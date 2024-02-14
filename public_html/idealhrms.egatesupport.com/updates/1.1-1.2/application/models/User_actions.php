<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    * @property employees_actions          $employees_actions
    * @property email_actions          $email_actions
    */
  
  class User_actions extends Base_model
  {
      function check_user()
      {
          $result=$this->db
                       ->select('user_id,user_password,password_salt,is_active,permissions,avatar,name as full_name,users.employee_id,position_id,department_id')
                       ->join('employees','employees.employee_id = users.employee_id','LEFT')
                       ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                       ->where(array('user_name'=>$this->input->post('username')))
                       ->get('users')
                       ->row_array();
          
          if (count($result)==0)
          {
              $this->set_error($this->lang->line('Wrong email or password'));
              return FALSE;
          }
          
          if ($result['is_active']=='0')
          {
              $this->set_error($this->lang->line('You is blocked'));
              return FALSE;
          }
          
          if (hash('sha512',$result['password_salt'].$this->input->post('password'))!=$result['user_password'])
          {
              $this->set_error($this->lang->line('Wrong email or password'));
              return FALSE;
          }
          
          unset($result['password_salt'],$result['user_password'],$result['is_active']);
          
          $this->load->helper('extract_first_name');
          $result['name']=extract_first_name($result['full_name']);
          $result['permissions']=unserialize($result['permissions']);
          
          $this->session->set_userdata($result);
          $this->db->update('users',array('last_login'=>date('Y-m-d H:i:s'),'last_logout'=>NULL),array('user_id'=>$result['user_id']));
          return TRUE;
      }
      
      function is_loged_in($permissions)
      {
          if ((isset($this->session->current->userdata['user_id'])) AND ($this->is_allowed($permissions)))
          {
              $this->load->language('common');
              $this->load->language($permissions);
              $this->load_messages();
              return TRUE;
          }
          
          header('Location: '.$this->config->item('base_url'));
          exit;
      }
      
      function is_allowed($permissions)
      {
          $logged=isset($this->session->current->userdata['permissions']['global_admin']);
          
          if (!is_array($permissions))
          {
              $permissions=array($permissions);
          }
          
          foreach($permissions as $permission)
          {
              if (isset($this->session->current->userdata['permissions'][$permission]))
              {
                  $logged=TRUE;
                  break;
              }
          }
          
          return $logged;
      }
      
      function get_profile()
      {
          $this->load->model('employees_actions');
          return $this->employees_actions->get_employee($this->session->current->userdata('employee_id'));
      }
      
      function save_profile()
      {
          $this->load->model('employees_actions');
          $_POST['employee_id']=$this->session->current->userdata('employee_id');
          $this->employees_actions->save_employee();
          
          $new_data=array();
          if ($this->employees_actions->get_avatar())
          {
              $new_data['avatar']=$this->employees_actions->get_avatar();
          }
          
          $new_data['full_name']=$this->input->post('employee_name');
          
          $this->load->helper('extract_first_name');
          $new_data['name']=extract_first_name($this->input->post('employee_name'));
          
          $this->session->set_userdata($new_data);
      }
      
      function save_password()
      {
          $result=$this->db
                       ->select('user_password, password_salt')
                       ->where('user_id',$this->session->current->userdata('user_id'))  
                       ->get('users')
                       ->row_array();
          
          if (hash('sha512',$result['password_salt'].$this->input->post('current_password'))!=$result['user_password'])
          {
              $this->set_error($this->lang->line('Wrong current password'));
              return FALSE;
          }
          
          $this->db->update('users',array('user_password'=>hash('sha512',$result['password_salt'].$this->input->post('new_password'))),array('user_id'=>$this->session->current->userdata('user_id')));
          return TRUE;
      }
      
      function logout()
      {
          $this->db->update('users',array('last_logout'=>date('Y-m-d H:i:s')),array('user_id'=>$this->session->current->userdata('user_id')));          
          $this->session->sess_destroy();
      }
      
      function is_employee_active($employee_id)
      {
          $is_active=$this->db
                          ->select('is_active')
                          ->where('employee_id',$employee_id)
                          ->get('users')
                          ->row_array();
          return $is_active['is_active']=='1';
      }
      
      function update_password()
      {
          if (($this->input->post('employee_id')=='1') OR (!$this->user_actions->is_allowed('admin')))
          {
              return FALSE;
          }
          
          $new_data['is_active']=($this->input->post('is_active')=='on');
          $new_data['permissions']=array('selfservice'=>TRUE);
          
          if ($this->input->post('new_password'))
          {
              $this->load->helper('key_generator');
              $salt=generate_key();
              $new_data['password_salt']=$salt;
              $new_data['user_password']=hash('sha512',$salt.$this->input->post('new_password'));
          }
          
          if ($this->input->post('permissions'))
          {
              foreach($this->input->post('permissions') as $permission=>$temp)
              {
                  if (in_array($permission,$this->config->item('possible_permissions')))
                  {
                      $new_data['permissions'][$permission]=TRUE;
                  }
              }
          }
          
          $new_data['permissions']=serialize($new_data['permissions']);
          $this->db->update('users',$new_data,array('employee_id'=>$this->input->post('employee_id')));
      }
      
      function forgot_password()
      {
          $is_exist=$this->db
                         ->select('employee_id')
                         ->where('user_name',$this->input->post('user_email'))
                         ->get('users')
                         ->row_array();
          
          if (count($is_exist)==0)
          {
              $this->set_error($this->lang->line('Email not found'));
              return FALSE;
          }
          
          $code=md5(rand().time().rand());
          
          $this->db->insert('activation_codes',array('code'=>$code,'type'=>'password','user_data'=>serialize(array('employee_id'=>$is_exist['employee_id']))));
          
          $this->load->model('email_actions');
          $message=$this->load->view('messages/new_password',array('code'=>$code),TRUE);
          $this->email_actions->send_email($this->input->post('user_email'),$this->lang->line('New password'),$message);
          
          return TRUE;
      }
      
      function check_code($code,$type)
      {
          $code_data=$this->db
                          ->select('user_data')
                          ->where(array('code'=>$code,'type'=>$type))
                          ->get('activation_codes')
                          ->row_array();
          if (count($code_data)==0)
          {
              $this->set_error($this->lang->line('Code not found'));
              return FALSE;
          }
          
          return unserialize($code_data['user_data']);
      }
      
      function set_new_password()
      {
          if (!$data=$this->check_code($this->input->post('code'),'password'))
          {
              return FALSE;
          }
          
          $this->load->helper('key_generator');
          $salt=generate_key();
          
          $this->db->update('users',
              array(
                'password_salt'=>$salt,
                'user_password'=>hash('sha512',$salt.$this->input->post('new_password'))
              ),
              array(
                'employee_id'=>$data['employee_id']
              ));
          
          $this->db->delete('activation_codes',array('code'=>$this->input->post('code')));
          
          return TRUE;
      }
      
      function get_permissions($employee_id)
      {
          $temp=$this->db
                     ->select('permissions')
                     ->where('employee_id',$employee_id)
                     ->get('users')
                     ->row_array();
          
          return unserialize($temp['permissions']);
      }
      
      function is_selfservice()
      {
          return isset($this->session->current->userdata['permissions']['selfservice']);
      }
      
      function load_messages()
      {
          if ($this->input->is_ajax_request())
          {
              return FALSE;
          }
          $messages=$this->db
                         ->select_sum('new_message','messages')
                         ->where('employee_id',$this->session->current->userdata('employee_id'))
                         ->get('mailbox_employees')
                         ->row_array();
          $this->load->vars('messages',$messages['messages']);
      }
      
      function check_detail($detail_type,$detail_id)
      {
          switch($detail_type)
          {
              case 'license':
              {
                  return $this->db
                              ->select('license_id')
                              ->where(array('employee_id'=>$this->session->current->userdata('employee_id'),'license_id'=>$detail_id))
                              ->get('employees_licenses')
                              ->num_rows()>0;
              }
          }
      }
  }
?>
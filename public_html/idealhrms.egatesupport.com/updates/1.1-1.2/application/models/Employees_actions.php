<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    * @property attachments_actions          $attachments_actions
    * @property departments_actions          $departments_actions
    * @property user_actions          $user_actions
    */
  
  class Employees_actions extends Base_model
  {
      private $photo=FALSE;
      
      function get_employees($page_id=1)
      {
          $this->db
               ->select('SQL_CALC_FOUND_ROWS employees.employee_id, name, avatar, position_name,status,IFNULL(department_name,"-") as department_name',FALSE)
               ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
               ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
               ->join('departments','departments.department_id = positions.department_id','LEFT')
               ->order_by('name')
               ->from('employees')
               ->limit(12,($page_id-1)*12);
          
          if ($this->input->get('search'))
          {
              $this->db
                   ->or_like('name',$this->input->get('search'),'both')
                   ->or_like('position_name',$this->input->get('search'),'both')
                   ->or_like('department_name',$this->input->get('search'),'both');
          }
          else
          {
              $this->db
                    ->where('status','Active');
          }
          
          $result['data']=$this->db
                               ->get()
                               ->result_array();
          
          $amount=$this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();
          
          $result['amount']=$amount['amount'];
          
          return $result;
      }
      
      function search_employee()
      {
          return $this->db
                      ->select('employees.employee_id as id, CONCAT(name,"[",IFNULL(department_name,"-"),"] ", IFNULL(position_name,"-")) as name',FALSE)
                      ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('status','Active')
                      ->like('name',$this->input->post('query'),'both')
                      ->order_by('name')
                      ->limit(20)
                      ->get('employees')
                      ->result_array();
      }
      
      function get_employee($employee_id)
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$employee_id)
                      ->get('employees')
                      ->row_array();
      }
      
      function check_email()
      {
          $result=$this->db
                       ->select('employee_id')
                       ->where('email',$this->input->post('employee_email'))
                       ->where('employee_id <> ',$this->input->post('employee_id'))
                       ->get('employees')
                       ->num_rows()>0;
          if ($result)
          {
              $this->set_error($this->lang->line('Email is currently used'));
              return FALSE;
          }
          
          return TRUE;
      }
      
      private function upload_avatar($self_service=FALSE)
      {
          if (isset($_FILES['employee_avatar'])  AND ($_FILES['employee_avatar']['error']==0))
         {
             $this->load->library('upload',array('upload_path'=>BASEPATH.'../files/avatars/','allowed_types'=>'gif|jpg|jpeg|png','max_size'=>'300','encrypt_name'=>TRUE));
             
             if (!$this->upload->do_upload('employee_avatar'))
             {
                 $this->set_error($this->upload->display_errors());
                 return FALSE;
             }

             $this->load->library('image_lib',array('image_library'=>'gd2','source_image'=>$this->upload->upload_path.$this->upload->file_name,'maintain_ratio'=>FALSE,'width'=>140,'height'=>140,'master_dim'=>'height')); 

             if (!$this->image_lib->resize())
             {
                 $this->set_error($this->image_lib->display_errors());
                 return FALSE;
             }
             
             $this->photo='files/avatars/'.$this->upload->file_name;
             if ($self_service)
             {
                 $this->session->set_userdata(array('avatar'=>$this->photo));
             }
         }
         
         return TRUE;
      }
      
      function save_employee()
      {
          if ((!$this->check_email()) OR (!$this->upload_avatar()))
          {
              return FALSE;
          }
          
          $data=array(
            'name'=>$this->input->post('employee_name'),
            'ssn'=>$this->input->post('employee_ssn'),
            'email'=>$this->input->post('employee_email'),
            'gender'=>($this->input->post('employee_gender')=='male')?'male':'female',
            'birth_date'=>($this->input->post('birth_date'))?date('Y-m-d',strtotime($this->input->post('birth_date'))):NULL
          );
          
          if ($this->photo)
          {
              $data['avatar']=$this->photo;
          }
          
          if ($this->input->post('employee_id')=='0')
          {
              $this->db->insert('employees',$data);
              
              $employee_id=$this->db->insert_id();
              
              $this->db->insert('users',array(
                'user_name'=>$this->input->post('employee_email'),
                'is_active'=>1,
                'employee_id'=>$employee_id,
                'permissions'=>'a:0:{}'
              ));
              
              return $employee_id;
          }
          
          $this->db->update('employees',$data,array('employee_id'=>$this->input->post('employee_id')));
          $this->db->update('users',array('user_name'=>$this->input->post('employee_email')),array('employee_id'=>$this->input->post('employee_id')));
          
          return TRUE;
      }
      
      function get_avatar()
      {
          return $this->photo;
      }
      
      function save_address()
      {
          $this->db->update('employees',array(
            'address'=>$this->input->post('employee_address'),
            'city'=>$this->input->post('employee_city'),
            'state'=>$this->input->post('employee_state'),
            'zip_code'=>$this->input->post('employee_zip'),
            'phone'=>$this->input->post('employee_phone'),
            'cell_phone'=>$this->input->post('employee_cell_phone'),
            'contacts'=>$this->input->post('contacts')
          ),array(
            'employee_id'=>$this->input->post('employee_id')
          ));
      }
      
      
      /**
       * Education
       * 
       */
      function get_education($employee_id)
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$employee_id)
                      ->order_by('start','DESC')
                      ->get('employees_education')
                      ->result_array();
      }
      
      function get_education_item($education_item)
      {
          return $this->db
                      ->select('*')
                      ->where('id',$education_item)
                      ->get('employees_education')
                      ->row_array();
      }
      
      function save_education()
      {
          if (($this->input->post('start') AND !strtotime($this->input->post('start'))) OR ($this->input->post('end') AND !strtotime($this->input->post('end'))))
          {
              $this->set_error($this->lang->line('Check dates'));
              return FALSE;
          }
          
          $data=array(
            'start'=>($this->input->post('start'))?date('Y-m-d',strtotime($this->input->post('start'))):NULL,
            'end'=>($this->input->post('end'))?date('Y-m-d',strtotime($this->input->post('end'))):NULL,
            'institution'=>$this->input->post('institution_name'),
            'description'=>$this->input->post('description')
          );
          
          if ($this->user_actions->is_allowed('employees'))
          {
              $data['is_verified']=1;
          }
          
          if ($this->input->post('education_id')=='0')
          {
              $data['employee_id']=$this->input->post('employee_id');
              $this->db->insert('employees_education',$data);
              $result=$education_id=$this->db->insert_id();
          }
          else
          {
              $this->db->update('employees_education',$data,array('id'=>$this->input->post('education_id'),'employee_id'=>$this->input->post('employee_id')));    
              $result=TRUE;
              $education_id=$this->input->post('education_id');
          }
          
          $this->load->model('attachments_actions');
          if (!$files=$this->attachments_actions->upload_attachments('education',$education_id))
          {
             return FALSE;
          }
          
          return array_merge($files,array('result'=>$result));
      }
      
      function delete_education($education_id)
      {
          $this->db->delete('employees_education',array('id'=>$education_id));
          
          $this->load->model('attachments_actions');
          $this->attachments_actions->remove_attachments('education',$education_id);
      }
      
      /**
       * Positions
       */
      function get_positions($employee_id)
      {
          return $this->db
                      ->select('id,is_current,start,end,position_name,IFNULL(department_name,"-") as department_name',FALSE)
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('employee_id',$employee_id)
                      ->order_by('start','DESC')
                      ->get('employees_positions')
                      ->result_array();
      }
      
      function get_position($position_id)
      {
          return $this->db
                      ->select('id,is_current,start,end,position_name,add_responsibilities,move_reason,responsibilities')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->where('id',$position_id)
                      ->get('employees_positions')
                      ->row_array();
      }
      
      function update_position()
      {
          $this->db->update('employees_positions',array('add_responsibilities'=>$this->input->post('add_responsibilities')),array('id'=>$this->input->post('position_id')));
      }
      
      function add_position()
      {
          $current_position=$this->get_current_position($this->input->post('employee_id'));
          
          if (count($current_position)>0)
          {
              if (strtotime($current_position['start'])>strtotime($this->input->post('start_date')))
              {
                  $this->set_error($this->lang->line('Error'));
                  return FALSE;
              }
              
              $this->db->update('employees_positions',array('is_current'=>0,'end'=>date('Y-m-d',strtotime($this->input->post('start_date')))),array('employee_id'=>$this->input->post('employee_id'),'is_current'=>1));
              
              if ($this->db->affected_rows()==0)
              {
                  $this->set_error($this->lang->line('Error'));
                  return FALSE;
              }    
          }
          
          $this->load->model('departments_actions');
          
          $this->db->insert('employees_positions',array(
            'employee_id'=>$this->input->post('employee_id'),
            'position_id'=>$this->input->post('new_position'),
            'department_id'=>$this->departments_actions->get_position_department($this->input->post('new_position')),
            'is_current'=>1,
            'start'=>date('Y-m-d',strtotime($this->input->post('start_date'))),
            'add_responsibilities'=>$this->input->post('add_responsibilities'),
            'move_reason'=>$this->input->post('move_reason')
          ));
          
          return $this->db->insert_id();
      }
      
      function get_current_position($employee_id)
      {
          return $this->db
                      ->select('position_id,start')
                      ->where(array('employee_id'=>$employee_id,'is_current'=>1))
                      ->get('employees_positions')
                      ->row_array();
      }
      
      /**
       * Skills
       */
      function get_skills($employee_id)
      {
          $temp= $this->db
                      ->select('skill_name, category_name,category_id')
                      ->join('skills','skills.skill_id = employees_skills.skill_id','LEFT')
                      ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                      ->where('employee_id',$employee_id)
                      ->order_by('skill_name')
                      ->get('employees_skills')
                      ->result_array();
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function get_employee_skills($employee_id)
      {
          $temp= $this->db
                      ->select('skills.skill_id,skill_name,category_name,employee_id,category_id')
                      ->join('skills','skills.parent_category = skills_categories.category_id AND skills.is_active=1','LEFT')
                      ->join('employees_skills','employees_skills.skill_id = skills.skill_id AND employee_id='.$employee_id,'LEFT')
                      ->where('skills_categories.is_active',1)
                      ->order_by('category_name,skill_name')
                      ->get('skills_categories')
                      ->result_array();
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function save_employee_skills()
      {
          $this->db->update('employees_skills',array('to_delete'=>1),array('employee_id'=>$this->input->post('employee_id'),'to_delete'=>0));
          
          $clean_ids=array(0);
          foreach($this->input->post('skills') as $skill_id=>$trash)
          {
              $clean_ids[]=(int)$skill_id;
          }
          
          $this->db
               ->query('INSERT INTO employees_skills (skill_id,employee_id)
                        SELECT skill_id,?
                        FROM skills
                        WHERE skill_id IN ('.implode(',',$clean_ids).')
                        ON DUPLICATE KEY UPDATE to_delete=0',array($this->input->post('employee_id')));
          
          $this->db->delete('employees_skills',array('employee_id'=>$this->input->post('employee_id'),'to_delete'=>1));
          
          return TRUE;
      }
      
      function delete_skill($skill_id)
      {
          $this->db->delete('skills_endorsement',array('skill_id'=>$skill_id));
          $this->db->delete('employees_skills',array('skill_id'=>$skill_id));
      }
      
      /**
       * Employment
       */
      function get_employment($employee_id) 
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$employee_id)
                      ->order_by('start')
                      ->get('employees_employment')
                      ->result_array();
      }
      
      function get_employment_item($employment_item)
      {
          return $this->db
                      ->select('*')
                      ->where('employment_id',$employment_item)
                      ->get('employees_employment')
                      ->row_array();
      }
      
      function save_employment()
      {
          $data=array(
            'start'=>date('Y-m-d',strtotime($this->input->post('start'))),
            'end'=>date('Y-m-d',strtotime($this->input->post('end'))),
            'company'=>$this->input->post('company'),
            'position'=>$this->input->post('position'),
            'responsibilities'=>$this->input->post('responsibilities')
          );
          
          if ($this->user_actions->is_allowed('employees'))
          {
              $data['is_verified']=1;
          }
          
          if ($this->input->post('employment_id')=='0')
          {
              $data['employee_id']=$this->input->post('employee_id');
              $this->db->insert('employees_employment',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('employees_employment',$data,array('employment_id'=>$this->input->post('employment_id'),'employee_id'=>$this->input->post('employee_id')));
          return TRUE;
      }
      
      function delete_employment($employment_id)
      {
          $this->db->delete('employees_employment',array('employment_id'=>$employment_id));
      }
      
      /**
       * Family
       */
      function get_family($employee_id)
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$employee_id)
                      ->get('employees_family')
                      ->result_array();
      }
      
      function get_relative($item_id)
      {
          return $this->db
                      ->select('*')
                      ->where('relative_id',$item_id)
                      ->get('employees_family')
                      ->row_array();
      }
      
      function save_relative()
      {
          $data=array(
            'relative_name'=>$this->input->post('relative_name'),
            'relative_type'=>$this->input->post('relative_type'),
            'birht_date'=>($this->input->post('birht_date'))?date('Y-m-d',strtotime($this->input->post('birht_date'))):NULL
          );
          
          if ($this->user_actions->is_allowed('employees'))
          {
              $data['is_verified']=1;
          }
          
          if ($this->input->post('relative_id')=='0')
          {
              $data['employee_id']=$this->input->post('employee_id');
              $this->db->insert('employees_family',$data);
              $result=$relative_id=$this->db->insert_id();
          }
          else
          {
              $this->db->update('employees_family',$data,array('relative_id'=>$this->input->post('relative_id'),'employee_id'=>$this->input->post('employee_id')));    
              $result=TRUE;
              $relative_id=$this->input->post('relative_id');
          }
          
          $this->load->model('attachments_actions');
          if (!$files=$this->attachments_actions->upload_attachments('relative',$relative_id))
          {
             return FALSE;
          }
          
          return array_merge($files,array('result'=>$result));
      }
      
      function delete_relative($relative_id)
      {
          $this->db->delete('employees_family',array('relative_id'=>$relative_id));
          
          $this->load->model('attachments_actions');
          $this->attachments_actions->remove_attachments('relative',$relative_id);
      }
      
      /**
       * Licenses
       */
      function get_licenses($employee_id) 
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$employee_id)
                      ->order_by('license_expiry')
                      ->get('employees_licenses')
                      ->result_array();
      }
      
      function get_license($item_id)
      {
          return $this->db
                      ->select('*')
                      ->where('license_id',$item_id)
                      ->get('employees_licenses')
                      ->row_array();
      }
      
      function save_license($employee_id=0)
      {
          $employee_id=($employee_id==0)?$this->input->post('employee_id'):$employee_id;
          
          $data=array(
            'license_name'=>$this->input->post('license_name'),
            'license_number'=>$this->input->post('license_number'),
            'license_expiry'=>($this->input->post('expiry'))?date('Y-m-d',strtotime($this->input->post('expiry'))):NULL,
            'is_verified'=>$this->user_actions->is_selfservice()?0:1
          );
          
          if ($this->input->post('license_id')=='0')
          {
              $data['employee_id']=$employee_id;
              $this->db->insert('employees_licenses',$data);
              $result=$license_id=$this->db->insert_id();
          }
          else
          {
              $this->db->update('employees_licenses',$data,array('license_id'=>$this->input->post('license_id'),'employee_id'=>$employee_id));
              $result=TRUE;
              $license_id=$this->input->post('license_id');
          }
          
          $this->load->model('attachments_actions');
          if (!$files=$this->attachments_actions->upload_attachments('license',$license_id))
          {
             return FALSE;
          }
          
          return array_merge($files,array('result'=>$result));
      }
      
      function delete_license($license_id)
      {
          $this->db->delete('employees_licenses',array('license_id'=>$license_id));
          
          $this->load->model('attachments_actions');
          $this->attachments_actions->remove_attachments('license',$license_id);
      }
      
      function resing_employee()
      {
          $current_position=$this->db
                                 ->select('*')
                                 ->where(array('employee_id'=>$this->input->post('employee_id'),'is_current'=>1))
                                 ->get('employees_positions')
                                 ->row_array();
          
          $this->db->insert('employees_resign',array(
            'employee_id'=>$this->input->post('employee_id'),
            'last_position'=>$current_position['position_id'],
            'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
            'reason'=>$this->input->post('reason')
          ));
          
          
          $this->db->update('employees',array('status'=>'Resigned'),array('employee_id'=>$this->input->post('employee_id')));
          $this->db->update('employees_positions',array('is_current'=>0,'end'=>date('Y-m-d',strtotime($this->input->post('date')))),array('employee_id'=>$this->input->post('employee_id'),'is_current'=>1));
          
          return TRUE;
      }
  }
?>
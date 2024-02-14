<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    * @property attachments_actions          $attachments_actions
    */

  class Mailbox_actions extends Base_model
  {
      function get_threads($page_id=1)
      {
          $result['data']=$this->db
                               ->select('SQL_CALC_FOUND_ROWS mailbox_employees.thread_id, subject, last_message,name,avatar, new_message',FALSE)
                               ->join('mailbox','mailbox.thread_id =  mailbox_employees.thread_id','LEFT')
                               ->join('employees','employees.employee_id = mailbox.author_id','LEFT')
                               ->order_by('new_message DESC, last_message DESC')
                               ->where('mailbox_employees.employee_id',$this->session->current->userdata('employee_id'))
                               ->limit(12,($page_id-1)*12)
                               ->get('mailbox_employees')
                               ->result_array();
          
          $amount=$this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();
          
          $result['amount']=$amount['amount'];
          
          return $result;
      }
      
      function is_allowed($thread_id)
      {
          return $this->db
                      ->select('thread_id')
                      ->where(array('thread_id'=>$thread_id,'employee_id'=>$this->session->current->userdata('employee_id')))
                      ->get('mailbox_employees')
                      ->num_rows()>0;
      }
      
      function get_thread($thread_id)
      {
          if (!$this->is_allowed($thread_id))
          {
              return array();
          }
          
          $result=$this->get_messages($thread_id);
          
          $result['thread']=$this->db
                                 ->select('subject, name, avatar,thread_id')
                                 ->join('employees','employees.employee_id = mailbox.author_id','LEFT')
                                 ->where('thread_id',$thread_id)
                                 ->get('mailbox')
                                 ->row_array();
          
          $this->db->update('mailbox_employees',array('new_message'=>0),array('thread_id'=>$thread_id,'employee_id'=>$this->session->current->userdata('employee_id'),'new_message > '=>0));
          
          return $result;
      }
      
      private function prepare_message_data()
      {
          $this->db
              ->select('SQL_CALC_FOUND_ROWS message_id, message, author_id, date, name, avatar,GROUP_CONCAT(CONCAT(\'{"file":"\',file,\'","attachment_id":\',attachment_id,\',"extenstion":"\',extenstion,\'","uploaded":"\',uploaded,\'"}\')) as attachments',FALSE)
              ->join('employees','employees.employee_id = mailbox_messages.author_id','LEFT')
              ->join('attachments','attachments.object = mailbox_messages.message_id AND attachments.type="message"','LEFT')
              ->group_by('message_id')
              ->order_by('date','DESC');
      }
      
      function get_messages($thread_id,$page_id=1)
      {
          ($page_id==1)?
            $this->db->limit(4,0):
            $this->db->limit(10,($page_id-2)*10+4);
          
          $this->prepare_message_data();
          $result['messages']=$this->db
                                   ->where('thread_id',$thread_id)
                                   ->get('mailbox_messages')
                                   ->result_array();
          
          $amount=$this->db->query('SELECT CEIL((FOUND_ROWS()-4)/10) as `amount`')->row_array();
          
          $result['amount']=$amount['amount'];
          
          return $result;
      }
      
      function get_message($message_id)
      {
          $this->prepare_message_data();
          return $this->db
                      ->where('message_id',$message_id)
                      ->get('mailbox_messages')
                      ->row_array();
      }
      
      private function add_message($thread_id)
      {
          $this->db->insert('mailbox_messages',array(
            'thread_id'=>$thread_id,
            'message'=>$this->input->post('message'),
            'author_id'=>$this->session->current->userdata('employee_id'),
            'date'=>date('Y-m-d H:i:s')
          ));
          
          $message_id=$this->db->insert_id();
          
          $this->load->model('attachments_actions');
          if (!$files=$this->attachments_actions->upload_attachments('message',$message_id))
          {
              return FALSE;
          }
          
          return $message_id;
      }
      
      function send_message()
      {
          if (!$this->is_allowed($this->input->post('thread_id')))
          {
              return FALSE;
          }
          
          $message_id=$this->add_message($this->input->post('thread_id'));
          
          $this->db->update('mailbox',array('last_message'=>date('Y-m-d H:i:s')),array('thread_id'=>$this->input->post('thread_id')));
          
          $this->db
               ->query('UPDATE mailbox_employees
                        SET new_message=new_message+1
                        WHERE thread_id=? AND employee_id<>?',array($this->input->post('thread_id'),$this->session->current->userdata('employee_id')));
          
          
          $this->db
               ->query('INSERT INTO events(event_id,event_type,event_source,recipient_id)
                        SELECT null,"message",?,employee_id
                        FROM mailbox_employees
                        WHERE thread_id=? AND employee_id<>?',array($message_id,$this->input->post('thread_id'),$this->session->current->userdata('employee_id')));
          
          return $message_id;
      }
      
      function remove_message($message_id)
      {
          $this->db->delete('mailbox_messages',array('message_id'=>$message_id,'author_id'=>$this->session->current->userdata('employee_id')));
          if ($this->db->affected_rows()>0)
          {
              $this->db->delete('events',array('event_type'=>'message','event_source'=>$message_id));
              $this->load->model('attachments_actions');
              $this->attachments_actions->remove_attachments('message',$message_id);
              return TRUE;
          }
          
          return FALSE;
      }
      
      function create_thread()
      {
          if (!isset($_POST['employees']) AND !isset($_POST['departments']) AND !isset($_POST['positions']))
          {
              $this->set_error($this->lang->line('Select at least one recipient'));
              return FALSE;
          }
          
          $this->db->insert('mailbox',array(
            'subject'=>$this->input->post('subject'),
            'author_id'=>$this->session->current->userdata('employee_id'),
            'last_message'=>date('Y-m-d H:i:s')
          ));
          
          $thread_id=$this->db->insert_id();
          
          $message_id=$this->add_message($thread_id);
          
          $this->db->insert('mailbox_employees',array(
            'thread_id'=>$thread_id,
            'employee_id'=>$this->session->current->userdata('employee_id')
          ));
          
          if (isset($_POST['employees']))
          {
              $recipients=array(0);
              foreach($this->input->post('employees') as $employee_id)
              {
                  $recipients[]=(int)$employee_id;
              }
              
              $this->db
                  ->query('INSERT INTO mailbox_employees(thread_id,employee_id,new_message)
                           SELECT ?,employee_id,1
                           FROM employees
                           WHERE employee_id IN ('.implode(',',$recipients).') AND status="Active"
                           ON DUPLICATE KEY UPDATE new_message=1',array($thread_id));
          }
          
          if (isset($_POST['departments']))
          {
              $recipients=array(0);
              foreach($this->input->post('departments') as $department_id)
              {
                  $recipients[]=(int)$department_id;
              }
              
              $this->db
                   ->query('INSERT INTO mailbox_employees(thread_id,employee_id,new_message)
                            SELECT ?,employee_id,1
                            FROM employees_positions
                            WHERE department_id IN ('.implode(',',$recipients).') AND is_current=1
                            ON DUPLICATE KEY UPDATE new_message=1',array($thread_id));
          }
          
          if (isset($_POST['positions']))
          {
              $recipients=array(0);
              foreach($this->input->post('positions') as $position_id)
              {
                  $recipients[]=(int)$position_id;
              }
              
              $this->db
                   ->query('INSERT INTO mailbox_employees(thread_id,employee_id,new_message)
                            SELECT ?,employee_id,1
                            FROM employees_positions
                            WHERE position_id IN ('.implode(',',$recipients).') AND is_current=1
                            ON DUPLICATE KEY UPDATE new_message=1',array($thread_id));
          }
          
          $this->db
               ->query('INSERT INTO events(event_id,event_type,event_source,recipient_id)
                        SELECT null,"message",?,employee_id
                        FROM mailbox_employees
                        WHERE thread_id=? AND employee_id<>?',array($message_id,$thread_id,$this->session->current->userdata('employee_id')));
          
          return $thread_id;
      }
  }
?>
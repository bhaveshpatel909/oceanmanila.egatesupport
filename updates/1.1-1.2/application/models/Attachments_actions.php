<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Attachments_actions extends Base_model
  {
      function get_attachments($object,$type)
      {
          return $this->db
                      ->select('*')
                      ->where(array('type'=>$type,'object'=>$object))
                      ->get('attachments')
                      ->result_array();
      }
      
      private function save_attachment($type,$object)
      {
          $this->db->insert('attachments',array(
                    'object'=>$object,
                    'type'=>$type,
                    'mime'=>$this->upload->file_type,
                    'extenstion'=>str_replace('.','',$this->upload->file_ext),
                    'file'=>$this->upload->orig_name,
                    'location'=>$this->upload->file_name,
                    'uploaded'=>date('Y-m-d H:i:s')                    
          ));
          
          return $this->db->insert_id();
      }
      
      function upload_attachments($type,$object)
      {
          $files=array('files'=>array('success'=>array(),'failed'=>array()));
          
          if (count($_FILES)==0)
          {
              return $files;
          }
          
          $this->load->library('upload',array(
                'upload_path'=>BASEPATH.'../files/attachments',
                'allowed_types'=>implode('|',$this->config->item('attachment_files')),
                'max_size'=>$this->config->item('max_file_size'),
                'encrypt_name'=>TRUE
          ));
         
         foreach($_FILES['new_attachments']['name'] as $index=>$name)
         {
             $_FILES['new_attachment']=array(
                'name'=>$name,
                'type'=>$_FILES['new_attachments']['type'][$index],
                'tmp_name'=>$_FILES['new_attachments']['tmp_name'][$index],
                'error'=>$_FILES['new_attachments']['error'][$index],
                'size'=>$_FILES['new_attachments']['size'][$index]
             );
             
             if (!$this->upload->do_upload('new_attachment'))
             {
                $files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
                $this->upload->error_msg=array();
                continue;
             }
             
             $files['files']['success'][]=array('id'=>$this->save_attachment($type,$object),'name'=>$this->upload->orig_name,'ext'=>str_replace('.','',$this->upload->file_ext));
         }
          
         return $files;
      }
      
      private function get_attachment($attachment_id)
      {
          return $this->db
                      ->select('*')
                      ->where('attachment_id',$attachment_id)
                      ->get('attachments')
                      ->row_array();
      }
      
      function remove_attachment($attachment_id,$check_permission=FALSE)
      {
          $attachment=$this->get_attachment($attachment_id);
          
          if (($check_permission) AND (!call_user_func(array($this,'check_'.$attachment['type']),$attachment['object'])))
          {
              return FALSE;
          }
          
          if (file_exists(BASEPATH.'../files/attachments/'.$attachment['location']))
          {
              @unlink(BASEPATH.'../files/attachments/'.$attachment['location']);
              $this->db->delete('attachments',array('attachment_id'=>$attachment_id));
          }
      }
      
      function download_attachment($attachment_id,$check_permission=FALSE)
      {
          $attachment=$this->get_attachment($attachment_id);
          
          if (($check_permission) AND (!call_user_func(array($this,'check_'.$attachment['type']),$attachment['object'])))
          {
              return FALSE;
          }
          
          if (!in_array($attachment['extenstion'],array('png','pdf','jpg','jpeg','gif','bmp')))
          {
              header('Content-Description: File Transfer');
              header('Content-Disposition: attachment; filename='.$file['file']);
          }
          
          header('Content-Type: '.$attachment['mime']);
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Pragma: public');
          readfile(BASEPATH.'../files/attachments/'.$attachment['location']);
          
          return TRUE;
      }
      
      private function check_license($license_id)
      {
          return $this->db
                      ->select('license_id')
                      ->where(array('license_id'=>$license_id,'employee_id'=>$this->session->current->userdata('employee_id')))
                      ->get('employees_licenses')
                      ->num_rows()>0;
      }
      
      private function check_message($message_id)
      {
          return $this->db
                      ->select('message_id')
                      ->join('mailbox_employees','mailbox_employees.thread_id = mailbox_messages.thread_id','LEFT')
                      ->where(array('message_id'=>$message_id,'employee_id'=>$this->session->current->userdata('employee_id')))
                      ->get('mailbox_messages')
                      ->num_rows()>0;
      }
      
      
      function remove_attachments($type,$object)
      {
          $files=$this->db
                      ->select('*')
                      ->where(array('type'=>$type,'object'=>$object))
                      ->get('attachments')
                      ->result_array();
          
          foreach($files as $attachment)
          {
              if (file_exists(BASEPATH.'../files/attachments/'.$attachment['location']))
              {
                  @unlink(BASEPATH.'../files/attachments/'.$attachment['location']);
                  $this->db->delete('attachments',array('attachment_id'=>$attachment['attachment_id']));
              }
          }
      }
  }
?>
<?php 
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
    
  class Mix_actions extends Base_model
  {
      function get_resign_reasons()
      {
          return $this->db
                      ->select('*')
                      ->where('is_active',1)
                      ->order_by('reason_name')
                      ->get('resign_reasons')
                      ->result_array();
      }
      
      function get_reason($reason_id)
      {
          return $this->db
                      ->select('*')
                      ->where('reason_id',$reason_id)
                      ->get('resign_reasons')
                      ->row_array();
      }
      
      function save_reason()
      {
          $data=array(
            'reason_name'=>$this->input->post('reason_name')
          );
          
          if ($this->input->post('reason_id')=='0')
          {
              $this->db->insert('resign_reasons',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('resign_reasons',$data,array('reason_id'=>$this->input->post('reason_id')));
          return TRUE;
      }
      
      function delete_reason($reason_id)
      {
          $this->db->update('resign_reasons',array('is_active'=>0),array('reason_id'=>$reason_id));
      }
      
      function get_processing_errors()
      {
          return $this->db
                      ->select('*')
                      ->order_by('error_date')
                      ->get('processing_errors')
                      ->result_array();
      }
      
      function delete_processing_errors()
      {
          $this->db->truncate('processing_errors');
          $this->db->update('events',array('has_error'=>0,'busy_by'=>0),array('has_error'=>1));
      }
      
      function get_punch_clock()
      {
          return $this->db
                      ->select('record_id, start_time, end_time, comments')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('start_time','DESC')
                      ->limit(5)
                      ->get('punch_clock')
                      ->result_array();
      }
      
      function update_clock_comments()
      {
          $this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
               ->where('end_time IS NULL',NULL,FALSE)
               ->update('punch_clock',array('comments'=>$this->input->post('comments')));
      }
      
      function complete_clock()
      {
          $this->db
               ->where('employee_id',$this->session->current->userdata('employee_id')) 
               ->where('end_time IS NULL',NULL,FALSE)
               ->update('punch_clock',array('comments'=>$this->input->post('comments'),'end_time'=>date('Y-m-d H:i:s')));
      }
      
      function get_latest_clock()
      {
          return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->limit(1)
                      ->order_by('end_time','DESC')
                      ->get('punch_clock')
                      ->result_array();
      }
	  function settingsas()
      {
          return $gbg = $this->db
                      ->select('*')
                       ->where('employee_id',$this->session->current->userdata('employee_id'))
                      // ->limit(1)
                      // ->order_by('end_time','DESC')
                      ->get('employees')
                      ->result_array();
      }
      
      function start_clock()
      {
		 $is_exist=$this->get_latest_clock();
          // if ((isset($is_exist[0]) AND !is_null($is_exist[0]['end_time'])) OR (count($is_exist)==0))
          // {
			   $gb=$this->settingsas();
		  $exact =  '+'.$gb[0]['late_time'].'minute';
			$date = date('Y-m-d H:i:s');
				
				//$date = "2017-06-16 08:40:00";
			$date1 = strtotime($date);
			$date2 = strtotime( $exact, $date1);
			   $lastd = date('Y-m-d H:i:s', $date2);
		//die("here");
              $this->db->insert('punch_clock',array(
                'employee_id'=>$this->session->current->userdata('employee_id'),
                'start_time'=>$lastd
              ));
			
			  
          //} 
		 
      }
      
      function get_unsent_emails()
      {
          return $this->db
                       ->where(array('busy_by'=>0,'has_error'=>0)) 
                       ->count_all_results('events');
      }
  }
?>
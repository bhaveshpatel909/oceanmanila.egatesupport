<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Timeoff_actions extends Base_model
  {
      function get_records($status=array('approved','denied'))
      {
          return $this->db
                      ->select('record_id, start_time, end_time, type,employee_comment, name,comment, timeoff.status,type,register_date')  
                      ->join('employees','employees.employee_id = timeoff.employee_id','LEFT')
                      ->where_in('timeoff.status',$status)
					  ->order_by("timeoff.start_time", "desc")
                      ->get('timeoff')
                      ->result_array();
      }
      
      function get_record($record_id,$status=array('approved','denied'))
      {
          return $this->db
                      ->select('*')
                      ->where('record_id',$record_id)
                      ->where_in('status',$status)
                      ->get('timeoff')
                      ->row_array();
      }
	  function get_leave($empid) {
        $this->db->where('employee_id', $empid);
        $this->db->where_in('status', 'approved');
$num_rows = $this->db->count_all_results('timeoff');
         return $num_rows;
    }
        function get_leave2($empid) {
        $this->db->where('employee_id', $empid);
        $this->db->where_in('status', 'request');
$num_rows = $this->db->count_all_results('timeoff');
         return $num_rows;
    }
      
      function save_record()
      {
          $employee_id=$this->input->post('employee_id');
          $employee_id=$employee_id[0];
          
          $data=array(
            'start_time'=>date('Y-m-d H:i',strtotime($this->input->post('start_time'))),
            'end_time'=>date('Y-m-d H:i',strtotime($this->input->post('end_time'))),
            'type'=>$this->input->post('type'),
			'register_date'=> date('Y-m-d H:i')
          );
          
          if ($employee_id==$this->session->current->userdata('employee_id'))
          {
              $data['employee_comment']=$this->input->post('employee_comment');
          }
          else
          {
              $data['comment']=$this->input->post('comment');
          }
          
          if ($this->input->post('record_id')=='0')
          {
              $data['employee_id']=$employee_id;
              $data['status']=($employee_id==$this->session->current->userdata('employee_id'))?'request':'approved';
              
              $this->db->insert('timeoff',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('timeoff',$data,array('record_id'=>$this->input->post('record_id')));
          return TRUE;
      }
      
      function delete_record($record_id)
      {
          $this->db->delete('timeoff',array('record_id'=>$record_id));
      }
      
      function change_status()
      {
          $this->db->update('timeoff',
            array(
                'status'=>$this->input->post('status'),
                'comment'=>$this->input->post('comment')
            ),
            array(
                'record_id'=>$this->input->post('record_id')
            )
          );
      }
      
      function get_employee_records()
      {
          return $this->db
                      ->select('record_id,start_time, end_time, type, status')
                      ->where('employee_id',$this->session->current->userdata['employee_id'])
                      ->get('timeoff')
                      ->result_array();
      }
	  function get_employee_yesterdayplan()
	  {
		  $date1= date('Y-m-d',strtotime("-1 days"));
		   $date2= date('Y-m-d');
		 // die("sdfs");
		   return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata['employee_id'])
					  ->where('schedules.start_date ', $date1)
					//->where('schedules.start_date =', $date2)
					->limit(1)
					->order_by("schedules.schedule_id", "desc")
                      ->get('schedules')
                      ->result_array();
	  }
	  function get_employee_todayplan()
	  {
		  $date1= date('Y-m-d',strtotime("-1 days"));
		   $date2= date('Y-m-d');
		 // die("sdfs");
		   return $this->db
                      ->select('*')
                      ->where('employee_id',$this->session->current->userdata['employee_id'])
					  ->where('schedules.start_date =', $date2)
					//->where('schedules.start_date <=', $date2)
					->limit(1)
					->order_by("schedules.schedule_id", "desc")
                      ->get('schedules')
                      ->result_array();
	  }
	  
	  function get_workmanualbydepartment($did)
	  {
		 // echo $did;
		  // die("sdfs");
		    $page_id=1;
			$this->db
                ->select('SQL_CALC_FOUND_ROWS *,departments.department_name as cname', FALSE)
				->join('departments', 'departments.department_id = workmanual.workmanual_category_id', 'LEFT')
				->limit(100, ($page_id - 1) * 100)
               // ->where('workmanual_category_id',$did )
                ->order_by('workmanual.uploaded', 'DESC')
                ->from('workmanual');

        // if ($this->input->get('search')) {
            // $this->db
                    // ->or_like('file', $this->input->get('search'), 'both')
                    // ->or_like('description', $this->input->get('search'), 'both');
        // }

        $result['data'] = $this->db
                ->get()
                ->result_array();
				// echo "<pre>";
				// print_R($result);
				
		foreach ($result['data'] as $key => $document) {
            $attachments = $this->db->select('*')->where(array('object'=> $document['workmanual_id'],'type'=> 'workmanual'))
                    ->get('attachments')->result_array();
            $document['attachments'] = $attachments;
            $result['data'][$key] = $document;
        }		
// echo "<pre>";
				// print_R($result);
        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
		return $result ;
	  }
	  function get_departmentname($did)
	  {
		 // echo $did;
		  // die("sdfs");
		    return $this->db
                      ->select('*')  
                       ->where('department_id',$did )
                      ->get('departments')
                      ->result_array();
	  }
	  
	  function get_employee_deta()
      {
          return $this->db
                      ->select('*')
                       ->where('employee_id',$this->session->current->userdata['employee_id'])
                    ->get('employees')
                      ->result_array();
      }
  }
?>
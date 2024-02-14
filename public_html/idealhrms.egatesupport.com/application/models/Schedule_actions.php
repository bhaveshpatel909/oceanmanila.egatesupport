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
class Schedule_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_schedule_items() {
        return $this->db
                        ->select('id,name')
                        ->get('schedule_item_setting')
                        ->result_array();
    }
	public function get_employeee($id) {
		//echo $id;
		//die("dsfe");
          $this->db->select('*');
        $this->db->where('employee_id', $id);
        $query = $this->db->get('employees');
        return $query->row_array();
    }

    function get_schedule_item($schedule_item_id) {
        $this->db->select('*');
        $this->db->where('id', $schedule_item_id);
        $query = $this->db->get('schedule_item_setting');
        return $query->row_array();
    }

    function save_schedule_item() {
        $data = array(
            'name' => $this->input->post('schedule_item_name'),
            'color' => $this->input->post('schedule_item_color'),
        );

        if ($this->input->post('schedule_item_id') == '0') {
            $this->db->insert('schedule_item_setting', $data);
            return $this->db->insert_id();
        }

        $this->db->update('schedule_item_setting', $data, array('id' => $this->input->post('schedule_item_id')));
        return TRUE;
    }

    function delete_schedule_item($schedule_item_id) {
        $this->db->delete('schedule_item_setting', array('id' => $schedule_item_id));
    }

    public function get_customer_items() {
        return $this->db
                        ->select('*')
                        ->get('customer_item_setting')
                        ->result_array();
    }

    function get_customer_item($customer_item_id) {
        $this->db->select('*');
        $this->db->where('id', $customer_item_id);
        $query = $this->db->get('customer_item_setting');
        return $query->row_array();
    }

    function save_customer_item() {
        $data = array(
            'name' => $this->input->post('customer_item_name'),
        );

        if ($this->input->post('customer_item_id') == '0') {
            $this->db->insert('customer_item_setting', $data);
            return $this->db->insert_id();
        }

        $this->db->update('customer_item_setting', $data, array('id' => $this->input->post('customer_item_id')));
        return TRUE;
    }

    function delete_customer_item($customer_item_id) {
        $this->db->delete('customer_item_setting', array('id' => $customer_item_id));
    }

    public function get_schedules() {
        $schedules = $this->db
                ->select('schedules.*, customer_item_setting.name as customer_name, schedule_item_setting.name as item_name')
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->get('schedules')
                ->result_array();

        return $schedules;
    } 
	public function get_allschedules($date) {
		$sdate= $date;
        // $schedules = $this->db
                // ->select('schedules.*, customer_item_setting.name as customer_name, schedule_item_setting.name as item_name')
                // ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                // ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
				
                // ->get('schedules')
                // ->result_array();
				$query = $this->db
                ->select('schedules.schedule_id as id, '."DATE_FORMAT(schedules.start_date,'%Y-%m-%d') as start, DATE_FORMAT(schedules.end_date,'%Y-%m-%d') as end, ".' schedules.remarks ,  schedules.remarks_admin,customer_item_setting.name as customer,CONCAT(schedule_item_setting.name) as title,CONCAT(" *",employees.name) as titlee, schedule_item_setting.color, employees.name as employee_name, schedule_item_setting.name as item_name', FALSE)
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->join('employees', 'employees.employee_id = schedules.employee_id', 'LEFT')
				->where('schedules.start_date=',$sdate)
                ->get('schedules');

        $schedules = $query->result_array();

        return $schedules;
    }
	
public function get_allschedules_month($emp,$newDate) {
		
		
		           $emloyee = $emp;
				$empp =  preg_replace("/[^a-zA-Z0-9\s]/", "",$emloyee);

           $query = $this->db
                ->select('schedules.schedule_id as id, '."DATE_FORMAT(schedules.start_date,'%Y-%m-%d') as start, DATE_FORMAT(schedules.end_date,'%Y-%m-%d') as end, ".' schedules.remarks ,  schedules.remarks_admin,customer_item_setting.name as customer,CONCAT(schedule_item_setting.name) as title,CONCAT(" *",employees.name) as titlee, schedule_item_setting.color, employees.name as employee_name, schedule_item_setting.name as item_name', FALSE)
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->join('employees', 'employees.employee_id = schedules.employee_id', 'LEFT')
			->where('schedules.start_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
			->order_by('schedules.start_date','DESC')
			->where('employees.employee_id',$empp)
                ->get('schedules');

        $schedules = $query->result_array();
 return $schedules;
    }


    public function get_schedule_calendar($start_date, $end_date, $employee_id, $schedule_item_id) {
        if (!is_null($employee_id) && $employee_id != 0) {
            $this->db->where('schedules.employee_id', $employee_id);
        }
        if (!is_null($schedule_item_id) && $schedule_item_id != 0) {
            $this->db->where('schedules.schedule_item_id', $schedule_item_id);
        }
        $this->db->where(array('schedules.start_date >=' => $start_date, 'schedules.start_date <=' => $end_date));
        $this->db->order_by('schedules.schedule_item_id');
        $query = $this->db
                ->select('schedules.schedule_id as id, '."DATE_FORMAT(schedules.start_date,'%Y-%m-%d') as start,DATE_FORMAT(schedules.start_date,'%Y-%m-%d %H:%i') as startd, DATE_FORMAT(schedules.end_date,'%Y-%m-%d') as end,DATE_FORMAT(schedules.end_date,'%Y-%m-%d %H:%i') as enddr, DATE_FORMAT(schedules.updated_date,'%Y-%m-%d') as updateddate,DATE_FORMAT(schedules.updated_date,'%H:%i %p') as updated, ".' schedules.remarks , customer_item_setting.name as customer,CONCAT(schedule_item_setting.name) as title,CONCAT(" *",employees.name) as titlee, schedule_item_setting.color, employees.name as employee_name, schedule_item_setting.name as item_name', FALSE)
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->join('employees', 'employees.employee_id = schedules.employee_id', 'LEFT')
                ->get('schedules');

        $schedules = $query->result_array();
		// echo'<pre>';
		// print_r($schedules);
		// echo'</pre>';
		// die('vvvfffv');
		
//        foreach ($schedules as $key => $schedule) {
//            $schedule['url'] = "schedule/edit_schedule/" . $schedule['id'];
//            $schedule['className'] = "schedule-item" ;
//            $schedules[$key] = $schedule;
//        }
        return $schedules;
    }
	
	/*************************************************************/
	
	
	public function get_schedule_bircalendar() {
        
//echo "rdtgrfdg";		
		return $this->db
                        ->select('bir_calnder_files.*, bir_forms.form_name')
                ->join('bir_forms', 'bir_forms.form_id = bir_calnder_files.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_calnder_files')
                        ->result_array();
    }
	public function get_schedule_accountingcalendar() {
        
//echo "rdtgrfdg";		
		return $this->db
                        ->select('accounting_schedules.*')
               // ->join('bir_forms', 'bir_forms.form_id = bir_calnder_files.form_id', 'LEFT')
						//->order_by("for_themonth", "asc")
                        ->get('accounting_schedules')
                        ->result_array();
    }
	public function get_schedule_birentry($title) {
        
//echo "rdtgrfdg";	
		 $formname= rtrim($title);	
		 $this->db->select('*');
        $this->db->where('form_name',$formname);
		 //$this->db->like('due_date', 'Every 10th%');  
         $query = $this->db->get('bir_forms');
        $schedules = $query->result_array();
		
        return $schedules;
    }

	public function get_fileattach($fid) {
        
	
		 $this->db->select('*');
        $this->db->where('object', $fid);
		 $this->db->where('type', 'bir_calander_file');
		 //$this->db->like('due_date', 'Every 10th%');  
         $query = $this->db->get('attachments');
		 
        //$schedules = $query->result_array();
        return $query->num_rows();
    }
	public function get_fileattach2($fid) {
        
	
		 $this->db->select('*');
        $this->db->where('object', $fid);
		 $this->db->where('type', 'bir_calander_file2');
		 //$this->db->like('due_date', 'Every 10th%');  
         $query = $this->db->get('attachments');
		 
        //$schedules = $query->result_array();
        return $query->num_rows();
    }
	public function get_fileattachname($fid) {
        
	
		 $this->db->select('*');
        $this->db->where('object', $fid);
        $this->db->where('type', 'bir_form');
		 //$this->db->like('due_date', 'Every 10th%'); 
		$this->db->order_by('uploaded','DESC');
         $this->db->limit(1);		 
         $query = $this->db->get('attachments');
		 
        $schedules = $query->result_array();
        return $schedules;
    
	}public function get_fileattachname2($fid) {
        
	
		 $this->db->select('*');
        $this->db->where('object', $fid);
        $this->db->where('type', 'bir_form2');
		 $this->db->order_by('uploaded','DESC');
          $this->db->limit(1);
		 //$this->db->like('due_date', 'Every 10th%');  
         $query = $this->db->get('attachments');
		 
        $schedules = $query->result_array();
        return $schedules;
    }
	
	
	public function save_birentryforms()
	
	{
		 $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_c_file_id') == '0') {
            $this->db->insert('bir_calnder_files', $data);
            $result = $bir_c_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_calnder_files', $data, array('bir_c_file_id' => $this->input->post('bir_c_file_id')));
            $result = TRUE;
            $bir_c_file_id = $this->input->post('bir_c_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_calander_file', $bir_c_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_calander_file2', $bir_c_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
		
	}
	/*************************************************************/

    function get_schedule_daily() {
        $schedule_date = $this->input->post('schedule_date');
        if (!isset($schedule_date)) {
            $schedule_date = date('Y-m-d');
        }
        $this->db->where('schedule_date', $schedule_date);
        $this->db->order_by('customer_item_id');
        $schedules = $this->db
                ->select('schedules.*, customer_item_setting.name as customer_name, schedule_item_setting.name as item_name')
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->get('schedules')
                ->result_array();
        //array_sort_by_column($schedules, 'customer_item_id');
        return $schedules;
    }

    function get_schedule($schedule_id) {
        $this->db->where('schedules.schedule_id', $schedule_id);
        $schedule = $this->db
                ->select('schedules.*, customer_item_setting.name as customer_name, schedule_item_setting.name as item_name, employees.employee_id, employees.name as employee_name')
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->join('employees', 'schedules.employee_id = employees.employee_id', 'LEFT')
                ->get('schedules')
                ->row_array();
        return $schedule;
    }

    function save_schedule() {
		
		$test= $this->input->post('description');
		    $shudule_id   =$this->input->post('schedule_id');
		    $remarks_employee = $this->input->post('remarks_employee');
		if($this->input->post('end_date')!="")
			
		{
			$end =$this->input->post('end_date');
		}
		else
		{
        $end = strtotime('+29 minutes', strtotime($this->input->post('start_date')));
		}
		// echo $end;
		// die("dfsg");
		$this->load->model('employees_actions');
		$result = $this->employees_actions->get_employee($this->input->post('employee_id'));
		$crntusr = $this->employees_actions->get_employee($this->session->current->userdata('employee_id'));
		
			$name=$crntusr['name'];
			$email=$crntusr['email'];
			
		$msgg = $this->input->post('description');
		
		$count = $this->input->post('count');
	if(!$this->user_actions->is_selfservice() && $this->input->post('schedule_id') != '0'){
		$remarks_admin = $this->input->post('remarks_admin');
	
	   $new_remarks = '<span style="color:red;font-weight:bolder;">'.$remarks_admin.'</span>';
	   if($this->input->post('end_date')!="")
	   {
		$data = array(
        'schedule_id' => $this->input->post('schedule_id'),
		'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
        'end_date' =>$this->input->post('end_date'),
        'remarks_admin' => strip_tags($new_remarks),
		
           'remarks' => $test,
        );
		$data['updated_date'] = date('Y-m-d H:i:s');
	   }
	   else
	   {
		 $data = array(
        'schedule_id' => $this->input->post('schedule_id'),
		'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
        'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
        'remarks_admin' => strip_tags($new_remarks),
		
           'remarks' => $test,
        );
		$data['updated_date'] = date('Y-m-d H:i:s');  
	   }
		
		 $this->db->update('schedules', $data, array('schedule_id' => $this->input->post('schedule_id')));
		die("Updated");
		
	}
	
	 if ($this->input->post('schedule_id') == '0') {
		 
		 // echo "dshgfd";
		 // die("here");
		 $ename =$this->input->post('employee');
			if($this->input->post('end_date')!="")
	   {
			  $data = array(
        'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
       'end_date' =>$this->input->post('end_date'),
	  // 'end_date' => date('Y-m-d H:i:s',$end),
        'remarks' => $test,
        'employee_id' => $this->input->post('employee_id'),
        'employee_name' => $ename[0]
		
		
        );

           $data['created_date'] = date('Y-m-d H:i:s');
           $data['updated_date'] = date('Y-m-d H:i:s');
	   }
	   else
	   {
		     $data = array(
        'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
       // 'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
	   'end_date' => date('Y-m-d H:i:s',$end),
        'remarks' => $test,
        'employee_id' => $this->input->post('employee_id'),
        'employee_name' => $ename[0]
		
		
        );

           $data['created_date'] = date('Y-m-d H:i:s');
           $data['updated_date'] = date('Y-m-d H:i:s');
		   
	   }
			
			// $data['remarks'] = $test;
			 // echo "<pre>";
			 // print_r($data);
			 // die("dgfd");
       $this->db->insert('schedules', $data); 
	$this->db->last_query();
	
			$schedule_id = $this->db->insert_id();
//die("dfs");
		return	$schedule_id;
		
        }
	
	if($this->user_actions->is_selfservice()){
			
		 $remarks_employee = $this->input->post('remarks_employee');
	       $schu_id=$this->input->post('schedule_id');
				$idd =$this->get_schedules($schu_id);
		
	  $remarks_admin = $this->input->post('remarks_admin');
	   $remarks_employe = '<span style="color:red;font-weight:bolder;">'.$remarks_employee.'</span>';
	   
	   if($this->input->post('end_date')!="" && $this->input->post('end_date'))
	   {
		$data = array(
        'schedule_id' => $this->input->post('schedule_id'),
		   'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
      'end_date' =>  $this->input->post('end_date'),
	  // 'end_date' => date('Y-m-d H:i:s',$end),
        'remarks_employe' => strip_tags($remarks_employe),
        'remarks_employe_detail' => ($email.','.$name.','.date('Y-m-d H:i:s')),
		'remarks_admin' => strip_tags($remarks_admin),
        'remarks' => $test
        );
		$data['updated_date'] = date('Y-m-d H:i:s');
	   }
	   else
	   {
		   $data = array(
        'schedule_id' => $this->input->post('schedule_id'),
		   'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
      // 'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
	   'end_date' => date('Y-m-d H:i:s',$end),
        'remarks_employe' => strip_tags($remarks_employe),
        'remarks_employe_detail' => ($email.','.$name.','.date('Y-m-d H:i:s')),
		'remarks_admin' => strip_tags($remarks_admin),
        'remarks' => $test
        );
		$data['updated_date'] = date('Y-m-d H:i:s');
		   
	   }
		$formatedMessag = '<html><head></head><span></br> <strong>Admin Message : </strong>'.$remarks_admin.'</span><span></br> <strong>Employe Message : </strong>'.$remarks_employe.'</span><body style="color:red;font-weight:800">You have newly updated job assignment as bellows</body>'.$msgg;
			
		
			
			 $from_email = $crntusr['email']; 
			 $to_email = $result['email'];
			$subject = 'Daily job assignment update with Employe Message ';
		
			$this->load->library('email'); 
			 $this->email->set_mailtype("html");
			 $this->email->from($from_email); 
			 $this->email->to($to_email);
			 $this->email->subject('Re:'.$subject); 
			 $this->email->message($formatedMessag); 
	   
			 //Send mail 
			 if($this->email->send()) 
			 $this->session->set_flashdata("email_sent","Email sent successfully."); 
			 else 
			 $this->session->set_flashdata("email_sent","Error in sending Email."); 
		
		$this->db->update('schedules', $data, array('schedule_id' => $this->input->post('schedule_id')));
		$msg='<span>Updated</span>';
		die($msg);	
		}
	if( $this->input->post('employee')!="")
		{
			
			if($this->input->post('end_date')!="")
			{
				 $ename =$this->input->post('employee');
				$data = array(
				'schedule_item_id' => $this->input->post('schedule_item_id'),
				'customer_item_id' => $this->input->post('customer_item_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => $this->input->post('end_date'),
				//'end_date' => $this->input->post('end_date'),
				'remarks' => $test,
				'employee_id' => $this->input->post('employee_id'),
				'employee_name' => $ename[0]
				);
			}
			else
			{
				 $ename =$this->input->post('employee');
				$data = array(
				'schedule_item_id' => $this->input->post('schedule_item_id'),
				'customer_item_id' => $this->input->post('customer_item_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
				//'end_date' => $this->input->post('end_date'),
				'remarks' => $test,
				'employee_id' => $this->input->post('employee_id'),
				'employee_name' => $ename[0]
				);
			}
		}
		
		
		else
		{
			if($this->input->post('end_date')!="")
			{
		 $data = array(
        'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
        'end_date' => $this->input->post('end_date'),
	   //'end_date' => $this->input->post('end_date'),
        'remarks' => $test,
		
        'employee_id' => $this->input->post('employee_id')
        
        );	
			}
			else
			{
				 $data = array(
				'schedule_item_id' => $this->input->post('schedule_item_id'),
				'customer_item_id' => $this->input->post('customer_item_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
			   //'end_date' => $this->input->post('end_date'),
				'remarks' => $test,
				
				'employee_id' => $this->input->post('employee_id')
				
				);	
			}
		}
       
	
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->update('schedules', $data, array('schedule_id' => $this->input->post('schedule_id')));
		
		
		//die("Updated");
		
		if($count == 1){
			
			$formatedMessag = '<html><head></head><body style="color:red;font-weight:800">You have newly updated job assignment as bellows</body>'.$msgg;
			
			 $from_email = $crntusr['email']; 
			 $to_email = $result['email'];
			$subject = 'Daily job assignment update';
			
			$this->load->library('email'); 
			 $this->email->set_mailtype("html");
			 $this->email->from($from_email); 
			 $this->email->to($to_email);
			 $this->email->subject('Re:'.$subject); 
			 $this->email->message($formatedMessag); 
	   
			 //Send mail 
			 if($this->email->send()) 
			 $this->session->set_flashdata("email_sent","Email sent successfully."); 
			 else 
			 $this->session->set_flashdata("email_sent","Error in sending Email."); 
		}
		
        return TRUE;
    } 
	function save_accounting_schedule() {
		
		$test= $this->input->post('description');
		$subject= $this->input->post('subject');
		   // $shudule_id   =$this->input->post('schedule_id');
		   // $remarks_employee = $this->input->post('remarks_employee');
		if($this->input->post('end_date')!="")
			
		{
			$end =$this->input->post('end_date');
		}
		else
		{
        $end = strtotime('+29 minutes', strtotime($this->input->post('start_date')));
		}
	
	
	 if ($this->input->post('schedule_id') == '0') {
		 
		 // echo "dshgfd";
		 // die("here");
		 //$ename =$this->input->post('employee');
			if($this->input->post('end_date')!="")
			{
			  $data = array(
        //'schedule_item_id' => $this->input->post('schedule_item_id'),
        //'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
       'end_date' =>$this->input->post('end_date'),
	  // 'end_date' => date('Y-m-d H:i:s',$end),
        'remarks' => $test,
        'subject' => $subject,
      //  'employee_name' => $ename[0]
		
		 );

           $data['created_date'] = date('Y-m-d H:i:s');
           $data['updated_date'] = date('Y-m-d H:i:s');
	   }
	   else
	   {
		     $data = array(
       // 'schedule_item_id' => $this->input->post('schedule_item_id'),
       // 'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
       // 'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
	   'end_date' => date('Y-m-d H:i:s',$end),
        'remarks' => $test,
        //'employee_id' => $this->input->post('employee_id'),
        'subject' => $subject
		
		
        );

           $data['created_date'] = date('Y-m-d H:i:s');
           $data['updated_date'] = date('Y-m-d H:i:s');
		   
	   }
			
			// $data['remarks'] = $test;
			 // echo "<pre>";
			 // print_r($data);
			 // die("dgfd");
       $this->db->insert('accounting_schedules', $data); 
	//echo $this->db->last_query();
	
			$schedule_id = $this->db->insert_id();
//die("dfs");
		return	$schedule_id;
		
        }
		else
			{
				 $data = array(
				'schedule_item_id' => $this->input->post('schedule_item_id'),
				'customer_item_id' => $this->input->post('customer_item_id'),
				'start_date' => $this->input->post('start_date'),
				'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
			   //'end_date' => $this->input->post('end_date'),
				'remarks' => $test,
				
				'subject' => $subject
				
				);	
			
		
       
	
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->update('accounting_schedules', $data, array('schedule_id' => $this->input->post('schedule_id')));
	//die("Updated");
			}
		
		
		
        return TRUE;
    }
	
	/*****************************8DRag Drop schedule**************************/
	
	function drag_schedule($data, $id)
	
	{
		
		 $this->db->insert('schedules', $data);
            $schedule_id = $this->db->insert_id();
			if($schedule_id)
			{
				$this->db->trans_start();
        $this->db->delete('schedules', array('schedule_id' => $id));
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return array('error' => 1);
        } else {
            return array('error' => 0);
        }
			}
	//	return	$schedule_id;
		
	}
	
	
	/**********************Ends here ****************************************/
	
	
	
	function upate_email($schedule_id){
		$this->load->model('settings_actions');
	 $schedul=$this->schedule_actions->get_schedule($schedule_id);
	 // print_r($schedul);
	 // die();
	 $employee = $this->schedule_actions->get_employeee($schedul['employee_id']);
	  $compny = $this->settings_actions->get_settings('company');
	  $compny_mail=$compny['company_email'];

$str = $compny_mail ;
 $email=explode(",",$str);
 $adimn_e=$email[0];
     $Admin_msgg=$schedul['remarks_admin'];
	 $msgg=$schedul['remarks'];
	 if($Admin_msgg !=''){
	 $Admin_msgg=$schedul['remarks_admin'];
	 }else {
		 $Admin_msgg='NO Message';
		 
	 }
	  $emp_email=$employee['email'];
	
	        $formatedMessag = '<html><head></head><body style="color:red;font-weight:800">You have newly updated job assignment as bellows</body>'.$msgg.'</br>&nbsp;&nbsp;<p style="font-weight:bolder;color:#000;">Admin Message For You :</p>&nbsp;&nbsp;<span style="color:green;">&nbsp;&nbsp;'.$Admin_msgg.'</span>';
			
			 $from_email = $adimn_e; 
			 $to_email = $emp_email;
			$subject = 'Updated job';
			
			$this->load->library('email'); 
			 $this->email->set_mailtype("html");
			 $this->email->from($from_email); 
			 $this->email->to($to_email);
			 $this->email->subject('Admin message:'.$subject); 
			 $this->email->message($formatedMessag); 
	   
			 //Send mail 
			 if($this->email->send()){ 
			 $this->session->set_flashdata("email_sent","Email sent successfully."); 
			 } else {
			 $this->session->set_flashdata("email_sent","Error in sending Email."); 
			 }
			 return true;
	}
    function delete_schedule($schedule_id) {

        $this->db->trans_start();
        $this->db->delete('schedules', array('schedule_id' => $schedule_id));
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return array('error' => 1);
        } else {
            return array('error' => 0);
        }
    }

    function preview_schedule($schedule_id) {
        $schedule = $this->db
                ->select('schedule.*, SUM(schedule_details.amount) as total, employees.name as employee_name')
                ->join('employees', 'employees.employee_id = schedule.employee_id', 'LEFT')
                ->join('schedule_details', 'schedule_details.schedule_id = schedule.schedule_id', 'LEFT')
                ->where('schedule.schedule_id', $schedule_id)
                ->group_by('schedule_details.schedule_id')
                ->get('schedule')
                ->row_array();
        $schedule_details = $this->db
                ->select('schedule_details.*, schedule_item_setting.name as schedule_item_name')
                ->join('schedule_item_setting', 'schedule_details.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->where('schedule_id', $schedule_id)
                ->get('schedule_details')
                ->result_array();
        //_custom_debug($schedule_details);
        $schedule['details'] = $schedule_details;
        return $schedule;
    }

}

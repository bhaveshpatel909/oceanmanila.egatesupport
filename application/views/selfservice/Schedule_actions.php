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
                ->select('schedules.schedule_id as id, '."DATE_FORMAT(schedules.start_date,'%Y-%m-%d') as start, DATE_FORMAT(schedules.end_date,'%Y-%m-%d') as end, ".' schedules.remarks , customer_item_setting.name as customer,CONCAT(schedule_item_setting.name) as title,CONCAT(" *",employees.name) as titlee, schedule_item_setting.color, employees.name as employee_name, schedule_item_setting.name as item_name', FALSE)
                ->join('schedule_item_setting', 'schedules.schedule_item_id = schedule_item_setting.id', 'LEFT')
                ->join('customer_item_setting', 'schedules.customer_item_id = customer_item_setting.id', 'LEFT')
                ->join('employees', 'employees.employee_id = schedules.employee_id', 'LEFT')
                ->get('schedules');

        $schedules = $query->result_array();
		// echo'<pre>';
		// print_r($schedules);
		// echo'<pre>';
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
		 $this->db->select('*');
        $this->db->where('due_date', 'Every 10th day after the end of each month');
		 //$this->db->like('due_date', 'Every 10th%');  
         $query = $this->db->get('bir_forms');
        $schedules = $query->result_array();
        return $schedules;
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
		 $this->db->where('type', 'bir_form');
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
         $query = $this->db->get('attachments');
		 
        $schedules = $query->result_array();
        return $schedules;
    }
	
	
	public function save_birentryforms()
	
	{
		
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
		// echo  $this->input->post('remarks');
		// die("hdshgfadhvkf");
        $end = strtotime('+29 minutes', strtotime($this->input->post('start_date')));
		$this->load->model('employees_actions');
		$result = $this->employees_actions->get_employee($this->input->post('employee_id'));
		$crntusr = $this->employees_actions->get_employee($this->session->current->userdata('employee_id'));
		$msgg = $this->input->post('remarks');
		$count = $this->input->post('count');
		if( $this->input->post('employee')!="")
		{
        $data = array(
        'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
        'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
        'remarks' => $this->input->post('remarks'),
        'employee_id' => $this->input->post('employee_id'),
        'employee_name' => $this->input->post('employee')
        );
		}
		else
		{
		 $data = array(
        'schedule_item_id' => $this->input->post('schedule_item_id'),
        'customer_item_id' => $this->input->post('customer_item_id'),
        'start_date' => $this->input->post('start_date'),
        'end_date' => date('Y-m-d H:i:s',$end), //$this->input->post('end_date'),
        'remarks' => $this->input->post('remarks'),
        'employee_id' => $this->input->post('employee_id')
        
        );	
		}
        if ($this->input->post('schedule_id') == '0') {
            $data['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert('schedules', $data);
            $schedule_id = $this->db->insert_id();
            return $schedule_id;
        }
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->update('schedules', $data, array('schedule_id' => $this->input->post('schedule_id')));
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

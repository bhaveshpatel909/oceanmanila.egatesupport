
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
class Task_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_task_status_list() {
        return $this->db
                        ->select('*')
                        ->get('task_status')
                        ->result_array();
    }

    function get_task_status($task_status_id) {
        $this->db->select('*');
        $this->db->where('task_status_id', $task_status_id);
        $query = $this->db->get('task_status');
        return $query->row_array();
    }

    function save_task_status() {
        $data = array(
            'task_status_name' => $this->input->post('task_status_name'),
//            'description' => $this->input->post('description')
        );

        if ($this->input->post('task_status_id') == '0') {
            $this->db->insert('task_status', $data);
            return $this->db->insert_id();
        }

        $this->db->update('task_status', $data, array('task_status_id' => $this->input->post('task_status_id')));
        return TRUE;
    }

    function delete_task_status($task_status_id) {
        $this->db->delete('task_status', array('task_status_id' => $task_status_id));
    }
	
	public function get_task_type_list() {
        return $this->db
                        ->select('*')
                        ->get('task_type')
                        ->result_array();
    }

    public function get_task_category_list() {
        return $this->db
                        ->select('*')
                        ->get('task_category')
                        ->result_array();
    }

    function get_task_category($task_category_id) {
        $this->db->select('*');
        $this->db->where('task_category_id', $task_category_id);
        $query = $this->db->get('task_category');
        return $query->row_array();
    }
	
	function get_task_type($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('task_type');
        return $query->row_array();
    }

	function save_task_type() {
        $data = array(
            'code' => $this->input->post('task_code'),
            'type' => $this->input->post('task_type')
        );

        if ($this->input->post('id') == '0') {
            $this->db->insert('task_type', $data);
            return $this->db->insert_id();
        }
		$this->db->update('task_type', $data, array('id' => $this->input->post('id')));
        return TRUE;
    }
	function delete_task_type($id) {
        $this->db->delete('task_type', array('id' => $id));
    }
	
    function save_task_category() {
        $data = array(
            'task_category_name' => $this->input->post('task_category_name'),
//            'description' => $this->input->post('description')
        );

        if ($this->input->post('task_category_id') == '0') {
            $this->db->insert('task_category', $data);
            return $this->db->insert_id();
        }

        $this->db->update('task_category', $data, array('task_category_id' => $this->input->post('task_category_id')));
        return TRUE;
    }

    function delete_task_category($task_category_id) {
        $this->db->delete('task_category', array('task_category_id' => $task_category_id));
    }

    public function get_tasks($status = null, $employee_id, $catte = null) {
		//print_r($employee_id);
		
		//$perm = $this->session->current->userdata;
			// echo'<pre>';
			// print_r($perm);

			// die('out');
		

        if (isset($status)) {
            if ($status == 'all') {
                $this->db->where(array('tasks.status !=' => 'completed'));
            } elseif($status == 'regular') {
                $this->db->where(array('tasks.task_regular' => 1));
            } else {
                $this->db->where(array('tasks.status' => $status));
            }
        }
		
        if (isset($employee_id)) {
			
			if ($employee_id===1) 
			{
				$xy='%'. 1 .'%';
				$this->db->where(array('tasks.notify like' => $xy));
			}
			else
			{
				$xy='%'.$employee_id.'%';
				$this->db->where(array('tasks.notify like' => $xy));
			}
        }
		
		if (isset($catte)) {
            $this->db->where(array('tasks.task_category_id' => $catte));
        }
		
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, task_type.code as tcode ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->join('task_type', 'task_type.id = tasks.taskcode', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
		
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		
        return $result;
    } 
	public function get_selftasks($status = null, $employee_id = null, $catte = null, $did=null) {
		
		//$perm = $this->session->current->userdata;
			// echo'<pre>';
			// print_r($perm);

			// die('out');
			//echo $status;
		
        if (isset($status)) {
            if ($status == 'all') {
                $this->db->where(array('tasks.status !=' => 'completed'));
              //  $this->db->where(array('tasks.status !=' => 'completed'));
            } elseif($status == 'regular') {
                $this->db->where(array('tasks.task_regular' => 1));
            } else {
                $this->db->where(array('tasks.status' => $status));
            }
        }
        if (isset($employee_id)) {
			
			$this->db->where('tasks.notify LIKE', '%'.$employee_id.'%');
           // $this->db->where(array('tasks.employee_id' => $employee_id));
        }
		if (isset($catte)) {
            $this->db->where(array('tasks.task_category_id' => $catte));
        }
		
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, task_type.code as tcode ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->join('task_type', 'task_type.id = tasks.taskcode', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
		// echo'<pre>';
			// print_r($result);

			// die('out');
		
        return $result;
    } 
	public function get_selftasks1($status = null, $employee_id = null, $catte = null) {
		
		//$perm = $this->session->current->userdata;
			// echo'<pre>';
			// print_r($perm);

			// die('out');
		
        
              //  $this->db->where(array('tasks.status =' => 'completed'));
               // $this->db->where(array('tasks.status =' => 'completed'));
            
        
        if (isset($employee_id)) {
			
			$this->db->where('tasks.notify LIKE', '%'.$employee_id.'%');
           // $this->db->where(array('tasks.employee_id' => $employee_id));
        }
		if (isset($catte)) {
            $this->db->where(array('tasks.task_category_id' => $catte));
        }
		
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, task_type.code as tcode ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->join('task_type', 'task_type.id = tasks.taskcode', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
        return $result;
    } 
	public function get_emptasks($status = null, $employee_id = null, $catte = null,$did) {
		
		$perm = $this->session->current->userdata;
		// echo $did;
			// echo'<pre>';
			// print_r($perm);
			

		//	die('out');
		
        if (isset($status)) {
            if ($status == 'all') {
                $this->db->where(array('tasks.status !=' => 'completed'));
            } elseif($status == 'regular') {
                $this->db->where(array('tasks.task_regular' => 1));
            } else {
                $this->db->where(array('tasks.status' => $status));
            }
        }
        if (isset($employee_id)) {
           // $this->db->where(array('tasks.employee_id' => $employee_id));
            $this->db->where(array('tasks.related_department' => $did));
        }
		if (isset($catte)) {
            $this->db->where(array('tasks.task_category_id' => $catte));
        }
		
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, task_type.code as tcode ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->join('task_type', 'task_type.id = tasks.taskcode', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
		
        return $result;
    }

    public function get_attention_tasks($employee_id = null) {
        if (isset($employee_id)) {
            $this->db->where(array('tasks.employee_id' => $employee_id));
        }
        $this->db->where(array('tasks.task_attention ' => 'required', 'tasks.employee_id !=' => ''));
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();        return $result;
    }

    public function get_attention_updated_tasks($employee_id = null) {
        if (isset($employee_id)) {
            $this->db->where(array('tasks.employee_id' => $employee_id));
        }
        $this->db->where(array('tasks.task_attention ' => 'updated', 'tasks.employee_id !=' => ''));
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
        return $result;
    }

    public function get_completed_tasks($employee_id = null) {
        $this->db->where(array('tasks.process' => 100));
        if (isset($employee_id)) {
            $this->db->where(array('tasks.employee_id' => $employee_id));
        }
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
        return $result;
    }

    function get_task($task_id) {
        $this->db->where('task_id', $task_id);
        $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, CONCAT(employees.name," [",IFNULL(departments.department_name,"-"),"] ", IFNULL(positions.position_name,"-")) as employee_name', FALSE)
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT');
        $query = $this->db->get('tasks');
		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		 
        return $query->row_array();
    }
	
	 function get_taskd() {
       // $this->db->where('task_id', $task_id);
        $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name, CONCAT(employees.name," [",IFNULL(departments.department_name,"-"),"] ", IFNULL(positions.position_name,"-")) as employee_name', FALSE)
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT');
        $this->db->order_by('tasks.task_id','desc');
        $query = $this->db->get('tasks');
		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		 
        return $query->result_array();
    }
	////////////////////////**********************tsak_type******************
	 function task_log() {
       // $this->db->where('task_id', $task_id);
        $this->db
                ->select('*');
                
       $this->db->order_by('log_date','desc');
        $query = $this->db->get('task_log');
		// echo "<pre>";
		// print_r($query);
		// echo "</pre>";
		 
        return $query->result_array();
    }
	
		 
   
 function assign_task($data, $where){
		//echo'<pre>';print_r($where);echo'</pre>';die;
		
		// $employee = $this->input->post('employee_id');
		// $employee_id =	implode(" ",$employee);
        // $data['employee_id'] = $employee_id;
	 		
	 $this->db->update('tasks', $data, $where);
            $result = TRUE;
			
	/*		
			////email notify
			$eidd= $data['employee_id'];
		
		$resultemp = $this->employees_actions->get_taskemployee($eidd);
		$from_email1 = "uplus.hrms@peza.com.ph"; 
		$resemail=$resultemp['email'];
 			 $this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email1); 
         $this->email->to($resemail);
         $this->email->subject($subbb); 
         $this->email->message($msggg);
		 $this->email->send();
		// echo "<pre>";
		// print_R($Notify);
		// die("dsfas");
	
		if($Notify != ""){
			// echo "hjhjkj";
			// die("sdf");
			$cnt= 0;
		foreach($Notify as $Noti){
			//echo $Noti;
//echo $cnt;
			$this->load->model('employees_actions');
			$result = $this->employees_actions->get_employee($Noti);
         $from_email = "uplus.hrms@peza.com.ph"; 
         $to_email = $result['email'];
		 //echo $to_email;
		
		//die("fdhgxgf");
  // if($resemail!= $to_email)

			 //echo '...................else condiction';
			 $this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email); 
         $this->email->to($to_email);
         $this->email->subject($subbb); 
         $this->email->message($msggg);
		 $this->email->send(); */
 }
 
 
 
 
 
 
    function save_task() {
        $data = array(
            'task_title' => $this->input->post('task_title'),
            'status' => $this->input->post('task_status'),
            'task_attention' => $this->input->post('task_attention'),
            'task_regular' => $this->input->post('task_regular'),
            'task_category_id' => $this->input->post('task_category_id'),
            'related_department' => $this->input->post('workmanual_category_id'),
            'start_date' => $this->input->post('start_date'),
            'due_date' => $this->input->post('due_date'),
            'description' => $this->input->post('description'),
            'additional' => $this->input->post('additional'),
			'updated_date' => date('Y-m-d H:i:s')
        );

        $employee = $this->input->post('employee_id');
		
		$employee_id =	implode(" ",$employee);
        $data['employee_id'] = $employee_id;
		
		$subb = $this->input->post('task_title');
		$subbb = strip_tags($subb);
		$msgg = $this->input->post('description');
		$Notify = $this->input->post('Notify');
		    $msgggg = ($msgg);
			$ccc = 0;
		   // $msggg.="<span style='padding-bottom: 4px;color:#ff6600;font-weight:bold;width:100%;float:left;'>This task is assigned to employee as follow</span>";
			 //$msggg.="<p style='float:left;color:#ff6600;display:inline-block;width:15%;'>Person In Charge<br><br>Notified Person</p>"; 
			
			// print_r($Notify);
			// print_r($msggg);
			
			// die("hello");
				foreach($Notify  as $emp){
					
					 $employe = $this->employees_actions->get_employee($emp);
					

					if($ccc<2)
					{
						if($ccc==0)
						{
							$employeenam="<span style='color:#ff6600; font-weight:bold;'>Person in Charge:&nbsp;&nbsp;&nbsp;</span>  ".$employe['name'];
							
						}
						else{
					     $employeenam="<span style='color:blue;'>&nbsp;&nbsp;/&nbsp;&nbsp;</span>".$employe['name']."<br/>";
						}
						
					}
					else
					{
					    
				 
				             $employeenam="<span style='color:#ff6600; font-weight:bold;'>Notified To :</span>&nbsp;&nbsp;&nbsp;".'<span style="width:100%;margin-bottom: 5px;">'.$employe['name'].'</span>';
				            
					}
		                  
				 $msggg.=$employeenam;
				 
					$ccc++;
					
				}
//$msggg.="<span style='padding-top: 10px;float:left; width:100%;color: blue;font-weight:bold;'>***Task Detail***</span>";
			
			$msggg.='<p style="float:left; width:100%;Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px;text-align:justify;">'.$msgggg.'</p>';
			
		
		
		if($Notify != ""){
		$nnoty =	implode(" ",$Notify);
		
        $data['notify'] = $nnoty;
		
		}
        if ($this->input->post('task_id') == '0') {
            $this->db->insert('tasks', $data);
            $result = $task_id = $this->db->insert_id();
			
        } else {
            
            $this->db->update('tasks', $data, array('task_id' => $this->input->post('task_id')));
            $result = TRUE;
            $task_id = $this->input->post('task_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('task', $task_id)) {
            return FALSE;
        }
	 
		$eidd= $data['employee_id'];
		$details = $this->settings_actions->get_settings('company');
	 
	    $company_mail  = $details['company_email'];
		 $email=explode(",",$company_mail);
		// echo  $company_mail;
	     $len=count($email);
	 // print_r($company_mail);
	  //die();
	// print_r($email[0]);
	// die();
		$resultemp = $this->employees_actions->get_taskemployee($eidd);
		
	 
		
 		 $from_email1 = $email[0]; 
		 
		 /*  sender receive email start here    */
		 
		 for($i=0;$i<$len;$i++)
	    {
			
		   $this->load->helper(array('email'));
           $this->load->library(array('email'));
		   $this->email->set_mailtype("html");
           $this->email->from($email[$i]); 
           $this->email->to($email[$i]);
           $this->email->subject($subbb); 
           $this->email->message($msggg);
		   $this->email->send();
		 
	
		 
	    }
		 
		 
		 
		  /*   sender receive email end here       */
		 
 		 // $from_email1 = $company_mail; 
 		$resemail=$resultemp['email'];
		
		if($Notify != ""){
			
		foreach($Notify as $Noti){
		
			$this->load->model('employees_actions');
			$result = $this->employees_actions->get_employee($Noti);
         $from_email = $from_email1; 
         $to_email = $result['email'];
		
			  $this->load->helper(array('email'));
           $this->load->library(array('email'));

			 //$this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email); 
         $this->email->to($to_email);
         $this->email->subject($subbb); 
         $this->email->message($msggg);
		 $this->email->send();
	
		 }
}
		
		
	
	
        return array_merge($files, array('result' => $result));
    }

    function delete_task($task_id) {
        $this->db->delete('task_log', array('task_id' => $task_id));
        $this->db->delete('attachments', array('object' => $task_id, 'type' => 'task'));
        $this->db->delete('tasks', array('task_id' => $task_id));
    }

    function get_task_comments($task_id) {
        $this->db->where('task_id', $task_id);
        $this->db->order_by('log_date', 'desc');
        $this->db
                ->select('task_log.*, employees.name as comment_user, employees.avatar ')
                ->join('employees', 'employees.employee_id = task_log.from_employee', 'LEFT');
        $query = $this->db->get('task_log');
        return $query->result_array();
    }
    
    function get_task_comment($task_comment_id) {
        $this->db->where('id', $task_comment_id);
        $this->db->order_by('log_date', 'desc');
        $this->db
                ->select('task_log.*, employees.name as comment_user, employees.avatar ')
                ->join('employees', 'employees.employee_id = task_log.from_employee', 'LEFT');
        $query = $this->db->get('task_log');
        return $query->row_array();
    }

    function save_task_comment() {
		
		$msg = $this->input->post('comment');
		$Notie = $this->input->post('task_id');
		$msgg = $msg;
		$resulltt = $this->task_actions->get_task($Notie);
	$mail_id = $this->session->current->userdata('employee_id');
	
	$resulrt = $this->employees_actions->get_employee($mail_id);
	$emp_mailid = $resulrt['email'];
		$subjec = $resulltt['description'];
		 //print_r($subjec);
	
$mail_message = '<br>Task&nbsp;Description:'.$subjec .'<span class="asdf" style="color:red;">**************<b style="position: relative;top: -4px;">Reply</b>****************</span><br>Name: '.$this->session->current->userdata('name').'&nbsp;&nbsp;'. $emp_mailid.'<br>Comment: '.$msgg;
		
		

	    $subject= strip_tags($resulltt['task_title']);
		
		$notiy = $resulltt['notify'];
		$Notify = explode(" ",$notiy);
        
        $employee_id = $this->session->current->userdata('employee_id');
        if(!in_array($employee_id,$Notify)){
            $Notify[] = $employee_id;
        }

        $data = array(
            'comment' => $this->input->post('comment')
        );
        //print_r($this->session->current->userdata('name'));die;


        if ($this->input->post('task_comment_id') == '0') {
            $data['from_employee'] = $employee_id;
            $data['log_date'] = date('Y-m-d H:i:s');
            $data['task_id'] = $this->input->post('task_id');
            $this->db->insert('task_log', $data);
            $result = $task_comment_id = $this->db->insert_id();
        } else {
            $this->db->update('task_log', $data, array('id' => $this->input->post('task_comment_id')));
            $result = TRUE;
            $task_comment_id = $this->input->post('task_comment_id');
        }
		
		
		$details = $this->settings_actions->get_settings('company');
		$email=explode(",",$details);
$email_cop	= $details['company_email'];

 $emailw=explode(",",$email_cop);
	 // print_r($emailw[0]);
	 // die();
	 
	 
	
		foreach($Notify as $Noti){
		 $this->load->model('employees_actions');
		 $result = $this->employees_actions->get_employee($Noti);
         $from_email = $emailw[0]; 
         $to_email = $result['email'];
         $this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email); 
         $this->email->to($to_email);
         $this->email->subject('Re:'.$subject); 
         $this->email->message($mail_message); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
		} 
		

        $this->db->where('id', $task_comment_id);
        $this->db
                ->select('task_log.*, employees.name as comment_user, employees.avatar')
                ->join('employees', 'employees.employee_id = task_log.from_employee', 'LEFT');
        $query = $this->db->get('task_log');
        $task_comment = $query->row_array();

        return $task_comment;
    }
    
    function delete_comment($task_comment_id) {
        $this->db->delete('task_log', array('id' => $task_comment_id));
    }

    function update_task_process() {
        $task_process = array(
            'process' => $this->input->post('task_process'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        return $this->db->update('tasks', $task_process, array('task_id' => $this->input->post('task_id')));
    }
    
    function update_task_attention() {
        $task_attention = array(
            'task_attention' => $this->input->post('task_attention'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        return $this->db->update('tasks', $task_attention, array('task_id' => $this->input->post('task_id')));
    }
    
    function save_assignment() {
		
        $update_data = array();
        $data = array(
            'notify' => $this->input->post('employee_id'),
            'employee_id' => $this->input->post('employee_id'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        
        $task_ids = json_decode($this->input->post('task_ids'));
           
		
		   
		   
        foreach($task_ids as $key => $task_id) {
            $data['task_id'] = $task_id;
            array_push($update_data, $data);
     
       // _custom_debug($update_data);
        $this->db->update_batch('tasks', $update_data, 'task_id');
		
       
		
	 
	   $subbb =$this->task_actions->get_task($data['task_id']);
	  // echo"<pre>";
	$title	= $subbb['task_title'];
	$msg = $subbb['description'];
		//echo $msg;
	   
	   
			$Noti= $data['notify'];
			$this->load->model('settings_actions');
		$details = $this->settings_actions->get_settings('company');
	 
	    $company_mail  = $details['company_email'];
			$this->load->model('employees_actions');
			$resultemp = $this->employees_actions->get_employee($Noti);
		// = $this->employees_actions->get_taskemployee($eidd);
		// echo"<pre>";
		// print_r($resultemp );
		// echo"</pre>";
 		//$from_email1 = $company_mail; 
 		//$resemail=$resultemp['email'];
		
		
		
		
	 $from_email = $company_mail ; 
         $to_email = $resultemp['email'];
		 $subject= $title;
         $this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email); 
         $this->email->to($to_email);
         $this->email->subject('Re-assigned Task:'.$subject); 
         $this->email->message('<b>Task Description:</b><br>'.$msg); 
   
         //Send mail 
         $this->email->send();	
		 return TRUE;
		}
		
		
		
		
			
	
		
		
		
			//$result = $this->employees_actions->get_employee($Noti);
         // $from_email = $company_mail; 
         // $to_email = $resemail;
		
			  // $this->load->helper(array('email'));
           // $this->load->library(array('email'));
    // $this->email->set_mailtype("html");
         // $this->email->from($from_email); 
         // $this->email->to($to_email);
         // $this->email->subject($subbb); 
         // $this->email->message($msggg);
		 // $this->email->send();
	
	
	
	}
	function save_codeassignment() {
		
		$update_data = array();
        $data = array(
            'taskcode' => $this->input->post('taskcod'),
			'updated_date' => date('Y-m-d H:i:s')
        );
        
        $task_ids = json_decode($this->input->post('task_ids'));
        
        foreach($task_ids as $key => $task_id) {
            $data['task_id'] = $task_id;
            array_push($update_data, $data);
        }
        $this->db->update_batch('tasks', $update_data, 'task_id');
        return TRUE;
    }
    
    function get_employee_tasks($employee_id, $type) {
        switch ($type) {
            case 'all':
                $this->db->where(array('tasks.status !=' => 'completed'));
                break;
            case 'regular':
                $this->db->where(array('tasks.task_regular' => 1));
                break;
            case 'attention':
                $this->db->where(array('tasks.task_attention ' => 'required'));
                break;
            case 'attention_update':
                $this->db->where(array('tasks.task_attention ' => 'updated'));
                break;
            default:
                $this->db->where(array('tasks.status' => $type));
                break;
        }
        
        if (isset($employee_id)) {
            $this->db->where(array('tasks.employee_id' => $employee_id));
        }
        $this->db->order_by('updated_date','desc');
        $query = $this->db
                ->select('tasks.*, employees.name as task_responsible, task_category.task_category_name ')
                ->join('employees', 'employees.employee_id = tasks.employee_id', 'LEFT')
                ->join('task_category', 'task_category.task_category_id = tasks.task_category_id', 'LEFT')
                ->get('tasks');
        //die($this->db->last_query());
        $result = $query->result_array();
        return $result;
    }

}


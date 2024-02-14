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
class Employees_actions extends Base_model {

    private $photo = FALSE;
    private $sign = FALSE;
    function get_employees($page_id,$is_active = TRUE) {
		
        if(!$is_active) {
            $this->db->where('users.is_active',0);
            $this->db->where('users.user_name!=','k09178548787@gmail.com');
        } else {
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
        }
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , employees.internal_id_no,positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.name !=', '')
               
                //->order_by('users.is_active',1)
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
      
        }
        $employees = $this->db->get('employees')->result_array();
	
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
			$stdate= date("Y-m-d");
			 $q1= $this->db->select('*')
                    ->where('employee_id',$employee['employee_id'])
                    ->like('start_time', $stdate)
                    ->order_by('record_id', 'desc')
                    ->limit(1)->get('punch_clock');
            $punchclock = $q1->result_array();

			 $employee['punchclock'] = $punchclock;
			  $employees[$key] = $employee;
        }
		
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }
	function get_employees_filter($page_id,$type ,$is_active) {
		// echo $type;
		// die("here");
		
        if($is_active==0) {
            $this->db->where('users.is_active',0);
            $this->db->where('users.user_name!=','k09178548787@gmail.com');
             $this->db->where('employees.is_regular=',$type);
        } else {
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
            $this->db->where('employees.is_regular=',$type);
        }
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.name !=', '')
               
                //->order_by('users.is_active',1)
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
      
        }
        $employees = $this->db->get('employees')->result_array();
	
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
			$stdate= date("Y-m-d");
			 $q1= $this->db->select('*')
                    ->where('employee_id',$employee['employee_id'])
                    ->like('start_time', $stdate)
                    ->order_by('record_id', 'desc')
                    ->limit(1)->get('punch_clock');
            $punchclock = $q1->result_array();

			 $employee['punchclock'] = $punchclock;
			  $employees[$key] = $employee;
        }
		
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
		// echo "<pre>";
		// print_r($result);
		// die('hiiii');

        return $result;
    }
	function get_employeesd_filter($page_id,$type ,$is_active) {
		// echo $type;
		// die("here");
		
        if($is_active==0) {
            $this->db->where('users.is_active',0);
            $this->db->where('users.user_name!=','k09178548787@gmail.com');
             $this->db->where('employees.department_id=',$type);
        } else {
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
            $this->db->where('employees.department_id=',$type);
        }
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.name !=', '')
               
                //->order_by('users.is_active',1)
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
      
        }
        $employees = $this->db->get('employees')->result_array();
	
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
			$stdate= date("Y-m-d");
			 $q1= $this->db->select('*')
                    ->where('employee_id',$employee['employee_id'])
                    ->like('start_time', $stdate)
                    ->order_by('record_id', 'desc')
                    ->limit(1)->get('punch_clock');
            $punchclock = $q1->result_array();

			 $employee['punchclock'] = $punchclock;
			  $employees[$key] = $employee;
        }
		
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
		// echo "<pre>";
		// print_r($result);
		// die('hiiii');

        return $result;
    }
	function get_employeesg_filter($page_id,$type ,$is_active) {
		// echo $type;
		// die("here");
		
        if($is_active==0) {
            $this->db->where('users.is_active',0);
            $this->db->where('users.user_name!=','k09178548787@gmail.com');
             $this->db->where('employees.group_id=',$type);
        } else {
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
            $this->db->where('employees.group_id=',$type);
        }
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.name !=', '')
               
                //->order_by('users.is_active',1)
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
      
        }
        $employees = $this->db->get('employees')->result_array();
	
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
			$stdate= date("Y-m-d");
			 $q1= $this->db->select('*')
                    ->where('employee_id',$employee['employee_id'])
                    ->like('start_time', $stdate)
                    ->order_by('record_id', 'desc')
                    ->limit(1)->get('punch_clock');
            $punchclock = $q1->result_array();

			 $employee['punchclock'] = $punchclock;
			  $employees[$key] = $employee;
        }
		
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
		// echo "<pre>";
		// print_r($result);
		// die('hiiii');

        return $result;
    }
	function get_employeesstatus_filter($page_id,$type ,$is_active) {
		// echo $type;
		// die("here");
		
        if($is_active==0) {
            $this->db->where('users.is_active',0);
            $this->db->where('users.user_name!=','k09178548787@gmail.com');
             $this->db->where('employees.status=',$type);
        } else {
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
            $this->db->where('employees.status',$type);
        }
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                ->join('employee_list', 'employee_list.id = employees.status', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.name !=', '')
               
                //->order_by('users.is_active',1)
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
      
        }
        $employees = $this->db->get('employees')->result_array();
	
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
			$stdate= date("Y-m-d");
			 $q1= $this->db->select('*')
                    ->where('employee_id',$employee['employee_id'])
                    ->like('start_time', $stdate)
                    ->order_by('record_id', 'desc')
                    ->limit(1)->get('punch_clock');
            $punchclock = $q1->result_array();

			 $employee['punchclock'] = $punchclock;
			  $employees[$key] = $employee;
        }
		
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
		// echo "<pre>";
		// print_r($result);
		// die('hiiii');

        return $result;
    }
	
	 function get_employeesbirthday() {
		
        
            $this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
      
        $this->db
                ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
				///->join('timeoff','timeoff.employee_id = employees.employee_id','LEFT')
			
                ->where('employees.birth_date =', 'NOW()');
               
                //->order_by('users.is_active',1)
                //->from('employees')
               // ->limit(30, ($page_id - 1) * 30);

        
        $employees = $this->db->get('employees')->result_array();
	
        // foreach($employees as $key => $employee) {
            // $q = $this->db->select('contract_expiry')
                    // ->where('employee_id',$employee['employee_id'])
                    // ->order_by('contract_id', 'desc')
                    // ->limit(1)->get('employees_contract');
            // $curr_contract = $q->row_array();
            // $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            // $employees[$key] = $employee;
			// $stdate= date("Y-m-d");
			 // $q1= $this->db->select('*')
                    // ->where('employee_id',$employee['employee_id'])
                    // ->like('start_time', $stdate)
                    // ->order_by('record_id', 'desc')
                    // ->limit(1)->get('punch_clock');
            // $punchclock = $q1->result_array();

			 // $employee['punchclock'] = $punchclock;
			  // $employees[$key] = $employee;
        // }
		
        $result['data'] = $employees;
        
        

        // $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        // $result['amount'] = $amount['amount'];

			echo "<pre>";
			print_r($employees);
			die("here");
        return $result;
    }
	//import csv **
 function importdata($data){
	 

	$res = $this->db->insert_batch('employees',$data);
	 // echo "<pre>";
	 // print_r($res); 
	 // die("here");
	  // $this->db->insert('employees', $data);

        // echo      $employee_id = $this->db->insert_id();
			

          // $res=  $this->db->insert('users', array(
                // 'user_name' => $data['email'],
                // 'is_active' => 1,
                // 'employee_id' => $employee_id,
                // 'permissions' => 'a:0:{}'
            // ));
		
        if($res){
            return $res;
        }else{
            return FALSE;
        }
	 
 }
 function importuser_data($data){
	 

	$res = $this->db->insert_batch('users',$data);
	 
		
        if($res){
            return $res;
        }else{
            return FALSE;
        }
	 
 }
 //**Export csv
 
 function export_data(){

 
 
 $this->db->select('employees.employee_id, employees.name, employees.avatar,employees.sign, employees.status,employees.employee_no,employees.nick_name,employees.ssn,employees.tin,employees.employee_pag_ibigno,employees.employee_status_note ,employees.birth_date,employees.employee_relation,employees.employee_contactperson,employees.employee_address, ,employees.contactno,employees.email,employees.pin');
        $this->db->from('employees');
        $query = $this->db->get();
        return $result[] = $query->result();
  	
 }
	
	
	 function get_employeesss($page_id,$is_active = TRUE) {
		// echo'<pre>'; 
		// print_r($page_id);
		// echo'</pre>';
        if(!$is_active) {
            $this->db->where('users.is_active',0);
        } else {
            $this->db->where('users.is_active',1);
        }
        $this->db
               ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , employees.internal_id_no,positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                //->where('employees.name !=', '')
                ->order_by('employees.name')
                //->from('employees')
                ->limit(30, ($page_id - 1) * 30);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{

        }
        $employees = $this->db->get('employees')->result_array();
		
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }
	
	function get_employesipp() {
		
            $this->db->where('users.is_active',1);
           //ss $this->db->where(' employees.employee_id',$id);
        
				$this->db
                ->select('SQL_CALC_FOUND_ROWS employees.employee_id, employees.name, employees.avatar, ,employees.sign, employees.status, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,users.user_ip as user_ip', FALSE)
                //->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                //->where('employees.name !=', '')
                ->order_by('employees.name');
                //->from('employees')
                

        
        $employees = $this->db->get('employees')->result_array();
		// echo'<pre>';
		// print_r($employees);
		// echo'<pre>';
		// die('vrf');
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }	function get_employeip($id) {
		// echo'<pre>';
		// print_r($page_id);
		// echo'</pre>';
        
            $this->db->where('users.is_active',1);
            $this->db->where(' employees.employee_id',$id);
        
				$this->db
                ->select('SQL_CALC_FOUND_ROWS employees.employee_id, employees.name, employees.avatar, , employees.sign, employees.status, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,users.user_ip as user_ip', FALSE)
                //->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                //->where('employees.name !=', '')
                ->order_by('employees.name');
                //->from('employees')
                

        
        $employees = $this->db->get('employees')->result_array();
		// echo'<pre>';
		// print_r($employees);
		// echo'<pre>';
		// die('vrf');
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }
	
	
	
	
	/********************/
	
	
	
	function get_employeesssf($page_id,$is_active = TRUE) {
		// echo'<pre>';
		// print_r($id);
		// echo'</pre>';
		 $id= $_GET['xy'];
        if(!$is_active) {
            $this->db->where('users.is_active',0);
        } else {
            $this->db->where('users.is_active',1);
        }
		
		
        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
            $this->db
                    ->where('status', $id);
                  
        }
    $this->db
               ->select('employees.employee_id, employees.name, employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , employees.internal_id_no,positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                //->where('employees.name !=', '')
                ->order_by('employees.name')
                 //->from('employees')
              ->limit(30, ($page_id - 1) * 30);

				
				
        $employees = $this->db->get('employees')->result_array();
		// echo'<pre>';
		// print_r($employees);
		// echo'<pre>';
		// die('vrf');
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
		
		
		
		
    }
	
	/////////////////////////////////// for timeoff employeee 
	
	
	function get_empl() {
		
		$status=array('approved','denied');
		
		$empleave =$this->db
                      ->select('employee_id')
                      ->where('record_id',$record_id)
                      ->where_in('status',$status)
                      ->get('timeoff')
                      ->result_array();
				// echo "<pre>";
// print_r($empleave);	
$empda=array();
foreach($empleave as $empl)
{
	$empdata[]= $empl['employee_id'];
}			

$edata= array_unique($empdata);
 
		 $query = $this->db
                ->select('employees.*')
              
                ->where('employees.status', $edata)
                
                ->get('employees');
//         die($this->db->last_query());
        return $query->result_array();
      //return false;
   }
		
  function get_active_employee(){
	  
	  
	$query= $this->db
                ->select('employees.name')
              
                 ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                 ->where('users.is_active', 1)
                ->get('employees');
//         die($this->db->last_query());
        return $query->result_array();
	
  }  
	
	/////////////////////////////////// for timeoff employeee end
	
	public function pinemp($employee_id) {
		 $query = $this->db
                ->select('employees.*,users.is_active,employees_contract.contract_expiry,users.user_ip as user_ip')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                ->join('employees_contract', 'employees.employee_id = employees_contract.employee_id', 'LEFT')
                ->where('employees.employee_id', $employee_id)
                 ->get('employees');
//         die($this->db->last_query());
        return $query->row_array();
    }
	
	public function update_pro() {
		$empl_pro =$_GET['pro'];
	$date = date('Y-m-d');

	if ($this->db->update('employees', array('profile_up' => 1, 'confirm_date_pp'=> $date) , array('employee_id' => $empl_pro)) ) {
	   echo"Confirmed Successfully";
        }
        return FALSE;
    }
	public function update_sign() {
				  $empl_sign =$_GET['sign'];
	$date = date('d-m-Y');
 if ($this->db->update('employees', array('sign_up' => 1, 'confirm_date_si'=> $date) , array('employee_id' => $empl_sign)) ) {
            return true;
        }
        return FALSE;
    }
	public function unpin() {
		$employee_id =$_GET['id'];
        if ($this->db->update('employees', array('pin' => 1) , array('employee_id' => $employee_id)) ) {
            return true;
        }
        return FALSE;
    }
	
	public function allpin() {
 $pin_employee =$_GET['pin'];

	$query =('SELECT * FROM employees where pin="1"');
      
        return $query->result_array();
    // echo $result;
   }
		
	
	/********************/
	
	
	
	function get_employees_active(){
		
			
		return	$this->db->where('is_active', '1');
			$q = $this->db->get('users');
			$q->result_array();
		
	}
	function get_employees_inactive(){
		
		return	$this->db->where('is_active', '0');
			$q = $this->db->get('users');
			 $q->result_array();
		

	}
	
	function get_emp_emailpass($emp_id){
	
	$ar=explode(",",$emp_id);
	$str[]="";
	
	foreach($ar as $x)
	{
		
		
// $this->db->where_in('id', $ids);
		
	$q = $this->db->select('*')->from('users')->where('employee_id',$x)->get();
    $str[]=$q->result();
	
	}
	
	return $str;
	}
	
	//**copy image path 
	
	function image_path_copy($emp_id){
	
	$arp=explode(",",$emp_id);
	$stre[]="";
	
	foreach($arp as $x)
	{
		
		
// $this->db->where_in('id', $ids);
		
	$q = $this->db->select('*')->from('employees')->where('employee_id',$x)->get();
    $stre[]=$q->result();
	
	}
	$empiddd=$this->input->get('allvalue', TRUE); 
	if($empiddd){
		
		$q = $this->db->select('*')->from('employees')->get();
    $stre[]=$q->result();
		
	}
 return $stre;
	}
	function get_emp_img_path($path){
		$empid=$this->input->get('empi');
		$empidn=rtrim($empid,",");
		$empidd = explode(",",$empidn);
		
	   $length=count($empidd);
		
		$newarraynama=rtrim($path,",");
	  $coypath = explode(",",$newarraynama);
	for ($i = 0; $i < $length; $i++) {
		 if($this->db->update('employees', array('copy_image_path' => $coypath[$i]) , array('employee_id' => $empidd[$i])) ) {
           }
		}
		redirect('http://uplushrms.peza.com.ph/request/processcallingcard');	
	}
	
	function get_emp_img_path2($path,$paths,$iddd){
		
		$empidn=rtrim($iddd,",");
		$empidd = explode(",",$empidn);
		
	   $length=count($empidd);
		
		$newarraynama=rtrim($path,",");
		$newarraynamas=rtrim($paths,",");
		$coypath = explode(",",$newarraynama);
		$coypaths = explode(",",$newarraynamas);
		// print_R($coypath);
		// echo"<br>";
		// print_R($coypaths);
		// echo"<br>";
		// print_R($empidd);
		// die();
	$length1=count($coypath);
		
	  
	for ($i = 0; $i < $length; $i++) {
		 if($this->db->update('employees', array('copy_image_path' => $coypath[$i],'copy_sig_path' => $coypaths[$i]),  array('employee_id' => $empidd[$i])) ) {
          
		// echo $empidd[$i];
        }	}
	redirect('http://uplushrms.peza.com.ph/request/processcallingcard');
	}
//***copy signature path function
	
		
	function signature_all($path,$iddd){
		
		$empidn=rtrim($iddd,",");
		$empidd = explode(",",$empidn);
		
	   $length=count($empidd);
		
		$newarraynama=rtrim($path,",");
		$coypath = explode(",",$newarraynama);
	$length1=count($coypath);
		
	  
	for ($i = 0; $i < $length; $i++) {
		 if($this->db->update('employees', array('copy_sig_path' => $coypath[$i]) , array('employee_id' => $empidd[$i])) ) {
          
		// echo $empidd[$i];
        }	}
	redirect('http://uplushrms.peza.com.ph/request/processcallingcard');
	}
	
	
	
	
	function getpunchintime($eid){
		
		
		$this->db->where('employee_id', $eid);
			$this->db->limit(1);
			$this->db->order('DESC');
			$q = $this->db->get('punch_clock');
		return	 $q->result_array();
		

	}
	
	function admin_info() {
		$this->db->where('employee_id', 1);
		$query = $this->db->get('employees');		 
		return ($data == 'object') ? $query->row() : $query->row_array();	    
	}
	

    function search_employee() {
		
		return $this->db
                        ->select('employees.employee_id as id, CONCAT(name," [",IFNULL(department_name,"-"),"] ") as name,email', FALSE)
                        ->join('employees_positions', 'employees_positions.employee_id = employees.employee_id AND is_current=1', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                        ->where('users.is_active', 1)
                        ->where('employees.name !=', '')
                       
                        ->like('name', $this->input->post('query'), 'both')
                        ->order_by('name')
                       // ->limit(30)
                        ->get('employees')
                        ->result_array();
    }
	
	 function search_employee1() {
		
		$userdat=$this->session->current->userdata('employee_id');
		return $this->db
                        ->select('employees.employee_id as id, CONCAT(name," [",IFNULL(department_name,"-"),"] ") as name,email', FALSE)
                        ->join('employees_positions', 'employees_positions.employee_id = employees.employee_id AND is_current=1', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                        ->where('users.is_active', 1)
                        ->where('employees.name !=', '')
						 ->where('employees.employee_id',$userdat)
                        ->like('name', $this->input->post('query'), 'both')
                        ->order_by('name')
                       // ->limit(30)
                        ->get('employees')
                        ->result_array();
    }
	
	function search_category() {
        return $this->db
                        ->select('task_category_id,task_category_name', FALSE)
                        ->get('task_category')
                        ->result_array();
    }
	
	 public function total_count() {
       return $this->db->count_all("employees");
    }
	
	public function total_activcount() {
		
		
      
		 $query = "SELECT employees.employee_id,users.is_active FROM employees INNER JOIN users ON employees.employee_id = users.employee_id
   WHERE users.is_active='1' AND users.user_name!='k09178548787@gmail.com'";
                
               
		$query = $this->db->query($query);
				return $query->num_rows();
	
    }
		public function total_inactivcount() {
		
		 $query = "SELECT employees.employee_id,users.is_active FROM employees INNER JOIN users ON employees.employee_id = users.employee_id
   WHERE users.is_active='0' AND users.user_name!='k09178548787@gmail.com'";
		$query = $this->db->query($query);
				return $query->num_rows();
	
    }
	
	public function total_inactivcount1() {
	
		$id= $_GET['xy'];
		
$query = $this->db->query("SELECT * FROM employees where  status = $id");
				return $query->num_rows();
	
    }
////////task count /////

public function total_tasks() {
	
	$query = $this->db->query("SELECT * FROM `tasks` where `process`< 100 AND status !='completed'");
				return $query->result_array();
	
	
	
    }
    function work_evaluation(){
		$date = date('Y-m-d', strtotime('today - 30 days'));
		$query = $this->db->query("SELECT * FROM evaluations where date between '$date' and curdate()");
				return $query->result_array();
		
		
		
	}	
	
	
	public function leave_rec($status=array('approved','denied')) {
            $date = date('Y-m-d', strtotime('today - 30 days'));
			
	$query = $this->db->query("SELECT * FROM timeoff where register_date between '$date' and curdate()  AND status = 'approved' || status = 'denied'");
				return $query->result_array();
	

      }
	function  disciplinary_action(){
		
		  $date = date('Y-m-d', strtotime('today - 30 days'));
		
		$query = $this->db->query("SELECT * FROM discipline where date between '$date' and curdate()");
				return $query->result_array();
		
		
	}
	  
	  function disp_rec(){
		  
		  $query = $this->db->query('SELECT * FROM discipline');
				return $query->result_array();
	  
					  }

	
	
	
	
	
	
    public function get_users($limit, $start) {
		
      $this->db->limit($limit, $start);
      $query = $this->db->get("employees");
      if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return false;
   }
	
	

    function get_employee($employee_id) {
        $query = $this->db
                ->select('employees.*,users.is_active,employees_contract.contract_expiry,users.user_ip as user_ip')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                ->join('employees_contract', 'employees.employee_id = employees_contract.employee_id', 'LEFT')
                ->where('employees.employee_id', $employee_id)
                ->order_by('contract_id', 'desc')
                ->get('employees');
//         die($this->db->last_query());
        return $query->row_array();
    } 
	
function get_employeess($is_active = TRUE) {
	
   $pin_employee =$_GET['checkval'];

        if(!$is_active) {
            $this->db->where('users.is_active',0);
			 $this->db->where('users.user_name!=','k09178548787@gmail.com');
        } else {
            $this->db->where('users.is_active',1);
			 $this->db->where('users.user_name!=','k09178548787@gmail.com');
        }
		 if($pin_employee){
			
        
		$this->db
                ->select('SQL_CALC_FOUND_ROWS employees.employee_id, employees.name, employees.avatar,employees.sign, employees.status,employees.employee_no,employees.nick_name,employees.ssn,employees.copy_avatar,employees.copy_sign,employees.tin,
				employees.Pag_Ibig_No,employees.employee_status_note ,employees.birth_date,employees.hired_date,employees.employee_relation,employees.employee_contactperson,employees.confirm_date_pp,employees.employee_address, ,employees.contactno,employees.email,employees.pin,employees.copy_image_path,employees.copy_sig_path,employees.healthno,positions.position_name,users.is_active,departments.department_name,grouplist.group_name,users.user_ip as user_ip', FALSE)
            
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                ->where('employees.pin =', '1')
                ->order_by('employees.name');
                //->from('employees')
            // ->limit(30, 1);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
            // $this->db
                    // ->where('is_active', '0')
                    // ->or_where('status', 'Resigned')
                    // ->or_where('status', 'Terminated')
                    // ->or_where('status', 'Contract_finished');
        }
        $employees = $this->db->get('employees')->result_array();
		// echo'<pre>';
		// print_r($employees);
		// echo'<pre>';
		// die('vrf');
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }
     else {
		

		
		$this->db
                ->select('SQL_CALC_FOUND_ROWS employees.employee_id, employees.name, employees.avatar,employees.sign, employees.status,employees.employee_no,employees.nick_name,employees.ssn,employees.copy_avatar,employees.copy_sign,employees.tin,
				employees.Pag_Ibig_No,employees.employee_status_note ,employees.birth_date,employees.hired_date,employees.employee_relation,employees.employee_contactperson,employees.confirm_date_pp,employees.employee_address, ,employees.contactno,employees.email,employees.pin,employees.copy_image_path,employees.copy_sig_path,employees.healthno,positions.position_name,users.is_active,departments.department_name,grouplist.group_name,users.user_ip as user_ip', FALSE)
            
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
               // ->where('employees.pin =', '1')
                ->order_by('employees.name');
                //->from('employees');
              // ->limit(100, 1);

        if ($this->input->get('search')) 
		{
                    $this->db->like('name', $this->input->get('search'));
                    $this->db->or_like('positions.position_name', $this->input->get('search'));
                    $this->db->or_like('departments.department_name', $this->input->get('search'));
        } 
		else 
		{
			
            // $this->db
                    // ->where('is_active', '0')
                    // ->or_where('status', 'Resigned')
                    // ->or_where('status', 'Terminated')
                    // ->or_where('status', 'Contract_finished');
        }
        $employees = $this->db->get('employees')->result_array();
		// echo'<pre>';
		// print_r($employees);
		// echo'<pre>';
		// die('vrf');
        foreach($employees as $key => $employee) {
            $q = $this->db->select('contract_expiry')
                    ->where('employee_id',$employee['employee_id'])
                    ->order_by('contract_id', 'desc')
                    ->limit(1)->get('employees_contract');
            $curr_contract = $q->row_array();
            $employee['contract_expiry'] = $curr_contract['contract_expiry'];
            $employees[$key] = $employee;
        }
        $result['data'] = $employees;
        
        

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
// echo "<pre>";
// print_r($result);
//echo $str = $this->db->last_query();
        return $result;
    }
}

	
function get_taskemployee($employee_id) {
		//echo $employee_id;
        $query = $this->db
                ->select('employees.*')
                
                ->where('employees.employee_id', $employee_id)
              
                ->get('employees');
				$res =$query->row_array();
				// echo "<pre>";
				// print_R($res);
        // die($this->db->last_query());
        return $res;
    }

    function check_email() {
        $result = $this->db
                        ->select('employee_id')
                        ->where('email', $this->input->post('employee_email'))
                        ->where('employee_id <> ', $this->input->post('employee_id'))
                        ->get('employees')
                        ->num_rows() > 0;
        if ($result) {
            $this->set_error($this->lang->line('Email is currently used'));
            return FALSE;
        }

        return TRUE;
    }

    private function upload_avatar($self_service = FALSE) {
        if (isset($_FILES['employee_avatar']) AND ( $_FILES['employee_avatar']['error'] == 0)) {
            $this->load->library('upload', array('upload_path' => BASEPATH . '../files/avatars/', 'allowed_types' => 'gif|jpg|jpeg|png', 'max_size' => '300', 'encrypt_name' => TRUE));

            if (!$this->upload->do_upload('employee_avatar')) {
                $this->set_error($this->upload->display_errors());
                return FALSE;
            }

            $this->load->library('image_lib', array('image_library' => 'gd2', 'source_image' => $this->upload->upload_path . $this->upload->file_name, 'maintain_ratio' => FALSE, 'width' => 140, 'height' => 140, 'master_dim' => 'height'));

            if (!$this->image_lib->resize()) {
                $this->set_error($this->image_lib->display_errors());
                return FALSE;
            }

            $this->photo = 'files/avatars/' . $this->upload->file_name;
            if ($self_service) {
                $this->session->set_userdata(array('avatar' => $this->photo));
            }
        }

        return TRUE;
    }
	
	
	private function upload_sign($self_service = FALSE) {
        if (isset($_FILES['signimag_1']) AND ( $_FILES['signimag_1']['error'] == 0)) {
            $this->load->library('upload', array('upload_path' => BASEPATH . '../files/sign/', 'allowed_types' => 'gif|jpg|jpeg|png', 'max_size' => '300', 'encrypt_name' => TRUE));

            if (!$this->upload->do_upload('signimag_1')) {
                $this->set_error($this->upload->display_errors());
                return FALSE;
            }

            $this->load->library('image_lib', array('image_library' => 'gd2', 'source_image' => $this->upload->upload_path . $this->upload->file_name, 'maintain_ratio' => FALSE, 'width' => 140, 'height' => 140, 'master_dim' => 'height'));

            if (!$this->image_lib->resize()) {
                $this->set_error($this->image_lib->display_errors());
                return FALSE;
            }

            $this->sign = 'files/sign/' . $this->upload->file_name;
            if ($self_service) {
                $this->session->set_userdata(array('sign' => $this->sign));
            }
        }

        return TRUE;
    }


    function save_employee() {
        if ((!$this->check_email()) OR ( !$this->upload_avatar())) {
            return FALSE;
        }
	// echo "<pre>";
	// print_r($_POST);
	// die("here");
	$is_regular=$this->input->post('is_regular');
	if($is_regular=='')
	{
		$regu=0;
	}
	else
	{
		$regu =1;
	}

        $data = array(
            'name' => $this->input->post('employee_name'),
            'nick_name' => $this->input->post('nick_name'),
            'hired_date' => $this->input->post('hired_date'),
            'Pag_Ibig_No' => $this->input->post('Pag_Ibig_No'),
            'employee_relation' => $this->input->post('employee_relation'),
            'employee_contactperson' => $this->input->post('employee_contactperson'),
            'employee_address' => $this->input->post('employee_address'),
            'ssn' => $this->input->post('employee_ssn'),
            'tin' => $this->input->post('employee_tin'),
            'healthno' => $this->input->post('employee_healthno'),
            'contactno' => $this->input->post('employee_contactno'),
            'email' => $this->input->post('employee_email'),
            'employee_no' => $this->input->post('employee_no'),
            'gender' => ($this->input->post('employee_gender') == 'male') ? 'male' : 'female',
			'petteycashliquidate'=>$this->input->post('petteycashliquidate'),
			'late_time'=>$this->input->post('late_time'),
			'status'=>$this->input->post('employee_memo'),
			'internal_id_no'=>$this->input->post('internal_id_no'),
			'is_regular'=>$regu,
            'birth_date' => ($this->input->post('birth_date')) ? date('Y-m-d', strtotime($this->input->post('birth_date'))) : NULL
        );

        if ($this->photo) {
            $data['avatar'] = $this->photo;
			
        }
		
		if ($this->sign) {
            
			$data['sign'] = $this->sign;
        }
		
		// echo "<pre>";
		// print_R($data);
		
		

        if ($this->input->post('employee_id') == '0') {
			
            $this->db->insert('employees', $data);

           echo   $employee_id = $this->db->insert_id();
			

            $this->db->insert('users', array(
                'user_name' => $this->input->post('employee_email'),
                'is_active' => 1,
                'employee_id' => $employee_id,
                'permissions' => 'a:0:{}'
            ));

            return $employee_id;
        }
		
		// echo "<pre>";
// print_r($data);

// echo $this->input->post('employee_id');
// die("heere");
    
        $this->db->update('employees', $data, array('employee_id' => $this->input->post('employee_id')));
	
        $this->db->update('users', array('user_name' => $this->input->post('employee_email')), array('employee_id' => $this->input->post('employee_id')));
//die($this->db->last_query());
        return TRUE;
    
	}
    function get_avatar() {
        return $this->photo;
    }
	
	function get_sign() {
        return $this->sign;
    }

    function save_address() {
        $this->db->update('employees', array(
            'address' => $this->input->post('employee_address'),
            'city' => $this->input->post('employee_city'),
            'state' => $this->input->post('employee_state'),
            'zip_code' => $this->input->post('employee_zip'),
            'phone' => $this->input->post('employee_phone'),
            'cell_phone' => $this->input->post('employee_cell_phone'),
            'contacts' => $this->input->post('contacts')
                ), array(
            'employee_id' => $this->input->post('employee_id')
        ));
    }

    function save_department() {
        $this->db->update('employees', array(
            'department_id' => $this->input->post('department_id'),
                ), array(
            'employee_id' => $this->input->post('employee_id')
        ));
    }
 function save_department1() {
	 $id =$this->input->get('empl');
	 $department =$this->input->get('department');
	   
        $this->db->update('employees', array(
            'department_id' => $department,
                ), array(
            'employee_id' => $id
        ));
    }	

	function update_status($emp_id,$status){
		
		 $this->db->update('employees', array(
            'status' => $status,
                ), array(
            'employee_id' => $id
        ));
		
		}
	

    function save_position() {
        $this->db->update('employees', array(
            'position_id' => $this->input->post('position_id'),
                ), array(
            'employee_id' => $this->input->post('employee_id')
        ));
    }
	function save_group() {
        $this->db->update('employees', array(
            'group_id' => $this->input->post('group_id'),
                ), array(
            'employee_id' => $this->input->post('employee_id')
        ));
    }

    /**
     * Education
     * 
     */
    function get_education($employee_id) {
        return $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->order_by('start', 'DESC')
                        ->get('employees_education')
                        ->result_array();
    }

    function get_education_item($education_item) {
        return $this->db
                        ->select('*')
                        ->where('id', $education_item)
                        ->get('employees_education')
                        ->row_array();
    }

    function save_education() {
        if (($this->input->post('start') AND ! strtotime($this->input->post('start'))) OR ( $this->input->post('end') AND ! strtotime($this->input->post('end')))) {
            $this->set_error($this->lang->line('Check dates'));
            return FALSE;
        }

        $data = array(
            'start' => ($this->input->post('start')) ? date('Y-m-d', strtotime($this->input->post('start'))) : NULL,
            'end' => ($this->input->post('end')) ? date('Y-m-d', strtotime($this->input->post('end'))) : NULL,
            'institution' => $this->input->post('institution_name'),
            'description' => $this->input->post('description')
        );

        if ($this->user_actions->is_allowed('employees')) {
            $data['is_verified'] = 1;
        }

        if ($this->input->post('education_id') == '0') {
            $data['employee_id'] = $this->input->post('employee_id');
            $this->db->insert('employees_education', $data);
            $result = $education_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_education', $data, array('id' => $this->input->post('education_id'), 'employee_id' => $this->input->post('employee_id')));
            $result = TRUE;
            $education_id = $this->input->post('education_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('education', $education_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_education($education_id) {
        $this->db->delete('employees_education', array('id' => $education_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('education', $education_id);
    }

    /**
     * Positions
     */
    function get_positions($employee_id) {
        return $this->db
                        ->select('id,is_current,start,end,position_name,IFNULL(department_name,"-") as department_name', FALSE)
                        ->join('positions', 'positions.position_id = employees_positions.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = positions.department_id', 'LEFT')
                        ->where('employee_id', $employee_id)
                        ->order_by('start', 'DESC')
                        ->get('employees_positions')
                        ->result_array();
    }

    function get_position($position_id) {
        return $this->db
                        ->select('id,is_current,start,end,position_name,add_responsibilities,move_reason,responsibilities')
                        ->join('positions', 'positions.position_id = employees_positions.position_id', 'LEFT')
                        ->where('id', $position_id)
                        ->get('employees_positions')
                        ->row_array();
    }

    function update_position() {
        $this->db->update('employees_positions', array('add_responsibilities' => $this->input->post('add_responsibilities')), array('id' => $this->input->post('position_id')));
    }

    function add_position() {
        $current_position = $this->get_current_position($this->input->post('employee_id'));

        if (count($current_position) > 0) {
            if (strtotime($current_position['start']) > strtotime($this->input->post('start_date'))) {
                $this->set_error($this->lang->line('Error'));
                return FALSE;
            }

            $this->db->update('employees_positions', array('is_current' => 0, 'end' => date('Y-m-d', strtotime($this->input->post('start_date')))), array('employee_id' => $this->input->post('employee_id'), 'is_current' => 1));

            if ($this->db->affected_rows() == 0) {
                $this->set_error($this->lang->line('Error'));
                return FALSE;
            }
        }

        $this->load->model('departments_actions');

        $this->db->insert('employees_positions', array(
            'employee_id' => $this->input->post('employee_id'),
            'position_id' => $this->input->post('new_position'),
            'is_current' => 1,
            'start' => date('Y-m-d', strtotime($this->input->post('start_date'))),
            'add_responsibilities' => $this->input->post('add_responsibilities'),
            'move_reason' => $this->input->post('move_reason')
        ));

        return $this->db->insert_id();
    }

    function get_current_position($employee_id) {
        return $this->db
                        ->select('position_id,start')
                        ->where(array('employee_id' => $employee_id, 'is_current' => 1))
                        ->get('employees_positions')
                        ->row_array();
    }

    /**
     * Skills
     */
    function get_skills($employee_id) {
        $temp = $this->db
                ->select('skill_name, category_name,category_id')
                ->join('skills', 'skills.skill_id = employees_skills.skill_id', 'LEFT')
                ->join('skills_categories', 'skills_categories.category_id = skills.parent_category', 'LEFT')
                ->where('employee_id', $employee_id)
                ->order_by('skill_name')
                ->get('employees_skills')
                ->result_array();
        $result = array();

        foreach ($temp as $item) {
            $result[$item['category_id']][] = $item;
        }

        return $result;
    }

    function get_employee_skills($employee_id) {
        $temp = $this->db
                ->select('skills.skill_id,skill_name,category_name,employee_id,category_id')
                ->join('skills', 'skills.parent_category = skills_categories.category_id AND skills.is_active=1', 'LEFT')
                ->join('employees_skills', 'employees_skills.skill_id = skills.skill_id AND employee_id=' . $employee_id, 'LEFT')
                ->where('skills_categories.is_active', 1)
                ->order_by('category_name,skill_name')
                ->get('skills_categories')
                ->result_array();
        $result = array();

        foreach ($temp as $item) {
            $result[$item['category_id']][] = $item;
        }

        return $result;
    }

    function save_employee_skills() {
        $this->db->update('employees_skills', array('to_delete' => 1), array('employee_id' => $this->input->post('employee_id'), 'to_delete' => 0));

        $clean_ids = array(0);
        foreach ($this->input->post('skills') as $skill_id => $trash) {
            $clean_ids[] = (int) $skill_id;
        }

        $this->db
                ->query('INSERT INTO employees_skills (skill_id,employee_id)
                        SELECT skill_id,?
                        FROM skills
                        WHERE skill_id IN (' . implode(',', $clean_ids) . ')
                        ON DUPLICATE KEY UPDATE to_delete=0', array($this->input->post('employee_id')));

        $this->db->delete('employees_skills', array('employee_id' => $this->input->post('employee_id'), 'to_delete' => 1));

        return TRUE;
    }

    function delete_skill($skill_id) {
        $this->db->delete('skills_endorsement', array('skill_id' => $skill_id));
        $this->db->delete('employees_skills', array('skill_id' => $skill_id));
    }

    /**
     * Employment
     */
    function get_employment($employee_id) {
        return $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->order_by('start')
                        ->get('employees_employment')
                        ->result_array();
    }

    function get_employment_item($employment_item) {
        return $this->db
                        ->select('*')
                        ->where('employment_id', $employment_item)
                        ->get('employees_employment')
                        ->row_array();
    }

    function save_employment() {
        $data = array(
            'start' => date('Y-m-d', strtotime($this->input->post('start'))),
            'end' => date('Y-m-d', strtotime($this->input->post('end'))),
            'company' => $this->input->post('company'),
            'position' => $this->input->post('position'),
            'responsibilities' => $this->input->post('responsibilities')
        );

        if ($this->user_actions->is_allowed('employees')) {
            $data['is_verified'] = 1;
        }

        if ($this->input->post('employment_id') == '0') {
            $data['employee_id'] = $this->input->post('employee_id');
            $this->db->insert('employees_employment', $data);
            return $this->db->insert_id();
        }

        $this->db->update('employees_employment', $data, array('employment_id' => $this->input->post('employment_id'), 'employee_id' => $this->input->post('employee_id')));
        return TRUE;
    }

    function delete_employment($employment_id) {
        $this->db->delete('employees_employment', array('employment_id' => $employment_id));
    }

	function delete_copyimg($cpyimg,$id) {
		$this->db->update('employees', array('copy_avatar' => null), array('employee_id' => $id));
	
		if(unlink($cpyimg)){
			
		echo"Image Delete Successfully";
     }
	 
	 
	}
	
	function sign_delete_img($cpyimg,$id) {
		$this->db->update('employees', array('copy_sign' => null), array('employee_id' => $id));
	
		if(unlink($cpyimg)){
			
		echo"Sign Image Delete Successfully";
     }
	 
	 
	}
	
	function delete_ppdate($id) {
		$this->db->update('employees', array('confirm_date_pp' => null), array('employee_id' => $id));
	
		echo"Date Delete Successfully";
     }
	
	
	
	function delete_datepp($id) {
		$reset_id =$_GET['reset_id'];
		if($reset_id){$this->db->update('employees', array('confirm_date_pp' => null));
	echo "<script>location.href='http://demo.peza.com.ph/request/processcallingcard'</script>";
     }
	}

    /**
     * Family
     */
    function get_family($employee_id) {
        return $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->get('employees_family')
                        ->result_array();
    }

    function get_relative($item_id) {
        return $this->db
                        ->select('*')
                        ->where('relative_id', $item_id)
                        ->get('employees_family')
                        ->row_array();
    }

    function save_relative() {
		
        $data = array(
            'relative_name' => $this->input->post('relative_name'),
            'relative_type' => $this->input->post('relative_type'),
            'birht_date' => $this->input->post('mobile_no') 
        );

        if ($this->user_actions->is_allowed('employees')) {
            $data['is_verified'] = 1;
        }

        if ($this->input->post('relative_id') == '0') {
            $data['employee_id'] = $this->input->post('employee_id');
            $this->db->insert('employees_family', $data);
            $result = $relative_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_family', $data, array('relative_id' => $this->input->post('relative_id'), 'employee_id' => $this->input->post('employee_id')));
            $result = TRUE;
            $relative_id = $this->input->post('relative_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('relative', $relative_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_relative($relative_id) {
        $this->db->delete('employees_family', array('relative_id' => $relative_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('relative', $relative_id);
    }

    /**
     * Licenses
     */
    function get_licenses($employee_id) {
        $result = $this->db
                        ->select('employees_licenses.*, 201_document_type.document_type_name as license_name')
                        ->where('employee_id', $employee_id)
                        ->join('201_document_type','201_document_type.document_type_id = employees_licenses.document_type_id','LEFT')
                        ->order_by('license_expiry')
                        ->get('employees_licenses')
                        ->result_array();
        foreach ($result as $key => $license) {
            $attachments = $this->db->select('*')->where(array('object'=> $license['license_id'],'type'=> 'license'))
                    ->get('attachments')->result_array();
            $license['attachments'] = $attachments;
            $result[$key] = $license;
        }
        //_custom_debug($query);
        return $result;
    }
	function get_all_licenses() {
		
		$this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
			$result = $this->db->query("SELECT `employees`.`employee_id`, `employees`.`name`, `employees_licenses`.*, `201_document_type`.`document_type_name` as `license_name`, `201_document_type`.`days_to_alert`, days_to_alert + TIMESTAMPDIFF(day, NOW(), `employees_licenses`.`license_expiry`)  as remaining_days FROM `employees` LEFT JOIN `employees_licenses` ON `employees_licenses`.`employee_id` = `employees`.`employee_id` LEFT JOIN `users` ON `users`.`employee_id` = `employees`.`employee_id` LEFT JOIN `201_document_type` ON `201_document_type`.`document_type_id` = `employees_licenses`.`document_type_id` WHERE `users`.`is_active` = 1 AND `users`.`user_name` != 'k09178548787@gmail.com' AND `employees`.`name` != '' ORDER BY `employees_licenses`.`license_expiry` ASC");
            //     ->select('employees.employee_id, employees.name,employees_licenses.*,201_document_type.document_type_name as license_name, 201_document_type.days_to_alert,(days_to_alert - TIMESTAMPDIFF(day,NOW(),employees_licenses.license_expiry))')
			// 	->join('employees_licenses','employees_licenses.employee_id = employees.employee_id' ,'LEFT')
            //      ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
            //      ->join('201_document_type', '201_document_type.document_type_id = employees_licenses.document_type_id', 'LEFT')
            //     ->where('employees.name !=', '')
            // ->order_by('employees_licenses.license_expiry','ASC')
            //             ->get('employees');
        $res = array();    
        foreach ($result->result() as $key => $license) {
            $attachments = $this->db->select('*')->where(array('object'=> $license->license_id,'type'=> 'license'))
                    ->get('attachments');
            $attachments = $attachments ? null : $attachments;
            $license->attachments = $attachments;
            $res[$key] = (array)$license;
        }
			// echo  "<pre>";
						// print_R($result);
        //_custom_debug($query);
        return $res;
    }

    function get_license($item_id) {
        return $this->db
                        ->select('*')
                        ->where('license_id', $item_id)
                        ->get('employees_licenses')
                        ->row_array();
    }

    function save_license($employee_id = 0) {
        $employee_id = ($employee_id == 0) ? $this->input->post('employee_id') : $employee_id;

		$empdata =		$this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                    
                        ->get('employees')
                        ->result_array();
						// echo "<pre>";
						// print_r($empdata);
						// die("here");
        $data = array(
            'license_name' => $this->input->post('license_name'),
            'license_number' => $this->input->post('license_number'),
            'license_expiry' => $this->input->post('expiry') ? $this->input->post('expiry') : NULL,
            'is_verified' => $this->user_actions->is_selfservice() ? 0 : 1,
            'document_type_id' => $this->input->post('document_type'),
        );
        
        if ($this->input->post('license_id') == '0') {
            $data['employee_id'] = $employee_id;
            $this->db->insert('employees_licenses', $data);
            $result = $license_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_licenses', $data, array('license_id' => $this->input->post('license_id'), 'employee_id' => $employee_id));
            $result = TRUE;
            $license_id = $this->input->post('license_id');
        }
        
        $this->load->model('attachments_actions');
		 $empname =$empdata[0]['name'];
        if (!$files = $this->attachments_actions->upload_attachments('license', $license_id ,$empname,'201File')) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_license($license_id) {
        $this->db->delete('employees_licenses', array('license_id' => $license_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('license', $license_id);
    }

    function resing_employee() {
        $current_position = $this->db
                ->select('*')
                ->where(array('employee_id' => $this->input->post('employee_id'), 'is_current' => 1))
                ->get('employees_positions')
                ->row_array();

        $this->db->insert('employees_resign', array(
            'employee_id' => $this->input->post('employee_id'),
            'last_position' => $current_position['position_id'],
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'reason' => $this->input->post('reason')
        ));


        $this->db->update('employees', array('status' => 'Resigned'), array('employee_id' => $this->input->post('employee_id')));
        $this->db->update('employees_positions', array('is_current' => 0, 'end' => date('Y-m-d', strtotime($this->input->post('date')))), array('employee_id' => $this->input->post('employee_id'), 'is_current' => 1));

        return TRUE;
    }

    /**
     * Contract
     */
    function get_contract($employee_id) {
        $query = $this->db
                ->select('employees_contract.*, contract_type.name as contract_type_name')
                ->join('contract_type', 'contract_type.id = employees_contract.contract_type_id', 'LEFT')
                ->where('employee_id', $employee_id)
                ->order_by('contract_id','DESC')
                ->get('employees_contract');
        //_custom_debug($this->db->last_query());
        $result = $query->result_array();
        foreach ($result as $key => $contract) {
            $attachments = $this->db->select('*')->where(array('object'=> $contract['contract_id'],'type'=> 'contract'))
                    ->get('attachments')->result_array();
            $contract['attachments'] = $attachments;
            $result[$key] = $contract;
        }
        //_custom_debug($query);
        return $result;
    }

    function get_contract_item($contract_item) {
        return $this->db
                        ->select('*')
                        ->where('contract_id', $contract_item)
                        ->get('employees_contract')
                        ->row_array();
    }

    function save_contract() {
        $data = array(
            'contract_expiry' => date('Y-m-d', strtotime($this->input->post('contract_expiry'))),
            'contract_salary' => $this->input->post('contract_salary'),
            'contract_content' => $this->input->post('content'),
            'contract_condition' => $this->input->post('contract_condition'),
            'performance_allowance' => $this->input->post('performance_allowance'),
            'contract_type_id' => $this->input->post('contract_type_id')
        );

        if ($this->user_actions->is_allowed('employees')) {
            $data['is_verified'] = 1;
        }
//
//        if ($this->input->post('contract_id') == '0') {
//            $data['employee_id'] = $this->input->post('employee_id');
//            $this->db->insert('employees_contract', $data);
//            return $this->db->insert_id();
//        }
//
//        $this->db->update('employees_contract', $data, array('contract_id' => $this->input->post('contract_id'), 'employee_id' => $this->input->post('employee_id')));
//        return TRUE;
$eid=$this->input->post('employee_id');
$empdata =		$this->db
                        ->select('*')
                        ->where('employee_id', $eid)
                    
                        ->get('employees')
                        ->result_array();
						$empname= $empdata[0]['name'];
        if ($this->input->post('contract_id') == '0') {
            $data['employee_id'] = $this->input->post('employee_id');
            $this->db->insert('employees_contract', $data);
            $result = $contract_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_contract', $data, array('contract_id' => $this->input->post('contract_id'), 'employee_id' => $this->input->post('employee_id')));
            $result = TRUE;
            $contract_id = $this->input->post('contract_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('contract', $contract_id,$empname,'EmployeeContract')) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_contract($contract_id) {
        $this->db->delete('employees_contract', array('contract_id' => $contract_id));
    }

    function print_contract($contract_id) {
        return $this->db
            ->select('employees_contract.*, employees.name as fullname,employees.avatar as imp_img , employees.position_id, employees.department_id, positions.position_name, departments.department_name,contract_type.name as contract_type_name')
                        ->join('employees', 'employees.employee_id = employees_contract.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('contract_type', 'contract_type.id = employees_contract.contract_type_id', 'LEFT')
                        ->where('employees_contract.contract_id', $contract_id)
                        ->get('employees_contract')
                        ->row_array();
    }

    function print_employee($employee_id) {
        $query = $this->db
                ->select('employees.*,employees.name as fullname, positions.position_name, departments.department_name')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->where('employees.employee_id', $employee_id)
                ->get('employees');
        $result = $query->row_array();
        return $result;
    }
//***********print_employee_leave***

function print_employee_leave($record_id,$status=array('request'))
      {
          return $this->db
                     ->select('timeoff.*,employees.name as fullname,employees.avatar as av,departments.department_name,positions.position_name')
					 ->join('employees', 'employees.employee_id= timeoff.employee_id', 'LEFT')
					 ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
					 ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                      ->where('timeoff.record_id',$record_id)
                      ->where_in('timeoff.status',$status)
                      ->get('timeoff')
                      ->row_array();
      }
	
	
    function update_employee_avatar($employee_id, $avatar) {
        $this->db->update('employees', array('avatar' => $avatar), array('employee_id' => $employee_id));
    }
    
	function update_employee_avatar1($employee_id, $avatar) {
        $this->db->update('employees', array('sign' => $avatar), array('employee_id' => $employee_id));
    }
    /**
     * Performances
     */
    function get_performances($employee_id) {
        $result = $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->order_by('performance_id')
                        ->get('employees_performances')
                        ->result_array();
        foreach ($result as $key => $performance) {
            $attachments = $this->db->select('*')->where(array('object'=> $performance['performance_id'],'type'=> 'performance'))
                    ->get('attachments')->result_array();
//            _custom_debug($this->db->last_query());
            $performance['attachments'] = $attachments;
            $result[$key] = $performance;
        }
        //_custom_debug($query);
        return $result;
    }

    function get_performance($item_id) {
        return $this->db
                        ->select('*')
                        ->where('performance_id', $item_id)
                        ->get('employees_performances')
                        ->row_array();
    }

    function save_performance($employee_id = 0) {
        $employee_id = ($employee_id == 0) ? $this->input->post('employee_id') : $employee_id;

        $data = array(
            'performance_name' => $this->input->post('performance_name'),            
        );

        if ($this->input->post('performance_id') == '0') {
            $data['employee_id'] = $employee_id;
            $this->db->insert('employees_performances', $data);
            $result = $performance_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_performances', $data, array('performance_id' => $this->input->post('performance_id'), 'employee_id' => $employee_id));
            $result = TRUE;
            $performance_id = $this->input->post('performance_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('performance', $performance_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_performance($performance_id) {
        $this->db->delete('employees_performances', array('performance_id' => $performance_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('performance', $performance_id);
    }
    
	/**********************************inactive claim models start********************************/
	  function inactiveclaim() {
       $result = $this->db
                        ->select('*')
                        //->where('employee_id', $employee_id)
                        //->order_by('claim_id')
                        ->get('employees_claims')
                        ->result_array();
        foreach ($result as $key => $claim) {
            $attachments = $this->db->select('*')->where(array('object'=> $claim['claim_id'],'type'=> 'claim'))
                    ->get('attachments')->result_array();
//            _custom_debug($this->db->last_query());
            $claim['attachments'] = $attachments;
            $result[$key] = $claim;
        }
        //_custom_debug($query);
        return $result;
    }

function getemp_images(){
	 $uploadedp =$_GET['id'];
	
     $query=  $this->db
                        ->select('*')
                        ->where('employee_id', $uploadedp)
                        //->order_by('claim_id')
                        ->get('employees')
                        ->result_array();
						 // foreach ($query as $key => $claim){
							// echo $claim['sign'].','; 
							// echo $claim['employee_no']; 
						 // }
						return $query;
    }
	
	function copy_signimages($data, $employee_id){
		//print_r($data);die();
		$this->db->update('employees', $data, array( 'employee_id' => $employee_id));
            $result = TRUE;
		
	}
	
	function copy_avtarimages($data, $employee_id){
		//print_r($data);die();
		$this->db->update('employees', $data, array( 'employee_id' => $employee_id));
            $result = TRUE;
		
	}

	
	   function get_claims($employee_id) {
        $result = $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->order_by('claim_id')
                        ->get('employees_claims')
                        ->result_array();
        foreach ($result as $key => $claim) {
            $attachments = $this->db->select('*')->where(array('object'=> $claim['claim_id'],'type'=> 'claim'))
                    ->get('attachments')->result_array();
//            _custom_debug($this->db->last_query());
            $claim['attachments'] = $attachments;
            $result[$key] = $claim;
        }
        //_custom_debug($query);
        return $result;
    }

    function get_claim($item_id) {
        return $this->db
                        ->select('*')
                        ->where('claim_id', $item_id)
                        ->get('employees_claims')
                        ->row_array();
    }

    function save_claim($employee_id = 0) {
        $employee_id = ($employee_id == 0) ? $this->input->post('employee_id') : $employee_id;

        $data = array(
            'claim_name' => $this->input->post('claim_name'),
                     
        );

        if ($this->input->post('claim_id') == '0') {
            $data['employee_id'] = $employee_id;
            $this->db->insert('employees_claims', $data);
            $result = $claim_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_claims', $data, array('claim_id' => $this->input->post('claim_id'), 'employee_id' => $employee_id));
            $result = TRUE;
            $claim_id = $this->input->post('claim_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('claim', $claim_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_claim($claim_id) {
        $this->db->delete('employees_claims', array('claim_id' => $claim_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('claim', $claim_id);
    }
    
	
	
	/**********************************Cliam models end********************************/
    /**
     * Assets & Benefits
     */
    function get_assetbenefits($employee_id) {
        $result = $this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                        ->order_by('assetbenefit_id')
                        ->get('employees_assetbenefits')
                        ->result_array();
        foreach ($result as $key => $assetbenefit) {
            $attachments = $this->db->select('*')->where(array('object'=> $assetbenefit['assetbenefit_id'],'type'=> 'assetbenefit'))
                    ->get('attachments')->result_array();
//            _custom_debug($this->db->last_query());
            $assetbenefit['attachments'] = $attachments;
            $result[$key] = $assetbenefit;
        }
        //_custom_debug($query);
        return $result;
    }

    function get_assetbenefit($item_id) {
        return $this->db
                        ->select('*')
                        ->where('assetbenefit_id', $item_id)
                        ->get('employees_assetbenefits')
                        ->row_array();
    }

    function save_assetbenefit($employee_id = 0) {
        $employee_id = ($employee_id == 0) ? $this->input->post('employee_id') : $employee_id;
$empdata =		$this->db
                        ->select('*')
                        ->where('employee_id', $employee_id)
                    
                        ->get('employees')
                        ->result_array();
						$empname= $empddata[0]['name'];
if(isset($_POST['assetbenefit_check'])){
			
			$is_returned = 1;
		
		}
		else{
			$is_returned = 0;
		}
		
        $data = array(
            'assetbenefit_name' => $this->input->post('assetbenefit_name'),   
			'is_returned'=> $is_returned,
        );

        if ($this->input->post('assetbenefit_id') == '0') {
            $data['employee_id'] = $employee_id;
            $this->db->insert('employees_assetbenefits', $data);
            $result = $assetbenefit_id = $this->db->insert_id();
        } else {
            $this->db->update('employees_assetbenefits', $data, array('assetbenefit_id' => $this->input->post('assetbenefit_id'), 'employee_id' => $employee_id));
            $result = TRUE;
            $assetbenefit_id = $this->input->post('assetbenefit_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('assetbenefit', $assetbenefit_id,$empname, '')) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_assetbenefit($assetbenefit_id) {
        $this->db->delete('employees_assetbenefits', array('assetbenefit_id' => $assetbenefit_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('assetbenefit', $assetbenefit_id);
    }
	
	function get_birthdayemployees()
	{
		   
		   $sdate =$_POST['start_date'];
		   $st_date =explode('/',$sdate);
		   $edate =$_POST['end_date'];
		   
		   $et_date =explode('/',$edate);
		
		$this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
   
       $result= $this->db
                ->select('employees.employee_id, employees.name,employees.birth_date ,employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
		
		//->where(array('DATE_FORMAT(birth_date, "d/m")>= ' => date('d/m', strtotime($this->input->post('start_date'))), 'DATE_FORMAT(birth_date, "d/m") <=' => date('d/m', strtotime($_POST["end_date"]))))
						//->order_by("employee_id", "desc")
						//->WHERE array('month(birth_date) between '02' and '08' and year(dt) between 2004 and 2005
						->where('month(birth_date) >=', $st_date[1])
					->where('month(birth_date) <=', $et_date[1])
					->where('day(birth_date) >=', $st_date[0])
					->where('day(birth_date) <=', $et_date[0])
                        ->get('employees')        
                        ->result_array();
						// echo "<pre>";
						// print_R($result);
						// die("here");
					//echo 	$str = $this->db->last_query();
						return $result;
	}
	function print_birthdayemployees($sdate,$edate)
	{
		   
		   //$sdate =$_POST['start_date'];
		   // echo $sdate;
		   // echo $edate;
		   $st_date =explode('/',$sdate);
		   //$edate =$_POST['end_date'];
		   
		   $et_date =explode('/',$edate);
		
		$this->db->where('users.is_active',1);
             $this->db->where('users.user_name!=','k09178548787@gmail.com');
   
       $result= $this->db
                ->select('employees.employee_id, employees.name,employees.birth_date ,employees.employee_no, employees.avatar, employees.sign, employees.status,employees.late_Time,employees.petteycashliquidate, employees.employee_status_note , positions.position_name,users.is_active,departments.department_name,grouplist.group_name', FALSE)
             //  ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('grouplist', 'grouplist.group_id = employees.group_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
		
		//->where(array('DATE_FORMAT(birth_date, "d/m")>= ' => date('d/m', strtotime($this->input->post('start_date'))), 'DATE_FORMAT(birth_date, "d/m") <=' => date('d/m', strtotime($_POST["end_date"]))))
						//->order_by("employee_id", "desc")
						//->WHERE array('month(birth_date) between '02' and '08' and year(dt) between 2004 and 2005
						->where('month(birth_date) >=', $st_date[1])
					->where('month(birth_date) <=', $et_date[1])
					->where('day(birth_date) >=', $st_date[0])
					->where('day(birth_date) <=', $et_date[0])
                        ->get('employees')        
                        ->result_array();
						return $result;
	}
	

}

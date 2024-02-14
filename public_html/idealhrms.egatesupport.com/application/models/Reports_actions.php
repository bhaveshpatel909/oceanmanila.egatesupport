<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Reports_actions extends Base_model {

    function get_results() {
        return call_user_func(array($this, $this->input->post('report_category') . '_' . $this->input->post('report_type')));
    }

    function validate_fields() {
        switch ($this->input->post('report_category') . '_' . $this->input->post('report_type')) {
            
        }
    }

    function get_newly_hired() {
        return $this->db
                        ->select('name,avatar, position_name, department_name, hired_at,vacancies_applicants.employee_id')
                        ->join('employees', 'employees.employee_id = vacancies_applicants.employee_id', 'LEFT')
                        ->join('employees_positions', 'employees_positions.employee_id  = employees.employee_id AND employees_positions.is_current=1', 'LEFT')
                        ->join('positions', 'positions.position_id = employees_positions.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = positions.department_id', 'LEFT')
                        ->where('vacancies_applicants.status', 'Enrolled')
                        ->limit(5)
                        ->order_by('vacancies_applicants.employee_id', 'DESC')
                        ->get('vacancies_applicants')
                        ->result_array();
    }

    function get_last_discipline() {
        return $this->db
                        ->select('discipline.*, employees.name as fullname, employees.avatar,employees.position_id, employees.department_id, positions.position_name, departments.department_name,discipline_reasons.name as reason_name, discipline_reasons.content as reason_content, discipline_actions.name as action_name')
                        ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                        ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                        ->limit(5)
                        ->order_by('discipline.date DESC')
                        ->get('discipline')
                        ->result_array();
    }

    function clock_default() {
		// echo "<pre>";
		// print_R($_POST['employee']);
		// die("sdf");
        if (isset($_POST['employee']) && $_POST['employee'][0]!="") {
			$result = $this->db
                        ->select('remarks,overtime_remark,record_id,start_time,end_time,penality_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments,time_out,ipaddress_in,ipaddress_out')
                        ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date'))),'employee_id'=>$_POST['employee'][0]))
						->order_by("record_id", "desc")
                        ->get('punch_clock')        
                        ->result_array();
           // $this->db->where('punch_clock.employee_id', (int) $_POST['employee'][0]);
        } 
		else {
            $employees=$this->db
                        ->select('employees.employee_id as id, employees.name as name,email, employees.late_time as late_time', FALSE)
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
					  // echo "<pre>";
					  // print_r($employee);
					  // die("asdA");
					  foreach($employees as $key =>$employee)
					  {
						 // $employee[$key]['clock']= $empp['id'];
						 // $employees[$key] = $empp;
						
						 $q1=$this->db
                        ->select('remarks,overtime_remark,record_id,start_time,end_time,penality_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments,time_out,ipaddress_in,ipaddress_out')
                        ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date'))),'employee_id'=>$employee['id']))
						->order_by("record_id", "desc")
                        ->get('punch_clock')        
                        ->result_array();
						// echo "<pre>";
						// echo "<pre>";
						// print_r($punchclock);
						 $employee['punchclock'] = $q1;
						  $employees[$key] = $employee;
					  }
					  $result['data'] = $employees;
					  // echo "<pre>";
					  // print_R($result);
        }
		  

        
						// echo "<pre>";
						// print_R($result);
       // array_sort_by_column($result, 'employee_id');
	   // echo "<pre>";
	   // print_r($result);
	   // die("dsfd");
	   
        return $result;
    }

    function discipline_discipline() {
        $employee = $this->input->post('employee');
        if (isset($employee)) {
            $this->db->where('discipline.employee_id', (int) $employee[0]);
        } else {
            $this->db
                    ->select('employees.name as fullname')
                    ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT');
        }

        $query = $this->db
                ->select('discipline.record_id, discipline.date, discipline_reasons.name as reason, discipline_actions.name as action_taken, discipline_actions.score')
                //->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                ->order_by('date')
                ->get('discipline');
        //die($this->db->last_query());
        return $query->result_array();
    }

    function print_discipline_report() {
        $employee = $this->input->post('employee');
        if (isset($employee)) {
            $this->db->where('discipline.employee_id', (int) $employee[0]);
        }
        $this->db
                ->select('employees.name as fullname')
                ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT');
        $query = $this->db
                ->select('discipline.record_id, discipline.date, discipline_reasons.name as reason, discipline_actions.name as action_taken, discipline_actions.score')
                ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                ->order_by('date')
                ->get('discipline');
        //die($this->db->last_query());
        return $query->result_array();
    }

    function print_punch_clock() {
        $employee = $this->input->post('employee');
        if (isset($employee)) {
            $this->db->where('punch_clock.employee_id', (int) $employee[0]);
        }
	if(trim($employee[0]) == null )
		{
			$this->db
                ->select('employees.employee_id, employees.name as fullname, position_name, department_name, avatar')
                ->join('employees', 'employees.employee_id = punch_clock.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT');
			$query = $this->db
					->select('start_time,end_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
					->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date')))))
					//->order_by('record_id','desc')
					->get('punch_clock');
			//die($this->db->last_query());
			$result = $query->result_array();
			array_sort_by_column($result, 'employee_id');
		}
        $this->db
                ->select('employees.employee_id, employees.name as fullname, position_name, department_name, avatar')
                ->join('employees', 'employees.employee_id = punch_clock.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT');
        $query = $this->db
                ->select('start_time,end_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
                ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date')))))
                //->order_by('record_id','desc')
                ->get('punch_clock');
        //die($this->db->last_query());
        $result = $query->result_array();
        array_sort_by_column($result, 'employee_id');
//        _custom_debug($result);
        return $result;
        
    }
    function export_punch_clock($id,$sdate,$edate) {
		//echo $sdate;
		//echo $edate;
		//die("gfbhnj");
        
		// echo "<pre>";
		// print_r($employee);
        if (isset($id) && $id!=0) {
			// echo "gfgbhkj,";
			// die("fggk");
            $this->db->where('punch_clock.employee_id', $id);
        }
	if($id == 0 )
		{
			//echo "dxcgvdf";
			  $employees=$this->db
                        ->select('employees.employee_id as id, employees.name as name,email,users.user_ip as user_ip', FALSE)
                        ->join('employees_positions', 'employees_positions.employee_id = employees.employee_id AND is_current=1', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                ->join('users', 'users.employee_id = employees.employee_id', 'LEFT')
                        ->where('users.is_active', 1)
                        ->where('employees.name !=', '')
                       // ->like('name', $this->input->post('query'), 'both')
                        ->order_by('name')
                       // ->limit(30)
                        ->get('employees')
                      ->result_array();
					  // echo "<pre>";
					  // print_r($employee);
					  // die("asdA");
					  foreach($employees as $key =>$employee)
					  {
						 // $employee[$key]['clock']= $empp['id'];
						 // $employees[$key] = $empp;
						
						 $q1=$this->db
                        ->select('remarks,overtime_remark,record_id,start_time,end_time,penality_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments,time_out,ipaddress_in,ipaddress_out')
                       // ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date'))),'employee_id'=>$employee['id']))
						 ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($sdate)), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($edate)),'employee_id'=>$employee['id']))
						->order_by("record_id", "desc")
                        ->get('punch_clock')        
                        ->result_array();
						// echo "<pre>";
						// echo "<pre>";
						// print_r($punchclock);
						if(!empty($q1))
						{
						 $employee['punchclock'] = $q1;
						  $employees[$key] = $employee;
						}
						
					  }
					  $result = $employees;
					return $result;
		}
		else
		{
		//die("xcfvzd");
        $this->db
                ->select('employees.employee_id, employees.name as fullname, position_name, department_name, avatar')
                ->join('employees', 'employees.employee_id = punch_clock.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT');
        $query = $this->db
                ->select('remarks,overtime_remark,record_id,start_time,end_time,penality_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments,time_out,ipaddress_in,ipaddress_out')
                ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($sdate)), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($edate))))
                ->order_by('record_id','desc')
                ->get('punch_clock');
        //die($this->db->last_query());
        $result = $query->result_array();
		// echo "<pre>";
		// print_r($result);
		// die("dgd");
       // array_sort_by_column($result, 'employee_id');
//        _custom_debug($result);
        return $result;
		}
        
    }
	
	public function Add_User($data_user){
		$this->db->insert('excell', $data_user);
   }
   
    function get_lazada_list() {
		return $this->db
			->select('*')
			->order_by('Order_No')
			->get('excell')
			->result_array();
    }
	
	function get_lazada_order() {
		return $this->db->distinct('Order_No')

			->select('Order_No')
			->order_by('Order_No')
			->get('excell')
			->result_array();
    }
	
	function posts_save($id , $fields)
    {
		$this ->db
		->where('id',$id)
		->update('excell',$fields);
    }
	
	function get_allCredit_byorder($odr)
    {
		//echo $odr;
		return $this->db

			->select_sum('Amount')
			->where(array('Order_No' => $odr, 'Transaction_Type' => 'Adjustments Shipping Fee'))
			->get('excell')
			->result_array();
	}
	
	function get_name_byorder($odr) {
		
		return $this->db

			->select('name')
			->where('Order_No',$odr)
			->get('excell')
			->result_array();
    }
	
	
	
function getemployeed($idddd) {
		return $this->db

			->select('*')
			->order_by('start_time', 'DESC')
			
			->where('employee_id',$idddd)
			->get('orpunch_clock')
       
			->result_array();
    }
	
	
	
	
	function get_alltyp_byorder($odr)
    {
		return $this->db->distinct('Transaction_Type')

			->select('Transaction_Type')
			->where('Order_No',$odr)
			->get('excell')
			->result_array();
	}
	
	function get_typamnt_byorder($odr, $typ)
    {
		return $this->db

			->select_sum('Amount')
			->where(array('Order_No' => $odr, 'Transaction_Type' => $typ))
			->get('excell')
			->result_array();
	}
	
	function delete_lazada_order() {
		$this->db->truncate('excell');
    }
	
	function updateendtime($data,$rid)
	{
		// echo "<pre>";
		// print_r($data);
		// echo $rid;
		// die("sfSD");
		 $res =$this->db
		->where('record_id',$rid)
		->update('punch_clock',$data);
		if($res)
		{
			$status= 'Updated';
		}
		return $status;
		
	}
	
	
	/*******************************************Reports of clock model  start*****************************************************/
	
	 function clock_ordefault() {
         if (isset($_POST['employee']) && $_POST['employee'][0]!="") {
			$result = $this->db
                        ->select('record_id,start_time,end_time,DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
                        ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date'))),'employee_id'=>$_POST['employee'][0]))
						->order_by("record_id", "desc")
                        ->get('orpunch_clock')        
                        ->result_array();
           // $this->db->where('punch_clock.employee_id', (int) $_POST['employee'][0]);
        } 
		else {
            $employees=$this->db
                        ->select('employees.employee_id as id, employees.name as name,email', FALSE)
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
					  // echo "<pre>";
					  // print_r($employee);
					  // die("asdA");
					  foreach($employees as $key =>$employee)
					  {
						 // $employee[$key]['clock']= $empp['id'];
						 // $employees[$key] = $empp;
						
						 $q1=$this->db
                       ->select('record_id,start_time,end_time,DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
                        ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date'))),'employee_id'=>$employee['id']))
						->order_by("record_id", "desc")
                        ->get('orpunch_clock')        
                        ->result_array();
						// echo "<pre>";
						// echo "<pre>";
						// print_r($punchclock);
						 $employee['punchclock'] = $q1;
						  $employees[$key] = $employee;
					  }
					  $result['data'] = $employees;
					  // echo "<pre>";
					  // print_R($result);
        }
		  

        
						// echo "<pre>";
						// print_R($result);
       // array_sort_by_column($result, 'employee_id');
	   // echo "<pre>";
	   // print_r($result);
	   // die("dsfd");
	   
        return $result;
    }
	
	  function orprint_punch_clock() {
        $employee = $this->input->post('employee');
        if (isset($employee)) {
            $this->db->where('orpunch_clock.employee_id', (int) $employee[0]);
        }
        $this->db
                ->select('employees.employee_id, employees.name as fullname, position_name, department_name, avatar')
                ->join('employees', 'employees.employee_id = orpunch_clock.employee_id', 'LEFT')
                ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                ->join('departments', 'departments.department_id = employees.department_id', 'LEFT');
        $query = $this->db
                ->select('start_time,end_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
                ->where(array('start_time >= ' => date('Y-m-d 00:00:00', strtotime($this->input->post('start_date'))), 'start_time <= ' => date('Y-m-d 23:59:59', strtotime($this->input->post('end_date')))))
                ->order_by('start_time')
                ->get('orpunch_clock');
        //die($this->db->last_query());
        $result = $query->result_array();
        array_sort_by_column($result, 'employee_id');
//        _custom_debug($result);
        return $result;
        
    }
	
	/*******************************************Reports of clock model  end*****************************************************/
	function get_assetbenefit()
	{
		
		  $result = $this->db
                        ->select('*')
                        ->where('is_returned', 0)
                        ->order_by('assetbenefit_id')
                        ->get('employees_assetbenefits')
                        ->result_array();
						if(!empty($result))
						{
        foreach ($result as $key => $assetbenefit) {
            $attachments = $this->db->select('*')->where(array('object'=> $assetbenefit['assetbenefit_id'],'type'=> 'assetbenefit'))
			
                    ->get('attachments')->result_array(); 
		$employe = $this->db->select('employees.employee_id, employees.name as fullname')->where(array('employee_id'=> $assetbenefit['employee_id']))
			
                     ->get('employees')->result_array();
         // _custom_debug($this->db->last_query());
            $assetbenefit['attachments'] = $attachments;
          $assetbenefit['employe'] = $employe;
            $result[$key] = $assetbenefit;
        }
		}
		// echo "<pre>";
		// print_R($result);
		// die("here");
		     /* return $this->db
                        ->select('employees_assetbenefits.assetbenefit_name,employees.employee_id, employees.name as fullname, attachments.location,attachments.file')
                        ->join('employees', 'employees.employee_id = employees_assetbenefits.employee_id', 'LEFT')
                        ->join('attachments', 'attachments.object = employees_assetbenefits.assetbenefit_id', 'LEFT')
                      //  ->join('users', 'users.employee_id = employees_assetbenefits.employee_id', 'LEFT')
                        
                        ->where('employees_assetbenefits.is_returned', 0)
                        //->limit(5)
                        //->order_by('vacancies_applicants.employee_id', 'DESC')
                        ->get('employees_assetbenefits')
                        ->result_array(); */
		return $result;
	}
	
}

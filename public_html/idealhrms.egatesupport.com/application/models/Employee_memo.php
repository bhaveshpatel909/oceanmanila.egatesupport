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
class Employee_memo extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_employee_memo_list() {
		
        return  $this->db
                        ->select('*')
						
                        ->get('employee_list')
						
                        ->result_array();
    }
	
	/***************************Add employee status list ************************************/
	
	 public function add_employee_memoo() {
		 
			
		$data = array(
            'status' => $this->input->post('employee_memoo'),
           
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('employee_list', $data);
			
             $reminderlist_id = $this->db->insert_id();
			
          
            
            return $reminderlist_id;
    }
	 }
	/***************************Add employee status list ************************************/
	
	public function get_employee_memo_listfilter() {
        return $this->db
                        ->select('*')
						->group_by('status')
                        ->get('employees')
						
                        ->result_array();
    }
	
	public function get_employee_memo_statusnote($employee_memo_id) {
			
		$this->db->select('employee_id, name, status, employee_status_note,write_rem,edit_rem,delete_rem,write_man,edit_man,delete_man,write_lea,edit_lea,delete_lea');
        $this->db->where('employee_id', $employee_memo_id);
        $query = $this->db->get('employees');
        return $query->row_array();
    }
	
	
    
     function get_employee_memo($employee_id) {
        $this->db->select('employee_id, name, status');
        $this->db->where('employee_id', $employee_memo_id);
        $query = $this->db->get('employees');
        return $query->row_array();
		
    }
	
	function enum_select( $table , $field ){
		    $query = " SHOW COLUMNS FROM `$table` LIKE '$field' ";
    $row = $this->db->query(" SHOW COLUMNS FROM `$table` LIKE '$field' ")->row()->Type;
    $regex = "/'(.*?)'/";
    preg_match_all( $regex , $row, $enum_array );
    $enum_fields = $enum_array[1];
	//print_r($enum_fields);
    return( $enum_fields );
}

    function save_employee_memo() {
        $data = array(
            'name' => $this->input->post('employee_memo')
        );

        if ($this->input->post('employee_memo_id') == '0') {
            $this->db->insert('contract_type', $data);
            return $this->db->insert_id();
        }

        $this->db->update('contract_type', $data, array('id' => $this->input->post('contract_type_id')));
        return TRUE;
    }
	
	
	/*****************update status********************/
	
	function up_employee_memo() {
  $id = $_POST['employee_memo_id'];
		$name = $_POST['employee_memoo'];
	 // die('dcd');
      /**Enum values in database**/ //'Active','Resigned','Terminated','Contract_finished'
	   $data = array(
	   'status' => $name
    );
 // echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// die('dfdfd');  
		
       $this->db->update('employee_list',  $data, array('id' =>$id));
        return TRUE;
        
    }
	
	/*****************update status********************/
		function delete_emp_type($employee_memo_id) {
	 $id = $_POST['employee_memo_id'];
		$name = $_POST['employee_memoo'];
	 // die('dcd');
      /**Enum values in database**/ //'Active','Resigned','Terminated','Contract_finished'
	   $data = array(
	   'status' => $name
    );
 // echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		// die('dfdfd');  
		
       $this->db->delete('employee_list',  $data, array('id' =>$employee_memo_id));
        return TRUE;
        
    }
/*
    function delete_employee_memo_type($contract_type_id) {
        $this->db->delete('contract_type', array('id' => $contract_type_id));
    } */

}

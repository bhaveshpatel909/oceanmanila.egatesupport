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
class Processlist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_processlist($id) {
        return $this->db
                        ->select('*')
                        ->where('process_id',$id)
						 ->get('processlist')
                        ->result_array();
    }

   

    function delete_processlist($id) {
        $this->db->delete('processlist', array('process_id' => $id));
    }

	
	
	 	function status_processlist($cid, $status)
	{
		//$bankid= $this->input->post('id');
		//die("fhbgf");
		$data = array(
        
			'is_active'=> $status,
			);
       $suss=  $this->db->update('processlist', $data, array('process_id' => $cid));
	}
	
    public function process_list() {
        $processlist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('processlist')
                ->result_array();
      
        return $processlist;
    }

   

    function save_processlist() {
		
		
		
			
			$data = array(
            'process_name' => $this->input->post('process_name'),
            'contactinfo' => $this->input->post('contactinfo'),
            'remarks' => $this->input->post('remarks'),
			'is_active'=> 1,
           
			 
        );
	
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('processlist', $data);
			
             $banklist_id = $this->db->insert_id();
			
          
            
            return $banklist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('processlist', $data, array('process_id' => $bankid));
	  
        return TRUE;
    }

    

}
?>

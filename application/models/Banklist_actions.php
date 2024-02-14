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
class Banklist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_banklist($id) {
        return $this->db
                        ->select('*')
                        ->where('bank_id',$id)
						 ->get('banklist')
                        ->result_array();
    }

   

    function delete_banklist($id) {
        $this->db->delete('banklist', array('bank_id' => $id));
    }

	
	
	 
	
    public function bank_list() {
        $banklist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('banklist')
                ->result_array();
      
        return $banklist;
    }

   

    function save_bank_list() {
		
		
		
			
			$data = array(
            'bank_name' => $this->input->post('bank_name'),
            'bank_acount_no' => $this->input->post('account_no'),
            'contact_no' => $this->input->post('contact_no'),
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('banklist', $data);
			
             $banklist_id = $this->db->insert_id();
			
          
            
            return $banklist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('banklist', $data, array('bank_id' => $bankid));
	  
        return TRUE;
    }

    

}

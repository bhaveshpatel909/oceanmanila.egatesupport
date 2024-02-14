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
class Reminderlist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_reminderlist($id) {
        return $this->db
                        ->select('*')
                        ->where('reminder_id',$id)
						 ->get('reminderlist')
                        ->result_array();
    }

   

    function delete_reminderlist($id) {
        $this->db->delete('reminderlist', array('reminder_id' => $id));
    }

	
	
	 
	
    public function reminder_list() {
        $reminderlist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('reminderlist')
                ->result_array();
      
        return $reminderlist;
    }

   

    function save_reminder_list() {
		
		
		
			
			$data = array(
            'reminder_name' => $this->input->post('bank_name'),
           
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('reminderlist', $data);
			
             $reminderlist_id = $this->db->insert_id();
			
          
            
            return $reminderlist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('reminderlist', $data, array('reminder_id' => $bankid));
	  
        return TRUE;
    }

    

}

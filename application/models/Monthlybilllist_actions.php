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
class Monthlybilllist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_monthlybilllist($id) {
        return $this->db
                        ->select('*')
                        ->where('billlist_id',$id)
						 ->get('monthlybilllist')
                        ->result_array();
    }

   

    function delete_monthlybilllist($id) {
        $this->db->delete('monthlybilllist', array('billlist_id' => $id));
    }

	
	
	 
	
    public function monthlybill_list() {
        $monthlybilllist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('monthlybilllist')
                ->result_array();
      
        return $monthlybilllist;
    }

   

    function save_monthlybill_list() {
		
		
		
			
			$data = array(
            'list_name' => $this->input->post('list_name'),
            
            'remarks' => $this->input->post('remarks'),
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('monthlybilllist', $data);
			
             $monthlybilllist_id = $this->db->insert_id();
			
          
            
            return $monthlybilllist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('monthlybilllist', $data, array('billlist_id' => $bankid));
	  
        return TRUE;
    }

    

}

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
class Customerlist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_customerlist($id) {
        return $this->db
                        ->select('*')
                        ->where('customer_id',$id)
						 ->get('customerlist')
                        ->result_array();
    }

   

    function delete_customerlist($id) {
        $this->db->delete('customerlist', array('customer_id' => $id));
    }

	
	
	 
	
    public function customer_list() {
        $customerlist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('customerlist')
                ->result_array();
      
        return $customerlist;
    }

   

    function save_customerlist() {
		
		
		
			
			$data = array(
            'customer_name' => $this->input->post('customer_name'),
            'contactinfo' => $this->input->post('contactinfo'),
            'remarks' => $this->input->post('remarks'),
			'is_active'=> 1,
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('customerlist', $data);
			
             $banklist_id = $this->db->insert_id();
			
          
            
            return $banklist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('customerlist', $data, array('customer_id' => $bankid));
	  
        return TRUE;
    }
	
	function status_customerlist($cid, $status)
	{
		//$bankid= $this->input->post('id');
		//die("fhbgf");
		$data = array(
        
			'is_active'=> $status,
			);
       $suss=  $this->db->update('customerlist', $data, array('customer_id' => $cid));
	}

    

}
?>

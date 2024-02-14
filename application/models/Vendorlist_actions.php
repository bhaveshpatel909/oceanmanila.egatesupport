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
class Vendorlist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_vendorlist($id) {
        return $this->db
                        ->select('*')
                        ->where('vendor_id',$id)
						 ->get('vendorlist')
                        ->result_array();
    }

   

    function delete_vendorlist($id) {
        $this->db->delete('vendorlist', array('vendor_id' => $id));
    }

	
	
	 	function status_vendorlist($cid, $status)
	{
		//$bankid= $this->input->post('id');
		//die("fhbgf");
		$data = array(
        
			'is_active'=> $status,
			);
       $suss=  $this->db->update('vendorlist', $data, array('vendor_id' => $cid));
	}
	
    public function vendor_list() {
        $vendorlist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('vendorlist')
                ->result_array();
      
        return $vendorlist;
    }

   

    function save_vendorlist() {
		
		
		
			
			$data = array(
            'vendor_name' => $this->input->post('vendor_name'),
            'contactinfo' => $this->input->post('contactinfo'),
            'remarks' => $this->input->post('remarks'),
			'is_active'=> 1,
           
			 
        );
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('vendorlist', $data);
			
             $banklist_id = $this->db->insert_id();
			
          
            
            return $banklist_id;
        }
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('vendorlist', $data, array('vendor_id' => $bankid));
	  
        return TRUE;
    }

    

}
?>

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
class Monthlybillpayment_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_petty_items() {
       $result =$this->db
                        ->select('*')
                        ->get('petty_item_setting')
                        ->result_array();
						// echo "<pre>";
						// print_r($result);
						return $result;
    }

    function get_petty_item($petty_item_id) {
        $this->db->select('*');
        $this->db->where('id', $petty_item_id);
        $query = $this->db->get('petty_item_setting');
        return $query->row_array();
    }

   
	
	
    public function billpayment_list() {
       $checkwriters = $this->db
                ->select('monthlybillpayment.*')
                ->get('monthlybillpayment')
                ->result_array();
         foreach($checkwriters as $key => $checkwriter) {
			 
			 $q = $this->db->select('list_name')
                    ->where('billlist_id',$checkwriter['payto'])
                     ->limit(1)->get('monthlybilllist');
            $curr_bank = $q->row_array();
            $checkwriter['banklist'] = $curr_bank['list_name'];
            $checkwriters[$key] = $checkwriter;
		 }
		 // echo "<pre>";
		 // print_r($checkwriters);
		 // die("sdfsad");
		  $result['data'] = $checkwriters;
        return $result;
    }
	
	

    function get_monthlybillpayment($petty_cash_id) {
		
		$checkwriter = $this->db
                ->select('monthlybillpayment.*')
               
               /// ->join('checkwriter_cash_detail', 'checkwriter_cash_detail.checkwriter_id = checkwriter.checkwriter_id', 'LEFT')
                ->where('monthlybillpayment.bill_id', $petty_cash_id)
                //->group_by('checkwriter_cash_detail.checkwriter_id')
                ->get('monthlybillpayment')
                ->row_array();
       
        return $checkwriter;
        
    }

    function save_monthlybillpayment() {
		
		
		
			
			$data = array(
            'bill_date' => $this->input->post('created_date'),
            'payto' => $this->input->post('payto'),
            'bill_no' => $this->input->post('bill_no'),
            'amount' => $this->input->post('amount'),
            'billing_period' => $this->input->post('billing_period'),
           
			 
        );
		
	
        if ($this->input->post('bill_id') == '0') {
            
            $this->db->insert('monthlybillpayment', $data);
			
             $monthlybilllist_id = $this->db->insert_id();
			
          
            
            return $monthlybilllist_id;
        }
       
	 $bankid= $this->input->post('bill_id');
		//die("fhbgf");
		
       $suss=  $this->db->update('monthlybillpayment', $data, array('bill_id' => $bankid));
	  
        return TRUE;
    }
    function delete_checkwriter($id) {
       
        $this->db->delete('checkwriter', array('checkwriter_id' => $id));
    }
    
   function print_check($id)
   {
	    $checkwriters = $this->db
                ->select('*')
				->where('checkwriter_id',$id)
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('checkwriter')
                ->result_array();
         return $checkwriters;
   }
   
   function bankaccount_list()
   
   {
	   $result =$this->db
                        ->select('*')
						->order_by("bank_name","asc")
                        ->get('banklist')
						//->group_by('bank_name')
						
                        ->result_array();
						// echo "<pre>";
						// print_r($result);
						return $result;
	   
   }
   function getaccountlist($bnkname)
   {
	  // $bnkname; 
	   $checkwriters = $this->db
                ->select('amount,check_cash_type')
                ->where('bankname',$bnkname)
                ->get('checkwriter')
                ->result_array();
         // echo "<pre>";
		 // print_r($checkwriters);
		$sum = 0;

foreach($checkwriters as $item) {
	$sum += $item['amount'];
}
 $sum; // output 5 
		 // echo "<pre>";
		 // print_r($sumarray);
	//$sum=  array_sum ($sumarray);
	$result= array("arraydata"=>$checkwriters,"total"=>$sum);
        return $result;
	   
   }
   

   
   
    

}

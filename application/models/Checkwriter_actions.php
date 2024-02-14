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
class Checkwriter_actions extends Base_model {

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

   
	
	
    public function checkwriter_list() {
       $checkwriters = $this->db
                ->select('checkwriter.*')
                ->get('checkwriter')
                ->result_array();
         foreach($checkwriters as $key => $checkwriter) {
			 
			 $q = $this->db->select('bank_name')
                    ->where('bank_id',$checkwriter['bankname'])
                     ->limit(1)->get('banklist');
            $curr_bank = $q->row_array();
            $checkwriter['banklist'] = $curr_bank['bank_name'];
            $checkwriters[$key] = $checkwriter;
		 }
		 // echo "<pre>";
		 // print_r($checkwriters);
		 // die("sdfsad");
		  $result['data'] = $checkwriters;
        return $result;
    }

    function get_checkwriter($petty_cash_id) {
		
		$checkwriter = $this->db
                ->select('checkwriter.*')
               
               /// ->join('checkwriter_cash_detail', 'checkwriter_cash_detail.checkwriter_id = checkwriter.checkwriter_id', 'LEFT')
                ->where('checkwriter.checkwriter_id', $petty_cash_id)
                //->group_by('checkwriter_cash_detail.checkwriter_id')
                ->get('checkwriter')
                ->row_array();
        $petty_cash_details = $this->db
                ->select('*')
                ->where('checkwriter_id', $petty_cash_id)
                ->get('checkwriter_cash_detail')
                ->result_array();
        //_custom_debug($petty_cash_details);
        $checkwriter['details'] = $petty_cash_details;
        return $checkwriter;
        
    }

    function save_checkwriter() {
		
		$data = array(
            'check_date' => $this->input->post('created_date'),
            'check_pay_to' => $this->input->post('payto'),
            'bankname' => $this->input->post('bank_name'),
            'description' => $this->input->post('description'),
            'account_no' => $this->input->post('bank_account_no'),
            'check_no' => $this->input->post('ca_no'),
            'amount' => $this->input->post('expense'),
            'check_cash_type' => $this->input->post('petty_cash_type'),
           
			 
        );
		
        $petty_detail_ids = $this->input->post('petty_detail_id');
        $petty_item_ids = $this->input->post('petty_item_id');
        $item_descriptions = $this->input->post('item_description');
        $amounts = $this->input->post('amount');
		 if ($this->input->post('checkwriter_id') == '0') {
           
            $this->db->insert('checkwriter', $data);
				
             $checkwriter_id = $this->db->insert_id();
			foreach ($amounts as $key => $amount) {
                $detail = array(
                    'checkwriter_id' => $checkwriter_id,
                    'check_item_id' => $petty_item_ids[$key],
                    'description' => $item_descriptions[$key],
                    'amount' => $amount);
					// echo "<pre>";
					// print_r($detail);
					// die("dsagf");
                $this->db->insert('checkwriter_cash_detail', $detail);
            }
          
            return $checkwriter_id;
        }
        $checkwriter_id = $this->input->post('checkwriter_id');
        foreach ($amounts as $key => $amount) {
            $detail = array(
                'checkwriter_id' => $checkwriter_id,
                'check_item_id' => $petty_item_ids[$key],
                'description' => $item_descriptions[$key],
                'amount' => $amount);
            if ($petty_detail_ids[$key] == '0') {
                $this->db->insert('checkwriter_cash_detail', $detail);
            } else {
                $this->db->update('checkwriter_cash_detail', $detail, array('id' => $petty_detail_ids[$key]));
            }
        }
		
       $suss=  $this->db->update('checkwriter', $data, array('checkwriter_id' => $checkwriter_id));
	  
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

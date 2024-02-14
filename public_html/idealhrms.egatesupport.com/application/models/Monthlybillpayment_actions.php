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
				->order_by('bill_id', 'DESC')
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
		  
		   foreach ($result['data'] as $key => $document) {
            $attachments = $this->db->select('*')->where(array('object'=> $document['bill_id'],'type'=> 'monthlybillno_file'))
                    ->get('attachments')->result_array();
            $document['attachments'] = $attachments;
            $result['data'][$key] = $document;
			$attachments2 = $this->db->select('*')->where(array('object'=> $document['bill_id'],'type'=> 'monthlybillpayment_file'))
                    ->get('attachments')->result_array();
            $document['attachments2'] = $attachments2;
            $result['data'][$key] = $document;
        }
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
		
		
		if(isset($_POST['paid_status']))
		{
			$status =$_POST['paid_status'];
		}
		else
		{
			$status =0;
		}
			
			$data = array(
            'bill_date' => $this->input->post('created_date'),
            'payto' => $this->input->post('payto'),
            'bill_no' => $this->input->post('bill_no'),
            'amount' => $this->input->post('amount'),
            'billing_period' => $this->input->post('billing_period'),
			'paid_status'=> $status,
           
			 
        );
		
	
        if ($this->input->post('bill_id') == '0') {
            
            $this->db->insert('monthlybillpayment', $data);
			
            $result =$monthlybilllist_id = $this->db->insert_id();
			
          
            
           // return $monthlybilllist_id; 
        }
		else
			
			{
				 //$monthlybilllist_id= $this->input->post('bill_id');
				
				// if(isset($this->input->post('paid_status')))
				// {
					// $paid_status= $this->input->post('paid_status');
				// }
				// else
				// {
					// $paid_status= 0;
				// }
				
				//$data['paid_status']=> $_POST['paid_status'];
				 // echo "<pre>";
				 // print_r($data);
				 // die("here");
				
				 
				 $suss=  $this->db->update('monthlybillpayment', $data, array('bill_id' => $this->input->post('bill_id')));
				 $result = TRUE;
				 $monthlybilllist_id= $this->input->post('bill_id');
			}
       
	
		//die("fhbgf");
		
      
	      $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('monthlybillno_file', $monthlybilllist_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('monthlybillpayment_file', $monthlybilllist_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
   
    }
    function monthlybillpayment_delete($id) {
       
        $this->db->delete('monthlybillpayment', array('bill_id' => $id));
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
   
   function monthlybill_list()
   
   {
	   $result =$this->db
                        ->select('*')
						->order_by("list_name","asc")
                        ->get('monthlybilllist')
						//->group_by('bank_name')
						
                        ->result_array();
						// echo "<pre>";
						// print_r($result);
						return $result;
	   
   }
   

   
   
    

}

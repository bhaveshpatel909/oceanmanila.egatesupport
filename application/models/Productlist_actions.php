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
class Productlist_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_productlist($id) {
        $result= $this->db
                        ->select('*')
                        ->where('product_id',$id)
						 ->get('productlist')
                        ->result_array();
						
						 
        
        //_custom_debug($query);
        return $result;
    }

   

    function delete_productlist($id) {
        $this->db->delete('productlist', array('product_id' => $id));
    }

	
	
	 	function status_productlist($cid, $status)
	{
		//$bankid= $this->input->post('id');
		//die("fhbgf");
		$data = array(
        
			'is_active'=> $status,
			);
       $suss=  $this->db->update('productlist', $data, array('product_id' => $cid));
	}
	
    public function product_list() {
        $productlist = $this->db
                ->select('*')
                // ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                // ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                // ->group_by('petty_cash_details.petty_cash_id')
                ->get('productlist')
                ->result_array();
				foreach ($productlist as $key => $product) {
            $attachments = $this->db->select('*')->where(array('object'=> $product['product_id'],'type'=> 'product_image'))
                    ->get('attachments')->result_array();
            $product['attachments'] = $attachments;
            $productlist[$key] = $product;
				}
      
        return $productlist;
    }

   

    function save_productlist() {
		
		
		
			
			$data = array(
            'product_name' => $this->input->post('product_name'),
            'sku' => $this->input->post('sku'),
            'remarks' => $this->input->post('remarks'),
			'product_date' => $this->input->post('product_date'),
			'is_active'=> 1,
           
			 
        );
		// echo "<pre>";
		// print_R($data);
		// echo "<pre>";
		// print_r($_FILES);
		// die("here");
		
	
        if ($this->input->post('id') == '0') {
            
            $this->db->insert('productlist', $data);
			
            $banklist_id = $this->db->insert_id();
			$this->load->model('attachments_actions');
          
             if (!$files1= $this->attachments_actions->upload_attachments('product_image', $banklist_id,'','ProductImages')) {
            return FALSE;
        }
		else
		{
	  
        return TRUE;
		}
            
        }
		else
		{
		
        
       
	 $bankid= $this->input->post('id');
		//die("fhbgf");
		
       $suss=  $this->db->update('productlist', $data, array('product_id' => $bankid));
	   $this->load->model('attachments_actions');
	  $attachment = $this->attachments_actions->get_attachments($bankid, 'product_image');
	  // echo "<pre>";
	  // print_R($attachment);
	  // die("here");
          
             if (!$files1= $this->attachments_actions->upload_product_attachments('product_image', $bankid,'','ProductImages',$attachment[0]['attachment_id'])) {
            return FALSE;
        }
		else
		{
	  
        return TRUE;
		}
		}
	  
    }

    

}
?>

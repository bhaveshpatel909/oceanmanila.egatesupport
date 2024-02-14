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
class Petty_actions extends Base_model {

    public function __construct() {
        parent::__construct();
    }

    public function get_petty_items() {
        return $this->db
                        ->select('*')
                        ->get('petty_item_setting')
                        ->result_array();
    }

    function get_petty_item($petty_item_id) {
        $this->db->select('*');
        $this->db->where('id', $petty_item_id);
        $query = $this->db->get('petty_item_setting');
        return $query->row_array();
    }

    function save_petty_item() {
        $data = array(
            'name' => $this->input->post('petty_item_name'),
        );

        if ($this->input->post('petty_item_id') == '0') {
            $this->db->insert('petty_item_setting', $data);
            return $this->db->insert_id();
        }

        $this->db->update('petty_item_setting', $data, array('id' => $this->input->post('petty_item_id')));
        return TRUE;
    }

    function delete_petty_item($petty_item_id) {
        $this->db->delete('petty_item_setting', array('id' => $petty_item_id));
    }

	
	
	 public function pppt() {
        return $this->db
                        ->select('*')
						
                        ->get('petty_cash')
						
                        ->result_array();
    }
	
	
    public function get_petty_cash_list() {
        $petty_cashs = $this->db
                ->select('petty_cash.*, SUM(petty_cash_details.amount) as total, employees.name as fullname')
                ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                ->group_by('petty_cash_details.petty_cash_id')
                ->get('petty_cash')
                ->result_array();
        /* $balance = 0;
          foreach ($petty_cashs as $key => $petty_cash) {
          $total_amount = $this->db
          ->select('SUM(id) as total')
          ->where('petty_cash_id', $petty_cash['petty_cash_id'])
          ->get('petty_cash_details')
          ->row_array();

          if($petty_cash['petty_cash_type'] == 'deposit') {
          $petty_cash['deposit'] = $total_amount['total'];
          $petty_cash['expense'] = 0;
          $balance = $balance + $total_amount['total'];
          } else {
          $petty_cash['expense'] = $total_amount['total'];
          $petty_cash['deposit'] = 0;
          $balance = $balance - $total_amount['total'];
          }
          $petty_cash['balance'] = $balance;
          $petty_cashs[$key] = $petty_cash;

          } */
        return $petty_cashs;
    } 
	
	
	public function get_petty_cash_list_exportitem($id) {
        $petty_cashsd = $this->db
                ->select('*')
              ->where('petty_cash_id', $id)
                ->get('petty_cash_details')
                ->result_array();
      
        return $petty_cashsd;
    }
	
 public function get_petty_cash_list_export($y,$m) {
        $petty_cashs = $this->db
                ->select('petty_cash.*, SUM(petty_cash_details.amount) as total,petty_cash_details.company,petty_cash_details.tin_no, employees.name as fullname')
                ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'FULL')
                ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'FULL')
				->where('petty_cash_id', 222)
				->where('month(created_date)', $m)
				->where('year(created_date)', $y)
				->order_by("id", "desc")
				//->where('year(created_date)', date('Y'))
                ->group_by('petty_cash_details.petty_cash_id')
				
                ->get('petty_cash')
                ->result_array();
        /* $balance = 0;
          foreach ($petty_cashs as $key => $petty_cash) {
          $total_amount = $this->db
          ->select('SUM(id) as total')
          ->where('petty_cash_id', $petty_cash['petty_cash_id'])
          ->get('petty_cash_details')
          ->row_array();

          if($petty_cash['petty_cash_type'] == 'deposit') {
          $petty_cash['deposit'] = $total_amount['total'];
          $petty_cash['expense'] = 0;
          $balance = $balance + $total_amount['total'];
          } else {
          $petty_cash['expense'] = $total_amount['total'];
          $petty_cash['deposit'] = 0;
          $balance = $balance - $total_amount['total'];
          }
          $petty_cash['balance'] = $balance;
          $petty_cashs[$key] = $petty_cash;

          } */
        return $petty_cashs;
    }

    function get_petty_cash($petty_cash_id) {
        $petty_cash = $this->db
                ->select('petty_cash.*, SUM(petty_cash_details.amount) as total, employees.name as employee_name')
                ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                ->where('petty_cash.petty_cash_id', $petty_cash_id)
                ->group_by('petty_cash_details.petty_cash_id')
                ->get('petty_cash')
                ->row_array();
        $petty_cash_details = $this->db
                ->select('*')
                ->where('petty_cash_id', $petty_cash_id)
                ->get('petty_cash_details')
                ->result_array();
        //_custom_debug($petty_cash_details);
        $petty_cash['details'] = $petty_cash_details;
        return $petty_cash;
    }

    function save_petty_cash() {
		
		
		// echo "<pre>";
		// print_r($_FILES);
		// die("dsgfd");
		$fileuploadname= $this->input->post('fileuploadname');
		 $fnamee= str_replace(" ","_",$fileuploadname);
		
      
		
		$gbb = $_FILES['new_attachments']['name'];
		$fname= str_replace(" ","_",$gbb);
		  $data = array(
            'ca_no' => $this->input->post('ca_no'),
            'petty_cash_type' => $this->input->post('petty_cash_type'),
            'created_date' => $this->input->post('created_date'),
            'description' => $this->input->post('description'),
			 'liquidated' => $this->input->post('alertchk'),
             'file' => $fname,
        );
		if($gbb != "")
		{
			$gb = $fname;
		
		$this->load->library('upload',array(
				'upload_path'=>BASEPATH.'../files/petty',
				'allowed_types'=>implode('|',$this->config->item('attachment_files')),
				'max_size'=>$this->config->item('max_file_size'),
				
			));
			
			$_FILES['new_attachments']=array(
					'name'=>$fname,
					'type'=>$_FILES['new_attachments']['type'],
					'tmp_name'=>$_FILES['new_attachments']['tmp_name'],
					'error'=>$_FILES['new_attachments']['error'],
					'size'=>$_FILES['new_attachments']['size']
				);
				if (!$this->upload->do_upload('new_attachments'))
				{
					$files['files']['failed'][]=sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' ');
					$this->upload->error_msg=array();
					continue;
				}
		
		
		}
		else{
			
			$data = array(
            'ca_no' => $this->input->post('ca_no'),
            'petty_cash_type' => $this->input->post('petty_cash_type'),
            'created_date' => $this->input->post('created_date'),
            'description' => $this->input->post('description'),
            'file' => $fnamee,
            'liquidated' => $this->input->post('alertchk'),
			 
        );
		}
		
		
        $employee_id = $this->input->post('employee_id');
        $data['employee_id'] = $employee_id[0];

        $petty_detail_ids = $this->input->post('petty_detail_id');
        $petty_item_ids = $this->input->post('petty_item_id');
        $item_descriptions = $this->input->post('item_description');
        $amounts = $this->input->post('amount');
        $company = $this->input->post('company');
        $tin = $this->input->post('tin');
		// echo "<pre>";
		// print_R($data);
		// die("dsfgdf");
	
        if ($this->input->post('petty_cash_id') == '0') {
           // $data['liquidated']=1;
			// echo "<pre>";
			// print_R($data);
			// die("dsfgdf");
            $this->db->insert('petty_cash', $data);
			 $petty_cash_id = $this->db->insert_id();
				$empdata=array('petteycashliquidate'=> 0);
			$this->db->update('employees', $empdata, array('employee_id' => $employee_id[0]));
           // echo $this->db->last_query();
            
			
          
            foreach ($amounts as $key => $amount) {
                $detail = array(
                    'petty_cash_id' => $petty_cash_id,
                    'petty_item_id' => $petty_item_ids[$key],
                    'description' => $item_descriptions[$key],
					 'company' => $company[$key],
                      'tin_no' => $tin[$key],
                    'amount' => $amount);
                $this->db->insert('petty_cash_details', $detail);
            }
            return $petty_cash_id;
        }
        $petty_cash_id = $this->input->post('petty_cash_id');
        foreach ($amounts as $key => $amount) {
            $detail = array(
                'petty_cash_id' => $petty_cash_id,
                'petty_item_id' => $petty_item_ids[$key],
                'description' => $item_descriptions[$key],
                'company' => $company[$key],
                'tin_no' => $tin[$key],
                'amount' => $amount);
            if ($petty_detail_ids[$key] == '0') {
                $this->db->insert('petty_cash_details', $detail);
            } else {
                $this->db->update('petty_cash_details', $detail, array('id' => $petty_detail_ids[$key]));
            }
        }
		
		$empdata=array('petteycashliquidate'=> $data['liquidated']);
		$this->db->update('employees', $empdata, array('employee_id' => $employee_id[0]));
       $suss=  $this->db->update('petty_cash', $data, array('petty_cash_id' => $petty_cash_id));
	   if($suss)
	   {
		   
		   $filename= $this->input->post('fileuploadname23');
		   $filename1= $this->input->post('fileuploadname');
		   if($filename=="")
		   {
			   if (file_exists(BASEPATH.'../files/petty/'.$filename))
			  {
				  @unlink(BASEPATH.'../files/petty/'.$filename);
				  
			  }
		   }
	   }
        return TRUE;
    }

    function delete_petty_cash($petty_cash_id) {
        $this->db->delete('petty_cash_details', array('petty_cash_id' => $petty_cash_id));
        $this->db->delete('petty_cash', array('petty_cash_id' => $petty_cash_id));
    }
    
    function preview_petty_cash($petty_cash_id) {
        $petty_cash = $this->db
                ->select('petty_cash.*, SUM(petty_cash_details.amount) as total, employees.name as employee_name')
                ->join('employees', 'employees.employee_id = petty_cash.employee_id', 'LEFT')
                ->join('petty_cash_details', 'petty_cash_details.petty_cash_id = petty_cash.petty_cash_id', 'LEFT')
                ->where('petty_cash.petty_cash_id', $petty_cash_id)
                ->group_by('petty_cash_details.petty_cash_id')
                ->get('petty_cash')
                ->row_array();
        $petty_cash_details = $this->db
                ->select('petty_cash_details.*, petty_item_setting.name as petty_item_name')
                ->join('petty_item_setting', 'petty_cash_details.petty_item_id = petty_item_setting.id', 'LEFT')
                ->where('petty_cash_id', $petty_cash_id)
                ->get('petty_cash_details')
                ->result_array();
        //_custom_debug($petty_cash_details);
        $petty_cash['details'] = $petty_cash_details;
        return $petty_cash;
    }
	function save_petty_comment()
	{
		//echo "<pre>";
		//print_R($_POST);
		$data=array('comment_p'=>$_POST['comment']);
		$suss=  $this->db->update('petty_cash', $data, array('petty_cash_id' => $_POST['pettyid']));
	}

}

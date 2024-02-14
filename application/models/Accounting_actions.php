<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Accounting_actions extends Base_model {

    function save_bir_file() {
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

		$mnthdate =  $this->input->post('for_themonth');
		$form_id =  $this->input->post('form_id');
        if ($this->input->post('bir_file_id') == '0') {
            $this->db->insert('bir_files', $data);
            $result = $bir_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_files', $data, array('bir_file_id' => $this->input->post('bir_file_id')));
            $result = TRUE;
            $bir_file_id = $this->input->post('bir_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files1= $this->attachments_actions->upload_attachments3('bir_file', $bir_file_id,$mnthdate,'BIRFileList')) {
            return FALSE;
        }
		
		
		$this->load->model('attachments_actions');
        if (!$files2 = $this->attachments_actions->upload_attachments4('bir_file2', $bir_file_id,$mnthdate,'BIRFileList')) {
            return FALSE;
        }
		// echo "<pre>";
		// print_R($files1);
		// echo "<pre>";
		// print_R($files2);
		$ss= $this->db
		->select('*')
		->where(array('form_id' => $form_id))
		//->order_by("form_name", "asc")
		->get('bir_forms')
		->row_array();
		
		        $account = $this->db
                ->select('setting_value')
                ->where(array('setting_key' => 'accounting_email'))
                ->get('settings')
                ->row_array();
		$to_email = $account['setting_value'];
		$subject =$mnthdate.'-BIR-'.$ss['form_name'].'- Report File';
		$attach_id1 = $files1['files']['success'][0]['id'];
		 $attach_id2 = $files2['files']['success'][0]['id'];
		//$attch_loc1 = get_bir_file_attach_new($attach_id1);
		$attch_loc1 =$this->db
                        ->select('*')
                        ->where(array('attachment_id' => $attach_id1))
                       // ->order_by("attachment_id", "desc")
                        ->get('attachments')
                        ->row_array();
		 $loc1 = $this->config->item('base_url').'files/attachments/'.$attch_loc1['location'];
		$attch_loc2 =$this->db
                        ->select('*')
                        ->where(array('attachment_id' => $attach_id2))
                       // ->order_by("attachment_id", "desc")
                        ->get('attachments')
                        ->row_array();
		 $loc2 = $this->config->item('base_url').'files/attachments/'.$attch_loc2['location'];
		
		$this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from('admin@peza.com.ph'); 
         $this->email->to($to_email);
         $this->email->subject($subject); 
         $this->email->message('Bir File Attachment'); 
         $this->email->attach($loc1); 
        $this->email->attach($loc2); 
   
         //Send mail 
         if($this->email->send()) 
		 {
			 //echo "sent";
		 }
		

        return array_merge($files1, array('result' => $result));
    }
	//**********************************************employeee benefit start*************************///
	 function save_bir_filee() {
		 
		
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_file_id') == '0') {
            $this->db->insert('bir_calnder_files_employee', $data);
            $result = $bir_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_calnder_files_employee', $data, array('bir_file_id' => $this->input->post('bir_file_id')));
            $result = TRUE;
            $bir_file_id = $this->input->post('bir_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments3('bir_file', $bir_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments4('bir_file2', $bir_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	
	
	
	
	function save_bir_calander_filee() {
		
	
		
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_c_file_id') == '0') {
            $this->db->insert('bir_calnder_files_employee', $data);
            $result = $bir_c_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_calnder_files_employee', $data, array('bir_c_file_id' => $this->input->post('bir_c_file_id')));
            $result = TRUE;
            $bir_c_file_id = $this->input->post('bir_c_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_calander_filee', $bir_c_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_calander_file23', $bir_c_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	
	
	//**********************************************employeee benefit end*************************///
	function save_bir_calander_file() {
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_c_file_id') == '0') {
            $this->db->insert('bir_calnder_files', $data);
            $result = $bir_c_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_calnder_files', $data, array('bir_c_file_id' => $this->input->post('bir_c_file_id')));
            $result = TRUE;
            $bir_c_file_id = $this->input->post('bir_c_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_calander_file', $bir_c_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_calander_file2', $bir_c_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	function save_bir_egate_file() {
		// echo "<pre>";
		// print_r($_POST);
		// die("dsf");
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_e_file_id') == '0') {
            $this->db->insert('bir_egate_files', $data);
            $result = $bir_e_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_egate_files', $data, array('bir_e_file_id' => $this->input->post('bir_e_file_id')));
            $result = TRUE;
            $bir_e_file_id = $this->input->post('bir_e_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_egate_file', $bir_e_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_egate_file2', $bir_e_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
		function save_bir_egate_filee() {
			
		
		
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_e_file_id') == '0') {
            $this->db->insert('bir_egate_files_employee', $data);
            $result = $bir_e_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_egate_files_employee', $data, array('bir_e_file_id' => $this->input->post('bir_e_file_id')));
            $result = TRUE;
            $bir_e_file_id = $this->input->post('bir_e_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_egate_filee', $bir_e_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_egate_file23', $bir_e_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	
	function save_bir_modory_file() {
		// echo "<pre>";
		// print_r($_POST);
		// die("dsf");
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_m_file_id') == '0') {
            $this->db->insert('bir_modory_files', $data);
            $result = $bir_m_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_modory_files', $data, array('bir_m_file_id' => $this->input->post('bir_m_file_id')));
            $result = TRUE;
            $bir_m_file_id = $this->input->post('bir_m_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_modory_file', $bir_m_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_modory_file2', $bir_m_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	function save_bir_modory_filee() {
		// echo "<pre>";
		// print_r($_POST);
		// die("dsf");
        $data = array(
            'form_id' => $this->input->post('form_id'),
            'for_themonth' => $this->input->post('for_themonth'),
			 'alertchk' => $this->input->post('alertchk'),
            'amount' => $this->input->post('amount'),
            'remarks' => $this->input->post('remarks'),
            'uploaded_date' => date('Y-m-d'),
            'reference' => $this->input->post('reference')
        );

        if ($this->input->post('bir_m_file_id') == '0') {
            $this->db->insert('bir_modory_files_employee', $data);
            $result = $bir_m_file_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_modory_files_employee', $data, array('bir_m_file_id' => $this->input->post('bir_m_file_id')));
            $result = TRUE;
            $bir_m_file_id = $this->input->post('bir_m_file_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_modory_filee', $bir_m_file_id)) {
            return FALSE;
        }
		
		$this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments2('bir_modory_file23', $bir_m_file_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	
	

    function get_bir_files() {
        return $this->db
                        ->select('bir_files.*, bir_forms.form_name')
                ->join('bir_forms', 'bir_forms.form_id = bir_files.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_files')
                        ->result_array();
    }
	function get_bir_calender_files() {
        return $this->db
                        ->select('bir_calnder_files.*, bir_forms.form_name')
                ->join('bir_forms', 'bir_forms.form_id = bir_calnder_files.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_calnder_files')
                        ->result_array();
    }
	
	function get_bir_calender_filese() {
        return $this->db->select('bir_calnder_files_employee.*,bir_forms_employee_benefit.form_name')
                 ->join('bir_forms_employee_benefit', 'bir_forms_employee_benefit.form_id = bir_calnder_files_employee.form_id', 'LEFT')
					 ->order_by("for_themonth", "asc")
                    ->get('bir_calnder_files_employee')
                      ->result_array();
		
                 
    }
	
	
	
	
	function get_bir_egate_files() {
        return $this->db
                        ->select('bir_egate_files.*, bir_forms.form_name')
                ->join('bir_forms', 'bir_forms.form_id = bir_egate_files.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_egate_files')
                        ->result_array();
    }
	
	
	function get_bir_egate_filese() {
        return $this->db
                        ->select('bir_egate_files_employee.*, bir_forms_employee_benefit.form_name')
                ->join('bir_forms_employee_benefit', 'bir_forms_employee_benefit.form_id = bir_egate_files_employee.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_egate_files_employee')
                        ->result_array();
    }
	
	function get_bir_modory_filese() {
        return $this->db
                        ->select('bir_modory_files_employee.*, bir_forms_employee_benefit.form_name')
                ->join('bir_forms_employee_benefit', 'bir_forms_employee_benefit.form_id = bir_modory_files_employee.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_modory_files_employee')
                        ->result_array();
    }
	
	
	function get_bir_modory_files() {
        return $this->db
                        ->select('bir_modory_files.*, bir_forms.form_name')
                ->join('bir_forms', 'bir_forms.form_id = bir_modory_files.form_id', 'LEFT')
						->order_by("for_themonth", "asc")
                        ->get('bir_modory_files')
                        ->result_array();
    }
	
	function updatealert()
	{
		echo $getid = $_GET['formid'];
		 $data = array(
            'form_id' => $this->input->Post('form_id'),
            'alertchk' => $this->input->post('for_themonth'),
			
        );
		return $this->db->update('bir_calnder_files', $data, array('bir_file_id' => $bir_file_id));
		
	}
	
	function update_bir_files($data,$bir_file_id)
	{
		// echo "<pre>";
		// print_R($data);
		 return $this->db->update('bir_files', $data, array('bir_file_id' => $bir_file_id));
	}
	function update_bir_calander_files($data,$bir_file_id)
	{
		// echo "<pre>";
		// print_R($data);
		 return $this->db->update('bir_calnder_files', $data, array('bir_c_file_id' => $bir_file_id));
	}

    function get_bir_file($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_file_id' => $bir_file_id))
                        ->get('bir_files')
                        ->row_array();
    }
	
	
    function get_bir_filee($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_file_id' => $bir_file_id))
                        ->get('bir_files_employee')
                        ->row_array();
    }
	
	
	
	function get_bir_calander_file($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_c_file_id' => $bir_file_id))
                        ->get('bir_calnder_files')
                        ->row_array();
    }
	
	function get_bir_calander_filee($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_c_file_id' => $bir_file_id))
                        ->get('bir_calnder_files_employee')
                        ->row_array();
    }
	
	
	function get_bir_egate_file($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_e_file_id' => $bir_file_id))
                        ->get('bir_egate_files')
                        ->row_array();
    }
	
	function get_bir_egate_filee($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_e_file_id' => $bir_file_id))
                        ->get('bir_egate_files_employee')
                        ->row_array();
    }
	
	function get_bir_modory_file($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_m_file_id' => $bir_file_id))
                        ->get('bir_modory_files')
                        ->row_array();
    }
	
	function get_bir_modory_filee($bir_file_id) {
        return $this->db
                        ->select('*')
                        ->where(array('bir_m_file_id' => $bir_file_id))
                        ->get('bir_modory_files_employee')
                        ->row_array();
    }
	
    
    function delete_bir_file($bir_file_id) {
        $this->db->delete('bir_files', array('bir_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_file', $bir_file_id);
    }
	function delete_bir_calander_file($bir_file_id) {
        $this->db->delete('bir_calnder_files', array('bir_c_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_calander_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_calander_file2', $bir_file_id);
    }
	function delete_bir_calander_filee($bir_file_id) {
        $this->db->delete('bir_calnder_files_employee', array('bir_c_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_calander_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_calander_file2', $bir_file_id);
    }
	function delete_bir_egate_file($bir_file_id) {
        $this->db->delete('bir_egate_files', array('bir_e_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_egate_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_egate_file2', $bir_file_id);
    }
	function delete_bir_egate_filee($bir_file_id) {
        $this->db->delete('bir_egate_files_employee', array('bir_e_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_egate_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_egate_file2', $bir_file_id);
    }
	
	
	function delete_bir_modory_file($bir_file_id) {
        $this->db->delete('bir_modory_files', array('bir_m_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_modory_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_modory_file2', $bir_file_id);
    }
	
	function delete_bir_modory_filee($bir_file_id) {
        $this->db->delete('bir_modory_files_employee', array('bir_m_file_id' => $bir_file_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_modory_file', $bir_file_id);
        $this->attachments_actions->remove_attachments('bir_modory_file2', $bir_file_id);
    }
	
	
	
	function get_bir_file_attach($bir_file_id, $type) {
        return $this->db
                        ->select('*')
                        ->where(array('object' => $bir_file_id))
                        ->where(array('type' => $type))
                        ->order_by("attachment_id", "desc")
                        ->get('attachments')
                        ->row_array();
    }
	function get_bir_file_attach_new($attachid) {
		echo $attachid;
        return $this->db
                        ->select('*')
                        ->where(array('attachment_id' => $attachid))
                       // ->order_by("attachment_id", "desc")
                        ->get('attachments')
                        ->row_array();
    }

	function get_bir_foerm() {
		$condition = 1;
        //return $this->db
		$ss= $this->db
		->select('*')
		->where(array('is_verified' => $condition))
		->order_by("form_name", "asc")
		->get('bir_forms')
		->result_array();
		return $ss;
		//print_r($ss);
		//die('1111');
    }
	
	function get_bir_foerme() {
		$condition = 1;
        //return $this->db
		$ss= $this->db
		->select('*')
		->where(array('is_verified' => $condition))
		->order_by("form_name", "asc")
		->get('bir_forms_employee_benefit')
		->result_array();
		return $ss;
		//print_r($ss);
		//die('1111');
    }
	
	
	
}

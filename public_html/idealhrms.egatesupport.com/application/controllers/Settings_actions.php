<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Settings_actions extends Base_model {

    private function load_settings($setting_group) {
        return $this->db
                        ->select('setting_key,setting_value')
                        ->where(array('setting_group' => $setting_group))
                        ->get('settings')
                        ->result_array();
    }

    function get_setting($setting_name) {
        $result = $this->db
                ->select('setting_value')
                ->where(array('setting_key' => $setting_name))
                ->get('settings')
                ->row_array();
        return $result['setting_value'];
    }

	function get_settingd() {
        $result = $this->db
                ->select('work_end')
                //->where(array('setting_key' => $setting_name))
                ->get('settings')
                ->row_array();
        return $result['work_end'];
    }
	

    function get_settings($setting_group) {
        foreach ($this->load_settings($setting_group) as $setting) {
            $new_settings[$setting['setting_key']] = $setting['setting_value'];
        }
        //print_r($new_settings);
        return $new_settings;
		
		//die();
    }
   function get_managersettings() {
        
        // $result = $this->db
                // ->select('setting_value')
                //->where(array('setting_key' => 'company_email'))
                // ->get('settings')
                // ->row_array();
        return "hhhhhhhhhhhhhhhhhhhhh";

        
    }
    function save_setting($setting_key, $setting_value) {
		//echo $setting_key;
		//echo $setting_value;
        $this->db->update('settings', array('setting_value' => $setting_value), array('setting_key' => $setting_key));
    }

    function save_settings($setting_group) {
		
		// echo '<pre>';
		// print_r($setting_group);
		// print_r($admin_email1);
		// print_r($task_manager_email1);
		// echo '</pre>';
		
		
		
        foreach ($this->load_settings($setting_group) as $setting) {
            if ($this->input->post($setting['setting_key'])) {
				
                $this->save_setting($setting['setting_key'], $this->input->post($setting['setting_key']));
            }
        }

        return TRUE;
    }
 function save_settingss($admin_email1,$task_manager_email1) {
		
		
		 $this->db->update('settings', array('setting_value' => $admin_email1), array('setting_key' => 'company_email_second'));
		 $this->db->update('settings', array('setting_value' => $task_manager_email1), array('setting_key' => 'company_email'));
		
        return TRUE;
    }
    function save_bir_form() {
        $data = array(
            'form_name' => $this->input->post('form_name'),
            'due_date' => $this->input->post('due_date'),
            'remarks' => $this->input->post('remarks'),
        );

        if ($this->input->post('form_id') == '0') {
            $this->db->insert('bir_forms', $data);
            $result = $form_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_forms', $data, array('form_id' => $this->input->post('form_id')));
            $result = TRUE;
            $form_id = $this->input->post('form_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_form', $form_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function get_bir_forms() {
        return $this->db
                        ->select('*')
                        ->get('bir_forms')
                        ->result_array();
    }
	
	 function get_bir_formsb() {
        return $this->db
                        ->select('*')
                        ->get('bir_forms_employee_benefit')
                        ->result_array();
    }
	
	///////////////////**************bir_forms_employee_benefit start//////////////////////
	   function get_bir_formb($form_id) {
        return $this->db
                        ->select('*')
                        ->where(array('form_id' => $form_id))
                        ->get('bir_forms_employee_benefit')
                        ->row_array();
    }
	
	function save_bir_formb() {
        $data = array(
			'form_name' => $this->input->post('form_name'),
            'due_date' => $this->input->post('due_date'),
            'remarks' => $this->input->post('remarks'),
			
			
        );

        if ($this->input->post('form_id') == '0') {
				
            $this->db->insert('bir_forms_employee_benefit', $data);
		    $result = $form_id = $this->db->insert_id();
        } else {
            $this->db->update('bir_forms_employee_benefit', $data, array('form_id' => $this->input->post('form_id')));
            $result = TRUE;
            $form_id = $this->input->post('form_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('bir_form', $form_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	function delete_bir_formb($form_id) {
        $this->db->delete('bir_forms_employee_benefit', array('form_id' => $form_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_form', $form_id);
    }
	
	///////////////////**************bir_forms_employee_benefit end//////////////////////
	

    function get_bir_form($form_id) {
        return $this->db
                        ->select('*')
                        ->where(array('form_id' => $form_id))
                        ->get('bir_forms')
                        ->row_array();
    }
	
	 function delete_bir_formg($form_id) {
        $this->db->delete('bir_forms', array('form_id' => $form_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_form', $form_id);
    }

    
    function delete_bir_form($form_id) {
        $this->db->delete('settings_licenses', array('form_id' => $form_id));

        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachments('bir_form', $form_id);
    }

}

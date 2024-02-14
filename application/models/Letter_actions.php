<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Letter_actions extends Base_model {

    function validate_fields() {
        switch ($this->input->post('report_category') . '_' . $this->input->post('report_type')) {
            
        }
    }

    function get_letters() {
        return $this->db
                        ->select('letters.*, letter_settings.name as letter_template_name')
                        ->join('letter_settings', 'letter_settings.id = letters.letter_template_id', 'LEFT')
                        ->get('letters')
                        ->result_array();
    }

    function get_letter($letter_id) {
        $letter = $this->db
                ->select('letters.*')
                ->where('letter_id', $letter_id)
                ->get('letters')
                ->row_array();
        //_custom_debug($letter);
        $letter['attention'] = json_decode($letter['attention'], TRUE);
        return $letter;
    }

    function letter_preview($letter_id) {
        $letter = $this->db
                ->select('letters.*')
                ->where('letter_id', $letter_id)
                ->get('letters')
                ->row_array();
        //_custom_debug($letter);
        //$letter['attention'] = json_decode($letter['attention'], TRUE);
        $letter['attention'] = implode('<br>', json_decode($letter['attention'], TRUE));
        return $letter;
    }

    function save_letter() {
        $data = array(
            'letter_date' => date('Y-m-d', strtotime($this->input->post('letter_date'))),
            'content' => $this->input->post('content'),
            'regarding' => $this->input->post('regarding'),
            'attention' => json_encode($this->input->post('attention')),
            'letter_template_id' => $this->input->post('letter_template_id'),
            'display_date' => $this->input->post('display_date') ? 1 : 0,
            'display_letter_to' => $this->input->post('display_letter_to') ? 1 : 0,
            'display_regarding' => $this->input->post('display_regarding') ? 1 : 0,
            'display_attention' => $this->input->post('display_attention') ? 1 : 0,
            'display_content' => $this->input->post('display_content') ? 1 : 0,
        );
        
        //$data['attention'] = json_decode($data['attention'], TRUE);
        //_custom_debug($data);
        if ($this->input->post('letter_id') == '0') {
            $this->db->insert('letters', $data);
            return $this->db->insert_id();
        }

        $this->db->update('letters', $data, array('letter_id' => $this->input->post('letter_id')));
        return TRUE;
    }

    function delete_letter($letter_id) {
        $this->db->delete('letters', array('letter_id' => $letter_id));
    }

    function get_employee_letters() {
        $this->db
                ->select('letters.letter_id, letters.date, setting_letters.name as reason_name, setting_letters.content as reason_content, setting_letters.name as action_name')
                ->join('letter_settings', 'setting_letters.id = letters.setting_letter_id', 'LEFT')
                ->where('employee_id', $this->session->current->userdata('employee_id'))
                ->order_by('date', 'DESC')
                ->limit(5)
                ->get('letters')
                ->result_array();
    }

    //Templates

    function get_setting_letters() {
        $query = $this->db
                ->select('*, CONCAT(name," [",IFNULL(remarks,"-"),"] ") as description', FALSE)
                ->get('letter_settings');
//        die($this->db->last_query());
        return $query->result_array();
    }

    function get_letter_template($setting_letter_id) {
        $this->db->select('*');
        $this->db->where('id', $setting_letter_id);

        $query = $this->db->get('letter_settings');
        return $query->row_array();
    }

    function save_setting_letter() {
        $data = array(
            'name' => $this->input->post('setting_letter_name'),
            'content' => $this->input->post('content'),
            'remarks' => $this->input->post('remarks')
        );

        if ($this->input->post('setting_letter_id') == '0') {
            $this->db->insert('letter_settings', $data);
            $result = $setting_letter_id = $this->db->insert_id();
        } else {
            $this->db->update('letter_settings', $data, array('id' => $this->input->post('setting_letter_id')));
            $result = TRUE;
            $setting_letter_id = $this->input->post('setting_letter_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('letter_setting', $setting_letter_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_setting_letter($setting_letter_id) {
        $this->db->delete('letter_settings', array('id' => $setting_letter_id));
    }

    function get_company_rules() {
        return $this->db
                        ->select('id, name, company_rules')
                        ->get('letter_settings')
                        ->result_array();
    }

    function get_letter_report() {
        $employee = $this->input->post('employee');
        if (isset($employee)) {
            $this->db->where('discipline.employee_id', (int) $employee[0]);
        }
        $disciplines = $this->db
                        ->select('SUM(discipline_actions.score) as discipline_score')
                        ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                        ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                        ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                        ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                        ->order_by('date')
                        ->get('discipline')->result_array();
//_custom_debug($disciplines);
        $letters = $this->db
                ->select('letters.letter_id, letters.date, employees.name as fullname, setting_letters.name as reason, letters.score')
                ->join('employees', 'employees.employee_id = letters.employee_id', 'LEFT')
                ->join('letter_settings', 'setting_letters.id = letters.setting_letter_id', 'LEFT')
                ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                ->order_by('date')
                ->get('letters')
                //echo($this->db->last_query());
                ->result_array();

        $data = array('discipline_score' => $disciplines[0]['discipline_score'], 'letters' => $letters);
        return $data;
    }

}

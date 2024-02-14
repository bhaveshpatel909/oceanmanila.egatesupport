<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Discipline_actions extends Base_model {

    function get_records($eid) {
		
		if($eid == 2) {
            $this->db->where('users.is_active',0);
        } elseif($eid == 1) {
            $this->db->where('users.is_active',1);
        }
		
        $disciplines = $this->db
                ->select('discipline.record_id, discipline.date, employees.name, discipline_reasons.name as reason, discipline_actions.name as action_taken,discipline.employee_id as empid')
                ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
				->join('users', 'users.employee_id = discipline.employee_id', 'LEFT')
                ->get('discipline')
                ->result_array();
        foreach ($disciplines as $key => $discipline) {
            $attachments = $this->db->select('*')->where(array('object' => $discipline['record_id'], 'type' => 'discipline'))
                            ->get('attachments')->result_array();
            //_custom_debug($this->db->last_query());
            $discipline['attachments'] = $attachments;
            $disciplines[$key] = $discipline;
        }


//        _custom_debug($disciplines);
        return $disciplines;
    }
	
	function get_recordsbyempid($id) {
        $disciplines = $this->db
                ->select('discipline.record_id, discipline.date, employees.name, discipline_reasons.name as reason, discipline_actions.name as action_taken')
                ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
				->where('discipline.employee_id', $id)
				->order_by('discipline.record_id', 'DESC')
                ->limit(5)
                ->get('discipline')
                ->result_array();
        foreach ($disciplines as $key => $discipline) {
            $attachments = $this->db->select('*')->where(array('object' => $discipline['record_id'], 'type' => 'discipline'))
                            ->get('attachments')->result_array();
            //_custom_debug($this->db->last_query());
            $discipline['attachments'] = $attachments;
            $disciplines[$key] = $discipline;
        }


//        _custom_debug($disciplines);
        return $disciplines;
    }

    function get_record($record_id) {
        return $this->db
                        ->select('discipline.*, employees.name as fullname,employees.position_id, employees.department_id, positions.position_name, departments.department_name,discipline_reasons.name as reason_name, discipline_reasons.content as reason_content, discipline_actions.name as action_name,discipline_reasons.categoryid as ecatgry')
                        ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                        ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                        ->where('record_id', $record_id)
                        ->get('discipline')
                        ->row_array();
    }

    function record_preview($record_id) {
        return $this->db
                        ->select('discipline.*, employees.name as fullname, employees.avatar, employees.position_id, employees.department_id, positions.position_name, departments.department_name,discipline_reasons.name as reason_name, discipline_reasons.content as reason_content, discipline_actions.name as action_name')
                        ->join('employees', 'employees.employee_id = discipline.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                        ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                        ->where('record_id', $record_id)
                        ->get('discipline')
                        ->row_array();
    }

    function save_record() {
        $data = array(
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'content' => $this->input->post('content'),
            'remark' => $this->input->post('remark'),
            'discipline_reason_id' => $this->input->post('discipline_reason_id'),
            'discipline_action_id' => $this->input->post('discipline_action_id')
        );

        if ($this->input->post('record_id') == '0') {
            $employee_id = $this->input->post('employee_id');
            $data['employee_id'] = $employee_id[0];
            $this->db->insert('discipline', $data);
            $result = $record_id = $this->db->insert_id();
        } else {
            $this->db->update('discipline', $data, array('record_id' => $this->input->post('record_id')));
            $result = TRUE;
            $record_id = $this->input->post('record_id');
        }


        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments('discipline', $record_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

    function delete_record($record_id) {
        $this->db->delete('attachments', array('object' => $record_id, 'type' => 'discipline'));
        $this->db->delete('discipline', array('record_id' => $record_id));
    }

    function get_employee_records() {
        $this->db
                ->select('discipline.record_id, discipline.date, discipline_reasons.name as reason_name, discipline_reasons.content as reason_content, discipline_actions.name as action_name')
                ->join('discipline_reasons', 'discipline_reasons.id = discipline.discipline_reason_id', 'LEFT')
                ->join('discipline_actions', 'discipline_actions.id = discipline.discipline_action_id', 'LEFT')
                ->where('employee_id', $this->session->current->userdata('employee_id'))
                ->order_by('date', 'DESC')
                ->limit(5)
                ->get('discipline')
                ->result_array();
    }

    function save_comment() {
        $this->db->update('discipline', array('comment' => $this->input->post('comment')), array('record_id' => $this->input->post('record_id'), 'employee_id' => $this->session->current->userdata('employee_id')));
    }

    function get_discipline_actions() {
        return $this->db
                        ->select('*')
                        ->get('discipline_actions')
                        ->result_array();
    }
	
	function get_discipline_category() {
        return $this->db
                        ->select('*')
						->order_by('name', 'ASC')
                        ->get('discipline_category')
                        ->result_array();
    }
	
	function get_evaluation_category() {
        return $this->db
                        ->select('*')
						->order_by('name', 'ASC')
                        ->get('evaluation_category')
                        ->result_array();
    }
	
	
	function get_disp($empid) {
        $this->db->where('employee_id', $empid);
$num_rows = $this->db->count_all_results('discipline');
         return $num_rows;
    }
	
	
	
	
	function get_discipline_categorybyid($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('discipline_category');
        return $query->row_array();
    }
	
	function get_evaluation_categorybyid($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('evaluation_category');
        return $query->row_array();
    }

    function get_discipline_action($discipline_action_id) {
        $this->db->select('*');
        $this->db->where('id', $discipline_action_id);
        $query = $this->db->get('discipline_actions');
        return $query->row_array();
    }

    function save_discipline_action() {
        $data = array(
            'name' => $this->input->post('discipline_action_name'),
            'score' => $this->input->post('discipline_action_score'),
        );

        if ($this->input->post('discipline_action_id') == '0') {
            $this->db->insert('discipline_actions', $data);
            return $this->db->insert_id();
        }

        $this->db->update('discipline_actions', $data, array('id' => $this->input->post('discipline_action_id')));
        return TRUE;
    }

    function delete_discipline_action($discipline_action_id) {
        $this->db->delete('discipline_actions', array('id' => $discipline_action_id));
    }

	function save_discipline_category() {
        $data = array(
            'name' => $this->input->post('discipline_category_name'),
            
        );

        if ($this->input->post('discipline_category_id') == '0') {
            $this->db->insert('discipline_category', $data);
            return $this->db->insert_id();
        }

        $this->db->update('discipline_category', $data, array('id' => $this->input->post('discipline_category_id')));
        return TRUE;
    }
	
	function delete_discipline_category($id) {
        $this->db->delete('discipline_category', array('id' => $id));
    }
	
	function delete_evaluation_category($id) {
        $this->db->delete('evaluation_category', array('id' => $id));
    }
	
	function save_evaluation_category() {
        $data = array(
            'name' => $this->input->post('evaluation_category_name'),
            
        );

        if ($this->input->post('evaluation_category_id') == '0') {
            $this->db->insert('evaluation_category', $data);
            return $this->db->insert_id();
        }

        $this->db->update('evaluation_category', $data, array('id' => $this->input->post('evaluation_category_id')));
        return TRUE;
    }
	
    //Reasons

    function get_discipline_reasons($id="") {
		if($id == ""){
			return $this->db
                        ->select('discipline_reasons.*, CONCAT(discipline_reasons.name," [",IFNULL(discipline_reasons.remarks,"-"),"] ") as description,discipline_category.name as category', FALSE)
						->join('discipline_category', 'discipline_category.id = discipline_reasons.categoryid', 'LEFT')
                        ->get('discipline_reasons')
                        ->result_array();
		}else{
			return $this->db
                        ->select('discipline_reasons.*, CONCAT(discipline_reasons.name," [",IFNULL(discipline_reasons.remarks,"-"),"] ") as description,discipline_category.name as category', FALSE)
						->join('discipline_category', 'discipline_category.id = discipline_reasons.categoryid', 'LEFT')
						->where('discipline_reasons.categoryid', $id)
                        ->get('discipline_reasons')
                        ->result_array();
		}
    }

    function get_discipline_reason($discipline_reason_id) {
        $this->db->select('*');
        $this->db->where('id', $discipline_reason_id);
        $query = $this->db->get('discipline_reasons');
        return $query->row_array();
    }

    function save_discipline_reason() {
        $data = array(
            'name' => $this->input->post('discipline_reason_name'),
            'company_rules' => $this->input->post('company_rules'),
            'content' => $this->input->post('content'),
            'categoryid' => $this->input->post('discipline_reason_category'),
            'score' => $this->input->post('score'),
            'remarks' => $this->input->post('discipline_reason_remarks')
        );
		
        if ($this->input->post('discipline_reason_id') == '0') {
            $this->db->insert('discipline_reasons', $data);
            return $this->db->insert_id();
        }

        $this->db->update('discipline_reasons', $data, array('id' => $this->input->post('discipline_reason_id')));
        return TRUE;
    }

    function delete_discipline_reason($discipline_reason_id) {
        $this->db->delete('discipline_reasons', array('id' => $discipline_reason_id));
    }

    function get_company_rules() {
        return $this->db
                        ->select('id, name, company_rules')
                        ->get('discipline_reasons')
                        ->result_array();
    }
	
	function get_evaluation_list() {
        $query = $this->db
			->select('*, CONCAT(name," [",IFNULL(remarks,"-"),"] ") as description', FALSE)
			->get('evaluation_list');
        return $query->result_array();
    }
	
	function save_evaluation() {
        $data = array(
            'name' => $this->input->post('evaluation_name'),
            'company_rules' => $this->input->post('company_rules'),
            'content' => $this->input->post('content'),
            'remarks' => $this->input->post('evaluation_remarks')
        );

        if ($this->input->post('evaluation_id') == '0') {
            $this->db->insert('evaluation_list', $data);
            return $this->db->insert_id();
        }

        $this->db->update('evaluation_list', $data, array('id' => $this->input->post('evaluation_id')));
        return TRUE;
    }
	
	function get_evaluationbyid($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('evaluation_list');
        return $query->row_array();
    }
	
	function delete_evaluation($id) {
        $this->db->delete('evaluation_list', array('id' => $id));
    }

}

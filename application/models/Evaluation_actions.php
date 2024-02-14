<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Evaluation_actions extends Base_model {
    
    function validate_fields() {
        switch ($this->input->post('report_category') . '_' . $this->input->post('report_type')) {
            
        }
    }

    function get_evaluations($eid) {
		if($eid == 2) {
            $this->db->where('users.is_active',0);
        } elseif($eid == 1) {
            $this->db->where('users.is_active',1);
        }
		
        return $this->db
                        ->select('evaluations.evaluation_id, evaluations.date, employees.name, evaluation_templates.name as reason, evaluations.score,evaluations.employee_id as empid')
                        ->join('employees', 'employees.employee_id = evaluations.employee_id', 'LEFT')
                        ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
						->join('users', 'users.employee_id = evaluations.employee_id', 'LEFT')
                        ->get('evaluations')
                        ->result_array();
    }

    function get_evaluation($evaluation_id) {
		
	
        return $this->db
                        ->select('evaluations.*, employees.name as fullname,employees.position_id, employees.department_id, positions.position_name, departments.department_name,evaluation_templates.name as evaluation_name, evaluation_templates.content as evaluation_content,evaluation_templates.ecatgoryid as ecatgry')
                        ->join('employees', 'employees.employee_id = evaluations.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                        ->where('evaluation_id', $evaluation_id)
                        ->get('evaluations')
                        ->row_array();
    }

    function evaluation_preview($evaluation_id) {
        return $this->db
                        ->select('evaluations.*, employees.name as fullname, employees.avatar, employees.position_id, employees.department_id, positions.position_name, departments.department_name,evaluation_templates.name as evaluation_name, evaluations.content as evaluation_content')
                        ->join('employees', 'employees.employee_id = evaluations.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                        ->where('evaluation_id', $evaluation_id)
                        ->get('evaluations')
                        ->row_array();
    }

    function save_evaluation() {
		// echo'<pre>';
		// print_r($_POST);
		// echo'<pre>';
		// die('mmooddll');
        $data = array(
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'content' => $this->input->post('content'),
            'remark' => $this->input->post('remark'),
            'evaluation_template_id' => $this->input->post('evaluation_template_id'),
            'score' => $this->input->post('score')
        );

        if ($this->input->post('evaluation_id') == '0') {
            $employee_id = $this->input->post('employee_id');
            $data['employee_id'] = $employee_id[0];
            $this->db->insert('evaluations', $data);
            return $this->db->insert_id();
        }

        $this->db->update('evaluations', $data, array('evaluation_id' => $this->input->post('evaluation_id')));
        return TRUE;
    }

    function delete_evaluation($evaluation_id) {
        $this->db->delete('evaluations', array('evaluation_id' => $evaluation_id));
    }

    function get_employee_evaluations() {
        $this->db
                ->select('evaluations.evaluation_id, evaluations.date, evaluation_templates.name as reason_name, evaluation_templates.content as reason_content, evaluation_templates.name as action_name')
                ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                ->where('employee_id', $this->session->current->userdata('employee_id'))
                ->order_by('date', 'DESC')
                ->limit(5)
                ->get('evaluations')
                ->result_array();
    }
	
	function get_evaluations_employeeid($empid) {
       return $this->db
                ->select('evaluations.evaluation_id, evaluations.date, employees.name, evaluation_templates.name as reason, evaluations.score')
				->join('employees', 'employees.employee_id = evaluations.employee_id', 'LEFT')
				->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                ->where('evaluations.employee_id', $empid)
				->order_by('evaluations.evaluation_id', 'DESC')
                ->limit(5)
                ->get('evaluations')
                ->result_array();
    }

    //Templates

	function get_evaluation_templates($id="") {
		if($id == ""){
			$query = $this->db
                        ->select('evaluation_templates.*, CONCAT(evaluation_templates.name," [",IFNULL(evaluation_templates.remarks,"-"),"] ") as description,evaluation_category.name as ecategory', FALSE)
						->join('evaluation_category', 'evaluation_category.id = evaluation_templates.ecatgoryid', 'LEFT')
                        ->get('evaluation_templates');
        return $query->result_array();
		}else{
                        $query = $this->db
                        ->select('evaluation_templates.*, CONCAT(evaluation_templates.name," [",IFNULL(evaluation_templates.remarks,"-"),"] ") as description,evaluation_category.name as ecategory', FALSE)
						->join('evaluation_category', 'evaluation_category.id = evaluation_templates.ecatgoryid', 'LEFT')
						->where('evaluation_templates.ecatgoryid', $id)
                        ->get('evaluation_templates');
        return $query->result_array();
						
                        
		}
    }
	

    function get_evaluation_template($evaluation_template_id) {
        $this->db->select('*');
        $this->db->where('id', $evaluation_template_id);
        $query = $this->db->get('evaluation_templates');
        return $query->row_array();
    }  

	function get_eva($empid) {
        $this->db->where('employee_id', $empid);
$num_rows = $this->db->count_all_results('evaluations');
         return $num_rows;
    }

    function save_evaluation_template() {
        $data = array(
            'name' => $this->input->post('evaluation_template_name'),
            'company_rules' => $this->input->post('company_rules'),
            'content' => $this->input->post('content'),
            'ecatgoryid' => $this->input->post('evaluation_template_category'),
            'score' => $this->input->post('score'),
            'remarks' => $this->input->post('evaluation_template_remarks')
        );

        if ($this->input->post('evaluation_template_id') == '0') {
            $this->db->insert('evaluation_templates', $data);
            return $this->db->insert_id();
        }

        $this->db->update('evaluation_templates', $data, array('id' => $this->input->post('evaluation_template_id')));
        return TRUE;
    }

    function delete_evaluation_template($evaluation_template_id) {
        $this->db->delete('evaluation_templates', array('id' => $evaluation_template_id));
    }

    function get_company_rules() {
        return $this->db
                        ->select('id, name, company_rules')
                        ->get('evaluation_templates')
                        ->result_array();
    }

    function get_evaluation_report() {
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
        $evaluations = $this->db
                ->select('evaluations.evaluation_id, evaluations.date, employees.name as fullname, evaluation_templates.name as reason, evaluations.score')
                ->join('employees', 'employees.employee_id = evaluations.employee_id', 'LEFT')
                ->join('evaluation_templates', 'evaluation_templates.id = evaluations.evaluation_template_id', 'LEFT')
                ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                ->order_by('date')
                ->get('evaluations')
        //echo($this->db->last_query());
        ->result_array();
        
        $data = array('discipline_score' => $disciplines[0]['discipline_score'], 'evaluations' => $evaluations);
        return $data;
        
    }

}

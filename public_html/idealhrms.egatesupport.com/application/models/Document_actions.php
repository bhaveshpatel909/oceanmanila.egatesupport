<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Document_actions extends Base_model {
    
    function validate_fields() {
        switch ($this->input->post('report_category') . '_' . $this->input->post('report_type')) {
            
        }
    }

    function get_documents($eid) {
		if($eid == 2) {
            $this->db->where('users.is_active',0);
        } elseif($eid == 1) {
            $this->db->where('users.is_active',1);
        }
		
        return $this->db
                        ->select('documents.document_id, documents.date, employees.name, document_templates.name as reason, documents.score,documents.employee_id as empid')
                        ->join('employees', 'employees.employee_id = documents.employee_id', 'LEFT')
                        ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
						->join('users', 'users.employee_id = documents.employee_id', 'LEFT')
                        ->get('documents')
                        ->result_array();
    }

    function get_document($document_id) {
		
	
        return $this->db
                        ->select('documents.*, employees.name as fullname,employees.position_id, employees.department_id, positions.position_name, departments.department_name,document_templates.name as document_name, document_templates.content as document_content,document_templates.ecatgoryid as ecatgry')
                        ->join('employees', 'employees.employee_id = documents.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                        ->where('document_id', $document_id)
                        ->get('documents')
                        ->row_array();
    }

    function document_preview($document_id) {
        return $this->db
                        ->select('documents.*, employees.name as fullname, employees.avatar, employees.position_id, employees.department_id, positions.position_name, departments.department_name,document_templates.name as document_name, documents.content as document_content')
                        ->join('employees', 'employees.employee_id = documents.employee_id', 'LEFT')
                        ->join('positions', 'positions.position_id = employees.position_id', 'LEFT')
                        ->join('departments', 'departments.department_id = employees.department_id', 'LEFT')
                        ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                        ->where('document_id', $document_id)
                        ->get('documents')
                        ->row_array();
    }

    function save_document() {
		// echo'<pre>';
		// print_r($_POST);
		// echo'<pre>';
		// die('mmooddll');
        $data = array(
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'content' => $this->input->post('content'),
            'remark' => $this->input->post('remark'),
            'document_template_id' => $this->input->post('document_template_id'),
            'score' => $this->input->post('score')
        );

        if ($this->input->post('document_id') == '0') {
            $employee_id = $this->input->post('employee_id');
            $data['employee_id'] = $employee_id[0];
            $this->db->insert('documents', $data);
            return $this->db->insert_id();
        }

        $this->db->update('documents', $data, array('document_id' => $this->input->post('document_id')));
        return TRUE;
    }

    function delete_document($document_id) {
        $this->db->delete('documents', array('document_id' => $document_id));
    }

    function get_employee_documents() {
        $this->db
                ->select('documents.document_id, documents.date, document_templates.name as reason_name, document_templates.content as reason_content, document_templates.name as action_name')
                ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->where('employee_id', $this->session->current->userdata('employee_id'))
                ->order_by('date', 'DESC')
                ->limit(5)
                ->get('documents')
                ->result_array();
    }
	
	function get_documents_employeeid($empid) {
       return $this->db
                ->select('documents.document_id, documents.date, employees.name, document_templates.name as reason, documents.score')
				->join('employees', 'employees.employee_id = documents.employee_id', 'LEFT')
				->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->where('documents.employee_id', $empid)
				->order_by('documents.document_id', 'DESC')
                ->limit(5)
                ->get('documents')
                ->result_array();
    }

    //Templates

	function get_document_templates($id="") {
		if($id == ""){
			$query = $this->db
                        ->select('document_templates.*, CONCAT(document_templates.name," [",IFNULL(document_templates.remarks,"-"),"] ") as description,document_category.name as ecategory', FALSE)
						->join('document_category', 'document_category.id = document_templates.ecatgoryid', 'LEFT')
                        ->get('document_templates');
        return $query->result_array();
		}else{
                        $query = $this->db
                        ->select('document_templates.*, CONCAT(document_templates.name," [",IFNULL(document_templates.remarks,"-"),"] ") as description,document_category.name as ecategory', FALSE)
						->join('document_category', 'document_category.id = document_templates.ecatgoryid', 'LEFT')
						->where('document_templates.ecatgoryid', $id)
                        ->get('document_templates');
        return $query->result_array();
						
                        
		}
    }
	
	function get_document_temp($document_id) {
		   return $this->db
                ->select('documents.document_id, documents.date, document_templates.name as reason_name, document_templates.content as reason_content, document_templates.name as action_name')
                ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->where('employee_id', $document_id)
                ->order_by('date', 'DESC')
                ->limit(5)
                ->get('documents')
                ->result_array();
    }
	

    function get_document_template($document_template_id) {
        $this->db->select('*');
        $this->db->where('id', $document_template_id);
        $query = $this->db->get('document_templates');
        return $query->row_array();
    }  

	function get_eva($empid) {
        $this->db->where('employee_id', $empid);
$num_rows = $this->db->count_all_results('documents');
         return $num_rows;
    }

    function save_document_template() {
        $data = array(
            'name' => $this->input->post('document_template_name'),
            'company_rules' => $this->input->post('company_rules'),
            'content' => $this->input->post('content'),
            'ecatgoryid' => $this->input->post('document_template_category'),
            'score' => $this->input->post('score'),
            'remarks' => $this->input->post('document_template_remarks')
        );

        if ($this->input->post('document_template_id') == '0') {
            $this->db->insert('document_templates', $data);
            return $this->db->insert_id();
        }

        $this->db->update('document_templates', $data, array('id' => $this->input->post('document_template_id')));
        return TRUE;
    }

    function delete_document_template($document_template_id) {
        $this->db->delete('document_templates', array('id' => $document_template_id));
    }

    function get_company_rules() {
        return $this->db
                        ->select('id, name, company_rules')
                        ->get('document_templates')
                        ->result_array();
    }

    function get_document_report() {
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
        $documents = $this->db
                ->select('documents.document_id, documents.date, employees.name as fullname, document_templates.name as reason, documents.score')
                ->join('employees', 'employees.employee_id = documents.employee_id', 'LEFT')
                ->join('document_templates', 'document_templates.id = documents.document_template_id', 'LEFT')
                ->where(array('date >= ' => date('Y-m-d', strtotime($this->input->post('start_date'))), 'date <= ' => date('Y-m-d', strtotime($this->input->post('end_date')))))
                ->order_by('date')
                ->get('documents')
        //echo($this->db->last_query());
        ->result_array();
        
        $data = array('discipline_score' => $disciplines[0]['discipline_score'], 'documents' => $documents);
        return $data;
        
    }

}

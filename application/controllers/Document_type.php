<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property user_actions          $user_actions
 * @property settings_actions          $settings_actions
 * @property mix_actions          $mix_actions
 * @property positions_actions          $positions_actions
 * @property departments_actions          $departments_actions
 */
class Document_type extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_actions');
        $this->load->model('document_type_actions');
    }
    
    function index() {
        $this->load->view('document_type/index', array('document_typelist' => $this->document_type_actions->get_201_document_type()));
    }
	function new_document_type() {
        $this->load->view('document_type/document_type_new');
    }
	 function save_document_type() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'department_id', 'rules' => 'required', 'label' => 'document_type_id'),
            array('field' => 'department_name', 'rules' => 'required', 'label' => $this->lang->line('document_type name')),
            array('field' => 'days_to_alert', 'rules' => 'required', 'label' => $this->lang->line('Days to alert')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        if (!$result = $this->document_type_actions->save_document_type()) {
            exit($this->load->view('layout/error', array('message' => $this->document_type_actions->get_error()), TRUE));
        }

        $this->load->view('document_type/document_type_add', array('result' => $result));
    }
	 function edit_document_type($department_id = 0) {
        $this->load->view('document_type/document_type_edit', array(
            'department' => $this->document_type_actions->get_document_type($department_id),
                //'skills'=>$this->departments_actions->get_required_skills($department_id),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }
	function delete_document_type() {
        $this->document_type_actions->delete_document_type($this->input->post('department_id'));
        $this->load->view('document_type/document_type_delete', array('department_id' => $this->input->post('department_id')));
    }
}
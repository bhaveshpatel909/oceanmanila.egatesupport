<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_letter $db
 * @property CI_Session          $session
 * @property letter_actions          $letter_actions
 */
class Letter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('letter');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('letter_actions');
        $this->load->view('letter/index', array('letters' => $this->letter_actions->get_letters()));
    }

    function edit_letter($letter_id = 0) {
        $this->load->model('letter_actions');
        $letter_templates = $this->letter_actions->get_setting_letters();
        $this->load->view('letter/letter_edit', array('letter' => $this->letter_actions->get_letter($letter_id), 'letter_templates' => $letter_templates));
    }

    function save_letter() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'letter_id', 'rules' => 'required', 'label' => 'letter_id'),
            array('field' => 'letter_template_id', 'rules' => 'required', 'label' => $this->lang->line('Letter Template')),
            array('field' => 'letter_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
            array('field' => 'letter_to', 'rules' => 'required', 'label' => $this->lang->line('To')),
            array('field' => 'regarding', 'rules' => 'required', 'label' => $this->lang->line('Regarding')),
//            array('field' => 'attention', 'rules' => 'required', 'label' => $this->lang->line('Attention')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('letter_actions');
        $this->load->view('letter/letter_add', array('result' => $this->letter_actions->save_letter()));
    }

    function delete_letter() {
        $this->load->model('letter_actions');
        $this->letter_actions->delete_letter($this->input->post('letter_id'));
        $this->load->view('letter/letter_delete', array('letter_id' => $this->input->post('letter_id')));
    }

    function new_letter() {
        $this->load->model('letter_actions');
        $letter_templates = $this->letter_actions->get_setting_letters();
        $this->load->view('letter/letter_new', array('letter_templates' => $letter_templates));
    }

    function preview_letter($letter_id = 0) {
				
        $this->load->model('letter_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $company_name = $this->settings_actions->get_setting('company_name');
        $letter = $this->letter_actions->letter_preview($letter_id);
        //PDF generating
        $html = $this->load->view('letter/letter_preview', array('letter' => $letter, 'logo' => $logo,'company_name' => $company_name), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $letter['letter_date']) . "_letter.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }

    //Reasons

    function letter_templates() {
        $this->load->model('letter_actions');
        $this->load->view('letter/letter_templates', array('letter_templates' => $this->letter_actions->get_letter_templates()));
    }

    function new_letter_template() {
        $this->load->view('letter/letter_template_new');
    }

    function get_letter_template() {
        $letter_template_id = $this->input->post('letter_template_id');
        $this->load->model('letter_actions');
        $data = array('letter_template' => $this->letter_actions->get_letter_template($letter_template_id));
        die(json_encode($data));
    }

    function edit_letter_template($letter_template_id = 0) {
        $this->load->model('letter_actions');
        $this->load->view('letter/letter_template_edit', array('letter_template' => $this->letter_actions->get_letter_template($letter_template_id)));
    }

    function save_letter_template() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'letter_template_id', 'rules' => 'required', 'label' => 'letter_template_id'),
            array('field' => 'letter_template_name', 'rules' => 'required', 'label' => $this->lang->line('letter_template_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('letter_actions');
        $this->load->view('letter/letter_template_add', array('result' => $this->letter_actions->save_letter_template()));
    }

    function delete_letter_template() {
        $this->load->model('letter_actions');
        $this->letter_actions->delete_letter_template($this->input->post('letter_template_id'));
        $this->load->view('letter/letter_template_delete', array('letter_template_id' => $this->input->post('letter_template_id')));
    }
    
    function employee_letter() {
        $this->load->view('reports/letter/index');
    }

    function report_letter() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'report_category', 'rules' => 'required', 'label' => 'report_category'),
            array('field' => 'report_type', 'rules' => 'required', 'label' => 'report_type'),
            array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start date')),
            array('field' => 'end_date', 'rules' => 'required', 'label' => $this->lang->line('End date'))
        ));

        $this->load->model('letter_actions');
        $this->letter_actions->validate_fields();

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $postData = $this->input->post();
        //_custom_debug($this->letter_actions->get_letter_report());
        $this->load->view('reports/' . $this->input->post('report_category') . '/' . $this->input->post('report_type'), array('data' => $this->letter_actions->get_letter_report(), 'postdata' => json_encode($postData)));
    }

}
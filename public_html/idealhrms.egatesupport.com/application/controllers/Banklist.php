<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_petty_cash $db
 * @property CI_Session          $session
 * @property petty_actions          $petty_actions
 */
class Banklist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('banklist_actions');
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('banklist/index', array('banklist' => $this->banklist_actions->bank_list()));
        } else {
            $this->load->view('banklist/index', array('banklist' => $this->banklist_actions->bank_list()));
        }
    }
        
    function new_banklist() {
        $this->load->model('banklist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('banklist/banklist_new');
		
     
        
    }

    function edit_banklist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('banklist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('banklist/banklist_edit', array(
            'banklist' => $this->banklist_actions->get_banklist($id)
           
        ));
    }

    function save_banklist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'bank_name', 'rules' => 'required', 'label' => 'petty_cash_id'),
            array('field' => 'account_no', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'contact_no', 'rules' => 'required', 'label' => 'Contact No'),
            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('banklist_actions');
        $this->load->view('banklist/banklist_add', array('result' => $this->banklist_actions->save_bank_list()));
    }

    function delete_banklist() {
        $this->load->model('banklist_actions');
        $this->banklist_actions->delete_banklist($this->input->post('id'));
        $this->load->view('banklist/banklist_delete', array('bank_id' => $this->input->post('id')));
    }

    function preview_petty_cash($petty_cash_id = 0) {
        $this->load->model('petty_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $petty_cash = $this->petty_actions->preview_petty_cash($petty_cash_id);
        //PDF generating
        $html = $this->load->view('petty/petty_cash_preview', array('petty_cash' => $petty_cash, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $task['employee_name']) . "_petty_cash.pdf";

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
    
    
    
}

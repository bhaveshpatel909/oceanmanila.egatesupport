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
class Monthlybilllist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('monthlybilllist_actions');
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('monthlybilllist/index', array('monthlybilllist' => $this->monthlybilllist_actions->monthlybill_list()));
        } else {
            $this->load->view('monthlybilllist/index', array('monthlybilllist' => $this->monthlybilllist_actions->monthlybill_list()));
        }
    }
        
    function new_monthlybilllist() {
        $this->load->model('monthlybilllist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('monthlybilllist/monthlybilllist_new');
		
     
        
    }

    function edit_monthlybilllist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('monthlybilllist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('monthlybilllist/monthlybilllist_edit', array(
            'monthlybilllist' => $this->monthlybilllist_actions->get_monthlybilllist($id)
           
        ));
    }

    function save_monthlybilllist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'list_name', 'rules' => 'required', 'label' => 'Pay To'),

            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('monthlybilllist_actions');
        $this->load->view('monthlybilllist/monthlybilllist_add', array('result' => $this->monthlybilllist_actions->save_monthlybill_list()));
    }

    function delete_monthlybilllist() {
        $this->load->model('monthlybilllist_actions');
        $this->monthlybilllist_actions->delete_monthlybilllist($this->input->post('id'));
        $this->load->view('monthlybilllist/monthlybilllist_delete', array('billlist_id' => $this->input->post('id')));
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

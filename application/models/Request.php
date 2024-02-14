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
 * @property workmanual_actions          $workmanual_actions
 */
class Request extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('request');
    }

    function index($page_id = 1) {
        $this->load->model('drequest_actions');
        $this->load->helper('fa-extension');
    	$request=	$this->drequest_actions->get_request_request();
        $this->load->view('request/index', array(
            'request' => $this->drequest_actions->get_request($page_id),
            'search' => $this->input->get('search'),
			'requestt'=> $request,
        ));
    }
	
	
	function processcallingcard($page_id = 1) {
        $this->load->model('drequest_actions');
		$this->load->model('employee_memo');
		 $this->load->model('attachments_actions');
		   $this->load->model('employees_actions');
        $this->load->helper('fa-extension');
    	$request=	$this->drequest_actions->get_request_request();
        $this->load->view('employees/process_callingcard', array(
            'employees' => $this->employees_actions->get_employeess(),
			'enum_values' => $this->employee_memo->enum_select('employees','status'),
		//	'employees_active' => $this->employees_actions->get_employees_active(),
            'ienumber' => $this->employees_actions->total_inactivcount(),
            'taskscount' => $this->employees_actions->total_tasks($empppp),
            'enumber' => $this->employees_actions->total_activcount(),
            'search' => $this->input->get('search'),
			
            'active_menu' => 'employees',
        ));
    }

    function cat($document_category_id = 0, $page_id = 1) {
        $this->load->model('drequest_actions');
        $this->load->helper('fa-extension');
        $category = $this->drequest_actions->get_document_category($document_category_id);

        $this->load->view('request/request', array(
            'request' => $this->drequest_actions->get_cat_workmanual($document_category_id, $page_id),
            'active_menu' => $category['document_category_name'],
            'category_id' => $category['document_category_id'],
            'search' => $this->input->get('search')
        ));
    }

    function edit_document($document_id = 0) {
		  $this->load->model('timeoff_actions');
        $this->load->model('drequest_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		$request=	$this->drequest_actions->get_request_request();
        $this->load->view('request/request_edit', array(
            'document' => $this->drequest_actions->get_document($document_id),
            'attachments' => $this->attachments_actions->get_attachments($document_id, 'request'),
			'request'=> $request,
			'emppdata' => $this->timeoff_actions->get_employee_deta(),
        ));
    }

    function new_request($document_category_id = 0) {
		  $this->load->model('timeoff_actions');
		 $this->load->model('drequest_actions');
	$request=	$this->drequest_actions->get_request_request();

        $this->load->view('request/request_new', array(
		'category_id' => $document_category_id,'request'=> $request,
		'emppdata' => $this->timeoff_actions->get_employee_deta(),
		
		
		));
    }

    function update_request() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
           array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
            array('field' => 'request_category_id', 'rules' => 'required', 'label' => 'request_category_id'),
            array('field' => 'description', 'rules' => 'required', 'label' => 'description')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
		
		 if ($this->user_actions->is_selfservice()) {
			 $this->load->model('drequest_actions');
        if (!$result = $this->drequest_actions->save_document1()) {
            exit($this->load->view('layout/error', array('message' => $this->drequest_actions->get_error()), TRUE));
        }
		 }
		 else
			 
			 {
				  $this->load->model('drequest_actions');
				if (!$result = $this->drequest_actions->save_document()) {
					exit($this->load->view('layout/error', array('message' => $this->drequest_actions->get_error()), TRUE));
				}
				 
			 }
        

        $this->load->helper('fa-extension');
        $this->load->view('request/request_add', $result);
    }

	function update_request1() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
           array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
            array('field' => 'request_category_id', 'rules' => 'required', 'label' => 'request_category_id'),
            array('field' => 'description', 'rules' => 'required', 'label' => 'description')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('drequest_actions');
        if (!$result = $this->drequest_actions->save_document1()) {
            exit($this->load->view('layout/error', array('message' => $this->drequest_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('request/request_add', $result);
    }

//    function update_document() {
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules(array(
//            array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
//            array('field' => 'document_category_id', 'rules' => 'required', 'label' => 'document_category_id')
//        ));
//
//        if ($this->form_validation->run() == FALSE) {
//            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
//        }
//
//        $this->load->model('workmanual_actions');
//        $result = $this->workmanual_actions->save_document();
//        if (!$result['result']) {
//            exit($this->load->view('layout/error', array('message' => $this->workmanual_actions->get_error()), TRUE));
//        }
//
//        $this->load->helper('fa-extension');
//        $this->load->view('workmanual/document_add', array('result' => $result));
//    }

    function download_document($document_id = 0) {
        $this->load->model('request_actions');
        $this->request_actions->download_document($document_id);
    }

    function delete_document() {
        $this->load->model('drequest_actions');
		
        $this->drequest_actions->delete_document($this->input->post('document_id'));
        $this->load->view('request/request_delete', array('document_id' => $this->input->post('document_id')));
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }

    function find_department() {
        $this->load->model('drequest_actions');
        echo json_encode($this->departments_actions->search_department());
    }

    function find_position() {
        $this->load->model('positions_actions');
        echo json_encode($this->positions_actions->search_position());
    }

    function download_attachment($attachment_id = 0) {
        $this->load->model('attachments_actions');
        $this->attachments_actions->download_attachment($attachment_id);
    }
	
	function print_employee_request($document_id = 0) {
       $this->load->model('drequest_actions');
        
        $emp_request = $this->drequest_actions->get_print_request($document_id);
		
        //PDF generating
        $html = $this->load->view('request/request_print', array('emp_request' => $emp_request), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $task['employee_name']) . "_EmployeeRequest.pdf";

        //load mPDF library
		$param = array(
            'mode' => 'en-GB-x',
           'format' => 'utf-8', '[75, 205]-L',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 16,
            'margin_bottom' => 2,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'L'
        );
       $this->load->library('m_pdf', $param);

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }


}

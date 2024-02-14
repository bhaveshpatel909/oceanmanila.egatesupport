<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property discipline_actions          $discipline_actions
 */
class Discipline extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('discipline');
		$this->load->model('discipline_actions');
        $this->load->helper('url');
    }

    function index($eid=1) {
        $this->load->model('discipline_actions');
		$this->load->model('employees_actions');
        $this->load->view('discipline/index', array('discipline' => $this->discipline_actions->get_records($eid), 'eid'=> $eid, 'employ' => $this->employees_actions->search_employee()));
    }

    function edit_record($record_id = 0,$catid="") {
        $this->load->model('discipline_actions');
        $discipline_reasons = $this->discipline_actions->get_discipline_reasons($catid);
        $discipline_actions = $this->discipline_actions->get_discipline_actions();
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
        $this->load->view(
                'discipline/record_edit', array('record' => $this->discipline_actions->get_record($record_id),
                    'attachments' => $this->attachments_actions->get_attachments($record_id, 'discipline'),
            'discipline_reasons' => $discipline_reasons,
            'discipline_actions' => $discipline_actions, 'category' => $this->discipline_actions->get_discipline_category(), 'cat' => $catid)
        );
    }

    function save_record() {
        $this->load->helper('fa-extension');
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'record_id', 'rules' => 'required', 'label' => 'record_id'),
            array('field' => 'employee_id[]', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'discipline_reason_id', 'rules' => 'required', 'label' => $this->lang->line('Reason')),
            array('field' => 'discipline_action_id', 'rules' => 'required', 'label' => $this->lang->line('Action')),
            array('field' => 'date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
                //array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
        if (!$result = $this->discipline_actions->save_record()) {
            exit($this->load->view('layout/error', array('message' => $this->discipline_actions->get_error()), TRUE));
        }
        $this->load->view('discipline/record_add', $result);
    }

    function delete_record() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_record($this->input->post('record_id'));
        $this->load->view('discipline/record_delete', array('record_id' => $this->input->post('record_id')));
    }

    function new_record($catid="") {
        $this->load->model('discipline_actions');
        $discipline_reasons = $this->discipline_actions->get_discipline_reasons($catid);
        $discipline_actions = $this->discipline_actions->get_discipline_actions();
        $this->load->view('discipline/record_new', array('discipline_reasons' => $discipline_reasons, 'discipline_actions' => $discipline_actions, 'category' => $this->discipline_actions->get_discipline_category(), 'cat' => $catid ));
    }

    function preview_record($record_id = 0) {
        $this->load->model('discipline_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $discipline = $this->discipline_actions->record_preview($record_id);
        //PDF generating
        $html = $this->load->view('discipline/record_preview', array('discipline' => $discipline, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $discipline['fullname']) . "_discipline.pdf";

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

    function discipline_reasons() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_reasons', array('discipline_reasons' => $this->discipline_actions->get_discipline_reasons()));
    }

    function new_discipline_reason() {
        $this->load->view('discipline/discipline_reason_new', array('category' => $this->discipline_actions->get_discipline_category()));
    }

    function get_discipline_reason() {
        $discipline_reason_id = $this->input->post('reason_id');
        $this->load->model('discipline_actions');
        $data = array('discipline_reason' => $this->discipline_actions->get_discipline_reason($discipline_reason_id));
        die(json_encode($data));
    }

    function edit_discipline_reason($discipline_reason_id = 0) {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_reason_edit', array('discipline_reason' => $this->discipline_actions->get_discipline_reason($discipline_reason_id), 'category' => $this->discipline_actions->get_discipline_category()));
    }

    function save_discipline_reason() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'discipline_reason_id', 'rules' => 'required', 'label' => 'discipline_reason_id'),
            array('field' => 'discipline_reason_name', 'rules' => 'required', 'label' => $this->lang->line('discipline_reason_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_reason_add', array('result' => $this->discipline_actions->save_discipline_reason()));
    }

    function delete_discipline_reason() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_discipline_reason($this->input->post('discipline_reason_id'));
        $this->load->view('discipline/discipline_reason_delete', array('discipline_reason_id' => $this->input->post('discipline_reason_id')));
    }
	
	//category
	function discipline_category() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_category', array('discipline_actions' => $this->discipline_actions->get_discipline_category()));
    }
	
	function evaluation_category() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/evaluation_category', array('discipline_actions' => $this->discipline_actions->get_evaluation_category()));
    }
	
	function new_discipline_category() {
        $this->load->view('discipline/discipline_category_new');
    }
	
	function new_evaluation_category() {
        $this->load->view('discipline/evaluation_category_new');
    }
	
	function save_discipline_category() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'discipline_category_id', 'rules' => 'required', 'label' => 'discipline_category_id'),
            array('field' => 'discipline_category_name', 'rules' => 'required', 'label' => $this->lang->line('discipline_category_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
    
		if (!$result = $this->discipline_actions->save_discipline_category()) {
            exit($this->load->view('layout/error', array('message' => $this->discipline_actions->get_error()), TRUE));
        }
        redirect('discipline/discipline_category', 'refresh');
	}
	
	function save_evaluation_category() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'evaluation_category_id', 'rules' => 'required', 'label' => 'evaluation_category_id'),
            array('field' => 'evaluation_category_name', 'rules' => 'required', 'label' => $this->lang->line('evaluation_category_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
    
		if (!$result = $this->discipline_actions->save_evaluation_category()) {
            exit($this->load->view('layout/error', array('message' => $this->discipline_actions->get_error()), TRUE));
        }
        redirect('discipline/discipline_category', 'refresh');
	}

	function edit_discipline_category($id = 0) {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_category_edit', array('discipline_action' => $this->discipline_actions->get_discipline_categorybyid($id)));
    }
	
	function edit_evaluation_category($id = 0) {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/evaluation_category_edit', array('discipline_action' => $this->discipline_actions->get_evaluation_categorybyid($id)));
    }
	
	function delete_discipline_category() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_discipline_category($this->input->post('discipline_category_id'));
       redirect('discipline/evaluation_category', 'refresh');
    }
	
	function delete_evaluation_category() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_evaluation_category($this->input->post('evaluation_category_id'));
       redirect('discipline/evaluation_category', 'refresh');
    }
	
    //Actions

    function discipline_actions() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_actions', array('discipline_actions' => $this->discipline_actions->get_discipline_actions()));
    }

    function new_discipline_action() {
        $this->load->view('discipline/discipline_action_new');
    }

    function edit_discipline_action($discipline_action_id = 0) {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_action_edit', array('discipline_action' => $this->discipline_actions->get_discipline_action($discipline_action_id)));
    }

    function save_discipline_action() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'discipline_action_id', 'rules' => 'required', 'label' => 'discipline_action_id'),
            array('field' => 'discipline_action_name', 'rules' => 'required', 'label' => $this->lang->line('discipline_action_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
        $this->load->view('discipline/discipline_action_add', array('result' => $this->discipline_actions->save_discipline_action()));
    }

    function delete_discipline_action() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_discipline_action($this->input->post('discipline_action_id'));
        $this->load->view('discipline/discipline_action_delete', array('discipline_action_id' => $this->input->post('discipline_action_id')));
    }

   

    function company_rules() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/company_rules', array('company_rules' => $this->discipline_actions->get_company_rules()));
    }

    function print_company_rules() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $this->load->model('discipline_actions');
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('discipline/company_rules_print', array('logo' => $logo, 'company_rules' => $this->discipline_actions->get_company_rules()), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "company_rules.pdf";

        //load mPDF library
        $param = array(
            'mode' => 'en-GB-x',
            'format' => 'A4',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'P'
        );
        $this->load->library('m_pdf', $param);
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
    
    function download_attachment($attachment_id = 0) {
        $this->load->model('attachments_actions');
        $this->attachments_actions->download_attachment($attachment_id);
    }
	
	function send_mail(){
		
	    $this->load->model('employees_actions');
	    $this->load->model('settings_actions');
		$record_id=$_REQUEST['mid'];
		// echo $record_id;
		// Die("cxfgzxd");
		$recosrd =$this->discipline_actions->get_record($record_id);
	
		 
      
		  
		$employee_id = $recosrd['employee_id'];
		//echo $employee_id;
		//die("yoyo");
        $valueee   = $this->employees_actions->pinemp($employee_id);
	   
	   // echo "<pre>";
		  // print_r($recosrd); 
		  // echo "<pre>";
		  // print_r($valueee);
		  
		   // die("here");
		   $details = $this->settings_actions->get_settings('company');
	  // echo"<pre>";
	 $company_mail= $details['company_email'];
	 $email=explode(",",$company_mail);
	 // print_R($email[0]);
	 // die();
	 //$len=count($email);
	 
	 // for($i=0;$i<$len;$i++)
	  //{
		$ggmessage=  $recosrd['content'];
		$date=  $recosrd['date'];
		$reason_name=  $recosrd['reason_name'];
		$fullname=  $recosrd['fullname'];
		$position_name=  $recosrd['position_name'];
		$department_name=  $recosrd['department_name'];
		$from=$email[0];
		$mailcontent="";
		$mailcontent .= "<h3>Disciplinary Action Form</h3>";
		$mailcontent .= "<span>Date:".$date."</span>";
		$mailcontent .= "<span>Employee Name:".$fullname." </span>";
		$mailcontent .= "<span>Position:".$position_name."</span>";
		$mailcontent .= "<span>Depatrment:".$department_name."</span>";
		$mailcontent .= "<br/><br/><h5>RE:".$reason_name."</h5>";
		$mailcontent .= "<br/><br/>:".$ggmessage;
		
		
   
	$this->load->library('email'); 
	  $this->email->clear(TRUE);
	  $this->email->set_mailtype("html");
      $this->email->from($from);
      $userem =($valueee['email']);		 
    //  $userem =($valueee['email']);		 
   $subject= "Disciplinary / Corrective  Action Notice";
     // $this->email->to($userem);
      $this->email->to($userem);
	 
      //$ggmessage ='<br>'.$con;
      $this->email->subject($subject); 
      $this->email->message($mailcontent);
	 
	  $this->email->send();
		
   
   // print_r($valueee);
			// die("i m here");
   
    echo $successme ="Mail Sent Successfully";
	 //$this->load->view('tasks/index');
	// $url ='http://uplushrms.peza.com.ph/discipline?id='.$recosrd["employee_id"];
    // echo "<script>alert('Mail Sent Successfully!'); location.href='".$url."';</script>";
	 

	
		
	}
	
	
	
	//evaluation

	function evaluation_list() {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/evaluation_list', array('evaluation_templates' => $this->discipline_actions->get_evaluation_list()));
    }
	
	function new_evaluation() {
        $this->load->view('discipline/evaluation_new');
    }
	
	function save_evaluation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'evaluation_id', 'rules' => 'required', 'label' => 'evaluation_id'),
            array('field' => 'evaluation_name', 'rules' => 'required', 'label' => $this->lang->line('evaluation_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
		if (!$result = $this->discipline_actions->save_evaluation()) {
            exit($this->load->view('layout/error', array('message' => $this->discipline_actions->get_error()), TRUE));
        }
        redirect('discipline/evaluation_list', 'refresh');
		
    }
	
	function edit_evaluation($id = 0) {
        $this->load->model('discipline_actions');
        $this->load->view('discipline/evaluation_edit', array('evaluation_template' => $this->discipline_actions->get_evaluationbyid($id)));
    }
	
	function delete_evaluation() {
        $this->load->model('discipline_actions');
        $this->discipline_actions->delete_evaluation($this->input->post('evaluation_id'));
        //$this->load->view('evaluation/evaluation_template_delete', array('evaluation_template_id' => $this->input->post('evaluation_template_id')));
    }
	
	function preview_evaluationeditpdf($evaluation_id = 0) {
		

		
        $this->load->model('evaluation_actions');
        $this->load->model('settings_actions');
		//$evaluation = $this->evaluation_actions->evaluation_preview($evaluation_id);
		
		$evaluation = $this->evaluation_actions->get_evaluation_template($evaluation_id);
		 $logo = $this->settings_actions->get_setting('company_logo');
		
        //PDF generating
        $html = $this->load->view('evaluation/evaluation_pdfprint', array('evaluation' => $evaluation, 'logo' => $logo), TRUE);
		  // print_r($html);
		
		// die("dfgfd");
		  //$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		
        //PDF generating
        //$html = $this->load->view('evaluation/evaluation_pdfprint', array('evaluation_template' => $evaluation));
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $evaluation_id) . "_evaluation.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
    }
	
}

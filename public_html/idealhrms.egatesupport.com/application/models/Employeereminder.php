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
 * @property employeereminder_actions          $employeereminder_actions
 */
class Employeereminder extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('employeereminder');
    }

    function index($page_id = 1) {
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employeereminder/index', array(
            'employeereminder' => $this->employeereminder_actions->get_employeereminder($page_id),
            'search' => $this->input->get('search')
        ));
    }

	
	function modelview() {
		if($_GET['id']){
		  $document_id=$_GET['id'];
	}
	
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
            $this->load->view('employeereminder/index', array(
         'allvieww' => $this->employeereminder_actions->get_documentrow($document_id),
        ));
    }

	
	
	
	
	
	
	
    function cat($document_category_id = 0, $page_id = 1) {
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
        $category = $this->employeereminder_actions->get_document_category($document_category_id);

        $this->load->view('employeereminder/employeereminder', array(
            'employeereminder' => $this->employeereminder_actions->get_cat_employeereminder($document_category_id, $page_id),
            'active_menu' => $category['document_category_name'],
            'category_id' => $category['document_category_id'],
            'search' => $this->input->get('search')
        ));
    }

    function edit_document($document_id = 0) {
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		$deparment=	$this->employeereminder_actions->get_employeereminder_department();
        $this->load->view('employeereminder/employeereminder_edit', array(
            'document' => $this->employeereminder_actions->get_document($document_id),
            'attachments' => $this->attachments_actions->get_attachments($document_id, 'employeereminder'),
			'deparment'=> $deparment
        ));
    }
	
//////////////////////////////////////////////////// mail part start //////////////////////////////////////////////////////////////	
	 function mail_document($document_id = 0) {
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		$deparment=	$this->employeereminder_actions->get_employeereminder_department();
        $this->load->view('employeereminder/empreminder_mail', array(
            'document' => $this->employeereminder_actions->get_document($document_id),
            'attachments' => $this->attachments_actions->get_attachments($document_id, 'employeereminder'),
			'deparment'=> $deparment
        ));
    }
	
	
		  function mail_empreminder() {
		
	
		$document_id = $_POST['idwork'];
		  $ids = $_POST['employees_list'];
		
		foreach($ids as $value) {

             $id = $value . "<br>";

			}
      $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		$deparment=	$this->employeereminder_actions->get_workmanual_department();
		$depp =$this->employeereminder_actions->mailget_document($document_id);
		$deppg =$this->employeereminder_actions->emp_document($id);
		$rg =$this->employeereminder_actions->allemp_document();
         $attact = $this->employeereminder_actions->mailget_attachments($document_id);
		 
		 $des =  $depp['description'];
		 $con = strip_tags($depp['content']);

		$arr=array();
		
		if($ids[0]==0){
		//	echo "fgyfc";
	 foreach($rg as $valueg) {
  // $valueg['email'];
	  $from ="upluscorporation@gmail.com";
	 $this->load->library('email'); 
	  $this->email->clear(TRUE);
		 $this->email->set_mailtype("html");
         $this->email->from($from); 
       

            $emailss  =  $valueg['email'].',';
                 //echo    "'".$emailss."'";
  $this->email->to($emailss);
   
     $this->email->subject($des); 
         $this->email->message($con);
	 foreach($attact as $valueat) {
// $this->email->attach('http://uplushrms.peza.com.ph/files/attachments/'.$valueat['location']);
		$this->email->attach("http://uplushrms.peza.com.ph/files/attachments/".$valueat['location'], 'attachment', $valueat['file']);
		 }

		$this->email->send();	
    }
		}
		
		else{
	 foreach($deppg as $valueg) {
  // $valueg['email'];
	  $from ="upluscorporation@gmail.com";
	 $this->load->library('email'); 
	  $this->email->clear(TRUE);
		 $this->email->set_mailtype("html");
         $this->email->from($from); 
       

            $emailss  =  $valueg['email'].',';
                 //echo    "'".$emailss."'";
  $this->email->to($emailss);
   
     $this->email->subject($des); 
         $this->email->message($con);
	 foreach($attact as $valueat) {
// $this->email->attach('http://uplushrms.peza.com.ph/files/attachments/'.$valueat['location']);
		$this->email->attach("http://uplushrms.peza.com.ph/files/attachments/".$valueat['location'], 'attachment', $valueat['file']);
		 }

		$this->email->send();	
    }
		}
		
      $successme ="Mail Sended Successfully";
	   $this->load->view('employeereminder/empreminder_mail',array('result' => $successme));
}
	
//////////////////////////////////////////////////////mail part end ///////////////////////////////////////////////////////////	
	
	
	
	
	function edit_document2($document_id = 0) {
        $this->load->model('employeereminder_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		$deparment=	$this->employeereminder_actions->get_employeereminder_department();
        $this->load->view('employeereminder/employeereminder_edit2', array(
            'document' => $this->employeereminder_actions->get_document($document_id),
            'employeereminder' => $this->employeereminder_actions->get_employeereminder($page_id=1),
			'deparment'=> $deparment
        ));
    }

    function new_employeereminder($document_category_id = 0) {
		
		 $this->load->model('employeereminder_actions');
	$deparment=	$this->employeereminder_actions->get_employeereminder_department();

        $this->load->view('employeereminder/employeereminder_new', array('category_id' => $document_category_id,'deparment'=> $deparment));
    }

    function update_employeereminder() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
           array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
            array('field' => 'employeereminder_category_id', 'rules' => 'required', 'label' => 'document_category_id'),
            array('field' => 'description', 'rules' => 'required', 'label' => 'description')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employeereminder_actions');
        if (!$result = $this->employeereminder_actions->save_document()) {
            exit($this->load->view('layout/error', array('message' => $this->employeereminder_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employeereminder/employeereminder_add', $result);
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
//        $this->load->model('employeereminder_actions');
//        $result = $this->employeereminder_actions->save_document();
//        if (!$result['result']) {
//            exit($this->load->view('layout/error', array('message' => $this->employeereminder_actions->get_error()), TRUE));
//        }
//
//        $this->load->helper('fa-extension');
//        $this->load->view('employeereminder/document_add', array('result' => $result));
//    }

    function download_document($document_id = 0) {
        $this->load->model('employeereminder_actions');
        $this->employeereminder_actions->download_document($document_id);
    }

    function delete_document() {
        $this->load->model('employeereminder_actions');
		
        $this->employeereminder_actions->delete_document($this->input->post('employeereminder_id'));
        $this->load->view('employeereminder/employeereminder_delete', array('document_id' => $this->input->post('document_id')));
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }

    function find_department() {
        $this->load->model('departments_actions');
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

}

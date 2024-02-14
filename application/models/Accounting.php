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
class Accounting extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('accounting');
        $this->load->helper('url');
    }

    function index() {
        
    }
    
    function bir_files() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerm();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_files', array('bir_files' => $this->accounting_actions->get_bir_files(),'bir_forems' => $list));
		
    }
	function bir_calender_files() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerm();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_calender_files',array('bir_files' => $this->accounting_actions->get_bir_calender_files(),'bir_forems' => $list));
		
    }
	function bir_egate_files() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerm();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_egate_files',array('bir_files' => $this->accounting_actions->get_bir_egate_files(),'bir_forems' => $list));
		
    
	}
	function bir_modory_files() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerm();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_modory_files',array('bir_files' => $this->accounting_actions->get_bir_modory_files(),'bir_forems' => $list));
		
    }
	
	
	/////////////////////employeee bebefit code start///////////////////
	
	
	
	function bir_calender_filesE() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerme();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_calender_filesE',array('bir_files' => $this->accounting_actions->get_bir_calender_filese(),'bir_forems' => $list));
		
    }
	function bir_egate_filesE() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerme();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_egate_filesE',array('bir_files' => $this->accounting_actions->get_bir_egate_filese(),'bir_forems' => $list));
		
    
	}
	function bir_modory_filesE() {  
		
        $this->load->model('accounting_actions');
		$bir_forems = $this->accounting_actions->get_bir_foerme();
		$list = $this->array_sortt($bir_forems, 'form_name', SORT_DESC);
	    $this->load->view('accounting/bir_modory_filesE',array('bir_files' => $this->accounting_actions->get_bir_modory_filese(),'bir_forems' => $list));
		
    }
	
	/////////////////////employeee bebefit code  end ///////////////////
	
	
		function array_sortt($array, $on, $order=SORT_DESC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
	
}

function updatealert(){
	 
	 
	 $getid = $_GET['formid'];
 $getcheck = $_GET['check'];
 
 if($getcheck==0){
	 
	 $onevalue=1;
	 
 }else{
	 
	 $onevalue=0;
 }
 

		 $data = array(
            
            'alertchk' => $onevalue,
			
        );
		return $this->db->update('bir_calnder_files', $data, array('bir_c_file_id' => $getid));
		
	
	
}
function updatealerte(){
	 
	 
	 $getid = $_GET['formid'];
 $getcheck = $_GET['check'];
 
 if($getcheck==0){
	 
	 $onevalue=1;
	 
 }else{
	 
	 $onevalue=0;
 }
 

		 $data = array(
            
            'alertchk' => $onevalue,
			
        );
		return $this->db->update('bir_calnder_files_employee', $data, array('bir_c_file_id' => $getid));
		
	
	
}


function updatealertegate(){
	 
	 
	 $getid = $_GET['formid'];
 $getcheck = $_GET['check'];
 
 if($getcheck==0){
	 
	 $onevalue=1;
	 
 }else{
	 
	 $onevalue=0;
 }
 

		 $data = array(
            
            'alertchk' => $onevalue,
			
        );
		return $this->db->update('bir_egate_files', $data, array('bir_e_file_id' => $getid));
		
	
	
}

function updatealertegatee(){
	 
	 
	 $getid = $_GET['formid'];
 $getcheck = $_GET['check'];
 
 if($getcheck==0){
	 
	 $onevalue=1;
	 
 }else{
	 
	 $onevalue=0;
 }
 

		 $data = array(
            
            'alertchk' => $onevalue,
			
        );
		return $this->db->update('bir_egate_files_employee', $data, array('bir_e_file_id' => $getid));
		
	
	
}







function updatealertmodory(){
	 
	 
	 $getid = $_GET['formid'];
 $getcheck = $_GET['check'];
 
 if($getcheck==0){
	 
	 $onevalue=1;
	 
 }else{
	 
	 $onevalue=0;
 }
 

		 $data = array(
            
            'alertchk' => $onevalue,
			
        );
		return $this->db->update('bir_modory_files', $data, array('bir_m_file_id' => $getid));
		
	
	
}

  function new_bir_file() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_file_new', array('bir_forms' => $bir_forms));
    }
	function new_bir_calender_file() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_calander_file_new', array('bir_forms' => $bir_forms));
    }
	function new_bir_egate_file() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_egate_file_new', array('bir_forms' => $bir_forms));
    }
	
	
	function new_bir_egate_filee() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_formsb();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_egate_file_newe', array('bir_forms' => $bir_forms));
    }
	function new_bir_modory_file() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_modory_file_new', array('bir_forms' => $bir_forms));
    }
	
	
	function new_bir_modory_filee() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_formsb();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_modory_file_newe', array('bir_forms' => $bir_forms));
    }
	///***********************employeee bebefit*********************///////////
	
	function new_bir_calender_filee() {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_formsb();
        //_custom_debug($bir_forms);
        $this->load->view('accounting/bir_calander_file_newe', array('bir_forms' => $bir_forms));
    }
	
	
	///***********************employeee bebefit end*********************///////////
	
	
	
	
	function updatebirfile($birfileid)
	{
		// echo $birfileid;
		// die("dfg00");
		 $this->load->model('accounting_actions');
		// $data = array(
            // 'alertchk' => 1,
			// );
         $bir_file = $this->accounting_actions->get_bir_file($birfileid);
		if($bir_file['alertchk']==1)
		{
			$data = array(
            'alertchk' => 0,
			);
			
		}
		else
		{
			$data = array(
            'alertchk' => 1,
			);
		}
		 
		  $bir_file = $this->accounting_actions->update_bir_files($data,$birfileid);
	}
	function updatebircalanderfile($birfileid)
	{
		// echo $birfileid;
		// die("dfg00");
		 $this->load->model('accounting_actions');
		// $data = array(
            // 'alertchk' => 1,
			// );
         $bir_file = $this->accounting_actions->get_bir_calander_file($birfileid);
		if($bir_file['alertchk']==1)
		{
			$data = array(
            'alertchk' => 0,
			);
			
		}
		else
		{
			$data = array(
            'alertchk' => 1,
			);
		}
		 
		  $bir_file = $this->accounting_actions->update_bir_calander_files($data,$birfileid);
	}
    
    function edit_bir_file($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_file($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_file_edit',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_file2')
                ));
    }
	
	 function edit_bir_filee($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_filee($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_file_edite',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_file2')
                ));
    }
	
	
	
	
	
	
	
	
	
	
	
	
	function edit_bir_calnder_file($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_calander_file($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_calanader_file_edit',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_calander_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_calander_file2')
                ));
    }
	
function edit_bir_calnder_filee($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_formsb();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_calander_filee($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_calanader_file_edite',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_calander_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_calander_file2')
                ));
    }	
	
	
	
	function edit_bir_egate_file($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_egate_file($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_egate_file_edit',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_egate_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_egate_file2')
                ));
    }
	function edit_bir_egate_filee($bir_file_id = 0) {
		
		
		
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_formsb();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_egate_filee($bir_file_id);
       //_custom_debug($bir_file);
        $this->load->view('accounting/bir_egate_file_edite',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_egate_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_egate_file2')
                ));
    }
	
	
	function edit_bir_modory_file($bir_file_id = 0) {
        $this->load->model('settings_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('accounting_actions');
        $bir_file = $this->accounting_actions->get_bir_modory_file($bir_file_id);
        //_custom_debug($bir_file);
        $this->load->view('accounting/bir_modory_file_edit',array(
            'bir_forms' => $bir_forms,
            'bir_file' => $bir_file,
            'attachments' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_modory_file'),
            'attachments2' => $this->attachments_actions->get_attachments($bir_file_id, 'bir_modory_file2')
                ));
    }
    
    function save_bir_file() {
		/*  echo'<pre>';
		print_r($_POST);
		// print_r($_FILES);
		 echo'</pre>';
		 die('rhtrhrt'); */
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_file()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_file_add', $result);
    }
	
	 function save_bir_filee() {
		/*  echo'<pre>';
		print_r($_POST);
		// print_r($_FILES);
		 echo'</pre>';
		 die('rhtrhrt'); */
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_filee()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_file_adde', $result);
    }
	
	
	
	
	function save_bir_calander_file() {
		/*  echo'<pre>';
		print_r($_POST);
		// print_r($_FILES);
		 echo'</pre>';
		 die('rhtrhrt'); */
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_calander_file()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_calanader_file_add', $result);
    }
	
		function save_bir_calander_filee() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_calander_filee()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_calanader_file_adde', $result);
    }
	
	
	
	function save_bir_egate_file() {
		  // echo'<pre>';
		// print_r($_POST);
		//print_r($_FILES);
		 // echo'</pre>';
		 // die('rhtrhrt'); 
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_egate_file()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_egate_file_add', $result);
    }
	
	function save_bir_egate_filee() {
		
		
		  
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_egate_filee()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_egate_file_adde', $result);
    }
	
	
	
	function save_bir_modory_file() {
		  // echo'<pre>';
		// print_r($_POST);
		//print_r($_FILES);
		 // echo'</pre>';
		 // die('rhtrhrt'); 
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->accounting_actions->save_bir_modory_file()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('accounting/bir_modory_file_add', $result);
    }
    
    function delete_bir_file() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_file($this->input->post('bir_file_id'));
        $this->load->view('accounting/bir_file_delete', array('bir_file_id' => $this->input->post('bir_file_id')));
    }
	function delete_bir_calander_file() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_calander_file($this->input->post('bir_c_file_id'));
        $this->load->view('accounting/bir_calander_file_delete', array('bir_c_file_id' => $this->input->post('bir_c_file_id')));
    }
	function delete_bir_calander_filee() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_calander_filee($this->input->post('bir_c_file_id'));
        $this->load->view('accounting/bir_calander_file_deletee', array('bir_c_file_id' => $this->input->post('bir_c_file_id')));
    }
	function delete_bir_egate_file() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_egate_file($this->input->post('bir_e_file_id'));
        $this->load->view('accounting/bir_egate_file_delete', array('bir_e_file_id' => $this->input->post('bir_e_file_id')));
    }
	
	function delete_bir_egate_filee() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_egate_filee($this->input->post('bir_e_file_id'));
        $this->load->view('accounting/bir_egate_file_deletee', array('bir_e_file_id' => $this->input->post('bir_e_file_id')));
    }
	
	
	
	function delete_bir_modory_file() {
        $this->load->model('accounting_actions');
        $this->accounting_actions->delete_bir_modory_file($this->input->post('bir_m_file_id'));
        $this->load->view('accounting/bir_modory_file_delete', array('bir_m_file_id' => $this->input->post('bir_e_file_id')));
    }

}

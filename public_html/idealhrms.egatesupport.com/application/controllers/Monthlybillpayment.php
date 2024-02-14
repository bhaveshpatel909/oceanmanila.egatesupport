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
class Monthlybillpayment extends CI_Controller {
	
	 function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
		$this->load->model('monthlybillpayment_actions');
		$ddd=$this->monthlybillpayment_actions->billpayment_list();
		// echo "<pre>";
		// print_R($ddd);
		// die("dgs");
		if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('monthlybillpayment/index', array('monthlybillpayment_list' => $this->monthlybillpayment_actions->billpayment_list(),
			'billlist'=>$this->monthlybillpayment_actions->monthlybill_list()));
        } else {
            $this->load->view('monthlybillpayment/index', array('monthlybillpayment_list' => $this->monthlybillpayment_actions->billpayment_list(),
			'billlist'=>$this->monthlybillpayment_actions->monthlybill_list()));
        }
			
			
          
		
		
       
    }
	 function monthlybillpayment_new() {
        $this->load->model('monthlybillpayment_actions');
       
        $this->load->model('monthlybilllist_actions');
		//$petty_items = $this->petty_actions->get_petty_items();
       // $item_row = $this->load->view('checkwriter/checkwriter_item_row', array('petty_items' => $petty_items), TRUE);
       $banklist = $this->monthlybilllist_actions->monthlybill_list();
       
        $this->load->view('monthlybillpayment/monthlybillpayment_new',array("banklist"=>$banklist));
		
     
        
    }
	 function save_monthlybillpayment() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'created_date', 'rules' => 'required', 'label' => 'Date'),
            array('field' => 'payto', 'rules' => 'required', 'label' => 'payto'),
            array('field' => 'bill_no', 'rules' => 'required', 'label' => $this->lang->line('Bill No')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Amount')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
		$this->load->helper('fa-extension');
        $this->load->model('monthlybillpayment_actions');
        $this->load->model('accounting_actions');
      //  $this->monthlybillpayment_actions->save_monthlybillpayment();
		if (!$result = $this->monthlybillpayment_actions->save_monthlybillpayment()) {
            exit($this->load->view('layout/error', array('message' => $this->accounting_actions->get_error()), TRUE));
        }
		$this->load->view('monthlybillpayment/monthlybillpayment_add', $result);
    }
	
	 function edit_monthlybillpayment($checkwriter_id = 0) {
        $this->load->helper('fa-extension');
       $this->load->model('monthlybillpayment_actions');
       $this->load->model('attachments_actions');
      
//        $this->load->model('attachments_actions');

       $this->load->model('monthlybilllist_actions');
	  //$attachment=  $this->attachments_actions->get_attachments($checkwriter_id, 'monthlybillno_file');
	 
        $banklist = $this->monthlybilllist_actions->monthlybill_list();
	  
        
        $this->load->view('monthlybillpayment/monthlybillpayment_edit', array(
            'checkwriterlist' => $this->monthlybillpayment_actions->get_monthlybillpayment($checkwriter_id),
            'banklist' => $banklist,
			'attachments' => $this->attachments_actions->get_attachments($checkwriter_id, 'monthlybillno_file'),
            'attachments2' => $this->attachments_actions->get_attachments($checkwriter_id, 'monthlybillpayment_file')
			
            
        ));
    }
	 function delete_monthlybillpayment() {
        $this->load->model('monthlybillpayment_actions');
		
		
        $this->monthlybillpayment_actions->monthlybillpayment_delete($this->input->post('bill_id'));
        $this->load->view('monthlybillpayment/monthlybillpayment_delete', array('bill_id' => $this->input->post('bill_id')));
    }
        
}
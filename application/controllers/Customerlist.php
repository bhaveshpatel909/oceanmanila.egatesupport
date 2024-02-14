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
class Customerlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('customerlist_actions');
		//echo  "hiii";
		//die("here");
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('customerlist/index', array('customerlist' => $this->customerlist_actions->customer_list()));
        } else {
            $this->load->view('customerlist/index', array('customerlist' => $this->customerlist_actions->customer_list()));
        }
    }
        
    function new_customerlist() {
        $this->load->model('customerlist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('customerlist/customerlist_new');
		
     
        
    }

    function edit_customerlist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('customerlist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('customerlist/customerlist_edit', array(
            'customerlist' => $this->customerlist_actions->get_customerlist($id)
           
        ));
    }

    function save_customerlist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'customer_name', 'rules' => 'required', 'label' => 'Customer Name'),
            array('field' => 'contactinfo', 'rules' => 'required', 'label' => 'Contact Info'),
            array('field' => 'remarks', 'rules' => 'required', 'label' => 'Remarks'),
            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('customerlist_actions');
        $this->load->view('customerlist/customerlist_add', array('result' => $this->customerlist_actions->save_customerlist()));
    }

    function delete_customerlist() {
        $this->load->model('customerlist_actions');
        $this->customerlist_actions->delete_customerlist($this->input->post('id'));
        $this->load->view('customerlist/customerlist_delete', array('vendor_id' => $this->input->post('id')));
    } 
	function status_update() {
        $this->load->model('customerlist_actions');
        $this->customerlist_actions->status_customerlist($_POST['cid'],$_POST['status']);
		return 'done';
       // $this->load->view('customerlist/customerlist_delete', array('vendor_id' => $this->input->post('id')));
    }

   

   
    
    
    
}

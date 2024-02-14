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
class Vendorlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('vendorlist_actions');
		//echo  "hiii";
		//die("here");
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('vendorlist/index', array('vendorlist' => $this->vendorlist_actions->vendor_list()));
        } else {
            $this->load->view('vendorlist/index', array('vendorlist' => $this->vendorlist_actions->vendor_list()));
        }
    }
        
    function new_vendorlist() {
        $this->load->model('vendorlist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('vendorlist/vendorlist_new');
		
     
        
    }

    function edit_vendorlist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('vendorlist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('vendorlist/vendorlist_edit', array(
            'vendorlist' => $this->vendorlist_actions->get_vendorlist($id)
           
        ));
    }

    function save_vendorlist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'vendor_name', 'rules' => 'required', 'label' => 'Vendor Name'),
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
        $this->load->model('vendorlist_actions');
        $this->load->view('vendorlist/vendorlist_add', array('result' => $this->vendorlist_actions->save_vendorlist()));
    }

    function delete_vendorlist() {
        $this->load->model('vendorlist_actions');
        $this->vendorlist_actions->delete_vendorlist($this->input->post('id'));
        $this->load->view('vendorlist/vendorlist_delete', array('vendor_id' => $this->input->post('id')));
    }

   
function status_update() {
        $this->load->model('vendorlist_actions');
        $this->vendorlist_actions->status_vendorlist($_POST['cid'],$_POST['status']);
		return 'done';
       // $this->load->view('customerlist/customerlist_delete', array('vendor_id' => $this->input->post('id')));
    }
   
    
    
    
}

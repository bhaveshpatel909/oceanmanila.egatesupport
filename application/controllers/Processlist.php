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
class Processlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('processlist_actions');
		//echo  "hiii";
		//die("here");
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('processlist/index', array('processlist' => $this->processlist_actions->process_list()));
        } else {
            $this->load->view('processlist/index', array('processlist' => $this->processlist_actions->process_list()));
        }
    }
        
    function new_processlist() {
        $this->load->model('processlist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('processlist/processlist_new');
		
     
        
    }

    function edit_processlist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('processlist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('processlist/processlist_edit', array(
            'processlist' => $this->processlist_actions->get_processlist($id)
           
        ));
    }

    function save_processlist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'process_name', 'rules' => 'required', 'label' => 'Vendor Name'),
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
        $this->load->model('processlist_actions');
        $this->load->view('processlist/processlist_add', array('result' => $this->processlist_actions->save_processlist()));
    }

    function delete_processlist() {
        $this->load->model('processlist_actions');
        $this->processlist_actions->delete_processlist($this->input->post('id'));
        $this->load->view('processlist/processlist_delete', array('vendor_id' => $this->input->post('id')));
    }

   
function status_update() {
        $this->load->model('processlist_actions');
        $this->processlist_actions->status_processlist($_POST['cid'],$_POST['status']);
		return 'done';
       // $this->load->view('customerlist/customerlist_delete', array('vendor_id' => $this->input->post('id')));
    }
   
    
    
    
}

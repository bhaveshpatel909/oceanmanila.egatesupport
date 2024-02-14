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
class Reminderlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('reminderlist_actions');
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('reminderlist/index', array('reminderlist' => $this->reminderlist_actions->reminder_list()));
        } else {
            $this->load->view('reminderlist/index', array('reminderlist' => $this->reminderlist_actions->reminder_list()));
        }
    }
        
    function new_reminderlist() {
        $this->load->model('reminderlist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('reminderlist/reminderlist_new');
		
     
        
    }

    function edit_reminderlist($id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('reminderlist_actions');
//        $this->load->model('attachments_actions');

       
       
        $this->load->view('reminderlist/reminderlist_edit', array(
            'reminderlist' => $this->reminderlist_actions->get_reminderlist($id)
           
        ));
    }

    function save_reminderlist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'bank_name', 'rules' => 'required', 'label' => 'Reminder name'),
            
            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('reminderlist_actions');
        $this->load->view('reminderlist/reminderlist_add', array('result' => $this->reminderlist_actions->save_reminder_list()));
    }

    function delete_reminderlist() {
        $this->load->model('reminderlist_actions');
        $this->reminderlist_actions->delete_reminderlist($this->input->post('id'));
        $this->load->view('reminderlist/reminderlist_delete', array('bank_id' => $this->input->post('id')));
    }

   
    
    
    
}

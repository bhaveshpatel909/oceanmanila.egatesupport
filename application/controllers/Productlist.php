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
class Productlist extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('productlist_actions');
		//echo  "hiii";
		//die("here");
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('productlist/index', array('productlist' => $this->productlist_actions->product_list()));
        } else {
            $this->load->view('productlist/index', array('productlist' => $this->productlist_actions->product_list()));
        }
    }
        
    function new_productlist() {
        $this->load->model('productlist_actions');
       // $petty_items = $this->checkwriter_actions->get_petty_items();
       
        $this->load->view('productlist/productlist_new');
		
     
        
    }

    function edit_productlist($id = 0) {
		$this->load->helper('fa-extension');
        $this->load->model('productlist_actions');
			$this->load->model('attachments_actions');

      // $bir_file = $this->productlist_actions->get_productlist($id);
       
        $this->load->view('productlist/productlist_edit', array(
            'productlist' => $this->productlist_actions->get_productlist($id),
			'attachments' => $this->attachments_actions->get_attachments($id, 'product_image'),
           
        ));
    }

    function save_productlist() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'product_name', 'rules' => 'required', 'label' => 'Product Name'),
            array('field' => 'sku', 'rules' => 'required', 'label' => 'Sku No'),
            array('field' => 'remarks', 'rules' => 'required', 'label' => 'Remarks'),
           // array('field' => 'product_image', 'rules' => 'required', 'label' => 'product_image'),
            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('productlist_actions');
		$this->load->helper('fa-extension');
        $this->load->view('productlist/productlist_add', array('result' => $this->productlist_actions->save_productlist()));
    }

    function delete_productlist() {
        $this->load->model('productlist_actions');
        $this->productlist_actions->delete_productlist($this->input->post('id'));
        $this->load->view('productlist/productlist_delete', array('vendor_id' => $this->input->post('id')));
    }

   
function status_update() {
        $this->load->model('productlist_actions');
        $this->productlist_actions->status_productlist($_POST['cid'],$_POST['status']);
		return 'done';
       // $this->load->view('customerlist/customerlist_delete', array('vendor_id' => $this->input->post('id')));
    }
   
    
    
    
}

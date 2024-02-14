<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property documents_actions          $documents_actions
    */
  class Documents extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('employees');
      }
      
      function index($page_id=1)
      {
          $this->load->model('documents_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('documents/index',array(
            'documents'=>$this->documents_actions->get_documents($page_id),
            'search'=>$this->input->get('search')
          ));
      }
      
      function edit_document($document_id=0)
      {
          $this->load->model('documents_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('documents/document_edit',array(
            'document'=>$this->documents_actions->get_document($document_id)
          ));
      }
      
      function new_document()
      {
          $this->load->view('documents/document_new');
      }
      
      function update_document()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'document_id','rules'=>'required','label'=>'document_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('documents_actions');
          $result=$this->documents_actions->save_document();
          if (!$result['result'])
          {
              exit($this->load->view('layout/error',array('message'=>$this->documents_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('documents/document_add',array('result'=>$result));
      }
      
      function download_document($document_id=0)
      {
          $this->load->model('documents_actions');
          $this->documents_actions->download_document($document_id);
      }
      
      function delete_document()
      {
          $this->load->model('documents_actions');
          $this->documents_actions->delete_document($this->input->post('document_id'));
          $this->load->view('documents/document_delete',array('document_id'=>$this->input->post('document_id')));
      }
      
      function find_employee()
      {
          $this->load->model('employees_actions');
          echo json_encode($this->employees_actions->search_employee());
      }
      
      function find_department()
      {
          $this->load->model('departments_actions');
          echo json_encode($this->departments_actions->search_department());
      }
      
      function find_position()
      {
          $this->load->model('positions_actions');
          echo json_encode($this->positions_actions->search_position());
      }
  }
?>
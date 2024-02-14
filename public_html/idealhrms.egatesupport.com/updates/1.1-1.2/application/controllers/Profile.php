<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property employees_actions          $employees_actions
    * @property attachments_actions          $attachments_actions
    */
  
  class Profile extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('selfservice');
      }
      
      function index()
      {
          $this->load->view('profile/index',array('profile'=>$this->user_actions->get_profile()));
      }
      
      function save_profile()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employee_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'employee_email','rules'=>'required|valid_email','label'=>$this->lang->line('Email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->user_actions->save_profile();
          $this->load->view('profile/update_profile');
      }
      
      function save_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'current_password','rules'=>'required','label'=>$this->lang->line('Current password')),
            array('field'=>'new_password','rules'=>'required','label'=>$this->lang->line('New password')),
            array('field'=>'password_again','rules'=>'required','label'=>$this->lang->line('Password again'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!$this->user_actions->save_password())
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Done')));
      }
      
      function logout()
      {
          $this->user_actions->logout();
          header('Location:'.$this->config->item('base_url'));
      }
      
      function licenses()
      {
          $this->load->model('employees_actions');
          $this->load->view('profile/licenses',array('licenses'=>$this->employees_actions->get_licenses($this->session->current->userdata('employee_id'))));
      }
      
      function edit_license($item_id=0)
      {
          if (!$this->user_actions->check_detail('license',$item_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('Error')),TRUE));
          }
          
          $this->load->model('employees_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('profile/license_edit',array(
            'license'=>$this->employees_actions->get_license($item_id),
            'attachments'=>$this->attachments_actions->get_attachments($item_id,'license')
          ));
      }
      
      function save_license()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE)); 
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'license_id','rules'=>'required','label'=>'license_id'),
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'license_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'expiry','rules'=>'required','label'=>$this->lang->line('Expiry')),
            array('field'=>'license_number','rules'=>'required','label'=>$this->lang->line('Number'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$result=$this->employees_actions->save_license($this->session->current->userdata('employee_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('profile/license_add',$result);
      }
      
      function delete_license()
      {
          if (!$this->user_actions->check_detail('license',$this->input->post('license_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('Error')),TRUE));
          }
          
          $this->load->model('employees_actions');
          $this->employees_actions->delete_license($this->input->post('license_id'));
          $this->load->view('profile/license_delete',array('license_id'=>$this->input->post('license_id')));
      }
      
      function new_license()
      {
          $this->load->view('profile/license_new',array('employee_id'=>$this->session->current->userdata('employee_id')));
      }
      
      function remove_attachment($attachment_id=0)
      {
          $this->load->model('attachments_actions');
          $this->attachments_actions->remove_attachment($attachment_id,TRUE);
      }
      
      function download_attachment($attachment_id=0)
      {
          $this->load->model('attachments_actions');
          $this->attachments_actions->download_attachment($attachment_id,TRUE);
      }
  }
?>
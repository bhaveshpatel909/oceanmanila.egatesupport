<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property settings_actions          $settings_actions
    * @property mix_actions          $mix_actions
    * @property positions_actions          $positions_actions
    * @property departments_actions          $departments_actions
    */
  
  class Settings extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('admin');
      }
      
      function index()
      {
          
      }
      
      function company()
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/company',array(
            'details'=>$this->settings_actions->get_settings('company')
          ));
      }
      
      function save_company()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'company_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'company_email','rules'=>'required','label'=>$this->lang->line('Email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->model('settings_actions');
          $this->settings_actions->save_settings('company');
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Saved')));
      }
      
      function email()
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/email',array(
            'email'=>$this->settings_actions->get_settings('email')
          ));
      }
      
      function save_email()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'email_method','rules'=>'required','label'=>$this->lang->line('Email method'))
          ));
          
          if ($this->input->post('email_method')=='smtp')
          {
              $this->form_validation->set_rules(array(
                array('field'=>'smtp_server','rules'=>'required','label'=>$this->lang->line('SMTP server')),
                array('field'=>'smtp_username','rules'=>'required','label'=>$this->lang->line('SMTP user')),
                array('field'=>'smtp_password','rules'=>'required','label'=>$this->lang->line('SMTP password'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->model('settings_actions');
          $this->settings_actions->save_settings('email');
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Saved')));
      }
      
      function positions()
      {
          $this->load->model('positions_actions');
          $this->load->view('settings/positions',array('positions'=>$this->positions_actions->get_positions()));
      }
      
      function edit_position($position_id=0)
      {
          $this->load->model('positions_actions');
          $this->load->model('departments_actions');
          
          
          $this->load->view('settings/position_edit',array(
            'position'=>$this->positions_actions->get_position($position_id),
            'skills'=>$this->positions_actions->get_required_skills($position_id),
            'departments'=>$this->departments_actions->get_departments_list()
          ));
      }
      
      function save_position()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'position_id','rules'=>'required','label'=>'position_id'),
                array('field'=>'position_name','rules'=>'required','label'=>$this->lang->line('Position name')),
                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('positions_actions');
          
          if (!$result=$this->positions_actions->save_position())
          {
              exit($this->load->view('layout/error',array('message'=>$this->positions_actions->get_error()),TRUE));
          }
          
          $this->load->view('settings/position_add',array('result'=>$result));
      }
      
      function delete_position()
      {
          $this->load->model('positions_actions');
          $this->positions_actions->delete_position($this->input->post('position_id'));
          $this->load->view('settings/position_delete',array('position_id'=>$this->input->post('position_id')));
      }
      
      function new_position()
      {
          $this->load->model('positions_actions');
          $this->load->model('departments_actions');
          
          $this->load->view('settings/position_new',array(
            'skills'=>$this->positions_actions->get_required_skills(0),
            'departments'=>$this->departments_actions->get_departments_list()
          ));
      }
      
      function resign_reasons()
      {
          $this->load->model('mix_actions');
          $this->load->view('settings/resign_reasons',array('reasons'=>$this->mix_actions->get_resign_reasons()));
      }
      
      function edit_reason($reason_id=0)
      {
          $this->load->model('mix_actions');
          $this->load->view('settings/reason_edit',array('reason'=>$this->mix_actions->get_reason($reason_id)));
      }
      
      function save_reason()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'reason_id','rules'=>'required','label'=>'reason_id'),
            array('field'=>'reason_name','rules'=>'required','label'=>$this->lang->line('Reason name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('mix_actions');
          $this->load->view('settings/reason_add',array('result'=>$this->mix_actions->save_reason()));
      }
      
      function delete_reason()
      {
          $this->load->model('mix_actions');
          $this->mix_actions->delete_reason($this->input->post('reason_id'));
          $this->load->view('settings/reason_delete',array('reason_id'=>$this->input->post('reason_id')));
      }
      
      function new_reason()
      {
          $this->load->view('settings/reason_new');
      }
      
      function departments()
      {
          $this->load->model('departments_actions');
          $this->load->view('settings/departments',array('departments'=>$this->departments_actions->get_departments()));
      }
      
      function view_department($department_id=0)
      {
          $this->load->model('departments_actions');
          echo json_encode($this->departments_actions->get_departments($department_id));
      }
      
      function delete_department($department_id=0)
      {
          $this->load->model('departments_actions');
          $this->departments_actions->delete_department($department_id);
      }
      
      function create_department()
      {
          if (!$this->input->get('parent_department') OR !$this->input->get('department_name'))
          {
              exit();
          }
          
          $this->load->model('departments_actions');
          header('Content-Type: application/json; charset=utf8');
          echo json_encode(array('id'=>$this->departments_actions->save_department()));
      }
      
      function rename_department()
      {
          if (!$this->input->get('department_id') OR !$this->input->get('department_name'))
          {
              exit();
          }
          
          $this->load->model('departments_actions');
          header('Content-Type: application/json; charset=utf8');
          echo json_encode(array('id'=>$this->departments_actions->save_department()));
      }
      
      function move_department()
      {
          if (!$this->input->get('department_id') OR !$this->input->get('new_parent'))
          {
              exit();
          }
          $this->load->model('departments_actions');
          $this->departments_actions->move_department();
          
          header('Content-Type: application/json; charset=utf8');
          echo json_encode(array('message'=>$this->lang->line('Done')));
      }
  }
?>
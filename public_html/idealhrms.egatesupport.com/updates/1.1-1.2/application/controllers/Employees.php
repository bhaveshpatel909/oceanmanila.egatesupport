<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property employees_actions          $employees_actions
    * @property mix_actions          $mix_actions
    * @property attachments_actions          $attachments_actions
    * @property positions_actions          $positions_actions
    */
  
  class Employees extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('employees');
      }
      
      function index($page_id=1)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/index',array(
            'employees'=>$this->employees_actions->get_employees($page_id),
            'search'=>$this->input->get('search')
          ));
      }
      
      function edit_employee($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/employee_edit',array(
            'employee'=>$this->employees_actions->get_employee($employee_id)
          ));
      }
      
      function save_employee()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'employee_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'employee_email','rules'=>'required|valid_email','label'=>$this->lang->line('Email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          
          if (!$result=$this->employees_actions->save_employee())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->view('employees/employee_save',array(
            'result'=>$result,
            'avatar'=>$this->employees_actions->get_avatar()
          ));
      }
      
      function new_employe()
      {
          $this->load->view('employees/employee_new');
      }
      
      function save_address()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->save_address();
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Saved')));
      }
      
      function resign($employee_id=0)
      {
          $this->load->model('mix_actions');
          $this->load->view('employees/employee_resign',array(
            'reasons'=>$this->mix_actions->get_resign_reasons(),
            'employee_id'=>$employee_id
          ));
      }
      
      function save_resign()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'reason','rules'=>'required','label'=>$this->lang->line('Reason')),
            array('field'=>'date','rules'=>'required','label'=>$this->lang->line('Date'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$this->employees_actions->resing_employee())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->view('employees/employee_resigned');
      }
      
      /**
       * Education
       * 
       */
      
      function education($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/education',array('education'=>$this->employees_actions->get_education($employee_id)));
      }
      
      function edit_education($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('employees/education_edit',array(
            'data'=>$this->employees_actions->get_education_item($item_id),
            'attachments'=>$this->attachments_actions->get_attachments($item_id,'education')
          ));
      }
      
      function save_education()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE)); 
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'education_id','rules'=>'required','label'=>'education_id'),
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'institution_name','rules'=>'required','label'=>$this->lang->line('Institution')),
            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          
          if (!$result=$this->employees_actions->save_education())
          {
              exit ($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('employees/education_add',$result);
      }
      
      function new_education($employee_id=0)
      {
          $this->load->view('employees/education_new',array('employee_id'=>$employee_id));
      }
      
      function delete_education()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->delete_education($this->input->post('education_id'));
          $this->load->view('employees/education_delete',array('education_id'=>$this->input->post('education_id')));
      }
      
      
      
      function positions($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/positions',array('positions'=>$this->employees_actions->get_positions($employee_id)));
      }
      
      function position_edit($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/position_edit',array('position'=>$this->employees_actions->get_position($item_id)));
      }
      
      function update_position()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->update_position();
          $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));
      }
      
      function position_view($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/position_view',array('position'=>$this->employees_actions->get_position($item_id)));
      }
      
      function new_position($employee_id=0)
      {
          $this->load->model('positions_actions');
          $this->load->model('employees_actions');
          
          $this->load->view('employees/position_new',array(
            'positions'=>$this->positions_actions->get_grouped_positions(),
            'employee_id'=>$employee_id,
            'current_position'=>$this->employees_actions->get_current_position($employee_id)
          ));
      }
      
      function save_position()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'new_position','rules'=>'required','label'=>$this->lang->line('New position')),
            array('field'=>'start_date','rules'=>'required','label'=>$this->lang->line('Start date')),
            array('field'=>'move_reason','rules'=>'required','label'=>$this->lang->line('Move reason'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$this->employees_actions->add_position())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->view('employees/position_add');
      }
      
      function check_position($position_id=0,$employee_id=0)
      {
          $this->load->model('positions_actions');
          $this->load->view('employees/position_compatible',array('data'=>$this->positions_actions->check_position($position_id,$employee_id)));
      }
      
      function skills($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/skills',array('skills'=>$this->employees_actions->get_skills($employee_id)));
      }
      
      function edit_skills($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/skills_edit',array(
            'skills'=>$this->employees_actions->get_employee_skills($employee_id),
            'employee_id'=>$employee_id
          ));
      }
      
      function save_skills()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$result=$this->employees_actions->save_employee_skills())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->view('employees/skills_add',array('result'=>$result));
      }
      
      
      
      function employment($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/employment',array('employment'=>$this->employees_actions->get_employment($employee_id)));
      }
      
      function edit_employment($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/employment_edit',array('employment'=>$this->employees_actions->get_employment_item($item_id)));
      }
      
      function save_employment()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employment_id','rules'=>'required','label'=>'employment_id'),
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'company','rules'=>'required','label'=>$this->lang->line('Company')),
            array('field'=>'position','rules'=>'required','label'=>$this->lang->line('Position')),
            array('field'=>'start','rules'=>'required','label'=>$this->lang->line('Start')),
            array('field'=>'end','rules'=>'required','label'=>$this->lang->line('End'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$result=$this->employees_actions->save_employment())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->view('employees/employment_add',array('result'=>$result));
      }
      
      function new_employment($employee_id=0)
      {
          $this->load->view('employees/employment_new',array('employee_id'=>$employee_id));
      }
      
      function delete_employment()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->delete_employment($this->input->post('employment_id'));
          $this->load->view('employees/employment_delete',array('employment_id'=>$this->input->post('employment_id')));
      }
      
      
      
      function relatives($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/family',array('family'=>$this->employees_actions->get_family($employee_id)));
      }
      
      function edit_relative($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('employees/relative_edit',array(
            'relative'=>$this->employees_actions->get_relative($item_id),
            'attachments'=>$this->attachments_actions->get_attachments($item_id,'relative')
          ));
      }
      
      function save_relative()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE)); 
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'relative_id','rules'=>'required','label'=>'relative_id'),
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id'),
            array('field'=>'relative_name','rules'=>'required','label'=>$this->lang->line('Name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('employees_actions');
          if (!$result=$this->employees_actions->save_relative())
          {
              exit($this->load->view('layout/error',array('error'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('employees/relative_add',$result);
      }
      
      function delete_relative()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->delete_relative($this->input->post('relative_id'));
          $this->load->view('employees/relative_delete',array('relative_id'=>$this->input->post('relative_id')));
      }
      
      function new_relative($employee_id=0)
      {
          $this->load->view('employees/relative_new',array('employee_id'=>$employee_id));
      }
      
      function licenses($employee_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->view('employees/licenses',array('licenses'=>$this->employees_actions->get_licenses($employee_id)));
      }
      
      function edit_license($item_id=0)
      {
          $this->load->model('employees_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('employees/license_edit',array(
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
          if (!$result=$this->employees_actions->save_license())
          {
              exit($this->load->view('layout/error',array('message'=>$this->employees_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('employees/license_add',$result);
      }
      
      function delete_license()
      {
          $this->load->model('employees_actions');
          $this->employees_actions->delete_license($this->input->post('license_id'));
          $this->load->view('employees/license_delete',array('license_id'=>$this->input->post('license_id')));
      }
      
      function new_license($employee_id=0)
      {
          $this->load->view('employees/license_new',array('employee_id'=>$employee_id));
      }
      
      function remove_attachment($attachment_id=0)
      {
          $this->load->model('attachments_actions');
          $this->attachments_actions->remove_attachment($attachment_id);
      }
      
      function download_attachment($attachment_id=0)
      {
          $this->load->model('attachments_actions');
          $this->attachments_actions->download_attachment($attachment_id);
      }
      
      function set_password($employee_id=0)
      {
          if (($employee_id=='1') OR (!$this->user_actions->is_allowed('admin')))
          {
              return FALSE;
          }
          
          $this->load->view('employees/password_set',array(
            'is_active'=>$this->user_actions->is_employee_active($employee_id),
            'employee_id'=>$employee_id,
            'permissions'=>$this->user_actions->get_permissions($employee_id)
          ));
      }
      
      function save_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'employee_id','rules'=>'required','label'=>'employee_id')
          ));
          
          if ($this->input->post('new_password'))
          {
              $this->form_validation->set_rules(array(
                array('field'=>'new_password','rules'=>'required','label'=>$this->lang->line('New password')),
                array('field'=>'password_again','rules'=>'required','label'=>$this->lang->line('Password again'))
              ));
          }
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/success',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->user_actions->update_password();
          $this->load->view('layout/success',array('message'=>$this->lang->line('Done')));
      }
  }
?>
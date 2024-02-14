<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property recruiting_actions          $recruiting_actions
    * @property positions_actions          $positions_actions
    * @property attachments_actions          $attachments_actions
    */
  
  class Recruiting extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('recruiting');
      }
      
      function index()
      {
          $this->load->model('recruiting_actions');
          $this->load->view('recruiting/index',array('vacancies'=>$this->recruiting_actions->get_vacancies()));
      }
      
      function vacancy($vacancy_id=0)
      {
          $this->load->model('recruiting_actions');
          $vacancy=$this->recruiting_actions->get_vacancy($vacancy_id);
          
          $this->load->model('positions_actions');
          
          $this->load->view('recruiting/vacancy_edit',array(
            'vacancy'=>$vacancy,
            'skills'=>$this->positions_actions->get_required_skills($vacancy['position_id']),
            'applicants'=>$this->recruiting_actions->get_applicants($vacancy_id)
          ));
      }
      
      function edit_applicant($applicant_id=0)
      {
          $this->load->model('recruiting_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('recruiting/applicant_edit',array(
            'applicant'=>$this->recruiting_actions->get_applicant($applicant_id),
            'attachments'=>$this->attachments_actions->get_attachments($applicant_id,'applicant')
          ));
      }
      
      function save_applicant()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE)); 
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'applicant_id','rules'=>'required','label'=>'applicant_id'),
            array('field'=>'applicant_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'applicant_email','rules'=>'required|valid_email','label'=>$this->lang->line('Email')),
            array('field'=>'birth_date','rules'=>'required','label'=>$this->lang->line('Birth date')),
            array('field'=>'applicant_phone','rules'=>'required','label'=>$this->lang->line('Phone'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('recruiting_actions');
          
          if (!$result=$this->recruiting_actions->save_applicant())
          {
              exit ($this->load->view('layout/error',array('message'=>$this->recruiting_actions->get_error()),TRUE));
          }
          
          $this->load->helper('fa-extension');
          $this->load->view('recruiting/applicant_add',$result);
      }
      
      function new_applicant($vacancy_id=0)
      {
          $this->load->view('recruiting/applicant_new',array('vacancy_id'=>$vacancy_id));
      }
      
      function save_status()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'applicant_id','rules'=>'required','label'=>'applicant_id'),
            array('field'=>'status','rules'=>'required','label'=>'status')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('recruiting_actions');
          
          if(!$result=$this->recruiting_actions->change_status())
          {
              exit($this->load->view('layout/error',array('message'=>$this->recruiting_actions->get_error()),TRUE));
          }
          
          $this->load->view('recruiting/applicant_change',array(
            'status'=>$this->lang->line($this->input->post('status')),
            'result'=>$result
          ));
      }
      
      function save_vacancy()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'vacancy_id','rules'=>'required','label'=>'vacancy_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('recruiting_actions');
          $this->load->view('recruiting/vacancy_add',array('result'=>$this->recruiting_actions->save_vacancy()));
      }
      
      function cancel_vacancy($vacancy_id=0)
      {
          $this->load->model('recruiting_actions');
          $this->recruiting_actions->cancel_vacancy($vacancy_id);
      }
      
      function new_vacancy()
      {
          $this->load->model('positions_actions');
          
          $this->load->view('recruiting/vacancy_new',array('positions'=>$this->positions_actions->get_grouped_positions(),));
      }
      
      function applicants()
      {
          $this->load->model('recruiting_actions');
          $this->load->view('recruiting/applicants',array('applicants'=>$this->recruiting_actions->get_applicants_list()));
      }
      
      function applicant($applicant_id=0)
      {
          $this->load->model('recruiting_actions');
          $this->load->model('attachments_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('recruiting/applicant_view',array(
            'applicant'=>$this->recruiting_actions->get_applicant($applicant_id),
            'attachments'=>$this->attachments_actions->get_attachments($applicant_id,'applicant')
          ));
      }
  }
?>
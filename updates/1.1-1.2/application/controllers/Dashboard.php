<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property timeoff_actions          $timeoff_actions
    * @property discipline_actions          $discipline_actions
    * @property assessments_actions          $assessments_actions
    * @property performance_actions          $performance_actions
    * @property reports_actions          $reports_actions
    * @property mix_actions          $mix_actions
    * @property recruiting_actions          $recruiting_actions
    * @property positions_actions          $positions_actions
    * @property documents_actions          $documents_actions
    * @property cron_actions          $cron_actions
    */
  class Dashboard extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('selfservice');
      }
      
      function index()
      {
          if ($this->user_actions->is_selfservice())
          {
              $this->load->model('timeoff_actions');
              $this->load->model('discipline_actions');
              $this->load->model('assessments_actions');
              $this->load->model('performance_actions');
              $this->load->model('mix_actions');
              $this->load->helper('dates_format');
              
              
              $this->load->view('selfservice/index',array(
                'timeoff'=>$this->timeoff_actions->get_employee_records(),
                'discipline'=>$this->discipline_actions->get_employee_records(),
                'skills'=>$this->assessments_actions->get_employee_assessments(),
                'performance'=>$this->performance_actions->get_employee_appraisal(),
                'clock'=>$this->mix_actions->get_punch_clock()
              ));
          }
          else
          {
              $this->load->model('reports_actions');
              $this->load->model('mix_actions');
              
              $this->load->view('dashboard/index',array(
                'newly_hired'=>$this->reports_actions->get_newly_hired(),
                'discipline'=>$this->reports_actions->get_last_discipline(),
                'unsent_emails'=>$this->mix_actions->get_unsent_emails()
              ));
          }
      }
      
      function send_emails()
      {
          if ($this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('cron_actions');
          $this->cron_actions->send_notifications();
          $this->load->view('layout/refresh');
      }
      
      
      function timeoff($record_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          $this->load->model('timeoff_actions');
          $this->load->view('selfservice/timeoff_view',array('record'=>$this->timeoff_actions->get_record($record_id,array('approved','denied','request'))));
      }
      
      function new_timeoff()
      {
          $this->load->view('selfservice/timeoff_new');
      }
      
      function save_timeoff()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'record_id','rules'=>'required','label'=>'record_id'),
            array('field'=>'start_time','rules'=>'required','label'=>$this->lang->line('Start time')),
            array('field'=>'end_time','rules'=>'required','label'=>$this->lang->line('End time')),
            array('field'=>'type','rules'=>'required','label'=>$this->lang->line('Type'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('timeoff_actions');
          $_POST['employee_id'][0]=$this->session->current->userdata('employee_id');
          $this->load->view('selfservice/timeoff_add',array('result'=>$this->timeoff_actions->save_record()));
      }
      
      function discipline($record_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('discipline_actions');
          $this->load->view('selfservice/discipline',array('discipline'=>$this->discipline_actions->get_record($record_id)));
      }
      
      function save_comment()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'record_id','rules'=>'required','label'=>'record_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('discipline_actions');
          $this->discipline_actions->save_comment();
          $this->load->view('layout/success',array('message'=>$this->lang->line('Saved')));
      }
      
      function assessment($assessment_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('assessments_actions');
          $this->load->view('selfservice/assessment',array('assessment'=>$this->assessments_actions->get_results($this->session->current->userdata('employee_id'),$assessment_id,FALSE)));
      }
      
      function appraisal($appraisal_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('performance_actions');
          $this->load->view('selfservice/appraisal',array(
            'appraisal'=>$this->performance_actions->get_appraisal($appraisal_id),
            'logs'=>$this->performance_actions->get_appraisal_logs($appraisal_id)
          ));
      }
      
      function update_clock_comments()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('mix_actions');
          $this->mix_actions->update_clock_comments();
      }
      
      function complete_clock()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('mix_actions');
          $this->mix_actions->complete_clock();
          
          $this->load->helper('dates_format');
          $this->load->view('selfservice/clock',array('clock'=>$this->mix_actions->get_latest_clock()));
      }
      
      function start_clock()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('mix_actions');
          $this->mix_actions->start_clock();
      }
      
      function vacancies()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('recruiting_actions');
          $this->load->view('selfservice/vacancies',array('vacancies'=>$this->recruiting_actions->get_open_vacancies()));
      }
      
      function apply_to_vacancy($vacancy_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('recruiting_actions');
          $this->load->model('positions_actions');
          
          $vacancy=$this->recruiting_actions->get_vacancy($vacancy_id);
          $this->load->view('selfservice/apply_to_vacancy',array(
            'vacancy'=>$vacancy,
            'data'=>$this->positions_actions->check_position($vacancy['position_id'],$this->session->current->userdata('employee_id'))
          ));
      }
      
      function proccess_apply()
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'vacancy_id','rules'=>'required','label'=>'vacancy_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('recruiting_actions');
          if (!$this->recruiting_actions->apply_employee())
          {
              exit($this->load->view('layout/error',array('message'=>$this->recruiting_actions->get_error()),TRUE));
          }
          
          $this->load->view('selfservice/applied');
      }
      
      function my_documents($page_id=1)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('documents_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('selfservice/documents_index',array(
            'documents'=>$this->documents_actions->get_employee_documents($page_id),
            'search'=>$this->input->get('search')
          ));
      }
      
      function download_document($document_id=0)
      {
          if (!$this->user_actions->is_selfservice())
          {
              exit();
          }
          
          $this->load->model('documents_actions');
          $this->documents_actions->download_document($document_id);
      }
  }
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property performance_actions          $performance_actions
    * @property employees_actions          $employees_actions
    */
  class Performance extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('performance');
      }
      
      function index()
      {
          $this->load->model('performance_actions');
          $this->load->view('performance/index',array('appraisals'=>$this->performance_actions->get_appraisals()));
      }
      
      function new_appraisal()
      {
          $this->load->view('performance/appraisal_new');
      }
      
      function find_employee()
      {
          $this->load->model('employees_actions');
          echo json_encode($this->employees_actions->search_employee());
      }
      
      function save_appraisal()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'appraisal_id','rules'=>'required','label'=>'appraisal_id'),
            array('field'=>'employee_id[]','rules'=>'required','label'=>$this->lang->line('Employee')),
            array('field'=>'expectations','rules'=>'required','label'=>$this->lang->line('Expectations'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('performance_actions');
          $this->load->view('performance/appraisal_add',array('result'=>$this->performance_actions->save_appraisal()));
      }
      
      function appraisal($appraisal_id=0)
      {
          $this->load->model('performance_actions');
          $this->load->view('performance/appraisal',array(
            'appraisal'=>$this->performance_actions->get_appraisal($appraisal_id),
            'logs'=>$this->performance_actions->get_appraisal_logs($appraisal_id)
          ));
      }
      
      function remove_log($log_id=0)
      {
          $this->load->model('performance_actions');
          $this->performance_actions->remove_log($log_id);
          $this->load->view('layout/success',array('message'=>$this->lang->line('Deleted')));
      }
      
      function new_log($appraisal_id=0)
      {
          $this->load->model('performance_actions');
          $this->load->view('performance/log_new',array(
            'criteria'=>$this->performance_actions->get_criteria(),
            'appraisal_id'=>$appraisal_id
          ));
      }
      
      function save_log()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'date','rules'=>'required','label'=>$this->lang->line('Date')),
            array('field'=>'comment','rules'=>'required','label'=>$this->lang->line('Comment')),
            array('field'=>'appraisal_id','rules'=>'required','label'=>'appraisal_id')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('performance_actions');
          if (!$log_id=$this->performance_actions->save_log())
          {
              exit($this->load->view('layout/error',array('message'=>$this->performance_actions->get_error()),TRUE));
          }
          $this->load->view('performance/log_add',array('log_id'=>$log_id));
      }
      
      function mark_completed($appraisal_id=0)
      {
          $this->load->view('performance/mark_completed',array('appraisal_id'=>$appraisal_id));
      }
      
      function proccess_complete()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'appraisal_id','rules'=>'required','label'=>'appraisal_id'),
            array('field'=>'results','rules'=>'required','label'=>$this->lang->line('Results'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('performance_actions');
          $this->performance_actions->mark_as_completed();
          $this->load->view('layout/success',array('message'=>$this->lang->line('Completed')));
          $this->load->view('layout/refresh');
      }
      
      function criteria()
      {
          $this->load->model('performance_actions');
          $this->load->view('performance/criteria',array('criteria'=>$this->performance_actions->get_criteria()));
      }
      
      function edit_criterion($criterion_id=0)
      {
          $this->load->model('performance_actions');
          $this->load->view('performance/criterion_edit',array('criterion'=>$this->performance_actions->get_criterion($criterion_id)));
      }
      
      function save_criterion()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'criterion_id','rules'=>'required','label'=>'criterion_id'),
            array('field'=>'criterion_name','rules'=>'required','label'=>$this->lang->line('Name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('performance_actions');
          $this->load->view('performance/criterion_add',array('result'=>$this->performance_actions->save_criterion()));
      }
      
      function delete_criterion()
      {
          $this->load->model('performance_actions');
          $this->performance_actions->delete_criterion($this->input->post('criterion_id'));
          $this->load->view('performance/criterion_delete',array('criterion_id'=>$this->input->post('criterion_id')));
      }
      
      function new_criterion()
      {
          $this->load->view('performance/criterion_new');
      }
  }
?>
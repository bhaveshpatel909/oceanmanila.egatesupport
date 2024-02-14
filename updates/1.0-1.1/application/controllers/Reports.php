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
    * @property departments_actions          $departments_actions
    * @property reports_actions          $reports_actions
    */
  
  class Reports extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('reports');
      }
      
      function index()
      {
          
      }
      
      function skills()
      {
          $this->load->model('departments_actions');
          $this->load->view('reports/skills/index',array(
            'departments'=>$this->departments_actions->get_departments_list()
          ));
      }
      
      function get_departments()
      {
          $this->load->model('departments_actions');
          $this->load->view('reports/departments',array(
            'departments'=>$this->departments_actions->get_departments_list()
          ));
      }
      
      function proccess_report()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'report_category','rules'=>'required','label'=>'report_category'),
            array('field'=>'report_type','rules'=>'required','label'=>'report_type'),
            array('field'=>'start_date','rules'=>'required','label'=>$this->lang->line('Start date')),
            array('field'=>'end_date','rules'=>'required','label'=>$this->lang->line('End date'))
          ));
          
          $this->load->model('reports_actions');
          $this->reports_actions->validate_fields();
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->view('reports/'.$this->input->post('report_category').'/'.$this->input->post('report_type'),array('data'=>$this->reports_actions->get_results()));
      }
      
      function clock()
      {
          $this->load->view('reports/clock/index');
      }
      
      function find_employee()
      {
          $this->load->model('employees_actions');
          echo json_encode($this->employees_actions->search_employee());
      }
  }
?>
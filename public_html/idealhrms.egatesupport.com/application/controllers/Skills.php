<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property skills_actions          $skills_actions
    * @property assessments_actions          $assessments_actions
    * @property departments_actions          $departments_actions
    * @property employees_actions          $employees_actions
    */
  
  class Skills extends CI_Controller
  {
      
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('skills');
      }
      
      function index()
      {
          $this->load->model('skills_actions');
          $this->load->view('skills/index',array('skills'=>$this->skills_actions->get_skills()));
      }
      
      function edit_skill($skill_id=0)
      {
          $this->load->model('skills_actions');
          $this->load->view('skills/skill_edit',array(
            'skill'=>$this->skills_actions->get_skill($skill_id),
            'categories'=>$this->skills_actions->get_categories()
          ));
      }
      
      function save_skill()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'skill_id','rules'=>'required','label'=>'skill_id'),
            array('field'=>'skill_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'parent_category','rules'=>'required','label'=>$this->lang->line('Category'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('skills_actions');
          if (!$result=$this->skills_actions->save_skill())
          {
              exit($this->load->view('layout/error',array('message'=>$this->skills_actions->get_error()),TRUE));
          }
          
          $this->load->view('skills/skill_add',array('result'=>$result));
      }
      
      function delete_skill()
      {
          $this->load->model('skills_actions');
          $this->skills_actions->delete_skill($this->input->post('skill_id'));
          $this->load->view('skills/skill_delete',array('skill_id'=>$this->input->post('skill_id')));
      }
      
      function new_skill()
      {
          $this->load->model('skills_actions');
          $this->load->view('skills/skill_new',array('categories'=>$this->skills_actions->get_categories()));
      }
      
      function categories()
      {
          $this->load->model('skills_actions');
          $this->load->view('skills/categories',array('categories'=>$this->skills_actions->get_categories()));
      }
      
      function edit_category($category_id=0)
      {
          $this->load->model('skills_actions');
          $this->load->view('skills/category_edit',array('category'=>$this->skills_actions->get_category($category_id)));
      }
      
      function save_category()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'category_id','rules'=>'required','label'=>'category_id'),
            array('field'=>'category_name','rules'=>'required','label'=>$this->lang->line('Name'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('skills_actions');
          if (!$result=$this->skills_actions->save_category())
          {
              exit($this->load->view('layout/error',array('message'=>$this->skills_actions->get_error()),TRUE));
          }
          
          $this->load->view('skills/category_add',array('result'=>$result));
      }
      
      function delete_category()
      {
          $this->load->model('skills_actions');
          $this->skills_actions->delete_category($this->input->post('category_id'));
          $this->load->view('skills/category_delete',array('category_id'=>$this->input->post('category_id')));
      }
      
      function new_category()
      {
          $this->load->view('skills/category_new');
      }
      
      function assessments()
      {
          $this->load->model('assessments_actions');
          $this->load->view('assessments/index',array('assessments'=>$this->assessments_actions->get_assessments()));
      }
      
      function edit_assessment($assessment_id=0)
      {
          $this->load->model('assessments_actions');
          $this->load->view('assessments/assessment_edit',array('assessment'=>$this->assessments_actions->get_assessment($assessment_id)));
      }
      
      function save_assessment()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'assessment_id','rules'=>'required','label'=>'assessment_id'),
            array('field'=>'assessment_name','rules'=>'required','label'=>$this->lang->line('Name')),
            array('field'=>'assessment_date','rules'=>'required','label'=>$this->lang->line('Date'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('assessments_actions');
          if (!$result=$this->assessments_actions->save_assessment())
          {
              exit($this->load->view('layout/error',array('message'=>$this->assessments_actions->get_error()),TRUE));
          }
          
          $this->load->view('assessments/assessment_add',array('result'=>$result));
      }
      
      function delete_assessment()
      {
          $this->load->model('assessments_actions');
          $this->assessments_actions->delete_assessment($this->input->post('assessment_id'));
          $this->load->view('assessments/assessment_delete',array('assessment_id'=>$this->input->post('assessment_id')));
      }
      
      function new_assessment()
      {
          $this->load->model('departments_actions');
          $this->load->view('assessments/assessment_new',array('departments'=>$this->departments_actions->get_departments_list()));
      }
      
      function set_assessments($assessment_id=0)
      {
          $this->load->model('assessments_actions');
          
          $this->load->view('assessments/assessments_set',array(
            'employees'=>$this->assessments_actions->get_employees($assessment_id),
            'assessment'=>$this->assessments_actions->get_assessment($assessment_id)
          ));
      }
      
      function assessment_results($employee_id=0,$assessment_id=0)
      {
          $this->load->model('assessments_actions');
          $this->load->model('employees_actions');
          
          $this->load->view('assessments/assessment_results',array(
            'results'=>$this->assessments_actions->get_results($employee_id,$assessment_id),
            'employee'=>$this->employees_actions->get_employee($employee_id),
            'employee_id'=>$employee_id,
            'assessment_id'=>$assessment_id
          ));
      }
      
      function save_results()
      {
          $this->load->model('assessments_actions');
          $this->assessments_actions->save_results();
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Saved')));
      }
  }
?>
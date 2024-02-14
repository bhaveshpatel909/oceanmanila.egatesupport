<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Assessments_actions extends Base_model
  {
      function get_assessments()
      {
          return $this->db
                      ->select('assessment_id,assessment_name,assessment_date,department_name')
                      ->join('departments','departments.department_id = assessments.assessment_department','LEFT')
                      ->get('assessments')
                      ->result_array();
      }
      
      function get_assessment($assessment_id=0)
      {
          return $this->db
                      ->select('assessment_id,assessment_name,assessment_date')
                      ->where('assessment_id',$assessment_id)
                      ->get('assessments')
                      ->row_array();
      }
      
      function save_assessment()
      {
          $data=array(
            'assessment_name'=>$this->input->post('assessment_name'),
            'assessment_date'=>date('Y-m-d',strtotime($this->input->post('assessment_date')))
          );
          
          if ($this->input->post('assessment_id')=='0')
          {
              $data['assessment_department']=$this->input->post('assessment_department');
              $this->db->insert('assessments',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('assessments',$data,array('assessment_id'=>$this->input->post('assessment_id')));
          return TRUE;
      }
      
      function delete_assessment($assessment_id)
      {
          $this->db->delete('assessments',array('assessment_id'=>$assessment_id));
          $this->db->delete('assessments_results',array('assessment_id'=>$assessment_id));
      }
      
      function get_employees($assessment_id)
      {
          return $this->db
                      ->select('employees.employee_id,name,avatar,COUNT(IFNULL(level,NULL)) as completed, COUNT(IFNULL(level,1)) as waiting',FALSE)  
                      ->join('employees_positions','employees_positions.department_id = assessments.assessment_department AND employees_positions.is_current=1','LEFT')
                      ->join('employees','employees.employee_id = employees_positions.employee_id','LEFT')
                      ->join('employees_skills','employees_skills.employee_id = employees.employee_id AND to_delete=0','LEFT')
                      ->join('assessments_results','assessments_results.employee_id = employees.employee_id AND employees_skills.skill_id = assessments_results.skill_id AND assessments_results.assessment_id = assessments.assessment_id','LEFT')
                      ->where('assessments.assessment_id',$assessment_id)
                      ->where('employees.employee_id IS NOT NULL',NULL,FALSE)
                      ->group_by('employees.employee_id')
                      ->order_by('name')
                      ->get('assessments')
                      ->result_array();
      }
      
      function get_results($employee_id,$assessment_id,$show_all=TRUE)
      {
          $this->db->where(array('employees_skills.employee_id'=>$employee_id,'to_delete'=>0));
          
          if (!$show_all)
          {
              $this->db->where('(level IS NOT NULL OR comment IS NOT NULL)',NULL,FALSE);
          }
          
          $temp=$this->db
                     ->select('skills.skill_id,skill_name,category_id,category_name,level,comment')
                     ->join('assessments_results','assessments_results.employee_id = employees_skills.employee_id AND assessments_results.skill_id = employees_skills.skill_id AND assessments_results.assessment_id='.$assessment_id,'LEFT')
                     ->join('skills','skills.skill_id = employees_skills.skill_id','LEFT')
                     ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                     ->order_by('category_name, skill_name')
                     ->get('employees_skills')
                     ->result_array();
          $result=array();
          
          foreach($temp as $skill)
          {
              $result[$skill['category_id']][]=$skill;
          }
          
          return $result;
      }
      
      function save_results()
      {
          $comments=$this->input->post('comments');
          $this->db->delete('assessments_results',array('assessment_id'=>$this->input->post('assessment_id'),'employee_id'=>$this->input->post('employee_id')));
          foreach($this->input->post('levels') as $skill_id=>$level)
          {
              if (($level) OR ($comments[$skill_id]))
              {
                  $this->db
                       ->query('INSERT INTO assessments_results(assessment_id,skill_id,employee_id,level,comment) 
                                VALUES (?,?,?,?,?)
                                ON DUPLICATE KEY UPDATE level=?,comment=?',array($this->input->post('assessment_id'),$skill_id,$this->input->post('employee_id'),(int)$level,$comments[$skill_id],(int)$level,$comments[$skill_id]));
              }
          }
      }
      
      function get_employee_assessments()
      {
          return $this->db
                      ->select('assessments_results.assessment_id, assessment_name, assessment_date')
                      ->join('assessments','assessments.assessment_id = assessments_results.assessment_id','LEFT')
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->group_by('assessments_results.assessment_id')
                      ->limit(5)
                      ->get('assessments_results')
                      ->result_array();
      }
  }
?>
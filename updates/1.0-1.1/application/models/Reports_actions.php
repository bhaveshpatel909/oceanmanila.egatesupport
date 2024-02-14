<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Reports_actions extends Base_model
  {
      function get_results()
      {
          return call_user_func(array($this,$this->input->post('report_category').'_'.$this->input->post('report_type')));
      }
      
      function validate_fields()
      {
          switch($this->input->post('report_category').'_'.$this->input->post('report_type'))
          {
              
          }
      }
      
      function get_newly_hired()
      {
          return $this->db
                      ->select('name,avatar, position_name, department_name, hired_at,vacancies_applicants.employee_id')
                      ->join('employees','employees.employee_id = vacancies_applicants.employee_id','LEFT')
                      ->join('employees_positions','employees_positions.employee_id  = employees.employee_id AND employees_positions.is_current=1','LEFT')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('vacancies_applicants.status','Enrolled')
                      ->limit(5)
                      ->order_by('vacancies_applicants.employee_id','DESC')
                      ->get('vacancies_applicants')
                      ->result_array();
      }
      
      function get_last_discipline()
      {
          return $this->db
                      ->select('date, headline, name,avatar, position_name, department_name')
                      ->join('employees','employees.employee_id = discipline.employee_id','LEFT')
                      ->join('employees_positions','employees_positions.employee_id  = employees.employee_id AND employees_positions.is_current=1','LEFT')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->limit(5)
                      ->order_by('date DESC')
                      ->get('discipline')
                      ->result_array();
      }
      
      function clock_default()
      {
          if (isset($_POST['employee']))
          {
              $this->db->where('punch_clock.employee_id',(int)$_POST['employee'][0]);
          }
          else
          {
              $this->db
                   ->select('name, position_name, department_name, avatar')
                   ->join('employees','employees.employee_id = punch_clock.employee_id','LEFT')
                   ->join('employees_positions','employees_positions.employee_id = punch_clock.employee_id AND employees_positions.is_current=1','LEFT')
                   ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                   ->join('departments','departments.department_id = employees_positions.department_id','LEFT');
          }
          
          return $this->db
                      ->select('start_time,end_time, DATE_FORMAT(start_time,"%Y%m%d") as date_id, comments')
                      ->where(array('start_time >= '=>date('Y-m-d',strtotime($this->input->post('start_date'))),'start_time <= '=>date('Y-m-d',strtotime($this->input->post('end_date')))))
                      ->order_by('start_time')
                      ->get('punch_clock')
                      ->result_array();
      }
  }
?>
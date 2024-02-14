<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Performance_actions extends Base_model
  {
      function get_appraisals()
      {
          return $this->db
                      ->select('appraisal_id, start_date, end_date, is_completed, name')
                      ->join('employees','employees.employee_id = performance_appraisal.employee_id','LEFT')
                      ->get('performance_appraisal')
                      ->result_array();
      }
      
      function save_appraisal()
      {
          $data=array(
            'start_date'=>($this->input->post('start_date'))?date('Y-m-d',strtotime($this->input->post('start_date'))):NULL,
            'end_date'=>($this->input->post('end_date'))?date('Y-m-d',strtotime($this->input->post('end_date'))):NULL,
            'expectations'=>$this->input->post('expectations')
          );
          
          if ($this->input->post('appraisal_id')=='0')
          {
              $employee_id=$this->input->post('employee_id');
              $data['employee_id']=$employee_id[0];
              $this->db->insert('performance_appraisal',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('performance_appraisal',$data,array('appraisal_id'=>$this->input->post('appraisal_id'),'is_completed'=>0));
          
          return TRUE;
      }
      
      function get_appraisal($appraisal_id)
      {
          return $this->db
                      ->select('appraisal_id,start_date,end_date, expectations, results, is_completed, name, avatar, position_name, department_name,employees.employee_id')
                      ->join('employees','employees.employee_id = performance_appraisal.employee_id','LEFT')
                      ->join('employees_positions','employees_positions.employee_id = performance_appraisal.employee_id AND employees_positions.is_current=1','LEFT')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = employees_positions.department_id','LEFT')
                      ->where('appraisal_id',$appraisal_id)
                      ->get('performance_appraisal')
                      ->row_array();
      }
      
      function get_appraisal_logs($appraisal_id)
      {
          $temp=$this->db
                     ->select('performance_log.log_id, date, comment, criteria_result, criterion_name')
                     ->join('performance_log_criteria','performance_log_criteria.log_id = performance_log.log_id','LEFT')
                     ->join('performance_criteria','performance_criteria.criterion_id = performance_log_criteria.criteria_id','LEFT')
                     ->where('appraisal_id',$appraisal_id)
                     ->order_by('date, criterion_name')
                     ->get('performance_log')
                     ->result_array();
          $result=array();
          
          foreach($temp as $log)
          {
              $result[$log['log_id']][]=$log;
          }
          
          return $result;
      }
      
      function remove_log($log_id)
      {
          $is_completed=$this->db
                             ->select('is_completed')
                             ->join('performance_appraisal','performance_appraisal.appraisal_id = performance_log.appraisal_id','LEFT')
                             ->where(array('log_id'=>$log_id,'is_completed'=>1))
                             ->get('performance_log')
                             ->num_rows()>0;
          
          if (!$is_completed)
          {
              $this->db->delete('performance_log_criteria',array('log_id'=>$log_id));
              $this->db->delete('performance_log',array('log_id'=>$log_id));
          }
      }
      
      function save_log()
      {
          $appraisal=$this->get_appraisal($this->input->post('appraisal_id'));
          if ($appraisal['is_completed']=='1')
          {
              $this->set_error($this->lang->line('Error'));
              return FALSE;
          }
          
          $this->db->insert('performance_log',array(
            'appraisal_id'=>$this->input->post('appraisal_id'),
            'date'=>date('Y-m-d',strtotime($this->input->post('date'))),
            'comment'=>$this->input->post('comment')
          ));
          
          $log_id=$this->db->insert_id();
          
          if (isset($_POST['results']))
          {
              foreach($this->input->post('results') as $criterion_id=>$result)
              {
                  if ($result)
                  {
                       $this->db->insert('performance_log_criteria',array(
                        'log_id'=>$log_id,
                        'criteria_id'=>$criterion_id,
                        'criteria_result'=>min(max(0,(int)$result),5)
                      ));   
                  }
              }    
          }
          
          
          return $log_id;
      }
      
      function mark_as_completed()
      {
          $this->db->update('performance_appraisal',array('results'=>$this->input->post('results'),'is_completed'=>1),array('appraisal_id'=>$this->input->post('appraisal_id'),'is_completed'=>0));
      }
      
      function get_criteria()
      {
          return $this->db
                      ->select('*')
                      ->where('is_active',1)
                      ->order_by('criterion_name')
                      ->get('performance_criteria')
                      ->result_array();
      }
      
      function get_criterion($criterion_id)
      {
          return $this->db
                      ->select('*')
                      ->where(array('criterion_id'=>$criterion_id,'is_active'=>1))
                      ->get('performance_criteria')
                      ->row_array();
      }
      
      function save_criterion()
      {
          $data=array(
            'criterion_name'=>$this->input->post('criterion_name')
          );
          
          if ($this->input->post('criterion_id')=='0')
          {
              $this->db->insert('performance_criteria',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('performance_criteria',$data,array('criterion_id'=>$this->input->post('criterion_id'),'is_active'=>1));
          return TRUE;
      }
      
      function delete_criterion($criterion_id)
      {
          $this->db->update('performance_criteria',array('is_active'=>0),array('criterion_id'=>$criterion_id));
      }
      
      function get_employee_appraisal()
      {
          return $this->db
                      ->select('appraisal_id, start_date, end_date, is_completed,LEFT(expectations,100) as expectations',FALSE)
                      ->where('employee_id',$this->session->current->userdata('employee_id'))
                      ->order_by('is_completed, end_date DESC')
                      ->get('performance_appraisal')
                      ->result_array();
      }
  }
?>
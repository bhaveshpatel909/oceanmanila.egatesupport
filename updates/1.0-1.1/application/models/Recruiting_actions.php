<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    * @property employees_actions          $employees_actions
    */
  
  class Recruiting_actions extends Base_model
  {
      function get_vacancies()
      {
          return $this->db
                      ->select('vacancy_id, position_name, department_name, status')
                      ->join('positions','positions.position_id = vacancies.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->get('vacancies')
                      ->result_array();
      }
      
      function get_vacancy($vacancy_id)
      {
          return $this->db
                      ->select('vacancy_id, position_name, department_name, status,description, vacancies.position_id')
                      ->join('positions','positions.position_id = vacancies.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('vacancy_id',$vacancy_id)
                      ->get('vacancies')
                      ->row_array();
      }
      
      function save_vacancy()
      {
          $data=array(
            'description'=>$this->input->post('description')
          );
          
          if ($this->input->post('vacancy_id')=='0')
          {
              $data['position_id']=$this->input->post('position_id');
              $this->db->insert('vacancies',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('vacancies',$data,array('vacancy_id'=>$this->input->post('vacancy_id'),'status'=>'Active'));
          return TRUE;
      }
      
      function get_applicants($vacancy_id)
      {
          return $this->db
                      ->select('applicant_id, applicant_name, status')
                      ->where('vacancy_id',$vacancy_id)
                      ->get('vacancies_applicants')
                      ->result_array();
      }
      
      function get_applicant($applicant_id)
      {
          return $this->db
                      ->select('*')
                      ->where('applicant_id',$applicant_id)
                      ->get('vacancies_applicants')
                      ->row_array();
      }
      
      function save_applicant()
      {
          $data=array(
            'applicant_name'=>$this->input->post('applicant_name'),
            'applicant_email'=>$this->input->post('applicant_email'),
            'applicant_phone'=>$this->input->post('applicant_phone'),
            'birth_date'=>$this->input->post('birth_date'),
            'advantages'=>$this->input->post('advantages'),
            'disadvantages'=>$this->input->post('disadvantages')
          );
          
          if ($this->input->post('applicant_id')=='0')
          {
              $data['vacancy_id']=$this->input->post('vacancy_id');
              $this->db->insert('vacancies_applicants',$data);
              $result=$applicant_id=$this->db->insert_id();
          }
          else
          {
              $this->db->update('vacancies_applicants',$data,array('applicant_id'=>$this->input->post('applicant_id')));
              $result=TRUE;
              $applicant_id=$this->input->post('applicant_id');
          }
          
          
          $this->load->model('attachments_actions');
          if (!$files=$this->attachments_actions->upload_attachments('applicant',$applicant_id))
          {
             return FALSE;
          }
          
          return array_merge($files,array('result'=>$result));
      }
      
      function change_status()
      {
          $result=TRUE;
          if ($this->input->post('status')=='Enrolled')
          {
              $applicant=$this->get_applicant($this->input->post('applicant_id'));
              if ($applicant['status']=='Enrolled')
              {
                  $this->set_error($this->lang->line('Error'));
                  return FALSE;
              }
              
              $_POST['employee_email']=$applicant['applicant_email'];
              $_POST['employee_id']='0';
              
              $this->load->model('employees_actions');
              if (!$this->employees_actions->check_email())
              {
                  $this->set_error($this->employees_actions->get_error());
                  return FALSE;
              }
              
              $_POST['employee_name']=$applicant['applicant_name'];
              $_POST['birth_date']=$applicant['birth_date'];
              
              $result=$_POST['employee_id']=$this->employees_actions->save_employee();
              
              
              $this->db->update('vacancies_applicants',array(
                'employee_id'=>$result,
                'hired_at'=>date('Y-m-d')
              ),array(
                'applicant_id'=>$this->input->post('applicant_id')
              ));
              
              $_POST['employee_phone']=$_POST['employee_cell_phone']=$applicant['applicant_phone'];
              $this->employees_actions->save_address();
              
              $position=$this->get_vacancy($applicant['vacancy_id']);
              
              $_POST['new_position']=$position['position_id'];
              $_POST['start_date']=date('Y-m-d');
              $_POST['move_reason']=$this->lang->line('Enrolled');
              $this->employees_actions->add_position();
          }
          
          $this->db
               ->query('UPDATE vacancies, vacancies_applicants
                        SET vacancies.status=?, vacancies_applicants.status=?
                        WHERE vacancies_applicants.applicant_id=? AND vacancies_applicants.vacancy_id = vacancies.vacancy_id',array('Filled',$this->input->post('status'),$this->input->post('applicant_id')));
          
          return $result;
      }
      
      function cancel_vacancy($vacancy_id)
      {
          $this->db->update('vacancies',array('status'=>'Canceled'),array('vacancy_id'=>$vacancy_id,'status'=>'Active'));
          $this->db->update('vacancies_applicants',array('status'=>'Ignored'),array('vacancy_id'=>$vacancy_id,'status'=>'Active'));
      }
      
      function get_applicants_list()
      {
          return $this->db
                      ->select('applicant_id, applicant_name,vacancies_applicants.status,position_name,department_name')
                      ->join('vacancies','vacancies.vacancy_id = vacancies_applicants.vacancy_id','LEFT')
                      ->join('positions','positions.position_id = vacancies.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->get('vacancies_applicants')
                      ->result_array();
      }
  }
?>
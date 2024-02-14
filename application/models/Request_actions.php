<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Request_actions extends Base_model
  {
      function get_grouped_request()
      {
          $requests=$this->request();
          
          $result=array();
          foreach($requests as $request)
          {
              $result[$request['department_id']]['name']=$request['department_name'];
              $result[$request['department_id']]['departments'][]=$request;
          }
          
          return $result;
      }
      
      function get_requests()
      {
          return $this->db
                      ->select('requestlist_id,request_name,IFNULL(request_name,"-") as request_name',FALSE)
                      ->where('is_active',1)
                      ->order_by('requestlist_id')
                      ->get('request')
                      ->result_array();
      }
      
      function get_request($requestlist_id)
      {
          return $this->db
                      ->select('*')
                      ->where('requestlist_id',$requestlist_id)
                      ->get('request')
                      ->row_array();
      }
      
      private function check_head()
      {
          if ($this->input->post('is_head')=='on')
          {
              $head=$this->db
                         ->select('name')
                         ->join('employees_request','employees_request.request_id = request.request_id AND  employees_request.is_current=1','LEFT')
                         ->join('employees','employees.employee_id = employees_departments.employee_id','LEFT')
                         ->where(array('request.request_id'=>$this->input->post('request_id'),'is_head'=>1,'request.request_id <> '=>$this->input->post('request_id')))
                         ->get('request')
                         ->row_array();
              
              if (count($head)>0)
              {
                  return ($head['name'])?$head['name']:$this->lang->line('busy');
              }
          }
          
          return FALSE;
      }
      
      function save_request()
      {          
          $data=array(
            'request_name'=>$this->input->post('request_name'),
          );
          
          if ($this->input->post('request_id')=='0')
          {
              $this->db->insert('request',$data);
              $request_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->update('request',$data,array('requestlist_id'=>$this->input->post('request_id')));
              $request=$this->input->post('requestlist_id');
              $result=TRUE;
          }          
          return $result;
      }
      
      private function assign_skills($request_id)
      {
          if ((!isset($_POST['skills'])) OR (count($_POST['skills'])==0))
          {
              return FALSE;
          }
          $this->db->delete('request_skills',array('request_id'=>$request_id));
          
          $clean_ids=array(0);
          foreach($this->input->post('skills') as $skill_id=>$trash)
          {
              $clean_ids[]=(int)$skill_id;
          }
          
          $this->db
               ->query('INSERT INTO request_skills (skill_id,request_id)
                        SELECT skill_id,?
                        FROM skills
                        WHERE skill_id IN ('.implode(',',$clean_ids).')',array($request_id));
      }
      
      function delete_request($requestlist_id)
      {
          $this->db->update('request',array('is_active'=>0),array('requestlist_id'=>$requestlist_id));
      }
      
      function get_required_skills($request_id)
      {
          $temp= $this->db
                      ->select('category_name,skills.skill_id,skill_name,request_id,category_id')
                      ->join('skills','skills.parent_category = skills_categories.category_id AND skills.is_active=1','LEFT')
                      ->join('request_skills','request_skills.skill_id = skills.skill_id AND request_skills.request_id='.$request_id,'LEFT')
                      ->where('skills_categories.is_active',1)
                      ->order_by('category_name, skill_name')
                      ->get('skills_categories')
                      ->result_array();
          
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function check_request($request_id,$request_id)
      {
          $temp= $this->db
                      ->select('skill_name,category_name,category_id')
                      ->join('employees_skills','employees_skills.skill_id  = departments_skills.skill_id AND employees_skills.employee_id='.$employee_id.' AND employees_skills.to_delete=0','LEFT')
                      ->join('skills','skills.skill_id = departments_skills.skill_id','LEFT')
                      ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                      ->where(array('department_id'=>$request_id,'employees_skills.skill_id'=>NULL))
                      ->order_by('category_name, skill_name')
                      ->get('request_skills')
                      ->result_array();
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function search_request()
      {
           return $this->db
                      ->select('request_id as id, request_name as name',FALSE)
                      
                      ->where('request.is_active',1)
                      ->like('request_name',$this->input->post('query'),'both')
                      ->order_by('request_name')
                      ->limit(20)
                      ->get('request')
                      ->result_array();
      }
  }
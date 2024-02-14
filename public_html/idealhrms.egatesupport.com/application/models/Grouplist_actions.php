<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Grouplist_actions extends Base_model
  {
      
      function get_grouplist()
      {
          return $this->db
                      ->select('group_id,group_name')
                      ->where('is_active',1)
                      ->order_by('group_id')
                      ->get('grouplist')
                      ->result_array();
      }
      
      function get_group($group_id)
      {
          return $this->db
                      ->select('*')
                      ->where('group_id',$group_id)
                      ->get('grouplist')
                      ->row_array();
      }
      
      private function check_head()
      {
          if ($this->input->post('is_head')=='on')
          {
              $head=$this->db
                         ->select('name')
                         ->join('employees_departments','employees_departments.department_id = departments.department_id AND  employees_departments.is_current=1','LEFT')
                         ->join('employees','employees.employee_id = employees_departments.employee_id','LEFT')
                         ->where(array('departments.department_id'=>$this->input->post('department_id'),'is_head'=>1,'departments.department_id <> '=>$this->input->post('department_id')))
                         ->get('departments')
                         ->row_array();
              
              if (count($head)>0)
              {
                  return ($head['name'])?$head['name']:$this->lang->line('busy');
              }
          }
          
          return FALSE;
      }
      
      function save_group()
      {          
          $data=array(
            'group_name'=>$this->input->post('department_name'),
            'is_active'=>1,
          );
          
          if ($this->input->post('department_id')=='0')
          {
              $this->db->insert('grouplist',$data);
              $department_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->update('grouplist',$data,array('group_id'=>$this->input->post('department_id')));
              $department_id=$this->input->post('department_id');
              $result=TRUE;
          }          
          return $result;
      }
      
      private function assign_skills($department_id)
      {
          if ((!isset($_POST['skills'])) OR (count($_POST['skills'])==0))
          {
              return FALSE;
          }
          $this->db->delete('departments_skills',array('department_id'=>$department_id));
          
          $clean_ids=array(0);
          foreach($this->input->post('skills') as $skill_id=>$trash)
          {
              $clean_ids[]=(int)$skill_id;
          }
          
          $this->db
               ->query('INSERT INTO departments_skills (skill_id,department_id)
                        SELECT skill_id,?
                        FROM skills
                        WHERE skill_id IN ('.implode(',',$clean_ids).')',array($department_id));
      }
      
      function delete_group($department_id)
      {
          $this->db->update('grouplist',array('is_active'=>0),array('group_id'=>$department_id));
      }
      
      function get_required_skills($department_id)
      {
          $temp= $this->db
                      ->select('category_name,skills.skill_id,skill_name,department_id,category_id')
                      ->join('skills','skills.parent_category = skills_categories.category_id AND skills.is_active=1','LEFT')
                      ->join('departments_skills','departments_skills.skill_id = skills.skill_id AND departments_skills.department_id='.$department_id,'LEFT')
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
      
      function check_department($department_id,$employee_id)
      {
          $temp= $this->db
                      ->select('skill_name,category_name,category_id')
                      ->join('employees_skills','employees_skills.skill_id  = departments_skills.skill_id AND employees_skills.employee_id='.$employee_id.' AND employees_skills.to_delete=0','LEFT')
                      ->join('skills','skills.skill_id = departments_skills.skill_id','LEFT')
                      ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                      ->where(array('department_id'=>$department_id,'employees_skills.skill_id'=>NULL))
                      ->order_by('category_name, skill_name')
                      ->get('departments_skills')
                      ->result_array();
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function search_department()
      {
           return $this->db
                      ->select('department_id as id, department_name as name',FALSE)
                      
                      ->where('departments.is_active',1)
                      ->like('department_name',$this->input->post('query'),'both')
                      ->order_by('department_name')
                      ->limit(20)
                      ->get('departments')
                      ->result_array();
      }
  }
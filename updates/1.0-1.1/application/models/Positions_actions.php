<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Positions_actions extends Base_model
  {
      function get_grouped_positions()
      {
          $positions=$this->get_positions();
          
          $result=array();
          foreach($positions as $position)
          {
              $result[$position['department_id']]['name']=$position['department_name'];
              $result[$position['department_id']]['positions'][]=$position;
          }
          
          return $result;
      }
      
      function get_positions()
      {
          return $this->db
                      ->select('position_id,position_name,IFNULL(department_name,"-") as department_name,positions.department_id',FALSE)
                      ->join('departments','departments.department_id = positions.department_id AND departments.is_active=1','LEFT')
                      ->where('positions.is_active',1)
                      ->order_by('department_name,position_name')
                      ->get('positions')
                      ->result_array();
      }
      
      function get_position($position_id)
      {
          return $this->db
                      ->select('*')
                      ->where('position_id',$position_id)
                      ->get('positions')
                      ->row_array();
      }
      
      private function check_head()
      {
          if ($this->input->post('is_head')=='on')
          {
              $head=$this->db
                         ->select('name')
                         ->join('employees_positions','employees_positions.position_id = positions.position_id AND  employees_positions.is_current=1','LEFT')
                         ->join('employees','employees.employee_id = employees_positions.employee_id','LEFT')
                         ->where(array('positions.department_id'=>$this->input->post('department_id'),'is_head'=>1,'positions.position_id <> '=>$this->input->post('position_id')))
                         ->get('positions')
                         ->row_array();
              
              if (count($head)>0)
              {
                  return ($head['name'])?$head['name']:$this->lang->line('busy');
              }
          }
          
          return FALSE;
      }
      
      function save_position()
      {
          if ($head=$this->check_head())
          {
              $this->set_error($this->lang->line('Head of department is ').$head);
              return FALSE;
          }
          
          $data=array(
            'position_name'=>$this->input->post('position_name'),
            'responsibilities'=>$this->input->post('responsibilities'),
            'department_id'=>$this->input->post('department_id'),
            'is_head'=>($this->input->post('is_head')=='on')?1:0
          );
          
          if ($this->input->post('position_id')=='0')
          {
              $this->db->insert('positions',$data);
              $position_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->update('positions',$data,array('position_id'=>$this->input->post('position_id')));
              $position_id=$this->input->post('position_id');
              $result=TRUE;
          }
          
          $this->assign_skills($position_id);
          
          return $result;
      }
      
      private function assign_skills($position_id)
      {
          if ((!isset($_POST['skills'])) OR (count($_POST['skills'])==0))
          {
              return FALSE;
          }
          $this->db->delete('positions_skills',array('position_id'=>$position_id));
          
          $clean_ids=array(0);
          foreach($this->input->post('skills') as $skill_id=>$trash)
          {
              $clean_ids[]=(int)$skill_id;
          }
          
          $this->db
               ->query('INSERT INTO positions_skills (skill_id,position_id)
                        SELECT skill_id,?
                        FROM skills
                        WHERE skill_id IN ('.implode(',',$clean_ids).')',array($position_id));
      }
      
      function delete_position($position_id)
      {
          $this->db->update('positions',array('is_active'=>0),array('position_id'=>$position_id));
      }
      
      function get_required_skills($position_id)
      {
          $temp= $this->db
                      ->select('category_name,skills.skill_id,skill_name,position_id,category_id')
                      ->join('skills','skills.parent_category = skills_categories.category_id AND skills.is_active=1','LEFT')
                      ->join('positions_skills','positions_skills.skill_id = skills.skill_id AND positions_skills.position_id='.$position_id,'LEFT')
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
      
      function check_position($position_id,$employee_id)
      {
          $temp= $this->db
                      ->select('skill_name,category_name,category_id')
                      ->join('employees_skills','employees_skills.skill_id  = positions_skills.skill_id AND employees_skills.employee_id='.$employee_id.' AND employees_skills.to_delete=0','LEFT')
                      ->join('skills','skills.skill_id = positions_skills.skill_id','LEFT')
                      ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                      ->where(array('position_id'=>3,'employees_skills.skill_id'=>NULL))
                      ->order_by('category_name, skill_name')
                      ->get('positions_skills')
                      ->result_array();
          $result=array();
          
          foreach($temp as $item)
          {
              $result[$item['category_id']][]=$item;
          }
          
          return $result;
      }
      
      function search_position()
      {
          return $this->db
                      ->select('position_id as id, CONCAT(position_name," [",IFNULL(department_name,"-"),"]") as name',FALSE)
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('positions.is_active',1)
                      ->like('position_name',$this->input->post('query'),'both')
                      ->order_by('position_name')
                      ->limit(20)
                      ->get('positions')
                      ->result_array();
      }
  }
?>
<?php 
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Skills_actions extends Base_model
  {
      function get_skills()
      {
          return $this->db
                      ->select('skill_id,skill_name,category_name')
                      ->join('skills_categories','skills_categories.category_id = skills.parent_category','LEFT')
                      ->where('skills.is_active',1)
                      ->get('skills')
                      ->result_array();
      }
      
      function get_skill($skill_id)
      {
          return $this->db
                      ->select('*')
                      ->where(array('skill_id'=>$skill_id,'is_active'=>1))
                      ->get('skills')
                      ->row_array();
      }
      
      function save_skill()
      {
          $data=array(
            'skill_name'=>$this->input->post('skill_name'),
            'skill_requirements'=>$this->input->post('skill_requirements'),
            'parent_category'=>$this->input->post('parent_category')
          );
          
          if ($this->input->post('skill_id')=='0')
          {
              $this->db->insert('skills',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('skills',$data,array('skill_id'=>$this->input->post('skill_id'),'is_active'=>1));
          return TRUE;
      }
      
      function delete_skill($skill_id)
      {
          $this->db->update('skills',array('is_active'=>0),array('skill_id'=>$skill_id));
          $this->db->update('employees_skills',array('to_delete'=>2));
      }
      
      function get_categories()
      {
          return $this->db
                      ->select('category_id,category_name')
                      ->order_by('category_name')
                      ->where('is_active',1)
                      ->get('skills_categories')
                      ->result_array();
      }
      
      function get_category($category_id)
      {
          return $this->db
                      ->select('*')
                      ->where(array('category_id'=>$category_id,'is_active'=>1))
                      ->get('skills_categories')
                      ->row_array();
      }
      
      function save_category()
      {
          $data=array(
            'category_name'=>$this->input->post('category_name')
          );
          
          if ($this->input->post('category_id')=='0')
          {
              $this->db->insert('skills_categories',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('skills_categories',$data,array('category_id'=>$this->input->post('category_id'),'is_active'=>1));
          return TRUE;
      }
      
      function delete_category($category_id)
      {
          $this->db->update('skills_categories',array('is_active'=>0),array('category_id'=>$category_id));
          $this->db->update('skills',array('is_active'=>0),array('parent_category'=>$category_id));
          
          $this->db->query('UPDATE employees_skills, skills
                            SET employees_skills.to_delete=2
                            WHERE skills.parent_category=? AND skills.skill_id = employees_skills.skill_id',array($category_id));
      }
  }
?>
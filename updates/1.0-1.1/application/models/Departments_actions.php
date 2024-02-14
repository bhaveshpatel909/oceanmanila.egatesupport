<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    * @property settings_actions          $settings_actions
    */

  class Departments_actions extends Base_model
  {
      function get_departments_list()
      {
          return $this->db
                      ->select('*')
                      ->where('is_active',1)
                      ->order_by('department_name')
                      ->get('departments')
                      ->result_array();
      }
      
      function get_departments()
      {
          $temp=$this->db
                     ->select('*')
                     ->where('is_active',1)
                     ->order_by('parent_department DESC, department_name')
                     ->get('departments')
                     ->result_array();
           $result=array();
           
           foreach($temp as $index=>$department)
           {
               $data=array(
                    'id'=>$department['department_id'],
                    'text'=>$department['department_name'],
                    'state'=>array('opened'=>TRUE)
               );
               
               if (isset($result[$department['department_id']]))
               {
                   $data['children']=array_values($result[$department['department_id']]);
                   unset($result[$department['department_id']]);
               }
                  
               $result[$department['parent_department']][$department['department_id']]=$data;
           }
           
           $this->load->model('settings_actions');
           
           $result=array(
                'id'=>0,
                'text'=>$this->settings_actions->get_setting('company_name'),
                'children'=>array_values(isset($result[0])?$result[0]:array()),
                'icon'=>'fa fa-home fa-1-5x',
                'state'=>array('opened'=>TRUE)
           );
           
           return $result;
      }
      
      function delete_department($department_id)
      {
          $this->db->update('departments',array('is_active'=>0),array('department_id'=>$department_id));
          $department_id=array($department_id);
          
          while(!is_null($department_id))
          {
              $this->db->where_in('parent_department',$department_id);
              $this->db->update('departments',array('is_active'=>0));
              
              $department_id=$this->db
                                  ->select('GROUP_CONCAT(department_id) as department_id',FALSE)
                                  ->where_in('parent_department',$department_id)
                                  ->get('departments')
                                  ->row_array();
              
              $department_id=$department_id['department_id']?explode(',',$department_id['department_id']):NULL;
          }
      }
      
      function save_department()
      {
          $data=array(
            'department_name'=>$this->input->get('department_name'),
            'parent_department'=>($this->input->get('parent_department')=='j1_1')?0:$this->input->get('parent_department')
          );
          
          if ($this->input->get('department_id')=='0')
          {
              $this->db->insert('departments',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('departments',array('department_name'=>$this->input->get('department_name')),array('department_id'=>$this->input->get('department_id')));
          return $this->input->get('department_id');
      }
      
      function move_department()
      {
          $this->db->update('departments',array('parent_department'=>$this->input->get('new_parent')),array('department_id'=>$this->input->get('department_id')));
      }
      
      function get_position_department($position_id)
      {
          $result=$this->db
                       ->select('department_id')
                       ->where('position_id',$position_id)
                       ->get('positions')
                       ->row_array();
          
          return $result['department_id'];
      }
      
      function search_department()
      {
          return $this->db
                      ->select('department_id as id, department_name as name',FALSE)
                      ->where('is_active',1)
                      ->like('department_name',$this->input->post('query'),'both')
                      ->order_by('department_name')
                      ->limit(20)
                      ->get('departments')
                      ->result_array();
      }
  }
?>
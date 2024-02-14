<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Document_type_actions extends Base_model
  {
      
      function get_201_document_type()
      {
          return $this->db
                      ->select('201_document_type.*')
                      ->where('is_active',1)
                      ->order_by('document_type_id')
                      ->get('201_document_type')
                      ->result_array();
      }
      
      function get_document_type($document_type_id)
      {
          return $this->db
                      ->select('*')
                      ->where('document_type_id',$document_type_id)
                      ->get('201_document_type')
                      ->row_array();
      }
      
      function save_document_type()
      {          
          $data=array(
            'document_type_name'=>$this->input->post('department_name'),
            'days_to_alert'=>$this->input->post('days_to_alert'),
            'is_active'=>1,
          );
          
          if ($this->input->post('department_id')=='0')
          {
              $this->db->insert('201_document_type',$data);
              $department_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->update('201_document_type',$data,array('document_type_id'=>$this->input->post('department_id')));
              $department_id=$this->input->post('department_id');
              $result=TRUE;
          }          
          return $result;
      }
      function delete_document_type($department_id)
      {
          $this->db->update('201_document_type',array('is_active'=>0),array('document_type_id'=>$department_id));
      }
      
      
  }
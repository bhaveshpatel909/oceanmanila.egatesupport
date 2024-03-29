<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_query_builder $db
    * @property CI_Session          $session
    */
  
  class Documents_actions extends Base_model
  {
      function get_documents($page_id=1)
      {
          $this->db
                ->select('SQL_CALC_FOUND_ROWS document_id,file,extenstion, description',FALSE)
                ->limit(12,($page_id-1)*12)
                ->order_by('file')
                ->from('documents');
          
          if ($this->input->get('search'))
          {
              $this->db
                   ->or_like('file',$this->input->get('search'),'both')
                   ->or_like('description',$this->input->get('search'),'both');
          }
          
          $result['data']=$this->db
                               ->get()
                               ->result_array();
          
          $amount=$this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();
          
          $result['amount']=$amount['amount'];
          
          return $result;
      }
      
      function get_document($document_id,$with_permissions=TRUE)
      {
          $document=$this->db
                         ->select('*')
                         ->where('documents.document_id',$document_id)
                         ->get('documents')
                         ->row_array();
          
          if (!$with_permissions)
          {
              return $document;
          }
          
          $permissions=$this->db
                            ->select('type,value')
                            ->where('document_id',$document_id)
                            ->get('documents_permissions')
                            ->result_array();
          
          foreach($permissions as $permission)
          {
              $document['permissions'][$permission['type']]=call_user_func(array($this,'get_'.$permission['type'].'_values'),$permission['value']);
          }
          
          return $document;
      }
      
      private function get_all_values($value)
      {
          return $value;
      }
      
      private function get_employees_values($value)
      {
          return $this->db
                      ->select('employees.employee_id as id, CONCAT(name,"[",IFNULL(department_name,"-"),"] ", IFNULL(position_name,"-")) as name',FALSE)
                      ->join('employees_positions','employees_positions.employee_id = employees.employee_id AND is_current=1','LEFT')
                      ->join('positions','positions.position_id = employees_positions.position_id','LEFT')
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('status','Active')
                      ->where_in('employees.employee_id',explode(',',$value))
                      ->order_by('name')
                      ->get('employees')
                      ->result_array();
      }
      
      private function get_departments_values($value)
      {
          return $this->db
                      ->select('department_id as id, department_name as name',FALSE)
                      ->where('is_active',1)
                      ->where_in('department_id',explode(',',$value))
                      ->order_by('department_name')
                      ->get('departments')
                      ->result_array();
      }
      
      private function get_positions_values($value)
      {
          return $this->db
                      ->select('position_id as id, CONCAT(position_name," [",IFNULL(department_name,"-"),"]") as name',FALSE)
                      ->join('departments','departments.department_id = positions.department_id','LEFT')
                      ->where('positions.is_active',1)
                      ->where_in('position_id',explode(',',$value))
                      ->order_by('position_name')                      
                      ->get('positions')
                      ->result_array();
      }
      
      function save_document()
      {
          if ($this->input->post('document_id')=='0')
          {
              $this->load->library('upload',array(
                'upload_path'=>BASEPATH.'../files/attachments',
                'allowed_types'=>implode('|',$this->config->item('attachment_files')),
                'max_size'=>$this->config->item('max_file_size'),
                'encrypt_name'=>TRUE
              ));
              
              if (!$this->upload->do_upload('document'))
              {
                  $this->set_error(sprintf($this->lang->line('Can not upload file %s'),$this->upload->file_name).', '.$this->upload->display_errors(' '));
                  return array('result'=>FALSE);
              }
              
              $document=array(
                'file'=>$this->upload->orig_name,
                'extenstion'=>str_replace('.','',$this->upload->file_ext),
                'description'=>$this->input->post('description'),
                'location'=>$this->upload->file_name,
                'uploaded'=>date('Y-m-d H:i:s'),
                'type'=>$this->upload->file_type
              );
              $this->db->insert('documents',$document);
              $document['result']=$this->db->insert_id();
              
              $this->save_permissions($document['result']);
                 
              return $document;
          }
          
          $this->db->update('documents',array('description'=>$this->input->post('description')),array('document_id'=>$this->input->post('document_id')));
          
          $this->save_permissions($this->input->post('document_id'));
          return array('result'=>TRUE);
      }
      
      private function save_permissions($document_id)
      {
          $this->db->delete('documents_permissions',array('document_id'=>$document_id));
          
          if ($this->input->post('permissions_all'))
          {
              $this->db->insert('documents_permissions',array(
                'document_id'=>$document_id,
                'type'=>'all',
                'value'=>'*'
              ));
              
              return TRUE;
          }
          
          if ($this->input->post('employees_list') AND count($this->input->post('employees_list'))>0)
          {
              $employees=array(0);
              foreach($this->input->post('employees_list') as $employee_id)
              {
                  $employees[]=(int)$employee_id;
              }
              
              $this->db
                   ->query('INSERT INTO documents_permissions(document_id,type,value)
                            SELECT ?,"employees",GROUP_CONCAT(employee_id)
                            FROM employees
                            WHERE employee_id IN ('.implode(',',$employees).') AND status="Active"',array($document_id));
          }
          
          if ($this->input->post('positions_list') AND count($this->input->post('positions_list')))
          {
              $positions=array(0);
              foreach($this->input->post('positions_list') as $position_id)
              {
                  $positions[]=(int)$position_id;
              }
              
              $this->db
                   ->query('INSERT INTO documents_permissions(document_id,type,value)
                            SELECT ?,"positions",GROUP_CONCAT(position_id)
                            FROM positions
                            WHERE position_id IN ('.implode(',',$positions).') AND is_active=1',array($document_id));
          }
          
          if ($this->input->post('departments_list') AND count($this->input->post('departments_list')))
          {
              $departments=array(0);
              foreach($this->input->post('departments_list') as $department_id)
              {
                  $departments[]=(int)$department_id;
              }
              
              $this->db
                   ->query('INSERT INTO documents_permissions(document_id,type,value)
                            SELECT ?,"departments",GROUP_CONCAT(department_id)
                            FROM departments
                            WHERE department_id IN ('.implode(',',$departments).') AND is_active=1',array($document_id));
          }
      }
      
      function download_document($document_id)
      {
          if ($this->user_actions->is_selfservice())
          {
              $this->prepare_employee_filter();
              $this->db->join('documents_permissions','documents_permissions.document_id = documents.document_id','LEFT');
          }
          
          $document=$this->get_document($document_id,FALSE);
          
          if (count($document)==0)
          {
              exit();
          }
          
          if (!in_array($document['extenstion'],array('png','pdf','jpg','jpeg','gif','bmp')))
          {
              header('Content-Description: File Transfer');
              header('Content-Disposition: attachment; filename='.$document['file']);
          }
          
          header('Content-Type: '.$document['type']);
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Pragma: public');
          readfile(BASEPATH.'../files/attachments/'.$document['location']);
          
          return TRUE;
      }
      
      function delete_document($document_id)
      {
          $document=$this->get_document($document_id);
          
          if (file_exists(BASEPATH.'../files/attachments/'.$document['location']))
          {
              @unlink(BASEPATH.'../files/attachments/'.$document['location']);
              $this->db->delete('documents',array('document_id'=>$document_id));
              $this->db->delete('documents_permissions',array('document_id'=>$document_id));
          }
      }
      
      private function prepare_employee_filter()
      {
          $this->db
               ->where('((documents_permissions.type="all" AND value="*") OR (documents_permissions.type="employees" AND FIND_IN_SET('.(!empty($this->session->current->userdata['employee_id'])?$this->session->current->userdata['employee_id']:0).',value)) OR (documents_permissions.type="positions" AND FIND_IN_SET('.(!empty($this->session->current->userdata['position_id'])?$this->session->current->userdata['position_id']:0).',value)) OR (documents_permissions.type="departments" AND FIND_IN_SET('.(!empty($this->session->current->userdata['department_id'])?$this->session->current->userdata['department_id']:0).',value)))',NULL,FALSE);
      }
      
      function get_employee_documents($page_id=1)
      {
          $this->prepare_employee_filter();
          
          $this->db
                ->select('SQL_CALC_FOUND_ROWS documents.document_id,file,extenstion, description',FALSE)
                ->join('documents','documents.document_id = documents_permissions.document_id','LEFT')
                ->limit(12,($page_id-1)*12)
                ->order_by('file');
          
          if ($this->input->get('search'))
          {
              $this->db
                   ->or_like('file',$this->input->get('search'),'both')
                   ->or_like('description',$this->input->get('search'),'both');
          }
          
          $result['data']=$this->db
                               ->get('documents_permissions')
                               ->result_array();
          
          $amount=$this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();
          
          $result['amount']=$amount['amount'];
          
          return $result;
      }
  }
?>
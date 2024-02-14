<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 */
class Drequest_actions extends Base_model {

    function get_request($page_id = 1) {
        $this->db
                ->select('SQL_CALC_FOUND_ROWS *,request.request_name as cname', FALSE)
				->join('request', 'request.requestlist_id = requestemp.request_category_id', 'LEFT')
                ->limit(100, ($page_id - 1) * 100)
                ->order_by('requestemp.uploaded', 'DESC')
                ->from('requestemp');

        if ($this->input->get('search')) {
            $this->db
                    ->or_like('file', $this->input->get('search'), 'both')
                    ->or_like('description', $this->input->get('search'), 'both');
        }
		
        $result['data'] = $this->db
                ->get()
                ->result_array();

				
		foreach ($result['data'] as $key => $document) {
            $attachments = $this->db->select('*')->where(array('object'=> $document['request_id'],'type'=> 'request'))
                    ->get('attachments')->result_array();
            $document['attachments'] = $attachments;
            $result['data'][$key] = $document;
        }		

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
				// echo "<pre>";
		// print_R($result);
		// die("sdfsd");
        return $result;
    }

    function get_cat_documents($document_category_id = 0, $page_id = 1) {
        $this->db
                ->select('SQL_CALC_FOUND_ROWS *', FALSE)
                ->where('document_category_id', $document_category_id)
//                ->limit(12, ($page_id - 1) * 12)
                ->order_by('uploaded', 'DESC')
                ->from('documents');

        if ($this->input->get('search')) {
            $this->db
                    ->or_like('file', $this->input->get('search'), 'both')
                    ->or_like('description', $this->input->get('search'), 'both');
        }

        $result['data'] = $this->db
                ->get()
                ->result_array();
        
        foreach ($result['data'] as $key => $document) {
            $attachments = $this->db->select('*')->where(array('object'=> $document['document_id'],'type'=> 'document'))
                    ->get('attachments')->result_array();
            $document['attachments'] = $attachments;
            $result['data'][$key] = $document;
        }
        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];
        //_custom_debug($result);
        return $result;
    }

    function get_document($document_id, $with_permissions = TRUE) {
        $document = $this->db
                ->select('*')
                ->where('requestemp.request_id', $document_id)
                ->get('requestemp')
                ->row_array();

        if (!$with_permissions) {
            return $document;
        }

        $permissions = $this->db
                ->select('type,value')
                ->where('request_id', $document_id)
                ->get('requestemp_permissions')
                ->result_array();

        foreach ($permissions as $permission) {
            $document['permissions'][$permission['type']] = call_user_func(array($this, 'get_' . $permission['type'] . '_values'), $permission['value']);
        }

        return $document;
    }

    private function get_all_values($value) {
        return $value;
    }

    private function get_employees_values($value) {
        return $this->db
                        ->select('employees.employee_id as id, CONCAT(name,"[",IFNULL(request_name,"-"),"] ", IFNULL(position_name,"-")) as name', FALSE)
                        ->join('employees_positions', 'employees_positions.employee_id = employees.employee_id AND is_current=1', 'LEFT')
                        ->join('positions', 'positions.position_id = employees_positions.position_id', 'LEFT')
                        ->join('request', 'request.request_id = positions.request_id', 'LEFT')
                        ->where('status', 'Active')
                        ->where_in('employees.employee_id', explode(',', $value))
                        ->order_by('name')
                        ->get('employees')
                        ->result_array();
    }

    private function get_request_values($value) {
        return $this->db
                        ->select('request_id as id, request_name as name', FALSE)
                        ->where('is_active', 1)
                        ->where_in('request_id', explode(',', $value))
                        ->order_by('request_name')
                        ->get('request')
                        ->result_array();
    }

    private function get_positions_values($value) {
        return $this->db
                        ->select('position_id as id, CONCAT(position_name," [",IFNULL(request_name,"-"),"]") as name', FALSE)
                        ->join('request', 'request.request_id = positions.request_id', 'LEFT')
                        ->where('positions.is_active', 1)
                        ->where_in('position_id', explode(',', $value))
                        ->order_by('position_name')
                        ->get('positions')
                        ->result_array();
    }

    function save_document() {
		if(isset($_POST['status']))
		{
			$status=  $this->input->post('status');
		}
		else
		{
			$status= 0;
		}
        $document = array(
            //'file' => $this->upload->orig_name,
            //'extenstion' => str_replace('.', '', $this->upload->file_ext),
            'request_category_id' => $this->input->post('request_category_id'),
            'description' => $this->input->post('description'),
            'content' => $this->input->post('content'),
            //'location' => $this->upload->file_name,
            'uploaded' => date('Y-m-d H:i:s'),
                //'type' => $this->upload->file_type
				 'status' => $this->input->post('status'),
				 'name' => $this->input->post('emp_name'),
        );
		// echo "<pre>";
		// print_r($_POST);
		// die("rgfht");
        if ($this->input->post('document_id') == '0') {
            $this->db->insert('requestemp', $document);
            $result = $document_id = $this->db->insert_id();

            $this->save_permissions($document_id);
        } else {
            $this->db->update('requestemp', $document, array('request_id' => $this->input->post('document_id')));
            $result = TRUE;
            $document_id = $this->input->post('document_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments_not_birg('request', $document_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }
	function save_document1() {
		if(isset($_POST['status']))
		{
			$status=  $this->input->post('status');
		}
		else
		{
			$status= 0;
		}
        $document = array(
            //'file' => $this->upload->orig_name,
            //'extenstion' => str_replace('.', '', $this->upload->file_ext),
            'request_category_id' => $this->input->post('request_category_id'),
            'description' => $this->input->post('description'),
            'content' => $this->input->post('content'),
            //'location' => $this->upload->file_name,
            'uploaded' => date('Y-m-d H:i:s'),
                //'type' => $this->upload->file_type
				 'status' => $this->input->post('status'),
				 'name' => $this->input->post('emp_name'),
        );
		// echo "<pre>";
		// print_r($_POST);
		// die("rgfht");
        if ($this->input->post('document_id') == '0') {
            $this->db->insert('requestemp', $document);
            $result = $document_id = $this->db->insert_id();

            $this->save_permissions($document_id);
        } else {
            $this->db->update('requestemp', $document, array('request_id' => $this->input->post('document_id')));
            $result = TRUE;
            $document_id = $this->input->post('document_id');
        }

        $this->load->model('attachments_actions');
        if (!$files = $this->attachments_actions->upload_attachments_not_birg('request', $document_id)) {
            return FALSE;
        }

        return array_merge($files, array('result' => $result));
    }

//    function save_document() {
//        if ($this->input->post('document_id') == '0') {
//            $this->load->library('upload', array(
//                'upload_path' => BASEPATH . '../files/attachments',
//                'allowed_types' => implode('|', $this->config->item('attachment_files')),
//                'max_size' => $this->config->item('max_file_size'),
//                'encrypt_name' => TRUE
//            ));
//
//            if (!$this->upload->do_upload('document')) {
//                $this->set_error(sprintf($this->lang->line('Can not upload file %s'), $this->upload->file_name) . ', ' . $this->upload->display_errors(' '));
//                return array('result' => FALSE);
//            }
//
//            $document = array(
//                'file' => $this->upload->orig_name,
//                'extenstion' => str_replace('.', '', $this->upload->file_ext),
//                'document_category_id' => $this->input->post('document_category_id'),
//                'description' => $this->input->post('description'),
//                'location' => $this->upload->file_name,
//                'uploaded' => date('Y-m-d H:i:s'),
//                'type' => $this->upload->file_type
//            );
//            $this->db->insert('documents', $document);
//            $document['result'] = $this->db->insert_id();
//
//            $this->save_permissions($document['result']);
//
//            return $document;
//        }
//
//        $this->db->update('documents', array('description' => $this->input->post('description')), array('document_id' => $this->input->post('document_id')));
//
//        $this->save_permissions($this->input->post('document_id'));
//        return array('result' => TRUE);
//    }

    private function save_permissions($document_id) {
        $this->db->delete('workmanual_permissions', array('workmanual_id' => $document_id));

        if ($this->input->post('permissions_all')) {
            $this->db->insert('requestemp_permissions', array(
                'request_id' => $document_id,
                'type' => 'all',
                'value' => '*'
            ));

            return TRUE;
        }

        if ($this->input->post('employees_list') AND count($this->input->post('employees_list')) > 0) {
            $employees = array(0);
            foreach ($this->input->post('employees_list') as $employee_id) {
                $employees[] = (int) $employee_id;
            }

            $this->db
                    ->query('INSERT INTO requestemp_permissions(request_id,type,value)
                            SELECT ?,"employees",GROUP_CONCAT(employee_id)
                            FROM employees
                            WHERE employee_id IN (' . implode(',', $employees) . ') AND status="Active"', array($document_id));
        }

        if ($this->input->post('positions_list') AND count($this->input->post('positions_list'))) {
            $positions = array(0);
            foreach ($this->input->post('positions_list') as $position_id) {
                $positions[] = (int) $position_id;
            }

            $this->db
                    ->query('INSERT INTO requestemp_permissions(requestemp_id,type,value)
                            SELECT ?,"positions",GROUP_CONCAT(position_id)
                            FROM positions
                            WHERE position_id IN (' . implode(',', $positions) . ') AND is_active=1', array($document_id));
        }

        if ($this->input->post('request_list') AND count($this->input->post('request_list'))) {
            $departments = array(0);
            foreach ($this->input->post('request_list') as $department_id) {
                $request[] = (int) $request_id;
            }

            $this->db
                    ->query('INSERT INTO requestemp_permissions(request_id,type,value)
                            SELECT ?,"request",GROUP_CONCAT(request_id)
                            FROM request
                            WHERE request_id IN (' . implode(',', $request) . ') AND is_active=1', array($document_id));
        }
    }

    function download_document($document_id) {
        if ($this->user_actions->is_selfservice()) {
            $this->prepare_employee_filter();
            $this->db->join('documents_permissions', 'documents_permissions.document_id = documents.document_id', 'LEFT');
        }

        $document = $this->get_document($document_id, FALSE);

        if (count($document) == 0) {
            exit();
        }

        if (!in_array($document['extenstion'], array('png', 'pdf', 'jpg', 'jpeg', 'gif', 'bmp'))) {
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename=' . $document['file']);
        }

        header('Content-Type: ' . $document['type']);
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Pragma: public');
        readfile(BASEPATH . '../files/attachments/' . $document['location']);

        return TRUE;
    }

    function delete_document($document_id) {
        $document = $this->get_document($document_id);
        $documentattach = $this->get_document_attachment($document_id);
		// echo $document_id;
		// echo "<pre>";
		// print_r($documentattach);
		// die("sdafs");
		foreach($documentattach as $docattach)

		{
			@unlink(BASEPATH . '../files/attachments/' . $docattach['location']);
		}
	
        $this->db->delete('requestemp', array('request_id' => $document_id));
        $this->db->delete('requestemp_permissions', array('request_id' => $document_id));
        
    }
	
	function del_avtar($emmp){
		
		print_r($emmp);
		
		
	}
	
	function get_document_attachment($document_id)
	{
		 return $this->db
                      ->select('location')
                      ->where('object',$document_id)
                      ->where('type','workmanual')
                      ->get('attachments')
                      ->result_array();
	}

    private function prepare_employee_filter() {
        $this->db
                ->where('((documents_permissions.type="all" AND value="*") OR (documents_permissions.type="employees" AND FIND_IN_SET(' . (!empty($this->session->current->userdata['employee_id']) ? $this->session->current->userdata['employee_id'] : 0) . ',value)) OR (documents_permissions.type="positions" AND FIND_IN_SET(' . (!empty($this->session->current->userdata['position_id']) ? $this->session->current->userdata['position_id'] : 0) . ',value)) OR (documents_permissions.type="departments" AND FIND_IN_SET(' . (!empty($this->session->current->userdata['department_id']) ? $this->session->current->userdata['department_id'] : 0) . ',value)))', NULL, FALSE);
    }

    function get_employee_documents($page_id = 1) {
        $this->prepare_employee_filter();

        $this->db
                ->select('SQL_CALC_FOUND_ROWS workmanual.document_id,file,extenstion, description', FALSE)
                ->join('workmanual', 'workmanual.workmanual_id = workmanual_permissions.workmanual_id', 'LEFT')
                ->limit(12, ($page_id - 1) * 12)
                ->order_by('file');

        if ($this->input->get('search')) {
            $this->db
                    ->or_like('file', $this->input->get('search'), 'both')
                    ->or_like('description', $this->input->get('search'), 'both');
        }

        $result['data'] = $this->db
                ->get('workmanual_permissions')
                ->result_array();
        
        foreach ($result['data'] as $key => $document) {
            $attachments = $this->db->select('*')->where(array('object'=> $document['document_id'],'type'=> 'document'))
                    ->get('attachments')->result_array();
            $document['attachments'] = $attachments;
            $result['data'][$key] = $document;
        }

        $amount = $this->db->query('SELECT CEIL(FOUND_ROWS()/12) as `amount`')->row_array();

        $result['amount'] = $amount['amount'];

        return $result;
    }

    public function get_document_categorys() {
        return $this->db
                        ->select('*')
                        ->get('documents_category')
                        ->result_array();
    }

    function get_document_category($document_category_id) {
        $this->db->select('*');
        $this->db->where('document_category_id', $document_category_id);
        $query = $this->db->get('documents_category');
        return $query->row_array();
    }
	function get_request_request()
	
	{
		  return $this->db
                        ->select('*')
						->where('is_active', 1)
                        ->get('request')
                        ->result_array();
    }
	

    function save_document_category() {
        $data = array(
            'document_category_name' => $this->input->post('document_category_name'),
        );

        if ($this->input->post('document_category_id') == '0') {
            $this->db->insert('documents_category', $data);
            return $this->db->insert_id();
        }

        $this->db->update('documents_category', $data, array('document_category_id' => $this->input->post('document_category_id')));
        return TRUE;
    }

    function delete_document_category($document_category_id) {
        $this->db->delete('documents_category', array('document_category_id' => $document_category_id));
    }
	
	 function get_print_request($document_id)
	 {
        $document = $this->db
                ->select('*')
                ->where('requestemp.request_id', $document_id)
                ->get('requestemp')
                ->row_array();
				// echo "<pre>";
				// print_r($document);
				// die("sxdcfd");

       
		    $catid =$document['request_category_id'];
		   $reqcat = $this->db
                ->select('*')
                ->where('request.requestlist_id', $catid)
                ->get('request')
                ->row_array();
		$document['request_name']=$reqcat['request_name'];
		
       // echo "<pre>";
	   // print_R($document);
	   // die("sdfad");
      

        return $document;
    }

}

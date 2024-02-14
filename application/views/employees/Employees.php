<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property user_actions          $user_actions
 * @property employees_actions          $employees_actions
 * @property mix_actions          $mix_actions
 * @property attachments_actions          $attachments_actions
 * @property positions_actions          $positions_actions
 */
class Employees extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
		$this->load->model('task_actions');
        $this->user_actions->is_loged_in('employees');
        $this->load->helper('url');
		
		 $this->load->model('employees_actions');
        $this->load->model('evaluation_actions');
		$this->load->model('discipline_actions');
        $this->load->model('departments_actions');
        $this->load->model('positions_actions');
		$this->load->model('timeoff_actions');
        $this->load->helper('fa-extension');
		$this->load->model('employee_memo');
    }

    function index($page_id = 1) {
		
        $this->load->model('employees_actions');
		
		$this->load->model('employee_memo');
		$empppp  = 	$this->employees_actions->get_employees($page_id);
	
		
	
        $this->load->view('employees/index', array(
            'employees' => $this->employees_actions->get_employees($page_id),
			'enum_values' => $this->employee_memo->enum_select('employees','status'),
		//	'employees_active' => $this->employees_actions->get_employees_active(),
            'ienumber' => $this->employees_actions->total_inactivcount(),
            'taskscount' => $this->employees_actions->total_tasks($empppp),
            'enumber' => $this->employees_actions->total_activcount(),
            'leave_rec' => $this->employees_actions->leave_rec(),
            'work_evaluation' => $this->employees_actions->work_evaluation(),
            'disciplinary_action' => $this->employees_actions->disciplinary_action(),
			'employee_memorg' => $this->employee_memo->get_employee_memo_list(),
            'search' => $this->input->get('search'),
			
            'active_menu' => 'employees',
            'page_id' => $page_id
        ));
        
	
    }

   function inactive($page_id = 1) {
        $this->load->model('employees_actions');
		$this->load->model('employee_memo');
		 $this->load->model('attachments_actions');
	
		 $id= $_GET['xy'];
	
		if($id !="" ){
        $this->load->view('employees/index', array(
            'employees' => $this->employees_actions->get_employeesssf($page_id, FALSE),
			'claims' => $this->employees_actions->inactiveclaim(),
			'enum_values' => $this->employee_memo->enum_select('employees','status'),
		//	'employees_inactive' => $this->employees_actions->get_employees_inactive(),
			'employee_memo' => $this->employee_memo->get_employee_memo_listfilter(),
			'employee_memorg' => $this->employee_memo->get_employee_memo_list(),
			
			 'enumber' => $this->employees_actions->total_inactivcount1(),
            'search' => $this->input->get('search'),
            'active_menu' => 'inactive_employees',
			 'page_id' => $page_id,
			 'inactive' => 1
        ));
		}
		else
		{
			
			  $this->load->view('employees/index', array(
            'employees' => $this->employees_actions->get_employeesss($page_id, FALSE),
			'claims' => $this->employees_actions->inactiveclaim(),
			'enum_values' => $this->employee_memo->enum_select('employees','status'),
	         //'employees_inactive' => $this->employees_actions->get_employees_inactive(),
			'employee_memo' => $this->employee_memo->get_employee_memo_listfilter(),
			'employee_memorg' => $this->employee_memo->get_employee_memo_list(),
		
			 'enumber' => $this->employees_actions->total_inactivcount(),
            'search' => $this->input->get('search'),
            'active_menu' => 'inactive_employees',
			 'page_id' => $page_id,
			 'inactive' => 1
        ));
			
		}
    }
	
	
	

	
	
    function edit_employee($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('evaluation_actions');
		$this->load->model('discipline_actions');
        $this->load->model('departments_actions');
        $this->load->model('positions_actions');
		$this->load->model('timeoff_actions');
        $this->load->helper('fa-extension');
		$this->load->model('employee_memo');
        $this->load->view('employees/employee_edit', array(
		
            'employee' => $this->employees_actions->get_employee($employee_id),
            'relatives' => $this->employees_actions->get_family($employee_id),
            'departments' => $this->departments_actions->get_departments(),
            'positions' => $this->positions_actions->get_positions(),
            'contracts' => $this->employees_actions->get_contract($employee_id),
            'performances' => $this->employees_actions->get_performances($employee_id),
            'claims' => $this->employees_actions->get_claims($employee_id),
            'evaluations' => $this->evaluation_actions->get_evaluations_employeeid($employee_id),
			  'count' => $this->evaluation_actions->get_eva($employee_id),
			 'get_leave' => $this->timeoff_actions->get_leave($employee_id),
			 'get_leave2' => $this->timeoff_actions->get_leave2($employee_id),
			 'displain' => $this->discipline_actions->get_disp($employee_id),
            'discipline' => $this->discipline_actions->get_recordsbyempid($employee_id),
            'assetbenefits' => $this->employees_actions->get_assetbenefits($employee_id),
            'licenses' => $this->employees_actions->get_licenses($employee_id),
			'employee_memor' => $this->employee_memo->get_employee_memo_list($employee_id),
			'record'=>$this->timeoff_actions->get_records()
        ));
    }

    function save_employee() {
        $this->load->library('form_validation');
	
		
        $this->form_validation->set_rules(array(
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'employee_name', 'rules' => 'required', 'label' => $this->lang->line('Name')),
            array('field' => 'nick_name', 'rules' => 'required', 'label' => $this->lang->line('Nick Name')),
            array('field' => 'employee_email', 'rules' => 'required|valid_email', 'label' => $this->lang->line('Email'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');

        if (!$result = $this->employees_actions->save_employee()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->view('employees/employee_save', array(
            'result' => $result,
            'avatar' => $this->employees_actions->get_avatar(),
			 'sign_img' => $this->employees_actions->get_sign()
        ));
		
    }

    function new_employe() {
        $this->load->view('employees/employee_new');
    }

    function save_address() {
        $this->load->model('employees_actions');
        $this->employees_actions->save_address();

        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }

    function save_department() {
        $this->load->model('employees_actions');
        $this->employees_actions->save_department();

        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }

	function save_department1() {
         $this->load->model('employees_actions');
		
		 $id =$this->input->get('empl');
	     $department =$this->input->get('department');
	 
        $this->employees_actions->save_department1();
}

function delete_file_from_folder(){
	$deletefiles =$this->input->get('allvalue');
	
	if($deletefiles){
		
 $directory = BASEPATH . '../files/ID_image/pic/';
    $filesd = glob($directory . '*');
	foreach($filesd as $path)
	{
		if(unlink($path)){
		   $this->db->update('employees', array('copy_avatar' => null)) ;
 }

	}
	
}	

	redirect('http://wshrms.peza.com.ph/request/processcallingcard');
}
//**delete sig image from folder
function delete_sigfile_from_folder(){
	$deletefiles =$this->input->get('allvalue');
	
	if($deletefiles){
		
 $directory = BASEPATH . '../files/ID_image/sig/';
    $filesd = glob($directory . '*');
	foreach($filesd as $path)
	{
		if(unlink($path)){
		   $this->db->update('employees', array('copy_sign' => null)) ;
 }

	}
	
}	

	redirect('http://wshrms.peza.com.ph/request/processcallingcard');
}






//**for multiple image files upload

 function  multiple_file(){
	 
	 
	  if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'files/ID_image/pic/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    //$uploadData[$i]['file_name'] = $fileData['file_name'];
                   // $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
	 
 }
 redirect('http://wshrms.peza.com.ph/request/processcallingcard');	
 }
//***upload for signature images
function multiple_sign_upload(){
	
	  if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'files/ID_image/sig/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    //$uploadData[$i]['file_name'] = $fileData['file_name'];
                    //$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
	 
 }
 redirect('http://wshrms.peza.com.ph/request/processcallingcard');	
 }
 
 function save_position() {
        $this->load->model('employees_actions');
        $this->employees_actions->save_position();

        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }

    function resign($employee_id = 0) {
        $this->load->model('mix_actions');
        $this->load->view('employees/employee_resign', array(
            'reasons' => $this->mix_actions->get_resign_reasons(),
            'employee_id' => $employee_id
        ));
    }

    function save_resign() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'reason', 'rules' => 'required', 'label' => $this->lang->line('Reason')),
            array('field' => 'date', 'rules' => 'required', 'label' => $this->lang->line('Date'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$this->employees_actions->resing_employee()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->view('employees/employee_resigned');
    }

    /**
     * Education
     * 
     */
    function education($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/education', array('education' => $this->employees_actions->get_education($employee_id)));
    }

    function edit_education($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/education_edit', array(
            'data' => $this->employees_actions->get_education_item($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'education')
        ));
    }

    function save_education() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'education_id', 'rules' => 'required', 'label' => 'education_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'institution_name', 'rules' => 'required', 'label' => $this->lang->line('Institution')),
            array('field' => 'description', 'rules' => 'required', 'label' => $this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');

        if (!$result = $this->employees_actions->save_education()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/education_add', $result);
    }

    function new_education($employee_id = 0) {
        $this->load->view('employees/education_new', array('employee_id' => $employee_id));
    }

    function delete_education() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_education($this->input->post('education_id'));
        $this->load->view('employees/education_delete', array('education_id' => $this->input->post('education_id')));
    }

    /**
     * Department
     * 
     */
    function department($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/department', array('department' => $this->employees_actions->get_department($employee_id)));
    }

    function edit_department($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/department_edit', array(
            'data' => $this->employees_actions->get_department_item($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'department')
        ));
    }

//    function save_department() {
//        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
//            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
//        }
//
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules(array(
//            array('field' => 'department_id', 'rules' => 'required', 'label' => 'department_id'),
//            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
//            array('field' => 'institution_name', 'rules' => 'required', 'label' => $this->lang->line('Institution')),
//            array('field' => 'description', 'rules' => 'required', 'label' => $this->lang->line('Description'))
//        ));
//
//        if ($this->form_validation->run() == FALSE) {
//            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
//        }
//
//        $this->load->model('employees_actions');
//
//        if (!$result = $this->employees_actions->save_department()) {
//            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
//        }
//
//        $this->load->helper('fa-extension');
//        $this->load->view('employees/department_add', $result);
//    }

    function new_department($employee_id = 0) {
        $this->load->view('employees/department_new', array('employee_id' => $employee_id));
    }

    function delete_department() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_department($this->input->post('department_id'));
        $this->load->view('employees/department_delete', array('department_id' => $this->input->post('department_id')));
    }

    function positions($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/positions', array('positions' => $this->employees_actions->get_positions($employee_id)));
    }

    function position_edit($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/position_edit', array('position' => $this->employees_actions->get_position($item_id)));
    }

    function update_position() {
        $this->load->model('employees_actions');
        $this->employees_actions->update_position();
        $this->load->view('layout/success', array('message' => $this->lang->line('Updated')));
    }

    function position_view($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/position_view', array('position' => $this->employees_actions->get_position($item_id)));
    }

    function new_position($employee_id = 0) {
        $this->load->model('positions_actions');
        $this->load->model('employees_actions');

        $this->load->view('employees/position_new', array(
            'positions' => $this->positions_actions->get_grouped_positions(),
            'employee_id' => $employee_id,
            'current_position' => $this->employees_actions->get_current_position($employee_id)
        ));
    }

//    function save_position() {
//        //_custom_debug($this->input->post());
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules(array(
//            array('field' => 'new_position', 'rules' => 'required', 'label' => $this->lang->line('New position')),
//            array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start date')),
//            array('field' => 'move_reason', 'rules' => 'required', 'label' => $this->lang->line('Move reason'))
//        ));
//
//        if ($this->form_validation->run() == FALSE) {
//            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
//        }
//
//        $this->load->model('employees_actions');
//        if (!$this->employees_actions->add_position()) {
//            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
//        }
//
//        $this->load->view('employees/position_add');
//    }

    function check_position($position_id = 0, $employee_id = 0) {
        $this->load->model('positions_actions');
        $this->load->view('employees/position_compatible', array('data' => $this->positions_actions->check_position($position_id, $employee_id)));
    }

    function skills($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/skills', array('skills' => $this->employees_actions->get_skills($employee_id)));
    }

    function edit_skills($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/skills_edit', array(
            'skills' => $this->employees_actions->get_employee_skills($employee_id),
            'employee_id' => $employee_id
        ));
    }

    function save_skills() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_employee_skills()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->view('employees/skills_add', array('result' => $result));
    }

    function employment($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/employment', array('employment' => $this->employees_actions->get_employment($employee_id)));
    }

    function edit_employment($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/employment_edit', array('employment' => $this->employees_actions->get_employment_item($item_id)));
    }

    function save_employment() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employment_id', 'rules' => 'required', 'label' => 'employment_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'company', 'rules' => 'required', 'label' => $this->lang->line('Company')),
            array('field' => 'position', 'rules' => 'required', 'label' => $this->lang->line('Position')),
            array('field' => 'start', 'rules' => 'required', 'label' => $this->lang->line('Start')),
            array('field' => 'end', 'rules' => 'required', 'label' => $this->lang->line('End'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_employment()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->view('employees/employment_add', array('result' => $result));
    }

    function new_employment($employee_id = 0) {
        $this->load->view('employees/employment_new', array('employee_id' => $employee_id));
    }

    function delete_employment() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_employment($this->input->post('employment_id'));
        $this->load->view('employees/employment_delete', array('employment_id' => $this->input->post('employment_id')));
    }

    function relatives($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/family', array('family' => $this->employees_actions->get_family($employee_id)));
    }

    function edit_relative($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/relative_edit', array(
            'relative' => $this->employees_actions->get_relative($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'relative')
        ));
    }

    function save_relative() {
		
		
		
		
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'relative_id', 'rules' => 'required', 'label' => 'relative_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'relative_name', 'rules' => 'required', 'label' => $this->lang->line('Name'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_relative()) {
            exit($this->load->view('layout/error', array('error' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/relative_add', $result);
    }

    function delete_relative() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_relative($this->input->post('relative_id'));
        $this->load->view('employees/relative_delete', array('relative_id' => $this->input->post('relative_id')));
    }

    function new_relative($employee_id = 0) {
        $this->load->view('employees/relative_new', array('employee_id' => $employee_id));
    }

    function licenses($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->helper('fa-extension');
        $this->load->view('employees/licenses', array('licenses' => $this->employees_actions->get_licenses($employee_id)));
    }

    function edit_license($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/license_edit', array(
            'license' => $this->employees_actions->get_license($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'license')
        ));
    }

    function save_license() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'license_id', 'rules' => 'required', 'label' => 'license_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'license_name', 'rules' => 'required', 'label' => $this->lang->line('Name')),
            array('field' => 'expiry', 'rules' => 'required', 'label' => $this->lang->line('Expiry')),
            array('field' => 'license_number', 'rules' => 'required', 'label' => $this->lang->line('Number'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_license()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/license_add', $result);
    }

    function delete_license() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_license($this->input->post('license_id'));
        $this->load->view('employees/license_delete', array('license_id' => $this->input->post('license_id')));
    }

    function new_license($employee_id = 0) {
        $this->load->view('employees/license_new', array('employee_id' => $employee_id));
    }

    function remove_attachment($attachment_id = 0) {
        $this->load->model('attachments_actions');
        $this->attachments_actions->remove_attachment($attachment_id);
    }

    function download_attachment($attachment_id = 0) {
		$this->load->helper('download');
        $this->load->model('attachments_actions');
       // $this->attachments_actions->download_attachment($attachment_id);
        //
        $attachment = $this->attachments_actions->download_attachment($attachment_id);
        $filewithpath = 'http://wshrms.peza.com.ph/files/attachments/'. $attachment['file'];
      //  echo BASEPATH.'../files/attachments/'.$attachment['file'];
        //echo $filewithpath; 

        $filewithpath = 'home1/pezacomph/public_html/wshrms/files/attachments/minebea_august.JPG';

        force_download($filewithpath, NULL);
        exit;
    }

    function set_password($employee_id = 0) {
		
		
		
        $userdata = $this->session->userdata();
        //if ((($employee_id == '1') && $userdata['employee_id'] != '1') OR ( !$this->user_actions->is_allowed('admin'))) {
        if (($employee_id == '1') && $userdata['employee_id'] != '1') {
            return FALSE;
        }
		$this->load->model('employee_memo');
		$this->load->model('employees_actions');
		$this->load->model('task_actions');

        $page_id=1;
		
		
		
		//print_r($_POST);
        $this->load->view('employees/password_set', array(
            'is_active' => $this->user_actions->is_employee_active($employee_id),
			'all_active_user' => $this->employees_actions->get_employees($page_id),
			'alltask' => $this->task_actions->get_task_type_list(),
			'tasks'=>$this->task_actions->get_selftasks($status,$employee_id,$catte),
            'employee_id' => $employee_id,
            'permissions' => $this->user_actions->get_permissions($employee_id),
			'enum_values' => $this->employee_memo->enum_select('employees','status'),
			'employee_memor' => $this->employee_memo->get_employee_memo_list($employee_id),
			'employee_memo' => $this->employee_memo->get_employee_memo_statusnote($employee_id)
			
        ));
    }
	
	function task_assignto(){
		//$userdata = $this->session->userdata();
		$this->load->model('task_actions');
		$postdata=$this->input->post();
		$employee_id =	$postdata['emp_id'];
		$new_emp =	$postdata['employee_id'];
		
		$status='all';
		$tasks=$this->task_actions->get_selftasks($status , $employee_id);
		// echo "<pre>";
		// print_R($tasks);
		// die("fdguhj");
		
		//die("sdfds");
		if(!empty($tasks))
		{
		// echo'<pre>';print_r($postdata);echo'</pre>';die('fgfhgfyjh');
		
		foreach($tasks as $task){
			
			$notify = $task['notify'];
		$newnotify = str_replace($employee_id, "", $notify);
		if($task['task_status']=="")
		{
			$status ="assigned";
		}
		else
		{
			$status= $task['task_status'];
		}
		
		$data = array(
			'employee_id' =>	$new_emp,
            'task_id' => $task['task_id'],
            'task_title' => $task['task_title'],
            'status' => $status,
            'task_attention' => $task['task_attention'],
            'task_regular' => $task['task_regular'],
            'notify' => $newnotify.' '.$new_emp,
            'task_category_id' => $task['task_category_id'],
            'related_department' => $task['workmanual_category_id'],
            'start_date' => $task['start_date'],
            'due_date' => $task['due_date'],
            'description' => $task['description'],
            'additional' => $task['additional'],
			'updated_date' => date('Y-m-d H:i:s')
        );
		// echo'<pre>';print_r($data);echo'</pre>';
		// die("dgfd");
		$where=array('task_id' => $task['task_id']);
		 $this->task_actions->assign_task($data, $where);
		}
		}
		$status='all';
		//$tasks=$this->task_actions->get_selftasks($status , 103);
		  $this->load->model('employees_actions');
			$resultemp = $this->employees_actions->get_taskemployee($new_emp);
	
 $from_email1 = "uplus.hrms@peza.com.ph"; 
 $resemail=$resultemp['email'];
 $subbb= "Task Assigned";
 $msggg='';
 
 
			foreach($tasks as  $t)
			{
				
				$msggg .= '<h2>Task List</h2><br/>';
				$msggg .= '<b>Title:</b>'.$t['task_title'].'<br/>';
				$msggg .= '<b>Description:</b>'.$t['description'].'<br/>';
			}
			
			// echo $msggg;
			// die("gfggj");
 		$this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from($from_email1); 
         $this->email->to($resemail);
         $this->email->subject($subbb); 
         $this->email->message($msggg);
		$sent = $this->email->send();
		
	redirect('employees/edit_employee/'.$employee_id);
		//}
		 //$this->load->view('layout/success', array('message' => $this->lang->line('Done')));
		
		//}
	}
//**calling card email functions//

 function callaing_card_mail(){
	 $this->load->model('employees_actions');
	$x=$this->input->get('q', TRUE);
	//echo $x;
	
	
	//print_r($ids);
	$result=$this->employees_actions->image_path_copy($x);
	//$result1=$this->employees_actions->image_path_copy($x);
	 // echo"<pre>";
 // print_R($result);
	 // echo"</pre>";
	  // die();
	  foreach($result as $key => $xyz)
		{
		    foreach($xyz as $key => $xy)
			{
				
				 
				 $from_email1 = "uplus.hrms@peza.com.ph"; 
                 $resemail=$xy->email;
                 $name=$xy->name;
                 $nick_name=$xy->nick_name;
                 $hired_date=$xy->hired_date;
                 $employee_no=$xy->employee_no;
                 $department=$xy->emailf;
                 $gender=$xy->gender;
                 $status=$xy->status;
                 $ssn=$xy->ssn;
                 $tin=$xy->tin;
                 $employee_pag_ibigno=$xy->employee_pag_ibigno;
                 $healthno=$xy->healthno;
                 $employee_relation=$xy->employee_relation;
                 $employee_address=$xy->employee_address;
                 $contactno=$xy->contactno;
                 $employee_contactperson=$xy->employee_contactperson;
				 
				       $password =$xy->user_password;
					 $password  = hash('sha512',  $password );
                 $subbb= "Your login details";
                 $msggg="Site Url : ".'http://wshrms.peza.com.ph'."<br/>"."Username: ".$resemail."<br/>"."Password: ".' Please Reset Password To Access Your Account<br><p style="color:red;font-weight:bolder;">Your Other Details See Below  Cheack With  Carefully If Any Mistakes or  Any Changes Please Contact to Admin </p>'.
				 "Name : ".$name."<br/>".
				 "Nick Name : ".$nick_name."<br/>".
				 "Hire Date : ".$hired_date."<br/>".
				 "Employee No. : ".$employee_no."<br/>".
				 "Department Name : ".$department."<br/>".
				 "Gender : ".$gender."<br/>".
				 "Status : ".$status."<br/>".
				 "SSS No. : ".$ssn."<br/>".
				 "TIN No. : ".$tin."<br/>".
				 "Pag-Ibig No. : ".$employee_pag_ibigno."<br/>".
				 "PhilHealth No. : ".$healthno."<br/>".
				 "Relation : ".$employee_relation."<br/>".
				 "Address : ".$employee_address."<br/>".
				 "Contact No. : ".$contactno."<br/>".
				 "Contact Person : ".$employee_contactperson."<br/>";
				 
                   $this->load->library('email'); 
		         $this->email->set_mailtype("html");
                 $this->email->from($from_email1); 
                 $this->email->to($resemail);
                 $this->email->subject($subbb); 
                 $this->email->message($msggg);
		         $sent = $this->email->send();
				 
				
			}
			
	   }
	   	redirect('http://wshrms.peza.com.ph/request/processcallingcard');
    
	 
 }
 
 //***
 function save_image_desktop(){
	  $image=$this->input->get('save_image', TRUE);
	 
	 $this->load->helper('download');
	$file = 'http://wshrms.peza.com.ph/files/ID_image/pic/';
$local_file = 'ID_image';
$download_file = 'name.zip';

// set the download rate limit (=> 20,5 kb/s)
$download_rate = 20.5;
if(file_exists($local_file) && is_file($local_file))
{
    header('Cache-control: private');
    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($local_file));
    header('Content-Disposition: filename='.$download_file);

    flush();
    $file = fopen($local_file, "r");
    while(!feof($file))
    {
        // send the current file part to the browser
        print fread($file, round($download_rate * 1024));
        // flush the content to the browser
        flush();
        // sleep one second
        sleep(1);
    }
    fclose($file);}
else {
    die('Error: The file '.$local_file.' does not exist!');
}
}
	 
 
 
 //**image copy path function
 function  image_path_copy(){
	  $this->load->model('employees_actions');
	$empid=$this->input->get('empi', TRUE);
	
	$result=$this->employees_actions->image_path_copy($empid);
	$path="";
	
	  foreach($result as $key => $xyz)
		{
		    foreach($xyz as $key => $xy)
			{
				
				$path=$path. " files/ID_image/pic/".$xy->employee_no.'.jpg'.',';
		
		
		}
		}
		$this->employees_actions->get_emp_img_path($path);
 }
 //***copy all eployee image path 
 function getallid(){
	  $this->load->model('employees_actions');
	$empiddd=$this->input->get('allvalue', TRUE); 
	 
	 $result=$this->employees_actions->image_path_copy();
	$path="";
	$paths="";
	$iddd="";
	  foreach($result as $key => $xyz)
		{
		    foreach($xyz as $key => $xy)
			{
				
				$path = $path. " files/ID_image/pic/".$xy->employee_no.'.jpg'.',';
				$paths = $paths. " files/ID_image/sig/".$xy->employee_no.'.jpg'.',';
		$iddd = $iddd. $xy->employee_id.',';
		
		}
		}
		$this->employees_actions->get_emp_img_path2($path,$paths,$iddd);
	 
	 
 }
 //**copy All Employee signature Image path
 
 function signature_all(){
	  $this->load->model('employees_actions');
	$empiddd=$this->input->get('allvalue', TRUE); 
	 
	 $result=$this->employees_actions->image_path_copy();
	$path="";
	$iddd="";
	  foreach($result as $key => $xyz)
		{
		    foreach($xyz as $key => $xy)
			{
				
				$path=$path. " files/ID_image/sig/".$xy->employee_no.'.jpg'.',';
		$iddd = $iddd. $xy->employee_id.',';
		
		}
		}
		$this->employees_actions->signature_all($path,$iddd);
	 
	 
 }
 

//**calling card email functions
function pinemp(){
	 $employee_id =$_GET['id'];
	 $this->load->model('employees_actions');
	  $this->employees_actions->pinemp($employee_id);
        
      }
function unpin(){
	
 $employee_id =$_GET['id'];
	 $this->load->model('employees_actions');
	  $this->employees_actions->unpin($employee_id);
        
      }
  
    function save_password() {
		// $postdata=$this->input->post();
		// print_r($postdata);die('dfdgh');
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id')
        ));

        if ($this->input->post('new_password')) {
            $this->form_validation->set_rules(array(
                array('field' => 'new_password', 'rules' => 'required', 'label' => $this->lang->line('New password')),
                array('field' => 'password_again', 'rules' => 'required', 'label' => $this->lang->line('Password again'))
            ));
        }

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/success', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->user_actions->update_password();
        $this->load->view('layout/success', array('message' => $this->lang->line('Done')));
    }

    function contract_type() {
        $this->load->model('contract_type');
        $this->load->view('employees/contract_type_list', array('contract_types' => $this->contract_type->get_contract_type_list()));
    }
	
	function employee_memo() {
        $this->load->model('employee_memo');
        $this->load->view('employees/employee_memo_list', array('employee_memo' => $this->employee_memo->get_employee_memo_list()));
    
    }

    function new_contract_type() {
        $this->load->view('employees/contract_type_new');
    }

    function get_contract_type() {
        $contract_type_id = $this->input->post('id');
        $this->load->model('contract_type');
        $data = array('contract_type' => $this->contract_type->get_contract_type($contract_type_id));
        die(json_encode($data));
    }

    function edit_contract_type($contract_type_id = 0) {
        $this->load->model('contract_type');
        $this->load->view('employees/contract_type_edit', array('contract_type' => $this->contract_type->get_contract_type($contract_type_id)));
    }
	
	function edit_employee_memo($employee_memo_id = 0,$id) {
		
		//echo $id;
		// $this->load->model('employees_actions');
        $this->load->model('employee_memo');
        $this->load->view('employees/employee_memo_edit', array(
		//'employees' => $this->employees_actions->get_employeesssf($id,$page_id, FALSE),
		'employee_memog' => $this->employee_memo->get_employee_memo($employee_memo_id),
		'enum_values' => $this->employee_memo->enum_select('employees','status',$employee_memo_id),
		'employee_memo' => $this->employee_memo->get_employee_memo_list(),
		 
		
		));
    }
	
	
	function add_employee_memoo() {

        $this->load->model('employee_memo');
        $this->load->view('employees/employee_memo_add');
    }
	
	function save_employee_memoo() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_memoo', 'rules' => 'required', 'label' => 'employee_memoo'),
            
            //array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('employee_memo');
        $this->load->view('employees/list_add', array('result' => $this->employee_memo->add_employee_memoo()));
    }
	

    function save_contract_type() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'contract_type_id', 'rules' => 'required', 'label' => 'contract_type_id'),
            array('field' => 'contract_type_name', 'rules' => 'required', 'label' => $this->lang->line('contract_type_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('contract_type');
        $this->load->view('employees/contract_type_add', array('result' => $this->contract_type->save_contract_type()));
    }
	
	function save_employee_memo() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_memo_id', 'rules' => 'required', 'label' => 'employee_memo_id'),
            array('field' => 'employee_memo', 'rules' => 'required', 'label' => $this->lang->line('employee_memo')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employee_memo');
        $this->load->view('employees/employee_memo_add', array('result' => $this->employee_memo->save_employee_memo()));
    }
	
	
	
	
	function up_employee_memo() {
		
		// echo '<pre>';
		// print_r($_POST['employee_memo_id']);
		// echo '</pre>';
		//$id= $_POST['employee_memo_id'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'employee_memo_id', 'rules' => 'required', 'label' => 'employee_memo_id'),
           // array('field' => 'employee_memoo', 'rules' => 'required', 'label' => $this->lang->line('employee_memoo')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

         $this->load->model('employee_memo');
         $this->load->view('employees/list_add', array('result' => $this->employee_memo->up_employee_memo()));
    }

	/*******************************Employee list *****************************************/
	function delete_emp() {
        $this->load->model('employee_memo');
        $this->employee_memo->delete_emp_type($this->input->post('employee_memo_id'));
        $this->load->view('employees/contract_emp_delete', array('employee_memo_id' => $this->input->post('employee_memo_id')));
    }
	
	/*******************************Employee list start *****************************************/
	
	
    function delete_contract_type() {
        $this->load->model('contract_type');
        $this->contract_type->delete_contract_type($this->input->post('contract_type_id'));
        $this->load->view('employees/contract_type_delete', array('contract_type_id' => $this->input->post('contract_type_id')));
    }

    function contract($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->view('employees/contract', array('contracts' => $this->employees_actions->get_contract($employee_id)));
    }

    function edit_contract($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('contract_type');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $contract_types = $this->contract_type->get_contract_type_list();
        $this->load->view('employees/contract_edit', array(
            'contract' => $this->employees_actions->get_contract_item($item_id),
            'contract_types' => $contract_types,
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'contract')
        ));
    }

    function save_contract() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'contract_id', 'rules' => 'required', 'label' => 'contract_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'contract_type_id', 'rules' => 'required', 'label' => 'contract_type_id'),
            array('field' => 'content', 'rules' => 'required', 'label' => $this->lang->line('Contract Content')),
            array('field' => 'contract_condition', 'rules' => 'required', 'label' => $this->lang->line('Contract Condition')),
            array('field' => 'contract_expiry', 'rules' => 'required', 'label' => $this->lang->line('Contract Expiration Date'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_contract()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/contract_add', $result);

        //$this->load->view('employees/contract_add', array('result' => $result));
    }

    function new_contract($employee_id = 0) {
        $this->load->model('contract_type');
        $contract_types = $this->contract_type->get_contract_type_list();
        $this->load->view('employees/contract_new', array('employee_id' => $employee_id, 'contract_types' => $contract_types));
    }

    function delete_contract() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_contract($this->input->post('contract_id'));
        $this->load->view('employees/contract_delete', array('contract_id' => $this->input->post('contract_id')));
    }

    function print_contract($contract_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $contract = $this->employees_actions->print_contract($contract_id);
        //PDF generating
        $html = $this->load->view('employees/contract_print', array('contract' => $contract, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $contract['fullname']) . "_contract.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

    function print_employee($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $company_name = $this->settings_actions->get_setting('company_name');
        $company_address = $this->settings_actions->get_setting('company_address');
        $company_phone = $this->settings_actions->get_setting('company_phone');
        $employee = $this->employees_actions->print_employee($employee_id);
		$family = $this->employees_actions->get_family($employee_id);

        $data = array(
            'company' => array('logo' => $logo, 'name' => $company_name, 'address' => $company_address, 'phone' => $company_phone),
            'family' => $family, 'employee' => $employee
        );
        //PDF generating
        $html = $this->load->view('employees/employee_print', $data, TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $employee['fullname']) . "_employee.pdf";

        //load mPDF library
        $param = array(
            'mode' => 'en-GB-x',
            'format' => 'A4',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'P'
        );
        $this->load->library('m_pdf', $param);
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
    
    function print_calling_card($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $company_name = $this->settings_actions->get_setting('company_name');
        $company_phone = $this->settings_actions->get_setting('company_phone');
        $company_address = $this->settings_actions->get_setting('company_address');
        $employee = $this->employees_actions->print_employee($employee_id);

        $data = array(
            'company' => array('logo' => $logo, 'name' => $company_name, 'address' => $company_address, 'phone' => $company_phone),
            'employee' => $employee
        );
        //PDF generating
        $html = $this->load->view('employees/employee_card', $data, TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $employee['fullname']) . "_employee.pdf";

        //load mPDF library
        $param = array(
            'mode' => 'en-GB-x',
            'format' => 'A4',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'P'
        );
        $this->load->library('m_pdf', $param);
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

    function upload_avatar_bk() {
        //_custom_debug($_FILES);
        $employee_id = $this->input->get('     ');
        if (isset($_FILES['webcam']) AND ( $_FILES['webcam']['error'] == 0)) {
            $this->load->library('upload', array('upload_path' => BASEPATH . '../files/avatars/', 'allowed_types' => 'gif|jpg|jpeg|png', 'max_size' => '300', 'encrypt_name' => TRUE));

            if (!$this->upload->do_upload('webcam')) {
                $this->set_error($this->upload->display_errors());
                return FALSE;
            }

            $this->load->library('image_lib', array('image_library' => 'gd2', 'source_image' => $this->upload->upload_path . $this->upload->file_name, 'maintain_ratio' => FALSE, 'width' => 140, 'height' => 140, 'master_dim' => 'height'));

            if (!$this->image_lib->resize()) {
                $this->set_error($this->image_lib->display_errors());
                return FALSE;
            }

            $avatar = 'files/avatars/' . $this->upload->file_name;
            //_custom_debug($avatar);
            $this->load->model('employees_actions');
            $this->employees_actions->update_employee_avatar($employee_id, $avatar);
        }
    }

    function upload_avatar() {
		  $this->load->model('employees_actions');
		 $uploadedp =$_GET['id'];
		
	if(!empty($uploadedp)){
		
		$result= $this->employees_actions->getemp_images($uploadedp);
		$res=$result[0];
		/****/
		
		
$imagePath = $res['avatar'];
		
$newPath = $res['avatar'].'_'.$res['employee_no'];
$image_name=basename($imagePath);
$new_name= $res['employee_no'];
$pathinfo = pathinfo($imagePath);
$ext = '.jpg';
$newName  = 'files/ID_image/pic/'.$new_name.$ext;

$data= array('copy_avatar'=>$newName);
$employee_id=$res['employee_id'];
$copied = copy($imagePath , $newName);

if ((!$copied)) 
{
    echo "Error : Not Copied";
}
else
{ 
   $inseert= $this->employees_actions->copy_avtarimages($data, $employee_id);
   echo'image copied';
}
		/****/
	//print_r($result[0]);
		
		//die();
	}else{
		 $options = array(
            // Upload directory
            'upload_dir' => 'files/avatars/',
            // Accepted file types
            'accept_file_types' => 'png|jpg|jpeg|gif',
            // Directory mode
            'mkdir_mode' => 0777,
            // File max/min size in bytes
            'max_file_size' => null,
            'min_file_size' => 1,
            // Image size validation
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // If the image size < crop size then force the resize
            'force_crop' => true,
            // Crop max width
            'crop_max_width' => null,
            // Crop max height
            'crop_max_height' => null,
            /**
             * Before upload callback.
             *
             * @param stdClass $image Properties: name, type size
             */
            'before_upload' => function ($image) {
                // Set image name. By default the image will have the original name but
                // with a number at the end if already exits
                // You can set the name to the userID or something like that
                // $image->name = "my_image.".$image->type;
            },
            /**
             * Upload complete callback.
             *
             * @param stdClass $image Properties: name, type, size, path, url, width, height
             */
            'upload_complete' => function ($image) {
                // Here you can save the image to database
                // using $image->name to get the image name
            },
            /**
             * Before crop callback.
             *
             * @param stdClass $crop Properties: file_name, file_type, src_path, dst_path, src_h, src_w, src_y, src_x, dst_w, dst_h
             */
            'before_crop' => function ($crop) {
                // You can set the crop destionaton path so the original file will be keept
                // $filename = "my_image_cropped.".$crop->file_type;
                // $crop->dst_path = $instance->getUploadPath($filename);
            },
            /**
             * Crop complete callback
             *
             * @param stdClass $image Pproperties: name, type, path, url, width, height
             */
            'crop_complete' => function ($image) {
                // Here you can save the image to database,
                // using $image->name to get the image name
            }
        );
        $employee_id = $this->input->get('employee_id');

        $this->load->library('imgselect',$options);
        $result = $this->imgselect->initialize();
        //_custom_debug($file);
        $file = $result['data'];
        if($file->action == 'upload') {
            die(json_encode($result));
        } else {
            $avatar = 'files/avatars/' . $file->name;
            //_custom_debug($avatar);
            $this->load->model('employees_actions');
            $this->employees_actions->update_employee_avatar($employee_id, $avatar);
            die(json_encode($result));
        }
    }
	}
	
	//*****************************for sign img code***********/
	
	
	function confirm_pro() {
		 $this->load->model('employees_actions');
		 $empl_pro =$_GET['pro'];
		 
		  $this->employees_actions->update_pro();
	
	}
function update_sin() {
		 $this->load->model('employees_actions');

		  $empl_sign =$_GET['sign'];
		  $this->employees_actions->update_sign();
	
	}
	function delete_datepp() {
		 $this->load->model('employees_actions');

		  $reset_id =$_GET['reset_id'];
		  $this->employees_actions->delete_datepp();
	
	}
	
	
	
	
	function upload_sign() {
		 $this->load->model('employees_actions');
		 $uploadedp =$_GET['id'];
		if(!empty($uploadedp)){
		
		$result= $this->employees_actions->getemp_images($uploadedp);
		$res=$result[0];
		/****/
		
		// print_r($res);
		// die();
		
$imagePath = $res['sign'];
		
$newPath = $res['sign'].'_'.$res['employee_no'];
$image_name=basename($imagePath);
$new_name= $res['employee_no'];
$pathinfo = pathinfo($imagePath);
$ext = '.jpg';
$newName  = 'files/ID_image/sig/'.$new_name.$ext;

$data= array('copy_sign'=>$newName);
$employee_id=$res['employee_id'];
$copied = copy($imagePath , $newName);




if ((!$copied)) 
{
    echo "Error : Not Copied";
}
else
{ 
 $inseert= $this->employees_actions->copy_signimages($data, $employee_id);
   echo'image copied';
}
		/****/
	//print_r($result[0]);
		
		//die();
	}else{
		
        $options = array(
            // Upload directory
            'upload_dir' => 'files/sign/',
            // Accepted file types
            'accept_file_types' => 'png|jpg|jpeg',
            // Directory mode
            'mkdir_mode' => 0777,
            // File max/min size in bytes
            'max_file_size' => null,
            'min_file_size' => 1,
            // Image size validation
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // If the image size < crop size then force the resize
            'force_crop' => true,
            // Crop max width
            'crop_max_width' => null,
            // Crop max height
            'crop_max_height' => null,
            /**
             * Before upload callback.
             *
             * @param stdClass $image Properties: name, type size
             */
            'before_upload' => function ($image) {
                // Set image name. By default the image will have the original name but
                // with a number at the end if already exits
                // You can set the name to the userID or something like that
                // $image->name = "my_image.".$image->type;
            },
            /**
             * Upload complete callback.
             *
             * @param stdClass $image Properties: name, type, size, path, url, width, height
             */
            'upload_complete' => function ($image) {
                // Here you can save the image to database
                // using $image->name to get the image name
            },
            /**
             * Before crop callback.
             *
             * @param stdClass $crop Properties: file_name, file_type, src_path, dst_path, src_h, src_w, src_y, src_x, dst_w, dst_h
             */
            'before_crop' => function ($crop) {
                // You can set the crop destionaton path so the original file will be keept
                // $filename = "my_image_cropped.".$crop->file_type;
                // $crop->dst_path = $instance->getUploadPath($filename);
            },
            /**
             * Crop complete callback
             *
             * @param stdClass $image Pproperties: name, type, path, url, width, height
             */
            'crop_complete' => function ($image) {
                // Here you can save the image to database,
                // using $image->name to get the image name
            }
        );
        $employee_id = $this->input->get('employee_id');

        $this->load->library('imgselect',$options);
        $result = $this->imgselect->initialize();
        //_custom_debug($file);
        $file = $result['data'];
        if($file->action == 'upload') {
            die(json_encode($result));
        } else {
            $avatar = 'files/sign/' . $file->name;
            //_custom_debug($avatar);
            $this->load->model('employees_actions');
            $this->employees_actions->update_employee_avatar1($employee_id, $avatar);
            die(json_encode($result));
        }
	}
    }
	
	function delete_copyimpg(){
	
 $updat =$_GET['id'];
 
 	$result= $this->employees_actions->getemp_images();
	
		$res=$result[0];
	
		
$imagePath = $res['copy_avatar'];
 $result= $this->employees_actions->delete_copyimg($imagePath,$updat);
 
		
		
	}
	
	function sign_delete_img(){
	
 $updat =$_GET['id'];
 
 	$result= $this->employees_actions->getemp_images();
	
		$res=$result[0];
	
		
$imagePath = $res['copy_sign'];
 $result= $this->employees_actions->sign_delete_img($imagePath,$updat);
 
		
		
	}
	function delete_ppdate(){
	$this->load->model('employees_actions');
 $delete_pp =$_GET['id'];
 
 	$result= $this->employees_actions->delete_ppdate($delete_pp);
	}
    
    function performances($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->helper('fa-extension');
        $this->load->view('employees/performances', array('performances' => $this->employees_actions->get_performances($employee_id)));
    }

	/********************claim start*******************************/
	 
	/********************claim end*******************************/
	
    function edit_performance($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/performance_edit', array(
            'performance' => $this->employees_actions->get_performance($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'performance')
        ));
    }

    function save_performance() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'performance_id', 'rules' => 'required', 'label' => 'performance_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'performance_name', 'rules' => 'required', 'label' => $this->lang->line('Name'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_performance()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/performance_add', $result);
    }

	
	/**********************save claim start*****************************/
	
	
	  function claims($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->helper('fa-extension');
        $this->load->view('employees/claim', array('claims' => $this->employees_actions->get_claims($employee_id)));
    }
	
	
	 function edit_claim($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/claim_edit', array(
            'claim' => $this->employees_actions->get_claim($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'claim')
        ));
    }
	
	
	 function save_claim() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'claim_id', 'rules' => 'required', 'label' => 'claim_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'claim_name', 'rules' => 'required', 'label' => $this->lang->line('Name'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_claim()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/claim_add', $result);
    }
	
	
	
    function delete_claim() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_claim($this->input->post('claim_id'));
        $this->load->view('employees/claim_delete', array('claim_id' => $this->input->post('claim_id')));
    }
	
	 function new_claim($employee_id = 0) {
        $this->load->view('employees/claim_new', array('employee_id' => $employee_id));
    }
	/***********************save claim end****************************/
	
	
    function delete_performance() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_performance($this->input->post('performance_id'));
        $this->load->view('employees/performance_delete', array('performance_id' => $this->input->post('performance_id')));
    }

    function new_performance($employee_id = 0) {
        $this->load->view('employees/performance_new', array('employee_id' => $employee_id));
    }
	/*************************Quick claim start********************************/
    
    /*************************Quick claim end********************************/
    function assetbenefits($employee_id = 0) {
        $this->load->model('employees_actions');
        $this->load->helper('fa-extension');
        $this->load->view('employees/assetbenefits', array('assetbenefits' => $this->employees_actions->get_assetbenefits($employee_id)));
    }

    function edit_assetbenefit($item_id = 0) {
        $this->load->model('employees_actions');
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');

        $this->load->view('employees/assetbenefit_edit', array(
            'assetbenefit' => $this->employees_actions->get_assetbenefit($item_id),
            'attachments' => $this->attachments_actions->get_attachments($item_id, 'assetbenefit')
        ));
    }

    function save_assetbenefit() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'assetbenefit_id', 'rules' => 'required', 'label' => 'assetbenefit_id'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'assetbenefit_name', 'rules' => 'required', 'label' => $this->lang->line('Name'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('employees_actions');
        if (!$result = $this->employees_actions->save_assetbenefit()) {
            exit($this->load->view('layout/error', array('message' => $this->employees_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('employees/assetbenefit_add', $result);
    }

    function delete_assetbenefit() {
        $this->load->model('employees_actions');
        $this->employees_actions->delete_assetbenefit($this->input->post('assetbenefit_id'));
        $this->load->view('employees/assetbenefit_delete', array('assetbenefit_id' => $this->input->post('assetbenefit_id')));
    }

    function new_assetbenefit($employee_id = 0) {
        $this->load->view('employees/assetbenefit_new', array('employee_id' => $employee_id));
    }
	//csv_uploade for employee 
	
function uploadData(){
	$this->load->model('employees_actions');
	 if ($this->input->post('submit')) {
            
            $path = 'uploade/';
            require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if(empty($error)){
              if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                $flag = true;
				
               
                foreach ($allDataInSheet as $value) {
					
                  if($flag){
                    $flag =false;
                    continue;
                  }
				  
				  
				  $data=array(
				  
				  'employee_id'=>$value['A'],
				  'hired_date'=>$value['B'],
				  'employee_no'=>$value['C'],
				  'email'=>$value['D'],
				  'nick_name'=>$value['E'],
				  'name'=>$value['F'],
				  'ssn'=>$value['G'],
				  'tin'=>$value['H'],
				  'employee_pag_ibigno'=>$value['I'],
				  'birth_date'=>$value['J'],
				  'employee_contactperson'=>$value['K'],
				  'employee_relation'=>$value['L'],
				  'employee_address'=>$value['M'],
				  'cell_phone'=>$value['N'],
				  'status'=>$value['O']);
				 }               
                $result = $this->employees_actions->importdata($data); 
                
				 
                if($result){
echo"<script>alert('Imported successfully !'); window.location = 'http://wshrms.peza.com.ph/request/processcallingcard';
</script>";
					
                
                }else{
                  echo "ERROR !";
                }             
     
          } catch (Exception $e) {
               die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' .$e->getMessage());
            }
          }else{
              echo $error['error'];
            }
            
            
    }

}
//download csv


function outputcsv() {
	
	
	$this->load->model('employees_actions');
	 $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Employee Master List.csv";
		//$export =$this->employees_actions->export_data();
       $query = "SELECT employees.employee_id, employees.name, employees.nick_name,employees.employee_no,employees.email ,employees.avatar, employees.sign, employees.copy_avatar,employees.copy_sign,employees.tin,employees.ssn,
	   employees.Pag_Ibig_No, 
employees.healthno,employees.birth_date,employees.gender,employees.address, departments.department_name
FROM employees
INNER JOIN departments ON employees.department_id = departments.department_id 
INNER JOIN users ON employees.employee_id = users.employee_id
   WHERE users.is_active='1'";
       $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
	
	
  }
    
 
		
    // header('Content-Type: text/csv; charset=utf-8');  
      // header('Content-Disposition: attachment; filename=employee_details.csv');  
      // $output = fopen("php://output", "w");  
     
      // $export =$this->employees_actions->export_data();
	
 // die();fputcsv($file,explode(',',$line));
  // fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Joining Date'));  
   // foreach($export as $row){
    // print_r($row);
	 // fputcsv($output,$row);  
      // }  
      // fclose($output);  
 
}

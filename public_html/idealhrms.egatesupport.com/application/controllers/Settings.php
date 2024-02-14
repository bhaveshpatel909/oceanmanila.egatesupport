<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property user_actions          $user_actions
 * @property settings_actions          $settings_actions
 * @property mix_actions          $mix_actions
 * @property positions_actions          $positions_actions
 * @property departments_actions          $departments_actions
 */
class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('admin');
		
        $this->load->helper(array('form', 'html', 'file', 'path', 'url'));
    }

    function index() {
        
    }

    function company() {
        $this->load->model('settings_actions');
        $this->load->view('settings/company', array(
            'details' => $this->settings_actions->get_settings('company'),
            'controller' => $this
        ));
		
	}
function unlink1()
{if(isset($_POST['files']))
	{
	unlink ($image);
	}
	 return Redirect::to('settings/company');
	// $this->load->view('settings/company');
}
	  
	
    function save_company() {
		
		//print_r($_POST);
		//die('jjhk');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'html', 'file'));

        // some validation configurations ...
        // register a custom callback for the image element
        $this->form_validation->set_rules('company_logo', 'Logo', 'callback_handle_upload');
        $this->form_validation->set_rules(array(
            array('field' => 'company_name', 'rules' => 'required', 'label' => $this->lang->line('Name')),
            array('field' => 'company_email', 'rules' => 'required', 'label' => $this->lang->line('Email'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->user_actions->get_error()), TRUE));
        }

        $this->load->model('settings_actions');
        $this->settings_actions->save_settings('company');

        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }
	 
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
 function save2(){
        $data = array();
		$this->load->library('form_validation');
        $this->load->helper(array('form', 'html', 'file'));
        // If file upload form submitted
        if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = './files/logoselect/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                
				
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }	
            }
		}
		// echo "image inserted";
		 // return Redirect::to('settings/company');
		$data['abcd']= '12';
$this->load->view('settings/company',$data);
	 }



	 function del()
	 {
	 $image=$_GET['img'];
	unlink($image);
	$data['abc']= '12';
$this->load->view('settings/company',$data);
	 }
////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
    function handle_upload() {


        $config['upload_path'] = './files/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if (isset($_FILES['company_logo']) && !empty($_FILES['company_logo']['name'])) {
            if ($this->upload->do_upload('company_logo')) {
                // set a $_POST value for 'image' that we can use later
                $upload_data = $this->upload->data();
				
				//print_r($upload_data) or die;
				
                $_POST['company_logo'] = 'files/logo/' . $upload_data['file_name'];
                return true;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            // throw an error because nothing was uploaded
            //$this->form_validation->set_message('handle_upload', "You must upload an image!");
            //return false;
        }
    }

    public function getBase64Image($image) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = set_realpath($image);
        $imageData = base64_encode(file_get_contents(set_realpath($image)));
        $this->load->library('image_lib', $config);
        $src = 'data: ' . $this->image_lib->mime_type . ';base64,' . $imageData;
        return $src;
    }
	function email() {
        $this->load->model('settings_actions');
        $this->load->view('settings/email', array(
            'email' => $this->settings_actions->get_settings('email'),
            'manager' => $this->settings_actions->get_managersettings(),
            'accountingemail' => $this->settings_actions->get_accountingmail_settings(),
            'expiration' => $this->settings_actions->get_expiredate(),
            'admin_manager_name' => $this->settings_actions->get_setting('admin_manager_name'),
			 'company_address' => $this->settings_actions->get_setting('company_address'),
			'company_phone' =>$this->settings_actions->get_setting('company_phone'),
			'company_name' =>$this->settings_actions->get_setting('company_name'),
			'no_employees' =>$this->settings_actions->get_setting('no_of_employee'),
            
        ));
    }
/*
    function email() {
        $this->load->model('settings_actions');
        $this->load->view('settings/email', array(
            'email' => $this->settings_actions->get_settings('email'),
            'manager' => $this->settings_actions->get_managersettings(),
            'adminemail' => $this->settings_actions->get_managersettingss()
        ));
    }
*/
    function save_email() {
        $this->load->library('form_validation');
        // $this->form_validation->set_rules(array(
            // array('field' => 'email_method', 'rules' => 'required', 'label' => $this->lang->line('Email method'))
        // ));

        // if ($this->input->post('email_method') == 'smtp') {
            // $this->form_validation->set_rules(array(
                // array('field' => 'smtp_server', 'rules' => 'required', 'label' => $this->lang->line('SMTP server')),
                // array('field' => 'smtp_username', 'rules' => 'required', 'label' => $this->lang->line('SMTP user')),
                // array('field' => 'smtp_password', 'rules' => 'required', 'label' => $this->lang->line('SMTP password'))
            // ));
        // }

        // if ($this->form_validation->run() == FALSE) {
            // exit($this->load->view('layout/error', array('message' => $this->user_actions->get_error()), TRUE));
        // }
		
		$admin_email=$this->input->post('admin_email');
		$company_name=$this->input->post('company_name');
		$company_address=$this->input->post('company_address');
		$company_phone=$this->input->post('company_phone');
		$admin_manager_name=$this->input->post('admin_manager_name');
		$accounting_email=$this->input->post('accounting_email');
		$task_manager_email=$this->input->post('task_manager_email');
		$no_employee=$this->input->post('no_employee');
		$expire_date=$this->input->post('expire_date');
		$admin_email1=explode(";",$admin_email);
		$task_manager_email1=explode(";",$task_manager_email);
		
        $adminemail=implode(",",$admin_email1);
		$taskemail=implode(",",$task_manager_email1);
		
		
        $this->load->model('settings_actions');
        $this->settings_actions->save_settings('email');
        $this->settings_actions->save_settingss($adminemail,$taskemail,$accounting_email,$admin_manager_name,$company_address,$company_name,$company_phone,$no_employee,$expire_date);

        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }

    function positions() {
        $this->load->model('positions_actions');
        $this->load->view('settings/positions', array('positions' => $this->positions_actions->get_positions()));
    }

    function edit_position($position_id = 0) {
        $this->load->model('positions_actions');
        //$this->load->model('departments_actions');


        $this->load->view('settings/position_edit', array(
            'position' => $this->positions_actions->get_position($position_id),
                //'skills'=>$this->positions_actions->get_required_skills($position_id),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }

    function save_position() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'position_id', 'rules' => 'required', 'label' => 'position_id'),
            array('field' => 'position_name', 'rules' => 'required', 'label' => $this->lang->line('Position name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('positions_actions');

        if (!$result = $this->positions_actions->save_position()) {
            exit($this->load->view('layout/error', array('message' => $this->positions_actions->get_error()), TRUE));
        }

        $this->load->view('settings/position_add', array('result' => $result));
    }

    function delete_position() {
        $this->load->model('positions_actions');
        $this->positions_actions->delete_position($this->input->post('position_id'));
        $this->load->view('settings/position_delete', array('position_id' => $this->input->post('position_id')));
    }

    function new_position() {
        $this->load->model('positions_actions');
        $this->load->model('departments_actions');

        $this->load->view('settings/position_new', array(
            'skills' => $this->positions_actions->get_required_skills(0),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }

    function departments() {
        $this->load->model('departments_actions');
        $this->load->view('settings/departments', array('departments' => $this->departments_actions->get_departments()));
    }

    function edit_department($department_id = 0) {
        $this->load->model('departments_actions');
        //$this->load->model('departments_actions');


        $this->load->view('settings/department_edit', array(
            'department' => $this->departments_actions->get_department($department_id),
                //'skills'=>$this->departments_actions->get_required_skills($department_id),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }

    function save_department() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'department_id', 'rules' => 'required', 'label' => 'department_id'),
            array('field' => 'department_name', 'rules' => 'required', 'label' => $this->lang->line('Department name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('departments_actions');

        if (!$result = $this->departments_actions->save_department()) {
            exit($this->load->view('layout/error', array('message' => $this->departments_actions->get_error()), TRUE));
        }

        $this->load->view('settings/department_add', array('result' => $result));
    }

    function delete_department() {
        $this->load->model('departments_actions');
        $this->departments_actions->delete_department($this->input->post('department_id'));
        $this->load->view('settings/department_delete', array('department_id' => $this->input->post('department_id')));
    }

    function new_department() {
        $this->load->model('departments_actions');

        $this->load->view('settings/department_new');
    }

	/*************************Request list controller**********************************/
	   function request() {
        $this->load->model('request_actions');
        $this->load->view('settings/request', array('requests' => $this->request_actions->get_requests()));
    }
	
	 function edit_request($requestlist_id = 0) {
        $this->load->model('request_actions');
        //$this->load->model('departments_actions');


        $this->load->view('settings/request_edit', array(
            'request' => $this->request_actions->get_request($requestlist_id),
                //'skills'=>$this->departments_actions->get_required_skills($department_id),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }

    function save_request() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'request_id', 'rules' => 'required', 'label' => 'request_id'),
            array('field' => 'request_name', 'rules' => 'required', 'label' => $this->lang->line('Request name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('request_actions');

        if (!$result = $this->request_actions->save_request()) {
            exit($this->load->view('layout/error', array('message' => $this->request_actions->get_error()), TRUE));
        }

        $this->load->view('settings/request_add', array('result' => $result));
    }
	
	function new_request() {
        $this->load->model('request_actions');

        $this->load->view('settings/request_new');
    }
	
	
	
    function delete_request() {
        $this->load->model('request_actions');
        $this->request_actions->delete_request($this->input->post('requestlist_id'));
        $this->load->view('settings/request_delete', array('requestlist_id' => $this->input->post('requestlist_id')));
    }
	
	/*************************Request list controller**********************************/
	
    function resign_reasons() {
        $this->load->model('mix_actions');
        $this->load->view('settings/resign_reasons', array('reasons' => $this->mix_actions->get_resign_reasons()));
    }

    function edit_reason($reason_id = 0) {
        $this->load->model('mix_actions');
        $this->load->view('settings/reason_edit', array('reason' => $this->mix_actions->get_reason($reason_id)));
    }

    function save_reason() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'reason_id', 'rules' => 'required', 'label' => 'reason_id'),
            array('field' => 'reason_name', 'rules' => 'required', 'label' => $this->lang->line('Reason name'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('mix_actions');
        $this->load->view('settings/reason_add', array('result' => $this->mix_actions->save_reason()));
    }

    function delete_reason() {
        $this->load->model('mix_actions');
        $this->mix_actions->delete_reason($this->input->post('reason_id'));
        $this->load->view('settings/reason_delete', array('reason_id' => $this->input->post('reason_id')));
    }

    function new_reason() {
        $this->load->view('settings/reason_new');
    }

//      function departments()
//      {
//          $this->load->model('departments_actions');
//          $this->load->view('settings/departments',array('departments'=>$this->departments_actions->get_departments()));
//      }
//      
//      function view_department($department_id=0)
//      {
//          $this->load->model('departments_actions');
//          echo json_encode($this->departments_actions->get_departments($department_id));
//      }
//      
//      function delete_department($department_id=0)
//      {
//          $this->load->model('departments_actions');
//          $this->departments_actions->delete_department($department_id);
//      }
//      
//      function create_department()
//      {
//          if (!$this->input->get('parent_department') OR !$this->input->get('department_name'))
//          {
//              exit();
//          }
//          
//          $this->load->model('departments_actions');
//          header('Content-Type: application/json; charset=utf8');
//          echo json_encode(array('id'=>$this->departments_actions->save_department()));
//      }
//      
//      function rename_department()
//      {
//          if (!$this->input->get('department_id') OR !$this->input->get('department_name'))
//          {
//              exit();
//          }
//          
//          $this->load->model('departments_actions');
//          header('Content-Type: application/json; charset=utf8');
//          echo json_encode(array('id'=>$this->departments_actions->save_department()));
//      }
//      
//      function move_department()
//      {
//          if (!$this->input->get('department_id') OR !$this->input->get('new_parent'))
//          {
//              exit();
//          }
//          $this->load->model('departments_actions');
//          $this->departments_actions->move_department();
//          
//          header('Content-Type: application/json; charset=utf8');
//          echo json_encode(array('message'=>$this->lang->line('Done')));
//      }

    function bir_forms() {
        $this->load->model('settings_actions');
        $this->load->view('settings/bir_forms', array('bir_forms' => $this->settings_actions->get_bir_forms()));
    }
/////*****************************bir_formsb///////////////////
function bir_formsb() {
        $this->load->model('settings_actions');
        $this->load->view('settings/bir_formsb', array('bir_forms' => $this->settings_actions->get_bir_formsb()));
    }
	
	function edit_bir_formb($form_id = 0) {
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('settings_actions');
        $bir_form = $this->settings_actions->get_bir_formb($form_id);
        //_custom_debug($bir_form);
        $this->load->view('settings/bir_form_editb', array(
            'bir_form' => $bir_form,
            'attachments' => $this->attachments_actions->get_attachments($form_id, 'bir_form')
        ));
    }
	
	 function save_bir_formb() {
		 
		
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => 'form_id'),
            array('field' => 'form_name', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
            array('field' => 'due_date', 'rules' => 'required', 'label' => $this->lang->line('Due Date'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('settings_actions');
        if (!$result = $this->settings_actions->save_bir_formb()) {
            exit($this->load->view('layout/error', array('message' => $this->settings_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('settings/bir_form_addb', $result);
    }
	function new_bir_formb() {
        $this->load->view('settings/bir_form_newb');
    }

	 function delete_bir_formb() {
        $this->load->model('settings_actions');
        $this->settings_actions->delete_bir_formb($this->input->post('form_id'));
        $this->load->view('settings/bir_form_deleteb', array('form_id' => $this->input->post('form_id')));
    }

	
	/////*****************************bir_formsb  end ///////////////////
	
	
	
    function new_bir_form() {
		
        $this->load->view('settings/bir_form_new');
    }

    function edit_bir_form($form_id = 0) {
        $this->load->model('attachments_actions');
        $this->load->helper('fa-extension');
        $this->load->model('settings_actions');
        $bir_form = $this->settings_actions->get_bir_form($form_id);
        //_custom_debug($bir_form);
        $this->load->view('settings/bir_form_edit', array(
            'bir_form' => $bir_form,
            'attachments' => $this->attachments_actions->get_attachments($form_id, 'bir_form')
        ));
    }

    function save_bir_form() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => 'form_id'),
            array('field' => 'form_name', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
            array('field' => 'due_date', 'rules' => 'required', 'label' => $this->lang->line('Due Date'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('settings_actions');
        if (!$result = $this->settings_actions->save_bir_form()) {
            exit($this->load->view('layout/error', array('message' => $this->settings_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('settings/bir_form_add', $result);
    }

    function delete_bir_form() {
        $this->load->model('settings_actions');
        $this->settings_actions->delete_bir_formg($this->input->post('form_id'));
        $this->load->view('settings/bir_form_delete', array('form_id' => $this->input->post('form_id')));
    }

    function task_status() {
        $this->load->model('task_actions');
        $this->load->view('tasks/task_status', array('task_status_list' => $this->task_actions->get_task_status_list()));
    }

    function new_task_status() {
        $this->load->view('tasks/task_status_new');
    }

    function edit_task_status($task_status_id = 0) {
        $this->load->model('task_actions');
        //$this->load->model('departments_actions');


        $this->load->view('tasks/task_status_edit', array(
            'task_status' => $this->task_actions->get_task_status($task_status_id),
        ));
    }

    function save_task_status() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'task_status_id', 'rules' => 'required', 'label' => 'task_status_id'),
            array('field' => 'task_status_name', 'rules' => 'required', 'label' => $this->lang->line('Task status name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('task_actions');

        if (!$result = $this->task_actions->save_task_status()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }

        $this->load->view('tasks/task_status_add', array('result' => $result));
    }

    function delete_task_status() {
        $this->load->model('task_actions');
        $this->task_actions->delete_task_status($this->input->post('task_status_id'));
        $this->load->view('tasks/task_status_delete', array('task_status_id' => $this->input->post('task_status_id')));
    }

    function task_type() {
        $this->load->model('task_actions');
        $this->load->view('tasks/task_type', array('task_type_list' => $this->task_actions->get_task_type_list()));
    }
	function new_task_type() {
        $this->load->view('tasks/task_type_new');
    }
	
	function save_task_type() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'id', 'rules' => 'required', 'label' => 'id'),
            array('field' => 'task_code', 'rules' => 'required', 'label' => $this->lang->line('Task Code')),
			array('field'=>'task_type','rules'=>'required','label'=>$this->lang->line('Task Type'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('task_actions');

        if (!$result = $this->task_actions->save_task_type()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
		exit;
       //$this->load->view('tasks/task_type', array('result' => $result));
    }
	
	function edit_task_type($id = 0) {
        $this->load->model('task_actions');
        $this->load->view('tasks/task_type_edit', array(
            'task_type' => $this->task_actions->get_task_type($id),
        ));
    }
	
	function delete_task_type() {
        $this->load->model('task_actions');
        $this->task_actions->delete_task_type($this->input->post('id'));
		exit;
        //$this->load->view('tasks/task_category_delete', array('task_category_id' => $this->input->post('task_category_id')));
    }
	
	function task_category() {
        $this->load->model('task_actions');
        $this->load->view('tasks/task_category', array('task_category_list' => $this->task_actions->get_task_category_list()));
    }

    function new_task_category() {
        $this->load->view('tasks/task_category_new');
    }

    function edit_task_category($task_category_id = 0) {
        $this->load->model('task_actions');
        //$this->load->model('departments_actions');


        $this->load->view('tasks/task_category_edit', array(
            'task_category' => $this->task_actions->get_task_category($task_category_id),
        ));
    }

    function save_task_category() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'task_category_id', 'rules' => 'required', 'label' => 'task_category_id'),
            array('field' => 'task_category_name', 'rules' => 'required', 'label' => $this->lang->line('Task category name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('task_actions');

        if (!$result = $this->task_actions->save_task_category()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }

        $this->load->view('tasks/task_category_add', array('result' => $result));
    }

    function delete_task_category() {
        $this->load->model('task_actions');
        $this->task_actions->delete_task_category($this->input->post('task_category_id'));
        $this->load->view('tasks/task_category_delete', array('task_category_id' => $this->input->post('task_category_id')));
    }

    function petty_items() {
        $this->load->model('petty_actions');
        $this->load->view('petty/petty_item', array('petty_items' => $this->petty_actions->get_petty_items()));
    }

    function new_petty_item() {
        $this->load->view('petty/petty_item_new');
    }

    function edit_petty_item($petty_item_id = 0) {
        $this->load->model('petty_actions');
        //$this->load->model('departments_actions');


        $this->load->view('petty/petty_item_edit', array(
            'petty_item' => $this->petty_actions->get_petty_item($petty_item_id),
        ));
    }

    function save_petty_item() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'petty_item_id', 'rules' => 'required', 'label' => 'petty_item_id'),
            array('field' => 'petty_item_name', 'rules' => 'required', 'label' => $this->lang->line('Petty Cash Item Name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('petty_actions');

        if (!$result = $this->petty_actions->save_petty_item()) {
            exit($this->load->view('layout/error', array('message' => $this->petty_actions->get_error()), TRUE));
        }

        $this->load->view('petty/petty_item_add', array('result' => $result));
    }

    function delete_petty_item() {
        $this->load->model('petty_actions');
        $this->petty_actions->delete_petty_item($this->input->post('petty_item_id'));
        $this->load->view('petty/petty_item_delete', array('petty_item_id' => $this->input->post('petty_item_id')));
    }

    function document_categorys() {
        $this->load->model('documents_actions');
        $this->load->view('documents/document_category', array('document_categorys' => $this->documents_actions->get_document_categorys()));
    }

    function new_document_category() {
        $this->load->view('documents/document_category_new');
    }

    function edit_document_category($document_category_id = 0) {
        $this->load->model('documents_actions');
        //$this->load->model('departments_actions');


        $this->load->view('documents/document_category_edit', array(
            'document_category' => $this->documents_actions->get_document_category($document_category_id),
        ));
    }

    function save_document_category() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'document_category_id', 'rules' => 'required', 'label' => 'document_category_id'),
            array('field' => 'document_category_name', 'rules' => 'required', 'label' => $this->lang->line('Petty Cash Item Name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('documents_actions');

        if (!$result = $this->documents_actions->save_document_category()) {
            exit($this->load->view('layout/error', array('message' => $this->documents_actions->get_error()), TRUE));
        }

        $this->load->view('documents/document_category_add', array('result' => $result));
    }

    function delete_document_category() {
        $this->load->model('documents_actions');
        $this->documents_actions->delete_document_category($this->input->post('document_category_id'));
        $this->load->view('documents/document_category_delete', array('document_category_id' => $this->input->post('document_category_id')));
    }

    function schedule_items() {
        $this->load->model('schedule_actions');
        $this->load->view('schedule/schedule_item', array('schedule_items' => $this->schedule_actions->get_schedule_items()));
    }

    function new_schedule_item() {
        $this->load->view('schedule/schedule_item_new');
    }

    function edit_schedule_item($schedule_item_id = 0) {
        $this->load->model('schedule_actions');
        //$this->load->model('departments_actions');


        $this->load->view('schedule/schedule_item_edit', array(
            'schedule_item' => $this->schedule_actions->get_schedule_item($schedule_item_id),
        ));
    }

    function save_schedule_item() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'schedule_item_id', 'rules' => 'required', 'label' => 'schedule_item_id'),
            array('field' => 'schedule_item_name', 'rules' => 'required', 'label' => $this->lang->line('Petty Cash Item Name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('schedule_actions');

        if (!$result = $this->schedule_actions->save_schedule_item()) {
            exit($this->load->view('layout/error', array('message' => $this->schedule_actions->get_error()), TRUE));
        }

        $this->load->view('schedule/schedule_item_add', array('result' => $result));
    }

    function delete_schedule_item() {
        $this->load->model('schedule_actions');
        $this->schedule_actions->delete_schedule_item($this->input->post('schedule_item_id'));
        $this->load->view('schedule/schedule_item_delete', array('schedule_item_id' => $this->input->post('schedule_item_id')));
    }

    function customer_items() {
        $this->load->model('schedule_actions');
        $this->load->view('schedule/customer_item', array('customer_items' => $this->schedule_actions->get_customer_items()));
    }

    function new_customer_item() {
        $this->load->view('schedule/customer_item_new');
    }

    function edit_customer_item($customer_item_id = 0) {
        $this->load->model('schedule_actions');
        //$this->load->model('departments_actions');


        $this->load->view('schedule/customer_item_edit', array(
            'customer_item' => $this->schedule_actions->get_customer_item($customer_item_id),
        ));
    }

    function save_customer_item() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'customer_item_id', 'rules' => 'required', 'label' => 'customer_item_id'),
            array('field' => 'customer_item_name', 'rules' => 'required', 'label' => $this->lang->line('Petty Cash Item Name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('schedule_actions');

        if (!$result = $this->schedule_actions->save_customer_item()) {
            exit($this->load->view('layout/error', array('message' => $this->schedule_actions->get_error()), TRUE));
        }

        $this->load->view('schedule/customer_item_add', array('result' => $result));
    }

    function delete_customer_item() {
        $this->load->model('schedule_actions');
        $this->schedule_actions->delete_customer_item($this->input->post('customer_item_id'));
        $this->load->view('schedule/customer_item_delete', array('customer_item_id' => $this->input->post('customer_item_id')));
    }

    //Reasons

    function letters() {
        $this->load->model('letter_actions');
        $this->load->view('letter/setting_letters', array('letters' => $this->letter_actions->get_setting_letters()));
    }

    function new_letter() {
        $this->load->view('letter/setting_letter_new');
    }

    function get_letter() {
        $setting_letter_id = $this->input->post('setting_letter_id');
        $this->load->model('letter_actions');
        $data = array('setting_letter' => $this->letter_actions->get_setting_letter($setting_letter_id));
        die(json_encode($data));
    }

    function edit_letter($setting_letter_id = 0) {
        $this->load->model('letter_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
        $this->load->view('letter/setting_letter_edit', array(
            'setting_letter' => $this->letter_actions->get_letter_template($setting_letter_id),
            'attachments' => $this->attachments_actions->get_attachments($setting_letter_id, 'letter_setting'),
        ));
    }

    function save_letter() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'setting_letter_id', 'rules' => 'required', 'label' => 'setting_letter_id'),
            array('field' => 'setting_letter_name', 'rules' => 'required', 'label' => $this->lang->line('setting_letter_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('letter_actions');
        //$this->load->view('letter/setting_letter_add', array('result' => $this->letter_actions->save_setting_letter()));
        if (!$result = $this->letter_actions->save_setting_letter()) {
            exit($this->load->view('layout/error', array('message' => $this->letter_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('letter/setting_letter_add', $result);
    }

    function delete_letter() {
        $this->load->model('letter_actions');
        $this->letter_actions->delete_setting_letter($this->input->post('setting_letter_id'));
        $this->load->view('letter/setting_letter_delete', array('setting_letter_id' => $this->input->post('setting_letter_id')));
    }
	// Group List controller
	function grouplist() {
        $this->load->model('grouplist_actions');
        $this->load->view('settings/grouplist', array('grouplist' => $this->grouplist_actions->get_grouplist()));
    }
	function new_group() {
        $this->load->model('grouplist_actions');

        $this->load->view('settings/group_new');
    }
	 function save_group() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'department_id', 'rules' => 'required', 'label' => 'group_id'),
            array('field' => 'department_name', 'rules' => 'required', 'label' => $this->lang->line('Group name')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('grouplist_actions');

        if (!$result = $this->grouplist_actions->save_group()) {
            exit($this->load->view('layout/error', array('message' => $this->grouplist_actions->get_error()), TRUE));
        }

        $this->load->view('settings/group_add', array('result' => $result));
    }
	 function edit_group($department_id = 0) {
        $this->load->model('grouplist_actions');
        //$this->load->model('departments_actions');


        $this->load->view('settings/group_edit', array(
            'department' => $this->grouplist_actions->get_group($department_id),
                //'skills'=>$this->departments_actions->get_required_skills($department_id),
                //'departments'=>$this->departments_actions->get_departments_list()
        ));
    }
	function delete_group() {
        $this->load->model('grouplist_actions');
        $this->grouplist_actions->delete_group($this->input->post('department_id'));
        $this->load->view('settings/group_delete', array('department_id' => $this->input->post('department_id')));
    }

	
	

}

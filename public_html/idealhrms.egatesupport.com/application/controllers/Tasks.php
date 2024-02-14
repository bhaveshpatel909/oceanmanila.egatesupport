<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_task $db
 * @property CI_Session          $session
 * @property task_actions          $task_actions
 */
class Tasks extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('task_actions');
        $this->load->model('user_actions');
		$this->load->model('settings_actions');
		$this->load->model('employees_actions');
		$this->load->model('timeoff_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index($status = null,$catte = null) {
		$this->load->model('workmanual_actions');
		$this->load->model('timeoff_actions');
		$this->load->model('employees_actions');
        $active_menu = isset($status) ? $status . '_tasks' : 'all_tasks';
        $is_selfservice = FALSE;
        $employee_id = null;
        if (!$this->user_actions->is_allowed('tasks')) {
			//echo "xdcgvfzd";
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			$emppdata=$this->timeoff_actions->get_employee_deta();
            $empdataaa = $this->employees_actions->search_employee();
			$category = $this->employees_actions->search_category();
			$settingss =$this->settings_actions->get_settings('company');
			$deparment=	$this->workmanual_actions->get_workmanual_department();
			$tasktype = $this->task_actions->get_task_type_list();
			$task_log = $this->task_actions->task_log();
			
			//echo'<pre>'; print_r($task_log);
			
		// die;
			$alltask = $this->task_actions->get_selftasks($status,$employee_id,$catte);
		     // echo "<pre>";
			 //print_r($alltask);die;
			
			foreach($alltask as $allts){
				$empl = explode(" ",$allts['notify']);
				$ccc = 0;
				foreach($empl as $emp){
					$employe = $this->employees_actions->get_employee($emp);
					$empname[$allts['task_id']][$ccc] = $employe['name'];
					$ccc++;
				}
			}
            $this->load->view('tasks/index', array('tasks' =>$alltask, 'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => $status, 'category' => $category,  'settingss' => $settingss, 'tasktype' => $tasktype, 'catte' => $catte,'deparment'=> $deparment,'empdataaa'=> $empdataaa,'empname' => $empname,'task_log' =>$task_log, 'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        } else {
			//echo "here";
            $employee_id = $this->input->get('employee_id');
			$empdataaa = $this->employees_actions->search_employee();
            $employee = $this->employees_actions->get_employee($employee_id);
			$emppdata=$this->timeoff_actions->get_employee_deta();
            $category = $this->employees_actions->search_category();
			$settingss =$this->settings_actions->get_settings('company');
			$deparment=	$this->workmanual_actions->get_workmanual_department();
			$tasktype = $this->task_actions->get_task_type_list();
			$alltask = $this->task_actions->get_tasks($status,$employee_id,$catte);
			$task_log = $this->task_actions->task_log();
			//$alltask = $this->task_actions->get_emptasks($status,$employee_id,$catte);
			// echo "<pre>";
			// print_R($alltask);
			

		 
			foreach($alltask as $allts){
				$empl = explode(" ",$allts['notify']);
				$ccc = 0;
				foreach($empl as $emp){
					$employe = $this->employees_actions->get_employee($emp);
					$empname[$allts['task_id']][$ccc] = $employe['name'];
					$ccc++;
				}
			}
			$tasksss=$this->task_actions->get_tasks($status,$employee_id,$catte);
			//echo'<pre>';print_r($tasksss);echo'</pre>';die('djkfjdbvgjfbgv');
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_tasks($status,$employee_id,$catte), 'active_menu' => $active_menu, 'employee' => $employee,'is_selfservice' => $is_selfservice, 'type' => $status, 'category' => $category,'settingss' => $settingss, 'tasktype' => $tasktype, 'empname' => $empname,'task_log' =>$task_log, 'catte' => $catte,'deparment'=> $deparment,'empdataaa'=> $empdataaa ,'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        }
    }
  ///////////////////////****************for pending task use *********************////////
 function pending_task($status = null,$catte = null) {
		$this->load->model('workmanual_actions');
		$this->load->model('timeoff_actions');
		$this->load->model('employees_actions');
        $active_menu = isset($status) ? $status . '_tasks' : 'all_tasks';
        $is_selfservice = FALSE;
        $employee_id = null;
        if (!$this->user_actions->is_allowed('tasks')) {
			//echo "xdcgvfzd";
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			$emppdata=$this->timeoff_actions->get_employee_deta();
            $empdataaa = $this->employees_actions->search_employee();
			$category = $this->employees_actions->search_category();
			$settingss =$this->settings_actions->get_settings('company');
			$deparment=	$this->workmanual_actions->get_workmanual_department();
			$tasktype = $this->task_actions->get_task_type_list();
			$task_log = $this->task_actions->task_log();
			
			//echo'<pre>'; print_r($task_log);
			
		// die;
			$alltask = $this->task_actions->get_selftasks($status,$employee_id,$catte);
		     // echo "<pre>";
			 //print_r($alltask);die;
			
			foreach($alltask as $allts){
				$empl = explode(" ",$allts['notify']);
				$ccc = 0;
				foreach($empl as $emp){
					$employe = $this->employees_actions->get_employee($emp);
					$empname[$allts['task_id']][$ccc] = $employe['name'];
					$ccc++;
				}
			}
            $this->load->view('tasks/index', array('tasks' =>$alltask, 'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => $status, 'category' => $category,  'settingss' => $settingss, 'tasktype' => $tasktype, 'catte' => $catte,'deparment'=> $deparment,'empdataaa'=> $empdataaa,'empname' => $empname,'task_log' =>$task_log, 'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        } else {
			//echo "here";
            $employee_id = $this->input->get('employee_id');
			$empdataaa = $this->employees_actions->search_employee();
            $employee = $this->employees_actions->get_employee($employee_id);
			$emppdata=$this->timeoff_actions->get_employee_deta();
            $category = $this->employees_actions->search_category();
			$settingss =$this->settings_actions->get_settings('company');
			$deparment=	$this->workmanual_actions->get_workmanual_department();
			$tasktype = $this->task_actions->get_task_type_list();
			$alltask = $this->task_actions->get_tasks($status,$employee_id,$catte);
			$task_log = $this->task_actions->task_log();
			//$alltask = $this->task_actions->get_emptasks($status,$employee_id,$catte);
			// echo "<pre>";
			// print_R($alltask);
			

		 
			foreach($alltask as $allts){
				$empl = explode(" ",$allts['notify']);
				$ccc = 0;
				foreach($empl as $emp){
					$employe = $this->employees_actions->get_employee($emp);
					$empname[$allts['task_id']][$ccc] = $employe['name'];
					$ccc++;
				}
			}
			
            $this->load->view('tasks/pendingtask', array('tasks' => $this->task_actions->get_tasks($status,$employee_id,$catte), 'active_menu' => $active_menu, 'employee' => $employee,'is_selfservice' => $is_selfservice, 'type' => $status, 'category' => $category,'settingss' => $settingss, 'tasktype' => $tasktype, 'empname' => $empname,'task_log' =>$task_log, 'catte' => $catte,'deparment'=> $deparment,'empdataaa'=> $empdataaa ,'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        }
    }



  
	function selftask($status = null,$catte = null) {
		
		$this->load->model('drequest_actions');
		$this->load->model('workmanual_actions');
	$deparment=	$this->workmanual_actions->get_workmanual_department();
	 $this->load->model('timeoff_actions');
	 $emppdata=$this->timeoff_actions->get_employee_deta();
	 $deparmentw =	$this->workmanual_actions->get_workmanual_department();
	$deptt = $this->timeoff_actions->get_departmentname($emppdata[0]['department_id']);
	$empdataaa = $this->employees_actions->search_employee();
	
    	$request=	$this->drequest_actions->get_request_request();
	 // echo "<pre>";
	 // print_r($deptt);
        $active_menu = 'selftask';
        $is_selfservice = FALSE;
       // $employee_id = null;
            $did= $deptt[0]['department_name'];
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			$category = $this->employees_actions->search_category();
			$tasktype = $this->task_actions->get_task_type_list();
            $task_log = $this->task_actions->task_log();
		
		    $all_tasks = $this->task_actions->get_selftasks($status,$employee_id,$catte,$did);
           for($i = 0; $i < count($all_tasks); $i++) {
               $output = preg_replace('!\s+!', ' ', $all_tasks[$i]['notify']);
               $notifi_emp = explode(" ",$output);
               $temp_notify_names = array();
               foreach ($notifi_emp as $emp_id) {
                   $employee_details = $this->employees_actions->get_employee($emp_id);
                   $temp_notify_names[] = $employee_details['name'];
               }
				
               //print_r($temp_notify_names);die;
               $all_tasks[$i]['notified_names'] = implode("<br>",$temp_notify_names);
           }
            //print_r($all_tasks);die;
				
            $this->load->view('selftask/index', array('tasks' => $all_tasks,
			
					
													  
													  
			'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => $status,
			'category' => $category, 
			'tasktype' => $tasktype,
			'empdataaa'=> $empdataaa ,
			'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id']),
            'deparment'=> $deparment,
			 'workmnaualdata' => $this->timeoff_actions->get_workmanualbydepartment($emppdata[0]['department_id']),	
			'deparmentw'=> $deparmentw,  
			'requestemp' => $this->drequest_actions->get_request(),
			'requestt'=> $request,
			'task_log' =>$task_log,
			 'timeoff' => $this->timeoff_actions->get_employee_records(),
			 'emppdata' => $this->timeoff_actions->get_employee_deta(),
			'catte' => $catte));
       
    }
	
	
    function attention_tasks() {
        $is_selfservice = FALSE;
        $active_menu = 'attention_tasks';
        $employee_id = null;
        if ($this->user_actions->is_selfservice()) {
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			 $emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_attention_tasks($employee_id), 'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => 'attention','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        } else {
            $employee_id = $this->input->get('employee_id');
			 $emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->model('employees_actions');
            $employee = $this->employees_actions->get_employee($employee_id);
			$emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_attention_tasks($employee_id), 'active_menu' => $active_menu, 'employee' => $employee,'is_selfservice' => $is_selfservice, 'type' => 'attention','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        }
    }
    
    function attention_updated_tasks() {
        $is_selfservice = FALSE;
        $active_menu = 'attention_updated_tasks';
        $employee_id = null;
        if ($this->user_actions->is_selfservice()) {
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			 $emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_attention_updated_tasks($employee_id), 'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => 'attention_update','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        } else {
            $employee_id = $this->input->get('employee_id');
            $this->load->model('employees_actions');
            $employee = $this->employees_actions->get_employee($employee_id);
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_attention_updated_tasks($employee_id), 'active_menu' => $active_menu, 'employee' => $employee,'is_selfservice' => $is_selfservice, 'type' => 'attention_update','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        }
    }
    
    function completed_tasks() {
        $is_selfservice = FALSE;
        $active_menu = 'completed_tasks';
        $employee_id = null;
        if ($this->user_actions->is_selfservice()) {
            $is_selfservice = TRUE;
            $employee_id = $this->session->current->userdata('employee_id');
			 $emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_completed_tasks($employee_id), 'active_menu' => $active_menu,'is_selfservice' => $is_selfservice, 'type' => 'completed','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        } else {
            $employee_id = $this->input->get('employee_id');
			 $emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->model('employees_actions');
            $employee = $this->employees_actions->get_employee($employee_id);
            $this->load->view('tasks/index', array('tasks' => $this->task_actions->get_completed_tasks($employee_id), 'active_menu' => $active_menu, 'employee' => $employee,'is_selfservice' => $is_selfservice, 'type' => 'completed','depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id'])));
        }
    }

    function new_task() {
        $this->load->model('workmanual_actions');
	$deparment=	$this->workmanual_actions->get_workmanual_department();
        $task_categories = $this->task_actions->get_task_category_list();
        $userdata = $this->session->userdata();
//        _custom_debug($userdata);
        $this->load->view('tasks/task_new', array(
		'task_categories' => $task_categories,
		'deparment'=> $deparment,
		'employee' => array('name'=>$userdata['full_name'], 'id' => $userdata['employee_id'])));
    }

    function edit_task($task_id = 0) {
        $this->load->helper('fa-extension');
         $this->load->model('workmanual_actions');
	$deparment=	$this->workmanual_actions->get_workmanual_department();
        $this->load->model('attachments_actions');
        $task_categories = $this->task_actions->get_task_category_list();
        $this->load->view('tasks/task_edit', array(
            'task' => $this->task_actions->get_task($task_id),
            'task_categories' => $task_categories,
			'deparment'=> $deparment,
            'attachments' => $this->attachments_actions->get_attachments($task_id, 'task')
        ));
    }

    function save_task() {
        $this->load->helper('fa-extension');
        $this->load->library('form_validation');
		//echo'<pre>';print_r($_POST);
        $this->form_validation->set_rules(array(
            array('field' => 'task_id', 'rules' => 'required', 'label' => 'task_id'),
            //array('field' => 'employee_id[]', 'rules' => 'required', 'label' => 'employee_id'),
            //array('field' => 'task_category_id', 'rules' => 'required', 'label' => $this->lang->line('Task Category')),
            array('field' => 'task_title', 'rules' => 'required', 'label' => $this->lang->line('Title')),
                //array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        
        if (!$result = $this->task_actions->save_task()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }

        $this->load->view('tasks/task_add', $result);
    }

//    function delete_task($task_id = 0) {
//        
//        $this->task_actions->delete_task($task_id);
//        $this->load->view('layout/success', array('message' => $this->lang->line('Deleted')));
//        //$this->load->view('layout/redirect', array('url' => $this->config->item('base_url') . 'discipline'));
//    }

    function delete_task() {
        
        $this->task_actions->delete_task($this->input->post('task_id'));
        $this->load->view('tasks/task_delete', array('task_id' => $this->input->post('task_id')));
    }

    function preview_task($task_id = 0) {
        
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $task = $this->task_actions->task_preview($task_id);
        //PDF generating
        $html = $this->load->view('tasks/task_preview', array('task' => $task, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $task['fullname']) . "_task.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }
	
	function find_taskcode() {
		
        echo json_encode($this->task_actions->get_task_type_list());
    }
    
    function comment_task($task_id = 0) {
        $this->load->helper('fa-extension');
        
        $this->load->model('attachments_actions');
		$neess = $this->task_actions->get_task($task_id);
		// echo"<pre>";
		// print_r($neess);
		// echo"</pre>";
		$nootfy = array();
		if ($neess['notify']) {
			$ttask = $neess['notify'];		
			$ttasskk = explode(" ",$ttask);
			foreach($ttasskk as $ttaskk){
	
			$this->load->model('employees_actions');
			$result = $this->employees_actions->get_employee($ttaskk);
			$nootfy[] = $result['name'];
			}
		}
        $this->load->view('tasks/task_comment', array(
            'task' => $this->task_actions->get_task($task_id),
            'task_comments' => $this->task_actions->get_task_comments($task_id),
            'attachments' => $this->attachments_actions->get_attachments($task_id, 'task'),
			'notifyy' => $nootfy
        ));
    }
    
    function edit_comment($task_comment_id = 0) {
        $this->load->view('tasks/task_comment_edit', array(
            'task_comment' => $this->task_actions->get_task_comment($task_comment_id),
        ));
    }
    
    function save_task_comment() {
        $this->load->helper('fa-extension');
        $this->load->library('form_validation');
        
        
        $this->form_validation->set_rules(array(
            array('field' => 'task_id', 'rules' => 'required', 'label' => 'task_id'),
            array('field' => 'comment', 'rules' => 'required', 'label' => $this->lang->line('Comment')),
                //array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        $code = trim($this->input->post('comment'));
        //_custom_debug($this->input->post());
        if ($code == '' || $code == '<p><br></p>') {
            exit($this->load->view('layout/error', array('message' => 'Please enter comment'), TRUE));
        }

        
        if (!$result = $this->task_actions->save_task_comment()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
        

        die($this->load->view('tasks/task_comment_add', array('task_comment' => $result), TRUE));
    }
    
    function save_edit_comment() {
        $this->load->library('form_validation');
        
        
        $this->form_validation->set_rules(array(
            array('field' => 'task_comment_id', 'rules' => 'required', 'label' => 'task_comment_id'),
            array('field' => 'comment', 'rules' => 'required', 'label' => $this->lang->line('Comment')),
        ));
        $code = trim($this->input->post('comment'));
        //_custom_debug($this->input->post());
        if ($code == '' || $code == '<p><br></p>') {
            exit($this->load->view('layout/error', array('message' => 'Please enter comment'), TRUE));
        }
        if (!$result = $this->task_actions->save_task_comment()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
        
        die(json_encode($result));
    }
    
    function delete_comment() {
        
        $this->task_actions->delete_comment($this->input->post('task_comment_id'));
        $this->load->view('tasks/task_comment_delete', array('task_comment_id' => $this->input->post('task_comment_id')));
    }
    
    function update_task_process() {
        
        if (!$result = $this->task_actions->update_task_process()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
    }
    
    function re_assign() { 
        $task_ids = json_decode($this->input->post('task_ids'));
     //_custom_debug($task_ids);
       $this->load->view('tasks/task_reassign', array('task_ids' => json_encode($task_ids)));
   }
	
	function assigncode() { 
        $task_idss = json_decode($this->input->post('task_idss'));
       $taskcood = $this->task_actions->get_task_type_list();
        $this->load->view('tasks/task_assigncode', array('task_idss' => json_encode($task_idss),'taskcood' => $taskcood));
    }
    
    function save_assignment() {
		//echo'<pre>';print_r($_POST);
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'task_ids', 'rules' => 'required', 'label' => 'task_ids'),
            array('field' => 'employee_id', 'rules' => 'required', 'label' => $this->lang->line('Employee')),
//                array('field'=>'department_id','rules'=>'required','label'=>$this->lang->line('Department'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        

        if (!$result = $this->task_actions->save_assignment()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }

        $this->load->view('tasks/task_reassign_save', array('result' => $result));
    }
    
	function save_codeassignment() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'task_ids', 'rules' => 'required', 'label' => 'task_ids'),
            array('field' => 'taskcod', 'rules' => 'required', 'label' => $this->lang->line('taskcod')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        

        if (!$result = $this->task_actions->save_codeassignment()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
        redirect('/tasks/index/', 'refresh');
    }
	
    function update_task_attention() {
        if (!$result = $this->task_actions->update_task_attention()) {
            exit($this->load->view('layout/error', array('message' => $this->task_actions->get_error()), TRUE));
        }
    }
    
    function print_employee_tasks($employee_id, $type) {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $tasks = $this->task_actions->get_employee_tasks($employee_id, $type);
        //PDF generating
        $html = $this->load->view('tasks/tasks_print', array('tasks' => $tasks, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); 
        $pdfFilePath = str_replace(" ", "_", $tasks[0]['task_responsible']) . "_task.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
    //////////////////mail_function start/////////////////
	

function mail_task() {
 
	 $this->load->model('settings_actions');
	$tasks_id = $_GET['id'];
	//$emp_id = $_GET['emp'];
	$employee_ids = explode(" ",$_GET['noti']);
	//print_r($ids);die;
	
	// echo '<pre>';
	// print_r($tasks_id);
	// echo '</pre>';
		
		foreach($ids as $value) {

             $id = $value . "<br>";

			}
	
	foreach($employee_ids as $emp_id){		
        $this->load->model('workmanual_actions');
        $this->load->helper('fa-extension');
        
		$alltasks=	$this->task_actions->get_task($tasks_id);
	     $rg =$this->workmanual_actions->allemp_documentt($emp_id);
       $details = $this->settings_actions->get_settings('company');
	  // echo"<pre>";
	 $company_mail= $details['company_email'];
	 $email=explode(",",$company_mail);
	 // print_R($email[0]);
	 // die();
	 //$len=count($email);
	 
	 // for($i=0;$i<$len;$i++)
	  //{
		$from=$email[0];
		 
	   
		 $des = $alltasks['task_title'];
		 $con = $alltasks['description'];
	
	  
	  $this->load->library('email'); 
	  $this->email->clear(TRUE);
	  $this->email->set_mailtype("html");
      $this->email->from($from);
      $userem =($rg[0]['email']);		 
   
      $this->email->to($userem);
      $ggmessage ='<br>'.$con;
      $this->email->subject($des); 
      $this->email->message($ggmessage);
	 
	  $this->email->send();
	  }
//}
	
    
      $successme ="Mail Sent Successfully";
	 //$this->load->view('tasks/index');
	
    echo "<script>alert('Mail Sent Successfully!'); location.href='http://uplushrms.peza.com.ph/tasks/index/all';</script>";
}
///////////////////****************************************for pending task/////////////

function pending_mailt() {
 
	 $this->load->model('settings_actions');
	$tasks_id = $_GET['id'];
	//$emp_id = $_GET['emp'];
	$employee_ids = explode(" ",$_GET['noti']);
	//print_r($ids);die;
	
	// echo '<pre>';
	// print_r($tasks_id);
	// echo '</pre>';
		
		foreach($ids as $value) {

             $id = $value . "<br>";

			}
	
	foreach($employee_ids as $emp_id){		
        $this->load->model('workmanual_actions');
        $this->load->helper('fa-extension');
        
		$alltasks=	$this->task_actions->get_task($tasks_id);
	     $rg =$this->workmanual_actions->allemp_documentt($emp_id);
       $details = $this->settings_actions->get_settings('company');
	  // echo"<pre>";
	 $company_mail  = $details['company_email'];

	   	 $email=explode(",",$company_mail);
	 // print_R($email[0]);
	 // die();
	 //$len=count($email);
	 
	 // for($i=0;$i<$len;$i++)
	  //{
		$fromdd=$email[0];
		 
	   
		 $des = $alltasks['task_title'];
		 $con = strip_tags($alltasks['description']);

		$arr=array();
		
	
	  $from =$fromdd;
	  $this->load->library('email'); 
	  $this->email->clear(TRUE);
	  $this->email->set_mailtype("html");
      $this->email->from($from);
      $userem =($rg[0]['email']);		 
   
      $this->email->to($userem);
      $ggmessage ='<br>'.$con;
      $this->email->subject($des); 
      $this->email->message($ggmessage);
	 
	  $this->email->send();
	}
	
    
      $successme ="Mail Sent Successfully";
	 //$this->load->view('tasks/index');
	
    echo "<script>alert('Mail Sent Successfully!'); location.href='http://uplushrms.peza.com.ph/tasks/pending_task';</script>";
}



}
    //////////////////mail_function End ////////////////
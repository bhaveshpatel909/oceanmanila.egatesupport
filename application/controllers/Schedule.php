<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_schedule $db
 * @property CI_Session          $session
 * @property schedule_actions          $schedule_actions
 */
class Schedule extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->load->model('schedule_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index($employee_id = null, $schedule_item_id = null) {
        $this->load->model('employees_actions');
        $employee = null;
        $schedule_item = null;
        if (!is_null($employee_id)) {
            $employee = $this->employees_actions->get_employee($employee_id);
        }
        if (!is_null($schedule_item_id)) {
            $schedule_item = $this->schedule_actions->get_schedule_item($schedule_item_id);
        }
        $this->load->view('schedule/index', array('employee_id' => $employee_id, 'employee' => $employee, 'schedule_item_id' => $schedule_item_id,'schedule_item' => $schedule_item));
    }

	
	/************************Bir calendar start ******************************/
	 function bir_calendar($employee_id = null, $schedule_item_id = null) {
        $this->load->model('employees_actions');
        $employee = null;
        $schedule_item = null;
        if (!is_null($employee_id)) {
            $employee = $this->employees_actions->get_employee($employee_id);
        }
        if (!is_null($schedule_item_id)) {
            $schedule_item = $this->schedule_actions->get_schedule_item($schedule_item_id);
        }
        $this->load->view('schedule/bir_calendar', array('employee_id' => $employee_id, 'employee' => $employee, 'schedule_item_id' => $schedule_item_id,'schedule_item' => $schedule_item));
    }
	
	/****************Accounting Calender********************************/
	function accounting_calendar()
	{ 
	$this->load->model('employees_actions');
        $employee = null;
        $schedule_item = null;
        if (!is_null($employee_id)) {
            $employee = $this->employees_actions->get_employee($employee_id);
        }
        if (!is_null($schedule_item_id)) {
            $schedule_item = $this->schedule_actions->get_schedule_item($schedule_item_id);
        }
        $this->load->view('schedule/accounting_calendar', array('employee_id' => '', 'employee' => '', 'schedule_item_id' => $schedule_item_id,'schedule_item' => $schedule_item));
    }
	
	 function bircalendar() {
        // Short-circuit if the client did not give us a date range.
                $this->load->model('schedule_actions');
        
        $output_arrayss = $this->schedule_actions->get_schedule_bircalendar();
        //_custom_debug($output_arrays);
// Send JSON to the client.

// echo '<pre>';
// print_r($output_arrayss);
// echo '</pre>';
// die("dgfd");
$ddd=[];



foreach($output_arrayss as $output=>$vv)

{
	?>
	
	<?php

  $fileattach = $this->schedule_actions->get_fileattach($vv['bir_c_file_id']);
  $fileattach2 = $this->schedule_actions->get_fileattach2($vv['bir_c_file_id']);
  if($fileattach>0)
 {
	 $file= 'yes';
  }
  else
  {
	 $file= 'no';
  }
  if($fileattach2>0)
	{
	 $file2= 'yess';
	}
  else
	{
	 $file2= 'noo';
	}
  // echo $file;
  // die(""w)
  

	$ddd[]= array('title'=> $vv['form_name'],'id'=>$vv['bir_c_file_id'],'start'=> $vv['for_themonth'],'className'=>'scheduler_basic_event '.$file.' '.$file2,'url' => '/schdeule/birformpreview');
	
	
	
	
	//alert(i);
	
	
	}
	// echo "<pre>";
	// print_R($ddd);

        echo  json_encode($ddd);
    }
	function accountingcalendar() {
        // Short-circuit if the client did not give us a date range.
                $this->load->model('schedule_actions');
        
        $output_arrayss = $this->schedule_actions->get_schedule_accountingcalendar();
        //_custom_debug($output_arrays);
// Send JSON to the client.

// echo '<pre>';
// print_r($output_arrayss);
// echo '</pre>';
// die("dgfd");
$ddd=[];



foreach($output_arrayss as $output=>$vv)

{
	
	$ddd[]= array('title'=> $vv['subject'],'id'=>$vv['schedule_id'],'start'=> $vv['start_date'],'className'=>'scheduler_basic_event','url' => '');
	
	
	
	
	//alert(i);
	
	
	}
	// echo "<pre>";
	// print_R($ddd);

        echo  json_encode($ddd);
    }
	
	/***********************Bir calender  end**********************************/
	
    function calendar($employee_id = null, $schedule_item_id = null) {
        // Short-circuit if the client did not give us a date range.
        if (!isset($_GET['start']) || !isset($_GET['end'])) {
            die("Please provide a date range.");
        }

        $start_date = $this->input->get('start');
        $end_date = $this->input->get('end');
        
        $output_arrays = $this->schedule_actions->get_schedule_calendar($start_date, $end_date, $employee_id, $schedule_item_id);
        //_custom_debug($output_arrays);
// Send JSON to the client.
// echo '<pre>';
// print_r($output_arrays);
// echo '</pre>';

        echo json_encode($output_arrays);
    }
	
	function drag_drop_schedule()
	{
		 $id= $_REQUEST['sid'];
		 $sd= $_REQUEST['sd'];
		
			$sdata=$this->schedule_actions->get_schedule($id);
			// echo "<pre>";
			// print_r($sdata);
			$edate= $sdata['end_date'];
			$sdate= $sdata['start_date'];
			$stop_date = date('Y-m-d H:i:s', strtotime($sd . ' +1 day'));
			$s_date = date('Y-m-d H:i:s', strtotime($sd));
			//Convert them to timestamps.

			 
		$data = array(
       // 'schedule_id' => $sdata['schedule_id'],
		'schedule_item_id' => $sdata['schedule_item_id'],
        'customer_item_id' => $sdata['customer_item_id'],
        'start_date' => $sd,
        'end_date' =>$stop_date,
        'remarks_admin' => strip_tags($sdata['remarks_admin']),
		'remarks' => $sdata['remarks'],
		'remarks_employe' => $sdata['remarks_employe'],
		'remarks_employe_detail' => $sdata['remarks_employe_detail'],
		'employee_id' => $sdata['employee_id'],
		'employee_name' => $sdata['employee_name'],
        );
		
           $data['created_date'] = date('Y-m-d H:i:s');
           $data['updated_date'] = date('Y-m-d H:i:s');
		   $this->load->model('schedule_actions');
		  $result= $this->schedule_actions->drag_schedule($data,$id);
		   echo $result;
	}

    function daily() {
        $this->load->view('schedule/daily_schedules', array('schedules' => $this->schedule_actions->get_schedule_daily()));
    }

    function new_schedule() {
		$this->load->model('employees_actions');
        $is_selfservice = $this->user_actions->is_selfservice();
        $employee_id = $this->session->userdata('employee_id');
		$employee = $this->schedule_actions->get_employeee($employee_id);
		
        $schedule_items = $this->schedule_actions->get_schedule_items();
        $customer_items = $this->schedule_actions->get_customer_items();
        $this->load->view('schedule/schedule_new', array('schedule_items' => $schedule_items, 'customer_items' => $customer_items, 'is_selfservice' => $is_selfservice, 'employee_id' => $employee_id,'employee'=> $employee));
    }
	function new_accounts_schedule() {
		
        $schedule_items = $this->schedule_actions->get_schedule_items();
		 $is_selfservice = $this->user_actions->is_selfservice();
        $customer_items = $this->schedule_actions->get_customer_items();
        $this->load->view('schedule/schedule_accounting_new', array('schedule_items' => '', 'customer_items' => '', 'is_selfservice' => $is_selfservice, 'employee_id' => '','employee'=> ''));
    }
	function newbitform_entry($title) {
		
		 $title= $_GET['selected'];
		  $this->load->model('schedule_actions');
         $this->load->model('settings_actions');
         $this->load->model('accounting_actions');
		  $this->load->helper('fa-extension');
         $this->load->model('attachments_actions');
        $bir_forms = $this->settings_actions->get_bir_forms();
        //$output_arrayss = $this->schedule_actions->get_schedule_birentry($title);
		// echo "<pre>";
		// print_r($output_arrayss);
		// die("dgfsd");
		
		 $bir_file = $this->accounting_actions->get_bir_calander_file($title);
      // echo "<pre>";
		// print_r($bir_file);
		// die("dgfsd");
		$attahment1= $this->attachments_actions->get_attachments($title, 'bir_calander_file');
		$attachment2= $this->attachments_actions->get_attachments($title, 'bir_calander_file2');


  
        $this->load->view('schedule/birformentry_edit', array('bir_forms' => $bir_forms,'bir_file' => $bir_file,'attachments' => $attahment1,'attachments2' => $attachment2));
		
	}
	function editbirformentry()
	{
		  $this->load->model('schedule_actions');
		  $this->load->model('settings_actions');
		  
		  if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'form_id', 'rules' => 'required', 'label' => $this->lang->line('Form Name')),
			  array('field' => 'alertchk', 'label' => $this->lang->line('Alert')),
            array('field' => 'amount', 'rules' => 'required', 'label' => $this->lang->line('Paid Amount')),
            array('field' => 'for_themonth', 'rules' => 'required', 'label' => $this->lang->line('For the month'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('accounting_actions');
        if (!$result = $this->schedule_actions->save_birentryforms()) {
            exit($this->load->view('layout/error', array('message' => $this->schedule_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');

        
        $this->load->view('schedule/birformentry_add', $result);
       // $this->load->view('schedule/birformentry_edit', array('result' => $this->schedule_actions->save_birentryforms()));
	}

    function edit_schedule($schedule_id = 0) {
	
        $is_selfservice = $this->user_actions->is_selfservice();
        $admin = $this->user_actions->is_loged_in('admin');
		$employee_id = $this->session->userdata('employee_id');
        $get_permissions = $this->user_actions->get_permissions($employee_id);
        $schedule_items = $this->schedule_actions->get_schedule_items();
        $customer_items = $this->schedule_actions->get_customer_items();
		if(isset($get_permissions['Edit_Calandare_Schedule']) || isset($get_permissions['global_admin']))
		{		
        $this->load->view('schedule/schedule_edit', array(
            'schedule' => $this->schedule_actions->get_schedule($schedule_id),
            'schedule_items' => $schedule_items,
            'customer_items' => $customer_items,
            'is_selfservice' => $is_selfservice,
            'admin' => $admin
			
        ));
		}else{
			$this->load->view('schedule/schedule_edit', array(
            'schedule' => $this->schedule_actions->get_schedule($schedule_id),
            'schedule_items' => $schedule_items,
            'customer_items' => $customer_items,
            'is_selfservice' => $is_selfservice,
            'admin' => $admin
			   ));
		//exit($this->load->view('schedule/index', array('message' => 'user not have permittion'), TRUE));
		}
    }

	
	
    function save_schedule() {
		// echo "<pre>";
		// print_r($_POST);
		// die("hgj");
		 $this->load->helper('fa-extension');
        $this->load->library('form_validation');
		// echo "hiii";
		// die("dsf");
	 $this->form_validation->set_rules(array(
    array('field' => 'schedule_id', 'rules' => 'required', 'label' => 'schedule_id'),
   array('field' => 'schedule_item_id', 'rules' => 'required', 'label' => $this->lang->line('Schedule Item')),
   array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start Date')),
//            array('field' => 'end_date', 'rules' => 'required', 'label' => $this->lang->line('End Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
		if($_POST['count'] == 0){
			
		
        $this->load->view('schedule/schedule_add', array('result' => $this->schedule_actions->save_schedule()));
		}else{
			
						
			$this->load->view('schedule/index', array('result' => $this->schedule_actions->save_schedule(),'message' => 'updated'));
		}
	}
	function save_accounting_schedule() {
		// echo "<pre>";
		// print_r($_POST);
		// die("hgj");
		 $this->load->helper('fa-extension');
        $this->load->library('form_validation');
		// echo "hiii";
		// die("dsf");
	 $this->form_validation->set_rules(array(
    //array('field' => 'schedule_id', 'rules' => 'required', 'label' => 'schedule_id'),
   //array('field' => 'schedule_item_id', 'rules' => 'required', 'label' => $this->lang->line('Schedule Item')),
   array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start Date')),
//            array('field' => 'end_date', 'rules' => 'required', 'label' => $this->lang->line('End Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
		if($_POST['count'] == 0){
			
		
        $this->load->view('schedule/schedule_accounting_add', array('result' => $this->schedule_actions->save_accounting_schedule()));
		}else{
			
						
			$this->load->view('schedule/accounting_calendar', array('result' => $this->schedule_actions->save_accounting_schedule(),'message' => 'updated'));
		}
	}

  function email_emp($schedule_id = 0){
	  
	  if($schedule_id !=''){
       $result = $this->schedule_actions->upate_email($schedule_id);
	   
	  }
	 
  if($result){
	
	$data['res']="updated";
    $this->load->view('schedule/index',$data);
  }
	 }


	

    function delete_schedule($schedule_id) {
        $result = $this->schedule_actions->delete_schedule($schedule_id);
        die(json_encode($result));
    }

    function print_daily() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');

        $data = $this->schedule_actions->get_schedule_daily();
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('schedule/daily_print', array('data' => $data, 'logo' => $logo), TRUE);
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "daily_schedule.pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }
	
	function find_category() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_category());
    }

    function schedule_calendar() {
        $this->load->view('schedule/index');
    }

    function preview_schedule($schedule_id = 0) {
		
		$employee_id = $this->session->userdata('employee_id');
        $get_permissions = $this->user_actions->get_permissions($employee_id);
        $this->load->view('schedule/schedule_preview', array('schedule' => $this->schedule_actions->get_schedule($schedule_id), 'perrmi' => $get_permissions));
    }

    function print_schedule($schedule_id = 0) {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');

        $data = $this->schedule_actions->get_schedule($schedule_id);
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('schedule/schedule_print', array('data' => $data, 'logo' => $logo), TRUE);
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "schedule.pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
    
    function find_schedule_item() {
        echo json_encode($this->schedule_actions->get_schedule_items());
    }
	
	 function print_all_schedule($currdate)
	 {
		 
		  $this->load->model('settings_actions');
			$logo = $this->settings_actions->get_setting('company_logo');

        $data = $this->schedule_actions->get_allschedules($currdate);
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('schedule/schedule_all_print', array('data' => $data, 'logo' => $logo), TRUE);
        //$this->load->view('schedule/schedule_all_print', array('data' => $data, 'logo' => $logo));
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "AllEmployeeSchedule.pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	 }
	 
	 
	  function printschedule_month()
	 {
		  $emp= $_GET['emp'];
		
		 
		  $this->load->model('settings_actions');
			$logo = $this->settings_actions->get_setting('company_logo');

        $data = $this->schedule_actions->get_allschedules_month($emp);
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('schedule/schedule_print_month', array('data' => $data, 'logo' => $logo), TRUE);
        //$this->load->view('schedule/schedule_all_print', array('data' => $data, 'logo' => $logo));
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "AllEmployeeSchedule.pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	 }
	 
	 
	 

}

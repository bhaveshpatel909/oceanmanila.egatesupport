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
 * @property timeoff_actions          $timeoff_actions
 * @property discipline_actions          $discipline_actions
 * @property assessments_actions          $assessments_actions
 * @property performance_actions          $performance_actions
 * @property reports_actions          $reports_actions
 * @property mix_actions          $mix_actions
 * @property recruiting_actions          $recruiting_actions
 * @property positions_actions          $positions_actions
 * @property documents_actions          $documents_actions
 * @property cron_actions          $cron_actions
 */
class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('selfservice');
		$this->load->model('evaluation_actions');
    }

    function index($eid=1) {
        if ($this->user_actions->is_selfservice()) {
			//echo "gffv,hjk";
            $this->load->model('employees_actions');
			$this->load->model('timeoff_actions');
			 $this->load->model('task_actions');
            $this->load->model('drequest_actions');
            $this->load->model('discipline_actions');
            $this->load->model('assessments_actions');
            $this->load->model('performance_actions');
			$this->load->model('employeereminder_actions');
            $this->load->model('mix_actions');
            $this->load->helper('dates_format');
			$this->load->model('drequest_actions');
            $this->load->model('workmanual_actions');
			$this->load->model('settings_actions');
			$this->load->model('evaluation_actions');
        $settingss =$this->settings_actions->get_settings('company');
     
		$deparmentw =	$this->workmanual_actions->get_workmanual_department();
		
       
		$deparment=	$this->employeereminder_actions->get_employeereminder_department();
      
    	$request=	$this->drequest_actions->get_request_request();


        $employee_id = $this->session->current->userdata('employee_id');
            

        
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

           

           //print_r($settingss);die;




			$emppdata=$this->timeoff_actions->get_employee_deta();
            $this->load->view('selfservice/index', array(
                'timeoff' => $this->timeoff_actions->get_employee_records(),
                'discipline' => $this->discipline_actions->get_employee_records(),
                'skills' => $this->assessments_actions->get_employee_assessments(),
                'performance' => $this->performance_actions->get_employee_appraisal(),
                'clock' => $this->mix_actions->get_punch_clock(),
                'empy_plan' => $this->timeoff_actions->get_employee_yesterdayplan(),
                'empt_plan' => $this->timeoff_actions->get_employee_todayplan(),
                'emppdata' => $this->timeoff_actions->get_employee_deta(),
                'workmnaualdata' => $this->timeoff_actions->get_workmanualbydepartment($emppdata[0]['department_id']),
                'requestemp' => $this->drequest_actions->get_request(),
				'employeereminder' => $this->employeereminder_actions->get_employeereminder(),
				'evaluations' => $this->evaluation_actions->get_evaluations($eid),
				'discipline' => $this->discipline_actions->get_records($eid),
				'depatmentdata' => $this->timeoff_actions->get_departmentname($emppdata[0]['department_id']),
				'requestt'=> $request,
				'deparment'=> $deparment,
				'deparmentw'=> $deparmentw,
                'alltask' => $all_tasks,
				
                'company_settings' => $settingss,
              //  'service_expire' => $exp_date,
				
            ));
        } else {
			$this->load->model('discipline_actions');
            $this->load->model('reports_actions');
            $this->load->model('mix_actions');
             $this->load->model('task_actions');
             $this->load->model('employees_actions');
			$this->load->model('drequest_actions');
			$this->load->model('settings_actions');
			 $exp_date =$this->settings_actions->get_expiredate();
			//	echo "hiiiiiii";
            $all_tasks = $this->task_actions->get_taskd();
            for($i = 0; $i < count($all_tasks); $i++) {
                $output = preg_replace('!\s+!', ' ', $all_tasks[$i]['notify']);
                $notifi_emp = explode(" ",$output);
                $temp_notify_names = array();
                foreach ($notifi_emp as $emp_id) {
                    $employee_details = $this->employees_actions->get_employee($emp_id);
                    $temp_notify_names[] = $employee_details['name'];
                }
                //print_r($temp_notify_names);die;
                $all_tasks[$i]['notified_names'] = implode(", ",$temp_notify_names);
            }
          
			$requests=$this->drequest_actions->get_request(1);
            //print_r($all_tasks);die;
            $this->load->view('dashboard/index', array(
			 
                'newly_hired' => $this->reports_actions->get_newly_hired(),
                'discipline' => $this->reports_actions->get_last_discipline(),
				'alltask' => $all_tasks,
                'unsent_emails' => $this->mix_actions->get_unsent_emails(),
				 'evaluations' => $this->evaluation_actions->get_evaluations($eid),
                  'discipline' => $this->discipline_actions->get_records($eid),				 
				'requests' => $requests,
				'service_expire' => $exp_date
            ));
        }
    }

    function send_emails() {
        if ($this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('cron_actions');
        $this->cron_actions->send_notifications();
        $this->load->view('layout/refresh');
    }

    function timeoff($record_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }
        $this->load->model('timeoff_actions');
        $this->load->view('selfservice/timeoff_view', array('record' => $this->timeoff_actions->get_record($record_id, array('approved', 'denied', 'request'))));
    }

    function new_timeoff() {
        $this->load->view('selfservice/timeoff_new');
    }

	function new_scheduleplan() {
        
		 $this->load->model('schedule_actions');
		 $schedule_items = $this->schedule_actions->get_schedule_items();
		 $employee_id = $this->session->userdata('employee_id');
		$employee = $this->schedule_actions->get_employeee($employee_id);
       // $this->load->view('selfservice/scheduleplan');
		$this->load->view('selfservice/scheduleplan_new', array(
                'schedule_items' => $schedule_items,
                'employee' => $employee,
               
            ));
    }
	function edit_scheduleplan($schedule_id = 0) {
        
		 $this->load->model('schedule_actions');
		 $schedule_items = $this->schedule_actions->get_schedule_items();
		 $schedule = $this->schedule_actions->get_schedule($schedule_id);
		 $employee_id = $this->session->userdata('employee_id');
		$employee = $this->schedule_actions->get_employeee($employee_id);
		
       // $this->load->view('selfservice/scheduleplan');
		$this->load->view('selfservice/schdeuleplan_edit', array(
                'schedule_items' => $schedule_items,
                'employee' => $employee,
                'schedule' => $schedule
				
               
            ));
    }
	function save_schedule_plan()
	
	{
		
		
		$this->load->model('schedule_actions');
		//$this->schedule_actions->save_schedule();
		 
		//$this->load->view('selfservice/index', array('result' => $this->schedule_actions->save_schedule()));
		//$this->load->view('selfservice/scheduleplan_new', array('result' => $this->schedule_actions->save_schedule(),'message' => 'updated'));
		if($_POST['count'] == 0){
        $this->load->view('schedule/schedule_add', array('result' => $this->schedule_actions->save_schedule()));
		}else{
			$this->load->view('schedule/index', array('result' => $this->schedule_actions->save_schedule(),'message' => 'updated'));
		}

	}

    function save_timeoff() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'record_id', 'rules' => 'required', 'label' => 'record_id'),
            array('field' => 'start_time', 'rules' => 'required', 'label' => $this->lang->line('Start time')),
            array('field' => 'end_time', 'rules' => 'required', 'label' => $this->lang->line('End time')),
            array('field' => 'type', 'rules' => 'required', 'label' => $this->lang->line('Type'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('timeoff_actions');
        $_POST['employee_id'][0] = $this->session->current->userdata('employee_id');
        $this->load->view('selfservice/timeoff_add', array('result' => $this->timeoff_actions->save_record()));
    }

    function discipline($record_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('discipline_actions');
        $this->load->view('selfservice/discipline', array('discipline' => $this->discipline_actions->get_record($record_id)));
    }

    function save_comment() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'record_id', 'rules' => 'required', 'label' => 'record_id')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('discipline_actions');
        $this->discipline_actions->save_comment();
        $this->load->view('layout/success', array('message' => $this->lang->line('Saved')));
    }

    function assessment($assessment_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('assessments_actions');
        $this->load->view('selfservice/assessment', array('assessment' => $this->assessments_actions->get_results($this->session->current->userdata('employee_id'), $assessment_id, FALSE)));
    }

    function appraisal($appraisal_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('performance_actions');
        $this->load->view('selfservice/appraisal', array(
            'appraisal' => $this->performance_actions->get_appraisal($appraisal_id),
            'logs' => $this->performance_actions->get_appraisal_logs($appraisal_id)
        ));
    }

    function update_clock_comments() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->update_clock_comments();
    }

    function complete_clock() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->complete_clock();

        $this->load->helper('dates_format');
        //$this->load->view('selfservice/clock', array('clock' => $this->mix_actions->get_punch_clock()));
    }
	function complete_clock_2() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->complete_clock_2();

        $this->load->helper('dates_format');
        $this->load->view('selfservice/clock', array('clock' => $this->mix_actions->get_punch_clock()));
    }

    function start_clock() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->start_clock();
		 $this->load->helper('dates_format');
        $this->load->view('selfservice/clock', array('clock' => $this->mix_actions->get_punch_clock()));
		
		
		
    }

    function vacancies() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('recruiting_actions');
        $this->load->view('selfservice/vacancies', array('vacancies' => $this->recruiting_actions->get_open_vacancies()));
    }

    function apply_to_vacancy($vacancy_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('recruiting_actions');
        $this->load->model('positions_actions');

        $vacancy = $this->recruiting_actions->get_vacancy($vacancy_id);
        $this->load->view('selfservice/apply_to_vacancy', array(
            'vacancy' => $vacancy,
            'data' => $this->positions_actions->check_position($vacancy['position_id'], $this->session->current->userdata('employee_id'))
        ));
    }

    function proccess_apply() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'vacancy_id', 'rules' => 'required', 'label' => 'vacancy_id')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('recruiting_actions');
        if (!$this->recruiting_actions->apply_employee()) {
            exit($this->load->view('layout/error', array('message' => $this->recruiting_actions->get_error()), TRUE));
        }

        $this->load->view('selfservice/applied');
    }

    function my_documents($page_id = 1) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('documents_actions');
        $this->load->helper('fa-extension');

        $this->load->view('selfservice/documents_index', array(
            'documents' => $this->documents_actions->get_employee_documents($page_id),
            'search' => $this->input->get('search')
        ));
    }

    function download_document($document_id = 0) {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('documents_actions');
        $this->documents_actions->download_document($document_id);
    }
    
    function performance_dashboard() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'report_category', 'rules' => 'required', 'label' => 'report_category'),
            array('field' => 'report_type', 'rules' => 'required', 'label' => 'report_type'),
            array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start date')),
            array('field' => 'end_date', 'rules' => 'required', 'label' => $this->lang->line('End date'))
        ));

        $this->load->model('reports_actions');
        $this->reports_actions->validate_fields();

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $postData = $this->input->post();

        $this->load->view('selfservice/' . $this->input->post('report_type'), array('data' => $this->reports_actions->get_results(), 'postdata' => json_encode($postData)));
    }
    
    function print_performance() {
        $json = $this->input->post('jsondata');
        //_custom_debug(json_decode($json, true));
        $_POST = json_decode($json, true);
        $this->load->model('reports_actions');
        $data = $this->reports_actions->get_results();
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('reports/clock/print', array('data' => $data, 'from' => $_POST['start_date'], 'to' => $_POST['end_date']), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $data[0]['fullname']) . "_report.pdf";

        //load mPDF library
        $param = array(
            'mode' => 'en-GB-x',
            'format' => 'A4',
            'font_size' =>  0,
            'font_default' => '',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'P'
        );
        $this->load->library('m_pdf',$param);
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
	function myperformance()
	{
		
		 $this->load->model('performance_actions');
		 
            $this->load->view('selfservice/myperformance', array(
              
                'performance' => $this->performance_actions->get_employee_appraisal(),
               
            ));
	}

	
	/*********************************************Orignal time clock in start*******************************************************/
	 function orignaldashboard() {
        if ($this->user_actions->is_selfservice()) {
            $this->load->model('timeoff_actions');
            $this->load->model('discipline_actions');
            $this->load->model('assessments_actions');
            $this->load->model('performance_actions');
            $this->load->model('mix_actions');
            $this->load->helper('dates_format');


            $this->load->view('selfservice/orignalindex', array(
                'timeoff' => $this->timeoff_actions->get_employee_records(),
                'discipline' => $this->discipline_actions->get_employee_records(),
                'skills' => $this->assessments_actions->get_employee_assessments(),
                'performance' => $this->performance_actions->get_employee_appraisal(),
                'clock' => $this->mix_actions->orget_punch_clock()
            ));
        } else {
            $this->load->model('reports_actions');
            $this->load->model('mix_actions');

            $this->load->view('selfservice/orignalindex', array(
                'newly_hired' => $this->reports_actions->get_newly_hired(),
                'discipline' => $this->reports_actions->get_last_discipline(),
                'unsent_emails' => $this->mix_actions->get_unsent_emails()
            ));
        }
    }

	
	function orupdate_clock_comments() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->orupdate_clock_comments();
    }

    function orcomplete_clock() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->orcomplete_clock();

        $this->load->helper('dates_format');
        $this->load->view('selfservice/orignalclock', array('clock' => $this->mix_actions->orget_punch_clock()));
    }

    function orstart_clock() {
        if (!$this->user_actions->is_selfservice()) {
            exit();
        }

        $this->load->model('mix_actions');
        $this->mix_actions->orstart_clock();
    }

	
	
	
	/*********************************************Orignal time clock in end************************************************/
	
	
}

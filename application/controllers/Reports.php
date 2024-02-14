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
 * @property employees_actions          $employees_actions
 * @property mix_actions          $mix_actions
 * @property attachments_actions          $attachments_actions
 * @property positions_actions          $positions_actions
 * @property departments_actions          $departments_actions
 * @property reports_actions          $reports_actions
 */
class Reports extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('reports');
        $this->load->helper('url');
		//require_once APPPATH.'third_party/PHPExcel.php';
        //$this->excel = new PHPExcel(); 
    }

    function index() {
        
    }

    function skills() {
        $this->load->model('departments_actions');
        $this->load->view('reports/skills/index', array(
            'departments' => $this->departments_actions->get_departments_list()
        ));
    }

    function get_departments() {
        $this->load->model('departments_actions');
        $this->load->view('reports/departments', array(
            'departments' => $this->departments_actions->get_departments_list()
        ));
    }

    function proccess_report() {
        $this->load->library('form_validation');
		 $this->load->model('settings_actions');
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
        $this->load->model('employees_actions');
        $user_ip = $this->employees_actions->get_employee($this->input->post('employee')[0])['user_ip'];
		$employee_late_time = $this->employees_actions->get_employee($this->input->post('employee')[0])['late_time'];
		

        $employeesss = $this->employees_actions->get_employeesss(1)['data'];
        $employees_ip = array();
        foreach ($employeesss as $emp) {
            $employees_ip[$emp['employee_id']] = $emp['user_ip'];
        }
        //print_r($employees_ip);die;

      
 //$this->input->post('report_category');
	 	//$this->input->post('report_type');
		
		
        $this->load->view('reports/' . $this->input->post('report_category') . '/' . $this->input->post('report_type'), array('data' => $this->reports_actions->get_results(), 'details' => $this->settings_actions->get_settings('company'), 'postdata' => json_encode($postData), 'ip_address' =>$user_ip,'employees_ip' => $employees_ip,'employee_late_time' => $employee_late_time));
    }



    function proccess_assets_report(){
    	$employee_id = $this->input->post('employee')[0];
    	$this->load->model('employees_actions');
    	$assets = array();
    	if($employee_id){
    		$tmp = array();
    		$tmp['employee'] = $this->employees_actions->get_employee($employee_id);
    		$tmp['data'] = $this->employees_actions->get_assetbenefits($employee_id);
    		$assets[] = $tmp;
    	}else{
    		$all_employees = $this->employees_actions->get_employees(1)['data'];
    		foreach ($all_employees as $emp) {
    			$tmp = array();
	    		$tmp['employee'] = $this->employees_actions->get_employee($emp['employee_id']);
	    		$tmp['data'] = $this->employees_actions->get_assetbenefits($emp['employee_id']);
    			$assets[] = $tmp;
    		}

    	}
    	//print_r($assets);

    	$this->load->view('reports/assets/default',array('assets' => $assets));
    }

    function clock() {
        $this->load->view('reports/clock/index');
    }

    function assets(){
    	$this->load->view('reports/assets/index');
    }
    
    function discipline() {
        $this->load->view('reports/discipline/index');
    }

    function find_employee() {
        $this->load->model('employees_actions');
		$data= $this->employees_actions->search_employee();
		//$data =array_unshift($data , 'View All');
		$newdata =  array (
      'id' => '',
      'name' => 'View All',
      'email' => ''
    );
	array_unshift($data,$newdata);
	//$data[] = $newdata;
		// echo "<pre>";
		// print_R($data);
		// die("sdfsd");
        echo json_encode($data);
    }
    
    function print_report() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $json = $this->input->post('jsondata');
        //_custom_debug(json_decode($json, true));
        $_POST = json_decode($json, true);
        $this->load->model('reports_actions');
        $data = $this->reports_actions->print_discipline_report();
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('reports/discipline/print', array('data' => $data,'logo' => $logo, 'from' => $_POST['start_date'], 'to' => $_POST['end_date']), TRUE);
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
    
    function print_punch_clock() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $json = $this->input->post('jsondata');
        //_custom_debug(json_decode($json, true));
		
        $_POST = json_decode($json, true);
        $this->load->model('reports_actions');
        $data = $this->reports_actions->print_punch_clock();
		//echo'<pre>';print_r($data);echo'</pre>';die('jhjguyhguy');
        //_custom_debug($data);
        //PDF generating
		 $details=$this->settings_actions->get_settings('company');
		 $postdata = json_encode($json);
		  $this->load->model('employees_actions');
        //$user_ip = $this->employees_actions->get_employee_ip($this->input->post('employee')[0])['user_ip'];

        $employeesss = $this->employees_actions->get_employeip($eid);
		// echo "<pre>";
		// print_r($employeesss);
		// die("dxcfcsd");
        $employees_ip = array();
        foreach ($employeesss['data'] as $emp) {
            $employees_ip[$emp['employee_id']] = $emp['user_ip'];
        }
		 // $ip_address =$user_ip;
		  $employees_ip = $employees_ip;
        $html = $this->load->view('reports/clock/print', array('data' => $data,'logo' => $logo, 'details' => $details, 'employees_ip'=>$employees_ip, 'from' => $_POST['start_date'], 'to' => $_POST['end_date']), TRUE);
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "punch_clock_report.pdf";

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
	
	function export_puch_clock($id,$sdate,$enddate)
	{
		
		//$this->load->library('excel');
	  // echo "<pre>";
	  // print_r($this->excel);
	//  $this->excel = new PHPExcel();

		$this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
       // $json = $this->input->post('jsondata');
        //_custom_debug(json_decode($json, true));
		
        //$_POST = json_decode($json, true);
        $this->load->model('reports_actions');
		
		 $eid=  $id;
        $data = $this->reports_actions->export_punch_clock($eid,$sdate,$enddate);
		
		// echo "<pre>";
		// print_r($data);
		// die("dsfg");
		
		 $this->load->model('employees_actions');
        //$user_ip = $this->employees_actions->get_employee_ip($this->input->post('employee')[0])['user_ip'];
if($eid==0)
{
        $employeesss = $this->employees_actions->get_employesipp();
}
else
{
	 $employeesss = $this->employees_actions->get_employeip($eid);
}
		// echo "<pre>";
		// print_r($employeesss);
		// die("dxcfcsd");
        $employees_ip = array();
        foreach ($employeesss['data'] as $emp) {
            $employees_ip[$emp['employee_id']] = $emp['user_ip'];
        }
		
		 $details=$this->settings_actions->get_settings('company');
		
		//$ip_address = $user_ip;
		$employees_ip = $employees_ip;
		// echo "<pre>";
		// print_R($data);
		
		// echo "<pre>";
		// print_r($details);
		
		// die("xzf");
		
		
		

		
			$this->load->library('excel');
			 
			$this->excel = new PHPExcel();
			 
			$compny_endt= $details['work_end'];
			$compny_timeout_allowance = $details['timeout_allowance'];
	
			 $emprecorddetail=array();
			 // echo "<pre>";
					// print_R($data);
					 // die("xsfzds");
					 
					 foreach($data as $k=>$dats)
					 {
						 // echo "<pre>";
					// print_R($dat);
					if(isset($dats['punchclock']))
					{
						
								 
									
									 $emprecorddetail[$k]= $dats;
								 
						
					}
					
					
						
						 // foreach($dat['punchclock'] as $key=>$value)
								// {
									
									// $emprecorddetail[$key]= $value;
								// }
						 
					 
							
								
								
								
							
							
						
						
					
					 }
					// echo "<pre>";
					// print_r($emprecorddetail);
					// die("sdfsd");
						$iZero = array_values($emprecorddetail);
						 
					 $current_date = '';
        
					$total_hours = $subtotal = 0;
					$remark= '';
					$timein="";
					if($eid==0)
					{
						// echo "dfgsd";
						// die("dcf");
						// echo "<pre>";
						// print_r($iZero);
						// die("ffdghjk");
						$this->excel->setActiveSheetIndex(0);
					 //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
							$this->excel->getActiveSheet()->SetCellValue('A1', 'Employee');
							$this->excel->getActiveSheet()->SetCellValue('B1', 'Dates');
							$this->excel->getActiveSheet()->SetCellValue('C1', 'IP Address (in)');
							$this->excel->getActiveSheet()->SetCellValue('D1', 'IP Address (out)');
							$this->excel->getActiveSheet()->SetCellValue('E1', 'Actual Time In');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Time In');
							$this->excel->getActiveSheet()->SetCellValue('G1', 'Actual Time Out');
							$this->excel->getActiveSheet()->SetCellValue('H1', 'Time Out');
							$this->excel->getActiveSheet()->SetCellValue('I1', 'Remarks');
							$this->excel->getActiveSheet()->SetCellValue('J1', 'Time Out Notes');
							$this->excel->getActiveSheet()->SetCellValue('K1', 'Overtime Details');
							$this->excel->getActiveSheet()->SetCellValue('L1', 'Working Hour');
							$this->excel->getActiveSheet()->SetCellValue('M1', 'Overtime Notes');
							
							$row=2;
						foreach($emprecorddetail as $dat)
						{
							// echo "<pre>";
							// print_r($dat);
							
							 foreach ($dat['punchclock'] as $record) {
								// echo $record['start_time'];
								 $start_time_unix = strtotime($record['start_time']);
								 $end_time_unix = strtotime($record['end_time']);
								$workhour='';
								$diff = strtotime($record['end_time']) - strtotime($record['start_time']);
							   
								$datesc= date($this->config->item('date_format'), $start_time_unix);
								$stime= date('H:i', strtotime($record['start_time']));
								//$timestamp = DateTime::createFromFormat('H:i:s', $val); 
								//$excelTime = PHPExcel_Shared_Date::PHPToExcel($timestamp);
							 //echo  $stime = PHPExcel_Shared_Date::PHPToExcel( $record['start_time'] );
							 if(!is_null($record['penality_time']))
								{
							//echo date('Y-m-d', strtotime($record['penality_time']))
								$timein= date('H:i', strtotime($record['penality_time']));
								}
							if($record['end_time']!="") {
							 	$etime= date('H:i', strtotime($record['end_time']));
							
								}
								if($record['end_time']!="") {
								$timeout=  date('H:i', strtotime($record['end_time'])-($compny_timeout_allowance*60));
								}
								$remark =  $record['remarks'];
						
						$timeoutnotes= $record['overtime_remark'];
						
						  $diffe = strtotime($record['end_time']) - strtotime($record['penality_time']);
							$endt=($record['end_time']);
								
							$endtt=(explode(" ",$endt));
							$endttt=($endtt['1']);
							
							if($endttt!= $compny_endt){
							
							$diff = $diffe;
								//echo 'diff  '.$diff; 
								//echo "<br/>";
								 
								  if ($diff > 0) {
								$days = floor($diff / 86400);
								$hours = floor(($diff % 86400) / 3600);
								$mins = floor((($diff % 86400) % 3600) / 60);
								$senconds = floor((($diff % 86400) % 3600) % 60);
								//echo (int) $days . ':'. ($diff % 86400);
								
								$workhour= sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
								$total_hours += $diff;
								
								
								}
							}
									
							else 	 
							{
							
							
							$diff = $diffe;
							
							if ($diff > 0) {
								$days = floor($diff / 86400);
								$hours = floor(($diff % 86400) / 3600);
								$mins = floor((($diff % 86400) % 3600) / 60);
								$senconds = floor((($diff % 86400) % 3600) % 60);
								//echo (int) $days . ':'. ($diff % 86400);
								
								$workhour=  sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
								$total_hours += $diff;
								
							}
							}
								
								  $this->excel->getActiveSheet()->SetCellValue('A' . $row,  $dat['name']);
							 $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $datesc);
							 $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $record['ipaddress_in']);
							 $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $record['ipaddress_out']);
							 $this->excel->getActiveSheet()->SetCellValue('E' . $row, $stime);
							// $this->excel->getActiveSheet()->setCellValue('D', PHPExcel_Shared_Date::PHPToExcel( $stime ));
							 
							$this->excel->getActiveSheet()->SetCellValue('F' . $row,  date('H:i', strtotime($record['penality_time'])));
							if($record['end_time'])
							{
							 $this->excel->getActiveSheet()->SetCellValue('G' . $row,date('H:i', strtotime($record['end_time'])));
							 $this->excel->getActiveSheet()->SetCellValue('H' . $row, $timeout);
							}
							else
							{
							$this->excel->getActiveSheet()->SetCellValue('G' . $row, '');
							$this->excel->getActiveSheet()->SetCellValue('H' . $row, '');							
							}
							 
							 $this->excel->getActiveSheet()->SetCellValue('I' . $row, $remark);
							 $this->excel->getActiveSheet()->SetCellValue('J' . $row, $timeoutnotes);
							 $this->excel->getActiveSheet()->SetCellValue('K' . $row, '');
							 $this->excel->getActiveSheet()->SetCellValue('L' . $row, $workhour);
							 $this->excel->getActiveSheet()->SetCellValue('M' . $row, $record['comments']);
							
						   //  $this->excel->getActiveSheet()->SetCellValue('j' . $row, $record['comments']);
						  
							 $row++;
								 
								 	
						}
							
						// echo $row;
						// echo "<br/>";
						
						$days = floor($total_hours / 86400);
							$hours = floor(($total_hours % 86400) / 3600);
							$mins = floor((($total_hours % 86400) % 3600) / 60);
							$senconds = floor((($total_hours % 86400) % 3600) % 60);
							//echo (int) $days . ':'. ($diff % 86400);
						 $tttt= sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
						//echo "<br/>";
						
						
						$total_hours='';
						
						  $hbd = $row+=2;
						
						$str[$hbd]= $tttt;
						 
						
						}
						//die("hghk");
						foreach($str as $k=>$v)
						{
							
							$rw =$k-1;
							 $this->excel->getActiveSheet()->setCellValue( 'L'.$rw ,  $v);
						}							
						
						 
						 $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
						$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
						//$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
						//$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
						//$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
						//$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
						//$this->excel->getActiveSheet()->getColumnDimension('k')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
						//$this->excel->getActiveSheet()->getColumnDimension('k')->setWidth(30);
						$this->excel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setWrapText(true);
						//$dateTimeNow = time();
						//$this->excel->getActiveSheet()->setCellValue('D', PHPExcel_Shared_Date::PHPToExcel( $dateTimeNow ));
						 $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4);
						//$this->excel->getActiveSheet()->getStyle('D1') ->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME3);

						$filename= 'Employee Punch clock Report';
					   // if ($xls) {
							ob_clean();
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
							header('Cache-Control: max-age=0');
							ob_clean();
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
							$objWriter->save('php://output');
							exit();
						
						 
					
					}
					else
					{
						
						$this->excel->setActiveSheetIndex(0);
					 //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
							$this->excel->getActiveSheet()->SetCellValue('A1', 'Employee');
							$this->excel->getActiveSheet()->SetCellValue('B1', 'Dates');
							$this->excel->getActiveSheet()->SetCellValue('C1', 'IP Address (in)');
							$this->excel->getActiveSheet()->SetCellValue('D1', 'IP Address (out)');
							$this->excel->getActiveSheet()->SetCellValue('E1', 'Actual Time In');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Time In');
							$this->excel->getActiveSheet()->SetCellValue('G1', 'Actual Time Out');
							$this->excel->getActiveSheet()->SetCellValue('H1', 'Time Out');
							$this->excel->getActiveSheet()->SetCellValue('I1', 'Remarks');
							$this->excel->getActiveSheet()->SetCellValue('J1', 'Time Out Notes');
							$this->excel->getActiveSheet()->SetCellValue('K1', 'Overtime Details');
							$this->excel->getActiveSheet()->SetCellValue('L1', 'Working Hour');
							$this->excel->getActiveSheet()->SetCellValue('M1', 'Overtime Notes');
							
							 $row = 2;
					
						foreach ($data as $key => $record) {
							
							// echo "<pre>";
							// print_r($record);
							
							$start_time_unix = strtotime($record['start_time']);
					   $end_time_unix = strtotime($record['end_time']);
					   
					   
						$workhour='';
						 $diff = strtotime($record['end_time']) - strtotime($record['start_time']);
							   
								$datesc= date($this->config->item('date_format'), $start_time_unix);
								$stime= date('H:i', strtotime($record['start_time']));
							 if(!is_null($record['penality_time']))
								{
							//echo date('Y-m-d', strtotime($record['penality_time']))
								$timein= date('H:i', strtotime($record['penality_time']));
								}
							if($record['end_time']) {
								$etime= date('H:i', strtotime($record['end_time']));
								}
								if($record['end_time']) {
								$timeout=  date('H:i', strtotime($record['end_time'])-($compny_timeout_allowance*60));
								}
								
						$remark =  $record['remarks'];
						
						$timeoutnotes= $record['overtime_remark'];
						
						  $diffe = strtotime($record['end_time']) - strtotime($record['penality_time']);
							$endt=($record['end_time']);
								
							$endtt=(explode(" ",$endt));
							$endttt=($endtt['1']);
							
							if($endttt!= $compny_endt){
							
							$diff = $diffe;
								 
								 
								  if ($diff > 0) {
								$days = floor($diff / 86400);
								$hours = floor(($diff % 86400) / 3600);
								$mins = floor((($diff % 86400) % 3600) / 60);
								$senconds = floor((($diff % 86400) % 3600) % 60);
								//echo (int) $days . ':'. ($diff % 86400);
								
								$workhour= sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
								$total_hours += $diff;
								
							} 
							}
							else 	 
							{
							
							
							$diff = $diffe;
							
							if ($diff > 0) {
								$days = floor($diff / 86400);
								$hours = floor(($diff % 86400) / 3600);
								$mins = floor((($diff % 86400) % 3600) / 60);
								$senconds = floor((($diff % 86400) % 3600) % 60);
								//echo (int) $days . ':'. ($diff % 86400);
								
								$workhour=  sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
								$total_hours += $diff;
								
							}}
								
								  $this->excel->getActiveSheet()->SetCellValue('A' . $row,  $record['fullname']);
							 $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $datesc);
							 $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $record['ipaddress_in']);
							 $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $record['ipaddress_out']);
							 $this->excel->getActiveSheet()->SetCellValue('E' . $row, $stime);
							 
							$this->excel->getActiveSheet()->SetCellValue('F' . $row,  date('H:i', strtotime($record['penality_time'])));
							 $this->excel->getActiveSheet()->SetCellValue('G' . $row, $etime);
							 $this->excel->getActiveSheet()->SetCellValue('H' . $row, $timeout);
							 $this->excel->getActiveSheet()->SetCellValue('I' . $row, $remark);
							 $this->excel->getActiveSheet()->SetCellValue('J' . $row, $timeoutnotes);
							 $this->excel->getActiveSheet()->SetCellValue('K' . $row, '');
							 $this->excel->getActiveSheet()->SetCellValue('L' . $row, $workhour);
							 $this->excel->getActiveSheet()->SetCellValue('M' . $row, $record['comments']);
						   //  $this->excel->getActiveSheet()->SetCellValue('j' . $row, $record['comments']);
						  
							 $row++;
						}
						
						 $days = floor($total_hours / 86400);
							$hours = floor(($total_hours % 86400) / 3600);
							$mins = floor((($total_hours % 86400) % 3600) / 60);
							$senconds = floor((($total_hours % 86400) % 3600) % 60);
							//echo (int) $days . ':'. ($diff % 86400);
							$tttt= sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
						
						 $ggd = 'L'.$row;
						 $hbd = 'L'.++$row;
						 $hbd1 = $hbd;
						 $this->excel->getActiveSheet()->setCellValue( 'L'.$row , $tttt);
						 $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
						$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
						$this->excel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
						$this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setWrapText(true);
						$filename= 'Employee Punch clock Report';
					   // if ($xls) {
							ob_clean();
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
							header('Cache-Control: max-age=0');
							ob_clean();
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
							$objWriter->save('php://output');
							exit();
                // }
				}

	
   
		
	}
    
    function work_evaluation_rules() {
        $this->load->model('evaluation_actions');
        $this->load->view('evaluation/company_rules', array('company_rules' => $this->evaluation_actions->get_company_rules()));
    }
	function asset_issuance_status() {
        $this->load->model('reports_actions');
		//echo "fdgzdfz";
		$RES = $this->reports_actions->get_assetbenefit();
		// echo "<pre>";
		// print_R($RES);
       $this->load->view('reports/asset_issuance_status', array('assetnenefit' => $this->reports_actions->get_assetbenefit()));
    }
	function print_asset_isuance_status()
	{
		 $this->load->model('reports_actions');
		 $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
		//echo "fdgzdfz";
		 $RES = $this->reports_actions->get_assetbenefit();
	 	 $html = $this->load->view('reports/asset_issuance_status_print', array('logo' => $logo, 'assets_isuance_statu' => $RES), TRUE);
       
	   ini_set('memory_limit', '256M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "Assets_Issuance_Status.pdf";

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
		// echo "<pre>";
	}

    function print_work_evaluation_rules() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $this->load->model('evaluation_actions');
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('evaluation/company_rules_print', array('logo' => $logo, 'company_rules' => $this->evaluation_actions->get_company_rules()), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "work_evaluation_rules.pdf";

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
	
	function lazada($sucess='') {
		$this->load->model('reports_actions');
		$this->load->view('reports/lazada', array('lazada' => $this->reports_actions->get_lazada_list()));
		
        
        
    }
	

	
	
public	function ExcelDataAdd()	{  
	
$file_info = pathinfo($_FILES["userfile"]["name"]);

$file_directory = FCPATH."files/excel/";
$new_file_name = date("d-m-Y ") . rand(000000,999999).".". $file_info["extension"];
// echo'<pre>';
	// print_r($new_file_name);
	// echo'</pre>';
	// die('error');
if($file_info['extension'] != 'xlsx' && $file_info['extension'] != 'xls'){
	// echo'<pre>';
	// print_r($file_info['extension']);
	// echo'</pre>';
	// die('error');
	redirect(base_url() . "reports/lazada?error1=1");
}
	// echo'<pre>';
	// print_r($file_info['extension']);
	// echo'</pre>';
	// die('continue');

if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $file_directory . $new_file_name))
{ 
$this->load->library('Excel');  
    $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(true,true,true,true,true,true,true,true);
	
	//$keyarray =	array_pop(array_reverse($sheet_data));	
	//print_r($keyarray);									for get first row of array
	
	$valuearray = array_shift($sheet_data);					//for remove first row
		
	//$c = array();
	//foreach($sheet_data as $sheetdat){
		
	//$c[] = array_combine($keyarray, $sheetdat);			for combine row as key
		
	//}
		$typ = array_search('Transaction Type', $valuearray);
		$detal = array_search('Details', $valuearray);
		$amt = array_search('Amount', $valuearray);
		$vat = array_search('VAT in Amount', $valuearray);
		$whtamt = array_search('WHT Amount', $valuearray);
		$whtstts = array_search('WHT included in Amount', $valuearray);
		$stats = array_search('Paid Status', $valuearray);
		$ordr = array_search('Order No.', $valuearray);
			// echo'<pre>';
			// print_r($valuearray);
			// print_r($typ);
			// print_r($detal);
			// print_r($amt);
			// print_r($vat);
			// print_r($whtamt);
			// print_r($whtstts);
			// print_r($stats);
			// print_r($ordr);
			// echo'</pre>';
			// die('fgiru');

    foreach($sheet_data as $data)
    {
		
        $result = array(
                
                'Transaction_Type' => $data[$typ],
                'Details' => $data[$detal],
                'Amount' => $data[$amt],
				'vat' => $data[$vat],
				'wht_amount' => $data[$whtamt],
				'wht_status' => $data[$whtstts],
                'Status' => $data[$stats],
				'Order_No' => $data[$ordr],
        );
		
	
		if($result != ''){
			// echo'<pre>';
			// print_r($result);
			// echo'</pre>';
			// die('fgiru');
			$this->load->model('reports_actions');
			$this->reports_actions->Add_User($result);
		}
		
    }
		unlink(FCPATH.'files/excel/'.$new_file_name); //File Deleted After uploading in database .			 
		redirect(base_url() . "reports/lazada/sucess");
	}else{
	
	redirect(base_url() . "reports/lazada?error1=1");
	}
	
}

public function savedata()
    {
        If( $_SERVER['REQUEST_METHOD']  != 'POST'  ){
            redirect(base_url() . "reports/lazada?error2=2");
        }
        // echo'<pre>';
		// print_r($_POST['val']);
        // echo'</pre>';
		// die('hbthhyy');
		
        $id = $_POST['id'];
        $val = $_POST['val'];
        $index = $_POST['index'];
        
        $fields = array(
                    $index => $val,
                  );
        
		$this->load->model('reports_actions');
        $this->reports_actions->posts_save($id, $fields);
        
        echo "Successfully saved";
          
    }
	
	function pdfDataAdd() {
		
        $this->load->model('reports_actions');
		$lazda = $this->reports_actions->get_lazada_order();
		
		$cot = 0;
		$grndtotl = 0;
		$granddeduct = 0;
		$grndblns = 0;
		foreach($lazda as $laz){
			$tp = 0;
			$ttotl = 0;
			$alltype = $this->reports_actions->get_alltyp_byorder($laz['Order_No']);
	
			foreach($alltype as $type){
				$typamnt = $this->reports_actions->get_typamnt_byorder($laz['Order_No'],$type['Transaction_Type']);
			
				$row[$cot]['typeamt'.$tp] = $typamnt[0]['Amount'];
				$row[$cot]['typenm'.$tp] = $type['Transaction_Type'];
				//echo'<pre>';print_r($row[$cot]['typenm'.$tp]);
				if($row[$cot]['typenm'.$tp] != "Orders-Item Charges-Item Price Credit") {
					$ttotl = $ttotl + $row[$cot]['typeamt'.$tp];
				//echo'<pre>';print_r($ttotl);
				}
				$row[$cot]['totexp'] = $ttotl;
					
				$tp++;
			}
			$row[$cot]['tpnm'] = $tp;
			
			//$Credit = $this->reports_actions->get_allCredit_byorder($laz['Order_No']);
			//print_r($Credit);
			//$name = $this->reports_actions->get_name_byorder($laz['Order_No']);
			
			$blns = $Credit[0]['Amount'] + $row[$cot]['totexp'];
			
			$row[$cot]['order'] = $laz['Order_No'];
			$row[$cot]['credit'] = $Credit[0]['Amount'];
			$row[$cot]['blns'] = $blns;
			
			$grndtotl = $grndtotl + $row[$cot]['credit'];
			$granddeduct = $granddeduct + $row[$cot]['totexp'];
			$grndblns = $grndblns + $row[$cot]['blns'];
			$cot++;
				// echo'<pre>';
				// print_r($row);
				// echo'</pre>';
				// die('grgrg');
		}
		
		
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('reports/lazada_pdf_print', array('grndtotl' => $grndtotl, 'granddeduct' => $granddeduct, 'grndblns' => $grndblns, 'rows' => $row), TRUE);
		ini_set("memory_limit","-1");
        //ini_set('memory_limit', '256M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "lazada_pdf.pdf";

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
	function pdfDataAdddumy() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $this->load->model('reports_actions');
		$lazda = $this->reports_actions->get_lazada_order();
		$cot = 0;
		foreach($lazda as $laz){
		
			$paymnt = $this->reports_actions->get_allpay_byorder($laz['Order_No']);
			$comison = $this->reports_actions->get_allcomison_byorder($laz['Order_No']);
			$Credit = $this->reports_actions->get_allCredit_byorder($laz['Order_No']);
			$name = $this->reports_actions->get_name_byorder($laz['Order_No']);
			
			$totexp = $paymnt[0]['Amount'] + $comison[0]['Amount'];
			$blns = $Credit[0]['Amount'] - $totexp;
			
			$row[$cot]['order'] = $laz['Order_No'];
			$row[$cot]['name'] = $name[0]['name'];
			$row[$cot]['payment'] = $paymnt[0]['Amount'];
			$row[$cot]['commision'] = $comison[0]['Amount'];
			$row[$cot]['credit'] = $Credit[0]['Amount'];
			$row[$cot]['totexp'] = $totexp;
			$row[$cot]['blns'] = $blns;
			
			$cot++;
		}
		// echo'<pre>';
		// print_r($row);
		// echo'</pre>';
		// die('grgrg');
		
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('reports/lazada_pdf_print', array('logo' => $logo, 'rows' => $row), TRUE);
		ini_set("memory_limit","-1");
        //ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "lazada_pdf.pdf";

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
	
	function pdfDatadelete() {
       $this->load->model('reports_actions');
		$lazdadelet = $this->reports_actions->delete_lazada_order();
		redirect(base_url() . "reports/lazada");
    }
	function manual_adjust()
	{
		
		 $this->load->library('form_validation');
       
	   
		$this->load->model('reports_actions');
	$record_id = $this->input->post('recordid');
		  $endtime = $this->input->post('endtime');
		  $recorddate = $this->input->post('recorddate');
		//die("dcfds");
		  if($endtime=="")
		  {
			  
			  echo "<b style= 'color:red;'>End time Can't be blank.</b>";
		  }
		 else if (preg_match('/^\d{2}:\d{2}$/', $endtime))
		 {
    // it is in the time format
			//echo "<b style= 'color:red;'>it is in the time format.</b>";
			$totalend=date('Y-m-d').' '.$endtime;
			// echo $totalend;
			// die("dgsfd");
			$data= array("end_time" =>$totalend,"overtime_remark"=>'Manual Time Out','ipaddress_out'=> $_SERVER['REMOTE_ADDR']);
			$res= $this->reports_actions->updateendtime($data,$record_id);
			echo $res;
		} 
		else 
		{
			echo "<b style= 'color:red;'>it is not in the time format.</b>";
		// it is not in the time format
		}
		
		//$this->load->view('reports/clock/index');
	}
	function manual_adjust_timein()
	{
		
		 $this->load->library('form_validation');
       
	   
		$this->load->model('reports_actions');
	$record_id = $this->input->post('recordid');
		  $endtime = $this->input->post('endtime');
		  $recorddate = $this->input->post('recorddate');
		  if($endtime=="")
		  {
			  
			  echo "<b style= 'color:red;'>End time Can't be blank.</b>";
		  }
		 else if (preg_match('/^\d{2}:\d{2}$/', $endtime))
		 {
    // it is in the time format
			//echo "<b style= 'color:red;'>it is in the time format.</b>";
			$totalend=$recorddate.' '.$endtime;
			//echo $totalend;
			//die("dgsfd");
			$data= array("penality_time" =>$totalend);
			$res= $this->reports_actions->updateendtime($data,$record_id);
			echo $res;
		} 
		else 
		{
			echo "<b style= 'color:red;'>it is not in the time format.</b>";
		// it is not in the time format
		}
		
		//$this->load->view('reports/clock/index');
	}

	/**********************************************************Reports clock orignal************************************************/

 function orproccess_report() {
	 // echo '<pre>';
	 // print_R($_POST);
	 // echo '</pre>';
	 
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

        $this->load->view('reports/' . $this->input->post('report_category') . '/' . $this->input->post('report_type'), array('data' => $this->reports_actions->get_results(), 'postdata' => json_encode($postData)));
    }

	 function orproccess_reportt() {
	 // echo '<pre>';
	 // print_R($_POST);
	 // echo '</pre>';
	 
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

        $this->load->view('reports/' . $this->input->post('report_category') . '/' . $this->input->post('report_type'), array('data' => $this->reports_actions->get_results(), 'postdata' => json_encode($postData)));
    }

	
	
    function orclock($id) {
		
		$idddd = $_GET['id'];
	
		 
     $this->load->model('reports_actions');
    $this->load->view('reports/clock/orindex', array('data' => $this->reports_actions->getemployeed($idddd)));
	
   }
	
	function orprint_punch_clock() {
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $json = $this->input->post('jsondata');
        //_custom_debug(json_decode($json, true));
        $_POST = json_decode($json, true);
        $this->load->model('reports_actions');
        $data = $this->reports_actions->orprint_punch_clock();
        //_custom_debug($data);
        //PDF generating
        $html = $this->load->view('reports/clock/orprint', array('data' => $data,'logo' => $logo, 'from' => $_POST['start_date'], 'to' => $_POST['end_date']), TRUE);
        //exit($html);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = "punch_clock_report.pdf";

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

	/**********************************************************Reports clock orignal************************************************/
	
	
}

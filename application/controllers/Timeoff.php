<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property timeoff_actions          $timeoff_actions
    */
  
  class Timeoff extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->load->model('employees_actions');
          $this->user_actions->is_loged_in('timeoff');
      }
      
      function index()
      {
          $this->load->model('timeoff_actions');
		   $this->load->helper('fa-extension');
		   $this->load->model('attachments_actions');
		   $this->load->model('employees_actions');
          $this->load->view('timeoff/index',array(
		 'emp'=>$this->employees_actions->get_active_employee(),
		  'records'=>$this->timeoff_actions->get_records(),
		  'emppdata' => $this->timeoff_actions->get_employee_deta()
		  ));
      }
      
      function edit_record($record_id=0)
      {
          $this->load->model('timeoff_actions');
          $this->load->view('timeoff/record_edit',array('record'=>$this->timeoff_actions->get_record($record_id)));
      }
      
      function save_record()
      {
		  
	
		
          $this->load->library('form_validation');
		    $this->load->helper('fa-extension');
          $this->form_validation->set_rules(array(
            array('field'=>'record_id','rules'=>'required','label'=>'record_id'),
            array('field'=>'start_time','rules'=>'required','label'=>$this->lang->line('Start time')),
            array('field'=>'end_time','rules'=>'required','label'=>$this->lang->line('End time')),
            array('field'=>'type','rules'=>'required','label'=>$this->lang->line('Type'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('timeoff_actions');
		  
          $this->load->view('timeoff/record_add',array('result'=>$this->timeoff_actions->save_record()));
      }
      
      function delete_record()
      {
          $this->load->model('timeoff_actions');
          $this->timeoff_actions->delete_record($this->input->post('record_id'));
          $this->load->view('timeoff/record_delete',array('record_id'=>$this->input->post('record_id')));
      }
      
      function new_record()
      {
		 
          $this->load->view('timeoff/record_new');
      }
      
      function find_employee()
      {
          $this->load->model('employees_actions');
		
          echo json_encode($this->employees_actions->search_employee());
      }
	  function find_employee1()
      {
		 
		  
          $this->load->model('employees_actions');
		
          echo json_encode($this->employees_actions->search_employee1());
      }
      
      function requests()
      {
		   $this->load->model('employees_actions');
          $this->load->model('timeoff_actions');
          $this->load->view('timeoff/requests',array(
		  'records'=>$this->timeoff_actions->get_records_request('request'),
		   'empdata'=>$this->employees_actions->get_active_employee(),
		  
		  ));
      }
      
      function view_request($record_id=0)
      {
          $this->load->model('timeoff_actions');
          $this->load->view('timeoff/record_view',array('record'=>$this->timeoff_actions->get_record($record_id,'request')));
      }
      
      function change_status()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'record_id','rules'=>'required','label'=>'record_id'),
            array('field'=>'status','rules'=>'required','label'=>'status')
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('timeoff_actions');
          $this->timeoff_actions->change_status();
          $this->load->view('timeoff/record_change',array('record_id'=>$this->input->post('record_id')));
      }
	  function exportlist()
	  {
		   $this->load->model('timeoff_actions');
		   // if(isset($_GET['empidd']))
		   // {
			  // $eidd= $_GET['empidd']; 
		   // }
		   // else
		   // {
			   
		   // }
		$records=  $this->timeoff_actions->get_records();
		
			$this->load->library('excel');
			 
			$this->excel = new PHPExcel();
			$this->excel->setActiveSheetIndex(0);
					 //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
							$this->excel->getActiveSheet()->SetCellValue('A1', 'Request Date');
							$this->excel->getActiveSheet()->SetCellValue('B1', 'Name');
							$this->excel->getActiveSheet()->SetCellValue('C1', 'Dates');
							$this->excel->getActiveSheet()->SetCellValue('D1', 'Employee Comments');
							$this->excel->getActiveSheet()->SetCellValue('E1', 'Admin Comments');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Type/Status');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Status');
						$row=2;
						 foreach($records as $record){
							$dates=date($this->config->item('date_format'),strtotime($record['start_time'])).'-'. date($this->config->item('date_format'),strtotime($record['end_time']));
							$status =$this->lang->line(ucfirst($record['type'])).'/'. $this->lang->line(ucfirst($record['status']));
							if($record['status'] =='approved'){
								$statuss ='Approved';
							}
							else
							{
								$statuss ='Not Approved';
							}
							
								
							$this->excel->getActiveSheet()->SetCellValue('A' . $row,  $record['register_date']);
							 $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $record['name']);
							 $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $dates);
							 $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $record['employee_comment']);
							 $this->excel->getActiveSheet()->SetCellValue('E' . $row, $record['comment']);								
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $status);
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $statuss);
						$row++;							 
						 }
						 $filename= 'Leave Report';
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
	  function exportlistbyemployee()
	  {
		   $this->load->model('timeoff_actions');
		  $eidd= $_GET['empidd']; 
		  $st= $_GET['status']; 
		  if($st==0)
		  {
			$records=  $this->timeoff_actions->get_records_emp($status=array('denied'),$eidd);  
		  }
		  else
		  {
			  $records=  $this->timeoff_actions->get_records_emp($status=array('approved'),$eidd);
		  }
		   
		
		
			$this->load->library('excel');
			 
			$this->excel = new PHPExcel();
			$this->excel->setActiveSheetIndex(0);
					 //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
							$this->excel->getActiveSheet()->SetCellValue('A1', 'Request Date');
							$this->excel->getActiveSheet()->SetCellValue('B1', 'Name');
							$this->excel->getActiveSheet()->SetCellValue('C1', 'Dates');
							$this->excel->getActiveSheet()->SetCellValue('D1', 'Employee Comments');
							$this->excel->getActiveSheet()->SetCellValue('E1', 'Admin Comments');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Type/Status');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Status');
						$row=2;
						 foreach($records as $record){
							$dates=date($this->config->item('date_format'),strtotime($record['start_time'])).'-'. date($this->config->item('date_format'),strtotime($record['end_time']));
							$status =$this->lang->line(ucfirst($record['type'])).'/'. $this->lang->line(ucfirst($record['status']));
							if($record['status'] =='approved'){
								$statuss ='Approved';
							}
							else
							{
								$statuss ='Not Approved';
							}
							
								
							$this->excel->getActiveSheet()->SetCellValue('A' . $row,  $record['register_date']);
							 $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $record['name']);
							 $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $dates);
							 $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $record['employee_comment']);
							 $this->excel->getActiveSheet()->SetCellValue('E' . $row, $record['comment']);								
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $status);
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $statuss);
						$row++;							 
						 }
						 $filename= 'Leave Report';
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
	  function exportrequestlist()
	  {
		   $this->load->model('timeoff_actions');
		   // if(isset($_GET['empidd']))
		   // {
			  // $eidd= $_GET['empidd']; 
		   // }
		   // else
		   // {
			   
		   // }
		$records=  $this->timeoff_actions->get_records_request('request');
		
			$this->load->library('excel');
			 
			$this->excel = new PHPExcel();
			$this->excel->setActiveSheetIndex(0);
					 //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
							$this->excel->getActiveSheet()->SetCellValue('A1', 'Request Date');
							$this->excel->getActiveSheet()->SetCellValue('B1', 'Name');
							$this->excel->getActiveSheet()->SetCellValue('C1', 'Dates');
							$this->excel->getActiveSheet()->SetCellValue('D1', 'Employee Comments');
							$this->excel->getActiveSheet()->SetCellValue('E1', 'Admin Comments');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Type/Status');
							$this->excel->getActiveSheet()->SetCellValue('F1', 'Status');
						$row=2;
						 foreach($records as $record){
							$dates=date($this->config->item('date_format'),strtotime($record['start_time'])).'-'. date($this->config->item('date_format'),strtotime($record['end_time']));
							$status =$this->lang->line(ucfirst($record['type'])).'/'. $this->lang->line(ucfirst($record['status']));
							if($record['status'] =='approved'){
								$statuss ='Approved';
							}
							else
							{
								$statuss ='Not Approved';
							}
							
								
							$this->excel->getActiveSheet()->SetCellValue('A' . $row,  $record['register_date']);
							 $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $record['name']);
							 $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $dates);
							 $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $record['employee_comment']);
							 $this->excel->getActiveSheet()->SetCellValue('E' . $row, $record['comment']);								
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $status);
							 $this->excel->getActiveSheet()->SetCellValue('F' . $row, $statuss);
						$row++;							 
						 }
						 $filename= 'Leave Request';
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
  }
?>
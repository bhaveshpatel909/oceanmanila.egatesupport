<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_evaluation $db
 * @property CI_Session          $session
 * @property evaluation_actions          $evaluation_actions
 */
class Evaluation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('evaluations');
        $this->load->helper('url');
    }

    function index($eid=1) {
        $this->load->model('evaluation_actions');
		$this->load->model('employees_actions');
        $this->load->view('evaluation/index', array('evaluations' => $this->evaluation_actions->get_evaluations($eid), 'eid'=> $eid,'employ' => $this->employees_actions->search_employee()));
    }

    function edit_evaluation($evaluation_id = 0, $catid="") {
        $this->load->model('evaluation_actions');
		$this->load->model('discipline_actions');
        $evaluation_templates = $this->evaluation_actions->get_evaluation_templates($catid);
        $this->load->view('evaluation/evaluation_edit', array('evaluation' => $this->evaluation_actions->get_evaluation($evaluation_id), 'evaluation_templates' => $evaluation_templates, 'category' => $this->discipline_actions->get_evaluation_category(), 'cat' => $catid));
    }

    function save_evaluation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'evaluation_id', 'rules' => 'required', 'label' => 'evaluation_id'),
            array('field' => 'employee_id[]', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'evaluation_template_id', 'rules' => 'required', 'label' => $this->lang->line('Evaluation Name')),
            array('field' => 'date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
                //array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('evaluation_actions');
        $this->load->view('evaluation/evaluation_add', array('result' => $this->evaluation_actions->save_evaluation()));
    }

    function delete_evaluation() {
        $this->load->model('evaluation_actions');
        $this->evaluation_actions->delete_evaluation($this->input->post('evaluation_id'));
        $this->load->view('evaluation/evaluation_delete', array('evaluation_id' => $this->input->post('evaluation_id')));
    }

    function new_evaluation($catid="") {
        $this->load->model('evaluation_actions');
        $this->load->model('discipline_actions');
		$this->load->model('timeoff_actions');
        $evaluation_templates = $this->evaluation_actions->get_evaluation_templates($catid);
        $this->load->view('evaluation/evaluation_new', array('evaluation_templates' => $evaluation_templates,
        'emppdata' => $this->timeoff_actions->get_employee_deta(),
		'category' => $this->discipline_actions->get_evaluation_category(), 'cat' => $catid));
    }

    function preview_evaluation($evaluation_id = 0) {
        $this->load->model('evaluation_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
	
		$images = $this->settings_actions->get_setting($employee['avatar']);
        $evaluation = $this->evaluation_actions->evaluation_preview($evaluation_id);
        //PDF generating
   $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'logo' => $logo), TRUE);
  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'imgq' => $imgq), TRUE);
  $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'images' => $images), TRUE);

  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'logo' => $employee), TRUE);
  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'images' => $employee), TRUE);
  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'image' => $employee), TRUE);
  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'images' => $imgq), TRUE);
  // $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'image' => $imgq), TRUE);

	//	$html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $evaluation['fullname'])  . "_evaluation.pdf";
 
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

    //Reasons

	function preview_evaluationeditpdf($evaluation_id = 0) {
		

		
        $this->load->model('evaluation_actions');
        $this->load->model('settings_actions');
		//$evaluation = $this->evaluation_actions->evaluation_preview($evaluation_id);
		
		$evaluation = $this->evaluation_actions->get_evaluation_template($evaluation_id);
		 $logo = $this->settings_actions->get_setting('company_logo');
		
        //PDF generating
        $html = $this->load->view('evaluation/evaluation_pdfprint', array('evaluation' => $evaluation, 'logo' => $logo), TRUE);
		  // print_r($html);
		
		// die("dfgfd");
		  //$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		
        //PDF generating
        //$html = $this->load->view('evaluation/evaluation_pdfprint', array('evaluation_template' => $evaluation));
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $evaluation_id) . "_evaluation.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
    }
	
	
	
    function evaluation_templates() {
        $this->load->model('evaluation_actions');
        $this->load->view('evaluation/evaluation_templates', array('evaluation_templates' => $this->evaluation_actions->get_evaluation_templates()));
    }

    function new_evaluation_template() {
		$this->load->model('discipline_actions');
        $this->load->view('evaluation/evaluation_template_new', array('category' => $this->discipline_actions->get_evaluation_category()));
    }

    function get_evaluation_template() {
        $evaluation_template_id = $this->input->post('reason_id');
        $this->load->model('evaluation_actions');
        $data = array('evaluation_template' => $this->evaluation_actions->get_evaluation_template($evaluation_template_id));
        die(json_encode($data));
    }

    function edit_evaluation_template($evaluation_template_id = 0) {
        $this->load->model('evaluation_actions');
		$this->load->model('discipline_actions');
        $this->load->view('evaluation/evaluation_template_edit', array('evaluation_template' => $this->evaluation_actions->get_evaluation_template($evaluation_template_id), 'category' => $this->discipline_actions->get_evaluation_category()));
    }

    function save_evaluation_template() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'evaluation_template_id', 'rules' => 'required', 'label' => 'evaluation_template_id'),
            array('field' => 'evaluation_template_name', 'rules' => 'required', 'label' => $this->lang->line('evaluation_template_name')),
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('evaluation_actions');
        $this->load->view('evaluation/evaluation_template_add', array('result' => $this->evaluation_actions->save_evaluation_template()));
    }

    function delete_evaluation_template() {
        $this->load->model('evaluation_actions');
        $this->evaluation_actions->delete_evaluation_template($this->input->post('evaluation_template_id'));
        $this->load->view('evaluation/evaluation_template_delete', array('evaluation_template_id' => $this->input->post('evaluation_template_id')));
    }
    
    function employee_evaluation() {
        $this->load->view('reports/evaluation/index');
    }

    function report_evaluation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'report_category', 'rules' => 'required', 'label' => 'report_category'),
            array('field' => 'report_type', 'rules' => 'required', 'label' => 'report_type'),
            array('field' => 'start_date', 'rules' => 'required', 'label' => $this->lang->line('Start date')),
            array('field' => 'end_date', 'rules' => 'required', 'label' => $this->lang->line('End date'))
        ));

        $this->load->model('evaluation_actions');
        $this->evaluation_actions->validate_fields();

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $postData = $this->input->post();
        //_custom_debug($this->evaluation_actions->get_evaluation_report());
        $this->load->view('reports/' . $this->input->post('report_category') . '/' . $this->input->post('report_type'), array('data' => $this->evaluation_actions->get_evaluation_report(), 'postdata' => json_encode($postData)));
    }
	
	function export_evaluation_template()
	{
		$this->load->model('evaluation_actions');
	$this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Evaluation Doc Template.csv";
			//$export =$this->employees_actions->export_data();
       $query = "SELECT evaluation_templates.*,evaluation_category.name as ecategory
FROM evaluation_templates
INNER JOIN evaluation_category ON evaluation_category.id = evaluation_templates.ecatgoryid";
   
  // die("here");
       $result = $this->db->query($query);
	   // echo "<pre>";
	   // print_r($result);
	   // die("here");
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		
        force_download($filename, $data);
	}
	function import_evaluation_template()
	{
		if ($this->input->post('submit')) {
		 // echo "<pre>";
		 // print_r($_FILES);
		 // die("hdcygfadj");
		 $path = 'uploade/';
            require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if (!$this->upload->do_upload('file_name')) {
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
				
				
               // $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				echo "<pre>";
				print_R($allDataInSheet);
				die("here");
                $flag = true;
								$i=0;
				
               
                foreach ($allDataInSheet as $value) {
					
                  if($flag){
                    $flag =false;
                    continue;
                  }
				  echo "<pre>";
				  print_R($value);
				  
				  // $dataa[]=array(
				  
				  // 'id'=>$value['A'],
				 // 'name'=>$value['B'],
				  
				  // 'company_rules'=>$value['C'],
				  // 'content'=>$value['D'],
				  // 'is_active'=>$value['E'],
				  // 'remarks'=>$value['F'],
				  // 'ecatgoryid'=>$value['G'],
				  // 'score'=>$value['H'],
				  // );
				 // $inserdata[$i]['id'] = $value['A'];
				  $inserdata[$i]['name'] = $value['B'];
				  $inserdata[$i]['company_rules'] = $value['C'];
				  $inserdata[$i]['content'] = $value['D'];
				  $inserdata[$i]['is_active'] = $value['E'];
				  $inserdata[$i]['remarks'] = $value['F'];
				  $inserdata[$i]['ecatgoryid'] = $value['F'];
				  $inserdata[$i]['score'] = $value['F'];
				  $i++;
				 
				 }  
echo "<pre>";
print_r($inserdata);
die("here");				 
                $result = $this->employees_actions->importdata($dataa); 
				 if($result1){
					//echo $result;
echo"<script>alert('Imported successfully !'); window.location = 'https://hrmsegate.egatesupport.com/request/processcallingcard';
</script>";
				ECHO "SUCCESS";	
                
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
	
	
	function send_mail(){
		
	    $this->load->model('evaluation_actions');
	    $this->load->model('settings_actions');
	    $this->load->model('employees_actions');
		$evaluation_id=$_REQUEST['mid'];
		// echo $record_id;
		// Die("cxfgzxd");
		$recosrd =$this->evaluation_actions->get_evaluation($evaluation_id);
	
		
		  
	 $employee_id = $recosrd['employee_id'];
		$valueee   = $this->employees_actions->pinemp($employee_id);
		
      
		
		// echo $employee_id;
	
   $logo = $this->settings_actions->get_setting('company_logo');
	
		$images = $this->settings_actions->get_setting($employee['avatar']);
        $evaluation = $this->evaluation_actions->evaluation_preview($evaluation_id);
		
		$details = $this->settings_actions->get_settings('company');
	  // echo"<pre>";
	 $html = $this->load->view('evaluation/evaluation_preview', array('evaluation' => $evaluation, 'logo' => $logo), TRUE);
	 $company_mail= $details['company_email'];
	 $email=explode(",",$company_mail);
	 // print_R($email[0]);
	 // die("here");
	 //$len=count($email);
	 
	 // for($i=0;$i<$len;$i++)
	  //{
		
		$from=$email[0];
		$mailcontent="";
		$mailcontent .= $html;
		//$mailcontent .= '<img src ="'.base_url().'/files/logo/kiwa-korean-2-300x188.png">';
		$this->load->library('email'); 
	  $this->email->clear(TRUE);
	  $this->email->set_mailtype("html");
      $this->email->from($from);
      $userem =($valueee['email']);		 
   $subject= "Work Evaluation";
     // $this->email->to($userem);
      $this->email->to($userem);
	 
      //$ggmessage ='<br>'.$con;
      $this->email->subject($subject); 
      $this->email->message($mailcontent);
	 
	  if($this->email->send())
		
		{
			 echo $successme ="Mail Sent Successfully";
		}
   // print_r($valueee);
			// die("i m here");
   
   
	 //$this->load->view('tasks/index');
	// $url ='http://uplushrms.peza.com.ph/discipline?id='.$recosrd["employee_id"];
    // echo "<script>alert('Mail Sent Successfully!'); location.href='".$url."';</script>";
	 

	
		
	}

}
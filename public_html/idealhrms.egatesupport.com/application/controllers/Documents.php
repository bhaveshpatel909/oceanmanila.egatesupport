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
 * @property documents_actions          $documents_actions
 */
class Documents extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('documents');
    }

    function index($page_id = 1) {
        $this->load->model('documents_actions');
        $this->load->helper('fa-extension');

        $this->load->view('documents/index', array(
            'documents' => $this->documents_actions->get_documents($page_id),
            'search' => $this->input->get('search')
        ));
    }

    function cat($document_category_id = 0, $page_id = 1) {
        $this->load->model('documents_actions');
        $this->load->helper('fa-extension');
        $category = $this->documents_actions->get_document_category($document_category_id);

        $this->load->view('documents/documents', array(
            'documents' => $this->documents_actions->get_cat_documents($document_category_id, $page_id),
            'active_menu' => $category['document_category_name'],
            'category_id' => $category['document_category_id'],
            'search' => $this->input->get('search')
        ));
    }

    function edit_document($document_id = 0) {
        $this->load->model('documents_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
        $this->load->view('documents/document_edit', array(
            'document' => $this->documents_actions->get_document($document_id),
            'attachments' => $this->attachments_actions->get_attachments($document_id, 'document')
        ));
    }

    function new_document($document_category_id = 0) {
        $this->load->view('documents/document_new', array('category_id' => $document_category_id));
    }
	
function print_pdf_duco($document_id = 0) {
        $this->load->model('documents_actions');
        $this->load->model('settings_actions');
        $this->load->helper('fa-extension');
        $this->load->model('attachments_actions');
		//$document = $this->document_actions->document_preview($document_id);
         $document = $this->documents_actions->get_document2($document_id);
		 //print_r($document);
		 // echo "Hello";
		  
		 $logo = $this->settings_actions->get_setting('company_logo');
//die();
        //PDF generating
        $html = $this->load->view('documents/doc_preview', array('document' => $document, 'logo' => $logo), TRUE);
		 $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		
		 ini_set('memory_limit', '32M');
		  $pdfFilePath = str_replace(" ", "_", $document_id) . "_document.pdf";
$this->load->library('m_pdf');
 
       //generate the PDF from the given html
       $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
		
		  
		
    }
	
	
	

	
	
	

    function update_document() {
        if ((count($_POST) == 0) AND ( count($_FILES) == 0)) {
            exit($this->load->view('layout/error', array('message' => $this->lang->line('Too many files')), TRUE));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
            array('field' => 'document_category_id', 'rules' => 'required', 'label' => 'document_category_id'),
            array('field' => 'description', 'rules' => 'required', 'label' => 'description')
        ));

        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }

        $this->load->model('documents_actions');
        if (!$result = $this->documents_actions->save_document()) {
            exit($this->load->view('layout/error', array('message' => $this->documents_actions->get_error()), TRUE));
        }

        $this->load->helper('fa-extension');
        $this->load->view('documents/document_add', $result);
    }

//    function update_document() {
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules(array(
//            array('field' => 'document_id', 'rules' => 'required', 'label' => 'document_id'),
//            array('field' => 'document_category_id', 'rules' => 'required', 'label' => 'document_category_id')
//        ));
//
//        if ($this->form_validation->run() == FALSE) {
//            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
//        }
//
//        $this->load->model('documents_actions');
//        $result = $this->documents_actions->save_document();
//        if (!$result['result']) {
//            exit($this->load->view('layout/error', array('message' => $this->documents_actions->get_error()), TRUE));
//        }
//
//        $this->load->helper('fa-extension');
//        $this->load->view('documents/document_add', array('result' => $result));
//    }

    function download_document($document_id = 0) {
        $this->load->model('documents_actions');
        $this->documents_actions->download_document($document_id);
    }

    function delete_document() {
        $this->load->model('documents_actions');
        $this->documents_actions->delete_document($this->input->post('document_id'));
        $this->load->view('documents/document_delete', array('document_id' => $this->input->post('document_id')));
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }

    function find_department() {
        $this->load->model('departments_actions');
        echo json_encode($this->departments_actions->search_department());
    }

    function find_position() {
        $this->load->model('positions_actions');
        echo json_encode($this->positions_actions->search_position());
    }

    function download_attachment($attachment_id = 0) {
        $this->load->model('attachments_actions');
        $this->attachments_actions->download_attachment($attachment_id);
    }
	function email_reminder($document_id)
	{
		
		$this->load->model('documents_actions');
		$document =$this->documents_actions->get_document($document_id);
		$date_reminder=$document['date_reminder'];
		$row_date = strtotime($date_reminder);
$today = strtotime(date('Y-m-d'));
// echo $date_reminder;
// echo "<br/>";
// echo date('Y-m-d');
if($row_date >= $today)
{
	?>
	<script>
   alert('Not yet due');
		 location.href='<?php echo $url;?>';
		</script>
		<?php 
    
}
else
{
	//echo "send email";
	$this->load->model('settings_actions');
		$account =$this->settings_actions->get_accountingmail_settings();
		$to_email = $account['setting_value'];
		$subject ='Document Reminder';
		$this->load->model('settings_actions');
		$account =$this->settings_actions->get_accountingmail_settings();
		$taskmanager =$this->settings_actions->get_taskmanagergmail_settings();
		$to_email = $account['setting_value'];
		$cc_email = $taskmanager['setting_value'];
		$subject ='Document Reminder';
		
		
		$this->load->library('email'); 
		 $this->email->set_mailtype("html");
         $this->email->from('admin@peza.com.ph'); 
       $this->email->to($to_email);
        $this->email->cc('purijyoti22@gmail.com');
       // $this->email->to('purijyoti22@gmail.com');
         $this->email->subject($subject); 
         $this->email->message('Reminder email for  renew permit'); 
		   if($this->email->send()) 
		 {
			 //echo "sent";
			 $mesge ="Mail Sent Successfully";
		 }
		 else
		 {
			 $mesge= 'Not yet due';
		 }

		
		 $url = $this->config->item('base_url').'documents/index';
	?>
   <script>
   alert('Mail Sent Successfully!');
		 location.href='<?php echo $url;?>';
		</script>
		<?php
		
	 //$this->load->view('tasks/index');
	 }
	
	}
	
	function email_reminder_cron()
	{
			$this->load->model('documents_actions');
		$alldocuments =$this->documents_actions->get_alldocuments();
		// echo "<pre>";
		// print_r(alldocuments);
		// die("here");
		foreach($alldocuments as $document)
		{
			if($document['email_for_reminder']==1)
			{
				$date_reminder=$document['date_reminder'];
				$row_date = strtotime($date_reminder);
			$today = strtotime(date('Y-m-d'));
			// echo $date_reminder;
			// echo "<br/>";
			// echo date('Y-m-d');
			if($row_date >= $today)
			{
				
			}
			else
			{
				$this->load->model('settings_actions');
				$account =$this->settings_actions->get_accountingmail_settings();
				$to_email = $account['setting_value'];
				$subject ='Document Reminder';
				$this->load->model('settings_actions');
				$account =$this->settings_actions->get_accountingmail_settings();
				$taskmanager =$this->settings_actions->get_taskmanagergmail_settings();
				$to_email = $account['setting_value'];
				$cc_email = $taskmanager['setting_value'];
				$subject = $document['description'];
				
				
				$this->load->library('email'); 
				 $this->email->set_mailtype("html");
				 $this->email->from('admin@peza.com.ph'); 
			  // $this->email->to($to_email);
				//$this->email->cc('purijyoti22@gmail.com');
			    $this->email->to('purijyoti22@gmail.com');
				 $this->email->subject($subject); 
				 $this->email->message('Reminder email for  renew permit'); 
				   if($this->email->send()) 
				 {
					 //echo "sent";
					 $mesge ="Mail Sent Successfully";
				 }
				 else
				 {
					 $mesge= 'Not yet due';
				 }
				
			}
		}
		}
		
		 
	
	}
	function exportalldocument()
	{
		$this->load->model('documents_actions');
	 $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Document List .csv";
		 $compare = date('Y-m-d');
		//$export =$this->employees_actions->export_data();
        $query = "SELECT documents.document_id,documents_category.document_category_name as cname,documents.description,documents.date_reminder FROM documents

LEFT JOIN documents_category ON documents.document_category_id = documents_category.document_category_id   ";
   
  // die("here");
       $result = $this->db->query($query);
	 
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		
        force_download($filename, $data);
	}

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_petty_cash $db
 * @property CI_Session          $session
 * @property petty_actions          $petty_actions
 */
class Petty extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
		
    }

    function index() {
        $this->load->model('petty_actions');
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('petty/index', array('petty_cash_list' => $this->petty_actions->get_petty_cash_list($employee_id)));
        } else {
            $this->load->view('petty/index', array('petty_cash_list' => $this->petty_actions->get_petty_cash_list()));
        }
    }
        
    function new_petty_cash() {
        $this->load->model('petty_actions');
        $petty_items = $this->petty_actions->get_petty_items();
        $item_row = $this->load->view('petty/petty_cash_item_row', array('petty_items' => $petty_items), TRUE);
        $this->load->view('petty/petty_cash_new', array('petty_items' => $petty_items,'item_row' => json_encode($item_row),
		
		'petty_cash_listt' => $this->petty_actions->pppt()
		
		
		));
		
     
        
    }

    function edit_petty_cash($petty_cash_id = 0) {
//        $this->load->helper('fa-extension');
        $this->load->model('petty_actions');
//        $this->load->model('attachments_actions');

        $petty_items = $this->petty_actions->get_petty_items();
        $item_row = $this->load->view('petty/petty_cash_item_row', array('petty_items' => $petty_items), TRUE);
        $this->load->view('petty/petty_cash_edit', array(
            'petty_cash' => $this->petty_actions->get_petty_cash($petty_cash_id),
            'petty_items' => $petty_items,
            'item_row' => json_encode($item_row)
        ));
    }

    function save_petty_cash() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'petty_cash_id', 'rules' => 'required', 'label' => 'petty_cash_id'),
            array('field' => 'employee_id[]', 'rules' => 'required', 'label' => 'employee_id'),
            array('field' => 'petty_cash_type', 'rules' => 'required', 'label' => $this->lang->line('Petty Cash Type')),
            array('field' => 'created_date', 'rules' => 'required', 'label' => $this->lang->line('Date')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('petty_actions');
        $this->load->view('petty/petty_cash_add', array('result' => $this->petty_actions->save_petty_cash()));
    }

    function delete_petty_cash() {
        $this->load->model('petty_actions');
        $this->petty_actions->delete_petty_cash($this->input->post('petty_cash_id'));
        $this->load->view('petty/petty_cash_delete', array('petty_cash_id' => $this->input->post('petty_cash_id')));
    }

    function preview_petty_cash($petty_cash_id = 0) {
        $this->load->model('petty_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $petty_cash = $this->petty_actions->preview_petty_cash($petty_cash_id);
        //PDF generating
        $html = $this->load->view('petty/petty_cash_preview', array('petty_cash' => $petty_cash, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $task['employee_name']) . "_petty_cash.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
	function print_petty_cash($petty_cash_id = 0) {
        $this->load->model('petty_actions');
        $this->load->model('settings_actions');
        $logo = $this->settings_actions->get_setting('company_logo');
        $petty_cash = $this->petty_actions->preview_petty_cash($petty_cash_id);
        //PDF generating
        $html = $this->load->view('petty/petty_cash_print', array('petty_cash' => $petty_cash, 'logo' => $logo), TRUE);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="😉" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $task['employee_name']) . "_petty_cash.pdf";

        //load mPDF library
		$param = array(
            'mode' => 'en-GB-x',
           'format' => 'utf-8', '[75, 205]-L',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 16,
            'margin_bottom' => 2,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'L'
        );
       $this->load->library('m_pdf', $param);

        //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

    function find_employee() {
        $this->load->model('employees_actions');
        echo json_encode($this->employees_actions->search_employee());
    }
	function save_comment_petty()
	{
		 $this->load->model('petty_actions');
		  $petty_cash = $this->petty_actions->save_petty_comment();
		  
			  echo "Comment Added Successfully";
		  //}
	}
    
function  export_excel(){
	
	 $year= $_POST['yr'];
 $month= $_POST['mth'];
	//die('fasjlk');
	
	  $this->load->model('petty_actions');
	$this->load->library('excel');
	  // echo "<pre>";
	  // print_r($this->excel);
	  $this->excel = new PHPExcel(); 
     $data = $this->petty_actions->get_petty_cash_list_export($year,$month);
     $this->excel->setActiveSheetIndex(0);
     //$this->excel->getActiveSheet()->setTitle(lang('Supplier\'s Proposal'));
            $this->excel->getActiveSheet()->SetCellValue('A1', 'Date');
            $this->excel->getActiveSheet()->SetCellValue('B1', 'Description');
            $this->excel->getActiveSheet()->SetCellValue('C1', 'Company');
            $this->excel->getActiveSheet()->SetCellValue('D1', 'TIN No');
            $this->excel->getActiveSheet()->SetCellValue('E1', 'Total');
           
              
				 $row = 2;
                foreach ($data as $data_row) {
					// echo "<pre>";
					// print_r($data);
                    $this->excel->getActiveSheet()->SetCellValue('A' . $row, $data_row['created_date']);
                     $this->excel->getActiveSheet()->SetCellValue('B' . $row,  $data_row['description']);
                     $this->excel->getActiveSheet()->SetCellValue('C' . $row,  $data_row['company']);
                    $this->excel->getActiveSheet()->SetCellValue('D' . $row,  $data_row['tin_no']);
                     $this->excel->getActiveSheet()->SetCellValue('E' . $row, $data_row['total']);
                  
                     $row++;
                 }

               
            $filename= 'Pettycash Detail';
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
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
class Checkwriter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_actions');
        $this->user_actions->is_loged_in('tasks');
        $this->load->helper('url');
    }

    function index() {
        $this->load->model('checkwriter_actions');
		
        if ($this->user_actions->is_selfservice()) {
            $employee_id = $this->session->current->userdata('employee_id');
            $this->load->view('checkwriter/index', array('checkwriter_list' => $this->checkwriter_actions->checkwriter_list(),
			'bankaccountlist'=>$this->checkwriter_actions->bankaccount_list()));
        } else {
            $this->load->view('checkwriter/index', array('checkwriter_list' => $this->checkwriter_actions->checkwriter_list(),
			'bankaccountlist'=>$this->checkwriter_actions->bankaccount_list()));
        }
    }
        
    function new_checkwriter() {
        $this->load->model('checkwriter_actions');
        $this->load->model('petty_actions');
        $this->load->model('banklist_actions');
		$petty_items = $this->petty_actions->get_petty_items();
        $item_row = $this->load->view('checkwriter/checkwriter_item_row', array('petty_items' => $petty_items), TRUE);
       $banklist = $this->banklist_actions->bank_list();
       
        $this->load->view('checkwriter/checkwriter_new',array("banklist"=>$banklist,'petty_items' => $petty_items,'item_row' => json_encode($item_row)));
		
     
        
    }

    function edit_checkwriter($checkwriter_id = 0) {
//        $this->load->helper('fa-extension');
       $this->load->model('checkwriter_actions');
       $this->load->model('petty_actions');
//        $this->load->model('attachments_actions');

       $this->load->model('banklist_actions');
       $banklist = $this->banklist_actions->bank_list();
	   $petty_items = $this->checkwriter_actions->get_petty_items();
        $item_row = $this->load->view('checkwriter/checkwriter_item_row', array('petty_items' => $petty_items), TRUE);
        
        $this->load->view('checkwriter/checkwriter_edit', array(
            'checkwriterlist' => $this->checkwriter_actions->get_checkwriter($checkwriter_id),
            'banklist' => $banklist,
			'petty_items' => $petty_items,
            'item_row' => json_encode($item_row)
            
        ));
    }

    function save_checkwriter() {
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules(array(
            array('field' => 'created_date', 'rules' => 'required', 'label' => 'petty_cash_id'),
            array('field' => 'payto', 'rules' => 'required', 'label' => 'payto'),
            array('field' => 'ca_no', 'rules' => 'required', 'label' => $this->lang->line('Check No')),
            array('field' => 'bank_name', 'rules' => 'required', 'label' => $this->lang->line('Bank Name')),
            array('field' => 'expense', 'rules' => 'required', 'label' => $this->lang->line('Amount')),
//            array('field'=>'description','rules'=>'required','label'=>$this->lang->line('Description'))
        ));
        // echo "<pre>";
        // print_r($_POST);
        // die();
        if ($this->form_validation->run() == FALSE) {
            exit($this->load->view('layout/error', array('message' => $this->form_validation->error_string()), TRUE));
        }
        $this->load->model('checkwriter_actions');
        $this->load->view('checkwriter/checkwriter_add', array('result' => $this->checkwriter_actions->save_checkwriter()));
    }

    function delete_checkwriter() {
        $this->load->model('checkwriter_actions');
        $this->checkwriter_actions->delete_checkwriter($this->input->post('checkwriter_id'));
        $this->load->view('checkwriter/checkwriter_delete', array('checkwriter_id' => $this->input->post('checkwriter_id')));
    }

     function printcheck($checkwriterid = 0) {
        $this->load->model('checkwriter_actions');
      
        $cherwriterdaa = $this->checkwriter_actions->print_check($checkwriterid);
		// echo "<pre>";
		// print_R($cherwriterdaa);
		
			//echo $amount= $checkwriter[0]['expense'];
			//echo this->checkwriter_actions->convert_number_to_words($amount);
		

        $data = array(
            'cherwriterdaa' => array('cherwriterdaa' => $cherwriterdaa)
            
        );
        //PDF generating
      $html= $this->load->view('checkwriter/checkwriter_print', $data,True);
        ini_set('memory_limit', '32M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="ðŸ˜‰" draggable="false" class="emoji">
        //this the the PDF filename that user will get to download
        $pdfFilePath = str_replace(" ", "_", $checkwriter[0]['check_date']) . "_check.pdf";

        //load mPDF library
        $param = array(
            'mode' => 'en-GB-x',
           'format' => 'utf-8', '[75, 205]-L',
            'font_size' => 0,
            'font_default' => '',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 9,
            'margin_bottom' => 9,
            'margin_header' => 9,
            'margin_footer' => 9,
            'oriental' => 'L'
        );
        $this->load->library('m_pdf', $param);
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->rotate(270);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }
	function getlistaccount()
	{
		
		 $accountno = $_GET['accountno'];
		//die("dsaf");
		$this->load->model('checkwriter_actions');
		 $cherwriterdaa = $this->checkwriter_actions->getaccountlist($accountno);
		 // echo "<pre>";
		 // print_R($cherwriterdaa);
		 $total = $cherwriterdaa['total'];
		$expense = $deposit = $balance = 0;
		$petty_cash=array();
		 foreach ($cherwriterdaa['arraydata'] as $key=>$cherwriter) {
			//array_sum($cherwriter['amount']);
			
                                        
             $petty_cash[$key][$cherwriter['check_cash_type']] = str_replace(',','',$cherwriter['amount']);
                                           
										
										
		 }
		 $expense =0;
		 $deposit =0;
		 $balance =0;
		foreach($petty_cash as $item)
		{
			
			
			$expense += $item['expense'];
			
			
			$deposit += $item['deposit'];
			
	}
	
		// echo $expense;
		// echo "<br/>";
		// echo $deposit ;
		 $balance =  $deposit-$expense;
		
		
		// if ($petty_cash['petty_cash_type'] == 'expense') {
                                            // $petty_cash['expense'] = $petty_cash['total'];
                                            // $petty_cash['deposit'] = 0;
                                            // $expense += $petty_cash['total'];
                                            // $balance = $balance - $petty_cash['total'];
                                        // } else {
                                            // $petty_cash['expense'] = 0;
                                            // $petty_cash['deposit'] = $petty_cash['total'];
                                            // $deposit += $petty_cash['total'];
                                            // $balance = $balance + $petty_cash['total'];
                                        // }
				echo $expense.'$$'.$deposit.'$$'.$balance;					
		
	}
 
    
    
}

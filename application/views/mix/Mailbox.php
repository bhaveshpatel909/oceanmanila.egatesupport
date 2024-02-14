<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property mailbox_actions          $mailbox_actions
    * @property user_actions          $user_actions
    * @property employees_actions          $employees_actions
    */
  
  class Mailbox extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
		  $this->load->model('settings_actions');
          $this->user_actions->is_loged_in('selfservice');
      }
      
      function index()
      {
          $this->load->model('mailbox_actions');
          $this->load->view('mailbox/index',array('threads'=>$this->mailbox_actions->get_threads()));
      }
      
      function threads($page_id=0)
      {
          $this->load->model('mailbox_actions');
          $this->load->view('mailbox/threads',array('threads'=>$this->mailbox_actions->get_threads($page_id)));
      }
      
      function thread($thread_id=0)
      {
          $this->load->model('mailbox_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('mailbox/thread',array('thread'=>$this->mailbox_actions->get_thread($thread_id)));
      }
      
      function send_message()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE));
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'thread_id','rules'=>'required','label'=>'thread_id'),
            array('field'=>'message','rules'=>'required','label'=>$this->lang->line('message'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('mailbox_actions');
          $this->load->helper('fa-extension');
          
          $this->load->view('mailbox/new_message',array(
            'message'=>$this->mailbox_actions->get_message($this->mailbox_actions->send_message())
          ));
      }
      
      function messages($thread_id=0,$page_id=0)
      {
          $this->load->model('mailbox_actions');
          if (!$this->mailbox_actions->is_allowed($thread_id))
          {
              exit();
          }
          $this->load->helper('fa-extension');
          $this->load->view('mailbox/messages',$this->mailbox_actions->get_messages($thread_id,$page_id));
      }
      
      function remove_message($message_id=0)
      {
          $this->load->model('mailbox_actions');
          $this->mailbox_actions->remove_message($message_id);
      }
      
      function compose_mail()
      {
          $this->load->view('mailbox/compose_mail');
      }
      
	  function compose_adminmail()
      {
          $this->load->view('mailbox/compose_adminmail');
      }
	  function set_upload_options()
		{   
		//upload an image options
		$config = array();
		$config['upload_path'] = './files/attachments/mailtoadmin/';
		$config['allowed_types'] = '';
		$config['min_size']      = '0';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
		}
	  
	  
	  function send_mailtoadmin()
	  { 
		  $this->load->library('email'); 
		  $this->load->library('upload');
		  $dataInfo = array();
		  $files = $_FILES;
		  $cpt = count($_FILES['new_attachments']['name']);
      for($i=0; $i<$cpt; $i++)
      {           
        $_FILES['new_attachments']['name']= $postData['Title'].'_'.$files['new_attachments']['name'][$i];
        $_FILES['new_attachments']['type']= $files['new_attachments']['type'][$i];
        $_FILES['new_attachments']['tmp_name']= $files['new_attachments']['tmp_name'][$i];
        $_FILES['new_attachments']['error']= $files['new_attachments']['error'][$i];
        $_FILES['new_attachments']['size']= $files['new_attachments']['size'][$i];    

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo[] = $this->upload->data();
		
       }
echo'<pre>';print_r($files);die('jhjhjhjhjhjhj');
		  
		  
		  $this->load->model('employees_actions');
          $adm=$this->employees_actions->admin_info();
		 // echo $adm['email'];die('ghghgh');
		  
		  $mail=$_POST['employees'];
		  $subject=$_POST['subject'];
		  $message=$_POST['message'];
		
		  
			$from ="upluscorporation@gmail.com";
			$this->load->library('email'); 
			$this->email->clear(TRUE);
			$this->email->set_mailtype("html");
			$this->email->from($from); 
       

            
		$this->email->to($adm['email']);
		$ggmessage ='<br>'.$_POST['message'];
		$this->email->subject($subject); 
        $this->email->message($ggmessage);
		 
		
		foreach($files as $valueat) {

		$this->email->attach($valueat['name']);
		 
		
		//$this->email->attach($valueat['name'], 'attachment', $file);
		 }

		$this->email->send();	
		 }
	  
      function create_thread()
      {
          if ((count($_POST)==0) AND (count($_FILES)==0))
          {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('Too many files')),TRUE));
          }
          
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'message','rules'=>'required','label'=>$this->lang->line('Message')),
            array('field'=>'subject','rules'=>'required','label'=>$this->lang->line('Subject'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('mailbox_actions');
          if (!$thread_id=$this->mailbox_actions->create_thread())
          {
              exit($this->load->view('layout/error',array('message'=>$this->mailbox_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Sent')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'mailbox/thread/'.$thread_id));
      }
      
      function find_admin()
      {
   $this->load->model('employees_actions');
      
           $details = $this->employees_actions->admin_info();
            
   
		 $this->load->view('mailbox/compose_adminmail');
      }
      function find_employee()
      {
          $this->load->model('employees_actions');
          echo json_encode($this->employees_actions->search_employee());
      }
      
      function find_department()
      {
          $this->load->model('departments_actions');
          echo json_encode($this->departments_actions->search_department());
      }
      
      function find_position()
      {
          $this->load->model('positions_actions');
          echo json_encode($this->positions_actions->search_position());
      }
  }
?>
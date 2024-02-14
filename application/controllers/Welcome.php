<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ini_set('display_errors', 1);
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property install_actions          $install_actions
    */
  class Welcome extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->language('welcome');
          $this->load->helper('url');
          $this->load->model('install_actions');
          $this->load->helper('cookie');
          if (!$this->install_actions->is_installed())
          {
              if (!$this->install_actions->check_compability())
              {
                  exit($this->load->view('install/errors',array(
                    'errors'=>$this->install_actions->get_error()
                  ),TRUE));
              }
              header('Location:'.preg_replace(array('/welcome/','/\/$/','/\/\?/'),array('install','/install','/install?'),$_SERVER['REQUEST_URI']));
              exit();
          }
      }
      
      function index()
      {
          
          $this->load->model('settings_actions');
          //print_r($this->input->cookie('remember_me',true));die;
          $logo = $this->settings_actions->get_setting('company_logo');
          $this->load->view('welcome/login',array('company_name'=>$this->settings_actions->get_setting('company_name'),'logo' => $logo, 'message' => ''));    
      }
      
      function check_user()
      {

        $remember = $this->input->post('remember_me');
        $credential = array();
        $credential['username'] = $this->input->post('username');
        $credential['password'] = $this->input->post('password');
        //delete_cookie('remember_me_username');
        //delete_cookie('remember_me_password');

        
        


		  
	$user_ip = $_POST['user_ip'];
		  
		  
		// echo'<pre>';
		// print_r($_POST);
		// echo'</pre>';
		// die('rfklj');
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'username','rules'=>'required|valid_email|max_length[50]','label'=>$this->lang->line('Username')),
            array('field'=>'password','rules'=>'required','label'=>$this->lang->line('Password')) 
			
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('user_actions');
          if (!$this->user_actions->check_user())
          {
              //exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
              $this->session->set_flashdata('message',$this->user_actions->get_error());
              redirect($this->config->item('base_url'));
          } else{
            if($remember){
              setcookie('remember_me_username',$credential['username'],time()+60*60*24*30);
              setcookie('remember_me_password',$credential['password'],time()+60*60*24*30);
              setcookie('remember_me_check','1',time()+60*60*24*30);
            }else{
              setcookie('remember_me_username',"");
              setcookie('remember_me_password',"");
              setcookie('remember_me_check','0');
            }
            //print_r($this->session->userdata());
            redirect($this->config->item('base_url').'dashboard');
          }
          
          
//          $this->load->view('layout/success',array('message'=>$this->lang->line('Going to dashboard')));
//          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'dashboard'));
      }
      
      function forgot_password()
      {
          $this->load->view('welcome/password_forgot');
      }
      
      function get_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'user_email','rules'=>'required|valid_email','label'=>$this->lang->line('Your email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('user_actions');
          if (!$this->user_actions->forgot_password())
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('Confirmation email was sent')));
      }
      
      function set_password($code='')
      {
          $this->load->model('user_actions');
          if (!$this->user_actions->check_code($code,'password'))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->view('welcome/login',array('code'=>$code));
      }
      
      function new_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
            array('field'=>'code','rules'=>'required','label'=>'code'),
            array('field'=>'new_password','rules'=>'required','label'=>$this->lang->line('New password')),
            array('field'=>'password_again','rules'=>'required','label'=>$this->lang->line('Password again'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('user_actions');
          if (!$this->user_actions->set_new_password())
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          $this->load->view('welcome/close_modal');
      }




      function getCookieDetails(){

        $arr = array('username'=>$this->input->cookie('remember_me_username',TRUE),'password'=>$this->input->cookie('remember_me_password',TRUE),'remember_check'=> $this->input->cookie('remember_me_check',TRUE));

        echo json_encode($arr);
        // print_r($this->input->cookie('remember_me_username',TRUE));
        // print_r($this->input->cookie('remember_me_password',TRUE));
      }
  }
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property mix_actions          $mix_actions
    */
  
  class Processing_errors extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('admin');
      }
      
      function index()
      {
          $this->load->model('mix_actions');
          $this->load->view('settings/processing_errors',array('errors'=>$this->mix_actions->get_processing_errors()));
      }
      
      function delete_errors()
      {
          $this->load->model('mix_actions');
          $this->mix_actions->delete_processing_errors();
      }
  }
?>
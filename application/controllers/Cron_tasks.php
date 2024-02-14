<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_active_record $db
 * @property CI_Session          $session
 * @property cron_actions          $cron_actions
 */
class Cron_tasks extends CI_Controller {

    function __construct() {
        parent::__construct();
        /*if (!$this->input->is_cli_request()) {
            exit();
        }*/
        $this->load->model('cron_actions');
    }

    function send_notifications() {
        
        $this->cron_actions->send_notifications();
    }
    
    function update_punclock() {
        /*if (!$this->input->is_cli_request()) {
            echo 'Only run con commandline';
            exit();
        }*/
        $schedue_time = strtotime(date('Y-m-d 23:00:00'));
        $now = strtotime(date('Y-m-d H:i:s'));
        if($now >= $schedue_time) {
            $this->cron_actions->update_punclock();
        }
    }

}

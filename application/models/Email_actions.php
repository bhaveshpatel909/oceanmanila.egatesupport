<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 * @property CI_Email          $email
 * @property settings_actions          $settings_actions
 */
class Email_actions extends Base_model {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        //$config['protocol'] = 'sendmail';
        //$config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $this->load->model('settings_actions');
        $email_settings = $this->settings_actions->get_settings('email');

        $this->email->protocol = $email_settings['email_method'];
        if ($email_settings['email_method'] == 'smtp') {
            $email_settings['smtp_server'] = explode(':', $email_settings['smtp_server']);
            $this->email->smtp_host = $email_settings['smtp_server'][0];
            if (count($email_settings['smtp_server']) > 1) {
                $this->email->smtp_port = $email_settings['smtp_server'][1];
            }

            $this->email->smtp_user = $email_settings['smtp_username'];
            $this->email->smtp_pass = $email_settings['smtp_password'];
        }
        $this->email->from($email_settings['smtp_username'], $this->settings_actions->get_setting('company_name'));
    }

    function send_email($to, $subject, $message) {
        $this->email->to(array($to));
        $this->email->subject($subject);
        $this->email->message($message);

        $send_result = $this->email->send();
        if (!$send_result) {
            $this->set_error($this->email->_debug_msg[0]);
        }

        return $send_result;
    }

}

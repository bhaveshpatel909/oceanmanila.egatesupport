<?php

/**
 * @property CI_Loader           $load
 * @property CI_Form_validation  $form_validation
 * @property CI_Input            $input
 * @property CI_DB_query_builder $db
 * @property CI_Session          $session
 * @property CI_Email          $email
 * @property settings_actions          $settings_actions
 * @property email_actions          $email_actions
 */
class Cron_actions extends Base_model {

    function send_notifications() {
        $busy_by = rand(0, 255);

        $this->db
                ->limit(20)
                ->update('events', array('busy_by' => $busy_by), array('event_type' => 'message', 'busy_by' => 0));

        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }

        $this->load->model('email_actions');
        $events = $this->db
                ->select('event_id,recipient_id,name,email,message,subject')
                ->join('employees', 'employees.employee_id = events.recipient_id', 'LEFT')
                ->join('mailbox_messages', 'mailbox_messages.message_id = events.event_source', 'LEFT')
                ->join('mailbox', 'mailbox.thread_id = mailbox_messages.thread_id', 'LEFT')
                ->where('busy_by', $busy_by)
                ->where('email IS NOT NULL', NULL, FALSE)
                ->get('events')
                ->result_array();

        $this->load->language('cron');

        $processed_events = array(0);
        foreach ($events as $event) {
            if (!$this->email_actions->send_email($event['email'], sprintf($this->lang->line('New message in "%s"'), $event['subject']), sprintf($this->lang->line('<h2>%s</h2>You got a new message in "%s".<p>%s</p>'), $event['name'], $event['subject'], $event['message']))) {
                $this->db->insert('processing_errors', array(
                    'error_text' => $this->email_actions->get_error(),
                    'error_date' => date('Y-m-d H:i:s'),
                    'error_type' => 'mail'
                ));
                $this->db->update('events', array('has_error' => 1), array('event_id' => $event['event_id']));
            } else {
                $processed_events[] = $event['event_id'];
            }
        }

        $this->db
                ->where_in('event_id', $processed_events)
                ->delete('events');
    }

    function update_punclock() {
        $default_time = date('Y-m-d 17:00:00');
        $sql = "UPDATE punch_clock SET end_time = IF(end_time IS NULL, '$default_time', end_time)";
        
        if ($this->db->query($sql)) {
            //echo "Success!";
        } else {
            //echo "Query failed!" . $this->db->last_query();
        }
    }

}

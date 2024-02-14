<?php

/**
 * _custom_debug()
 * 
 * is used to debug
 * @access	public
 * @return	object 
 */
function _custom_debug($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function get_document_category() {
    $CI = & get_instance();
    $categories = $CI->db->select('*')->get('documents_category')->result_array();
    return $categories;
}

/**
 * array_sort_by_column()
 * 
 * is used to sort multi dimension array
 * @access	public
 * @return	array 
 */
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

// Date Utilities
//----------------------------------------------------------------------------------------------
// Parses a string into a DateTime object, optionally forced into the given timezone.
function parseDateTime($string, $timezone = null) {
    $date = new DateTime(
            $string, $timezone ? $timezone : new DateTimeZone('UTC')
            // Used only when the string is ambiguous.
            // Ignored if string has a timezone offset in it.
    );
    if ($timezone) {
        // If our timezone was ignored above, force it.
        $date->setTimezone($timezone);
    }
    return $date;
}

// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
    return new DateTime($datetime->format('Y-m-d'));
}

function get_tasks_number() {
    $CI = & get_instance();
   // if ($CI->user_actions->is_selfservice()) {
	if (!$CI->user_actions->is_allowed('tasks')) {
        $employee_id = $CI->session->current->userdata('employee_id');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.status!=' => 'completed'));
        $tasks_number['all'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.status' => 'unassigned'));
        $tasks_number['unassigned'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.status' => 'assigned'));
        $tasks_number['assigned'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.task_regular' => 1));
        $tasks_number['regular'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.status' => 'completed'));
        $tasks_number['completed'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.task_attention ' => 'required', 'tasks.employee_id !=' => ''));
        $tasks_number['attention_required'] = $CI->db->count_all_results('tasks');
        
        $CI->db->where(array('tasks.employee_id' => $employee_id));
        $CI->db->where(array('tasks.task_attention ' => 'updated', 'tasks.employee_id !=' => ''));
        $tasks_number['attention_updated'] = $CI->db->count_all_results('tasks');
    } else {
        $CI->db->where(array('tasks.status!=' => 'completed'));
        $tasks_number['all'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.status' => 'unassigned'));
        $tasks_number['unassigned'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.status' => 'assigned'));
        $tasks_number['assigned'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.task_regular' => 1));
        $tasks_number['regular'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.status' => 'completed'));
        $tasks_number['completed'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.task_attention ' => 'required', 'tasks.employee_id !=' => ''));
        $tasks_number['attention_required'] = $CI->db->count_all_results('tasks');
        $CI->db->where(array('tasks.task_attention ' => 'updated', 'tasks.employee_id !=' => ''));
        $tasks_number['attention_updated'] = $CI->db->count_all_results('tasks');
    }
    return $tasks_number;
}

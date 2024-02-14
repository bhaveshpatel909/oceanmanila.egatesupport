<?php  defined('BASEPATH') OR exit('No direct script access allowed');

if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['discipline_actions']= array (
    array('name'=>'Attendance', 'children' => array(
        array('name' => 'Late', 'children' => array()),
        array('name' => 'Absent', 'children' => array()),
    )),
    array('name'=>'Attitude', 'children' => array()),
    array('name'=>'Work Performance', 'children' => array()),
    
    );
$config['task_status'] = array(
    'unassigned' => 'Unassigned'
);
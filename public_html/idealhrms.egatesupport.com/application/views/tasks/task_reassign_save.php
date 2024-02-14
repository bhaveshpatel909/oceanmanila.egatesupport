<?php 
$html = ' Click <a href="tasks/index/">here</a> to back to tasks list. ';
if (is_numeric($result)){    
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added.') . $html));?>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated.') . $html));?>
    
<?php }?>
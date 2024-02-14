<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));
    $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'recruiting/vacancy/'.$result));
    }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
<?php }?>
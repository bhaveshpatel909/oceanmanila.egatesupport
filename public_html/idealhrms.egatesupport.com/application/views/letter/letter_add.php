<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            $('#letter_id').val(<?= $result?>);
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
<?php }?>
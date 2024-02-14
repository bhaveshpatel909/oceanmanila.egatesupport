<script>
    $('document').ready(function(){
        $("#save_result").html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Done')))?>');
        $("#new_password_window").modal('hide');
    })
</script>
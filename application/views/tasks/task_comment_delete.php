<script>
    $('document').ready(function(){
        $("#save_result").html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Deleted')))?>');
        
        $("#task_comment_" + '<?= $task_comment_id?>').remove();
    });
</script>
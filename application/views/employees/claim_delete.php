<script>
    $('document').ready(function(){
        $("#save_result").html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Deleted')))?>');
        $("#modal_window").modal('hide');
        $('#claim_<?= $claim_id?>').remove();
		location.reload();
    })
</script>
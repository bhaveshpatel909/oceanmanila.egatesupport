<script>
    $('document').ready(function(){
        $("#save_result").html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Deleted')))?>');
        $("#modal_window").modal('hide');
        $('#assetbenefit_<?= $assetbenefit_id?>').remove();
		location.reload();
    })
</script>
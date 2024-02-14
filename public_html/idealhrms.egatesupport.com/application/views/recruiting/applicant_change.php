<script>
    $('document').ready(function(){
        var row = $('tbody tr[entity_id='+$('#applicant_id').val()+']').get(0);
        current_table.fnUpdate('<?= $status?>',row,1);
        
        <?php if (!is_numeric($result)){?>
        $('#save_result').html('<?= $this->load->view('layout/success',array('message'=>$this->lang->line('Changed')),TRUE)?>');
        $("#modal_window").modal('hide');
        <?php }?>
    })
</script>
<?php if (is_numeric($result)){
    $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'employees/edit_employee/'.$result));
    $this->load->view('layout/success',array('message'=>$this->lang->line('Changed')));
}?>
<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Applied')))?>
<script>
    $('document').ready(function(){
        var row = $('tbody tr[entity_id='+$('#vacancy_id').val()+']').get(0);
        current_table.fnUpdate('-',row,2);
        current_table.fnUpdate('<?= $this->lang->line('Active')?>',row,1);
    })
</script>
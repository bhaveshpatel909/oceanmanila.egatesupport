<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([''+($('#request_id option:selected').text()?$('#department_id option:selected').text():'')+''+$("#request_name").val(),'<a href="settings/edit_request/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('.request_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#request_id').val()+']').get(0);
            current_table.fnUpdate(''+($('#request_id option:selected').text()?$('#request_id option:selected').text():'')+''+$("#request_name").val(),row,0);
        })
    </script>
<?php }?>
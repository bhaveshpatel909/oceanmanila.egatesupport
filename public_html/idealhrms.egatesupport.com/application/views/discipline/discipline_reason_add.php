<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([<?= $result?>,$("#discipline_reason_name").val(),$("#discipline_reason_category").val(),$('#discipline_reason_remarks').val(),'<a href="discipline/edit_discipline_reason/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success btn-xs"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#discipline_reason_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#discipline_reason_id').val()+']').get(0);
            current_table.fnUpdate($("#discipline_reason_id").val(),row,0);
            current_table.fnUpdate($('#discipline_reason_name').val(),row,1);
            current_table.fnUpdate($('#discipline_reason_category').val(),row,2);
            current_table.fnUpdate($('#discipline_reason_remarks').val(),row,3);
        })
    </script>
<?php }?>
<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([<?= $result?>,$("#evaluation_template_name").val(),$('#evaluation_template_category').val(),$('#evaluation_template_remarks').val(),'<a href="evaluation/edit_evaluation_template/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#evaluation_template_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#evaluation_template_id').val()+']').get(0);
            current_table.fnUpdate($("#evaluation_template_id").val(),row,0);
            current_table.fnUpdate($('#evaluation_template_name').val(),row,1);
            current_table.fnUpdate($('#evaluation_template_category').val(),row,2);
            current_table.fnUpdate($('#evaluation_template_remarks').val(),row,3);
        })
    </script>
<?php }?>
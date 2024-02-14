<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData(['['+($('#department_id option:selected').text()?$('#department_id option:selected').text():'-')+']'+$("#department_name").val(),'<a href="settings/edit_department/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('.department_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#department_id').val()+']').get(0);
            current_table.fnUpdate('['+($('#department_id option:selected').text()?$('#department_id option:selected').text():'-')+']'+$("#department_name").val(),row,0);
        })
    </script>
<?php }?>
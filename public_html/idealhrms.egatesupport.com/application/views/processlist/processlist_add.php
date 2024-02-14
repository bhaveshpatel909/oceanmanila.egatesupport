<?php 
$html = ' Click <a href="processlist/index/">here</a> to back to vendor list. ';
if (is_numeric($result)){    
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added.') . $html));?>
    <script>
        $('document').ready(function(){
//            row = current_table.fnAddData([<?= $result?>,$("#task_status_name").val(),'<a href="settings/edit_task_status/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
//            oSettings = current_table.fnSettings();
//            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
//            $('#task_status_id').val(<?= $result?>);
            
           
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated.') . $html));?>
    <script>
        $('document').ready(function(){
//            var row = $('tbody tr[entity_id='+$('#task_status_id').val()+']').get(0);
//            //var updateData = [$("#form_name").val(),'<a href="settings/edit_task_status/"'+$("#form_id").val()+'  data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>'];
//            current_table.fnUpdate($("#task_status_id").val(),row,0);
//            current_table.fnUpdate($("#task_status_name").val(),row,1);
            
           
        });
    </script>
<?php }?>
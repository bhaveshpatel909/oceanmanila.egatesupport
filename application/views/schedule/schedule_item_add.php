<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            var color_label = '<span class="label" style="background-color: '+$("#schedule_item_color").val()+'">'+$("#schedule_item_color").val()+'</span>'
            row = current_table.fnAddData([<?= $result?>,$("#schedule_item_name").val(),color_label,'<a href="settings/edit_schedule_item/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#schedule_item_id').val(<?= $result?>);
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#schedule_item_id').val()+']').get(0);
            //var updateData = [$("#form_name").val(),'<a href="settings/edit_schedule_item/"'+$("#form_id").val()+'  data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>'];
            current_table.fnUpdate($("#schedule_item_id").val(),row,0);
            current_table.fnUpdate($("#schedule_item_name").val(),row,1);
            var color_label = '<span class="label" style="background-color: '+$("#schedule_item_color").val()+'">'+$("#schedule_item_color").val()+'</span>'
            current_table.fnUpdate(color_label,row,2);
            
        });
    </script>
<?php }?>
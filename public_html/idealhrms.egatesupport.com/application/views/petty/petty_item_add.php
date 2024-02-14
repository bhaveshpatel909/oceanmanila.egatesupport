<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([<?= $result?>,$("#petty_item_name").val(),'<a href="settings/edit_petty_item/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#petty_item_id').val(<?= $result?>);
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#petty_item_id').val()+']').get(0);
            //var updateData = [$("#form_name").val(),'<a href="settings/edit_petty_item/"'+$("#form_id").val()+'  data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>'];
            current_table.fnUpdate($("#petty_item_id").val(),row,0);
            current_table.fnUpdate($("#petty_item_name").val(),row,1);
            
        });
    </script>
<?php }?>
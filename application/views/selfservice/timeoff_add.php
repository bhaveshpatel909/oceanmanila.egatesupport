<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([$("#start_time").val()+' - '+$('#end_time').val(),$('#type option:selected').text()+' / <?= $this->lang->line('Request')?>','<a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="dashboard/timeoff/<?= $result?>"><i class="fa fa-briefcase"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('.record_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#record_id').val()+']').get(0);
            current_table.fnUpdate($("#start_time").val()+' - '+$('#end_time').val(),row,0);
            current_table.fnUpdate($('#type option:selected').text()+' / <?= $this->lang->line('Request')?>',row,1);
        })
    </script>
<?php }?>
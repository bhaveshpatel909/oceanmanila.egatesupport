<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            var name=employee_id.getSelection();
            var empid=empid.getSelection();
            name=name[0].name.split('[')[0];
            empid=empid[0].empid.split('[')[0];
            row = current_table.fnAddData([name,$("#start_time").val()+' - '+$('#end_time').val(),$('#type option:selected').text()+' / <?= $this->lang->line('Approved')?>','<a class="btn btn-outline btn-success" href="timeoff/edit_record/<?= $result?>"><i class="fa fa-edit"></i></a>']);
			
			row1 = current_table.fnAddData([empid,$("#start_time").val()+' - '+$('#end_time').val(),$('#type option:selected').text()+' / <?= $this->lang->line('Approved')?>','<a class="btn btn-outline btn-success" href="timeoff/edit_record/<?= $result?>"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('.record_id').val(<?= $result?>);
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
			location.reload();
            var row = $('tbody tr[entity_id='+$('#record_id').val()+']').get(0);
            current_table.fnUpdate($("#start_time").val()+' - '+$('#end_time').val(),row,1);
            current_table.fnUpdate($('#type option:selected').text()+' / '+$(row).attr('status'),row,2);
        
	
            var row1 = $('tbody tr[entity_id='+$('#record_id').val()+']').get(0);
            current_table.fnUpdate($("#start_time").val()+' - '+$('#end_time').val(),row,1);
            current_table.fnUpdate($('#type option:selected').text()+' / '+$(row).attr('status'),row1,2);
        })
    </script>
<?php }?>
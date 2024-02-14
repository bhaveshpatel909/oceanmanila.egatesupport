<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([$("#assessment_name").val(),$('#assessment_date').val(),$('#assessment_department option:selected').text(),'<a href="skills/edit_assessment/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a class="btn btn-outline btn-success" href="skills/set_assessments/<?= $result?>"><i class="fa fa-tasks"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('.assessment_id').val(<?= $result?>);
            $('#assessment_department_area').remove();
        })
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#assessment_id').val()+']').get(0);
            current_table.fnUpdate($("#assessment_name").val(),row,0);
            current_table.fnUpdate($("#assessment_date").val(),row,1);
        })
    </script>
<?php }?>
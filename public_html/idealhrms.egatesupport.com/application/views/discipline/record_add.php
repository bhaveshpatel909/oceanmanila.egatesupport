<?php 
$html = ' Click <a href="discipline">here</a> to back to tasks list. ';
if (is_numeric($result)){    
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added.') . $html));?>
    <script>
        $('document').ready(function(){
            $('#record_id').val(<?= $result?>);
            $('#employee_id_area').hide();
            
            <?php foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['id']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
            $("#new_attachments").val('');
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
            
            <?php foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['id']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
            $("#new_attachments").val('');
        });
    </script>
<?php }?>
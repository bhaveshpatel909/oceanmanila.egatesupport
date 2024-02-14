<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([$("#form_name").val(),$("#due_date").val(),'<a href="settings/edit_bir_formb/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#form_id').val(<?= $result?>);
            <?php foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['id']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
            $("#new_attachments").val('');
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#form_id').val()+']').get(0);
            //var updateData = [$("#form_name").val(),'<a href="settings/edit_bir_form/"'+$("#form_id").val()+'  data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>'];
            current_table.fnUpdate($("#form_name").val(),row,0);
            current_table.fnUpdate($("#due_date").val(),row,1);
            <?php foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['id']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
            $("#new_attachments").val('');
        });
    </script>
<?php }?>
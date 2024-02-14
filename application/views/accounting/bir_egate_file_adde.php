<?php if (is_numeric($result)){
    $this->load->view('layout/success',array('message'=>$this->lang->line('Added')));?>
    <script>
        $('document').ready(function(){
            row = current_table.fnAddData([$("#for_themonth").val(),$('#form_id option:selected').text(),null,$("#alertchk").val(),$("#amount").val(),null,null,null,'<a href="accounting/edit_bir_egate_filee/<?= $result?>" data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>']);
            oSettings = current_table.fnSettings();
            oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
            $('#bir_e_file_id').val(<?= $result?>);
            <?php			foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['name']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
			$("#new_attachments").val('');
            $("#new_attachments2").val('');
			 window.location.reload();
        });
    </script>
<?php }else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>
    <script>
        $('document').ready(function(){
            var row = $('tbody tr[entity_id='+$('#form_id').val()+']').get(0);
            //var updateData = [$("#form_name").val(),'<a href="accounting/edit_bir_file/"'+$("#form_id").val()+'  data-target="#modal_window" data-toggle="modal" class="btn btn-outline btn-success"><i class="fa fa-edit"></i></a>'];
            current_table.fnUpdate($("#for_themonth").val(),row,0);
            current_table.fnUpdate($('#form_id option:selected').text(),row,1);
			 current_table.fnUpdate($("#alertchk").val(),row,2);
            current_table.fnUpdate($(null,row,3);
            current_table.fnUpdate($("#amount").val(),row,4);
            current_table.fnUpdate($(null,row,5);
            current_table.fnUpdate($("#remarks").val(),row,6);
            current_table.fnUpdate($("#reference").val(),row,7);
            
            <?php foreach($files['success'] as $attachment){?>
            $('#attachments_list').append('<div class="file m-b-xs" id="attachment_<?= $attachment['id']?>"><button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['id']?>"><i class="fa fa-trash-o"></i></button><div class="file-name pull-left"><a href="employees/download_attachment/<?= $attachment['name']?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['ext'])?> fa-1-5x"></i> <?= $attachment['name']?><br><small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'))?></small></a></div><div class="clearfix"></div></div>');
            <?php }?>
            $("#new_attachments").val('');
			 $("#new_attachments2").val('');
			 //window.location.reload();
        });
    </script>
<?php }?>
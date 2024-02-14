<script>
function refreshPage(){
  window.location.reload(history.back());
} 
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="refreshPage();" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Record')?></h4>
            </div>
            <div class="modal-body">
                <form action="timeoff/delete_record" method="POST" id="delete_record">
                    <input type="hidden" id="record_id" name="record_id" value="<?= $record['record_id']?>" class="record_id">
                </form>
				<?php 
				?>
                <form action="timeoff/save_record" method="POST" id="save_record" enctype="multipart/form-data">
                    <div id="save_result2"></div>
                    <input type="hidden" id="record_id" name="record_id" value="<?= $record['record_id']?>" class="record_id">
                    <input type="hidden" id="record_id" name="employee_iddd" value="<?= $record['employee_id']?>" class="record_id">
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="start_time" class="control-label"><?= $this->lang->line('Start time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="start_time" id="start_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= date($this->config->item('date_format'),strtotime($record['start_time']))?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group has-feedback">
                            <label class="end_time" class="control-label"><?= $this->lang->line('End time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="end_time" id="end_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= date($this->config->item('date_format'),strtotime($record['end_time']))?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="type" class="control-label"><?= $this->lang->line('Type')?><sup class="mandatory">*</sup></label>
                            <select name="type" id="type" class="form-control required">
                                <?php foreach(array('vacation','sick','holidays','other') as $type){?>
                                <option value="<?= $type?>" <?= ($record['type']==$type)?'selected="selected"':''?>><?= $this->lang->line(ucfirst($type))?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="employee_comment"><?= $this->lang->line('Comment of employee')?></label>
                        <p><i><?= $record['employee_comment']?></i></p>
                    </div>
                    <div class="form-group">
                        <label for="comment" class="control-label"><?= $this->lang->line('Comment')?></label>
                        <textarea rows="5" name="comment" id="comment" class="form-control"><?= $record['comment']?></textarea>
                    </div>
					<div class="form-group">
					 <label for="comment" class="control-label"><?= $this->lang->line('File Attachment')?></label>
                        <?php $this->load->view('mix/attachments_list',array('attachments'=>array()))?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete record ?') && submit_form('#delete_record','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" onClick="refreshPage();"  onClick="history.go(0)" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_record','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Record')?></h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="timeoff/change_status" method="POST" id="approve_record">
                    <input type="hidden" id="record_id" name="record_id" value="<?= $record['record_id']?>" class="record_id">
                    <input type="hidden" name="status" value="approved">
                    <input type="hidden" name="comment" id="comment" class="comment">
                </form>
                <form action="timeoff/change_status" method="POST" id="deny_record">
                    <input type="hidden" id="record_id" name="record_id" value="<?= $record['record_id']?>" class="record_id">
                    <input type="hidden" name="status" value="denied">
                    <input type="hidden" name="comment" id="comment" class="comment">
                </form>
                <div class="clearfix"></div>
                <div class="col-lg-6" style="padding-left: 0;">
                    <div class="form-group has-feedback">
                        <label for="start_time" class="control-label"><?= $this->lang->line('Start time')?><sup class="mandatory">*</sup></label>
                        <input type="text" id="start_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format').' '.$this->config->item('js_time_format')?>" value="<?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['start_time']))?>" disabled="disabled">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group has-feedback">
                        <label class="end_time" class="control-label"><?= $this->lang->line('End time')?><sup class="mandatory">*</sup></label>
                        <input type="text" id="end_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format').' '.$this->config->item('js_time_format')?>" value="<?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['end_time']))?>" disabled="disabled">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-6" style="padding-left: 0;">
                    <div class="form-group has-feedback">
                        <label for="type" class="control-label"><?= $this->lang->line('Type')?><sup class="mandatory">*</sup></label>
                        <select id="type" class="form-control required" disabled="disabled">
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
                    <textarea rows="5" name="comment" id="comment" class="form-control" onchange="$('.comment').val($(this).val())"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#approve_record','#save_result2')"><?= $this->lang->line('Approve')?></button>
                <button type="button" class="btn btn-success" onclick="submit_form('#deny_record','#save_result2')"><?= $this->lang->line('Deny')?></button>
            </div>
        </div>
    </div>
</div>
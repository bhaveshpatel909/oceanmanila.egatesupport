<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Record')?></h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-lg-6" style="padding-left: 0;">
                    <div class="form-group has-feedback">
                        <label for="start_time" class="control-label"><?= $this->lang->line('Start time')?></label>
                        <input type="text" id="start_time" class="form-control required" value="<?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['start_time']))?>" disabled="disabled">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group has-feedback">
                        <label class="end_time" class="control-label"><?= $this->lang->line('End time')?></label>
                        <input type="text" id="end_time" class="form-control required" value="<?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['end_time']))?>" disabled="disabled">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-6" style="padding-left: 0;">
                    <div class="form-group has-feedback">
                        <label for="type" class="control-label"><?= $this->lang->line('Type')?></label>
                        <select id="type" class="form-control required" disabled="disabled">
                            <option><?= $this->lang->line(ucfirst($record['type']))?></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group has-feedback">
                        <label for="status" class="control-label"><?= $this->lang->line('Status')?></label>
                        <select id="status" class="form-control required" disabled="disabled">
                            <option><?= $this->lang->line(ucfirst($record['status']))?></option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="employee_comment"><?= $this->lang->line('Comment')?></label>
                    <p><i><?= $record['comment']?></i></p>
                </div>
                <div class="form-group">
                    <label for="comment" class="control-label"><?= $this->lang->line('Your comment')?></label>
                    <p><i><?= $record['employee_comment']?></i></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
            </div>
        </div>
    </div>
</div>
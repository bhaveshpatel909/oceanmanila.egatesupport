<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Record')?></h4>
            </div>
            <div class="modal-body">
                <form action="dashboard/save_timeoff" method="POST" id="save_timeoff">
                    <div id="save_result2"></div>
                    <input type="hidden" id="record_id" name="record_id" value="0" class="record_id">
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="start_time" class="control-label"><?= $this->lang->line('Start time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="start_time" id="start_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format').' '.$this->config->item('js_time_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group has-feedback">
                            <label class="end_time" class="control-label"><?= $this->lang->line('End time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="end_time" id="end_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format').' '.$this->config->item('js_time_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="type" class="control-label"><?= $this->lang->line('Type')?><sup class="mandatory">*</sup></label>
                            <select name="type" id="type" class="form-control required">
                                <?php foreach(array('vacation','sick','holidays','other') as $type){?>
                                <option value="<?= $type?>"><?= $this->lang->line(ucfirst($type))?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="employee_comment" class="control-label"><?= $this->lang->line('Your comment')?></label>
                        <textarea rows="5" name="employee_comment" id="employee_comment" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_timeoff','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
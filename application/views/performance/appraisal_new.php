<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
        $('#employee_id').magicSuggest({
            allowFreeEntries:false,
            data:'performance/find_employee',
            maxSelection:1
        });
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Appraisal')?></h4>
            </div>
            <div class="modal-body">
                <form action="performance/save_appraisal" method="POST" id="save_appraisal">
                    <div id="save_result2"></div>
                    <input type="hidden" id="appraisal_id" name="appraisal_id" value="0" class="appraisal_id">
                    <div class="form-group has-feedback">
                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="employee_id" id="employee_id" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0px;">
                        <div class="form-group">
                            <label for="start_date" class="control-label"><?= $this->lang->line('Start date')?></label>
                            <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="end_date" class="control-label"><?= $this->lang->line('End date')?></label>
                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback">
                        <label for="expectations" class="control-label"><?= $this->lang->line('Expectations')?><sup class="mandatory">*</sup></label>
                        <textarea rows="5" name="expectations" id="expectations" class="form-control required"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_appraisal','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
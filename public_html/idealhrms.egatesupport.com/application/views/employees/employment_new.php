<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Employment')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_employment" method="POST" id="save_employment">
                    <div id="save_result2"></div>
                    <input type="hidden" id="employment_id" name="employment_id" value="0" class="employment_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div class="form-group has-feedback">
                        <label for="company" class="control-label"><?= $this->lang->line('Company')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="company" id="company" class="form-control required" maxlength="100">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="position" class="control-label"><?= $this->lang->line('Position')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="position" id="position" class="form-control required" maxlength="100">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="start" class="control-label"><?= $this->lang->line('Start')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="start" id="start" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="end" class="control-label"><?= $this->lang->line('End')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="end" id="end" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback">
                        <label for="responsibilities" class="control-label"><?= $this->lang->line('Responsibilities')?></label>
                        <textarea rows="5" name="responsibilities" id="responsibilities" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_employment','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
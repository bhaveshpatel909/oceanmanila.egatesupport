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
                <h4 class="modal-title"><?= $this->lang->line('Assessment')?></h4>
            </div>
            <div class="modal-body">
                <form action="skills/delete_assessment" method="POST" id="delete_assessment">
                    <input type="hidden" id="assessment_id" name="assessment_id" value="<?= $assessment['assessment_id']?>" class="assessment_id">
                </form>
                <form action="skills/save_assessment" method="POST" id="save_assessment">
                    <div id="save_result2"></div>
                    <input type="hidden" id="assessment_id" name="assessment_id" value="<?= $assessment['assessment_id']?>" class="assessment_id">
                    <div class="form-group has-feedback">
                        <label for="assessment_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="assessment_name" id="assessment_name" class="form-control required" maxlength="100" value="<?= $assessment['assessment_name']?>">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="assessment_date" class="control-label"><?= $this->lang->line('Date')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="assessment_date" id="assessment_date" class="form-control required datetimepicker" maxlength="100" value="<?= date($this->config->item('date_format'),strtotime($assessment['assessment_date']))?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete assessment ?') && submit_form('#delete_assessment','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_assessment','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
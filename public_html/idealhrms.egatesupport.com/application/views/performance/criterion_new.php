<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Criterion')?></h4>
            </div>
            <div class="modal-body">
                <form action="performance/save_criterion" method="POST" id="save_criterion">
                    <div id="save_result2"></div>
                    <input type="hidden" id="criterion_id" name="criterion_id" value="0" class="criterion_id">
                    <div class="form-group has-feedback">
                        <label for="criterion_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="criterion_name" id="criterion_name" class="form-control required" maxlength="100">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_criterion','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
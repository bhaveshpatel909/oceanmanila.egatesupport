<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Mark as completed')?></h4>
            </div>
            <div class="modal-body">
                <form action="performance/proccess_complete" method="POST" id="proccess_complete">
                    <div id="save_result2"></div>
                    <input type="hidden" id="appraisal_id" name="appraisal_id" value="<?= $appraisal_id?>">
                    <div class="form-group has-feedback">
                        <label for="results" class="control-label"><?= $this->lang->line('Results')?><sup class="mandatory">*</sup></label>
                        <textarea rows="5" class="form-control required" name="results" id="results"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#proccess_complete','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
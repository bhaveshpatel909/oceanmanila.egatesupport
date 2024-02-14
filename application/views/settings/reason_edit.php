<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Reason')?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_reason" method="POST" id="delete_reason">
                    <input type="hidden" id="reason_id" name="reason_id" value="<?= $reason['reason_id']?>" class="reason_id">
                </form>
                <form action="settings/save_reason" method="POST" id="save_reason">
                    <div id="save_result2"></div>
                    <input type="hidden" id="reason_id" name="reason_id" value="<?= $reason['reason_id']?>" class="reason_id">
                    <div class="form-group has-feedback">
                        <label for="reason_name" class="control-label"><?= $this->lang->line('Reason name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="reason_name" id="reason_name" class="form-control required" maxlength="100" value="<?= $reason['reason_name']?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete reason ?') && submit_form('#delete_reason','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_reason','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
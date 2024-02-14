<script>
    $('document').ready(function () {
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit Task Status') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_task_status" method="POST" id="delete_task_status">
                    <input type="hidden" id="task_status_id" name="task_status_id" value="<?= $task_status['task_status_id'] ?>" class="task_status_id">
                </form>
                <form action="settings/save_task_status" method="POST" id="save_task_status">
                    <div id="save_result2"></div>
                    <input type="hidden" id="task_status_id" name="task_status_id"  value="<?= $task_status['task_status_id']?>" class="task_status_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="task_status_name" class="control-label"><?= $this->lang->line('Task Status Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="task_status_name" id="task_status_name" class="form-control required"  value="<?= $task_status['task_status_name']?>" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Task Status?') && submit_form('#delete_task_status', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_task_status', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
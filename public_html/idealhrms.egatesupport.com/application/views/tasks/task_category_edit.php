<script>
    $('document').ready(function () {
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit Task Category') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_task_category" method="POST" id="delete_task_category">
                    <input type="hidden" id="task_category_id" name="task_category_id" value="<?= $task_category['task_category_id'] ?>" class="task_category_id">
                </form>
                <form action="settings/save_task_category" method="POST" id="save_task_category">
                    <div id="save_result2"></div>
                    <input type="hidden" id="task_category_id" name="task_category_id"  value="<?= $task_category['task_category_id']?>" class="task_category_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="task_category_name" class="control-label"><?= $this->lang->line('Task Category Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="task_category_name" id="task_category_name" class="form-control required"  value="<?= $task_category['task_category_name']?>" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Task Category?') && submit_form('#delete_task_category', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_task_category', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
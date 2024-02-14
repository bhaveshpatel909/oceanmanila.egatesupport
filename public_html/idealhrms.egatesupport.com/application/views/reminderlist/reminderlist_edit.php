<script>
    $('document').ready(function () {
		$('#something').click(function() {
			location.reload();
		});
		
    });
</script>
<?php

?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit reminderlist') ?></h4>
            </div>
            <div class="modal-body">
                <form action="reminderlist/delete_reminderlist" method="POST" id="delete_task_type">
                    <input type="hidden" id="id" name="id" value="<?= $reminderlist[0]['reminder_id']?>" class="id">
                </form>
                <form action="reminderlist/save_reminderlist" method="POST" id="save_task_type">
                    <div id="save_result2"></div>
                    <input type="hidden" id="id" name="id"  value="<?= $reminderlist[0]['reminder_id']?>" class="id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="bank_name" class="control-label"><?= $this->lang->line('Reminder Category Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control required" value="<?= $reminderlist[0]['reminder_name']?>" maxlength="50">
                        </div>
						
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Reminder List?') && submit_form('#delete_task_type', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" id="something" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_task_type', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
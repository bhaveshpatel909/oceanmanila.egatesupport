<script>

    // $('document').ready(function () {
		  // $('#due_date').datetimepicker({
            // format: 'YYYY-MM-DD',
            // useCurrent: true,
            // pickTime: false
        // });
		
    // })
</script>
<?php $this->load->view('mix/attachment_remove') ?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('BIR Form Registration') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_bir_form" method="POST" id="delete_bir_form">
                    <input type="hidden" id="form_id" name="form_id" value="<?= $bir_form['form_id'] ?>" class="form_id">
                </form>
                <form action="settings/save_bir_form" method="POST" id="save_bir_form">
                    <div id="save_result2"></div>
                    <input type="hidden" id="form_id" name="form_id"  value="<?= $bir_form['form_id']?>" class="form_id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="form_name" class="control-label"><?= $this->lang->line('Form Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="form_name" id="form_name" class="form-control required" value="<?= $bir_form['form_name']?>" maxlength="200">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="due_date" class="control-label"><?= $this->lang->line('Due Date') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="due_date" id="due_date" class="form-control required datetimepicker" value="<?= $bir_form['due_date']?>" data-date-format="<?= $this->config->item('js_month_format');?>" maxlength="200">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list')?>
                    <div class="form-group">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?></label>
                        <textarea rows="6" id="remarks" name="remarks" class="form-control"><?= $bir_form['remarks']?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Bir Form ?') && submit_form('#delete_bir_form', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_form', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
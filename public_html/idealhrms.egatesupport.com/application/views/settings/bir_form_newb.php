<script>
    $('document').ready(function () {
		var  burl ="<?php echo base_url();?>";
		$('.close_button').click(function(){
			
		location.href=burl+"settings/bir_formsb";
			
		});

    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Employee Benefit BIR Form Registration') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_bir_formb" method="POST" id="save_bir_form">
                    <div id="save_result2"></div>
                    <input type="hidden" id="form_id" name="form_id" value="0" class="form_id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="form_name" class="control-label"><?= $this->lang->line('Form Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="form_name" id="form_name" class="form-control required" maxlength="200">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="due_date" class="control-label"><?= $this->lang->line('Due Date') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="due_date" id="due_date" class="form-control required" maxlength="200">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list',array('attachments'=>array()))?>
                    <div class="form-group">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?></label>
                        <textarea rows="6" id="remarks" name="remarks" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close_button"  data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"  onclick="submit_form('#save_bir_form', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
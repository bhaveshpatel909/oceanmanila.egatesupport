<script>
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
		
		$('#something').click(function() {
			location.reload();
		});
		
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Monthly Bill list') ?></h4>
            </div>
            <div class="modal-body">
                <form action="monthlybilllist/save_monthlybilllist" method="POST" id="save_task_type">
                    <div id="save_result2"></div>
                    <input type="hidden" id="id" name="id" value="0" class="id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="bank_name" class="control-label"><?= $this->lang->line('Pay to') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="list_name" id="bank_name" class="form-control required" maxlength="50">
                        </div>
						
						 <div class="form-group">
                        <label class="control-label" for="content"><?= $this->lang->line('Remarks')?></label>
                       <textarea rows="4" name="remarks" id="content" class="form-control summernote-modal"></textarea>
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="something" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_task_type', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
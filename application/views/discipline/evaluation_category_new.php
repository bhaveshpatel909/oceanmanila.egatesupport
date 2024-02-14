<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Evaluation category') ?></h4>
            </div>
            <div class="modal-body">
                <form action="discipline/save_evaluation_category" method="POST" id="save_evaluation_category">
                    <div id="save_result2"></div>
                    <input type="hidden" id="evaluation_category_id" name="evaluation_category_id" value="0" class="evaluation_category_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_category_name" class="control-label"><?= $this->lang->line('Evaluation Category name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="evaluation_category_name" id="evaluation_category_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    <!--div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_category_score" class="control-label"><?= $this->lang->line('Evaluation Category Score') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_category_score" id="discipline_category_score" class="form-control required" maxlength="100" value="">
                        </div>
                    </div-->
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary trigger" onclick="submit_form('#save_evaluation_category', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
	$('document').ready(function(){
		$( ".trigger" ).click(function() {
			$( document ).ajaxComplete(function() {
				window.location.href = 'discipline/evaluation_category';
			});	
		});	
    });
</script>
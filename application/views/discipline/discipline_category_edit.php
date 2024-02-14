<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Discipline Category') ?></h4>
            </div>
            <div class="modal-body">
                <form action="discipline/delete_discipline_category" method="POST" id="delete_discipline_category">
                    <input type="hidden" id="discipline_category_id" name="discipline_category_id" value="<?= $discipline_action['id'] ?>" class="discipline_category_id">
                </form>
                <form action="discipline/save_discipline_category" method="POST" id="save_discipline_category">
                    <div id="save_result2"></div>
                    <input type="hidden" id="discipline_category_id" name="discipline_category_id" value="<?= $discipline_action['id'] ?>" class="discipline_category_id">
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_category_name" class="control-label"><?= $this->lang->line('Discipline Category Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_category_name" id="discipline_category_name" class="form-control required" maxlength="100" value="<?= $discipline_action['name'] ?>">
                        </div>
                    </div>
                    <!--div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_action_score" class="control-label"><?= $this->lang->line('Discipline Action Score') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_action_score" id="discipline_action_score" class="form-control required" maxlength="100" value="<?= $discipline_action['score'] ?>">
                        </div>
                    </div-->
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger triggerr pull-left" onclick="confirm('Delete Discipline Category ?') && submit_form('#delete_discipline_category', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary trigger" onclick="submit_form('#save_discipline_category', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
	$('document').ready(function(){
		$( ".trigger" ).click(function() {
			$( document ).ajaxComplete(function() {
				window.location.href = 'discipline/discipline_category';
			});	
		});	
		
		$( ".triggerr" ).click(function() {
			$( document ).ajaxComplete(function() {
				window.location.href = 'discipline/discipline_category';
			});	
		});	
    });
</script>
<div id="" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Employee Work Evaluation') ?></h4>
            </div>
            <div class="modal-body">
                <form action="evaluation/delete_evaluation_template" method="POST" id="delete_evaluation_template">
                    <input type="hidden" id="evaluation_template_id" name="evaluation_template_id" value="<?= $evaluation_template['id'] ?>" class="evaluation_template_id">
                </form>
                <form action="evaluation/save_evaluation_template" method="POST" id="save_evaluation_template">
                    <div id="save_result2"></div>
                    <input type="hidden" id="evaluation_template_id" name="evaluation_template_id" value="<?= $evaluation_template['id'] ?>" class="evaluation_template_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_template_name" class="control-label"><?= $this->lang->line('Evaluation Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="evaluation_template_name" id="evaluation_template_name" class="form-control required" maxlength="100" value="<?= $evaluation_template['name'] ?>">
                        </div>
                    </div>
					<div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_template_category" class="control-label"><?= $this->lang->line('Evaluation Category') ?><sup class="mandatory">*</sup></label>
                            <select style="width:100%;height:34px;" name="evaluation_template_category" id="evaluation_template_category">
								<option value="">Select</option>
								<?php foreach($category as $cat){ ?>
									<option value="<?= $cat['id']?>"<?php if($cat['id'] == $evaluation_template['ecatgoryid']) echo"selected"; ?>><?= $cat['name']?></option>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-8 no-padding">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_template_remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control " id="evaluation_template_remarks" name="evaluation_template_remarks"><?= $evaluation_template['remarks'] ?></textarea>
                        </div>
                    </div>
					<div class="col-lg-3">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="score" class="control-label"><?= $this->lang->line('Score') ?><sup class="mandatory"></sup></label>
                            <input type="number" name="score" value="<?= $evaluation_template['score'] ?>" class="form-control no-padding" >
                        </div>
                    </div>
					<div class="clearfix"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="company_rules" class="control-label"><?= $this->lang->line('Guidelines') ?><sup class="mandatory"></sup></label>
                            <textarea id="company_rules" class="form-control summernote-modal" id="company_rules" name="company_rules"><?php echo $evaluation_template["company_rules"]?></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="evaluation_template_content" class="control-label"><?= $this->lang->line('Content template') ?><sup class="mandatory"></sup></label>
                            <textarea id="content" class="form-control summernote-modal" id="content" name="content"><?php echo $evaluation_template["content"]?></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete discipline reason ?') && submit_form('#delete_evaluation_template', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default savereload" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary savereload" onclick="submit_form('#save_evaluation_template', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<?php $content = addslashes($evaluation_template["content"]);?>
<script type="text/javascript">
    $(document).ready(function () {
		
				
				$('.close').click(function() {
   setTimeout(function() { window.location.reload(true); }, 3000); 
});
		$('.savereload').click(function() {
    setTimeout(function() { window.location.reload(true); }, 3000); 
});
		
        $('.summernote-modal').summernote({
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
        var company_rules = $('textarea[name="company_rules"]').text();
        $('#company_rules').summernote('code', company_rules);
        var content = $('textarea[name="content"]').text();
        $('#content').summernote('code', content);
    });
</script>
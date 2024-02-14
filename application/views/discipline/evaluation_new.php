<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Work Evaluation New') ?></h4>
            </div>
            <div class="modal-body">
                <form action="discipline/save_evaluation" onsubmit="return postForm();"  method="POST" id="save_evaluation">
                    <div id="save_result2"></div>
                    <input type="hidden" id="evaluation_id" name="evaluation_id" value="0" class="evaluation_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_name" class="control-label"><?= $this->lang->line('Evaluation Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="evaluation_name" id="evaluation_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="evaluation_remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control " id="evaluation_remarks" name="evaluation_remarks"></textarea>
                        </div>
                    </div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="company_rules" class="control-label"><?= $this->lang->line('Guidelines') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="company_rules" name="company_rules"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="evaluation_template_content" class="control-label"><?= $this->lang->line('Performance Evaluation Memo') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary trigger" onclick="submit_form('#save_evaluation', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
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
		
		$( ".trigger" ).click(function() {
			$( document ).ajaxComplete(function() {
				window.location.href = 'discipline/evaluation_list';
			});	
		});	
    });
    var postForm = function () {
        var company_rules = $('textarea[name="company_rules"]').html($('.summernote-modal').eq(0).code());
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(1).code());
    };
</script>
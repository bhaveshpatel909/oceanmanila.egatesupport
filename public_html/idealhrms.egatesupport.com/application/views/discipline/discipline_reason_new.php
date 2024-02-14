<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Discipline Reason') ?></h4>
            </div>
            <div class="modal-body">
                <form action="discipline/save_discipline_reason" onsubmit="return postForm();"  method="POST" id="save_discipline_reason">
                    <div id="save_result2"></div>
                    <input type="hidden" id="discipline_reason_id" name="discipline_reason_id" value="0" class="discipline_reason_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_reason_name" class="control-label"><?= $this->lang->line('Discipline Reason name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_reason_name" id="discipline_reason_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
					<div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_reason_category" class="control-label"><?= $this->lang->line('Discipline Category') ?><sup class="mandatory">*</sup></label>
                            <select style="width: 100%;height:34px" name="discipline_reason_category" id="discipline_reason_category">
								<option value="">Select</option>
								<?php foreach($category as $cat){ ?>
									<option value="<?=$cat['id']?>"><?=$cat['name']?></option>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-8 no-padding">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_reason_remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control " id="discipline_reason_remarks" name="discipline_reason_remarks"></textarea>
                        </div>
                    </div>
					
					<div class="col-lg-3">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="score" class="control-label"><?= $this->lang->line('Score') ?><sup class="mandatory"></sup></label>
                            <input type="number" name="score" value="" class="form-control no-padding" >
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="company_rules" class="control-label"><?= $this->lang->line('Company Rules') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="company_rules" name="company_rules"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="discipline_reason_content" class="control-label"><?= $this->lang->line('Content template') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_discipline_reason', '#save_result2')"><?= $this->lang->line('Save') ?></button>
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
    });
    var postForm = function () {
        var company_rules = $('textarea[name="company_rules"]').html($('.summernote-modal').eq(0).code());
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(1).code());
    }
	$('.close').click(function() {
		var burl ='<?php echo base_url();?>';
		//alert(burl);
  window.location= burl+"discipline/discipline_reasons";
});
	
</script>








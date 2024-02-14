<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Letter') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_letter" onsubmit="return postForm();"  method="POST" id="save_letter">
                    <div id="save_result2"></div>
                    <input type="hidden" id="setting_letter_id" name="setting_letter_id" value="0" class="setting_letter_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="setting_letter_name" class="control-label"><?= $this->lang->line('Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="setting_letter_name" id="setting_letter_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 no-padding">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="setting_letter_remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control " id="remarks" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="setting_letter_content" class="control-label"><?= $this->lang->line('Content') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <?php $this->load->view('mix/attachments_list', array('attachments' => array())) ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_letter', '#save_result2')"><?= $this->lang->line('Save') ?></button>
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
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(1).code());
    };
</script>
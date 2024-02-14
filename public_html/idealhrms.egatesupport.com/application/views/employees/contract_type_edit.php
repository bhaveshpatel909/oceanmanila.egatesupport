<div id="" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Contract Type') ?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_contract_type" method="POST" id="delete_contract_type">
                    <input type="hidden" id="contract_type_id" name="contract_type_id" value="<?= $contract_type['id'] ?>" class="contract_type_id">
                </form>
                <form action="employees/save_contract_type" method="POST" id="save_contract_type">
                    <div id="save_result2"></div>
                    <input type="hidden" id="contract_type_id" name="contract_type_id" value="<?= $contract_type['id'] ?>" class="contract_type_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="contract_type_name" class="control-label"><?= $this->lang->line('Contract Type name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="contract_type_name" id="contract_type_name" class="form-control required" maxlength="100" value="<?= $contract_type['name'] ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="contract_type_content" class="control-label"><?= $this->lang->line('Content template') ?><sup class="mandatory"></sup></label>
                            <textarea class="form-control summernote-modal" id="content" name="content"><?php echo $contract_type["content"]?></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete discipline reason ?') && submit_form('#delete_contract_type', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_contract_type', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<?php $content = addslashes($contract_type["content"]);?>
<script type="text/javascript">
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
        var content = $('textarea[name="content"]').text();
        $('.summernote-modal').summernote('code', content);
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Category')?></h4>
            </div>
            <div class="modal-body">
                <form action="skills/delete_category" method="POST" id="delete_category">
                    <input type="hidden" id="category_id" name="category_id" value="<?= $category['category_id']?>" class="category_id">
                </form>
                <form action="skills/save_category" method="POST" id="save_category">
                    <div id="save_result2"></div>
                    <input type="hidden" id="category_id" name="category_id" value="<?= $category['category_id']?>" class="category_id">
                    <div class="form-group has-feedback">
                        <label for="category_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="category_name" id="category_name" class="form-control required" maxlength="100" value="<?= $category['category_name']?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete category ?') && submit_form('#delete_category','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_category','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
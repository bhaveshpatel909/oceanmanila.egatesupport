<script>
    $('document').ready(function () {
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit Customer Item') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_customer_item" method="POST" id="delete_customer_item">
                    <input type="hidden" id="customer_item_id" name="customer_item_id" value="<?= $customer_item['id'] ?>" class="customer_item_id">
                </form>
                <form action="settings/save_customer_item" method="POST" id="save_customer_item">
                    <div id="save_result2"></div>
                    <input type="hidden" id="customer_item_id" name="customer_item_id"  value="<?= $customer_item['id']?>" class="customer_item_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="customer_item_name" class="control-label"><?= $this->lang->line('Customer Item Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="customer_item_name" id="customer_item_name" class="form-control required"  value="<?= $customer_item['name']?>" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Customer Item?') && submit_form('#delete_customer_item', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_customer_item', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
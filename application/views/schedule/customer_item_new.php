<script>
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Customer Item') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_customer_item" method="POST" id="save_customer_item">
                    <div id="save_result2"></div>
                    <input type="hidden" id="customer_item_id" name="customer_item_id" value="0" class="customer_item_id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="customer_item_name" class="control-label"><?= $this->lang->line('Customer Item Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="customer_item_name" id="customer_item_name" class="form-control required" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_customer_item', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
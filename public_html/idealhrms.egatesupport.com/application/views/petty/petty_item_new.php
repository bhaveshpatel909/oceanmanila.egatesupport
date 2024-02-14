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
                <h4 class="modal-title"><?= $this->lang->line('Add Petty Cash Item') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_petty_item" method="POST" id="save_petty_item">
                    <div id="save_result2"></div>
                    <input type="hidden" id="petty_item_id" name="petty_item_id" value="0" class="petty_item_id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="petty_item_name" class="control-label"><?= $this->lang->line('Petty Cash Item Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="petty_item_name" id="petty_item_name" class="form-control required" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_petty_item', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
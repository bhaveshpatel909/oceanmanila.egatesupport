<script>
    $('document').ready(function () {
        $('.demo2').colorpicker();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit Schedule Item') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_schedule_item" method="POST" id="delete_schedule_item">
                    <input type="hidden" id="schedule_item_id" name="schedule_item_id" value="<?= $schedule_item['id'] ?>" class="schedule_item_id">
                </form>
                <form action="settings/save_schedule_item" method="POST" id="save_schedule_item">
                    <div id="save_result2"></div>
                    <input type="hidden" id="schedule_item_id" name="schedule_item_id"  value="<?= $schedule_item['id']?>" class="schedule_item_id">

                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="schedule_item_name" class="control-label"><?= $this->lang->line('Schedule Item Name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="schedule_item_name" id="schedule_item_name" class="form-control required"  value="<?= $schedule_item['name']?>" maxlength="50">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="schedule_item_color" class="control-label"><?= $this->lang->line('Color') ?><sup class="mandatory"></sup></label>
                            <div class="input-group demo2">
                                <input type="text" name="schedule_item_color" id="schedule_item_color" value="<?= $schedule_item['color']?>" class="form-control" />
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div> 
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete Schedule Item?') && submit_form('#delete_schedule_item', '#save_result2')"><?= $this->lang->line('Delete') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_schedule_item', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
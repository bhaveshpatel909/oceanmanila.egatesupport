<script>
    $('document').ready(function () {
        init_icheck();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Position') ?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_position" method="POST" id="save_position">
                    <div id="save_result2"></div>
                    <input type="hidden" id="position_id" name="position_id" value="0" class="position_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="position_name" class="control-label"><?= $this->lang->line('Position name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="position_name" id="position_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="responsibilities" class="control-label"><?= $this->lang->line('Responsibilities') ?></label>
                        <textarea rows="6" id="responsibilities" name="responsibilities" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_position', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
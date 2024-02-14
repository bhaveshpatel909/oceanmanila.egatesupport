<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Discipline Action') ?></h4>
            </div>
            <div class="modal-body">
                <form action="discipline/save_discipline_action" method="POST" id="save_discipline_action">
                    <div id="save_result2"></div>
                    <input type="hidden" id="discipline_action_id" name="discipline_action_id" value="0" class="discipline_action_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_action_name" class="control-label"><?= $this->lang->line('Discipline Action name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_action_name" id="discipline_action_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="discipline_action_score" class="control-label"><?= $this->lang->line('Discipline Action Score') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="discipline_action_score" id="discipline_action_score" class="form-control required" maxlength="100" value="">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_discipline_action', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $position['position_name']?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/update_position" method="POST" id="update_position">
                    <div id="save_result2"></div>
                    <input type="hidden" id="position_id" name="position_id" value="<?= $position['id']?>">
                    <div class="form-group">
                        <label class="control-label"><?= $this->lang->line('Responsibilities')?></label>
                        <p><?= $position['responsibilities']?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-lg-5 no-padding">
                        <label class="control-label"><?= $this->lang->line('Move reason')?></label>
                        <p><?= $position['move_reason']?></p>
                    </div>
                    <div class="form-group col-lg-3 no-padding">
                        <label class="control-label"><?= $this->lang->line('Start date')?></label>
                        <p><?= date($this->config->item('date_format'),strtotime($position['start']))?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="add_responsibilities" class="control-label"><?= $this->lang->line('Additional responsibilities')?></label>
                        <textarea rows="5" name="add_responsibilities" id="add_responsibilities" class="form-control"><?= $position['add_responsibilities']?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#update_position','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
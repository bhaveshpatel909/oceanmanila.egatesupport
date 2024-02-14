<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $position['position_name']?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Responsibilities')?></label>
                    <p><?= $position['responsibilities']?></p>
                </div>
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Additional responsibilities')?></label>
                    <p><?= $position['add_responsibilities']?></p>
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
                <div class="form-group col-lg-3 no-padding">
                    <label class="control-label"><?= $this->lang->line('End date')?></label>
                    <p><?= date($this->config->item('date_format'),strtotime($position['end']))?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
            </div>
        </div>
    </div>
</div>
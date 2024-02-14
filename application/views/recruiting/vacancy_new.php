<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Vacancy')?></h4>
            </div>
            <div class="modal-body">
                <form action="recruiting/save_vacancy" method="POST" id="save_vacancy">
                    <div id="save_result2"></div>
                    <input type="hidden" id="vacancy_id" name="vacancy_id" value="0" class="vacancy_id">
                    <div class="form-group has-feedback">
                        <label for="position_id" class="control-label"><?= $this->lang->line('Position')?><sup class="mandatory">*</sup></label>
                        <select name="position_id" id="position_id" class="form-control required">
                            <?php foreach($positions as $department){?>
                            <optgroup label="<?= $department['name']?>">
                                <?php foreach($department['positions'] as $position){?>
                                <option value="<?= $position['position_id']?>"><?= $position['position_name']?></option>
                                <?php }?>
                            </optgroup>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label"><?= $this->lang->line('Description')?></label>
                        <textarea rows="4" name="description" id="description" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_vacancy','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
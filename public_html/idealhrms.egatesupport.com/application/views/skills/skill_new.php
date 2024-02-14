<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Skill')?></h4>
            </div>
            <div class="modal-body">
                <form action="skills/save_skill" method="POST" id="save_skill">
                    <div id="save_result2"></div>
                    <input type="hidden" id="skill_id" name="skill_id" value="0" class="skill_id">
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="skill_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="skill_name" id="skill_name" class="form-control required" maxlength="100">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group has-feedback">
                            <label for="parent_category" class="control-label"><?= $this->lang->line('Category')?><sup class="mandatory">*</sup></label>
                            <select name="parent_category" id="parent_category" class="form-control required">
                                <?php foreach($categories as $category){?>
                                <option value="<?= $category['category_id']?>"><?= $category['category_name']?></option>
                                <?php }?>
                            </select>                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="skill_requirements" class="control-label"><?= $this->lang->line('Requirements')?></label>
                        <textarea rows="5" name="skill_requirements" id="skill_requirements" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_skill','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
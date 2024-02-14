<script>
    $('document').ready(function(){
        init_icheck();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Department')?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/save_department" method="POST" id="save_department">
                    <div id="save_result2"></div>
                    <input type="hidden" id="department_id" name="department_id" value="0" class="department_id">
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#department_tab" data-toggle="tab"><?= $this->lang->line('Department')?></a></li>
                      <!--<li><a href="#skills_tab" data-toggle="tab"><?= $this->lang->line('Required skills')?></a></li>-->
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="department_tab">
                            <div class="col-lg-6" style="padding-left: 0;">
                                <div class="form-group has-feedback m-t-sm">
                                    <label for="department_name" class="control-label"><?= $this->lang->line('Department name')?><sup class="mandatory">*</sup></label>
                                    <input type="text" name="department_name" id="department_name" class="form-control required" maxlength="100">
                                </div>
                            </div>
<!--                            <div class="col-lg-6">
                                <div class="form-group has-feedback m-t-sm m-b-none">
                                    <label for="department_id" class="control-label"><?= $this->lang->line('Department')?><sup class="mandatory">*</sup></label>
                                    <select name="department_id" id="department_id" class="form-control required">
                                        <?php foreach($departments as $department){?>
                                        <option value="<?= $department['department_id']?>"><?= $department['department_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox i-checks m-b-none">
                                        <input type="checkbox" name="is_head" id="is_head" class="i-checks">
                                        <label for="is_head" class="control-label"><?= $this->lang->line('Head of department')?></label>
                                    </div>
                                </div>
                            </div>-->
                            <div class="clearfix"></div>
                        </div>
<!--                        <div class="tab-pane fade" id="skills_tab">
                            <ul class="unstyled no-padding m-t-sm" style="max-height: 320px;overflow: auto;">
                                <?php foreach($skills as $categories){?>
                                    <li>
                                        <strong><?= $categories[0]['category_name']?></strong>
                                        <ul class="unstyled">
                                            <?php foreach($categories as $skill){?>
                                            <li>
                                                <div class="checkbox i-checks m-b-none">
                                                    <input type="checkbox" name="skills[<?= $skill['skill_id']?>]" id="skill_<?= $skill['skill_id']?>" class="i-checks">
                                                    <label for="skill_<?= $skill['skill_id']?>" class="control-label"><?= $skill['skill_name']?></label>
                                                </div>
                                            </li>
                                            <?php }?>
                                        </ul>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>-->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_department','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
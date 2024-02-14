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
                <h4 class="modal-title"><?= $this->lang->line('Skill')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_skills" method="POST" id="save_skills">
                    <div id="save_result2"></div>
                    <input type="hidden" id="employee_id" name="employee_id" value="<?=$employee_id?>">
                    <ul class="unstyled no-padding" style="max-height: 400px;overflow: auto;">
                        <?php foreach($skills as $categories){?>
                            <li>
                                <strong><?= $categories[0]['category_name']?></strong>
                                <ul class="unstyled">
                                    <?php foreach($categories as $skill){?>
                                    <li>
                                        <div class="checkbox i-checks m-b-none">
                                            <input type="checkbox" name="skills[<?= $skill['skill_id']?>]" id="skill_<?= $skill['skill_id']?>" <?= (is_null($skill['employee_id']))?'':'checked="checked"'?> class="i-checks">
                                            <label for="skill_<?= $skill['skill_id']?>" class="control-label"><?= $skill['skill_name']?></label>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                            </li>
                        <?php }?>
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_skills','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
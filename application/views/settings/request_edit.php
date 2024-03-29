<script>
    $('document').ready(function(){
        init_icheck();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			<?php 
			
			// echo '<pre>';
			// print_r($request);
			// echo '</pre>';
			?>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Request')?></h4>
            </div>
            <div class="modal-body">
                <form action="settings/delete_request" method="POST" id="delete_request">
                    <input type="hidden" id="requestlist_id" name="requestlist_id" value="<?= $request['requestlist_id']?>" class="request_id">
                </form>
                <form action="settings/save_request" method="POST" id="save_request">
                    <div id="save_result2"></div>
                        <input type="hidden" id="request_id" name="request_id" value="<?= $request['requestlist_id']?>" class="request_id">
                        
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#request_tab" data-toggle="tab"><?= $this->lang->line('Request')?></a></li>
                          <!--<li><a href="#skills_tab" data-toggle="tab"><?= $this->lang->line('Required skills')?></a></li>-->
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="request_tab">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <div class="form-group has-feedback m-t-sm">
                                        <label for="request_name" class="control-label"><?= $this->lang->line('Request name')?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="request_name" id="request_name" class="form-control required" maxlength="100" value="<?= $request['request_name']?>">
                                    </div>
                                </div>
<!--                                <div class="col-lg-6">
                                    <div class="form-group has-feedback m-t-sm m-b-none">
                                        <label for="department_id" class="control-label"><?= $this->lang->line('request')?><sup class="mandatory">*</sup></label>
                                        <select name="department_id" id="department_id" class="form-control required">
                                            <?php foreach($requests as $request){?>
                                            <option <?= ($request['request_id']==$request['request_id'])?'selected="selected"':''?> value="<?= $request['request_id']?>"><?= $department['request_name']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox i-checks m-b-none">
                                            <input type="checkbox" name="is_head" id="is_head" <?= ($request['is_head']=='1')?'checked="checked"':''?> class="i-checks">
                                            <label for="is_head" class="control-label"><?= $this->lang->line('Head of request')?></label>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="clearfix"></div>
                            </div>
<!--                            <div class="tab-pane fade" id="skills_tab">
                                <ul class="unstyled no-padding m-t-sm" style="max-height: 320px;overflow: auto;">
                                    <?php foreach($skills as $categories){?>
                                        <li>
                                            <strong><?= $categories[0]['category_name']?></strong>
                                            <ul class="unstyled">
                                                <?php foreach($categories as $skill){?>
                                                <li>
                                                    <div class="checkbox i-checks m-b-none">
                                                        <input type="checkbox" name="skills[<?= $skill['skill_id']?>]" id="skill_<?= $skill['skill_id']?>" <?= (is_null($skill['request_id']))?'':'checked="checked"'?> class="i-checks">
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
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete request ?') && submit_form('#delete_request','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_request','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
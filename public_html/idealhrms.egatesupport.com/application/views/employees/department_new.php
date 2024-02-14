<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
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
                <form action="employees/save_department" method="POST" id="save_department" role="form">
                    <div id="save_result2"></div>
                    <input type="hidden" id="department_id" name="department_id" value="0" class="department_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div class="col-lg-6 no-padding">
                        <div class="form-group has-feedback">
                            <label for="new_department" class="control-label"><?= $this->lang->line('New department')?><sup class="mandatory">*</sup></label>
                            <select name="new_department" id="new_department" class="form-control required">
                            <?php foreach($departments as $department){?>
                            <optgroup label="<?= $department['name']?>">
                                <?php foreach($department['departments'] as $department){?>
                                <option <?= ($current_department['department_id']==$department['department_id'])?'disabled="disabled"':''?> value="<?= $department['department_id']?>"><?= $department['department_name']?></option>
                                <?php }?>
                            </optgroup>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_department','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
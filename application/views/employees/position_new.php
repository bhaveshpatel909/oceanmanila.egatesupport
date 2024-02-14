<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
        
        check_position($('#new_position').val());
        
        $('#new_position').change(function(){
            check_position($('#new_position').val());
        })
    })
    
    function check_position(position_id)
    {
        $("#position_compatible").html('<img src="images/ajax-loader.gif" />');
        $.ajax({
            url:'employees/check_position/'+position_id+'/<?= $employee_id?>',    
            success:function(html){
                $('#position_compatible').html(html);
            }
        })
    }
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('New position')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_position" method="POST" id="save_position">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div id="save_result2"></div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6 no-padding">
                        <div class="form-group has-feedback">
                            <label for="new_position" class="control-label"><?= $this->lang->line('New position')?><sup class="mandatory">*</sup></label>
                            <select name="new_position" id="new_position" class="form-control required">
                            <?php foreach($positions as $department){?>
                            <optgroup label="<?= $department['name']?>">
                                <?php foreach($department['positions'] as $position){?>
                                <option <?= ($current_position['position_id']==$position['position_id'])?'disabled="disabled"':''?> value="<?= $position['position_id']?>"><?= $position['position_name']?></option>
                                <?php }?>
                            </optgroup>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group has-feedback">
                            <label for="start_date" class="control-label"><?= $this->lang->line('Start date')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="start_date" id="start_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback">
                        <label for="move_reason" class="control-label"><?= $this->lang->line('Move reason')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="move_reason" id="move_reason" class="form-control required" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label for="add_responsibilities" class="control-label"><?= $this->lang->line('Additional responsibilities')?></label>
                        <textarea rows="5" name="add_responsibilities" id="add_responsibilities" class="form-control"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div id="position_compatible"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_position','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
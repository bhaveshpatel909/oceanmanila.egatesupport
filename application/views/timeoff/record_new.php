<script>
    var employee_id;
    var empid;
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker();
        employee_id=$('#employee_id').magicSuggest({
            allowFreeEntries:false,
            data:'timeoff/find_employee',
            maxSelection:1
        });
		 empid=$('#empid').magicSuggest({
            allowFreeEntries:false,
            data:'timeoff/find_employee1',
            maxSelection:1
        });
		
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
<?php  
$userdat=$this->session->current->userdata('employee_id');




?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Record')?></h4>
            </div>
            <div class="modal-body">
                <form action="timeoff/save_record" method="POST" id="save_record">
                    <div id="save_result2"></div>
                    <input type="hidden" id="record_id" name="record_id" value="0" class="record_id">
					
					<?php if ($this->user_actions->is_selfservice()) { ?>
					<div class="form-group has-feedback">
                        <label for="empid" class="control-label"><?= $this->lang->line('Employee')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="empid" id="empid" class="form-control">
                    </div>
					<?php }else { ?>
                    <div class="form-group has-feedback">
                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="employee_id" id="employee_id" class="form-control">
                    </div>
					<?php } ?>
                    <div class="clearfix"></div>
                     <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="start_time" class="control-label"><?= $this->lang->line('Start time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="start_time" id="start_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format');?>">
                        </div>
                    </div>
				
                    <div class="col-lg-6">
                        <div class="form-group has-feedback">
                            <label class="end_time" class="control-label"><?= $this->lang->line('End time')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="end_time" id="end_time" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format');?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="type" class="control-label"><?= $this->lang->line('Type')?><sup class="mandatory">*</sup></label>
                            <select name="type" id="type" class="form-control required">
                                <?php foreach(array('Select Leave Type','vacation','sick','holidays','without notice','other') as $type){?>
								
                                <option  value="<?= $type?>"><?= $this->lang->line(ucfirst($type))?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="comment" class="control-label"><?= $this->lang->line('Comment')?></label>
                        <textarea rows="5" name="employee_comment" id="employee_comment" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="history.go(0)" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_record','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
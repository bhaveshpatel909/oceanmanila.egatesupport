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
                <h4 class="modal-title"><?= $this->lang->line('Resign')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_resign" method="POST" id="save_resign">
                    <div id="save_result2"></div>
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div class="form-group has-feedback">
                        <label for="reason" class="control-label"><?= $this->lang->line('Reason')?><sup class="mandatory">*</sup></label>
                        <select name="reason" id="reason" class="form-control required">
                            <?php foreach($reasons as $reason){?>
                            <option value="<?= $reason['reason_id']?>"><?= $reason['reason_name']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="date" class="control-label"><?= $this->lang->line('Date')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="date" id="date" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format')?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_resign','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
<script>
function refreshPage(){
  window.location.reload(history.back());
} 
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="refreshPage();"class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Performance')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_performance" method="POST" id="delete_performance">
                    <input type="hidden" id="performance_id" name="performance_id" value="<?= $performance['performance_id']?>" class="performance_id">
                </form>
                <form action="employees/save_performance" method="POST" id="save_performance">
                    <div id="save_result2"></div>
                    <input type="hidden" id="performance_id" name="performance_id" value="<?= $performance['performance_id']?>" class="performance_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $performance['employee_id']?>">
                    <div class="form-group has-feedback">
                        <label for="performance_name" class="control-label"><?= $this->lang->line('Note')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="performance_name" id="performance_name" class="form-control required" maxlength="100" value="<?= $performance['performance_name']?>">
                    </div>
                    <div class="clearfix"></div>
                    
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete performance ?') && submit_form('#delete_performance','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" onClick="refreshPage();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_performance','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
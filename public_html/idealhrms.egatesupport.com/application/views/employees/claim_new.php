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
                <h4 class="modal-title"><?= $this->lang->line('Quit Claim')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_claim" enctype="multipart/form-data" method="POST" id="save_claim">
                    <div id="save_result2"></div>
                    <input type="hidden" id="claim_id" name="claim_id" value="0" class="claim_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div class="form-group has-feedback">
                        <label for="claim_name" class="control-label"><?= $this->lang->line('Note')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="claim_name" id="claim_name" class="form-control required" maxlength="100">
                    </div>
                    <div class="clearfix"></div>
                    
                    <?php $this->load->view('mix/attachments_list',array('attachments'=>array()))?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_claim','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
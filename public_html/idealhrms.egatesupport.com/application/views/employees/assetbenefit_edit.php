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
                <h4 class="modal-title"><?= $this->lang->line('Assets & Benefits')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_assetbenefit" method="POST" id="delete_assetbenefit">
                    <input type="hidden" id="assetbenefit_id" name="assetbenefit_id" value="<?= $assetbenefit['assetbenefit_id']?>" class="assetbenefit_id">
                </form>
                <form action="employees/save_assetbenefit" method="POST" id="save_assetbenefit">
                    <div id="save_result2"></div>
                    <input type="hidden" id="assetbenefit_id" name="assetbenefit_id" value="<?= $assetbenefit['assetbenefit_id']?>" class="assetbenefit_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $assetbenefit['employee_id']?>">
                    <div class="form-group has-feedback">
                        <label for="assetbenefit_name" class="control-label"><?= $this->lang->line('Issued Assets & Benefits ')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="assetbenefit_name" id="assetbenefit_name" class="form-control required" maxlength="100" value="<?= $assetbenefit['assetbenefit_name']?>">
                    </div>
					<div class="form-group">
                        <label for="assetbenefit_name" class="control-label"><?= $this->lang->line('Returned')?></label>
						
                        <input type="checkbox" name="assetbenefit_check" id="assetbenefit_check" class="form-control" value ="1" <?php if($assetbenefit['is_returned']==1) { echo "checked=checked";}?>>
						
                    </div>
                    <div class="clearfix"></div>
                    
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete assetbenefit ?') && submit_form('#delete_assetbenefit','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" onClick="refreshPage();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_assetbenefit','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
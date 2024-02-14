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
                <button type="button" onClick="refreshPage()"class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Employment')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_contract" method="POST" id="delete_contract">
                    <input type="hidden" id="contract_id" name="contract_id" value="<?= $contract['contract_id']?>" class="contract_id">
                </form>
                <form action="employees/save_contract" method="POST" id="save_contract">
                    <div id="save_result2"></div>
                    <input type="hidden" id="contract_id" name="contract_id" value="<?= $contract['contract_id']?>" class="contract_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $contract['employee_id']?>">
                    
                    <div class="form-group has-feedback">
                        <label for="contract_type_id" class="control-label"><?= $this->lang->line('Contract Type') ?><sup class="mandatory">*</sup></label>
                        <select name="contract_type_id" id="contract_type_id" class="form-control required">
                            <option value="">Select Contract Type</option>
                            <?php foreach ($contract_types as $contract_type) { ?>
                                <option <?php echo ($contract_type['id'] == $contract['contract_type_id']) ? 'selected' : '' ?> value="<?= $contract_type['id'] ?>"><?= $contract_type['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
					 <div class="">
                    <div class="col-lg-6" style="padding-left: 0;">
                        <label for="contract_salary" class="control-label"><?= $this->lang->line('Contract Salary') ?><sup class="mandatory">*</sup></label>
                        <input type="text" name="contract_salary" id="contract_salary" class="form-control required" maxlength="12" value="<?= $contract['contract_salary']?>">                        
                    </div>
					<div class="col-lg-6" style="padding-left: 0;">
					<label for="performance_allowance_display" class="control-label"><?= $this->lang->line('Performance Allowance display') ?></label>
 <input type="text" name="performance_allowance" id="performance_allowance" class="form-control required" maxlength="12" value="<?= $contract['performance_allowance']?>">
					</div>
					</div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="contract_expiry" class="control-label"><?= $this->lang->line('Contract Expiration Date') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="contract_expiry" id="contract_expiry" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format') ?>" value="<?= $contract['contract_expiry']?>">
                        </div>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="" >
                        <div class="form-group">
                            <textarea class="form-control summernote-modal" id="content" name="content"><?= $contract['contract_content']?></textarea>
                        </div>
                    </div>
                                       
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback">
                        <label for="contract_condition" class="control-label"><?= $this->lang->line('Contract Condition') ?><sup class="mandatory"></sup></label>
                        
                        <textarea rows="5" name="contract_condition" id="contract_condition" class="form-control"><?= $contract['contract_condition']?></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete contract ?') && submit_form('#delete_contract','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button"onClick="refreshPage()" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_contract','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.summernote-modal').summernote({
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
        var content = $('textarea[name="content"]').text();
        $('.summernote-modal').summernote('code', content);
    });
</script>
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
                <h4 class="modal-title"><?= $this->lang->line('License')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_license" method="POST" id="delete_license">
                    <input type="hidden" id="license_id" name="license_id" value="<?= $license['license_id']?>" class="license_id">
                </form>
                <form action="employees/save_license" method="POST" id="save_license">
                    <div id="save_result2"></div>
                    <input type="hidden" id="license_id" name="license_id" value="<?= $license['license_id']?>" class="license_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $license['employee_id']?>">
                    <div class="form-group has-feedback">
                        <label for="license_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="license_name" id="license_name" class="form-control required" maxlength="100" value="<?= $license['license_name']?>">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="expiry" class="control-label"><?= $this->lang->line('Expiry')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="expiry" id="expiry" class="form-control datetimepicker required" value="<?= date($this->config->item('date_format'),strtotime($license['license_expiry']))?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="license_number" class="control-label"><?= $this->lang->line('Number')?><sup class="mandatory">*</sup></label>
                            <input type="text" name="license_number" id="license_number" class="form-control required" value="<?= $license['license_number']?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete license ?') && submit_form('#delete_license','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_license','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
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
                <button type="button" onClick="refreshPage();" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Required Documents')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_license" method="POST" id="delete_license">
                    <input type="hidden" id="license_id" name="license_id" value="<?= $license['license_id']?>" class="license_id">
                </form>
                <form action="employees/save_license" method="POST" id="save_license">
                    <div id="save_result2"></div>
                    <input type="hidden" id="license_id" name="license_id" value="<?= $license['license_id']?>" class="license_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $license['employee_id']?>">
                    <div class="col-lg-12" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="license_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                            <select id="list_201_document_type" class="form-control" name="document_type">
                                <option value=""></option>
                                <?php 
                                    foreach ($list_document_type as $key => $document_type) {
                                ?>
                                <option value="<?= $document_type["document_type_id"] ?>" <?= $document_type["document_type_id"] == $license['document_type_id'] ? 'selected' : ""  ?> ><?= $document_type["document_type_name"] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="expiry" class="control-label"><?= $this->lang->line('Expiry')?></label>
                            <input type="text" name="expiry" id="expiry" class="form-control datetimepicker" value="<?= $license['license_expiry'] ? date($this->config->item('date_format'),strtotime($license['license_expiry'])) : "" ?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="license_number" class="control-label"><?= $this->lang->line('Number')?></label>
                            <input type="text" name="license_number" id="license_number" class="form-control" value="<?= $license['license_number']?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete license ?') && submit_form('#delete_license','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button"  onClick="refreshPage();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_license','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
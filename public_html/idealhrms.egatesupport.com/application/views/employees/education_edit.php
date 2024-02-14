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
                <button type="button" onClick="refreshPage();"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Benefit History')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/delete_education" method="POST" id="delete_education">
                    <input type="hidden" id="education_id" name="education_id" value="<?= $data['id']?>" class="education_id">
                </form>
                <form action="employees/save_education" method="POST" id="save_education" role="form">
                    <div id="save_result2"></div>
                    <input type="hidden" id="education_id" name="education_id" value="<?= $data['id']?>" class="education_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $data['employee_id']?>">
                    <div class="form-group has-feedback">
                        <label for="institution_name" class="control-label"><?= $this->lang->line('Item')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="institution_name" id="institution_name" class="form-control required" maxlength="100" value="<?= $data['institution']?>">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="description" class="control-label"><?= $this->lang->line('Description')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="description" id="description" class="form-control required" maxlength="100" value="<?= $data['description']?>">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="start" class="control-label"><?= $this->lang->line('Start')?></label>
                            <input type="text" name="start" id="start" class="form-control datetimepicker" value="<?= $data['start']?date($this->config->item('date_format'),strtotime($data['start'])):''?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="end" class="control-label"><?= $this->lang->line('End')?></label>
                            <input type="text" name="end" id="end" class="form-control datetimepicker" value="<?= $data['end']?date($this->config->item('date_format'),strtotime($data['end'])):''?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list')?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete education ?') && submit_form('#delete_education','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button"  onClick="refreshPage();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_education','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
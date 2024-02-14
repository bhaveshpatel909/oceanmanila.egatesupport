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
                <h4 class="modal-title"><?= $this->lang->line('Benefit History')?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_education" method="POST" id="save_education" role="form">
                    <div id="save_result2"></div>
                    <input type="hidden" id="education_id" name="education_id" value="0" class="education_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                    <div class="form-group has-feedback">
                        <label for="institution_name" class="control-label"><?= $this->lang->line('Item')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="institution_name" id="institution_name" class="form-control required" maxlength="100">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="description" class="control-label"><?= $this->lang->line('Description')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="description" id="description" class="form-control required" maxlength="100">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="start" class="control-label"><?= $this->lang->line('Start')?></label>
                            <input type="text" name="start" id="start" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group">
                            <label for="end" class="control-label"><?= $this->lang->line('End')?></label>
                            <input type="text" name="end" id="end" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php $this->load->view('mix/attachments_list',array('attachments'=>array()))?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_education','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
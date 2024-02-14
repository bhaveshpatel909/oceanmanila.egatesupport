<script>
    $('document').ready(function(){
        init_icheck();
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('201 Document Type')?></h4>
            </div>
            <div class="modal-body">
                <form action="document_type/delete_document_type" method="POST" id="delete_group">
                    <input type="hidden" id="department_id" name="department_id" value="<?= $department['document_type_id']?>" class="department_id">
                </form>
                <form action="document_type/save_document_type" method="POST" id="save_group">
                    <div id="save_result2"></div>
                        <input type="hidden" id="department_id" name="department_id" value="<?= $department['document_type_id']?>" class="department_id">
                        
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#department_tab" data-toggle="tab"><?= $this->lang->line('201 Document Type')?></a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="department_tab">
                                <div class="col-lg-6" style="padding-left: 0;">
                                    <div class="form-group has-feedback m-t-sm">
                                        <label for="department_name" class="control-label"><?= $this->lang->line('201 Document Type Name')?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="department_name" id="department_name" class="form-control required" maxlength="100" value="<?= $department['document_type_name']?>">
                                    </div>
                                    <div class="form-group has-feedback m-t-sm">
                                        <label for="days_to_alert" class="control-label"><?= $this->lang->line('Days to Alert')?><sup class="mandatory">*</sup></label>
                                        <input type="number" name="days_to_alert" id="days_to_alert" class="form-control required" maxlength="4" value="<?= $department['days_to_alert'] ?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete 201 Document Type ?') && submit_form('#delete_group','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_group','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
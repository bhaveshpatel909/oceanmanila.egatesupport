<script>
    var employees_list,positions_list,departments_list;
    $('document').ready(function(){
        init_icheck();
        
        $('#permissions_all').on('ifToggled', function(event){
            $('#more_permissions').toggleClass('hide')
        });
        
        employees_list=$('#employees_list').magicSuggest({
            allowFreeEntries:false,
            data:'documents/find_employee'
        });
        
        <?php if (isset($document['permissions']['employees'])){?>
        employees_list.addToSelection(<?= json_encode($document['permissions']['employees'])?>);
        <?php }?>
            
        
        positions_list=$('#positions_list').magicSuggest({
            allowFreeEntries:false,
            data:'documents/find_position'
        });
        
        <?php if (isset($document['permissions']['positions'])){?>
        positions_list.addToSelection(<?= json_encode($document['permissions']['positions'])?>);
        <?php }?>
        
        
        departments_list=$('#departments_list').magicSuggest({
            allowFreeEntries:false,
            data:'documents/find_department'
        });
        
        <?php if (isset($document['permissions']['departments'])){?>
        departments_list.addToSelection(<?= json_encode($document['permissions']['departments'])?>);
        <?php }?>
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $document['file']?></h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="documents/delete_document" method="POST" id="delete_document">
                    <input type="hidden" id="document_id" name="document_id" value="<?= $document['document_id']?>">
                </form>
                <form action="documents/update_document" method="POST" id="save_document">
                    <input type="hidden" name="document_id" id="document_id" value="<?= $document['document_id']?>">
                    <div class="form-group">
                        <label class="control-label"><?= $this->lang->line('Permissions')?></label>
                        <div class="checkbox i-checks">
                            <input type="checkbox" name="permissions_all" id="permissions_all" <?= (isset($document['permissions']['all']))?'checked="checked"':''?> class="i-checks">
                            <label for="permissions_all" class="control-label"><?= $this->lang->line('For everyone')?></label>
                        </div>
                        
                        <div class="<?= (isset($document['permissions']['all'])?'hide':'')?>" id="more_permissions">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#employees_tab" data-toggle="tab"><?= $this->lang->line('Employees')?></a></li>
                              <li><a href="#positions_tab" data-toggle="tab"><?= $this->lang->line('Positions')?></a></li>
                              <li><a href="#departments_tab" data-toggle="tab"><?= $this->lang->line('Departments')?></a></li>
                            </ul>
                            
                            <div class="tab-content space-15">
                                <div class="tab-pane fade active in" id="employees_tab">
                                    <input type="text" id="employees_list" name="employees_list">
                                </div>
                                <div class="tab-pane fade" id="positions_tab">
                                    <input type="text" id="positions_list" name="positions_list">
                                </div>
                                <div class="tab-pane fade" id="departments_tab">
                                    <input type="text" id="departments_list" name="departments_list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="control-label" for="description"><?= $this->lang->line('Document')?></label>
                        <div class="file">
                            <div class="file-name">
                                <a href="documents/download_document/<?= $document['document_id']?>" target="_blank">
                                    <i class="fa <?= get_fa_extension($document['extenstion'])?> fa-1-5x"></i> <?= $document['file']?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Description')?></label>
                        <textarea rows="4" name="description" id="description" class="form-control"><?= $document['description']?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete document ?') && submit_form('#delete_document','#save_result2')"><?= $this->lang->line('Delete')?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_document','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
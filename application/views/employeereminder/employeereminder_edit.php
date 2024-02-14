<script>
    var employees_list,positions_list,departments_list;
    $('document').ready(function(){
		//alert("fdgdf");
        init_icheck();
        
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
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
        var content = $('textarea[name="content"]').text();
        $('.summernote-modal').summernote('code', content);
        
        $('#permissions_all').on('ifToggled', function(event){
            $('#more_permissions').toggleClass('hide')
        });
        $("#document_category_id").select2({
            placeholder: "Select Category",
            allowClear: true
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
<?php $this->load->view('mix/attachment_remove') ?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title">Edit Employee Reminder</h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="employeereminder/delete_document" method="POST" id="delete_document">
                    <input type="hidden" id="document_id" name="document_id" value="<?= $document['employeereminder_id']?>">
                </form>
                <form action="employeereminder/update_employeereminder" method="POST" id="save_document">
                    <input type="hidden" name="document_id" id="document_id" value="<?= $document['employeereminder_id']?>">
                    <div class="form-group">
                        <label class="control-label"><?= $this->lang->line('Permissions')?></label>
                        <div class="checkbox i-checks">
							<?php 
				// echo '<pre>';
				// print_r($document);
				// echo '</pre>';
				// die('vfvf');
				
				?>
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
                    <div class="form-group">
                        <?php $this->load->view('mix/attachments_list') ?>
<!--                        <label class="control-label" for="description"><?= $this->lang->line('Document')?></label>
                        <div class="file">
                            <div class="file-name">
                                <a href="documents/download_document/<?= $document['document_id']?>" target="_blank">
                                    <i class="fa <?= get_fa_extension($document['extenstion'])?> fa-1-5x"></i> <?= $document['file']?>
                                </a>
                            </div>
                        </div>-->
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="document_category_id"><?= $this->lang->line('Category') ?><sup class="mandatory">*</sup></label>
                        <?php //$categories = get_document_category(); ?>
                        <select readonly name="employeereminder_category_id" id="employeereminder_category_id" class="form-control required">
                            <option value=""></option>
                            <?php foreach ($deparment as $category) { ?>
                                <option <?php echo ($document['employeereminder_category_id'] == $category['reminder_id'])? 'selected' : ''?> value="<?= $category['reminder_id'] ?>"><?= $category['reminder_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Description') ?></label>
                        <input type="text" name="description" id="description" value="<?= $document['description']?>" class="form-control required" />
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="content"><?= $this->lang->line('Content')?></label>
                        <textarea rows="4" name="content" id="content" class="form-control summernote-modal"><?= $document['content']?></textarea>
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
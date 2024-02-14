<script>
    var employees_list, positions_list, departments_list;
	
    $('document').ready(function () {
        init_icheck();
		$('.datetimepicker').datetimepicker({pickTime: false});

        $('#permissions_all').on('ifToggled', function (event) {
            $('#more_permissions').toggleClass('hide')
        });

        employees_list = $('#employees_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_employee'
        });

        positions_list = $('#positions_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_position'
        });

        departments_list = $('#departments_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_department'
        });
        $("#document_category_id").select2({
            placeholder: "Select Category",
            allowClear: true
        });
        
        $('.summernote-modal').summernote({
            height: 150,
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
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('New document') ?></h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="documents/update_document" method="POST" id="save_document">
                    <input type="hidden" name="document_id" id="document_id" value="0">
                    <div class="form-group">
                        <label class="control-label"><?= $this->lang->line('Permissions') ?></label>
                        <div class="checkbox i-checks">
                            <input type="checkbox" name="permissions_all" id="permissions_all" checked="checked" class="i-checks">
                            <label for="permissions_all" class="control-label"><?= $this->lang->line('For everyone') ?></label>
                        </div>

                        <div class="hide" id="more_permissions">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#employees_tab" data-toggle="tab"><?= $this->lang->line('Employees') ?></a></li>
                                <li><a href="#positions_tab" data-toggle="tab"><?= $this->lang->line('Positions') ?></a></li>
                                <li><a href="#departments_tab" data-toggle="tab"><?= $this->lang->line('Departments') ?></a></li>
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
                        <?php $this->load->view('mix/attachments_list', array('attachments' => array())) ?>
<!--                        <label class="control-label" for="document"><?= $this->lang->line('Document') ?><sup class="mandatory">*</sup></label>
                        <div class="file">
                            <div class="file-name" id="document_area">
                                <input type="file" name="document" id="document" class="required">
                            </div>
                        </div>-->
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="document_category_id"><?= $this->lang->line('Category') ?><sup class="mandatory">*</sup></label>
                        <?php $categories = get_document_category(); ?>
                        <select name="document_category_id" id="document_category_id" class="form-control required">
                            <option value=""></option>
                            <?php foreach ($categories as $category) { ?>
                                <option <?php echo ($category_id == $category['document_category_id'])? 'selected' : ''?> value="<?= $category['document_category_id'] ?>"><?= $category['document_category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Description') ?></label>
                        <input type="text" name="description" id="description" class="form-control required" />
                    </div>
					<div class="form-group">
                       <label for="for_themonth" class="control-label"><?= $this->lang->line('Date Reminder') ?></label>
                            <input type="text" name="date_reminder" id="date_reminder" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                    </div>
					<div class="form-group">
                       <label for="for_themonth" class="control-label"><?= $this->lang->line('Email For Reminder') ?></label>
                            <input type="checkbox" name="email_for_reminder" id="email_for_reminder" class="form-control " value="1">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Description about forms') ?></label>
                        <textarea rows="4" name="content" id="content" class="form-control summernote-modal"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_document', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
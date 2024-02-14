<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Task') ?></h4>
            </div>
            <div class="modal-body">
                <form action="tasks/save_task" method="POST" id="save_task">
                    <div id="save_result2"></div>
                    <input type="hidden" id="task_id" name="task_id" value="0" class="task_id">
                    <div class="form-group has-feedback">
                        <label for="task_category_id" class="control-label"><?= $this->lang->line('Task category') ?><sup class="mandatory">*</sup></label>
                        <select name="task_category_id" id="task_category_id" class="form-control required">
                            <option value=""></option>
                            <?php foreach ($task_categories as $task_category) { ?>
                                <option value="<?= $task_category['task_category_id'] ?>"><?= $task_category['task_category_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div> 
                    <div class="form-group has-feedback">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="task_title" class="control-label"><?= $this->lang->line('Title') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="task_title" id="task_title" class="form-control required" maxlength="200" placeholder="Enter Title">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="" >
                        <div class="form-group">
                            <textarea class="form-control summernote-modal" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback" >
                        <div class="form-group has-feedback">
                            <label for="start_date" class="control-label"><?= $this->lang->line('Start Date') ?><sup class="mandatory"></sup></label>
                            <input type="text" name="start_date" id="start_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>
                    <div class="form-group has-feedback" >
                        <div class="form-group has-feedback">
                            <label for="due_date" class="control-label"><?= $this->lang->line('Due Date') ?><sup class="mandatory"></sup></label>
                            <input type="text" name="due_date" id="due_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback" id="employee_id_area">
                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee') ?><sup class="mandatory">*</sup></label>
                        <input type="text" name="employee_id" id="employee_id" class="form-control required">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_task', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function () {
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
        $('.datetimepicker').datetimepicker({pickTime: false});
        $("#task_category_id").select2({
            placeholder: "Select Task Category",
            allowClear: true
        });
        $('#employee_id').magicSuggest({
            allowFreeEntries: false,
            data: 'discipline/find_employee',
            maxSelection: 1
        });
    });

    var postForm = function () {
        var content = $('textarea[name="description"]').html($('.summernote-modal').eq(0).code());
    };
    
    
</script>
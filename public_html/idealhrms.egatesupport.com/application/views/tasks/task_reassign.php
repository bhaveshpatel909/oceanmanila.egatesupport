<script>
    var employees_list
    $('document').ready(function () {
        var ms = $('#employee').magicSuggest({
            placeholder: 'Filter By Employee',
            allowFreeEntries: true,
            data: 'tasks/find_employee',
            maxSelection: 1,
        });
        $(ms).on('selectionchange', function (e, m) {
                $('#employee_id').val(this.getValue());
            });
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Re Assign') ?></h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="tasks/save_assignment" method="POST" id="save_assignment">
                    <input type="hidden" name="task_ids" id="task_ids" value='<?= $task_ids ?>'>
                    <div class="form-group">
                        <input type="text" id="employee" name="employee">
                        <input type="hidden" value="" id="employee_id" name="employee_id" class="required" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_assignment', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Contract') ?></h4>
            </div>
            <div class="modal-body">
                <form action="employees/save_contract" method="POST" id="save_contract">
                    <div id="save_result2"></div>
                    <input type="hidden" id="contract_id" name="contract_id" value="0" class="contract_id">
                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id ?>">

                    <div class="form-group has-feedback">
                        <label for="contract_type_id" class="control-label"><?= $this->lang->line('Contract Type') ?><sup class="mandatory">*</sup></label>
                        <select name="contract_type_id" id="contract_type_id" class="form-control required">
                            <option value="">Select Contract Type</option>
                            <?php foreach ($contract_types as $contract_type) { ?>
                                <option value="<?= $contract_type['id'] ?>"><?= $contract_type['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="">
                    <div class="col-lg-6" style="padding-left: 0;">
                        <label for="contract_salary" class="control-label"><?= $this->lang->line('Contract Salary') ?><sup class="mandatory">*</sup></label>
                        <input type="text" name="contract_salary" id="contract_salary" class="form-control required" maxlength="12">                        
                    </div>
					<div class="col-lg-6" style="padding-left: 0;">
					<label for="performance_allowance_display" class="control-label"><?= $this->lang->line('Performance Allowance display') ?></label>
                     <input type="text" name="performance_allowance" id="performance_allowance" class="form-control" maxlength="12">
					</div>
					</div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group ">
                            <label for="contract_expiry" class="control-label"><?= $this->lang->line('Contract Expiration Date') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="contract_expiry" id="contract_expiry" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>   
                    <div class="clearfix"></div>
                    <div class="" >
                        <div class="form-group">
                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
                        </div>
                    </div>                 
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback">
                        <label for="contract_condition" class="control-label"><?= $this->lang->line('Contract Condition') ?><sup class="mandatory">*</sup></label>

                        <textarea rows="5" name="contract_condition" id="contract_condition" class="form-control required"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_contract', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
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
            ]
        });
        $('#contract_type_id').on('change', function () {
            var $id = $(this).val();
            $.ajax({
                url: 'employees/get_contract_type',
                type: 'POST',
                data: {id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.contract_type.content;
                    //console.log(data.contract_type.content);
                    $('textarea[name="content"]').html(content);
                    var content1 = $('textarea[name="content"]').text();
                    $('.summernote-modal').summernote('code', content1);
                }
            });
        });
    });

    var postForm = function () {
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(0).code());
    }
</script>
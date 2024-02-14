<?php $this->load->view('layout/header', array('title' => $this->lang->line('Work Evaluation'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
        $('#employee_id').magicSuggest({
            allowFreeEntries: false,
            data: 'evaluation/find_employee',
            maxSelection: 1
        });
        $("#evaluation_template_id").select2({
            placeholder: "Select Evaluation Name",
            allowClear: true
        });
    })
</script>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'evaluation_new')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('New record for work evaluation') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Work Evaluation') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <button class="btn btn-primary" onclick="submit_form('#save_evaluation')">
                        <i class="fa fa-floppy-o"></i>
                        <?= $this->lang->line('Save') ?>
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
                            <div class="col-lg-9">
                                <form action="evaluation/save_evaluation" method="POST" id="save_evaluation">
                                    <input type="hidden" name="evaluation_id" id="evaluation_id" value="0">
                                    <div class="col-lg-6" style="padding-left: 0;">
                                        <div class="form-group has-feedback">
                                            <label for="date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                            <input type="text" name="date" id="date"  value= "<?php echo date("Y-m-d");?>"class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee') ?><sup class="mandatory">*</sup></label>
										
										<?php
										  $gb = $_GET['empid'];
										  $gbb = $_GET['name'];
										
										if(isset($_GET['empid'])){ ?>
											<input type="hidden" id="empidd"  name="employee_id[]" value="<?php echo $gb; ?>">
											<input type="text" id ='empname'  name="employee_nm" value="<?php echo $gbb; ?>" class="form-control" disabled>
										<?php }else{ ?>
                                        <input type="text" name="employee_id" id="employee_id[]" class="form-control required">
										<?php } ?>
                                    </div>
									<div class="col-lg-6 form-group has-feedback" style="padding-left:0px">
                                        <label for="evaluation_category_id" class="control-label"><?= $this->lang->line('Evaluation Category') ?><sup class="mandatory">*</sup></label>
                                        <select name="evaluation_category_id" id="evaluation_category_id" class="form-control required">
                                            <option value="">Select</option>
                                            <?php foreach ($category as $discipline_reason) { ?>
                                                <option value="<?= $discipline_reason['id'] ?>"<?php if($cat == $discipline_reason['id']) echo"selected"; ?>><?= $discipline_reason['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group has-feedback">
                                        <label for="evaluation_template_id" class="control-label"><?= $this->lang->line('Evaluation Name') ?><sup class="mandatory">*</sup></label>
                                        <select name="evaluation_template_id" id="evaluation_template_id" class="form-control required">
                                            <!--<option value="">Select Evaluation Name</option>-->
                                            <?php foreach ($evaluation_templates as $evaluation_template) { ?>
                                                <option value="<?= $evaluation_template['id'] ?>"><?= $evaluation_template['description'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div> 
                                    <div class="" >
                                        <div class="form-group">
                                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="score" class="control-label"><?= $this->lang->line('Score point') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="score" id="score" class="form-control score-modal required">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="remark" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                                        <textarea rows="5" class="form-control" name="remark" id="remark"></textarea>
                                    </div>
<!--                                    <div class="form-group">
                                        <label for="taken_actions" class="control-label"><?= $this->lang->line('Taken actions') ?></label>
                                        <textarea rows="5" class="form-control" name="taken_actions" id="taken_actions"></textarea>
                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
		   var $id = $('#evaluation_template_id').val();
            $.ajax({
                url: 'evaluation/get_evaluation_template',
                type: 'POST',
                data: {reason_id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.evaluation_template.content;
                    var scor = data.evaluation_template.score;
                    //console.log(data.evaluation_template.content);
                    $('.summernote-modal').summernote('code', content);
                    $("#score").val(scor);
                }
            });
        $('#evaluation_template_id').on('change', function () {
            var $id = $(this).val();
            $.ajax({
                url: 'evaluation/get_evaluation_template',
                type: 'POST',
                data: {reason_id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.evaluation_template.content;
					var scor = data.evaluation_template.score;
                    //console.log(data.evaluation_template.content);
                    $('.summernote-modal').summernote('code', content);
					 $("#score").val(scor);
                }
            });
        });
		
		$('#evaluation_category_id').on('change', function () {
            var id = $(this).val();
			var empp= $('#empidd').val();
			var ename= $('#empname').val();
			//alert(empp);
			//alert(ename);
			window.location.href = 'evaluation/new_evaluation/'+id+'?empid='+empp+'&name='+ename;
		});
		
    });

    var postForm = function () {
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(0).code());
    }
</script>
<?php
$this->load->view('layout/footer')?>
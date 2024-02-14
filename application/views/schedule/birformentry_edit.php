<?php $this->load->view('layout/header', array('title' => $this->lang->line('Schedule - Add new'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>

<script>
    $('document').ready(function () {
		
		
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
//        $('.datetimepicker').datetimepicker({
//            format: 'YYYY-MM-DD HH:mm',
//            useCurrent: true
//        });

        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            pickTime: false
        });
//        $('#end_date').datetimepicker({
//            format: 'YYYY-MM-DD HH:mm',
//            useCurrent: false //Important! See issue #1075
//        });
//        $("#start_date").on("dp.change", function (e) {
//            $('#end_date').data("DateTimePicker").minDate(e.date);
//        });
//        $("#end_date").on("dp.change", function (e) {
//            $('#start_date').data("DateTimePicker").maxDate(e.date);
//        });

$('.remove_attachment1').click(function () {
			//alert("dgfd");
			var attid =$(this).attr('attachment_id');
			//var attachement_name =$(this).attr('attachement_name');
           $('#fileuploadname').val('');
           $('#attachment_'+attid).hide();
           $('#attachformfile').val('');
        });
		$('.remove_attachment2').click(function () {
			//alert("dgfd");
         //  $('#fileuploadname').val('');
		 var attidd =$(this).attr('attachment_id');
		// var attachement_name =$(this).attr('attachement_name');
           $('#attachment_'+attidd).hide();
           $('#attachpayfile').val('');
        });
        $("#schedule_item_id, #customer_item_id").select2({
            placeholder: "Select Schedule Item",
            allowClear: true
        });
        var postForm = function () {
            var content = $('textarea[name="remarks"]').html($('.summernote-modal').eq(0).code());
        }

    });

</script>
<div id="wrapper">  
<?php $this->load->view('mix/attachment_remove') ?>
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_new')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?php echo "Bir Document Input Form";?> </h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?php echo "Bir Document Input Form";?> </h2>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="schedule/bir_calendar">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" onclick="submit_form('#save_schedule')">
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
                            <div class="col-lg-12">
							<?php
							// echo "<pre>";
							// print_R($attachments);
							// echo '<hr/>';
							// echo "<pre>";
							// print_R($fileattach2);
							// ?>
                             <form action="schedule/editbirformentry" method="POST" id="save_schedule">
                    <div id="save_result2"></div>
                    <input type="hidden" id="bir_c_file_id" name="bir_c_file_id"  value="<?= $bir_file['bir_c_file_id']?>" class="bir_file_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="for_themonth" class="control-label"><?= $this->lang->line('For the month') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="for_themonth" id="for_themonth" value="<?= $bir_file['for_themonth']?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback col-lg-6" style="padding-left: 0;">
                        <label for="form_id" class="control-label"><?= $this->lang->line('Form Name') ?><sup class="mandatory">*</sup></label>
                        <select name="form_id" id="form_id" class="form-control required">
                            <option value="">Select Form Name</option>
                            <?php foreach ($bir_forms as $bir_form) { ?>
                                <option <?php echo ($bir_form['form_id'] == $bir_file['form_id']) ? 'selected' : '' ?> value="<?= $bir_form['form_id'] ?>"><?= $bir_form['form_name'] ?></option>
								
                            <?php } ?>
							
                        </select>
						
                    </div>
					<div class="form-group has-feedback col-lg-6" style="margin-top: -68px; color: red; font-size: 36px;">
                        <label for="alertchk" class="control-label"><?= $this->lang->line('Alert') ?></label>
                        <input type="checkbox" style="width: 109px; height: 21px;" <? if($bir_file['alertchk']== 1){ ?> checked <?php } ?> name="alertchk" id="alertchk" value="<?if($bir_file['alertchk']==1)
											{
												echo '0' ;
												
											}
											else{
												
												echo '1';
											}
											
											?>"  >
                    </div>
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;padding-right:0px;">
                        <label for="Form_File" class="control-label"><?= $this->lang->line('Form File') ?></label>
                        <?php $this->load->view('mix/attachments_list') ?>
                    </div>
					
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="amount" class="control-label"><?= $this->lang->line('Paid Amount') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="amount" id="amount" value="<?= $bir_file['amount']?>"  class="form-control required" maxlength="12">
                        </div>
                    </div>
					
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;padding-right:0px">
                        <label for="form_id" class="control-label m-t-sm"><?= $this->lang->line('Payment File') ?></label>
                        <?php $this->load->view('mix/attachments_list2') ?>
                    </div>
					
                    <div class="clearfix"></div>
         
                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?></label>
                        <textarea rows="1" id="remarks" name="remarks" class="form-control"><?= $bir_file['remarks']?> </textarea>
                    </div>
					
					<div class="col-lg-6" style="padding-left:8px;float:right;padding-right:0px">
                        <div class="form-group has-feedback">
                            <label for="reference" class="control-label"><?= $this->lang->line('Reference No.') ?><sup class="mandatory"></sup></label>
                            <input type="text" name="reference" id="reference"  value="<?= $bir_file['reference']?>" class="form-control" maxlength="60">
                        </div>
                    </div>
                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('layout/footer') ?>

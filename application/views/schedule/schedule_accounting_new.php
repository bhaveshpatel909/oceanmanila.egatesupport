<?php $this->load->view('layout/header', array('title' => $this->lang->line('Schedule - Add new'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<?php

print_r($res);






if($res)
{
   echo "<script>alert('Email sent successfully')</script>";
   ?>
<script>
//Using setTimeout to execute a function after 5 seconds.
setTimeout(function () {
//Redirect with JavaScript
var burl ="<?php echo base_url();?>";
window.location.href= burl+'schedule/index';
}, 200);
</script>
<?php
}
// else
// {
	// echo "<script>alert('message not sent')</script>";
	
// }

?>
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

        $("#schedule_item_id, #customer_item_id").select2({
            placeholder: "Select Schedule Item",
            allowClear: true
        });
      
    });
  var postForm = function () {
            var content = $('textarea[name="remarks"]').html($('.summernote-modal').eq(0).code());
        }
		
		
		function submit_formne(form_selector, target)
{
	
    target = target || "#save_result";

    $(target).html('<img src="images/ajax-loader.gif" />');
    change_validation_position(form_selector);
	
	// $.ajax({
// type: "POST",
// url: "http://uplushrms.peza.com.ph/schedule/save_schedule",
// data: 'ddd',
// cache: false,
// success: function(result){
// alert(result);
// }
// });

var ajxurl = "<?php echo $this->config->item('base_url');?>";
var start_date = $("#start_date").val();
var employee_id = $("#employee_id").val();
var schedule_id = $("#schedule_id").val();
var employee = $("#employee").val();
var schedule_item_id = $("#schedule_item_id").val();
var customer_item_id = $("#customer_item_id").val();
var remarks = $("#remarks").val();
var dataString = 'start_date='+ start_date + '&employee_id='+ employee_id + '&schedule_id='+ schedule_id + '&employee='+ employee + '&schedule_item_id='+ schedule_item_id + '&customer_item_id='+ customer_item_id + '&remarks='+ remarks;

          
          $.ajax({
            type: 'post',
			cache: false,
            url: ajxurl+'/schedule/save_schedule',
            data: dataString,
            success: function (response) {
				console.log(response);
              alert('form was submitted');
            }
          });


    // $(form_selector).ajaxSubmit({
        // beforeSubmit: function (arr, $form) {
			// alert("vcbhngf");
            // if ($($form).valid() == true)
            // {
				// alert("ggg");
				
                // return true;
            // }
			
            // $(target).html('');
            // return false;
        // },
        // target: target
    // });
	

	
}






</script>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_new')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('New  Accounting Schedule') ?></h2>
				<ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Schedule') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="schedule/accounting_calendar">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" onclick="submit_form('#save_accounting_schedule')">
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
                            <div id="save_result">
							
							</div>
                            <div class="col-lg-12">
                                <form action="schedule/save_accounting_schedule" method="POST" id="save_accounting_schedule">
                                    <input type="hidden" id="schedule_id" name="schedule_id" value="0" class="schedule_id">
                                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id ?>" class="employee_id">
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="start_date" class="control-label"><?= $this->lang->line('Start Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="start_date" id="start_date" value="<?php echo $_GET['selected']; ?>" class="form-control required datetimepicker" >
                                    </div>  
                                    <div class="form-group has-feedback  col-lg-5 ">
                                        <!--label for="end_date" class="control-label"><?= $this->lang->line('End Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="end_date" id="end_date" value="" class="form-control required datetimepicker" -->
                                    </div>
                                    <div class="clearfix"></div>
									<div class="form-group has-feedback  col-lg-5  no-padding">
                                        <label for="subject" class="control-label"><?= $this->lang->line('Subject') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="subject" id="subject" value="" class="form-control required" >
                                    </div>
                                    <div class="clearfix"></div>
                                    
                                   
               <div class="clearfix"></div>
  <div class="form-group has-feedback" id="employee_id_area">
    <label for="remarks" class="control-label">
	<?= $this->lang->line('Remarks') ?><sup class="mandatory">
	</sup></label>
                                        <!--textarea name="remarks" id="remarks" class="form-control summernote-modal"></textarea-->
										  <textarea class="form-control summernote-modal" id="description" name="description"></textarea>
										  
                                    </div>
                                    <div class="clearfix"></div>
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

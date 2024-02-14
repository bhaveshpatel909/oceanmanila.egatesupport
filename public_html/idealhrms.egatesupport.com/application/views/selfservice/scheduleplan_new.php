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

        $("#schedule_item_id, #customer_item_id").select2({
            placeholder: "Select Schedule Item",
            allowClear: true
        });
        var postForm = function () {
            var content = $('textarea[name="description"]').html($('.summernote-modal').eq(0).code());
        }
		
		  var content = $('textarea[name="description"]').text();
        $('.summernote-modal').summernote('code', content);
        
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: true
        });
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });
        $("#schedule_item_id, #customer_item_id").select2({
            placeholder: "Select Schedule Item",
            allowClear: true
        });
        var postForm = function () {
            var content = $('textarea[name="description"]').html($('.summernote-modal').eq(0).code());
        };
		
		$('#noti').click(function(){
			//alert('aassdd');
			$('#count').val(1);
			$('#save_schedule').submit();
		});

    });

</script>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_new')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>
<?php 
		// if(isset($message)){
			// echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		// } ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('New Schedule') ?></h2>
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
                    <a class="btn btn-warning" href="dashboard">
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
                                <form action="dashboard/save_schedule_plan" method="POST" id="save_schedule">
                                    <input type="hidden" id="schedule_id" name="schedule_id" value="0" class="schedule_id">
                                    
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="start_date" class="control-label"><?= $this->lang->line('Start Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="start_date" id="" value="<?php echo $dbstartdatge= date('Y-m-d');?>" class="form-control required" readonly>
                                    </div>  
                                    <div class="form-group has-feedback  col-lg-5 ">
<!--                                        <label for="end_date" class="control-label"><?= $this->lang->line('End Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="end_date" id="end_date" value="" class="form-control required datetimepicker" >-->
                                    </div>
                                    <div class="clearfix"></div>
                                    
											
											<div class="form-group has-feedback col-lg-5 no-padding">
											  <label for="employeename" class="control-label"><?php echo 'Employee Name'; ?><sup class="mandatory">*</sup></label>
											<input type="text" id="employee" name="employee" class="form-control" value="<?php echo $employee['name'];?>" readonly>
											<input type="hidden" id="employee_id" name="employee_id" value="<?php echo $employee['employee_id']?>" class="employee_id">
											<div>
											
										
									<?php //echo "<pre>";
									//print_r($employee);
									?>
                                    <div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="schedule_item_id" class="control-label"><?= $this->lang->line('Schedule Item') ?><sup class="mandatory">*</sup></label>
                                       <?php //echo "<pre>";
									  // print_r($schedule_items);?>
									   <input type="text" name="schedule_item_idd" value="<?php echo $schedule_items[3]['name'];?>" readonly class="form-control">
									   <input type="hidden"  name="schedule_item_id" value="<?php echo $schedule_items[3]['id'];?>">
                                    </div>
                                    <div class="clearfix"></div>
                                   
                                    <div class="clearfix"></div>

                                    <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                                        <textarea name="description" id="description" class="summernote-modal"></textarea>
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

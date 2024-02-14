<?php $this->load->view('layout/header', array('title' => $this->lang->line('Schedule - Edit'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
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
        var content = $('textarea[name="description"]').text();
        $('.summernote-modal').summernote('code', content);
        
		var conten= $('textarea[name="remarks_admin"]').text();
        $('.summernote-modal').summernote('code', conten);
		var con = $('textarea[name="remarks_employee"]').text();
        $('.summernote-modal').summernote('code', con);
		
		
		
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
		 var postForm1 = function () {
            var contentrr = $('textarea[name="remarks_admin"]').html($('.summernote-modal').eq(0).code());
        }; 
		
		var postForm2 = function () {
            var contentrr = $('textarea[name="remarks_employee"]').html($('.summernote-modal').eq(0).code());
        };
		$('#noti').click(function(){
			//alert('aassdd');
			$('#count').val(1);
			$('#save_schedule').submit();
		});
		
		$('.save_button').click(function(){
			//alert('aassdd');
			$('#count').val(1);
			$('#save_schedule').submit();
		});
		$('#save_button').click(function(){
			//alert('aassdd');
		 $("#save_result").addClass("intro");
			
		});

    });

</script>
<style>

div#remarks_emp .note-editing-area {height: 133px;}
div .intro { font-size: 24px;  background: #1ab394;  text-align: center;color: white; margin-bottom: 18px; border-radius: 5px;}
</style>
<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit Schedule') ?></h2>
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
                    <a class="btn btn-warning" href="schedule/index">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" id="save_button"onclick="submit_form('#save_schedule')">
                        <i class="fa fa-floppy-o"></i>
                        <?= $this->lang->line('Save') ?>
                    </button>
					<button id="noti" class="btn btn-primary" style="background-color:#f90000;border-color:#b90000">
                        <i class="fa fa-floppy-o"></i>
                        <?= $this->lang->line('Save&Notify') ?>
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
                                <form action="schedule/save_schedule" method="POST" id="save_schedule">
								
								
									<input type="hidden" name="count" id="count" value="0">
                                    <input type="hidden" id="schedule_id" name="schedule_id" value="<?=$schedule['schedule_id']?>" class="schedule_id">
                                    <input type="hidden" id="employee_id" name="employee_id" value="<?= $schedule['employee_id'] ?>" class="employee_id">
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="start_date" class="control-label"><?= $this->lang->line('Start Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="start_date" id="start_date" value="<?=date('Y-m-d H:i',  strtotime($schedule['start_date']))?>" class="form-control required datetimepicker" >
                                    </div>  
                                    <div class="form-group has-feedback  col-lg-5 ">
                                        <label for="end_date" class="control-label"><?= $this->lang->line('End Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="end_date" id="end_date" value="<?php if($schedule['end_date'] && $schedule['end_date'] != '0000-00-00 00:00:00' && $schedule['end_date'] != NULL ) { echo date('Y-m-d H:i',  strtotime($schedule['end_date']));}?>" class="form-control required datetimepicker" >
                                    </div>                                   
                                    <div class="clearfix"></div>
                                    <?php if (!$is_selfservice) { ?>
                                        <div class="form-group has-feedback col-lg-5 no-padding">
                                            <label for="employees"><?= $this->lang->line('Employee') ?></label>
                                            <input type="text" id="employee" name="employee">
                                        </div>
                                        <script>
                                            $('document').ready(function () {
												 document.getElementsByClassName("for_user_test").readOnly = "true";
                                                var ms = $('#employee').magicSuggest({
                                                    allowFreeEntries: false,
                                                    data: 'schedule/find_employee',
                                                    maxSelection: 1,
                                                    value: [{"id":"<?= $schedule['employee_id']?>","name":"<?= $schedule['employee_name']?>"}]
                                                });
                                                $(ms).on('selectionchange', function (e, m) {
                                                    $('#employee_id').val(this.getValue());
                                                });
                                            });
                                        </script>
                                        <div class="clearfix"></div>
                                    <?php } ?>
                                    <div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="schedule_item_id" class="control-label"><?= $this->lang->line('Schedule Item') ?><sup class="mandatory">*</sup></label>
                                        <select name="schedule_item_id" id="schedule_item_id" class="form-control required">
                                            <option value=""></option>
                                            <?php foreach ($schedule_items as $schedule_item) { 
										
											
											
											
											?>
                                                <option <?php echo $schedule['schedule_item_id'] == $schedule_item['id'] ? 'selected' : ''?> value="<?= $schedule_item['id'] ?>"><?= $schedule_item['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="customer_item_id" class="control-label"><?= $this->lang->line('Customer') ?></label>
                                        <select name="customer_item_id" id="customer_item_id" class="form-control">
                                            <option value=""></option>
                                            <?php foreach ($customer_items as $customer_item) { 
											
											
											?>
                                                <option <?php echo $schedule['customer_item_id'] == $customer_item['id'] ? 'selected' : ''?>  value="<?= $customer_item['id'] ?>"><?= $customer_item['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
									
                                    <div class="clearfix"></div>
									<?php if(!$this->user_actions->is_selfservice()){ 
							
									$admin_remark=$schedule['remarks_admin'];
									$d = new DateTime("now", new DateTimeZone('Asia/Manila'));
                                       $date = $d->format(DateTime::W3C);
								
									
									?>
                                         <div  class="form-group has-feedback" id="remarks_adminj">
                        <label for="remarks_admin" class="control-label"><?= $this->lang->line('Remarks Admin') ?></label>
         <textarea name="remarks_admin" class="summernote-modal" id="remarks_admin"><?= $admin_remark.$date; ?></textarea>
	
                                    
									<?php }else{ ?>
									
                        <label for="remarks_admin" class="control-label"><?= $this->lang->line('Remarks Employee') ?></label>
      <textarea name="remarks_employee" class="summernote-modal" id="remarks_employee">
	     <?=$schedule['remarks_employe']?></textarea>
                                    </div>
									
									
										<?php } ?>
										<?php if($this->user_actions->is_selfservice()){?>
                                    <div  class="form-group has-feedback" id="employee_id_area">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
      <textarea readonly="readonly" name="description" id="remarks" class="summernote-modal for_user_test" ><?=$schedule['remarks']?></textarea>
                                    </div>
										<?php } else{ ?>
										<div  class="form-group has-feedback" id="employee_id_area">
                                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                                        <textarea  name="description" id="remarks" class="summernote-modal"><?=$schedule['remarks']?></textarea>
										</div> <?php } ?>
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
<style>

</style>
<?php $this->load->view('layout/footer') ?>

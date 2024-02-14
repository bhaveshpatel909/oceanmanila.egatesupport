<?php $this->load->view('layout/header', array('title' => $this->lang->line('Task - Edit'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>

<?php 
if ($task['notify']) {
   $ttask = $task['notify'];
 $ttaskk = explode(" ",$ttask);
foreach($ttaskk as $taskk){
	
}
}
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
                ['height', ['height']],
                ['codeview', ['codeview']]
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
        $("#task_status").select2({
            allowClear: true
        });
		
		<?php 
			if ($task['employee_id']) {
			$ttaskk = $task['employee_id'];
			$ttaskk =	str_replace(" ",",",$ttaskk);
			
			?>
				$('#employee_id').magicSuggest({
				allowFreeEntries: false,
				
				valueField: 'id',
				displayField: 'name',
				value: [<?php echo $ttaskk; ?>],
				
                data: 'tasks/find_employee',
				
                maxSelection: 1,
            });
	
		<?php	
		} else{
		?>
			$('#employee_id').magicSuggest({
        allowFreeEntries: false,
                data: 'tasks/find_employee',
                maxSelection: 100,
        <?php if ($task['employee_id']) { ?> value: [{"id":"<?= $task['employee_id'] ?>", "name":"<?= $task['employee_name'] ?>"}]
        <?php } ?>
            });
		
		<?php } ?>
		
		<?php 
			if ($task['notify']) {
			$ttask = $task['notify'];
		   $ttask =	str_replace(" ",",",$ttask);
			
			?>
				$('#Notify').magicSuggest({
				allowFreeEntries: false,
				 data: 'tasks/find_employee',
				valueField: 'id',
				displayField: 'name',
				 maxSelection: 100,
				value: [<?php echo $ttask; ?>],
				
               
            });
	
		<?php	
		} else{
		?>
			$('#Notify').magicSuggest({
            allowFreeEntries: false,
            data: 'tasks/find_employee',
            maxSelection: 100,
            <?php if ($task['employee_id']) { ?> value: [{"id":"<?= $task['employee_id'] ?>", "name":"<?= $task['employee_name'] ?>"}]
        <?php } ?>
        });
		
		<?php } ?>
		
            $('.btn-attention button').click(function () {
                $('.btn-attention button').removeClass('active');
                $(this).addClass('active');
                $("#task_attention").val($(this).attr('task_attention'));
            })
            $('.btn-regular button').click(function () {
                $('.btn-regular button').removeClass('active');
                $(this).addClass('active');
                $("#task_regular").val($(this).attr('task_regular'));
                if($(this).attr('task_regular') == '1') {
                    $('#additional').attr('readonly', false);
                } else {
                    $('#additional').attr('readonly', true).val('');
                }
            });

    });
    
            var postForm = function () {
                var content = $('textarea[name="description"]').html($('.summernote-modal').eq(0).code());
            }
</script>
<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'tasks')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit Task') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Tasks') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="tasks/index/all">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" onclick="submit_form('#save_task')">
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
                                <form action="tasks/save_task" method="POST" id="save_task">
                                    <input type="hidden" id="task_id" name="task_id"  value="<?= $task['task_id'] ?>" class="task_id">
                                    <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="employee_id" id="employee_id" class="form-control">
                                    </div>
									<div class="form-group has-feedback" id="Notify_to">
                                        <label for="Notify" class="control-label"><?= $this->lang->line('Notify to') ?></label>
                                        <input type="text" name="Notify" id="Notify" class="form-control">
                                    </div>
                                    <div class="clearfix"></div>
									<?php   
									// echo '<pre>';
									// print_r($task);
									// echo '</pre>';
									
									?>
									  <div class="form-group has-feedback col-lg-3 no-padding">
                                        <div class="form-group has-feedback m-t-sm">
                                            <label for="task_category_id" class="control-label"><?= $this->lang->line('Related Department') ?></label>
									 <select name="workmanual_category_id" id="workmanual_category_id" class="form-control" style=" width: 328px; border-radius: 7px; height: 30px;  border: 1px solid #b1acac;
">
                            <option value="">Select</option>
                            <?php foreach ($deparment as $category) { ?>
                                <option <?php echo ($task['related_department'] == $category['department_name'])? 'selected' : ''?> value="<?= $category['department_name'] ?>"><?= $category['department_name'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
									
									
                                    <div class="form-group has-feedback col-lg-3 no-padding">
                                        <div class="form-group has-feedback m-t-sm">
                                            <label for="task_category_id" class="control-label"><?= $this->lang->line('Task Category') ?><sup class="mandatory">*</sup></label>
                                            <select name="task_category_id" id="task_category_id" class="form-control required">
                                                <?php foreach ($task_categories as $task_category) { ?>
                                                    <option <?php echo ($task_category['task_category_id'] == $task['task_category_id']) ? 'selected' : '' ?> value="<?= $task_category['task_category_id'] ?>"><?= $task_category['task_category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback col-lg-3">
                                        <div class="form-group has-feedback m-t-sm">
                                            <label for="task_title" class="control-label"><?= $this->lang->line('Task Status') ?><sup class="mandatory"></sup></label>
                                            <div class="clearfix"></div>
                                            <select id="task_status" name="task_status" class="form-control required">
                                                <option <?php echo ($task['status'] == 'unassigned') ? 'selected' : '' ?> value="unassigned">Unassigned</option>
                                                <option <?php echo ($task['status'] == 'assigned') ? 'selected' : '' ?> value="assigned">Assigned</option>
                                                <option <?php echo ($task['status'] == 'completed') ? 'selected' : '' ?> value="completed">Completed</option>
                                                <option <?php echo ($task['status'] == 'regular') ? 'selected' : '' ?> value="regular">Regular</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback col-lg-2">
                                        <div class="form-group has-feedback m-t-sm padding-left-20">
                                             <label for="task_title" class="control-label  fdth"><?= $this->lang->line('Make Task Regular') ?><span class="li_hover"><img src="http://wshrms.peza.com.ph/images/if_question.png" style="width:17px; height:15px"><sup class="mandatory"></sup><span class="on_hover">Regular task will be repeated every month - and it will not be deleted</span></span></label>
                                            <input type="hidden" name="task_regular" id="task_regular" value="<?= $task['task_regular'] ?>">
                                            <div class="clearfix"></div>
                                            <div class="btn-group btn-regular" role="group">
                                                <button type="button" class="btn btn-default <?php echo ($task['task_regular'] == 1) ? 'active' : '' ?>" task_regular="1">Yes</button>
                                                <button type="button" class="btn btn-default <?php echo ($task['task_regular'] == 0) ? 'active' : '' ?>" task_regular="0">Blank</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback col-lg-1 no-padding">
                                        <div class="form-group has-feedback m-t-sm">
                                            <label for="task_title" class="control-label">Every *th</label>
                                            <div class="clearfix"></div>
                                            <input type="text" name="additional" id="additional" value="<?=$task['additional']?>" class="form-control" <?php echo ($task['task_regular'] == 1) ? '' : 'readonly' ?> maxlength="2" />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div> 
                                    <div class="form-group has-feedback col-lg-6 no-padding">
                                        <div class="form-group has-feedback m-t-sm">                                            
                                            <label for="task_title" class="control-label"><?= $this->lang->line('Title') ?><sup class="mandatory">*</sup></label>
                                            <input type="text" name="task_title" id="task_title" value="<?= $task['task_title'] ?>" class="form-control required" maxlength="200" placeholder="Enter Title">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback col-lg-6">
                                        <div class="form-group has-feedback m-t-sm">
                                            <input type="hidden" name="task_attention" id="task_attention" value="<?= $task['task_attention'] ?>">
                                            <label for="task_title" class="control-label"><?= $this->lang->line('For Attention') ?><sup class="mandatory"></sup></label>
                                            <div class="clearfix"></div>
                                            <div class="btn-group btn-attention" role="group">
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'off') ? 'active' : '' ?>" task_attention="off">Off</button>
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'required') ? 'active' : '' ?>" task_attention="required">Have Question</button>
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'updated') ? 'active' : '' ?>" task_attention="updated">Answered</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="" >
                                        <div class="form-group">
                                            <label for="description" class="control-label"><?= $this->lang->line('Description') ?><sup class="mandatory"></sup></label>
                                            <textarea class="form-control summernote-modal" id="description" name="description"><?= $task['description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php $this->load->view('mix/attachments_list') ?>
                                    <div class="clearfix"></div>

                                    <div class="form-group has-feedback" >
                                        <div class="form-group has-feedback">
                                            <label for="start_date" class="control-label"><?= $this->lang->line('Start Date') ?><sup class="mandatory"></sup></label>
                                            <input type="text" name="start_date" id="start_date" value="<?= $task['start_date'] ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <div class="form-group has-feedback">
                                            <label for="due_date" class="control-label"><?= $this->lang->line('Due Date') ?><sup class="mandatory"></sup></label>
                                            <input type="text" name="due_date" id="due_date" value="<?= $task['due_date'] ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
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


<div class="ms-res-item" data-json="{&quot;id&quot;:&quot;62&quot;,&quot;name&quot;:&quot;Lourrey Lyn A. Saflor [Technical Support] Technician&quot;,&quot;email&quot;:&quot;lynsaflor26@gmail.com&quot;}">Lourrey Lyn A. Saflor [Technical Support] Technician</div>

<style>
label.li_hover:hover > .on_hover {
    display: block;
}
span.li_hover:hover > .on_hover {
    display: block;
}
.on_hover {
    width: 268px;
    position: absolute;
    background: #000;
    color: #fff;
    z-index: 9;
    top: -43px;
    padding: 3px 12px;
    border-radius: 9px;
    left: 0px;
    display: none;
}
</style>



<?php $this->load->view('layout/footer') ?>

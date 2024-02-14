<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Discipline'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
        $("#discipline_reason_id").select2({
            placeholder: "Select Reason",
            allowClear: true
        });
        $("#discipline_action_id").select2({
            placeholder: "Select Action",
            allowClear: true
        });
    });
    
    function delete_record(record_id)
    {
        if (confirm('<?= $this->lang->line('Delete record?')?>'))
        {
            $('#save_result').html('<img src="images/ajax-loader.gif" />');
            $.ajax({
                url:'discipline/delete_record/'+record_id,
                success:function(html){
                    $('#save_result').html(html);
                }
            });
        }
    }
</script>
<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">  
    <?php $this->load->view('layout/menu',array('active_menu'=>'discipline'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        <?php if($cat == ""){ $cat =  $record['ecatgry']; } ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $record['fullname']?>, [<?= ($record['department_name']?$record['department_name']:'-')?>] <?= ($record['position_name']?$record['position_name']:'-')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Discipline')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <div class="btn-group">
                        <button class="btn btn-primary" onclick="submit_form('#save_record')">
                            <i class="fa fa-plus-circle"></i>
                            <?= $this->lang->line('Save')?>
                        </button>
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">  
                            <li>
                                <a href="discipline/preview_record/<?= $record['record_id']?>"  target="_blank" title="preview">
                                    <?= $this->lang->line('Preview')?>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="delete_record(<?= $record['record_id']?>);return false;">
                                    <?= $this->lang->line('Delete')?>
                                </a>
                            </li>
                        </ul>
                    </div>
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
                                <form action="discipline/save_record" method="POST" id="save_record">
                                    <input type="hidden" name="record_id" id="record_id" value="<?= $record['record_id']?>">
                                    <input type="hidden" name="employee_id[]" id="employee_id" value="<?= $record['employee_id']?>">
                                    <div class="col-lg-6" style="padding-left: 0;">
                                        <div class="form-group has-feedback">
                                            <label for="date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                            <input type="text" name="date" id="date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>" value="<?php echo $record['date']?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
									<div class="col-lg-6 form-group has-feedback" style="padding-left:0px">
                                        <label for="discipline_category_id" class="control-label"><?= $this->lang->line('Discipline Category') ?><sup class="mandatory">*</sup></label>
                                        <select name="discipline_category_id" id="discipline_category_id" class="form-control required">
                                            <option value="">Select</option>
                                            <?php foreach ($category as $discipline_reason) { ?>
                                                <option value="<?= $discipline_reason['id'] ?>"<?php if($cat == $discipline_reason['id']) echo"selected"; ?>><?= $discipline_reason['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group has-feedback">
                                        <label for="discipline_reason_id" class="control-label"><?= $this->lang->line('Reason') ?><sup class="mandatory">*</sup></label>
                                        <select name="discipline_reason_id" id="discipline_reason_id" class="form-control required">
                                            <!--<option value="">Select Reason</option>-->
                                            <?php foreach ($discipline_reasons as $discipline_reason) { ?>
                                                <option <?php echo ($record['discipline_reason_id'] == $discipline_reason['id']) ? "selected" : "" ?> value="<?= $discipline_reason['id'] ?>"><?= $discipline_reason['description'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="clearfix"></div> 
                                    <div class="" >
                                        <div class="form-group">
                                            <textarea class="form-control summernote-modal" id="content" name="content"><?php echo $record["content"]?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="discipline_action_id" class="control-label"><?= $this->lang->line('Action Taken') ?><sup class="mandatory">*</sup></label>
                                        <select name="discipline_action_id" id="discipline_action_id" class="form-control required">
                                            <option value="">Select Action</option>
                                            <?php foreach ($discipline_actions as $discipline_action) { ?>
                                                <option <?php echo ($record['discipline_action_id'] == $discipline_action['id']) ? "selected" : "" ?> value="<?= $discipline_action['id'] ?>"><?= $discipline_action['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="remark" class="control-label"><?= $this->lang->line('Remarks') ?><sup class="mandatory"></sup></label>
                                        <textarea rows="5" class="form-control" name="remark" id="remark"><?= $record["remark"]?></textarea>
                                    </div>
                                    <?php $this->load->view('mix/attachments_list') ?>
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
        var content = $('textarea[name="content"]').text();
        $('.summernote-modal').summernote('code', content);
		
		var $id = $('#discipline_reason_id').val();
            $.ajax({
                url: 'discipline/get_discipline_reason',
                type: 'POST',
                data: {reason_id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.discipline_reason.content;
                    //console.log(data.discipline_reason.content);
                    $('.summernote-modal').summernote('code', content);
                }
            });
		
		
        $('#discipline_reason_id').on('change', function () {
            var $id = $(this).val();
            $.ajax({
                url: 'discipline/get_discipline_reason',
                type: 'POST',
                data: {reason_id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.discipline_reason.content;
                    //console.log(data.discipline_reason.content);
                    $('.summernote-modal').summernote('code', content);
                }
            });
        });
		
		$('#discipline_category_id').on('change', function () {
            var id = $(this).val();
			var empid = $('#record_id').val();
			window.location.href = 'discipline/edit_record/'+empid+'/'+id;
		});
		
    });

    var postForm = function () {
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(0).code());
    }
</script>
<?php $this->load->view('layout/footer')?>
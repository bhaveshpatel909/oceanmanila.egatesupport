<?php $this->load->view('layout/header', array('title' => $this->lang->line('Letter'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
//        $('#employee_id').magicSuggest({
//            allowFreeEntries: false,
//            data: 'letter/find_employee',
//            maxSelection: 1
//        });
        $("#letter_template_id").select2({
            placeholder: "Select Letter Template",
            allowClear: true
        });
    })
</script>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'letter')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('New record for work letter') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Add Letter') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="letter/index">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" onclick="submit_form('#save_letter')">
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
                                <form action="letter/save_letter" method="POST" id="save_letter">
                                    <input type="hidden" name="letter_id" id="letter_id" value="0">
                                    <div class="col-lg-6" style="padding-left: 0;">
                                        <div class="form-group has-feedback">
                                            <label for="letter_date" class="control-label"><?= $this->lang->line('Date') ?>
                                                <sup class="mandatory">*</sup>
                                            </label>
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <input type="text" name="letter_date" id="letter_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="checkbox" name="display_date" value="1" checked></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback" >
                                        <label for="letter_to" class="control-label"><?= $this->lang->line('To') ?><sup class="mandatory">*</sup></label>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" name="letter_to" id="letter_to" class="form-control required">
                                            </div>
                                            <div class="col-md-1">
                                                <input type="checkbox" name="display_letter_to" value="1" checked></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="regarding" class="control-label"><?= $this->lang->line('Regarding') ?><sup class="mandatory">*</sup></label>
                                        <div class="row">
                                            <div class="col-md-11">
                                            <input type="text" name="regarding" id="regarding" class="form-control required">
                                            </div>
                                            <div class="col-md-1">
                                                <input type="checkbox" name="display_regarding" value="1" checked></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback" >
                                        <label for="attention" class="control-label"><?= $this->lang->line('Attention') ?><sup class="mandatory">*</sup></label>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" name="attention[]" id="attention1" class="form-control required">
                                            </div>
                                            <div class="col-md-1">
                                                <input type="checkbox" name="display_attention" value="1" checked></input>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="text" name="attention[]" id="attention2" class="form-control ">
                                        <br>
                                        <input type="text" name="attention[]" id="attention3" class="form-control ">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="letter_template_id" class="control-label"><?= $this->lang->line('Letter Template') ?><sup class="mandatory">*</sup></label>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <select name="letter_template_id" id="letter_template_id" class="form-control required">
                                                    <option value="">Select Letter Name</option>
                                                    <?php foreach ($letter_templates as $letter_template) { ?>
                                                        <option value="<?= $letter_template['id'] ?>"><?= $letter_template['description'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <input type="checkbox" name="display_content" value="1" checked></input>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="clearfix"></div> 
                                    <div class="" >
                                        <div class="form-group">
                                            <textarea class="form-control summernote-modal" id="content" name="content"></textarea>
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
        //$('.note-toolbar').hide()
        $('#letter_template_id').on('change', function () {
            var $id = $(this).val();
            $.ajax({
                url: 'letter/get_letter_template',
                type: 'POST',
                data: {letter_template_id: $id},
                success: function (response) {
                    var data = $.parseJSON(response);
                    var content = data.letter_template.content;
                    //console.log(data.letter_template.content);
                    $('.summernote-modal').summernote('code', content);
                }
            });
        });
    });

    var postForm = function () {
        var content = $('textarea[name="content"]').html($('.summernote-modal').eq(0).code());
    };
</script>
<?php
$this->load->view('layout/footer')?>
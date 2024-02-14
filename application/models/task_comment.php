<?php $this->load->view('layout/header', array('title' => $this->lang->line('Task - Comment'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<?php 
// echo'<pre>';
// print_r($notifyy);
// echo'</pre>';
?>
<style>
.onmobile{ display:none}
label.control-label.onmobile {
    display: none;
}
.onmobile3333{ display:none}
@media only screen and (min-width: 767px) {
.ghyyg img.img-rounded.avatar {
    width: 46px;
}
}
@media only screen and (max-width: 767px) {
	.defult33{ display:none;}
	.onmobile3333{ display:block; float: left;  margin-top: 18px;}
	.onmobile{    
    float: left;
    margin-top: 18px;}
	.asdrf{ display:none;}
	.ghyyg img {
    max-height: 49px;
    width: auto;
    margin: auto;
    display: block;
}
.ghyyg img {
    float: left;
    margin-right: 15px;
}

.no-padding {
   
    text-align: left;
    margin: 0px auto;
}

img.img-rounded.avatar {
    max-width: 53%;
    display: inline-block;
}

.col-lg-11 {
    margin-top:10px;
    padding: 0px;
}

.col-lg-11 p {
    width: 100%;
    text-align: justify;
}
}
</style>

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
        $('.datetimepicker').datetimepicker({pickTime: false});
        $('#task_process').slider({
            formatter: function (value) {
                return value + ' %';
            }
        }).on('change', function () {
            //console.log($(this).val());
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.ajax({
                url: 'tasks/update_task_process',
                type: 'POST',
                data: {'task_id': $('#task_id').val(), 'task_process': $('#task_process').val()},
                success: function (response) {
                    //console.log(response);       
                    $('#save_result2').html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Task process has been changed!')));?>');
                }
            });
        });

        $('.btn-attention button').click(function () {
            $('.btn-group button').removeClass('active');
            $(this).addClass('active');
            var attention = $(this).attr('task_attention');
            $("#task_attention").val(attention);
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.ajax({
                url: 'tasks/update_task_attention',
                type: 'POST',
                data: {'task_id': $('#task_id').val(), 'task_attention': attention},
                success: function (response) {
                    //console.log(response);
                    $('#save_result2').html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Attention Status has been changed!')));?>');
                }
            });
        });

//        $('.task-comment-wrapper').hover(function () {
//            $(this).children('.cmt-hover').fadeIn();
//        }, function () {
//            $(this).children('.cmt-hover').hide();
//        });

        $('#comments').on("mouseleave", ".task-comment-wrapper", function (e) {
            $(this).children('.cmt-hover').hide();
        });

        $('#comments').on("mouseover", ".task-comment-wrapper", function (e) {
            $(this).children('.cmt-hover').show();
        });
    });
    function add_comment(f) {
        var url = $(f).attr('action');
        var comment = $('.summernote-modal').eq(0).summernote('code');

        $('#save_result').html('<img src="images/ajax-loader.gif" />');
        $.ajax({
            url: url,
            type: 'POST',
            data: {'task_comment_id': $('#task_comment_id').val(), 'task_id': $('#task_id').val(), 'comment': comment},
            success: function (response) {
                //console.log(response);
                $('.summernote-modal').summernote('code', '');
                $('.summernote-modal').summernote('destroy');
                $('#save_result').after(response).html('').focus();
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
                    ]
                });
            }
        });

    }
</script>
<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'tasks')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Task Summary') ?></h2>
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
                    <!--                    <button class="btn btn-primary" onclick="submit_form('#save_task')">
                                            <i class="fa fa-floppy-o"></i>
                    <?= $this->lang->line('Save') ?>
                                        </button>-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-lg-10 ">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Title') ?></label></div>
                                        <div class="col-lg-10"><?= $task['task_title'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Task Category') ?></label></div>
                                        <div class="col-lg-10"><?= $task['task_category_name'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Description') ?></label></div><span style="color:red;">
                                        <div class="col-lg-10"><?= $task['description'] ?></div></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Attachment') ?></label></div>
                                        <div class="col-lg-10"><?php $this->load->view('mix/attachments_list', array('readonly' => TRUE)) ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Start Date') ?></label></div>
                                        <div class="col-lg-10"><?= $task['start_date'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Due Date') ?></label></div>
                                        <div class="col-lg-10"><?= $task['due_date'] ?></div>
                                    </div>
									<div class="row">
                                        <div class="col-lg-2"><label for="task_title" class="control-label"><?= $this->lang->line('Notify To') ?></label></div>
										<?php foreach($notifyy as $notifyto) { ?>
                                        <div class="col-lg-10" style="float: right;"><?= $notifyto ?></div>
										<?php } ?>
                                    </div>
                                </div>
                                <form action="tasks/save_task_comment" method="POST" id="save_task_comment">
                                    <input type="hidden" id="task_comment_id" name="task_comment_id"  value="0" class="task_comment_id">
                                    <input type="hidden" id="task_id" name="task_id"  value="<?= $task['task_id'] ?>" class="task_id">

                                    <div class="" >
                                        <div class="form-group">  
                                            <label for="description" class="control-label"><?= $this->lang->line('Task process') ?></label>

                                            <div class="col-lg-12 no-padding"><input id="task_process" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?= $task['process'] ?>" name="task_process"/></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="form-group has-feedback col-lg-4 no-padding">
                                        <div class="form-group has-feedback m-t-sm">
                                            <input type="hidden" name="task_attention" id="task_attention" value="<?= $task['task_attention'] ?>">
                                            <label for="task_title" class="control-label"><?= $this->lang->line('For Attention') ?><sup class="mandatory"></sup></label>
                                            <div class="clearfix"></div>
                                            <div class="btn-group btn-attention" role="group">
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'off') ? 'active' : '' ?>" task_attention="off">Off</button>
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'required') ? 'active' : '' ?>" task_attention="required">Required</button>
                                                <button type="button" class="btn btn-default <?php echo ($task['task_attention'] == 'updated') ? 'active' : '' ?>" task_attention="updated">Updated</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="save_result2" class=""></div>
                                    <div class="" >
                                        <div class="form-group"> 
                                            <label for="description" class="control-label"><?= $this->lang->line('Leave a comment') ?></label>
                                            <textarea class="form-control summernote-modal" id="comment" name="comment"></textarea>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="button" class="btn btn-primary pull-right" onclick="add_comment('#save_task_comment')">
                                        <i class="fa fa-floppy-o"></i>
                                        <?= $this->lang->line('Save') ?>
                                    </button>
                                </form>
                                <div class="clearfix"></div>
                                <div><label for="comment" class="control-label doublestyle"><?= $this->lang->line('Comment<span>-Task Update</span>') ?><sup class="mandatory"></sup></label></div>
                                <div id="comments" class="asdfgrrt">
                                    <div id="save_result" class=""></div>
                                    <?php foreach ($task_comments as $key => $task_comment) { ?>
                                        <div class="row bs-callout bs-callout-primary task-comment-wrapper" id="task_comment_<?= $task_comment['id'] ?>">
                                            <div class="col-xs-12 col-lg-1 no-padding ghyyg">
                                                <img width="90%" src="<?= $task_comment['avatar'] ?>" alt="avatar" class="img-rounded avatar" />
<span class="onmobile3333">
                                                    Comment on <span><?= date('M d, Y', strtotime($task_comment['log_date'])) ?></span>
													</span>
                                            </div>
                                            <div class="col-xs-12 col-lg-11 ">
                                                <div >
                                                    <label class="control-label asdrf"><?php echo ($task_comment['comment_user'] ? $task_comment['comment_user'] : 'Admin') ?></label><span class="defult33">
                                                    Comment on <span><?= date('M d, Y', strtotime($task_comment['log_date'])) ?></span>
													</span>
                                                </div>
                                                <div id="comment_<?= $task_comment['id'] ?>"><?= $task_comment['comment'] ?></div>
                                            </div>
                                            <?php $userdata = $this->session->userdata(); ?>
                                            <?php if (($userdata['employee_id'] == $task_comment['from_employee']) || isset($userdata['permissions']['global_admin'])) { ?>
                                                <div class="cmt-hover" id="cmt-hover-<?= $task_comment['id'] ?>">
                                                    <a class="btn btn-outline btn-success btn-xs" href="tasks/edit_comment/<?= $task_comment['id'] ?>" data-target="#modal_window" data-toggle="modal">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete comment?') && submit_form('#delete_comment<?= $task_comment['id'] ?>', '#save_result')" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>

                                                    <form action="tasks/delete_comment" method="POST" id="delete_comment<?= $task_comment['id'] ?>">
                                                        <input type="hidden" id="task_comment_id" name="task_comment_id" value="<?= $task_comment['id'] ?>" class="task_comment_id<?= $task_comment['id'] ?>">
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">

            </div>
        </div>

    </div>
</div>
<?php $this->load->view('layout/footer') ?>





<?php $this->load->view('layout/header', array('title' => $this->lang->line('Self service'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'countdown' => TRUE)) ?>
<script>
    $('document').ready(function () {
        current_table = $('.data_table').dataTable({
            pageLength: 5
        });

        $('#update_comments').click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/orupdate_clock_comments', {comments: $('#comments').val()}, function () {
                $("#save_result2").html('');
            });
        })

        $("#complete_clock").click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/orcomplete_clock', {comments: $('#comments').val()}, function (html) {
                $("#save_result2").html('');
                $('#comments').val('');
                $('#active_clock,#start_clock').toggleClass('hide show');
                //$('#punch_clock').prepend(html);
                $('#punch_clock').html(html);
                $('#sinceCountdown').countdown('destroy');
            });
        })

        $('#start_clock_button').click(function () {
            $.ajax({url: 'dashboard/orstart_clock'});
            $('#active_clock,#start_clock').toggleClass('hide show');
            start_counter(new Date());
        })


<?php
$active_clock = (isset($clock[0]) AND is_null($clock[0]['end_time'])) ? strtotime($clock[0]['start_time']) : FALSE;

if ($active_clock) {
    ?>
            start_counter(new Date(<?= date('Y', $active_clock) ?>,<?= date('n', $active_clock) ?> - 1,<?= date('d', $active_clock) ?>, <?= date('H', $active_clock) ?>,<?= date('i', $active_clock) ?>, <?= date('s', $active_clock) ?>));
<?php } ?>
    })

    function start_counter(start_date)
    {
        $('#sinceCountdown').countdown({since: start_date, format: 'HMS', description: ' '});
    }


</script>
<script>
    $('document').ready(function () {
        $("#start_date,#end_date").datetimepicker({pickTime: false});
        $("#get_results_btn").trigger('click');
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'orignalclock')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5 title="
How it works—
Every task will be tracked by time recorded for individual task,
1. To start a new task--> Click on “Start Task”
2. To stop the task--> Click on “Stop Task”"style=" font-size:24px !important;"><?= $this->lang->line('Task Tracker') ?><span><img style="margin-left:5px;" src="images/if_Help.png" width="17px"></span><span title="" style="font-size: 17px;
 
    text-align: center !important;
    position: absolute;
	color:red;
    left: 21%;
	top: 23px;">Task mentioned by you, will be recorded with time, so that management can track time taken for each task

</span></h5>
                                </div>
                                <div class="ibox-content">
                                    <?php
                                    if ($active_clock) {
                                        $active_clock = array_shift($clock);
                                    }
                                    ?>
                                    <div id="start_clock" class="m-b-sm <?= $active_clock ? 'hide' : 'show' ?>">
                                        <button type="button" class="btn btn-primary btn-lg" id="start_clock_button">
                                            <i class="fa fa-thumb-tack"></i>
                                            <?= $this->lang->line('Start clock') ?>
                                        </button>
                                    </div>
                                    <div id="active_clock" class="<?= $active_clock ? 'show' : 'hide' ?>">
                                        <div id="sinceCountdown"></div>
                                        <div id="save_result2"></div>
                                        <div class="form-group">
                                            <label title="
How it works—
Every task will be tracked by time recorded for individual task,
1. To start a new task--> Click on “Start Task”
2. To stop the task--> Click on “Stop Task”" for="comments"><?= $this->lang->line('Task Description') ?><span><img style="margin-left:5px;"src="images/if_Help.png" width="17px"></span></label>
                                            <textarea rows="3" id="comments" class="form-control"><?= $active_clock ? $active_clock['comments'] : '' ?></textarea>
                                        </div>
                                        <div class="btn-group pull-right new-clock">
                                            <button type="button" class="btn btn-primary btn-sm" id="complete_clock">
                                                <i class="fa fa-check-circle">
                                                    <?= $this->lang->line(' Stop Task') ?></i>
                                            </button>
                                            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">  
                                                <li>
                                                    <a href="#" id="update_comments" onclick="return false;"><?= $this->lang->line('Update comments') ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr class="m-b-sm m-t-sm"/>
                                    </div>
                                    <div class="feed-activity-list" id="punch_clock">
                                        <?php $this->load->view('selfservice/orignalclock', array('clock' => $clock)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>  
                
<?php
$this->load->view('layout/footer')?>
<?php $this->load->view('layout/header', array('title' => $this->lang->line('Self service'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'countdown' => TRUE)) ?>
<script>
    $('document').ready(function () {
        current_table = $('.data_table').dataTable({
            pageLength: 5
        });

        $('#update_comments').click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/update_clock_comments', {comments: $('#comments').val()}, function () {
                $("#save_result2").html('');
            });
        })

        $("#complete_clock").click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/complete_clock', {comments: $('#comments').val()}, function (html) {
                $("#save_result2").html('');
                $('#comments').val('');
                $('#active_clock,#start_clock').toggleClass('hide show');
                //$('#punch_clock').prepend(html);
                $('#punch_clock').html(html);
                $('#sinceCountdown').countdown('destroy');
            });
        })

        $('#start_clock_button').click(function () {
            // $.ajax({url: 'dashboard/start_clock'},function() {
				// alert("dfsgd");
				// location.reload();
			// }),
			var plan= 0;
			<?php if(empty($empt_plan))
			{
				?>
				 plan = 1;
				<?php
			}
			else
			{
				?>
				plan = 2;
				<?php
			}
			?>
			if(plan==1)
			{
				alert("Pls make today's plan before you start to time in");
			}
			else
			{
			 $.post('dashboard/start_clock', {data: 'sdf'}, function (html) {
             // alert("dgzdf");
			 location.reload();
			 });
            $('#active_clock,#start_clock').toggleClass('hide show');
            start_counter(new Date());
			}
			
        })


<?php
$active_clock = (isset($clock[0]) AND is_null($clock[0]['end_time'])) ? strtotime($clock[0]['start_time']) : FALSE;

if ($active_clock) {
    ?>
	var activeclock = '<?php echo $active_clock;?>';
	//alert('<?php echo $clock[0]['start_time'];?>');
	//alert(activeclock);
	//var ddddd= new Date(<?= date('Y', $active_clock) ?>,<?= date('n', $active_clock) ?> - 1,<?= date('d', $active_clock) ?>, <?= date('H', $active_clock) ?>,<?= date('i', $active_clock) ?>, <?= date('s', $active_clock) ?>);
	//alert(ddddd);
            start_counter(new Date(<?= date('Y', $active_clock) ?>,<?= date('m', $active_clock) ?>-1,<?= date('d', $active_clock) ?>, <?= date('H', $active_clock) ?>,<?= date('i', $active_clock) ?>-10, <?= date('s', $active_clock) ?>));
<?php } ?>
    })

    function start_counter(start_date)
    {
		//alert(start_date);
		//var dated= new(Date());
		//alert(dated);
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
    <?php $this->load->view('layout/menu', array('active_menu' => 'myperformance')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>
		<?php 
		if(isset($message)){
			echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		} ?>
        <div class="row">

        <div class="col-lg-8">
            <h2><?= $this->lang->line('Employee Performance Report') ?></h2>
        </div>
        <div class="clearfix"></div>

        <div class="wrapper wrapper-content animated fadeInDown">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">  
                        <div class="ibox-title">
                            <h5><?= $this->lang->line('Options') ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <form action="dashboard/performance_dashboard" method="POST" id="proccess_report">
                                    <input type="hidden" name="report_category" id="report_category" value="discipline">
                                    <input type="hidden" name="report_type" id="report_type" value="discipline">
                                    <div id="report_options">
                                        <input type="hidden" name="employee[]" value="<?php echo $this->session->current->userdata['employee_id'] ?>" />
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="start_date"><?= $this->lang->line('Start date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="start_date" id="start_date" value="<?= date($this->config->item('date_format'), mktime(0, 0, 0, date('n'), 1)) ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div>
                                    <div class="control-group has-feedback">
                                        <label for="end_date"><?= $this->lang->line('End date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="end_date" id="end_date" value="<?= date($this->config->item('date_format'), mktime(0, 0, 0, date('n'))) ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div>
                                    <div class="clearfix m-t-lg"></div>
                                    <button type="button" class="btn btn-primary pull-right" id="get_results_btn" onclick="submit_form('#proccess_report', '#proccess_report_result')">
                                        <i class="fa fa-bar-chart-o"></i>
                                        <?= $this->lang->line('Get results') ?>
                                    </button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?= $this->lang->line('Results') ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <div id="proccess_report_result"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
$this->load->view('layout/footer')?>
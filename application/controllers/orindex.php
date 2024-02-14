<?php $this->load->view('layout/header', array('title' => $this->lang->line('Reports'), 'forms' => TRUE, 'magicsuggest' => TRUE, 'date_time' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $("#start_date,#end_date").datetimepicker({pickTime: false});
    })
</script>
<script>
     
	 
  $('document').ready(function () {
	 
	  $("#empid").keyup(function(){
            alert($(this).val());
        });
  
});

</script>


<?php
  $empname =$_GET['xy'];?>


<br>
<?php $empdepart =$_GET['de']; ?>
 
<p id="empnamee"><?php $empname.' '.'<span>['.$empdepart.']</span>' ;?>
  <?php $empid = $_GET['id'];?>

</p>


<?php 






?>





<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'orignalreports_clock')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Wrok Detail Report') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Reports') ?>
                    </li>
					 <div class="title-action" style="padding-top:30px;">
                    <a href="employees" class="btn btn-primary" style="border:1px solid #f7c029; background:#f7c029;color:white;text-align:center;margin-top: -19px;
    float: left;">
                        <i class="fa fa-fa-circle"></i>
                        <?= $this->lang->line('Back')?>
                    </a>
                </div>
                </ol>
				
				
               
         
				
				
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">  
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Options') ?></h5>                                    
                                </div>
                                <div class="ibox-content">
                                    <div>
									
                                        <form action="reports/orproccess_report" method="POST" id="proccess_report">
                                            <input type="hidden" name="report_category" id="report_category" value="clock">
                                            <input type="hidden" name="report_type" id="report_type" value="ordefault">
                                            <div class="row">
                                                <div id="report_options" class="col-lg-6">
                                                    <?php $this->load->view('reports/employee') ?>
                                                </div>
                                                <div class="form-group has-feedback col-lg-3">
                                                    <label for="start_date"><?= $this->lang->line('Start date') ?><sup class="mandatory">*</sup></label>
                                                    <input type="text" name="start_date" id="start_date" value="<?= date($this->config->item('date_format'), mktime(0, 0, 0, date('n'), 1)) ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                                </div>
                                                <div class="control-group has-feedback col-lg-3">
                                                    <label for="end_date"><?= $this->lang->line('End date') ?><sup class="mandatory">*</sup></label>
                                                    <input type="text" name="end_date" id="end_date" value="<?= date($this->config->item('date_format'), mktime(0, 0, 0, date('n'))) ?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#proccess_report')">
                                                <i class="fa fa-bar-chart-o"></i>
                                                <?= $this->lang->line('Get results') ?>
                                            </button>
                                            <button type="button" class="btn btn-success pull-right" onclick="$('#print_punch_clock').submit()" style="margin-right: 20px;">
                                                <i class="fa fa-file-pdf-o"></i>
                                                <?= $this->lang->line('Print') ?>
                                            </button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php if($empid==''){?>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Results') ?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <div id="save_result"></div>
									<?php } else {?>	
										<div class="clocktab">
		<h3><?php echo $dat['name'];?></h3>
		<table class="table table-striped table-bordered table-hover data_tablee">
		<input type="text" name="report_category" id="empid" value="<?php echo $empid; ?>">
			<thead>
				<tr>
				  <?php if (isset($data[0]['name'])) { ?>
                <th><?= $this->lang->line('Employee') ?></th>
            <?php } ?>
            <th  style="width: 8%; text-align: center;"><?= $this->lang->line('Dates') ?></th>
            <th style="width: 12%; text-align: center;"><?= $this->lang->line('In Time') ?></th>
            <th style="width: 8%; text-align: center;"><?= $this->lang->line('Out Time') ?></th>
            <th style="width: 11%; text-align: center;"><?= $this->lang->line('Working Hour') ?></th>
            <th  ><?= $this->lang->line('Comments') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($dat['punchclock'] as $record) {
             $start_time_unix = strtotime($record['start_time']);
             $end_time_unix = strtotime($record['end_time']);
            ?>
               <?php if (isset($record['name'])) { ?>
                    <td>
                        <img src="<?= $record['avatar'] ?>" class="img-circle col-lg-3 col-md-3 col-sm-4 col-xs-5"/>
                        <?= $record['name'] ?><br> [<?= $record['department_name'] ?>] <?= $record['position_name'] ?>
                    </td>
                <?php } ?>
                <td>
                    <?php
                    if ($current_date != $record['date_id']) {
                        $current_date = $record['date_id'];
                        ?>
                        <strong style="float: right;"><?= date($this->config->item('date_format'), $start_time_unix) ?></strong>
                    <?php } ?>

                </td>
                <td><p style="float: right;"><?= date('Y-m-d', strtotime($record['start_time'])) ?> <span class="text-primary text-bold"><?= date('H:i', strtotime($record['start_time'])) ?></span></p></td>
                <td>
				<p style="float: right;">
                    <?php if($record['end_time']) {?>
                    <?php if (date('Y-m-d',strtotime($record['start_time']))!=date('Y-m-d',strtotime($record['end_time']))) {?>
                    <?= date('Y-m-d', strtotime($record['end_time'])) ?> 
                    <?php } ?>
                    <span class="text-primary text-bold"><?= date('H:i', strtotime($record['end_time'])) ?></span>
                    <?php } ?>
					</p>
                </td>
                <td class="text-right text-danger text-bold">
                    <?php
//                    $datetime1 = new DateTime($record['start_time']);
//                    $datetime2 = new DateTime($record['end_time']);
//                    $interval = $datetime1->diff($datetime2);
//                    //$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %S seconds');
//                    $elapsed = $interval->format('%H:%I:%S');
//                    $days = $interval->format('%a');
//                    $hours = $interval->format('%H') + ($days * 24);
//                    $mins = $interval->format('%I');
//                    $senconds = $interval->format('%S');
//                    echo sprintf("%'.02d", $hours) . ":" . $mins . ":" . $senconds;
                    $diff = strtotime($record['end_time']) - strtotime($record['start_time']);
                    if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
                    }
                    ?>
                </td>
                <td><?= $record['comments'] ?></td>
            </tr>
			<?php 
			}
			?>
			</tbody>
			<tfoot>
        <tr>
            <?php if (isset($data[0]['name'])) { ?>
                <th></th>
            <?php } ?>
            <th colspan="3" style="text-align: right;font-weight: 700;"><?= $this->lang->line('Total time') ?></th>
            <td style="font-weight: 700;" class="text-danger text-bold text-right"><?php
                $days = floor($total_hours / 86400);
                $hours = floor(($total_hours % 86400) / 3600);
                $mins = floor((($total_hours % 86400) % 3600) / 60);
                $senconds = floor((($total_hours % 86400) % 3600) % 60);
                //echo (int) $days . ':'. ($diff % 86400);
                echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                ?></td>
            <td>

            </td>
		
        </tr>
		
    </tfoot>
	</table>
	</div>
									<?php }	?>
										
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
</div>
<?php
$this->load->view('layout/footer')?>
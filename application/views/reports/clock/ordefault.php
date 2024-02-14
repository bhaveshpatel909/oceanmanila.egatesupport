<?php 
if(isset($data['data']))
{
	// echo "<pre>";
	// print_R($data);
	foreach($data['data'] as $dat)
	{
		?>
		<style>
		.clocktab h3{color: #000;}
		.clocktab
		{
			background: #efefee;
			padding: 10px;
			margin-bottom:20px;
			box-shadow: 0px 2px 2px #ccc;
		}
		.clocktab .table-bordered {
			border: 1px solid #333!important;
		}
		.clocktab .table-bordered > thead > tr > th
		{
			border: 1px solid #333!important;
		}
		.clocktab .table-striped > tbody > tr:nth-child(2n+1) > td
		{
			background: none!important;
		   border: 1px solid #333!important;
		}
		.clocktab .table-bordered > tfoot > tr > th
		{
			border: 1px solid #333!important;
			
		}
		.clocktab .table-bordered > tfoot > tr > td
		{
			border: 1px solid #333!important;
			
		}
		.clocktab .table-bordered > tbody > tr > td
		{
			border: 1px solid #333!important;
			
		}
		</style>
		<div class="clocktab">
		<h3><?php echo $dat['name'];?></h3>
		<table class="table table-striped table-bordered table-hover data_tablee">
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
				
		<?php 
	}
}
else
{
	//echo "dcsvbdf";
	?>
	
	<table class="table table-striped table-bordered table-hover data_tablee">
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
        <?php
        $current_date = '';
        $total_hours = 0;
		 // echo "<pre>";
		// print_r($data);
        foreach ($data as $record) {
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
                        <strong  strong style="float: right;"><?= date($this->config->item('date_format'), $start_time_unix) ?></strong>
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
        <?php } ?>
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
	<?php
}
?>



<form target="_blank" action="reports/print_punch_clock" method="POST" id="print_punch_clock">
    <input type="hidden" name="jsondata" id="jsondata" value='<?= $postdata ?>' />
</form>
<script>
    $('document').ready(function () {
       // alert("edgtfaer");
	    $('td#manualadjusttime').click(function () {
			
			var record_id = $(this).attr('data-record_id');
			//alert(record_id);
			var end_time =$(this).attr('data-endtime');
			//$('#endtimee').val(end_time);
			//$('#recid').val(record_id);
			$("#myModal_"+record_id).show();
		})
		$('td#manualadjustepenality').click(function () {
			//alert("fvhbdgf");
			var record_id = $(this).attr('data-record_idd');
			//alert(record_id);
			var end_time =$(this).attr('data-ptime');
			//$('#endtimee').val(end_time);
			//$('#recid').val(record_id);
			$("#myModal1_"+record_id).show();
		}) 

		
    })
	
	function hidepop(id)
	{

		$('#myModal_'+id).hide();
		$('#prr_reprt').trigger('click');
	}
</script>
<style>

.modal {

    overflow: visible!important;
   position: absolute!important;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 99999999999999999!important;
   width: 100%!important;
   
   .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
    
</style>
<div class="clearfix m-t-lg"></div>

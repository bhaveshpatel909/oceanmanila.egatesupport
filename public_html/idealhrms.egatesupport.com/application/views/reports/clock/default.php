<?php 
$company_work_start = date("Y-m-d H:i", strtotime(date("Y-m-d"). ' ' .$details['work_start'].":00"));
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
.hhh th:nth-child(10), .hhh td:nth-child(10) { width: 280px !important;}
		
			@media only screen and (max-width: 990px) {

		div#save_result table td, div#save_result table th {
    padding: 5px;
}
}

<?php 
//print_r($details);die;
$compny_timeout_allowance = $details['timeout_allowance'];
?>
		</style>
		<div class="clocktab">
		<h3><?php  echo $dat['name'];?></h3>
		<table class="table table-striped table-bordered table-hover data_tablee hhh">
			<thead>
				<tr>
					<?php if (isset($data[0]['name'])) { ?>
						<th><?= $this->lang->line('Employee') ?></th>
					<?php } ?>
					<th><?= $this->lang->line('Dates') ?></th>
					<th><?= $this->lang->line('Actual Time In ') ?></th>
					  <th><?= $this->lang->line('Time In') ?></th>
					<th><?= $this->lang->line(' Actual Time Out') ?></th>
					<th><?= $this->lang->line('Time Out') ?></th>
					<th><?= $this->lang->line('Remarks') ?></th>
					<th><?= $this->lang->line('Time Out Notes') ?></th>
					<th><?= $this->lang->line('Overtime Details') ?></th>
					<th style="text-align:center;"><?= $this->lang->line('Working Hour') ?></th>
					<th><?= $this->lang->line('Overtime Notes') ?></th>
				</tr>
			</thead>
			<tbody>
		
			
			<?php foreach ($dat['punchclock'] as $record) {
				//print_r($details);die;
             $start_time_unix = strtotime($record['start_time']);
             $end_time_unix = strtotime($record['end_time']);
            ?>
            <tr style="position:relative;">
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
                        <strong><?= date($this->config->item('date_format'), $start_time_unix) ?></strong>
                    <?php } ?>

                </td>
                <td> <span class="text-primary text-bold"><?= date('H:i', strtotime($record['start_time'])) ?></span>  <?php echo $record['ipaddress_in'];?></td>
				<td id= "manualadjustepenality" data-record_idd ="<?php echo $record['record_id'];?>" data-ptime= "<?php echo  date('H:i', strtotime($record['penality_time']));?>"><?php if(!is_null($record['penality_time']))
				{
					//echo date('Y-m-d', strtotime($record['penality_time']))
				?>
				<span class="text-primary text-bold" style="color:red!important;">
				<?php 
				 echo  date('H:i', strtotime($record['penality_time']));
				
				
				} ?></span></td>
                <td id="manualadjusttime" data-record_id ="<?php echo $record['record_id'];?>" data-endtime= "<?php echo  date('H:i', strtotime($record['end_time']));?>" style="cursor: pointer;">
				 
				 
                    <?php if($record['end_time']) {?>
                    <span class="">
                    
                    <span class="text-primary text-bold"><?= date('H:i', strtotime($record['end_time'])) ?></span>  <?php echo $record['ipaddress_out'];?>
					
                    <?php } ?>
                </td>
                
				<td><span class="text-primary text-bold" style="color:red!important;"><?php if($record['end_time']) {
					echo date('H:i', strtotime($record['end_time'])-($compny_timeout_allowance*60));
				}?></span></td>
				
				
				<td><?php
					//if($record['overtime_remark']!="" && $record['remarks']!=""){ echo  $record['remarks'].'/'. $record['overtime_remark'];}
				// elseif ($record['overtime_remark']!="")
				// {
					// echo  $record['overtime_remark'];
				// }
				// else {
					echo  $record['remarks'];
					//}?></td>
				<td>
				<?php echo $record['overtime_remark'];?>
				</td>
				<td></td>
			
                <td  class="text-center text-danger text-bold">
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
$diffe = strtotime($record['end_time']) - strtotime($record['penality_time']);
					$endt=($record['end_time']);
						
					$endtt=(explode(" ",$endt));
					$endttt=($endtt['1']);
					
					if($endttt!= $compny_endt){
					
					$diff = $diffe;
						 
						 
						  if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
						
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
						
                    } }
					else 	 
					{
					
					
				    $diff = $diffe;
					
                    if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
						
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
						
                    }}
                    ?>
                </td>
                <td style="dedr"><?= $record['comments'] ?>
				
				
				
				<div class="modalwrap">
					<div class="modal"   id= "myModal_<?php echo $record['record_id'];?>" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" onClick="hidepop(<?php echo $record['record_id'];?>)" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
									<h4 class="modal-title"><?= $this->lang->line('Manual Adjust Time Out') ?></h4>
								</div>
								<div class="modal-body">
								<h3><i>Note:Please Edit  time  in format</i> <b style="color:red;">(HH:MM)</b></h3>
								<form method ="post" action="reports/manual_adjust" id="save_bir_file_<?php echo $record['record_id'];?>">
								   <div id="save_result2_<?php echo $record['record_id'];?>" style="color:#1AB394;font-size: 20px;  margin-bottom: 20px;"></div>
								<label> End Time</label>
								   <input type= "text" id="endtimee" name="endtime" value="<?= date('H:i', strtotime($record['end_time'])) ?>">
								   <input type= "hidden"  id="recid" name="recordid" value="<?php echo $record['record_id'];?>">
								   <input type= "hidden"  id="recid" name="recorddate" value="<?php echo  date('Y-m-d', strtotime($record['end_time']))?>">
								</div>
								<div class="modal-footer" style="margin-top:68px;">
									<button type="button" onclick ="hidepop(<?php echo $record['record_id'];?>)"  class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
									<button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_file_<?php echo $record['record_id'];?>', '#save_result2_<?php echo $record['record_id'];?>')"><?= $this->lang->line('Save') ?></button>
								</div>
								</form>
							</div>
						</div>
					</div>
					</div>
<!-------------------Model For Edit penality Time--------------------------->
<div class="modalpopup">
					<div class="modal "   id= "myModal1_<?php echo $record['record_id'];?>" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" onClick="hidepop(<?php echo $record['record_id'];?>)" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
								<h4 class="modal-title"><?= $this->lang->line('Manual Adjust Time In') ?></h4>
							</div>
							<div class="modal-body">
							<h3><i>Note:Please Edit  time  in format</i> <b style="color:red;">(HH:MM)</b></h3>
							<form method ="post" action="reports/manual_adjust_timein" id="save_bir_file1_<?php echo $record['record_id'];?>">
							   <div id="save_result3_<?php echo $record['record_id'];?>" style="color:#1AB394;font-size: 20px;  margin-bottom: 20px;"></div>
							<label>Time In</label>
							   <input type= "text" id="endtimee" name="endtime" value="<?= date('H:i', strtotime($record['penality_time'])) ?>">
							   <input type= "hidden"  id="recid" name="recordid" value="<?php echo $record['record_id'];?>">
							   <input type= "hidden"  id="recid" name="recorddate" value="<?php echo  date('Y-m-d', strtotime($record['penality_time']))?>">
							</div>
							<div class="modal-footer" style="margin-top:68px;">
								<button type="button" onclick ="hidepop(<?php echo $record['record_id'];?>)"  class="btn btn-default bgfg" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
								<button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_file1_<?php echo $record['record_id'];?>', '#save_result3_<?php echo $record['record_id'];?>')"><?= $this->lang->line('Save') ?></button>
							</div>
							</form>
						</div>
					</div>
				</div>
				</div>

<!------------------------Model code ends here------------------------>
</td>
				
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
            <th colspan="8" style="text-align: right;font-weight: 700;"><?= $this->lang->line('Total time') ?></th>
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
		$total_hours='';
	}
}
else
{
	//echo "dcsvbdf";
	//print_r($data);die;
	?>
	
	<table class="table table-striped table-bordered table-hover data_tablee ggg">
    <thead>
        <tr>
            <?php if (isset($data[0]['name'])) { ?>
                <th><?= $this->lang->line('Employee') ?></th>
            <?php } ?>
            <th><?= $this->lang->line('Dates') ?></th>
            <th><?= $this->lang->line('Actual Time In ') ?></th>
			  <th><?= $this->lang->line('Time In') ?></th>
            <th><?= $this->lang->line('Actual Time Out') ?></th>
            <th><?= $this->lang->line('Time Out') ?></th>
            <th><?= $this->lang->line('Remarks') ?></th>
            <th><?= $this->lang->line('Time Out Notes') ?></th>
            <th><?= $this->lang->line('Overtime Details') ?></th>
            <th><?= $this->lang->line('Working Hour') ?></th>
            <th><?= $this->lang->line('Overtime Notes') ?></th>
        </tr>
    </thead>
	
	<?php 

	$compny_endt= $details['work_end'];
	// echo "<pre>";
	// print_r($data);
	// echo "<pre>";
	// print_r($details);
	// die();
	$compny_timeout_allowance = $details['timeout_allowance'];
		//print_r($compny_endt);die;
	
	?>
	
    <tbody>
        <?php
        $current_date = '';
        $total_hours = 0;
		 // echo "<pre>";
		//print_r($data);die;
		// die('gvhhgjj');
	
        foreach ($data as $record) {
        	//print_r($record['penality_time']);die;
            $start_time_unix = strtotime($record['start_time']);
            $end_time_unix = strtotime($record['end_time']);
            ?>
            <tr style="position:relative;">
			
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
                        <strong><?= date($this->config->item('date_format'), $start_time_unix) ?></strong>
                    <?php } ?>

                </td>
                <td> <span class="text-primary text-bold"><?= date('H:i', strtotime($record['start_time'])) ?></span> <?php echo $record['ipaddress_in'];?></td>
				<td id= "manualadjustepenality" data-record_idd ="<?php echo $record['record_id'];?>" data-ptime= "<?php echo  date('H:i', strtotime($record['penality_time']));?>"><?php if(!is_null($record['penality_time']))
				{
					//echo date('Y-m-d', strtotime($record['penality_time']))
				?>
				
				<span class="text-primary text-bold" style="color:red!important;">
				<?php
				echo date('H:i', strtotime($record['penality_time']));
				//$record['start_time'] = substr($record['start_time'],11);
				/* if(strtotime($company_work_start) < strtotime($record['start_time'])) { 
					if($employee_late_time){
						// echo $gpenalitytime;
					 $exact =  '+'.$employee_late_time.'minute';
					$date = strtotime($date);
					$date = strtotime( $exact, $date);
					echo $lastd = date('H:i', $date);
						
						?>
						
						<?php } else{
								// echo $gpenalitytime;
					 $exact =  '+'.$details['overtime'].'minute';
					$date = strtotime($date);
					$date = strtotime( $exact, $date);
					echo $lastd = date('H:i', $date);
							
						date('H:i', strtotime($company_work_start) + $details['overtime']*60) ?>
						
						<?php }?>
				<?php }else{
					
				?>
				<?= date('H:i', strtotime($company_work_start)) ?>
				<?php 				
				}
				?> */
				?>
				</span>
				<?php } ?></td>
                <td id="manualadjusttime" data-record_id ="<?php echo $record['record_id'];?>" data-endtime= "<?php echo  date('H:i', strtotime($record['end_time']));?>" style="cursor: pointer;">
				 
				 
                    <?php if($record['end_time']) {?>
                    <span class="">
                     
                    
                    <span class="text-primary text-bold"><?= date('H:i', strtotime($record['end_time'])) ?></span> <?php echo $record['ipaddress_out'];?>
					
                    <?php } ?>
                </td>
				<td><span class="text-primary text-bold" style="color:red!important;">
				<?php if($record['end_time']) {
					echo date('H:i', strtotime($record['end_time'])-($compny_timeout_allowance*60));
				}?></span></td>
				<td><?php 
				// if($record['overtime_remark']!="" && $record['remarks']!=""){ echo  $record['remarks'].'/'. $record['overtime_remark'];}
				// elseif ($record['overtime_remark']!="")
				// {
					// echo  $record['overtime_remark'];
				// }
				// else { 
				echo  $record['remarks'];
				//}?></td>
				
				<td><?php echo $record['overtime_remark']; ?></td>
				<td></td>
			
                <td class="text-center text-danger text-bold">
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
                     // echo "<pre>";
					 // print_r($record);
					 // die();
                    $diffe = strtotime($record['end_time']) - strtotime($record['penality_time']);
					$endt=($record['end_time']);
						
					$endtt=(explode(" ",$endt));
					
					 $endttt=($endtt['1']);
					$hm=(explode(":",$endttt));
					$hmm= $hm[0].':'.$hm[1];
					//echo "<br/>";
					//echo $compny_endt;
					if($hmm!= $compny_endt){
					
						//echo "cxfgvdf";
					
					 $diff = ($diffe);
						 
						 
						  if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
						
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
						
                    }
					}
					else 	 
					{
					
					//echo "else";
				    $diff = $diffe;
					
                    if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
						
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins) ;//. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
						
                    }} 
                    ?>
                </td>
                <td style=""><?= $record['comments'] ?>
				
					
<!-------------------Model For Edit penality Time--------------------------->

<!------------------------Model code ends here------------------------>
</td>
				
            </tr>
			
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <?php if (isset($data[0]['name'])) { ?>
                <th></th>
            <?php } ?>
            <th colspan="8" style="text-align: right;font-weight: 700;"><?= $this->lang->line('Total time') ?></th>
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
table.table.table-striped.table-bordered.table-hover.data_tablee.ggg tbody tr td:nth-child(9) {
    text-align: center !important;
}

</style>
<div class="clearfix m-t-lg"></div>


					

				<style>
.modalwrap { position: fixed;  left: 0px;  top: 160px;  width: 100%;}
.modalpopup { position: fixed;  left: 0px;  top: 160px;  width: 100%; z-index:9999999999;}
				</style>
			
		  <script>
   $(".bgfg").click(function(){
    $(".modalpopup").hide();
});
    </script> 		
				
				<script>
$( ".modalwrap" ).insertAfter( "#page-wrapper" );
</script>				
<script>
$( ".modalpopup" ).insertAfter( ".wrapper-content" );
</script>

 		

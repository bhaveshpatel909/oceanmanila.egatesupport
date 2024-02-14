	<?php $this->load->view('layout/header', array('title' => $this->lang->line('Self service'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'countdown' => TRUE,'icheck'=>TRUE,'scroll'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function () {
        current_table = $('.data_table').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	  
        });
  
  
   current_tablem = $('.data_tablem').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	   "oLanguage": {
      "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'><?php echo "Work Manual".'('.$depatmentdata[0]['department_name'].')'; ?> </b>",
    }
        });
   
  current_tabler = $('.data_tabler').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	   "oLanguage": {
     // "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'>Employee Reminder  </b>",
    }
        });
		
        current_table = $('.data_tab').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	   "oLanguage": {
      "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'>Employee Request </b>",
    }
        });

			
	$('#work_category_id').change( function() { 
            current_tablem.fnFilter( $(this).val() ); 
			//alert('dvd');
       });	
	   
	   $('#reminder_category_id').change( function() { 
            current_tabler.fnFilter( $(this).val() ); 
			//alert('dvd');
       });	
	   
	   
		$('#request_category_id').change( function() { 
            current_table.fnFilter( $(this).val() ); 
			//alert('dvd');
       });	
		
		
        $('#update_comments').click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/update_clock_comments', {comments: $('#comments').val()}, function () {
                $("#save_result2").html('');
            });
        })

        $("#complete_clock").click(function () {
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            var commentt = $('#comments').val();
            
            <?php 
            	//$work_end = strtotime(date('Y-m-d H:i', strtotime($company_settings['work_end'])));
            	//$current_time = strtotime(date('Y-m-d H:i'));
            	//if($current_time > $work_end){
            ?>
            
            $.post('dashboard/complete_clock', {comments:commentt}, function (html) {
				
				//alert(html);
				// $("modalovertime .modal-body").html(html);
				if(html!="")
				{
					$("#modalovertime").show();
				}
				else
				{
					alert("dfgsf");
					$("#complete_clock").hide();
					$("#complete_clock2").show();
					$("#complete_clock2").trigger('click');
				}
                $("#save_result2").html(html);
               // $('#comments').val('');
               // $('#active_clock,#start_clock').toggleClass('hide show');
                //$('#punch_clock').prepend(html);
                //$('#punch_clock').html(html);
               // $('#sinceCountdown').countdown('destroy');
				//location.reload();
            });
        })
		$("#complete_clock2").click(function () {
			//alert("html");
			$('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/complete_clock_2', {comments: $('#comments').val()}, function (html) {
				
				//alert(html);
				// $("modalovertime .modal-body").html(html);
				
                $("#save_result2").html('');
               // $('#comments').val('');
               // $('#active_clock,#start_clock').toggleClass('hide show');
                //$('#punch_clock').prepend(html);
                //$('#punch_clock').html(html);
                $('#sinceCountdown').countdown('destroy');
				location.reload();
            });
		})

        $('#start_clock_button').click(function () {
            // $.ajax({url: 'dashboard/start_clock'},function() {
				// alert("dfsgd");
				// location.reload();
			// }),
			//alert("dsfasd");
			var plan= 0;
			var endtime= 0;

              // alert(current_Date)   ;
			//var endtime =end_Date;
			<?php 
			$date1 = date('Y-m-d');
			$datee= $clock[0]['end_time'];
			$date2 = date('Y-m-d',strtotime($datee));
			$datetimeObj1 = new DateTime($date1);
			$datetimeObj2 = new DateTime($date2);
			$interval = $datetimeObj1->diff($datetimeObj2);
			$dateDiff = $interval->format('%R%a');
			if($dateDiff == 0)
			{
			?>
			//alert("fdhbf");
			endtime =1;
			<?php 
			} 
			
			else{
				?>
				endtime =2;
				<?php 
			} 
			 if(empty($empt_plan))
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
			//alert(endtime);
			if(plan==1)
			{
				alert("Pls make today's plan before you start to time in");
			}
			else if(endtime==1)
			{
				alert("You already time out today . You can not time in at same day . Please contact admin for this matter");
			}
			else
			{
			 $.post('dashboard/start_clock', {data: 'sdf'}, function (html) {
             // alert("dgzdf");
			location.reload();
			// $('#punch_clock').html(html);
			 });
           // $('#active_clock,#start_clock').toggleClass('hide show');
            start_counter(new Date());
			}
			
        })



		<?php
$active_clock = (isset($clock[0]) AND is_null($clock[0]['end_time'])) ? strtotime($clock[0]['start_time']) : FALSE;

if ($active_clock) {
    ?>
            start_counter(new Date(<?= date('Y', $active_clock) ?>,<?= date('n', $active_clock) ?> - 1,<?= date('d', $active_clock) ?>, <?= date('H', $active_clock) ?>,<?= date('i', $active_clock) ?>, <?= date('s', $active_clock) ?>));
<?php } ?>


<?php
if(!empty($clock[0]['start_time'])) 
{
$date1 = date('Y-m-d', strtotime($clock[0]['start_time']));
$date2 = date('Y-m-d');
$timestamp1 = strtotime($date1);
$timestamp2 = strtotime($date2);
if($timestamp1 < $timestamp2 && is_null($clock[0]['end_time']) )
{
	?>
	//alert("dfzdg");
	$("#complete_clock").trigger('click');
	<?php 
}
else
{
	?>
	//alert("cbx");
	//$("#complete_clock").trigger('click');
	<?php
}
}
?>
    })

    function start_counter(start_date)
	
    {
		//alert(start_date);
		var dateObj = new Date();
		var month = dateObj.getUTCMonth() + 1; //months from 1-12
		var day = dateObj.getUTCDate();
		var year = dateObj.getUTCFullYear();
		// alert(month);
		// alert(day);
		// alert(year);
		var datee=  new Date(year, month-1, day);
		//alert(datee);			
        $('#sinceCountdown').countdown({since: datee, format: 'HMS', description: ' '});
		//$('#sinceCountdown').countdown({since: new Date(2018, 3-1, 23)});
    }




</script>

<script>
    $('document').ready(function () {
        $("#start_date,#end_date").datetimepicker({pickTime: false});
        $("#get_results_btn").trigger('click');
    })
	function savecomment()
	{
		var empoyeecmnt= $("#employee_overtimecomment").val();
		if(empoyeecmnt==''){
			alert('Please Add some comment to proceed!');
			return false;
		}
		//alert(empoyeecmnt);
		$('#comments').val(empoyeecmnt);
		$("#modalovertime").hide();
		$("#complete_clock").hide();
		$("#complete_clock2").show();
		$("#complete_clock2").trigger('click');
	
	}
	function modalclose()
	{
		$("#modalovertime").hide();
		$("#complete_clock").hide();
		$("#complete_clock2").show();
		
	}
</script>
<style>


</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'dashboard')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>
		<?php 
		if(isset($message)){
			echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		} ?>
       
<?php //echo $_SERVER['REMOTE_ADDR'];?>
                <div class="wrapper wrapper-content animated fadeInDown">

                	<div class="row visible-xs visible-sm">
                		<div class="col-lg-5">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('My Tasks')?></h5>
                                </div>
                                <div class="ibox-content fhxfghf">
                                <div>
								<table class="table table-striped table-bordered table-hover data_table_2" >
                                <thead>
                                    <tr>        
										 <th class="asss22" width="30%"><?= $this->lang->line('Start Date') ?></th>
                                        <th class="asss222" ><?= $this->lang->line('Title') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count_to_termintate = 0;?>
                                    <?php for($i = 0; $i < count($alltask); $i++) { 
                                        
                                        $task = $alltask[$i];

										 if($task['process']<100)
											{
													$processclass= 'uncomplete';
                                                    $count_to_termintate++;
                                                    if($count_to_termintate > 20){
                                                        break;
                                                    }
											}
											else
											{
												$processclass= 'complete';
                                                continue;
											}


										?>								
									
                                        <tr entity_id="<?= $task['task_id'] ?>" class="<?php echo $processclass;?>">
						
											<td  class="main_sec"><?php echo $task['start_date'];?></td>
                                            <td class="asss222">
											<div style=" position:relative;">
												<?php if($task['task_attention']=="updated"){?>
										         <b><img src="http://wshrms.peza.com.ph/images/if_check.png "style="width:13px; height:13px"></b><?php }?>
												<?php if($task['task_attention']=="required"){?>
										      <b><img src="http://wshrms.peza.com.ph/images/if_question.png"style="width:13px; height:13px"></b><?php }?>
												<?php 
											 $cday = $settingss['days'];
											
											$newdate = date('Y-m-d');
												
											 $udate = date('Y-m-d', strtotime($task['updated_date']));
											 $daysting = "+".$cday."  day";
											 $enddate = date('Y-m-d',strtotime($daysting, strtotime($udate)));
											
											if( $newdate < $enddate && $udate >= $newdate || $enddate > $newdate ){ ?>
											
											<a  style="color:red;"class="pop-btn" href="tasks/comment_task/<?= $task['task_id'] ?>" data-pop="#pop<?= $task['task_id'] ?>">
											<?= $task['task_title'] ?></a>
											<?php }  else { ?>
											
											<a class="pop-btn" href="tasks/comment_task/<?= $task['task_id'] ?>" data-pop="#pop<?= $task['task_id'] ?>"><?= $task['task_title'] ?></a>
												
												<?php } ?>
										   
												<div class="pop-dialog" id="pop<?= $task['task_id'] ?>"> <?= $task['description'] ?></div>
												</div>
											</td>
                                        </tr>
                                  
									<?php  } ?>
                                </tbody>
                            </table>
									
									
										
                                    </div>
                                </div>
                            </div>
                        </div>
                	</div>



                    <div class="row">
                        <div id="save_result"></div>
						<div class="wrapper wrapper-content animated fadeInDown">
				<div class="row">
				<div class= "col-md-12">
					<div style="padding: 0px 4px;" class="col-md-6">
					<?php if(empty($empy_plan))
					{
					
					?>
						
					
					  <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 <h5 title="
Yesterday's Pending tasks list, include
this while creating today's plan">Yesterday Plan</h5>	
							<?php 
							// echo "<pre>";
							// print_r($emppdata[0]['name']);
							// echo "</pre>";
							
							$date1= date('Y-m-d',strtotime("-1 days"));
							$dbstartdatge= date('Y-m-d',strtotime($empplann['start_date']));
							$date2= date('Y-m-d');
							?>
							
							<span>&nbsp;&nbsp;<?php echo $emppdata[0]['name'];?></span> <span>&nbsp;&nbsp;<?php echo $date2;?></span>
							<!--a href="dashboard/new_scheduleplan" class="btn btn-primary btn-sm pull-right">
							<i class="fa fa-plus-circle"></i>
							Add </a-->
							                
							
						
						
						</div>
						<div class="ibox-content">
							<div class="plan-data"> 
							
								<!--<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Employee:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Date:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['start_date'];?></div>
								</div>-->
								<!--div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Item:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Customer:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div-->
								<div class="row">
									<!--<div class="col-lg-2"><label for="" class="control-label">Remarks:</label></div>-->
									<div class="col-lg-12"><p><?php echo "No Data";?></p></div>
								</div>
						</div>
						</div>
						
						</div>
						
					<?php
					
					}
					else
					{
					?>
						<?php foreach($empy_plan as $empplan)
						{
							//echo "<pre>";
							//print_R($empplan);
							
							?>
							
							
							   <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 	<h5>Yesterday Plan</h5>	
							<?php 
							$date1= date('Y-m-d',strtotime("-1 days"));
							$dbstartdatge= date('Y-m-d',strtotime($empplan['start_date']));
							$date2= date('Y-m-d');
							?>
							
							<span>&nbsp;&nbsp;<?php echo $empplan['employee_name'];?></span> <span>&nbsp;&nbsp;<?php echo $dbstartdatge;?></span>
							  <a href="dashboard/edit_scheduleplan/<?php echo $empplan['schedule_id'];?>" class="btn btn-primary btn-sm pull-right">
							<i class="fa fa-edit"></i>
							Edit </a>                 
							
						
						
						</div>
						<div class="ibox-content">
							<div class="plan-data"> 
							
								<!--<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Employee:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Date:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['start_date'];?></div>
								</div>-->
								<!--div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Item:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Customer:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div-->
								<div class="row">
									<!--<div class="col-lg-2"><label for="" class="control-label">Remarks:</label></div>-->
									<div class="col-lg-12"><p><?php echo $empplan['remarks'];?></p></div>
									<?php if($empplann['remarks_admin'] !=''){?>
									<div class="col-lg-12"><label>Admin Message</label><p style="color:red;font-weight:bolder;"><?php echo $empplann['remarks_admin'];?></p></div><?php } ?>
									<?php if($empplann['remarks_employe'] !=''){
										
									$empd=$empplann['remarks_employe_detail'];
										$str = $empd;
                                        $name = explode(',',$str);
									
										?>
									<div class="col-lg-12"><label style="color:green;font-weight:bolder;"><?php echo $name[0].'&nbsp;&nbsp;(&nbsp;'.$name[1].'&nbsp;)&nbsp;&nbsp;'?> Message for you </label><p style="color:red;font-weight:bolder;"><?php echo $empplann['remarks_employe'];?></p></div><?php } ?>
								</div>
						</div>
						</div>
						
						</div>
						
							<?php
						}
						
					}
						?>
					</div>
					<div style="padding:0px 4px;"class="col-md-6">
					<?php// echo "<pre>";
					//print_r($emptplan);
					?>
						<?php if(empty($empt_plan))
					{
					
					?>
						
					
					  <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 <h5 title="
Create today's task list including yesterday's pending tasks, 
you can't Time In without creating this task list">Today Plan<span><img  title="This is a list of all new task plan, it is important to create 
a new plan first to generate the Punch clock function."src="images/if_Help.png" width="17px" style="margin-left:5px;"></span></h5>	
							<?php 
							// echo "<pre>";
							// print_r($emppdata);
							$date1= date('Y-m-d',strtotime("-1 days"));
							$dbstartdatge= date('Y-m-d',strtotime($empplann['start_date']));
							$date2= date('Y-m-d');
							?>
							
							<span>&nbsp;&nbsp;<?php echo $emppdata[0]['name'];?></span> <span>&nbsp;&nbsp;<?php echo $date2;?></span>
							<a href="dashboard/new_scheduleplan" class="btn btn-primary btn-sm pull-right">
							<i class="fa fa-plus-circle"></i>
							Add </a>
							                
							
						
						
						</div>
						<div class="ibox-content">
							<div class="plan-data"> 
							
								<!--<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Employee:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Date:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['start_date'];?></div>
								</div>-->
								<!--div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Item:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Customer:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div-->
								<div class="row">
									<!--<div class="col-lg-2"><label for="" class="control-label">Remarks:</label></div>-->
									<div class="col-lg-12"><p><?php echo "<p style='color: #428bca;'>Pls review yesterday's plan and make today's job plan before time in.</p>";?></p></div>
								</div>
						</div>
						</div>
						
						</div>
						
					<?php
					
					}
					else 
					{
					?>
					
						<?php foreach($empt_plan as $empplann)
						{
							// echo "<pre>";
							// print_R($empplan);
							
							?>
							
							
							   <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 <h5>Today Plan</h5>	
							<?php 
							$date1= date('Y-m-d',strtotime("-1 days"));
							$dbstartdatge= date('Y-m-d',strtotime($empplann['start_date']));
							$date2= date('Y-m-d');
							?>
							
							<span>&nbsp;&nbsp;<?php echo $empplann['employee_name'];?></span> <span>&nbsp;&nbsp;<?php echo $dbstartdatge;?></span>
							  <a href="dashboard/edit_scheduleplan/<?php echo $empplann['schedule_id'];?>" class="btn btn-primary btn-sm pull-right">
							<i class="fa fa-edit"></i>
							Edit </a>                 
							
						
						
						</div>
						<div class="ibox-content">
							<div class="plan-data"> 
							
								<!--<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Employee:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Date:</label></div>
									<div class="col-lg-10"><//?php echo $empplan['start_date'];?></div>
								</div>-->
								<!--div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Item:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div>
								<div class="row">
									<div class="col-lg-2"><label for="" class="control-label">Customer:</label></div>
									<div class="col-lg-10"><?php //echo $emppla['employee_name'];?></div>
								</div-->
								<div class="row">
									<!--<div class="col-lg-2"><label for="" class="control-label">Remarks:</label></div>-->
									<div class="col-lg-12"><p><?php echo $empplann['remarks'];?></p></div>
									<?php if($empplann['remarks_admin'] !=''){?>
									<div class="col-lg-12"><label>Admin Message</label><p style="color:red;font-weight:bolder;"><?php echo $empplann['remarks_admin'];?></p></div><?php } ?>
									
									<?php if($empplann['remarks_employe'] !=''){
										
									$empd=$empplann['remarks_employe_detail'];
										$str = $empd;
                                        $name = explode(',',$str);
									
										?>
									<div class="col-lg-12"><label style="color:green;font-weight:bolder;"><?php echo $name[0].'&nbsp;&nbsp;(&nbsp;'.$name[1].'&nbsp;)&nbsp;&nbsp;'?> Message</label><p style="color:red;font-weight:bolder;"><?php echo $empplann['remarks_employe'];?></p></div><?php } ?>
								</div>
						</div>
						</div>
						
						</div>
						
							<?php
						}
						
					}
						?>
					
					</div>
				</div>
				</div>
				</div>
                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div style="z-index: 9999999;
    position: relative;" class="ibox-title">
                                    <!--h5><?= $this->lang->line('Punch Clock') ?> <span style="position:absolute;right:22px;">Late Penalty Time: <b style="color:red;"><?php echo $emppdata[0]['late_time'].'</b> min';?></span></h5-->
									<h5 ><span title="This is the monitoring of work time in and out for todays work accomplished plan
You need to create todays task list first to enable the Time In process"><?= $this->lang->line('Punch Clock') ?></span><a  class="li_hover">  &nbsp;&nbsp;<span><img title="
1. Click +Add in Today Plan.
2. Add remarks for Today Plan.
3. Click Save
4. When a Today Plan is made, time in.
5. When work is done, time out"src="images/if_Help.png" width="17px"></span>
									</a> <button type="button" class="btn btn-primary btn-lg on_hover" style="position:absolute;right:22px;top: 9px;
    padding: 4px 8px;" id="start_clock_button">
                                            <i class="fa fa-thumb-tack"></i>
                                            <?= $this->lang->line('Time In ') ?>
											<span class="hover_text" style ="display:none;">Time in & out should be at the assigned network - if recorded  IP is different, it will be considered as void. It will cause warning</span>
                                        </button></h5>
                                </div>
                                <div style="padding-top:0px;"class="ibox-content ibox-content22">
                                   
									<?php 
									/* echo date('n', $active_clock);
									echo "</br>";
									echo date('Y', $active_clock);
									echo "</br>";
									echo date('H', $active_clock);
									echo "</br>";*/
									//echo date('i', $active_clock);
									//echo "</br>";
									//echo date('s', $active_clock);
									//echo "</br>"; 
									// echo "<pre>";
									// print_r($clock)
                                    // if ($active_clock) {
                                        // $active_clock = array_shift($clock);
                                    // }
									// echo "<pre>";
									// print_r($clock);
									 // echo $active_clock;
									 
									?>
									
									 <div id="start_clock" style="display:none !important; position: sticky;z-index: 999;float:left;margin-top: 15px;" class="col-lg-offset-3 m-b-sm <?= $active_clock ? 'hide' : 'show' ?>">
                                        
                                    </div>
                               
                                    <div id="active_clock" class="<?= $active_clock ? 'show' : 'hide' ?>">
                                        <div id="sinceCountdown"></div>
                                        <div id="save_result2"></div>
                                        <div class="form-group">
                                            <label for="comments"><?= $this->lang->line('Comments') ?></label>
                                            <textarea rows="3" id="comments" class="form-control"><?= $active_clock ? $active_clock['comments'] : '' ?></textarea>
                                        </div>
										 <div id="rrrrrrrrrrrr" style="position: sticky;z-index: 999;" class="col-lg-offset-3 m-b-sm">
									<a href="tasks/selftask">
		                            <button class="btn btn-lg btn-primary" type="button" style=""><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;My Tasks</button>
									   
									   
									   
									   </a>
                                      
                                        
                                    </div>
                                        <div class="btn-group pull-right" style="position: sticky;z-index: 999;">
                                            <button type="button" class="on_hover btn btn-primary btn-sm" id="complete_clock">
                                                <i class="fa fa-check-circle">
                                                    <?= $this->lang->line('Time Out') ?></i>
													<span class="hover_text hover_texterr">Time in & out should be at the assigned network - if recorded  IP is different, it will be considered as void. It will cause warning</span>
                                            </button>
											<button type="button" class="btn btn-primary btn-sm" id="complete_clock2" style="display:none;">
                                                <i class="fa fa-check-circle">
                                                    <?= $this->lang->line('Time Out') ?></i>
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
									 <div class="responsive2">
<?php //echo'<pre>'; print_r($clock);echo'</pre>';?>
                                        <?php $this->load->view('selfservice/clock', array('clock' => $clock)) ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
							  
							  
							  		<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content ">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="ibox-title" style="border-bottom:1px #ddd solid !important; border-top: none; margin-top: -15px; margin-bottom: 13px;">
   <h5 title="This was all the list of all the reminder to all employees with its specific description
you can view all the list of employee reminder by category list and description" style="font-size: 14px;
    margin-bottom: 15px;
    color: #676a6c;
    font-weight: 700;"><?php echo "Employee Reminder";?> </h5>
     

	 <?php if($emppdata[0]['write_rem']=="0") { ?>
	 
	   <a href="employeereminder/new_employeereminder/<?php echo '?cat='.$nameee; ?>" style="float: right; margin-top: 15px;" class="btn btn-primary" 
			 data-toggle="modal" data-target="#modal_window">
                    <i class="fa fa-plus-circle"></i>
                 <?= $this->lang->line('New')?>
                </a>
                                 <?php } ?>
                        </div>
						<div class="responsive1">
                            <table class="table table-striped table-bordered table-hover data_tabler" >
							<div class="col-md-3" style="float: right; margin-right: 626px;">
								<div class="my-slect">
							 <select name="request_category_id" id="reminder_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                           <?php foreach ($deparment as $category) { ?>
                                <option value="<?= $category['reminder_name'] ?>"><?= $category['reminder_name'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
                                <thead>
                                    <tr>
                                        <th style="width:5%; padding-left:7px; !important">ID</th>
										<th style="width:8%;"><?= $this->lang->line('Date') ?></th>
										 <th style="width:13%;"><?= $this->lang->line('Category Name') ?></th>
                                        <th style="10%;"class="mn_width"><?= $this->lang->line('Description') ?></th>
                                        <th style="width:13%; text-align:center;"><?= $this->lang->line('File Attachment') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employeereminder['data'] as $index => $document) { ?>
                                        <tr entity_id="<?= $document['employeereminder_id'] ?>">
                                            <td class="idmanual"><?= $document['employeereminder_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td > <?= $document['cname'] ?></td>
											 <td class="mn_width" id= "<?= $document['employeereminder_id'] ?>" class="">
											 <a class="btn   btn-xs" href="employeereminder/edit_document2/<?= $document['employeereminder_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                   <?= $document['description'] ?>
                                                </a>
											
											</td>
											
                                            
                                            <td style="text-align:center;">
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) { ?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td style="text-align:center;">
                                          <?php
                                           
										  if($emppdata[0]['edit_rem']=="0") { ?>
                                                <a class="btn btn-outline btn-success btn-xs" href="employeereminder/edit_document/<?= $document['employeereminder_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
									<?php } ?>
												                                          <?php
                                           
										  if($emppdata[0]['delete_rem']=="0") { ?>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['employeereminder_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                	<?php } ?>
                                                <form action="employeereminder/delete_document" method="POST" id="delete_document<?= $document['employeereminder_id'] ?>">
                                                    <input type="hidden" id="employeereminder_id" name="employeereminder_id" value="<?= $document['employeereminder_id'] ?>" class="employeereminder_id<?= $document['employeereminder_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
				
							  
				
						
   
                        <div class="clearfix"></div>                       

                    </div>
                </div>
				<div class="wrapper wrapper-content animated fadeInDown">
				<div class="row">
              	<div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5 title="This was all the list of Leave request that is subject for approval, 
you need to register all the leave here so the request will be valid"><?= $this->lang->line('Leave tracking') ?></h5>
							<a class="li_hover">  &nbsp;&nbsp;<span class="baloon-msg li_hover"><img src="images/if_Help.png" width="1%"></span>
									<span class="hover_button">File leave here for approval. If leave is not filed here, it will not be accepted and considered invalid.</span></a>
								 <?php
                              // echo '<pre>';
							  // print_R($emppdata);
                              // echo '</pre>';

								 if($emppdata[0]['write_lea']=="0") { ?>
								 
                            <a href="dashboard/new_timeoff" class="btn btn-primary btn-sm pull-right" data-target="#modal_window" data-toggle="modal">
                                <i class="fa fa-plus-circle"></i>
                                <?= $this->lang->line('Add') ?>
                            </a>
								 <?php } ?>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('Dates') ?></th>
                                        <th><?= $this->lang->line('Type / Status') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($timeoff as $record) { ?>
                                        <tr entity_id="<?= $record['record_id'] ?>">
                                            <td><?= date($this->config->item('date_format') . ' ' . $this->config->item('time_format'), strtotime($record['start_time'])) ?> - <?= date($this->config->item('date_format') . ' ' . $this->config->item('time_format'), strtotime($record['end_time'])) ?></td>
                                            <td><?= $this->lang->line(ucfirst($record['type'])) ?> / <?= $this->lang->line(ucfirst($record['status'])) ?></td>
                                            <td>
											
											<?php  if($emppdata[0]['edit_lea']=="0") { ?>
                                                <a class="btn btn-outline btn-success" href="dashboard/timeoff/<?= $record['record_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-briefcase"></i>
                                                </a>
											<?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                </div>
        
        <div class="wrapper wrapper-content animated fadeInDown">
            <div class="row">
                <?php 
				
				$nameee = $depatmentdata[0]['department_name'];
				?>
            </div>
        </div>
        <div class="clearfix"></div>
       
        <div class="clearfix"></div>
		<?php 
		
		// echo "<pre>";
							// print_r($emppdata);
							// echo "</pre>";
		//echo "<pre>";
		//print_R($workmnaualdata);
		//echo "<pre>";
		//print_R($depatmentdata);
		
		?>
       <div class="col-lg-8">
           
        </div>
        <div class="clearfix"></div>
		
	<!--	<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
					
                        <div class="row" >
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px;">
                            <h5 style="font-size: 23px; margin-bottom: 15px; color: orange;"><!--<//?php echo "Work Manual".'('.$depatmentdata[0]['department_name'].')'; ?></h5>
                         <!--  <a href="workmanual/new_workmanual/<//?php echo '?cat='.$nameee; ?>" style="float: right; margin-top: 15px;" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <//?= $this->lang->line('New')?>
                    </a>
                        </div>
						
						
				
                            <table class="table table-striped table-bordered table-hover data_tablem" >
							<div class="col-md-3" style="float: right; margin-right: 626px;">
								<div class="my-slect">
							 <select name="request_category_id" id="work_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                           <//?php foreach ($deparmentw as $category) { ?>
                                <option value="<//?= $category['department_name'] ?>"><//?= $category['department_name'] ?></option>
                            <//?php } ?>
                        </select>
						</div>
						</div>
						
						
<thead>
	
			 
                                    <tr>
									
                                        <th >ID</th>
										 <th ><//?= $this->lang->line('Date') ?></th>
                                        <th ><//?= $this->lang->line('Category Name') ?></th>
                                        <th ><//?= $this->lang->line('Description') ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <//?php foreach ($workmnaualdata['data'] as $index => $document) { ?>
                                        <tr entity_id="<//?= $document['workmanual_id'] ?>">
                                            <td><//?= $document['workmanual_id'] ?></td>
											<td><//?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td><//?= $document['cname'] ?></td>
                                            <td><//?= $document['description'] ?></td>
                                             <td>
                                                <div class="file-name wrapword">
                                                    <//?php foreach ($document['attachments'] as $attachment) {
														
														?>
                                                        <//?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<//?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></a></div>
                                                        <//?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<//?php echo base_url('files/attachments/' . $attachment['location']) ?>" ></i> <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></a></div>
                                                        <//?php } ?>
                                                    <//?php } ?>
                                                </div>
                                            </td>                                            
                                            <td>

                                                <a class="btn btn-outline btn-success btn-xs" href="workmanual/edit_document/<//?= $document['workmanual_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!--a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<//?= $document['workmanual_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a-->

                                              <!--  <form action="workmanual/delete_document" method="POST" id="delete_document<//?= $document['workmanual_id'] ?>">
                                                    <input type="hidden" id="workmanual_id" name="workmanual_id" value="<//?= $document['workmanual_id'] ?>" class="workmanual_id<//?= $document['workmanual_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    <//?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->
		
		
        <div class="clearfix"></div>

				<!--Employeee request -->
			
			<?php $ggfg = $emppdata[0]['name'];
			
			 
			
			?>
        <div class="clearfix"></div>
		<style>

		.on_hover:hover >.hover_text {
    display: block;
}
.hover_text {
    position: absolute;
    background: #000;
    padding: 5px 15px;
    font-size: 12px;
    border-radius: 15px;
    left: 100%;
    display: none;    top: 13px;
}
		.hover_button{ margin-left:0px;}
		.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;right: -169px;
}
		span.hover_text.hover_texterr {
    left: auto;
    right: 100%;
    top: 0px;
}
.table.table-striped th ,
.table.table-striped td {padding:4px;}
div#rrrrrrrrrrrr {
    float: right;
    margin-left: 15px;
}
div#rrrrrrrrrrrr button {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
}
@media only screen and (max-width: 990px) {
	
	.responsive1 .mn_width a {
    max-width: 100px !important;
    white-space: normal;
}
}
	
@media only screen and (max-width: 767px) {	
	
body .responsive2 th, .responsive2 td {    padding:2px !IMPORTANT;    font-size: 10px;}
.ibox-content.ibox-content22 {    padding: 15px 8px 20px 8px;}
#page-wrapper { padding: 0 5px;}
.responsive1 .mn_width a {  font-size: 9px;  text-align: left;  padding: 1px 0px;}
.responsive1 th, .responsive1 td {
    font-size: 9px;
}
.responsive1 th a, .responsive1 td a{
    font-size: 9px;
}
.gray-bg .row.border-bottom {
    margin: 0px;
}

}	

@media only screen and (max-width: 480px) {	
.wrapper-content {
    padding: 20px 5px 0px 5px;
}
div.dataTables_filter label {
    float: left;
    font-weight: normal;
    margin-left: 13px;
}
div.dataTables_length select {margin-left: 15px; margin-bottom: 10px;}
body .responsive2 th, .responsive2 td {
    padding: 2px 1px !important;
    font-size: 10px;
}
div.dataTables_paginate {  float: left; margin-top: 10px;}
div#rrrrrrrrrrrr button.btn.btn-lg.btn-primary {

}
div#rrrrrrrrrrrr {
    float: right;
}
.responsive2 th:nth-child(6), .responsive2 td:nth-child(6) {
    width: 50px !important;
    max-width: 50px !important;
    min-width: 50px !important;
}
div#DataTables_Table_1_length b { font-size: 18px !important;}

}	

@media only screen and (max-width: 380px) {	
body .responsive2 th, .responsive2 td {
    padding: 2px 1px !important;
    font-size: 8px;
}
}
	table#DataTables_Table_1 {
    border-top: 1px #dddddd solid !important;
}	

tr.odd td:nth-child(4) a {
    font-size: 13px !IMPORTANT;
}
a.btn.btn-xs {
    font-size: 13px;
}
.table.table-striped th, .table.table-striped td {
    padding: 2px !Important;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
}
div#DataTables_Table_1_wrapper{
	width:98% !Important;
	margin:auto !important;
}
table#DataTables_Table_1 thead tr th:nth-child(1) {
   text-align:center !Important;
}
tr.odd td:nth-child(1) {
    text-align:center !Important;
}
tr.even td:nth-child(1) {
     text-align:center !Important;
}
</style>
		<!--<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px;">
					
   <h5 style="font-size: 23px; margin-bottom: 15px; color: orange;"><!--<//?php echo "Employee Request";?> --> </h5>
 
      <!--  <a href="request/new_request/<//?php echo '?cat='.$nameee; ?>" style="float: right; margin-top: 15px;" class="btn btn-primary" 
			 data-toggle="modal" data-target="#modal_window">
                    <i class="fa fa-plus-circle"></i>
                 <//?= $this->lang->line('New')?>
                </a>
                        </div>
						
                            <table class="table table-striped table-bordered table-hover data_tab" >
							<div class="col-md-3" style="float: right; margin-right: 626px;">
								<div class="my-slect">
							 <select name="request_category_id" id="request_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                            <//?php foreach ($requestt as $category) { ?>
                                <option  value="<//?= $category['request_name'] ?>"><//?= $category['request_name'] ?></option>
                            <//?php } ?>
                        </select>
						</div>
						</div>
                                <thead>
                                    <tr>
									
                                        <th>ID</th>
										<th><//?= $this->lang->line('Date') ?></th>
										 <th><//?= $this->lang->line('Category Name') ?></th>
                                        <th><//?= $this->lang->line('Description') ?></th>
										 <th><//?= $this->lang->line('Requested by') ?></th>
										 <th><//?= $this->lang->line('Status') ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <//?php 
									// echo '<pre>';
									// print_r($requestemp);
									// echo '</pre>';
									
									foreach ($requestemp['data'] as $index => $documentt) { ?>
                                        <tr entity_id="<//?= $documentt['request_id'] ?>">
                                            <td class="idmanual" ><//?= $documentt['request_id'] ?></td>
											<td><//?= date('Y-m-d', strtotime($documentt['uploaded'])) ?></td>
											<td> <//?= $documentt['cname'] ?></td>
                                            <td><a class="btn btn-outline btn-primary btn-xs" style="margin-right:8px;" target="_blank" href="request/print_employee_request/<//?= $documentt['request_id']; ?>" >
                                                    <i class="fa fa-print"></i>
                                                </a><//?= $documentt['description'] ?></td>
											  <td><//?= $documentt['name'] ?></td>
 <td><///?php if($documentt['status']==1){?><span class="badge badge-success m-t-xs" style="width: 86px;">Approved</span>
											 <//?php } else{ ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: orange !important;">Pending</span>
											 <//?php  } ?>
											</td>
                                            <td>
                                                <div class="file-name wrapword">
                                                    <//?php foreach ($documentt['attachments'] as $attachmentt) { ?>
                                                        <//?php if (strpos($attachmentt['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="</?php echo base_url('documents/download_attachment/' . $attachmentt['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <//?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<//?php echo base_url('files/attachments/' . $attachmentt['location']) ?>" ><img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <//?php } ?>
                                                    <//?php } ?>
                                                </div>
                                            </td>                                            
                                            <td >

                                                <a class="btn btn-outline btn-success btn-xs" href="request/edit_document/<//?= $documentt['request_id'] ?><//?php echo '?page=selfservice'; ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<//?= $documentt['request_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                               <form action="request/delete_document" method="POST" id="delete_document<//?= $documentt['request_id'] ?>">
                                                    <input type="hidden" id="document_id" name="document_id" value="<//?= $documentt['request_id'] ?>" class="request_id<//?= $documentt['request_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    <//?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>-->
				
    </div>
</div>
<?php
$this->load->view('layout/footer')?>
<div class="modal"id="modalovertime" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only" onclick="savecomment();"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Comment')?></h4>
            </div>
            <div class="modal-body">
			
			<h3>Your timeout will be cosidered as Overtime. Please fill up Overtime Work Details</h3>
               <form id="save_comment" method="post" action="">
			   <div class="form-group">
                        <label for="employee_overtimecomment" class="control-label"><?= $this->lang->line('Your comment')?></label>
                        <textarea required="required" rows="5" name="employee_overtimecomment" id="employee_overtimecomment" class="form-control"></textarea>
                    </div>
			   </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="savecomment();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="savecomment();"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
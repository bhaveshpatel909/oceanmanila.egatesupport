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
      "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'>Employee Reminder  </b>",
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
            $.post('dashboard/complete_clock', {comments: $('#comments').val()}, function (html) {
				
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
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'dashboard')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>
		<?php 
		if(isset($message)){
			echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		} ?>
       

                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Punch Clock') ?> <span style="position:absolute;right:22px;">Late Penality Time: <b style="color:red;"><?php echo $emppdata[0]['late_time'].'</b> min';?></span></h5>
                                </div>
                                <div class="ibox-content">
                                   
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
									
									 <div id="start_clock" style="position: sticky;z-index: 999;" class="col-lg-offset-3 m-b-sm <?= $active_clock ? 'hide' : 'show' ?>">
                                        <button type="button" class="btn btn-primary btn-lg" id="start_clock_button">
                                            <i class="fa fa-thumb-tack"></i>
                                            <?= $this->lang->line('Time In ') ?>
                                        </button>
                                    </div>
                                   
                                    <div id="active_clock" class="<?= $active_clock ? 'show' : 'hide' ?>">
                                        <div id="sinceCountdown"></div>
                                        <div id="save_result2"></div>
                                        <div class="form-group">
                                            <label for="comments"><?= $this->lang->line('Comments') ?></label>
                                            <textarea rows="3" id="comments" class="form-control"><?= $active_clock ? $active_clock['comments'] : '' ?></textarea>
                                        </div>
                                        <div class="btn-group pull-right" style="position: sticky;z-index: 999;">
                                            <button type="button" class="btn btn-primary btn-sm" id="complete_clock">
                                                <i class="fa fa-check-circle">
                                                    <?= $this->lang->line('Time Out') ?></i>
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
<?php echo'<pre>'; print_r($clock);echo'</pre>';?>
                                        <?php $this->load->view('selfservice/clock', array('clock' => $clock)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
							  
							  
							  		<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px;">
   <h5 style="font-size: 23px; margin-bottom: 15px; color: orange;"><!--<//?php echo "Employee Reminder";?>--> </h5>
     

	 <?php if($emppdata[0]['write_rem']=="0") { ?>
	 
	   <a href="employeereminder/new_employeereminder/<?php echo '?cat='.$nameee; ?>" style="float: right; margin-top: 15px;" class="btn btn-primary" 
			 data-toggle="modal" data-target="#modal_window">
                    <i class="fa fa-plus-circle"></i>
                 <?= $this->lang->line('New')?>
                </a>
                                 <?php } ?>
                        </div>
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
                                        <th>ID</th>
										<th><?= $this->lang->line('Date') ?></th>
										 <th><?= $this->lang->line('Category Name') ?></th>
                                        <th><?= $this->lang->line('Desciption') ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employeereminder['data'] as $index => $document) { ?>
                                        <tr entity_id="<?= $document['employeereminder_id'] ?>">
                                            <td class="idmanual"><?= $document['employeereminder_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td > <?= $document['cname'] ?></td>
											 <td id= "<?= $document['employeereminder_id'] ?>" class="">
											 <a class="btn   btn-xs" href="employeereminder/edit_document2/<?= $document['employeereminder_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                   <?= $document['description'] ?>
                                                </a>
											
											</td>
											
                                            
                                            <td>
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
                                            <td >
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
				
							  
				<div class="wrapper wrapper-content animated fadeInDown">
				<div class="row">
				<div class= "col-md-12">
					<div class="col-md-6">
					<?php if(empty($empy_plan))
					{
					
					?>
						
					
					  <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 <h5>Yesterday Plan</h5>	
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
								</div>
						</div>
						</div>
						
						</div>
						
							<?php
						}
						
					}
						?>
					</div>
					<div class="col-md-6">
					<?php// echo "<pre>";
					//print_r($emptplan);
					?>
						<?php if(empty($empt_plan))
					{
					
					?>
						
					
					  <div class="ibox float-e-margins">
							     <div class="ibox-title">
								 <h5>Today Plan</h5>	
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
						
   
                        <div class="clearfix"></div>                       

                    </div>
                </div>
				<div class="wrapper wrapper-content animated fadeInDown">
				<div class="row">
              	<div class="col-md-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><?= $this->lang->line('Leave tracking') ?></h5>
							
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
                                        <th ><//?= $this->lang->line('Desciption') ?></th>
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
		.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;right: -169px;
}
.table.table-striped th ,
.table.table-striped td {padding:4px;}
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
                                        <th><//?= $this->lang->line('Desciption') ?></th>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only" onclick="modalclose();"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Comment')?></h4>
            </div>
            <div class="modal-body">
			
			<h3>Your timeout will be cosidered as Overtime. Please fill up Overtime Work Details</h3>
               <form id="save_comment" method="post" action="">
			   <div class="form-group">
                        <label for="employee_overtimecomment" class="control-label"><?= $this->lang->line('Your comment')?></label>
                        <textarea rows="5" name="employee_overtimecomment" id="employee_overtimecomment" class="form-control"></textarea>
                    </div>
			   </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="modalclose();" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="savecomment();"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/header', array('title' => $this->lang->line('pending_task'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE, 'magicsuggest' => TRUE)) ?>

<style>
.pop-dialog{
	left:200px;
}
.samefor-div
{
	float:left;
	width: 9%;
}

.dep-div
{
	
}	
.cat-div
{
	
}
.task-code-div
{
	
}
.emp-div
{
width:53%;	
}

.table th:nth-child(4) {    max-width: 250px !important;}
.table td:nth-child(4) {    max-width:250px !important;}
.table th:nth-child(7) {    max-width: 30px !important;}
.table td:nth-child(7) {    max-width:30px !important;}
.table th:nth-child(8) {    max-width: 30px !important;}
.table td:nth-child(8) {   max-width: 30px !important;}
.table th:nth-child(9) {    min-width:130px !important; max-width: 130px !important;}
.table td:nth-child(9) {    min-width:130px !important; max-width: 130px !important;}
.table th:nth-child(10) {    min-width: 90px !important;}
.table td:nth-child(10) {    min-width: 90px !important;}
.table th:nth-child(11) {    min-width: 90px !important;}
.table td:nth-child(11) {    min-width: 90px !important;}
.table th:nth-child(12) {    min-width: 90px !important;}
.table td:nth-child(12) {    min-width: 90px !important; text-align:center;}		

@media only screen and (max-width: 767px) {



	
}
.responsive.responsive_mode.mode-mode div#DataTables_Table_0_wrapper .col-sm-6:nth-child(1) {
    width: 16%;
}
.responsive.responsive_mode.mode-mode div#DataTables_Table_0_wrapper .col-sm-6:nth-child(2) {
    width: 19%;
}
select.mySelector4 {
    width: 96%;
}
.samefor-div {
    float: left;
    width: 12%;
}
.samefor-div {
    float: left;
    width: 19%;
}

</style>
<?php  global $selemplodepartment; ?>
<?php  global $processclass; ?>
 
	<?php  $username= $this->session->current->userdata('full_name') ?>
						 


<script>
    $('document').ready(function () {
		$('.complete').hide();
        $('#reAssign').click(function () {
            var that = $(this);
            var values = new Array();
            $.each($("input[name='checkHead[]']:checked"), function () {
                values.push($(this).val());
            });

            if (values.length > 0) {
//                console.log(JSON.stringify(values));
//                that.attr('href', url);
                return true;
            } else {
                alert("Please select at least one item. ");
                return false;
            }
        });
		
		$('#Assigncode').click(function () {
            var that = $(this);
            var values = new Array();
            $.each($("input[name='checkHead[]']:checked"), function () {
                values.push($(this).val());
            });

            if (values.length > 0) {
//                console.log(JSON.stringify(values));
//                that.attr('href', url);
                return true;
            } else {
                alert("Please select at least one item. ");
                return false;
            }
        });

        $('#modal_window').on('shown.bs.modal', function (e) {

            var values = new Array();
            $.each($("input[name='checkHead[]']:checked"), function () {
                values.push($(this).val());
            });
            var url = $('#reAssign').attr('href');
            $.ajax({
                cache: false,
                type: 'POST',
                url: url,
                data: 'task_ids=' + JSON.stringify(values),
                success: function (data) {
                    $('#modal_window').html(data);
                }
            });
        });
		
		$('#modal_windoww').on('shown.bs.modal', function (e) {
			//alert('ggrg');
            var valuess = new Array();
            $.each($("input[name='checkHead[]']:checked"), function () {
                valuess.push($(this).val());
            });
            var url = $('#Assigncode').attr('href');
            $.ajax({
                cache: false,
                type: 'POST',
                url: url,
                data: 'task_idss=' + JSON.stringify(valuess),
                success: function (data) {
                    $('#modal_windoww').html(data);
                }
            });
        });

// $('.mySelectorself').change( function(e) {
// var gbb = $(this).val(); 
 // });
		
		
        //$(".knob").knob();
        current_table = $('.data_table').dataTable({
        <?php  if (isset($is_selfservice)) { ?>
	
          
			//current_table = $('.data_table').dataTable({
         "oSearch": {"sSearch": ""},
         
		
		   
		<?php }  else { ?>
		
			current_table = $('.data_table').dataTable({
				 $('input[type="search"]').val('').keyup();
				
             "columnDefs": [{
                    "targets": [0, 2, 10],
                    "orderable": false
					"order": [ 2, "ASC" ]
                }]  
	<?php } ?>
				 
        });
	

		  
        $('.pop-btn').hover(function () {
            var pop = $(this).attr('data-pop');
            $(pop).show();
        }, function () {
            var pop = $(this).attr('data-pop');
            $(pop).fadeOut();
        });
<?php if (isset($is_selfservice)) { ?>
            var ms = $('#employee').magicSuggest({
                placeholder: 'Filter By Employee',
                allowFreeEntries: false,
                data: 'schedule/find_employee',
                maxSelection: 1
            });
			
    <?php if (isset($employee)) { ?>
                ms.setSelection([{name: '<?= $employee['name'] ?>', Department_name:'<?= $employee['department_name'] ?>', id:<?= $employee['employee_id'] ?>}]);
    <?php } ?>
            $(ms).on('selectionchange', function (e, m) {
                $('#employee_id').val(this.getValue());
                $('#filterByEmployee').submit();
            });
<?php } ?>




	
	$('#mySelector').change( function(e) { 
		var letter = $(this).val();
		window.location.href="<?php echo base_url();?>tasks/pending_task/"+letter;
	});
 
 	
 
 
 
		$('.mySelector3').change( function(e) {
			
   var letter = $(this).val();
 
 current_table.fnFilter( $(this).val() , 4); 	 
 });
$('.mySelector21').change( function(e) {
			
   var letter = $(this).val();
 ;
 current_table.fnFilter( $(this).val() , 4); 	 
 
 
 });


 
		
	


 
	$('#mySelector2').change( function(e) { 
   var letter = $(this).val();
     if (letter === 'null') {
         $ ('tr').show ();
     }
     else {
         $("table tr td:nth-child(2)").each(
		   function(){
			   if($(this).html() != letter){
				   $(this).parent().hide();
			   }
			   else{
				   $(this).parent().show();
			   }
		   });
     }             
 });
	$('.mySelector4').change( function(e) {
			
   var ddddd = $(this).val();
   
 
	
  current_table.fnFilter( $(this).val() , 8); 	 
 });
 
 $('.mySelectorself').change( function(e) {
			
 

  current_table.fnFilter( $(this).val() , 8);

 
	 $('input[type="search"]').val('').keyup();

 
 });
 
 $('.mySelector5').change( function(e) {
			
   var ddddd = $(this).val();
   
    //alert(ddddd);
	
  current_table.fnFilter( $(this).val() , 8); 	 
 });
 
 
 
 
 $('#task_status').change( function(e) {
			
   var ddddd = $(this).val();
   
   // alert(ddddd);
	
  current_table.fnFilter( $(this).val() , 12); 	 
 });
 
 

 
 
 


    });
	
	
	
	
	
	
</script>
<script>
$(document).ready(function() {
        var country = $('#mySelector21').val();
      
     // alert(country);
	  
	  current_table.fnFilter(country , 4); 	
	  
} );
} );

 
</script>



<script>

function get()
{
	
	
   var k=ducument.getElementById("abc");
   k.style.display="block";
	
	
}




</script>
<?php  $emname =$_GET['xy'];?>



<br>
<?php   $de =$_GET['de']; ?>
 
<p id="gb"><?php echo $emname ;?></p>


<style>
#gb {
 display: none;
}
.hover_text {
       position: absolute;
    background: #000;
    color: #fff;
    font-size: 15px;
    width: 840px;
    padding: 1px 14px;
    text-align: center;
    border-radius: 20px;
    display: none;
    left: 12%;
    top: 0px;
    z-index: 99;
}
.on_hover span img {
    width: 15px;
    margin-left: 3px;
}
.on_hover:hover> .hover_text{ display:block;}
</style>
<script>

  
 $(document).ready(function() {
var newwww	= $( "#gb" ).html()
	
//alert(newwww);
	current_table.fnFilter( newwww , 8); 
	
	
});
		
		
	
  
</script>





<?php 
			
				foreach($empdataaa as $emplyee){
					
					 // echo '<pre>';
					  // print_r($empdataaa);
					//print_r($emplyee['name']);
					// echo '</pre>';
					
				}
			
				
				?>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'pending_task')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-4" style="padding-right:5px;">
                <h2 class="on_hover"><?= $this->lang->line('Pending Tasks') ?><span><img title
				="Register pending or ongoing task here. Employee should not 
delete Tasks - only management is allowed to delete Task."src="images/if_Help.png" width="13%"></span></h2>
                <ol class="breadcrumb">
				
				
				
                     <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
						<?php  global $selemplodepartment;
						//print_r($depatmentdata);
						 $selemplodepartment = $depatmentdata[0]['department_name'];	?>
                    </li>
                    <li>
                        <?= $this->lang->line('List') ?>
                    </li>
                </ol>
            </div>
			
		
          
        <div  class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content ibox_content">
                        <div class="row">
                            <div id="save_result"></div>
					
					<div class="responsive responsive_mode mode-mode">
					<div style="float: right;
    width: 62%;"class="status-1 status-2">
					<div class="echo-2">
					
					<?php  $username= $this->session->current->userdata('full_name') ?>
			
                <div class="form-group gtrt" style="padding-top: 0px;width:204px; float:left">
				<?php if ($emname != '')  { ?>
				
				<input type="text" class="form-control" value="<?php echo $emname;?>" readonly >
				<?php } else { ?>
				
			<?php $empd =$username.'<b>['.$selemplodepartment.']</b>'; ?>
				
				        <?php if ($this->user_actions->is_selfservice()) { ?>

				
				   <select name="mySelectorself" class ="mySelectorself" style="height: 35px;">
				<option value="">SELECT DEPARTMENT</option>
				 <option value="<?php echo $username;?>" selected="selected"><?echo $empd;?></option>
						
				
                   <?php foreach($empdataaa as $emp)   {
				 
						$haystack = $str = $emp['name'] ;

							   $emppp =(explode('[',$str));
								
								$newww1 =($emppp[0]);
						 	$neww2  = ($emppp[1]);
							
					$needle  = $selemplodepartment ;
								
						$newwww	 = $newww1.'<b>[' .$neww2.'</b>';		



								?>
								

           	<?php	if(strpos( $haystack, $needle ) !== false){  ?>
			
			<option value="<?=$newww1;?>"<?php if ($newwww==$empd){ ?> selected="selected"<?php } ?>  ><?= $newww1.'<b>[' .$needle.']</b>'; ?></option>
			
				   
			<?php	}  ?> 
				   
				   
					 <?//php if ($this->user_actions->is_selfservice()) { ?>	
				
               <?php } ?>
           </select>
			
		<?php } else {?>
				
				<select name="mySelector4" class ="mySelector4" style="height: 35px;">
				
				
						<option value="">SELECT EMPLOYEE</option>
				
                   <?php foreach($empdataaa as $emp)   {
				 
								$str = $emp['name'] ;

							   $emppp =(explode('[',$str));
								
								$newww1 =($emppp[0]);
								$neww2  = ($emppp[1]);
							$newww	 = $newww1.'<b>[' .$neww2.'</b>';
								
								?>
								

           		
				   <option value="<?=$newww1;?>"><?php echo $newww; ?></option>
					 <?//php if ($this->user_actions->is_selfservice()) { ?>	
				
               <?php } ?>
           </select>
			 	
				   <?php } }?>	

			</div>
					<div class="task-code-div samefor-div same-2">
						<div class="form-group" style="padding-top: 0px;">
						 <?php //echo "<pre>";
								//print_r($deparment);
								?>
							<select id="task_status" name="task_status"  style="height: 35px;width: 95%;">
														<option value="">SELECT STATUS</option>
														<option value="unassigned">Unassigned</option>
														<option value="assigned">Assigned</option>
														<option value="completed">Completed</option>
														<option value="regular">Regular</option>                                                
							</select>
							
						</div>
					</div>
					<div class="dep-div samefor-div same-1">
                <div class="form-group" style="padding-top: 0px;">
				  <?php if ($this->user_actions->is_selfservice()) { ?>

                    
					<select name="mySelector21" class="mySelector21" style="height: 35px;width: 95%;">
					<option value="">SELECT DEPARTMENT</option>
						   <?php foreach ($deparment as $categorye) { ?>
						   
                                <option <?php if($categorye['department_name'] == $selemplodepartment){ ?>selected="selected"<?php } ?>  value="<?= $categorye['department_name']  ?>" disabled="true"><?= $categorye['department_name'] ?></option>
					<?php }  ?>
                    </select>
					
				  <?php }  else {?>
					 <select name="mySelector3" class="mySelector3" style="height: 35px;width: 95%;">
						<option value="">SELECT DEPARTMENT</option>
						  <?php foreach($deparment as $cattegrt)
						{ ?>
						<option value="<?= $cattegrt['department_name']; ?>"<?php if($cattegrt['department_name'] == $catte){ ?>selected="selected"<?php } ?> ><?= $cattegrt['department_name']; ?></option>
				  <?php }  } ?>
                    </select>
					
                </div>
            
			</div>
			<div class="cat-div samefor-div same-1">
                <div class="form-group" style="padding-top: 0px;">
                    <select name="mySelector" id="mySelector" style="height: 35px;width: 95%;">
						<option value="">SELECT CATEGORY</option>
						<?php foreach($category as $cattegrt)
						{ ?>
						<option value="<?= $cattegrt['task_category_id']; ?>"<?php if($cattegrt['task_category_id'] == $catte){ ?>selected="selected"<?php } ?> ><?= $cattegrt['task_category_name']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
			
			<div style="display:none;"class="task-code-div samefor-div same-1">
                <div class="form-group" style="padding-top:0px;">
                    <select name="mySelector2" id="mySelector2" style="height: 35px;width: 95%;">
						<option value="null">SELECT TASK CODE</option>
						<?php foreach($tasktype as $cattegrt)
						{ ?>
						<option value="<?= $cattegrt['code']; ?>"><?= $cattegrt['code']; ?>-<?= $cattegrt['type']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
			</div>
			<div class="action" style="float:right; margin-left: 6px;">
                <div style="padding-top:0px;"class="title-action">
                    <a href="tasks/index/all" class="btn btn-primary" >
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <?= $this->lang->line('Reset') ?>
                    </a>
                </div>
            </div>
</div>
                            <table class="table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
                                        <th  style="display:none; class="text-center">

                                            <label ">
                                                <input type="checkbox" name="checkHead" class="i-checks checkHead" id="selectall"/>
                                                <span class="lbl"></span>

                                            </label>
											
                                        </th>


										<th style="display:none;"class="asss" width="4%"><?= $this->lang->line('T C') ?></th>
                                        <th class="asss22" width="13%"><?= $this->lang->line('Task process') ?></th>
                                        <th style="width:15%;"class="asss222"><?= $this->lang->line('Title') ?></th>
										 <th style="width:5%;"><?= $this->lang->line('Department') ?></th>
                                        <th style="width:6%;"><?= $this->lang->line('Category') ?></th>
                                        <th style="display:none;"></th>
                                        <th width="6%"><?= $this->lang->line('Regular') ?></th>
										
                                        <!--th width="4%">status</th-->
                                        <th style="width:3%;"class="mn_width"><?= $this->lang->line('Assigned to') ?></th>
                                        <th style="width:4%;"class="mn_width1"><?= $this->lang->line('Start Date') ?></th>
                                        <th style="width:4%;" class="mn_width2"><?= $this->lang->line('Due Date') ?></th>
                                        <th class="mn_width3" width="8%"><?= $this->lang->line('Reminder') ?></th>
                                          <th style="display:none;" width="7%"></th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php //print_r($task_log);die;?>
                                    <?php foreach ($tasks as $task) { 

									
									// echo"<pre>";
									
									// print_r($task);
									// echo"</pre>";

                                    	$last_comment_date = null;
                                    	$comments_count = 0;
                                    	foreach ($task_log as $comment) {
                                    		if($comment['task_id'] == $task['task_id']){
                                    			$comments_count++;
                                    			if($comments_count == 1){
                                    				$last_comment_date = date('Y-m-d',strtotime($comment['log_date']));
                                    			}
                                    		}
                                    	}
									
									
									
									
										 if($task['process']<100)
											{
													$processclass= 'uncomplete';
											}
											else
											{
												$processclass= 'complete';
											}
										?>								
									
                                        <tr entity_id="<?= $task['task_id'] ?>" class="<?php echo $processclass;?>">
										
                                            <td style="display:none;"class="text-center">
                                                <label>
                                                    <input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="<?= $task['task_id'] ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
											<td style="display:none;" class="asss"><?= $task['tcode']?></td>
											
                                            <!--td>
                                                <div  class="pop-container">
                                                    <a class="btn btn-outline btn-info btn-xs" href="tasks/comment_task/<?= $task['task_id'] ?>" data-toggle="tooltip" data-placement="top" title="Communication">
                                                        <i class="fa fa-commenting"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-primary btn-xs pop-btn" data-pop="#pop<?= $task['task_id'] ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <div class="pop-dialog" id="pop<?= $task['task_id'] ?>"><?= $task['description'] ?></div>                                                
                                                </div>
                                            </td-->
											
                                            <td class="asss22">
											
                                                <!--<input type="text" class="knob" value="<?php echo $task['process']; ?>" data-thickness="0.2" data-width="40" data-height="40" data-fgColor="#00a65a" data-readonly="true">-->
                                                <div class="progress" style="margin-bottom: 0;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $task['process']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $task['process']; ?>%;">
                                                        <?php echo $task['process']; ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="asss222">
											<div style=" position:relative;">
												<?php if($task['task_attention']=="updated"){?>
<b><span class="hover1"><img src="http://wshrms.peza.com.ph/images/if_check.png "style="width:13px; height:13px"><span class="hover_text1">Question regarding this task has been answered</span></span></b><?php }?>
												<?php if($task['task_attention']=="required"){?>
										      <b><span class="hover1"><img src="http://wshrms.peza.com.ph/images/if_question.png"style="width:13px; height:13px"><span class="hover_text1">There is a question regarding this task</span></span></b><?php }?>
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
											
											
											 <td> <?= $task['related_department']?></td>
                                            <td><?= $task['task_category_name']?></td>
                                            <td style="display:none;"class="text-center text-danger"><?= $task['additional']?></td>
                                            <td title="means that this is regular task " class="text-center text-danger"><?= ($task['task_regular'] == 1) ? 'R' : '' ?></td>
                                            
											<td class="mn_width ">
											<span class="asfe">
											<span class="der">
											<?php 
											// echo "<pre>";
											// print_r($empname);
											$result = isset($empname[$task['task_id']]) ? $empname[$task['task_id']] : null;
											$result = array_filter($result);
											$results = array_unique($result);
											
											
													foreach($results as $resu){
														echo $resu ;
														echo "<br/>";
													}
											?>
											</span>
											<span class="dyhtrer">
											<?php 
											// echo "<pre>";
											//print_r($empname);
											$result = isset($empname[$task['task_id']]) ? $empname[$task['task_id']] : null;
											$result = array_filter($result);
											$results = array_unique($result);
											
											
													foreach($results as $resu){
														echo $resu ;
														echo "<br/>";
													}
											?>
											</span>
											</span>
											</td>
                                            <td class="mn_width1"><div class="olddd"><?= $task['start_date'] ?>
                                            <?php 
												$earlier = new DateTime($task['due_date']);
												$later = new DateTime(date('Y-m-d'));

												$diff = $later->diff($earlier)->format("%a");
												
												if($later>$earlier && $task['process']<100){	
												?>
												<span class="on_hover"  style="color: #FF0004"> (<?php echo $diff;?>)<span class="count">Number of delayed days after due date.</span></span>
                                          		<?php
												}
												?>
                                           <?php if($comments_count){?><br>
                                           <div  class="pop-container ggggggggggg">
                                           <a class="pop-btn" data-pop="#pop-last-comment-date"><span class="dedede" style="color: red;"><?php echo $last_comment_date;?> <span class=" hjhjhj" id="">Date of latest Update</span></span></a>
                                          
                                           </div>
                                           <div  class="pop-container gtrt">
                                           <a class="pop-btn" data-pop="#pop-last-comment-count">
                                           <span class="tedt" style="color: #4fb494; font-weight: bold;">(<?php echo $comments_count;?>) <span class="ghthg" id="pop-last-comment-countg">Number of comments</span></span>
                                           </a>
                                          
                                           </div>
                                       <?php }?>


                                           </div>
                                       </td>
                                            <td class="mn_width2"><?php echo ($task['due_date'] == '0000-00-00' || $task['due_date'] == null) ? '' : $task['due_date'] ?></td>
                                            <td class="mn_width3">

                                                
												<?php if ($this->user_actions->is_selfservice()) {
													if($task['task_regular'] != 1){?>
												
                                               
												
												<?php } } else {?>
												
												<?php }?>
					                  <?php if (!$this->user_actions->is_selfservice()) { ?>

												
					                  <a class="onhover" href="tasks/mail_task?id=<?= $task['task_id'] ?>&emp=<?=$task['employee_id'] ?>&noti=<?=$task['notify'] ?>" style="border:1px solid #00b440; border-radius: 3px; padding: 0px 5px 2px;display: inline-block;">													
								<img src="http://wshrms.peza.com.ph/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"><span class="onhoverw">Resend email to notified person to remind this task</span></a>
												 <?php }?>

                                                
												
                                            </td>
											
											
											<td style="display:none;"><?php echo $task['status']; ?></td>
                                        </tr>
                                  
									
								
										
									<?php  } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer')?>


<style>
.hover1:hover > .hover_text1 {
    display: block;
}
.hover_text1 {
    position: absolute;
    background: #000;
    color: #fff;
    white-space: nowrap;
    padding: 5px 21px;
    border-radius: 16px;
    left: 14px;
    top: -5px;
    z-index: 9;
    display: none;
}
.der {
    height: 38px;
    display: block;
    overflow: hidden;
}
.mn_width1 {
    width: 69px !important;
}
.mn_width3 {
    width: 10px !important;
}
.asss22 {
    width: 20px !important;
}
.asfe{ position:relative;}
.asfe:hover > .dyhtrer {
    display: block;
}
.dyhtrer {
    display: none;
    position: absolute;
    background: #fff;
    color: #000;
    border: solid 1px #ccc;
    box-shadow: 1px 3px 10px #ccc;
    z-index: 999;
    width: 227px;
    padding: 12px;
    border-radius: 5px;
    left: 138px;
    top: -48px;
}
.onhover{ position:relative;}
.onhover:hover > .onhoverw {
    display: block;
}
.mn_width3 a {
    width: 23px;
    height: 21px;
}
.onhoverw {
    position: absolute;
    background: #000;
    color: #fff;
    width: 360px;
    padding: 5px;
    border-radius: 15px;
    right: 7%;
    display: none;
    top: -34px;
    font-weight: bold;
}
.tedt:hover > .ghthg {
    display: block;
}
.tedt{position:relative;}
.ghthg {
    position: absolute;
    background: #000;
    color: #fff;
    width: 193px;
    text-align: center;
    padding: 6px;
    border-radius: 15px;
    display: none;
    left: 100%;
    top: 0px;
    margin-left: 6px;
}
.dedede{position:relative;}
.dedede:hover > .hjhjhj {
    display: block;
}
.hjhjhj {
    position: absolute;
    background: #000;
    color: #ffff;
    width: 162px;
    padding: 5px 12px;
    border-radius: 15px;
    display: none;
    margin-left: -169px;
    top: 0px;text-align: right;
}
.olddd {
    position: relative;
    float: left;
    width: 100%;
    box-sizing: border-box;
}
.on_hover{position:relative;}
.on_hover:hover >.count {
    display: block;
}
.count {
    position: absolute;
    background: #000;
    color: #fff;
    padding: 6px 23px;
    border-radius: 15px;    width: 310px;
    font-weight: bold;
    top: -24px;
    left: 100%;
    display: none;
}
.pop-container.ggggggggggg {
    display: inline;
}
.pop-container.gtrt {
   display: inline;
}
.gtrt , .ggggggggggg {
    position: relative;
}
.pop-container.gtrt .pop-dialog {
    left: 20px;
    top: 10px;
    width: 225px;
    font-weight: 600;
    min-width: 100% !important;
    text-align: center;
    background: #000;     padding: 6px 23px;
    color: #fff;
    border-radius: 40px;
}
td.mn_width1 {
    position: relative;
}
.pop-container.ggggggggggg .pop-dialog {
left: -245px;
    top: 10px;
    background: #000;
    color: #fff;
    font-weight: 600;    padding: 6px 23px;
    text-align: center;
    width: 236px;
    min-width: 100% !important;
    border-radius: 34px;
}

@media only screen and (max-width: 767px) {	

.hover_text {font-size: 12px;width: 100%;padding: 4px 7px;left: 0px;top: 29px;}

.row.border-bottom {  margin: 0px;}
.responsive td, .responsive th{font-size:8px;padding-left: 1px !important; padding-right: 1px !important;}
.progress .progress-bar {    font-size: 8px;}
.icheckbox_square-green, .iradio_square-green{ width:13px; height:13px;}
.icheckbox_square-green, .iradio_square-green { background-size: 224px 14px;}
.responsive .table .mn_width {  width: 71px !important; min-width: 100% !important;  max-width: 100% !important;    padding-right: 0px;}
.responsive .table .mn_width1 {max-width: 82px !important;}
.responsive .table .mn_width2 {
    min-width: 100% !important;
    max-width: 100% !important;
}
.responsive .table .mn_width3 {
    min-width: 100% !important;
    max-width: 100% !important; width:24px !important;
}
.responsive .table .mn_width3 a {
    padding: 2px;
    font-size: 8px;    line-height: 17px;
}
body .responsive .table .asss {
    width: 50px !important;
    max-width: 100% !important;
}
body .responsive .table .asss222 {
    max-width: 100% !important;
    min-width: 100px !important;
    width: 50px !important;
}
.ibox_content {
    padding-left: 0px;
    padding-right: 0px;
}
.emp-div.samefor-div .form-group select.mySelector4 {
    width: 100%;
}
.emp-div.samefor-div .form-group {
    width: 100% !important;
}
.samefor-div{ width:100%;}
.wrapper-content {float: left; width:100%;}
.emp-div { width: 100%;}
.display_completed_checkbox1 {
    margin-left: 0px !important;
    margin-bottom: 10px !important;
}
.samefor-div select {
    width: 100% !important;
}
div.dataTables_paginate {
    float: left; margin-top: 6px;
}
.dddddddd {
    float: left;
    margin-left: 10px;
}
	
.responsive_mode tr th:nth-child(1) , .responsive_mode tr td:nth-child(1){ display:none;}	
	
	
.responsive_mode tr th:nth-child(6) , .responsive_mode tr td:nth-child(6){ display:none;}	
.responsive_mode tr th:nth-child(7) , .responsive_mode tr td:nth-child(7){ display:none;}	
.responsive_mode tr th:nth-child(8) , .responsive_mode tr td:nth-child(8){ display:none;}	
.responsive_mode tr th:nth-child(9) , .responsive_mode tr td:nth-child(9){ display:none;}	
.responsive_mode tr th:nth-child(12) , .responsive_mode tr td:nth-child(12){ display:none;}	
.responsive_mode tr th:nth-child(13) , .responsive_mode tr td:nth-child(13){ display:none;}	
	
.responsive_mode tr th:nth-child(2), .responsive_mode tr td:nth-child(2) {  	
   
    width: 45px !important;}
.responsive_mode tr th:nth-child(5), .responsive_mode tr td:nth-child(5) {  }	
.responsive_mode tr th:nth-child(4), .responsive_mode tr td:nth-child(4) {  ;}
.responsive .table .mn_width3 {
   
}	
.hover_text1 { left: -73px;  top: -25px; }
div.dataTables_length label select {
    color: #333;
}
div.dataTables_length label {

    color: transparent;
}
.responsive_mode tr th:nth-child(2) {

    font-size: 9px;
}
div.dataTables_filter label{ float:left;}
th.asss222 { text-align: center;}
th.mn_width1 { text-align: center;}
body .responsive .table tr td{background:#fefefe;border-bottom:1px solid #ddd !important;}

}



@media only screen and (max-width: 480px) {	
.responsive td, .responsive th{ font-size:11px;}

}

select.mySelector4 {
    border: 1px #ddd solid !important;
    border-radius: 3px;
}
select#task_status{
	  border: 1px #ddd solid !important;
    border-radius: 3px;
}
select.mySelector3{
	  border: 1px #ddd solid !important;
    border-radius: 3px;
}
select#mySelector{
	  border: 1px #ddd solid !important;
    border-radius: 3px;
}
.responsive.responsive_mode.mode-mode div#DataTables_Table_0_wrapper .col-sm-6:nth-child(1) {
    width:18%;
    padding-right: 0px !important;
}
.responsive.responsive_mode.mode-mode div#DataTables_Table_0_wrapper .col-sm-6:nth-child(2) {
    width:19%;
    padding: 0px !IMPORTANT;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}
td.asss22{
	width:72px !important;
}
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>



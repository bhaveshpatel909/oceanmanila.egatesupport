<?php $this->load->view('layout/header', array('title' => $this->lang->line('Tasks'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE, 'magicsuggest' => TRUE)) ?>

<style>
.pop-dialog{
	left:200px;
}
.dataTables_wrapper th:nth-child(1)
{
width:4% !important;	
}
.dataTables_wrapper td:nth-child(1)
{
width:4% !important;	
}
.dataTables_wrapper th:nth-child(2)
{
width:8% !important;	
}
.dataTables_wrapper td:nth-child(2)
{
width:8% !important;	
}

.dataTables_wrapper th:nth-child(3)
{
width:12% !important;	
}
.dataTables_wrapper td:nth-child(3)
{
width:12% !important;
	
}
.dataTables_wrapper th:nth-child(5)
{
width:12% !important;	
text-align:center;
}
.dataTables_wrapper td:nth-child(5)
{
width:12% !important;
text-align:center;	
}
.dataTables_wrapper th:nth-child(6)
{

text-align:center;
}
.dataTables_wrapper td:nth-child(6)
{

text-align:center;	
}
td.mn_width1 {position: relative;}

</style>
<style>
		.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;
	right: -169px;
}

// #DataTables_Table_0_filter{text-align:right;}
// #DataTables_Table_0_filter label{float: none;
// font-weight: normal;
// display: inline-block;
// margin-right: 11px;}
		</style>
<script>
    $('document').ready(function () {
		
		
		 current_tablem = $('.data_tablem').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	   "oLanguage": {
      "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'> </b>",
    },
	// 'fnDrawCallback': function (oSettings) {
		// $('.dataTables_filter').change(function () {
			// $(this).append("<a href='workmanual/new_workmanual/<?php echo '?cat='.$nameee; ?>' style='display: inline-block;' class='btn btn-primary' data-toggle='modal' data-target='#modal_window'>  <i class='fa fa-plus-circle'></i>New </a>");
		// });
	// }
        });
		
			$('#work_category_id').change( function() { 
            current_tablem.fnFilter( $(this).val() ); 
			//alert('dvd');
       });	
	   
	   current_tabler = $('.data_tab').dataTable({
           "iDisplayLength": 5,
		  
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	  "order": [[ 2, "asc" ]],
	   "bFilter": true, 
	   "oLanguage": {
      "sLengthMenu": " _MENU_<b style='color:orange;font-size: 24px;margin-left: 13px;'></b>",
    }
        });
		$('#request_category_id').change( function() { 
            current_tabler.fnFilter( $(this).val() ); 
			//alert('dvd');
       });	
		
		
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

        $('#modal_windowt').on('shown.bs.modal', function (e) {

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

        //$(".knob").knob();
        current_table = $('.data_table').dataTable({
//            "order": [[6, "desc"]],
            "columnDefs": [{
                    "targets": [0, 2, 10],
                    "orderable": false
                }]
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
                ms.setSelection([{name: '<?= $employee['name'] ?>', id:<?= $employee['employee_id'] ?>}]);
    <?php } ?>
            $(ms).on('selectionchange', function (e, m) {
                $('#employee_id').val(this.getValue());
                $('#filterByEmployee').submit();
            });
<?php } ?>


	
	$('#mySelector').change( function(e) { 
		var letter = $(this).val();
		window.location.href="<?php echo base_url();?>tasks/selftask/all/"+letter;
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
 
 
 
 $('#mySelector4').change( function(e) { 
   var letterr = $(this).val();
    

current_table.fnFilter( $(this).val() ,8); 	
	 
 });


    });
</script>
<?php 
			
				foreach($empdataaa as $emplyee){
					
					 // echo '<pre>';
					  // print_r($empdataaa);
					// print_r($emplyee['name']);
					// echo '</pre>';
					
				}
			
				
				?>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => $active_menu)) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-2">
			
					<div class="bb2" style="float:left;">
                <h2 style="margin-top: 26px; margin-bottom: 0px;"><?= $this->lang->line('Tasks') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
						<?php $selemplodepartment = $depatmentdata[0]['department_name'];	?>
                    </li>
                    <li>
                        <?= $this->lang->line('List') ?>
                    </li>
                </ol>
				</div>
            </div>
			<div class="new-catagery">
			<div class="col-lg-2 selevtor-22">
                <div class="form-group" style="padding-top: 30px;">
                    <select name="mySelector" id="mySelector" style="height: 35px;width: 85%;">
						<option value="">SELECT CATEGORY</option>
						<?php foreach($category as $cattegrt)
						{ ?>
						<option value="<?= $cattegrt['task_category_id']; ?>"<?php if($cattegrt['task_category_id'] == $catte){ ?>selected="selected"<?php } ?> ><?= $cattegrt['task_category_name']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
			
			<div style="display:none;" class="col-lg-2">
                <div class="form-group" style="padding-top: 30px;">
                    <select name="mySelector2" id="mySelector2" style="height: 35px;width: 85%;">
						<option value="null">SELECT TASK CODE</option>
						<?php foreach($tasktype as $cattegrtt)
						{ ?>
						<option value="<?= $cattegrtt['code']; ?>"><?= $cattegrtt['code']; ?>-<?= $cattegrtt['type']; ?></option>
						<?php } ?>
                    </select>
                </div>
            </div>
			<?php  $username= $this->session->current->userdata('full_name') ?>
			
			
				<?php $empd =$username.'<b>['.$selemplodepartment.']</b>'; ?>
			
			<div class="col-lg-4">
                <div class="form-group" style="padding-top: 30px;">
                    <select name="mySelector2" id="mySelector4" style="height: 35px;width: 85%;">
						
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
			
                </div>
            </div>
			<div style="position: relative;
    right: 7%;
    z-index: 999999;" class="col-lg-1 rest-22">
                <div class="title-action">
                    <a href="tasks/index/all" class="btn btn-primary" >
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <?= $this->lang->line('Reset') ?>
                    </a>
                </div>
            </div>
			</div>
            <div class="col-lg-2">
                <div class="form-group" style="padding-top: 30px;">
                    <?php if (!$is_selfservice) { ?>
                        <input type="text" id="employee" name="employee">
                        <form action="" method="GET" id="filterByEmployee">
                            <input type="hidden" value="" id="employee_id" name="employee_id" />
                        </form>
                    <?php } ?>
					
					
                </div>
            </div>
			
            <div class="col-lg-1" style=" display:none;padding-top: 30px;">
                <div class="btn-group pull-right" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="tasks/re_assign" id="reAssign" data-toggle="modal" data-target="#modal_windowt"><i class="fa fa-user"></i> Assign to</a></li>
						<li><a href="tasks/assigncode" id="Assigncode" data-toggle="modal" data-target="#modal_windoww"><i class="fa fa-user "></i> Assign task code</a></li>
                        <?php if (isset($employee)) { ?>
                        <li><a target="_blank" href="tasks/print_employee_tasks/<?= $employee['employee_id'] ?>/<?=$type?>" id="printTaskList" ><i class="fa fa-file-pdf-o"></i> Print</a></li>
                        <?php } ?>                        
<!--<li><a href="#" id="deleteAll"><i class="fa fa-trash-o"></i> Delete</a></li>-->
				
                    </ul>
                </div>
            </div>
			<div class="col-lg-1"> 
			<div class="bb1" style="float:right; ; margin-top:30px;">
			<a href="tasks/new_task" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
                    </a>
					</div>
					</div>
            <div class="col-lg-1">
                <div class="title-action">
                    
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="padd_decrease wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="responsive1">
                            <table class="table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
                                        <th style="width:7%;"class="text-center">
                                            <label>
                                                <input type="checkbox" name="checkHead" class="i-checks checkHead" id="selectall"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
										<th style="display:none;"width="4%"><?= $this->lang->line('T C') ?></th>
                                        <th width="12%"><?= $this->lang->line('Task process') ?></th>
                                        <th><?= $this->lang->line('Title') ?> </th>
										 <th><?= $this->lang->line('Department') ?></th>
                                        <th><?= $this->lang->line('Category') ?></th>
                                        <th style="display:none;" width="4%"></th>
                                        <th style="display:none;" width="4%"></th>
                                        <th><?= $this->lang->line('Assigned to') ?></th>
                                        <th><?= $this->lang->line('Start Date') ?></th>
                                        <th><?= $this->lang->line('Due Date') ?></th>
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
							<?php
  

							$gbbb = 'Common - Notice' ;?>
                                    <?php foreach ($tasks as $task) {
																			
                                 
								    
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
									
										 
									  ?>
									
									
                                        <tr entity_id="<?= $task['task_id'] ?>">
                                            <td class="text-center">
                                                <label>
                                                    <input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="<?= $task['task_id'] ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
											<td><?= $task['tcode']?></td>
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
                                            <td>
                                                <!--<input type="text" class="knob" value="<?php echo $task['process']; ?>" data-thickness="0.2" data-width="40" data-height="40" data-fgColor="#00a65a" data-readonly="true">-->
                                                <div class="progress" style="margin-bottom: 0;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $task['process']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $task['process']; ?>%;">
                                                        <?php echo $task['process']; ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
												<div style=" position:relative;">
												<a class="pop-btn" href="tasks/comment_task/<?= $task['task_id'] ?>" data-pop="#pop<?= $task['task_id'] ?>"><?= $task['task_title'] ?></a>
												<div class="pop-dialog" id="pop<?= $task['task_id'] ?>"><?= $task['description'] ?></div>
												</div>
											</td>
											 <td><?= $task['related_department']?></td>
                                            <td><?= $task['task_category_name']?></td>
                                            <td class="text-center text-danger"><?= $task['additional']?></td>
                                            <td class="text-center text-danger"><?= ($task['task_regular'] == 1) ? 'R' : '' ?></td>
                                            <td>
											<?php echo $task['notified_names'];?></td>
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
                                           <?php
                                    
                                    if($comments_count){?><br>
                                           <div  class="pop-container ggggggggggg">
                         <a class="pop-btn" data-pop="#pop-last-comment-date"><span class="dedede" style="color: red;"><?php echo $last_comment_date;?> <span class=" hjhjhj" id="">Date of latest Update</span></span></a>
                                          
                                           </div>
                                           <div  class="pop-container gtrt">
                                           <a class="pop-btn" data-pop="#pop-last-comment-count">
                                           <span class="tedt" style="color: #4fb494; font-weight: bold;">(<?php echo $comments_count;?>) <span class="ghthg"
										   id="pop-last-comment-countg">Number of comments</span></span>
                                           </a>
                                          
                                           </div>
                                       <?php }?>


                                           </div>
                                       </td>
                                            <td><?php echo ($task['due_date'] == '0000-00-00' || $task['due_date'] == null) ? '' : $task['due_date'] ?></td>
                                            <td>

                                                <a class="btn btn-outline btn-success btn-xs" href="tasks/edit_task/<?= $task['task_id'] ?>" >
                                                    <i class="fa fa-edit"></i>
                                                </a>
												<?php if($task['task_regular'] != 1){?>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete task ?') && submit_form('#delete_task<?= $task['task_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												<?php }
												?>
                                                <form action="tasks/delete_task" method="POST" id="delete_task<?= $task['task_id'] ?>">
                                                    <input type="hidden" id="task_id" name="task_id" value="<?= $task['task_id'] ?>" class="task_id<?= $task['task_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
                                     <?php //} //else if($task['related_department'] == $gbbb )   { ?>
									
									
								<!--	<tr entity_id="<?= $task['task_id'] ?>">
                                            <td class="text-center">
                                                <label>
                                                    <input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="<?= $task['task_id'] ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
											<td><?= $task['tcode']?></td>
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
                                            </td>
                                            <td>
                                                <!--<input type="text" class="knob" value="<//?php echo $task['process']; ?>" data-thickness="0.2" data-width="40" data-height="40" data-fgColor="#00a65a" data-readonly="true">-->
                                               <!-- <div class="progress" style="margin-bottom: 0;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<//?php echo $task['process']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $task['process']; ?>%;">
                                                        <//?php echo $task['process']; ?>%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
												<div style=" position:relative;">
												<a class="pop-btn" href="tasks/comment_task/<//?= $task['task_id'] ?>" data-pop="#pop<?= $task['task_id'] ?>"><?= $task['task_title'] ?></a>
												<div class="pop-dialog" id="pop<//?= $task['task_id'] ?>"><?= $task['description'] ?></div>
												</div>
											</td>
											 <td><//?= $task['related_department']?></td>
                                            <td><//?= $task['task_category_name']?></td>
                                            <td class="text-center text-danger"><//?= $task['additional']?></td>
                                            <td class="text-center text-danger"><//?= ($task['task_regular'] == 1) ? 'R' : '' ?></td>
                                            <td><//?php $result = isset($empname[$task['task_id']]) ? $empname[$task['task_id']] : null;
													foreach($result as $resu){
														echo $resu.' / ';
													}
											?></td>
                                            <td><//?= $task['start_date'] ?></td>
                                            <td><//?php echo ($task['due_date'] == '0000-00-00' || $task['due_date'] == null) ? '' : $task['due_date'] ?></td>
                                            <td>

                                                <a class="btn btn-outline btn-success btn-xs" href="tasks/edit_task/<//?= $task['task_id'] ?>" >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete task ?') && submit_form('#delete_task<//?= $task['task_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <form action="tasks/delete_task" method="POST" id="delete_task<//?= $task['task_id'] ?>">
                                                    <input type="hidden" id="task_id" name="task_id" value="<//?= $task['task_id'] ?>" class="task_id<//?= $task['task_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>-->
									
									
							<?php    //}		
							
							
							
							}							?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
				
				
				
				<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
					
                        <div class="row" >
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px; padding-left:1px;">
							
							<?php if($emppdata[0]['write_man']=="0") { ?>
						   <a style="float:right !important;
						   "href="workmanual/new_workmanual/<?php echo '?cat='.$nameee; ?>" style=" margin-top: 15px;margin-right:10px; " class="btn btn-primary" data-toggle="modal" data-target="#modal_windowww">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add')?>
                    </a>
					  <?php } ?>
                            <span style="color: #232b32;font-size: 24px;vertical-align:bottom; padding-top: 15px;"><?php echo "Work Manual".'('.$depatmentdata[0]['department_name'].')'; ?></span>
                           
						    
					
                        </div>
						
						<div class="responsive3">
				
                            <table class="  table table-striped table-bordered table-hover data_tablem" >
							
							<div class="col-md-3" style="float: right; margin-right: 626px;">
								<div class="my-slect">
							 <select name="request_category_id" id="work_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                           <?php foreach ($deparmentw as $category) { ?>
						   <?php  if($selemplodepartment == $category['department_name']  ) { ?>
                                <option value="<?= $category['department_name'] ?>"><?= $category['department_name'] ?></option>
                            <?php }
                         		else if($category['department_name']== $gbbb )	{
           									?>
											<option value="<?= $category['department_name'] ?>"><?= $category['department_name'] ?></option>
						   <?php    }			}				?>
                        </select>
						</div>
						</div>
						
						
<thead>
	
			 
                                    <tr>
									
                                        <th width="4%">ID</th>
										 <th><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Category Name') ?></th>
                                        <th style="text-align:center;"class="mn_width" width="30%"><?= $this->lang->line('Desciption') ?></th>
                                        <th></th>
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
										<?php
             // echo '<pre>';
			 // print_r($workmnaualdata);
             // echo '</pre>'; 
			 ?>
                                    <?php foreach ($workmnaualdata['data'] as $document) { ?>
									<?php  if($selemplodepartment == $document['department_name']  ) { ?>
                                        <tr entity_id="<?= $document['workmanual_id'] ?>">
                                            <td><?= $document['workmanual_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td><?= $document['cname'] ?></td>
                                            <td class="mn_width"><a class="btn   btn-xs" href="workmanual/edit_document1/<?= $document['workmanual_id'] ?>" data-target="#modal_window"  data-toggle="modal"><?= $document['description'] ?></td>
                                             <td>
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) {
														
														?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"
															height="14px" width="14px"></a></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ></i> <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"height="14px" width="14px"></a></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td>
											     <?php
                                           
										  if($emppdata[0]['edit_man']=="0") { ?>

                                                <a class="btn btn-outline btn-success btn-xs" href="workmanual/edit_document/<?= $document['workmanual_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
												<?php } ?>
												                                          <?php
                                           
										  if($emppdata[0]['delete_man']=="0") { ?>
												
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['workmanual_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

												<?php } ?>
												
                                                <form action="workmanual/delete_document" method="POST" id="delete_document<?= $document['workmanual_id'] ?>">
                                                    <input type="hidden" id="workmanual_id" name="workmanual_id" value="<?= $document['workmanual_id'] ?>" class="workmanual_id<?= $document['workmanual_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } else if($document['department_name'] == $gbbb )   { ?>
								
								<tr entity_id="<?= $document['workmanual_id'] ?>">
                                            <td><?= $document['workmanual_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td><?= $document['cname'] ?></td>
                                            <td><?= $document['description'] ?></td>
                                             <td>
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) {
														
														?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ></i> <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td>
											
																						     <?php
                                           
										  if($emppdata[0]['edit_man']=="0") { ?>


                                                <a class="btn btn-outline btn-success btn-xs" href="workmanual/edit_document/<?= $document['workmanual_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
												
												<?php } ?>
												                                          <?php
                                           
										  if($emppdata[0]['delete_man']=="0") { ?>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['workmanual_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												
										  <?php   } ?>

                                                <form action="workmanual/delete_document" method="POST" id="delete_document<?= $document['workmanual_id'] ?>">
                                                    <input type="hidden" id="workmanual_id" name="workmanual_id" value="<?= $document['workmanual_id'] ?>" class="workmanual_id<?= $document['workmanual_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>
								
								
								
								
								<?php    	}		
									}								
								?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
		
				
				
					<style>
		.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;right: -169px;
}
.table.table-striped th ,
.table.table-striped td {padding:4px;}
.pop-btn
{color:orange;font-weight:bold;}
.dedede{position:relative;}
.dedede:hover > .hjhjhj { display: block;}

@media only screen and (max-width: 767px) {	

.responsive1 th, .responsive1 td {
    font-size: 10px;  padding-left: 1px !important;  padding-right: 1px !important;
}
.padd_decrease { padding-left: 0px; padding-right: 0px;}
.responsive2 th, .responsive2 td {font-size: 10px;padding-left: 2px !important; padding-right: 2px !important;}
.responsive2 .ornge11 span {width: auto !important; padding-left: 5px; padding-right: 5px;}
.title-action{ text-align:left; padding-top:0px;}
.btn-group.pull-right {
    float: left !important;
}
.pull-right>.dropdown-menu {
    left: 0px;
}
.responsive3 th, .responsive3 td {  font-size: 9px;}
div.dataTables_filter label{float: left;}
.ibox-title span {
    font-size: 20px !important;
    padding-top: 17px !important;
    float: left;
    width: 100%;
}
div.dataTables_length label{ width:100%;}
div.dataTables_length label b {
    display: none;
}
.responsive1 th, .responsive1 td{ font-size:7px;}
.responsive1 td .progress-bar { font-size: 7px;    width: 96% !important;}
.responsive1 td a.btn-xs {  padding: 2px; font-size: 8px;}
.icheckbox_square-green, .iradio_square-green{ height:13px; width:13px;}
.icheckbox_square-green, .iradio_square-green {  background-size: 225px 15px;}
.responsive3 .mn_width a {
    white-space: normal;    padding: 0px;
    text-align: left;
    font-size: 11px;
}
div.dataTables_paginate {  float: left;    margin-top: 5px;}

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

@media only screen and (max-width: 400px) {	
.responsive1 th, .responsive1 td{ font-size:6px;}
.responsive2 th, .responsive2 td {font-size: 9px;padding-left: 1px !important; padding-right: 1px !important;}

}

@media only screen and (max-width: 380px) {	
.responsive1 th, .responsive1 td {
    font-size: 6px;
}
.responsive2 th, .responsive2 td {
    font-size: 8px;}
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
.dedede:hover > .hjhjhj {
    display: block;
}
.hjhjhj {
    position: absolute;
    background: #000;
    color: #ffff;
    width: 165px;
    padding: 5px 12px;
    border-radius: 15px;
    display: none;
    margin-left: -169px;
    top: 0px;text-align: right;
}
select#mySelector {
    border: 1px #ddd solid;
    border-radius: 3px;
}
select#mySelector2 {
    border: 1px #ddd solid;
    border-radius: 3px;
}
select#mySelector4 {
    border: 1px #ddd solid;
    border-radius: 3px;
}
.dataTables_wrapper th:nth-child(1) {
    width: 5% !important;
}
.icheckbox_square-green {
    border-radius: 3px;
}
select#mySelector4 {
    border: 1px #ddd solid;
    border-radius: 3px;
    width: 64% !IMPORTANT;
}
.new-catagery {
    width: 100%;
    margin: auto !IMPORTANT;
    text-align: center;
}
.selevtor-22 {
    position: relative;
    left: 8%;
    z-index: 9999999;
}
table#DataTables_Table_2 {
    border-top: 1px #ddd solid !IMPORTANT;
}
table#DataTables_Table_1 {
    border-top: 1px #ddd solid !important;
}
.dataTables_wrapper th:nth-child(3) {
    width: 12% !important;
    background: none;
}
table#DataTables_Table_2 thead tr th.sorting_disabled {
    background: none;
}
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !important;
}
		</style>
		<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content ibox-content2">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px; padding-left:1px;">
							
		<a style="float:right;"href="request/new_request/<?php echo '?cat='.$nameee; ?>" style=" margin-right:10px;margin-top: 15px;" class="btn btn-primary" 
			 data-toggle="modal" data-target="#modal_windowww">
                    <i class="fa fa-plus-circle"></i>
                 <?= $this->lang->line('Add')?>
                </a>			
   <span style="font-size: 23px; vertical-align:bottom; padding-top: 15px; color: #232b32;">Employee Request <!--<//?php echo "Employee Request";?> --> </span>
 
        
                        </div>
						<div class="responsive2">
                            <table class="  table table-striped table-bordered table-hover data_tab" >
							<div class="col-md-3" style="float: right; margin-right: 626px;">
								<div class="my-slect">
							 <select name="request_category_id" id="request_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                            <?php foreach ($requestt as $category) { ?>
                                <option  value="<?= $category['request_name'] ?>"><?= $category['request_name'] ?></option>
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
										 <th><?= $this->lang->line('Requested by') ?></th>
										 <th class="ornge11"><?= $this->lang->line('Status') ?></th>
                                        <th style="text-align:center;"><?= $this->lang->line('File Attachment') ?></th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									// echo '<pre>';
									// print_r($requestemp);
									// echo '</pre>';
									
									foreach ($requestemp['data'] as $index => $documentt) { ?>
                                        <tr entity_id="<?= $documentt['request_id'] ?>">
                                            <td class="idmanual" ><?= $documentt['request_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($documentt['uploaded'])) ?></td>
											<td> <?= $documentt['cname'] ?></td>
                                            <td class="resp"><a class="btn btn-outline btn-primary btn-xs" style="margin-right:8px;" target="_blank" href="request/print_employee_request/<?= $documentt['request_id']; ?>" >
                                                    <i class="fa fa-print"></i>
                                                </a><?= $documentt['description'] ?></td>
											  <td><?= $documentt['name'] ?></td>
 <td class="ornge11"><?php if($documentt['status']==1){?><span class="badge badge-success m-t-xs" style="width: 86px;">Approved</span>
											 <?php } else if($documentt['status']==2){ ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: green !important;">Completed</span>
											 <?php  } else { ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: orange !important;">Pending</span>
											 <?php } ?>
											</td>
                                            <td style="text-align:center;">
                                                <div class="file-name wrapword">
                                                    <?php foreach ($documentt['attachments'] as $attachmentt) { ?>
                                                        <?php if (strpos($attachmentt['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachmentt['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachmentt['location']) ?>" ><img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td style="text-align:center;">

                                                <a class="btn btn-outline btn-success btn-xs" href="request/edit_document/<?= $documentt['request_id'] ?><?php echo '?page=selfservice'; ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $documentt['request_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                               <form action="request/delete_document" method="POST" id="delete_document<?= $documentt['request_id'] ?>">
                                                    <input type="hidden" id="document_id" name="document_id" value="<?= $documentt['request_id'] ?>" class="request_id<?= $documentt['request_id'] ?>">
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
				
				
				
				
				
				
				
				
				
            </div>        
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer')?>



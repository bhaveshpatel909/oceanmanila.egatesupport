<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Dashboard'),'forms'=>TRUE,'tables'=>TRUE)) ?>
 
<style>
.vbn tr:hover td {  background: #f5f5f5 !important;}
.vbn th:first-child, .vbn td:first-child { max-width: 100px !important;  width: 70px !important;}
td.main_sec { font-size: 11px;}
td.secnd22 .badge {border-radius: 2px;margin-left: 0px !important;min-width: 70px !important;margin: 0px;}
td.secnd22 { padding-left: 0px !important;}
.today_shed { display:none;}	
.onlyonmb{ display:none;}	
.ful_width .btn.btn-lg
{
padding: 5px 11px!important;
font-size: 15px!important;
}
@media only screen and (max-width: 767px)
{
.today_shed { display:inline-block;margin-top: 15px;}
.onlyonmb{ display:block;}	
	
}


</style>
<script>
 $('document').ready(function () {
	 
	  $('.data_table').DataTable( {
		  "pageLength": 15,
        "order": [[ 0, "desc" ]]
    } );
	
	  $('.data_table1').DataTable( {
		  "pageLength": 25,
        "order": [[ 0, "desc" ]]
    } );
	  
	
current_table = $('.data_table').dataTable();
		
$('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        });
		
    });
	
	$('.data_table input').attr("placeholder", "enter seach terms here");
    
</script>

<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'dashboard'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
       
        <div class="row ghyg">
		<span class="ful_width">
	<span class="em-q" style="    float: right;
    margin-right: 25px;">
		<a href="employees">
		<button class="btn btn-lg btn-primary" type="button" style="margin-left: 26px;
    margin-top: 15px;}">Attendance</button></a>
        <a href="tasks/new_task">
		<button class="btn btn-lg btn-primary" type="button" style="margin-left: 26px;
    margin-top: 15px;}">Add Task</button></a>
    <a href="schedule/print_all_schedule/<?php echo date('Y-m-d');?>" target="_blank">
        <button class="btn btn-lg btn-primary" type="button" style="margin-left: 26px;
    margin-top: 15px;}">Highlights</button></a>
	<a href="tasks/pending_task	">
        <button class="btn btn-lg btn-primary" type="button" style="margin-left: 26px;
    margin-top: 15px;}">Pending Task</button></a>
	<a  class="onlyonmb" href="schedule">
	
	
        <button class="btn btn-lg btn-primary" type="button" style="margin-left: 26px;
    margin-top: 15px;}">Daily Work</button></a>
	</span>
	 <span style ="color: orange;
    font-weight: bold;
    float:left;
    margin-top: 25px;
    margin-right:0px;
    margin-left:25px;
}">Service will be expired After: <?php echo $service_expire['setting_value'];?>	</span >
	
	</span>
	<div id='calendar' class="col-lg-12"></div>
	
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="clearfix"></div>
						 <div class="col-lg-6 fsttbl">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Latest Tasks')?></h5>
                                </div>
                                <div class="ibox-content fhxfghf">
                                    <div>
									<table class="vbn table table-striped table-bordered table-hover data_table1" >
                                <thead>
                                    <tr>
                                        
										
                                        
										 <th class="asss22 " width="30%"><?= $this->lang->line('Start Date') ?></th>
                                        <th class="asss222" ><?= $this->lang->line('Title') ?></th>
										
										
                                        <!--th width="4%">status</th-->
                                       <!-- <th class="mn_width"><? // = $this->lang->line('Assigned to') ?></th> -->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count_to_termintate = 0;?>
                                    <?php for($i = 0; $i < count($alltask); $i++) { 
                                        
                                        
                                        $task = $alltask[$i];
                                    
									 // echo"<pre>";
									
									 // print_r($alltask[$i]);
									 // echo"</pre>";
										// die;
									
									
									
									
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
											
                                          
<!-- <td class="mn_width3">
 </td>
--> </tr>
                                  	<?php  } ?>
                                </tbody>
                            </table>
									 <!--div class="feed-activity-list">
										
										
                                            <?php// foreach($alltask as $person)//{
												
												// echo '<pre>';
												// print_r($person);
												// echo '</pre>';
												
												
												
												?>
											
											
											
                                            <div class="feed-element">
                                                <a href="employees/edit_employee/<?= $person['employee_id']?>" class="pull-left">
                                                    <img class="img-circle" src="<?= $person['avatar']?>">
                                                </a>
                                                <div class="media-body ">
                                                    <small class="pull-right"><?= date($this->config->item('date_format'),strtotime($person['hired_at']))?></small>
                                                    <strong><?= $person['name']?></strong> 
                                                    <br/>[<?= $person['department_name']?>] <?= $person['position_name']?>
                                                </div>
                                            </div>
                                            <?php //}?>
                                        </div-->
										
                                    </div>
                                </div>
								</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Employee Requests')?></h5>
                                </div>
                                <div class="ibox-content fhxfghf">
                                    <div>
                                    <table class="vbn table table-striped table-bordered table-hover data_table1" >
                                <thead>
                                    <tr>
                                        
                                         <th class="asss22 main_secghy" width="30%"><?= $this->lang->line('Date') ?></th>
										  <th class="secnd22">Status</th>
                                        <th class="asss222" ><?= $this->lang->line('Description') ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
									for($i = 0; $i < count($requests['data']); $i++) { 
                                        
                                        
                                        $req = $requests['data'][$i];
                                        if($i == 20){
                                            break;
                                        }
                                    


                                        ?>                              
                                    
                                        <tr>
                                        
										<?php 
										//print_r($req);
										
										
										$contant = $req['content'];
										
										
										?>
                                            <td  class="main_sec main_secghy"><?php echo date('Y-m-d',strtotime($req['uploaded']));?></td>
                                           <td class="secnd22"><?php if($req['status']==1){?><span class="badge badge-success m-t-xs" style="width: 61px;margin-left: -1px; padding: 5px 2px;">Approved</span>
										   <?php } else if($req['status']==2){ ?>
											 <span class="badge badge-success m-t-xs" style="width: 69px; background-color: green !important; margin-left: -4px;padding: 5px 2px;">Completed</span>
											 <?php } else{ ?>
											 <span class="badge badge-success m-t-xs" style="width: 61px; background-color: orange !important;margin-left: -1px;padding: 5px 2px;">Pending</span>
											 <?php  } ?>
											</td>
											

										  <td class="asss222 asss222eert" style="padding-left: 40px; position: relative;">
                                                <a class="btn btn-outline btn-primary btn-xs fthy" style="margin-right:8px; position: absolute; left: 5px;" target="_blank" href="request/print_employee_request/<?= $req['request_id']; ?>" >
                                                    <i class="fa fa-print"></i> </a>
												<a class="" href="request/edit_document/<?= $req['request_id'] ?>"  data-toggle="modal" data-target="#modal_window">
<span class="on_hover_con"><?php echo $req['description']?>
												<span class="on_hover_text"><?php echo $contant ?></span></span>
												</a>
                                            </td>
                                            
                                        </tr>
                                  
                                        
                                    <?php  } ?>
                                </tbody>
                            </table>
                                    
                                    </div>
                                </div>
							</div>
                        </div>
                        <div class="col-lg-6 side345 report-e">
							
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                 <h5><?= $this->lang->line('Evaluation Report')?></h5>
                                </div>
                                <div class="ibox-content uuuuuuuu">
                                    <!--div>
                                        <?php //if ($unsent_emails>0){?>
                                        <button class="btn btn-info" onclick="ajax_query('dashboard/send_emails')">
                                            <?//= $this->lang->line('Send unsent emails')?> (<?//= $unsent_emails?>)
                                        </button>
                                        <?php //}?>
                                    </div-->
									    <table class=" vbn table table-striped table-bordered table-hover data_table new_table" >
                                <thead>
                                    <tr>
                                        <th style="display:none"><?= $this->lang->line('Employeeid')?></th>
                                       
										
                                        <th  class="new_h_wrap2"><?= $this->lang->line('Date')?></th>
										<th class="new_h_wrap"><?= $this->lang->line('Employee Name')?></th>
										<th class="new_h"><?= $this->lang->line('Evaluation Name')?></th>
                                         
                                        <!--th><?//= $this->lang->line('Score Point')?></th-->
                                        <!--th></th-->
                                    </tr>
                                </thead>
                                <tbody class="fbody">
                                    <?php foreach($evaluations as $evaluation){?>
                                    <tr entity_id="<?= $evaluation['evaluation_id'] ?>">
                                        <td style="display:none"><?= $evaluation['empid']?></td>
                                       
                                        <td class="new_table_wrap2"><?= date('Y-m-d',strtotime($evaluation['date']))?></td>
										<td class="new_table_wrap1"><a href ="employees/edit_employee/<?php echo $evaluation['empid'];?>"><?= $evaluation['name']?></a></td>
                                        <td class="new_table_wrap"><?= $evaluation['reason']?></td>
										 
                                        <!--td class="price"><?//= $evaluation['score']?></td-->
                                        <!--td>
                                            <a class="btn btn-outline btn-success btn-xs" href="evaluation/edit_evaluation/<?//= $evaluation['evaluation_id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="evaluation/preview_evaluation/<?//= $evaluation['evaluation_id']?>">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Evaluation ?') && submit_form('#delete_evaluation<?//= $evaluation['evaluation_id']?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                
                                                <form action="evaluation/delete_evaluation" method="POST" id="delete_evaluation<?//= $evaluation['evaluation_id']?>">
                                                    <input type="hidden" id="evaluation_id" name="evaluation_id" value="<?//= $evaluation['evaluation_id']?>" class="evaluation_id<?//= $evaluation['evaluation_id']?>">
                                                </form>
                                        </td-->
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
									
                                </div>
                            </div>
				
			</div>
			
			<div class="col-lg-6">
						<div class="ibox-title">
                 <h5><?= $this->lang->line('Latest D.A &amp; C.A')?></h5>
             </div>					
			<div class="ibox-content fhxfghf search">
			 <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
                            <table class=" vbn table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
										<th style="display:none"><?= $this->lang->line('Employeeid')?></th>
										<th class="new_h_row"><?= $this->lang->line('Date') ?></th>
                                        <th class="new_h_row1"><?= $this->lang->line('Employee') ?></th>
                                        
                                        <th class="new_h_row2"><?= $this->lang->line('Reason') ?></th>
                                        <!--th><?//= $this->lang->line('File Attachment') ?></th-->
                                        <th><?= $this->lang->line('Action Taken') ?></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($discipline as $record) { ?>
                                        <tr  entity_id="<?= $record['record_id'] ?>">
											<td style="display:none"><?= $record['empid']?></td>
											<td><?= date('Y-m-d', strtotime($record['date'])) ?></td>
											<td><a href ="employees/edit_employee/<?php echo $record['empid'];?>"><?= $record['name'] ?></a></td>
                                            <td><?= $record['reason'] ?></td>
                                            <!--td>
                                                <?php //foreach ($record['attachments'] as $attachment) { ?>
                                                    <?php //if (strpos($attachment['mime'], 'image') === false) { ?>
                                                        <div><a class='preview ' target="_blank" href="<?php// echo base_url('discipline/download_attachment/' . $attachment['attachment_id']) ?>" ><?//= $attachment['file'] ?></a></div>
                                                    <?php// } else { ?>
                                                        <div><a class='preview ' data-toggle='lightbox' href="<?php// echo base_url('files/attachments/' . $attachment['location']) ?>" ><?//= $attachment['file'] ?></a></div>
                                                    <?php //}
                                              //  }
                                                ?>
                                            </td-->
                                            <td><?= $record['action_taken'] ?></td>
                                            <!--td>
                                                <a class="btn btn-outline btn-success  btn-xs" href="discipline/edit_record/<?//= $record['record_id'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="discipline/preview_record/<?//= $record['record_id'] ?>">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Discipline ?') && submit_form('#delete_discipline<?//= $record['record_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <form action="discipline/delete_record" method="POST" id="delete_discipline<?//= $record['record_id'] ?>">
                                                    <input type="hidden" id="record_id" name="record_id" value="<?//= $record['record_id'] ?>" class="record_id<?//= $record['record_id'] ?>">
                                                </form>
                                            </td-->
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
											
			     <div class="clearfix"></div>
				  
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<style>
th.new_h_wrap2.sorting {
    max-width: 100px !important;
    width: 70px !important;
}
.vbn td {
    font-size: 11px !important;
}
th.new_h_row.sorting {
    width: 70px !important;
}
.ibox-content.fhxfghf.search {
    padding-left: 5px !important;
}

th.new_h_wrap.sorting {
    width:118px !important;
}
th.new_h.sorting {
    width: 160px !important;
}

.ibox-content.uuuuuuuu {
    padding-right: 22px !important;
}
.ibox-content.fhxfghf.search .wrapper.wrapper-content.animated.fadeInDown .ibox-content {
  
    border-color: #fff;
}
.ibox-content.fhxfghf.search .wrapper.wrapper-content.animated.fadeInDown{  padding-top: 0px;}
.ibox-content.fhxfghf.search div.dataTables_filter label {
    top: -65px;    right: -15px;
}
.fsttbl tr td, .fsttbl tr th {
    padding: 10.5px 8px !important;
}
div.dataTables_filter label { position: absolute;  top: -50px;  right: 0px;    color: #428bca;}
div.dataTables_filter label input {
    width: 115px !important;    color: #000;
}
.dataTables_wrapper .row:last-child .col-sm-6 {
    width: 100%;
}
div.dataTables_paginate {
    width: 100%;
    float: left;
    margin-top: 10px;
}
.dataTables_length {
    display: none;
}
.dataTables_filter {
    
}
div.dataTables_filter label{ float:left;}
.dataTables_wrapper>.row:first-child .col-sm-6:first-child {
    display: none;
}
.dataTables_wrapper>.row:first-child .col-sm-6:last-child {
    width: 100%;
}
table#DataTables_Table_2 th:nth-child(2), table#DataTables_Table_2 td:nth-child(2) {
    width: 78px;
}
.table-striped>tbody>th:nth-child(1){
	
	
}
div.dataTables_filter label { }
select.form-control.input-sm {
    margin-top: 7px;
}

div.dataTables_length label select {
    color: #333;
}
div.dataTables_length label {
    color: transparent;
}
.secnd22 {
    width: 70px !important;
    max-width: 67px !important;
    padding-left: 4px !important;
}
.on_hover_text {position: absolute;
    background: #fff;
    padding: 10px;
    box-shadow: 2px 2px 4px #999;
    display: none;
    z-index: 9999;
    left: -36px;
    color: #333;
    min-width: 304px;
    top: auto;
    border-radius: 7px;
    bottom: 116%;}
.on_hover_con:hover > .on_hover_text {  display: block;}
.on_hover_con { position: relative;  cursor: pointer;  color: #428bca;  width: 100%;  display: inline-block;}
.ibox-content.fhxfghf table th:first-child { }
.ibox-content.fhxfghf table td:first-child {  border-left: 1px solid #fefefe;}
.ibox-content.fhxfghf table td:last-child { border-right: 1px solid #fefefe;  background: #fefefe;}
.ibox-content.fhxfghf table td { border-right: 1px solid #fdfdfd;}
.vbn .odd td {
    background-color: #f5f5f5 !important;
}
.ibox-content.fhxfghf table th {
    background: none;
    border-right-color: #fefefe;
    border-left-color: #fefefe;
}
.ibox-content.fhxfghf tr td {
    border-bottom: 1px solid #ddd !important;
}
body .ibox-content.fhxfghf tr th {
    border-bottom: 1px solid #ddd !important;
}
.fhxfghf table tr th:first-child , .fhxfghf table tr td:first-child
{ width: 85px;		
}

@media only screen and (max-width: 767px) {
	.main_secghy {
    width: 70px !important;
    max-width: 100%;
}
div.dataTables_filter label input {
    width: 116px !important;
    color: #000;
    
}

.dataTables_filter {
    
    margin-bottom: -9px;
}
td.asss222.asss222eert {
    padding-left: 7px !important;
}	
.fthy{ display:none;}	
.ghyg .btn-primary {
    margin-left: 5px !important;
    padding: 5px 6px;
    font-size: 14px;
}
	td.main_sec {
    font-size: 9px;
}

td.asss222 a {
    font-size: 11px;
}

.ful_width {float: left; width: 100%; text-align: center;  margin-bottom: 15px;  position: relative;    z-index: 99999;
    padding: 0px 26px;
}
.on_hover_text {
padding: 10px 11px;
    padding: 10px 11px;
    display: none;
    z-index: 9999;
    left: auto;
    color: #333;
    min-width: 100%;
    top: 0px;
    border-radius: 7px;
    right: 0px;
    width: 118px;
    min-width: 247px;
    margin-right: 7px;
    bottom: 111%;
    top: auto;
    width: 100%;
    max-width: 100%;
    margin-top: -33px;
    margin-right: 0px;
    margin-left: 0px;
}
span.ful_width a {
    padding: 0px 2px;
    display: inline-block;
}
span.ful_width a:nth-child(1) {
    padding-left: 0px;
    float: left;
}
span.ful_width a:nth-child(4) {
    padding-right: 0px;
    float: right;
}
.minimalize-styl-2{ margin-left:26px;}
}
@media only screen and (max-width: 400px) {
	
	
.ghyg .btn-primary {
    margin-left: 0px !important;
    padding: 5px 4px;
    font-size: 12px;
}
}
.report-e {
    position: relative;
    top: -76px;
}

</style>

<?php $this->load->view('layout/footer')?>
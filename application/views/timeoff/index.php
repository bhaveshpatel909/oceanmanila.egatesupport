<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Approved'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_tablee = $('.data_table').dataTable({
            "order": [[0, "desc"]],
            "columnDefs": [{
//                    "targets": [0, 6],
//                    "orderable": false
                }]
        });
	$('.mySelector').change( function(e) { 
	//alert("dsgfd");
   var letter = $(this).val();
  //alert(letter);
 current_tablee.fnFilter( $(this).val() ,1); 	 
 });
		$('.mySelectort').change( function(e) { 
	//alert("dsgfd");
   var letter = $(this).val();
  //alert(letter);
 current_tablee.fnFilter( $(this).val() ,4); 	 
 });
		
    });
</script>

<style>
.col-lg-8.align_wrap {
    height: 60px!important;
}
.alignset {
    float: left;
}
.align2 {
    float: left;
    padding-left: 28px;
    min-width: 285px;
}

</style>




<div id="wrapper">


    <?php $this->load->view('layout/menu',array('active_menu'=>'leave_tracking'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8 align_wrap">
			  <div class="alignset">
                <h2><?= $this->lang->line('Approved')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Leave tracking')?>
                    </li>
                </ol>
            </div>
			    <div class="align2 form-group" style="padding-top: 30px;">
				<?php 
				// echo "<pre>";
				// print_R($empdata);
				?>
                    <select style="    height: 35px;
    width: 99% !important; border:1px #ddd solid; border-radius:3px;" name="mySelector" class="mySelector">
							<option value=""> &nbsp;&nbsp;Select Employee</option>
						
							<?php foreach($emp as $recordf){
						
						?>
						 <option  value="<?= $recordf['name'] ?>"><?= $recordf['name'] ?></option>
						<?php } ?>
                    </select>
					
                </div>
				
				<div class="align3 export-button" style="float:left;">
				<a href="<?php echo base_url();?>timeoff/exportlist">Export</a>
				</div>
            </div>
			
			
		<!--	<div class="col-lg-2">
                <div class="form-group" style="padding-top: 30px;">
				<//?php 
				//echo "<pre>";
				//print_R($empdata);
				?>
                    <select name="mySelectort" class="mySelectort" style="height: 35px;width: 85%;">
							<option value="">Select Status</option>
						 <option value="approved">Approved</option>
						 <option value="denied">Denied</option>
						
                    </select>
					
                </div>
            </div>
		-->
            <div class="col-lg-6">
                <div class="title-action">
				<?//php
                              // echo '<pre>';
							  // print_R($emppdata);
                              // echo '</pre>';

								 //if(//$emppdata[0]['write_lea']=="0") { ?>
                    <!--<a href="timeoff/new_record" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
                        <i class="fa fa-plus-circle"></i>
                        <?//= $this->lang->line('Add')?>
                    </a>-->
					 <?//php //} ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
                            <table class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
									 <th><?= $this->lang->line('Request Date')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Dates')?></th>
                                        <th><?= $this->lang->line('Employee Comments')?></th>
                                        <th><?= $this->lang->line('Admin Comment')?></th>
                                        <th><?= $this->lang->line('Files')?></th>
                                        <th><?= $this->lang->line('Type / Status')?></th>
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($records as $record){
										
							//print_r($record);
										
										
										?>
                                    <tr entity_id="<?= $record['record_id']?>" status="<?= $this->lang->line(ucfirst($record['status']))?>">
									    <td><?= $record['register_date']?></td>
                              <td><span class="minspan"> <?= $record['name']?> <p style="display:none;" ><?= $record['record_id']?></p><span class="on_hover1">
							 <p><b>Employee Comment </b><?= $record['employee_comment']?></p><p><b> Comment </b>
							  <?= $record['comment']?></p>
							  </span></span></td>
                                        <td><?= date($this->config->item('date_format'),strtotime($record['start_time']))?> - <?= date($this->config->item('date_format'),strtotime($record['end_time']))?></td>
										<td><?= $record['employee_comment']?></td>
										<td><?= $record['comment']?></td>
										<td> <?php foreach ($record['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/Leaveform/' . $attachment['location']) ?>"download="<?php echo base_url('files/attachments/201File/' . $attachment['file']) ?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/Leaveform/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?></td>
                                        <td><?= $this->lang->line(ucfirst($record['type']))?> / <?= $this->lang->line(ucfirst($record['status']))?></td>
										<td>
										<?php if($record['status'] =='approved'){?>
											<button type="button" class="btn btn-success Approved1">Approved</button>
											
										<?php } ?>
										
										</td>
                                        <td>
										<?php
                              // echo '<pre>';
							  // print_R($emppdata);
                              // echo '</pre>';
										
								 if (!$this->user_actions->is_selfservice() || $this->user_actions->is_allowed('Leave Approval')) { ?>
                                            <a class="btn btn-outline btn-success" href="timeoff/edit_record/<?= $record['record_id']?>" data-target="#modal_window" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </a>
								 <?php  } ?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.form-group {
    margin-bottom: 0px;
}
div#DataTables_Table_0_filter input {
border: 1px solid #a7a1a1;}
button.btn.btn-success.Approved1 {
    color: rgb(255, 255, 255);
    background-color: rgb(92, 184, 92);
    border-color: rgb(76, 174, 76);
}
div#DataTables_Table_0_filter {
    position: relative;
    top:-94px;
   
}
.export-button
{
	padding-top:30px;
}
.export-button a
{
	background:#1AB394;
	color:#fff;
	border-radius:4px;
	display:inline-block;
	padding:8px 20px;
}
span.on_hover1 p b { display: block;}
.minspan:hover > .on_hover1 { display: block;}
span.minspan {
    position: relative;
}
.page-heading {
    border-top: 4px solid #E7EAEC;
    padding: 0px 10px 0px 10px;
}
.on_hover1 {
    display: none;
    position: absolute;
    background: #fff;
    padding: 9px;
    box-shadow: 0px 4px 2px #dcd9d9;
    min-width: 455px;
    text-align: justify;
    bottom: 29px;
    border-radius: 4px;
}
.deny {
    color: #f9efef;
    font-weight: bolder;
    background: red;
    
}
.Approved {
    background: green;
    color: white;
    font-weight: bolder;
    padding: 2px 8px;
    border-radius: 2px;
}
.dataTable tr td:nth-child(5){ text-align:left; vertical-align: middle;}
.dataTable tr td:nth-child(5) span {     min-width: 69px;
    display: inline-block;
    font-weight: normal;
    border-radius: 3px;
    text-align:left;}

	.dataTable tr td:nth-child(8),.dataTable tr th:nth-child(8){
    width:40.031px !important;
}
.dataTable tr td:nth-child(6),.dataTable tr th:nth-child(6){
    width:128.031px !important;
}
.dataTable tr td:nth-child(7),.dataTable tr th:nth-child(7){
    width: 100.031px !important;
}
	.dataTable tr td:nth-child(5), .dataTable tr th:nth-child(5) {
    max-width: 270px !important;
    width: 420.031px !important;
}
.dataTable tr td:nth-child(4), .dataTable tr th:nth-child(4) {
    max-width: 270px !important;
    width: 420.031px !important;
}
.dataTable tr td:nth-child(3),.dataTable tr th:nth-child(3){
	    max-width: 270px !important;
    width: 174px !important;
	
}
.dataTable tr td:nth-child(2),.dataTable tr th:nth-child(2){
	    max-width: 270px !important;
    width: 168px !important;
	
}
.dataTable tr td:nth-child(1),.dataTable tr th:nth-child(1){
	    max-width: 270px !important;
    width: 116px !important;
	
}
.breadcrumb>li+li:before {
    content: "/\00a0";
    padding: 0 5px;
    color: #ccc;
    padding: 0px !important;
    position: relative !important;
    left: 2px !important;
}
.export-button {
    padding-top: 30px !important;
    margin-left: 15px !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}
</style>
<?php $this->load->view('layout/footer')?>
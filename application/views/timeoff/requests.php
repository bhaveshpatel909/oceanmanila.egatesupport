<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Requests'),'forms'=>TRUE,'tables'=>TRUE,'magicsuggest'=>TRUE)) ?>
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
		
    })
</script>
<style>
div#DataTables_Table_0_filter {
    position: absolute;
    top: -104px;
    left: -504px;
}
div#DataTables_Table_0_filter input {
border: 1px solid #a7a1a1;}
.alignset {
    float: left;
}
.align2 {
    float: left;
    padding-left: 45px;
    min-width: 285px;
}
</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'timeoff_requests'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
            <div class="alignset">
                <h2><?= $this->lang->line('Requests')?></h2>
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
<select name="mySelector" class="mySelector" style="height: 35px;width: 99%;border: 1px #ddd solid;border-radius: 3px;">
<option value="">Select Employee</option>

<?php foreach($empdata as $recordee){

?>
<option value="<?= $recordee['name'] ?>"><?= $recordee['name']?></option>
<?php 

}
 ?>
</select>
 

</div>

<div class="align3 export-button" style="float:left;">
				<a href="<?php echo base_url();?>timeoff/exportrequestlist">Export</a>
				</div>
            </div>	
		
<div class="col-lg-2"> 
</div>

			<div class="col-lg-2">                <div class="title-action">                <!--    <a href="timeoff/new_record" class="btn btn-primary" data-target="#modal_window" data-toggle="modal"> -->					
			
			
			<a href="timeoff/new_record" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">                        <i class="fa fa-plus-circle"></i>                        <?= $this->lang->line('Add')?>                    </a> 
							

			</div>            </div>
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
                                    <tr> <th><?= $this->lang->line('Request Date')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Dates')?></th>
                                        <th><?= $this->lang->line('Employee Comments')?></th>
                                        <th><?= $this->lang->line('Admin Comment')?></th>
										<th><?= $this->lang->line('Type')?></th>
                                        <th style="width:8% !important;"><?= $this->lang->line('Leave Status')?></th>
                                       <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($records as $record){
										// echo"<pre>";
										// print_R($record);
								// echo"</pre>";
										
										?>
                                    <tr entity_id="<?= $record['record_id']?>">
									     
                                        <td><?= $record['register_date']?></td>
                                        <td><?= $record['name']?></td>
                                        <td><?= date($this->config->item('date_format'),strtotime($record['start_time']))?> ~ <?= date($this->config->item('date_format'),strtotime($record['end_time']))?></td>
										<td><?= $record['employee_comment'];?></td>
										<td><?= $record['comment'];?></td>
										
                                        <td><?= $this->lang->line(ucfirst($record['type']))?></td>
										<td><?php if($record['status']=='denied'){?>
											
                             <button type="button" style="width: 95px;" title="Please Confirm Your Department Head About This" value="denied" class="btn btn-danger">DENY</button>
											
										<?php }else{ ?>
										<button type="button" value="request" title="Your Leave On Processing Please Wait" class="btn btn-warning">Processing</button>
										
										<?php } ?></td>
										<td><a target="_blank" title="Approve/Deny Leave from here" href="employees/print_employee_leave/<?= $record['record_id'] ?>" class="btn btn-primary ">
                        <i class="fa fa-file-pdf-o"></i> &nbsp;Print Form  </a></td>
                                      <td>
									     <?php if (!$this->user_actions->is_selfservice() || $this->user_actions->is_allowed('Leave Approval')) { ?>
										<a class="btn btn-outline btn-success new_btn" title="Approve/Deny Leave from here" href="timeoff/view_request/<?= $record['record_id']?>" data-target="#modal_window" data-toggle="modal">
                                                <i class="fa fa-info"></i>
                                            </a>
							
                                        </td>
									  <?php } ?>
										
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
.btn-success.btn-outline {
    color: #1C84C6;
    float:none !important;
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
a.btn.btn-primary {
    padding-top: 10px !important;
    padding-bottom: 8px !important;
}
.dataTable tr td:nth-child(5), .dataTable tr th:nth-child(5) {
    width: 50px !important;
    max-width: 100px;    min-width:200px !important;
}.dataTable tr td:nth-child(6), .dataTable tr th:nth-child(6) {
width: 29px !important;}
.dataTable tr td:nth-child(7), .dataTable tr th:nth-child(7) {
    width: 7px !important;
    max-width: 68px;
    min-width: 50px;
}
.dataTable tr td:nth-child(3), .dataTable tr th:nth-child(3) {
    min-width: 84px;
}
.dataTable tr td:nth-child(9), .dataTable tr th:nth-child(9) {
    max-width: 100px !important;
    width: 25px !important; text-align: center;
}
.dataTable tr td:nth-child(7) button {
    width: 97px !important;
}

.dataTable tr td:nth-child(8), .dataTable tr th:nth-child(8) {
           width:74px !important;
    max-width: 43px;
    min-width: 17px;

}

.dataTable tr td:nth-child(4), .dataTable tr th:nth-child(4) {
    width:240px !important;
    max-width: 146px;
}
.dataTable tr td:nth-child(3), .dataTable tr th:nth-child(3) {
	width: 76px !important;
}
.dataTable tr td:nth-child(1),.dataTable tr th:nth-child(1) {
	width:62px !important;
}
.dataTable tr td:nth-child(2),.dataTable tr th:nth-child(2) {
	width: 151px !important;
	    
}
.dataTable tr td:nth-child(7) button {
    /* width: 47px !important; */
    min-width: 127px;
    padding: 10px 21px 7px 21px!important;
}
div#DataTables_Table_0_filter {
    position: absolute;
    top: -110px;
    left: 0;
}
.dataTable tr td:nth-child(5), .dataTable tr th:nth-child(5) {
    width: 50px !important;
    max-width: 100px;
    min-width: 90px !important;
}
.dataTable tr td:nth-child(2), .dataTable tr th:nth-child(2) {
    width: 111px !important;
}
.dataTable tr td:nth-child(7) button {
    min-width: 106px;
}
.dataTable tr td:nth-child(8), .dataTable tr th:nth-child(8) {
    width: 87px !important;
}

a.btn.btn-outline.btn-success.new_btn {
    padding: 9px 17px;
}
.align2 {
    float: left;
    padding-left: 29px;
    min-width: 285px;
}
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !IMPORTANT;
}
.breadcrumb>li+li:before {
    content: "/\00a0";
    padding: 0 5px;
    color: #ccc;
    padding: 0px !important;
    position: relative;
    left: 2px !important;
}
.align3.export-button {
    margin-left: 15px !important;
}
.dataTable tr td:nth-child(7) button {
    width: 52px !important;
}
.dataTable tr td:nth-child(7) button {
    min-width: 79px;
}
.dataTable tr td:nth-child(8), .dataTable tr th:nth-child(8) {
    width: 105px !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}


</style>
<?php $this->load->view('layout/footer')?>
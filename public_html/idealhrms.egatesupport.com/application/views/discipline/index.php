<?php $this->load->view('layout/header', array('title' => $this->lang->line('Discipline'), 'forms' => TRUE, 'tables' => TRUE)) ?>
<script>
    $('document').ready(function(){
		
		 $('.data_table').DataTable( {
		  
        "order": [[ 2, "desc" ]]
    } );
		
		
		
        mcurrent_table = $('.data_table').dataTable();
		
		$('.datetimepicker').datetimepicker({pickTime: false});
		
		var bla = $('#selectemp').val();
			if (bla === 'null') {
				$ ('tr').show ();
			}
			else {
				$("table tr td:nth-child(1)").each(
				function(){
					if($(this).html() != bla){
						$(this).parent().hide();
					}
					else{
						$(this).parent().show();
					}
				});
				$('#mySelector').val(bla).prop('selected', true);
			} 
		
		$(".searchInput").on("change", function() {
			//alert('enter2');
			var from = $("#frm_dat").val();
			var to = $("#to_dat").val();
				//alert(from);
				//alert(to);
			$(".fbody tr").each(function() {
				var row = $(this);
				var date = row.find("td").eq(2).text();
				//alert(date);
				//show all rows by default
				var show = true;

				//if from date is valid and row date is less than from date, hide the row
				if (from && date < from)
				show = false;
			
				//if to date is valid and row date is greater than to date, hide the row
				if (to && date > to)
				show = false;

				if (show)
				row.show();
				else
				row.hide();
			});
		});
		
		$('#mySelector').change( function(e) { 
			var letter = $(this).val();
			if (letter === 'null') {
				$ ('tr').show ();
			}
			else {
				$("table tr td:nth-child(1)").each(
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
		
		$("#mystatus").on("change", function() {
		
			var proid = $(this).val();
			window.location.href = 'discipline/index/'+proid;
		});
		
	
		  
		  
		
		

	var sum = 0;
	$("table tr:visible .price").each(function() {

		var value = $(this).text();
		// add only if the value is number
		if(!isNaN(value) && value.length != 0) {
			sum += parseFloat(value);
		}
		
	});
		
    });
	
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
	
	
		function msend(id){
		var burl = '<?php echo base_url();?>';
			$.ajax({
            type: 'post',
			cache: false,
            url: burl+'discipline/send_mail/'+id,
           data : 'mid='+ id,
            success: function (response) {
				console.log(response);
              alert('Mail sent successfully');
            }
          });
		  
		}
		  
</script>
<style>
.breadcrumb > li a{ font-size:13px;}
.breadcrumb > li { font-size:13px;}
.goto-emp
{ color: #1AB394;
/*text-shadow: 0px -1px 7px #ccc;*/
font-size: 15px;
}
.goto-emp a{font-size: 13px;color: #1AB394;text-decoration: none;}
.one_line {
    font-size: 17px;
    font-weight: 600;
    margin-top: 28px;
}
.col-lg-3.brdcrumb {
    padding-right: 0px;
}
.col-lg-1.totll1 h2 {
    font-size: 19px;
    padding-top: 15px;
}
.col-lg-1.totll1 {
    padding: 0px;
}
ol.breadcrumb.breadcrumb22 { width: auto;  display: inline-block;}
p.goto-emp {width: auto; display: inline-block;padding-left: 40px;}
.dataTables_length select { margin-right: 15px;}

.new-fome select#mystatus {
    border: 1px #ddd solid !important;
    border-radius: 3px !important;
}
.new-fome select#mySelector {
    border: 1px #ddd solid !important;
    border-radius: 3px !Important;
}
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}

</style>
<?php 
	if(isset($_GET['id'])){ ?>
		<input type="hidden" id="selectemp" value="<?=$_GET['id'];?>">	
	<?php }else{ ?>
		<input type="hidden" id="selectemp" value="null">
<?php } ?>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'discipline')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-4 brdcrumb">              
                <h2 style="margin-left:0px" class="one_line"><?= $this->lang->line('Disciplinary & Corrective Action') ?></h2>
				
                <ol style="display:none" class="breadcrumb breadcrumb22">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Discipline') ?>
                    </li>
                </ol>
				<p style="padding-left:0px;"class="goto-emp">
<a href="<?php echo base_url();?>employees">Click here to created disciplinary & corrective action 
</a></p>
            </div>
			<div style="padding:0px;" class="col-lg-1">
				<div class="form-group new-fome" style="padding-top: 30px;">
                    <select name="mystatus" id="mystatus" style="    height: 35px;
    width:77%;
    float: right;
    margin-right: 8px;">
						
						<option style="text-align:center;"value="1" <?php if($eid==1){ echo 'selected'; } ?>>ACTIVE</option>
						<option value="2"<?php if($eid==2){ echo 'selected'; } ?>>Inactive</option>
						<option value="0"<?php if($eid==0){ echo 'selected'; } ?>>All</option>
						
					</select>
                </div>
            </div>
			<div style="padding:0px;" class="col-lg-2">
				<div class="form-group new-fome" style="padding-top: 30px;">
                    <select name="mySelector" id="mySelector" style="height: 35px;width:85% !important;">
						<option style="text-align:center; value="null">SELECT EMPLOYEE</option>
						<?php foreach($employ as $emp) { ?>
							<option value="<?= $emp['id']?>"><?= $emp['name']?></option>
						<?php } ?>
					</select>
                </div>
            </div>
			<div style="padding-right:0px;" class="col-lg-5">
				<div style="padding:0px 0px;  margin-top:30px;" class="col-lg-6" style="margin-top:30px;">
					<input type="text" name="frm_dat" id="frm_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="From Date">
				</div>
				<div class="col-lg-6" style="margin-top:30px;">
					<input type="text" name="to_dat" id="to_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="To Date">
				</div>
            </div>
            <div style="display:none;"class="col-lg-1 totll1">
				
                <h2 style="color:red">Total Score</h2>
            </div>
            <div style="display:none;" class="col-lg-1 ">
                <div class="title-action">
                    <!--a href="discipline/new_record" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
                    </a-->
                </div>
            </div>
			<div class="col-sm-12 col-md-12">

			</div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
                            <table class="table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
										<th style="display:none"><?= $this->lang->line('Employeeid')?></th>
                                        <th><?= $this->lang->line('Employee') ?></th>
                                        <th><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Reason') ?></th>
                                        <th><?= $this->lang->line('File Attachment') ?></th>
                                        <th><?= $this->lang->line('Action Taken') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($discipline as $record) { ?>
                                        <tr  entity_id="<?= $record['record_id'] ?>">
											<td style="display:none"><?= $record['empid']?></td>
                                            <td><?= $record['name'] ?></td>
                                            <td><?= date('Y-m-d', strtotime($record['date'])) ?></td>
                                            <td><?= $record['reason'] ?></td>
                                            
								<td>
							  <?php foreach ($record['attachments'] as $attachment) {?>
							  <?php if (strpos($attachment['mime'], 'image') === false) { ?>
<i style='color: red;cursor: pointer;' class="fa fa-file-pdf-o"> &nbsp;<a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']);?>" download="<?php echo base_url('files/attachments/' . $attachment['file']) ?>" target="_blank"><?php echo $attachment['file'];?> </a>

</i>
							  <?php  } }?>
								</td>
                                         <?php //print_r($record); ?>
                                            <td><?= $record['action_taken'] ?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success  btn-xs" href="discipline/edit_record/<?= $record['record_id'] ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="discipline/preview_record/<?= $record['record_id'] ?>">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Discipline ?') && submit_form('#delete_discipline<?= $record['record_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												
												<a class="btn btn-outline btn-primary btn-xs" href="javascript:void(0);" onclick="msend(<?php echo $record['record_id'];?>)">
												<img src="<?php echo base_url();?>images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"></a>

                                                <form action="discipline/delete_record" method="POST" id="delete_discipline<?= $record['record_id'] ?>">
                                                    <input type="hidden" id="record_id" name="record_id" value="<?= $record['record_id'] ?>" class="record_id<?= $record['record_id'] ?>">
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
<?php
$this->load->view('layout/footer')?>
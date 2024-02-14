<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Work Evaluation'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
		 $('.data_table').DataTable( {
		  
        "order": [[ 2, "desc" ]]
    } );
		
        current_table = $('.data_table').dataTable();
		
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
			var sum = 0;
	$("table tr:visible .price").each(function() {

		var value = $(this).text();
		// add only if the value is number
		if(!isNaN(value) && value.length != 0) {
			sum += parseFloat(value);
		}
	});
	$("#MyEdit").html(sum);
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
			var sum = 0;
	$("table tr:visible .price").each(function() {

		var value = $(this).text();
		// add only if the value is number
		if(!isNaN(value) && value.length != 0) {
			sum += parseFloat(value);
		}
	});
	$("#MyEdit").html(sum);
		});
		
		
		

	var sum = 0;
	$("table tr:visible .price").each(function() {

		var value = $(this).text();
		// add only if the value is number
		if(!isNaN(value) && value.length != 0) {
			sum += parseFloat(value);
		}
	});
	$("#MyEdit").html(sum);
	
	$("#mystatus").on("change", function() {
		
			var proid = $(this).val();
			window.location.href = 'evaluation/index/'+proid;
		});
		
    });
</script>
<style>
.goto-emp{color: #1AB394;/*text-shadow: 0px -1px 7px #ccc;*/font-size: 14px;}
.stynew h2, .stynew p { }
.col-lg-1.classss {    padding-left: 0px;    padding-right: 0px;}
.col-lg-3.stynew {    padding-right: 3px;}
.goto-emp a {color: #1AB394; text-decoration: none; font-size:13px;}
ol.breadcrumb.breadcrumb22 { width: auto;  display: inline-block;}
p.goto-emp {width: auto; display: inline-block;padding-left:15px;}
.col-lg-1.chsssj { padding: 0px;}
.col-lg-1.chsssj h2 { font-size: 23px;  margin-top: 30px;}
.col-lg-4.stynew {padding-right: 0px;}
ol.breadcrumb.breadcrumb22 li, ol.breadcrumb.breadcrumb22 li a { font-size: 13px;}


tbody.fbody tr.odd td:nth-child(5) {
    text-align: center;
}
tbody.fbody tr.even td.price {
    text-align: center;
}
tbody.fbody tr td:nth-child(6) {
    text-align: center;
}
</style>
<?php 
	if(isset($_GET['id'])){ ?>
		<input type="hidden" id="selectemp" value="<?=$_GET['id'];?>">	
	<?php }else{ ?>
		<input type="hidden" id="selectemp" value="null">
<?php } ?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'evaluations'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div style="width: 32%;"class="col-lg-4 stynew">
                <h2 style="margin-left:13px;"><?= $this->lang->line('Evaluation Report')?>	<span></span></h2>
                <p class="goto-emp gghjk"><a href="http://wshrms.peza.com.ph/employees">Go to employee page to create work evaluation report</a></span></p>
				
                <ol style="display:none;" class="breadcrumb breadcrumb22">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Employee Work Evaluation List')?>
                    </li>
                </ol>
            </div>
			<div style="padding:0px;" class="col-lg-1">
			<?php  
        // echo '<pre>';
		// print_r($employ);
        // echo '</pre>';
		// die('gggg');



			?>
				<div class="form-group" style="padding-top: 30px;">
                    <select name="mystatus" id="mystatus" style="height: 35px;width: 85%;">
						
						<option value="1" <?php if($eid==1){ echo 'selected'; } ?>>ACTIVE</option>
						<option value="2"<?php if($eid==2){ echo 'selected'; } ?>>INACTIVE</option>
						<option value="0"<?php if($eid==0){ echo 'selected'; } ?>>ALL</option>
						
					</select>
                </div>
            </div>
			<div style="padding:0px;" class="col-lg-2 classss">
				<div class="form-group" style="padding-top: 30px;">
                    <select name="mySelector" id="mySelector" style="height: 35px;width: 85%;">
						<option value="null">SELECT EMPLOYEE</option>
						<?php foreach($employ as $emp) { ?>
							<option value="<?= $emp['id']?>"><?= $emp['name']?></option>
						<?php } ?>
					</select>
                </div>
            </div>
			<div  style="padding:0px;"class="col-lg-4">
				<div style="padding:0px;margin-top:30px;" class="col-lg-6" style="margin-top:30px;">
					<input type="text" name="frm_dat" id="frm_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="From Date">
				</div>
				<div class="col-lg-6" style="margin-top:30px;">
					<input type="text" name="to_dat" id="to_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="To Date">
				</div>
            </div>
            <div style="padding:0px;" class="col-lg-1 chsssj">
				
                <h2 style="font-size:19px; color:red">Total Score:<span id="MyEdit"></span></h2>
            </div>
			<!--div class="col-lg-1">
                <div class="title-action">
                    <a href="evaluation/new_evaluation" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add')?>
                    </a>
                </div>
            </div-->
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
                                       
										<th width="18%"><?= $this->lang->line('Evaluation Name')?></th>
                                        <th width="8%"><?= $this->lang->line('Date')?></th>
                                         <th width="18%"><?= $this->lang->line('Employee')?></th>
                                        <th style="text-align:center;"><?= $this->lang->line('Score Point')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="fbody">
                                    <?php foreach($evaluations as $evaluation){?>
                                    <tr entity_id="<?= $evaluation['evaluation_id'] ?>">
                                        <td style="display:none"><?= $evaluation['empid']?></td>
                                       <td><?= $evaluation['reason']?></td>
                                        <td><?= date('Y-m-d',strtotime($evaluation['date']))?></td>
                                        
										 <td><?= $evaluation['name']?></td>
                                        <td class="price"><?= $evaluation['score']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success btn-xs" href="evaluation/edit_evaluation/<?= $evaluation['evaluation_id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="evaluation/preview_evaluation/<?= $evaluation['evaluation_id']?>">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Evaluation ?') && submit_form('#delete_evaluation<?= $evaluation['evaluation_id']?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                
                                                <form action="evaluation/delete_evaluation" method="POST" id="delete_evaluation<?= $evaluation['evaluation_id']?>">
                                                    <input type="hidden" id="evaluation_id" name="evaluation_id" value="<?= $evaluation['evaluation_id']?>" class="evaluation_id<?= $evaluation['evaluation_id']?>">
                                                </form>
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
<?php $this->load->view('layout/footer')?>
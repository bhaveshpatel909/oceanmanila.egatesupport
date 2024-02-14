<?php $this->load->view('layout/header', array('title' => $this->lang->line('Monthly Bill Payment'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE)) ?>
<style>
.row.wrapper.border-bottom.white-bg.page-heading {
    padding-bottom: 0px !important;
}
.filerby {
    float: right !important;
    top: -35px !important;
    position: relative;
}
.filerby .col-md-6 {
    top: -5px;
    position: relative;
}
.filerby .col-md-4 {
    top: -5px;
    position: relative;
}
span.txtfilter {
    top: -5px;
    position: relative;
}
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 50%;
    min-height: 30%;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
   
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    position: absolute;
    top: -17px;
right: -16px;
    font-size: 19px;
    line-height: 30px;
    width: 36px;
    height: 36px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 10px;
    
    display: inline-block;
    font-weight: bold;
}
.dataTables_wrapper td
{
	padding: 16px 6px !important;
}
.align-cen
{
	text-align:left;
}
.align-censs
{
	text-align:left;
}
.align-right
{
	text-align:right;
}
.align-censs-right
{
text-align:right;	
}
.align-cen a
{
	font-size:16px;
}
.popupdiv-new
{
padding: 17px;
}
.my-slect {
    position: unset;
    margin-left: 231px !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tbody tr.odd td:nth-child(4) {
    text-align: center !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tr.even td:nth-child(4) {
    text-align: center !IMPORTANT;
}
</style>
<script>
    $('document').ready(function () {
        $(".knob").knob();
        current_table = $('.data_table').dataTable({
            "order": [[5, "DESC"]],
            "columnDefs": [{
                    "targets": [1, 5],
                    "orderable": true
                }]
        });
		
		
		 current_tableb = $('.gb').dataTable({
            "order": [[5, "DESC"]],
			"autoWidth": false,
			"ordering": false,
			"columnDefs": [{
                    "targets": [1, 5],
                    "orderable": true
                }]
        });
		
		
			 $('#bank_accnt_n').on('change', function() {
            var item_roww = $(this).val();
             var option = $('option:selected', this).attr('data-bank_id');
			 $.ajax({
                url:'checkwriter/getlistaccount/',
				type: 'GET',
                data: {accountno: option},
                success:function(html){
					//console.log(html);
					var  strr= html.split("$$");
					//alert(strr[0]);
					//alert(strr[1]);
					//alert(strr[2]);
					//alert(strr[0].toLocaleString());
                    $('#expp').html(strr[0]);
                    $('#depp').html(strr[1]);
                    $('#ball').html(strr[2]);
					var options = {aSep: ',', aDec: '.', aSign: '₱ ', mDec: 0};
					$('.autoNumeric').autoNumeric('init', options);
                }
            });
            //alert(item_roww);
			 current_table.fnFilter(item_roww,9);
        });
   
 $('#request_category_id').change( function() { 
        current_table.fnFilter( $(this).val() ,1); 
		//	alert(gbbg);
			
       });	
	   

  
	
	
	$('.popupcl').click( function() { 
    current_tableb.fnFilter( $(this).html() ,1); 
			//alert('dcdcd');
       });	
	   

    });
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'monthly_bill_payment')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?= $this->lang->line('Monthly Bill Payment') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Monthly Bill Payment') ?>
                    </li>
                </ol>
				
				<div class="filerby" style="">
								<div class="my-slect">
								 <?php //echo "<pre>";
								//print_r($billlist);
								?>
								<div style="padding:0px; width: 10%;"class="col-md-2"><strong>Filter By:</strong></div>
							<div style="padding:0px;" class="col-md-6"> <select name="request_category_id" id="request_category_id"  style="" class="form-control required">
                            <option value="">view all</option>
                            <?php foreach ($billlist as $category) { ?>
                                <option  value="<?= $category['list_name'] ?>"><?= $category['list_name'] ?></option>
                            <?php } ?>
                        </select></div>
						
						<div class="col-md-4"><span ><span class="txtfilter">View Bill For Payment</span> <input type="checkbox" <?php if($_GET['xy']==1){ echo 'checked';} ?> name="viewbillpayment" id="viewbillpayment" value="<?php if($_GET['xy']==1){ echo '0'; } else { echo '1'; } ?>" style="zoom: 1.5;"></span></div>
				</div>
				</div>
            </div>
			
            <div class="col-lg-2">
                <div class="title-action">
                    <a href="monthlybillpayment/monthlybillpayment_new" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
						<!--div class ="searchyfilter">
						<label>Filter by Pay to</label>
						<?php
						// echo "<pre>";
						//print_r($bankaccountlist);
						?>
						<select name="bankaccount" id="bank_accnt_n">
						<option value="">Choose Account Number</option-->
						<?php
						?>
						</select>
						<!--input type="button" id="filter_bankaccnt" value= "Go"></button-->
						<!--/div-->
                            <div id="save_result"></div>
							
							<?php $tab = $_GET['xy']; 

    if($tab==1){
		
		
           	// echo $expense;
										  // echo '<pre>';
										  // print_r($petty_cash['attachments2']);
										  // echo '</pre>';
							?>
							
                            <table class="table table-striped table-bordered table-hover data_table o0-22" >
							
                                <thead class="new-accountno">
                                    <tr>
                                        <th width="8%"><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Pay to.') ?></th>
                                       <th ><?= $this->lang->line('Bill No.') ?></th>
                                        <th style="text-align:center;" class="new-accountno"><?= $this->lang->line('Amount') ?></th>
                                        <th style="text-align:center;" class="align-right"><?= $this->lang->line('Payment Status') ?></th>
                                        <th><?= $this->lang->line('Billing Period') ?></th>
                                        
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
								
                                <tbody>
                                    <?php
                                   
									// echo "<pre>";
									// print_R($monthlybillpayment_list);
                                
										// if ($petty_cash['check_cash_type'] == 'expense') {
                                            // $petty_cash['expense'] = $petty_cash['total'];
                                            // $petty_cash['deposit'] = 0;
                                            // $expense += $petty_cash['total'];
                                            // $balance = $balance - $petty_cash['total'];
                                        // } else {
                                            // $petty_cash['expense'] = 0;
                                            // $petty_cash['deposit'] = $petty_cash['total'];
                                            // $deposit += $petty_cash['total'];
                                            // $balance = $balance + $petty_cash['total'];
                                        // }
										echo $expense;
										  echo '<pre>';
										  print_r($petty_cash['attachments2']);
										  echo '</pre>';
                                        ?>
										<?php 
                                $expense = $deposit = $balance = 0;

							foreach ($monthlybillpayment_list['data'] as $petty_cash) {

							
							if(empty($petty_cash['attachments2'])) {  ?>
                                        <tr entity_id="<?= $petty_cash['bill_id'] ?>">
                                            <td><?= $petty_cash['bill_date'] ?></td>
                                            <td class="align-cen"><a class="trigger_popup_fricc popupcl"><?= $petty_cash['banklist']; ?></a></td>
                                            <td><?php foreach($petty_cash['attachments'] as $attachment)
											{
												?><a class='btn btn-outline btn-primary btn-xs' target='_blank' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><?= $petty_cash['bill_no'] ?></td>
									
											<td class="align-right">
                                                <?php foreach($petty_cash['attachments2'] as $attachment2)
											{
												?><a class='btn btn-outline btn-primary btn-xs' target='_blank' href="<?php echo base_url('files/attachments/' . $attachment2['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><span class=""><?= $petty_cash['amount'] ?></span>
                                            </td>
											<td style="text-align:center;">
											<span class="" style ="color:red; text-align:right;"><?php 
													$paid_status =$petty_cash['paid_status'];
														if($paid_status==1)
														{
															echo "Paid";
														}
														
														?></span>
											</td>
										
                                            <td>
                                                <span class=""><?= $petty_cash['billing_period'] ?></span>
                                            </td>
                                            <td class="ghghghg" style="width: 105px;">
                                                
												 <!--a href="checkwriter/printcheck/<?= $petty_cash['bill_id'] ?>" >
                                                        <img src="http://wshrms.peza.com.ph/images/if_print_172530.png">
                                                    </a-->
                                                    <a class="btn btn-outline btn-success btn-xs" href="monthlybillpayment/edit_monthlybillpayment/<?= $petty_cash['bill_id'] ?>" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-danger btn-xs"  onclick="confirm('Delete Bill Entry ?') && submit_form('#delete_petty_cash<?= $petty_cash['bill_id'] ?>', '#save_result')" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
													<?php
													// echo '<pre>';
													// print_r($petty_cash);
													// echo '</pre>';
													// die('dfcf');
													
													
													
													?>
													
											
                                                <form action="monthlybillpayment/delete_monthlybillpayment" method="POST" id="delete_petty_cash<?= $petty_cash['bill_id'] ?>">
                                                    <input type="hidden" id="bill_id" name="bill_id" value="<?= $petty_cash['bill_id'] ?>" class="checkwriter_id<?= $petty_cash['bill_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>                                    
                                   	 <?php 
							}  
	}	?>
                                </tbody>
								
                                <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                <th></th>
                                </tfoot>
							
                            </table>
							
							
							<?php 
							 
	}	?>
	
	<?php if($tab==null){   ?>
							
							             <table  class="table table-striped table-bordered table-hover data_table" >
							
                                <thead>
                                    <tr>
                                        <th width="8%"><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Pay to.') ?></th>
                                       <th><?= $this->lang->line('Bill No.') ?></th>
                                        <th style="text-align:center;" class=" new-accountno"><?= $this->lang->line('Amount') ?></th>
                                        <th style="text-align:center;" class="align-right"><?= $this->lang->line('Payment Status') ?></th>
                                        <th><?= $this->lang->line('Billing Period') ?></th>
                                        
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $expense = $deposit = $balance = 0;
									// echo "<pre>";
									// print_R($monthlybillpayment_list);
                                    foreach ($monthlybillpayment_list['data'] as $petty_cash) {
										// if ($petty_cash['check_cash_type'] == 'expense') {
                                            // $petty_cash['expense'] = $petty_cash['total'];
                                            // $petty_cash['deposit'] = 0;
                                            // $expense += $petty_cash['total'];
                                            // $balance = $balance - $petty_cash['total'];
                                        // } else {
                                            // $petty_cash['expense'] = 0;
                                            // $petty_cash['deposit'] = $petty_cash['total'];
                                            // $deposit += $petty_cash['total'];
                                            // $balance = $balance + $petty_cash['total'];
                                        // }
										//echo $expense;
										  // echo '<pre>';
										  // print_r($petty_cash['attachments2']);
										  // echo '</pre>';
                                        ?>
                                        <tr entity_id="<?= $petty_cash['bill_id'] ?>">
                                            <td><?= $petty_cash['bill_date'] ?></td>
                                            <td class="align-cen"><a class="trigger_popup_fricc popupcl"><?= $petty_cash['banklist']; ?></a></td>
                                            <td><?php foreach($petty_cash['attachments'] as $attachment)
											{
												?><a class='btn btn-outline btn-primary btn-xs' target='_blank' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><?= $petty_cash['bill_no'] ?></td>
                                            
											<td class="align-right">
                                                <?php foreach($petty_cash['attachments2'] as $attachment2)
											{
												?><a class='btn btn-outline btn-primary btn-xs' target='_blank' href="<?php echo base_url('files/attachments/' . $attachment2['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><span class=""><?= $petty_cash['amount'] ?></span>
                                            </td>
                                           
                                            <td style="text-align:center;">
                                                <span class="" style ="color:red;text-align:right;"><?php 
													$paid_status =$petty_cash['Payment Status'];
														if($paid_status==1)
														{
															echo "Paid";
														}
														
														?></span>
														
														
                                            </td>
											<td>
                                                <span class=""><?= $petty_cash['billing_period'] ?></span>
                                            </td>
                                            <td class="ghghghg" style="width: 105px;">
                                                
												 <!--a href="checkwriter/printcheck/<?= $petty_cash['bill_id'] ?>" >
                                                        <img src="http://wshrms.peza.com.ph/images/if_print_172530.png">
                                                    </a-->
                                                    <a class="btn btn-outline btn-success btn-xs" href="monthlybillpayment/edit_monthlybillpayment/<?= $petty_cash['bill_id'] ?>" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Bill Entry ?') && submit_form('#delete_petty_cash<?= $petty_cash['bill_id'] ?>', '#save_result')" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
													<?php
													// echo '<pre>';
													// print_r($petty_cash);
													// echo '</pre>';
													// die('dfcf');
													
													
													
													?>
													
											
                                                <form action="monthlybillpayment/delete_monthlybillpayment" method="POST" id="delete_petty_cash<?= $petty_cash['bill_id'] ?>">
                                                    <input type="hidden" id="bill_id" name="bill_id" value="<?= $petty_cash['bill_id'] ?>" class="checkwriter_id<?= $petty_cash['bill_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>                                    
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                <th></th>
                                </tfoot>
                            </table>
							
	<?php } ?>
							
                        </div>
                    </div>
                </div>
            </div>        
        </div>
		
<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
	<div class="popupdiv-new">
        <div class="popupCloseButton">X</div>
		
											
                                     <table  class="table table-striped table-bordered table-hover gb" >
							
                                <thead>
                                    <tr>
                                        <th  width="20%"><?= $this->lang->line('Date') ?></th>
                                        <th  width="20%"><?= $this->lang->line('Pay to.') ?></th>
                                       <th  width="20%"><?= $this->lang->line('Bill No.') ?></th>
                                        <th class="align-censs-right new-accountno"><?= $this->lang->line('Amount') ?></th>
                                        <th style="text-align:center;" class="align-censs-right"><?= $this->lang->line('Payment Status') ?></th>
                                        <th><?= $this->lang->line('Billing Period') ?></th>
                                        
                                      <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $expense = $deposit = $balance = 0;
									// echo "<pre>";
									// print_R($monthlybillpayment_list);
                                    foreach ($monthlybillpayment_list['data'] as $petty_cash) {
										// if ($petty_cash['check_cash_type'] == 'expense') {
                                            // $petty_cash['expense'] = $petty_cash['total'];
                                            // $petty_cash['deposit'] = 0;
                                            // $expense += $petty_cash['total'];
                                            // $balance = $balance - $petty_cash['total'];
                                        // } else {
                                            // $petty_cash['expense'] = 0;
                                            // $petty_cash['deposit'] = $petty_cash['total'];
                                            // $deposit += $petty_cash['total'];
                                            // $balance = $balance + $petty_cash['total'];
                                        // }
										//echo $expense;
										  // echo '<pre>';
										  // print_r($petty_cash['attachments2']);
										  // echo '</pre>';
                                        ?>
                                        <tr entity_id="<?= $petty_cash['bill_id']; ?>">
                                            <td class="align-censs"><?= $petty_cash['bill_date'] ?></td>
                                            <td class="align-censs"><a class="trigger_popup_fricc popupcl"><?= $petty_cash['banklist']; ?></a></td>
                                            <td class="align-censs"><?php foreach($petty_cash['attachments'] as $attachment)
											{
												?><a class='btn btn-outline btn-primary btn-xs'  href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><?= $petty_cash['bill_no'] ?></td>
                                            
											<td class="align-censs-right">
                                                <?php foreach($petty_cash['attachments2'] as $attachment2)
											{
												?><a class='btn btn-outline btn-primary btn-xs' href="<?php echo base_url('files/attachments/' . $attachment2['location']) ?>" > <i class="fa fa-file-pdf-o"></i></a>
											<?php }
											?><span class=""><?= $petty_cash['amount'] ?></span>
                                            </td>
                                           
                                            <td style="text-align:center;" class="align-censs">
                                                <span class="" style ="color:red;text-align:right;"><?php 
													$paid_status =$petty_cash['Payment Status'];
														if($paid_status==1)
														{
															echo "Paid";
														}
														
														
														
														?></span>
                                            </td><td class="align-censs">
                                                <span class=""><?= $petty_cash['billing_period'] ?></span>
                                            </td>
                                            <td></td>
                                        </tr>                                    
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                <th></th>
                                </tfoot>
                            </table>
									</div>
    </div>
</div>
		
		
		
    </div>
</div>

<style>

</style>
<script>

$(window).load(function () {
    $(".trigger_popup_fricc").click(function(){
       $('.hover_bkgr_fricc').show();
    });
    $('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});

</script>




<?php
$this->load->view('layout/footer')?>


<style>
.ghghghg {    padding-top:0px !important;}
.ghghghg input{     min-width: 18px;
    min-height: 22px;
    display: inline-block;
    position: relative;
    top: 10px;}
	
	.filerby {
    float: left !important;
    top: -35px !important;
    position: relative !important;
    margin-left: 15% !important;
}
</style>
<script>

	$('document').ready(function () {
$('#viewbillpayment').click( function(e) { 
		var letter = $(this).val();
		//alert(letter);
		if(letter=='1')
		{
		
				window.location.href="<?php echo base_url();?>monthlybillpayment/index?xy="+letter;
		}
		else{
			window.location.href="<?php echo base_url();?>monthlybillpayment/index";
		
		}
	
	//	alert(letter);
	});
	
	
	
	
	// $(".gbp").click(function(){

	// $('#fall').removeClass('current');
	 // $('.gbp').addClass('current');
	  
 // });
	});
</script>

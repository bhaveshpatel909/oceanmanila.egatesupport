<?php $this->load->view('layout/header', array('title' => $this->lang->line('Bill Payment - Edit'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<script>
    $('document').ready(function () {        
        $('.datetimepicker').datetimepicker({pickTime: false});
//        $("#petty_item_id").select2({
//            placeholder: "Select Petty Cash Item",
//            allowClear: true
//        });
       
        $("#bank_name").change(function () {
			//alert("fdsvbdf");
       // var acntno = $(this).attr('data-account_no');
		var option = $('option:selected', this).attr('data-account_no');
		//alert(option)
        $('#bank_account_no').val(option);
    });
	$('#add_item').click(function () {
            var item_row = '<?= $item_row ?>';
            $('#petty_items tbody').append(item_row);
        }); 
		$('#petty_items tbody').on('keyup','.item-amount', function() {
            var total = 0;
            $('.item-amount').each(function() {
                total += parseInt($(this).val());
            });
            //var options = {aSep: ',', aDec: '.', aSign: '', mDec: 0};
            $('#total_amount').autoNumeric('set', total);
        });
        var options = {aSep: ',', aDec: '.', aSign: '₱ ', mDec: 0};
            $('#total_amount').autoNumeric('init', options);
      
    });
</script>
<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'monthly_bill_payment')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit Bill Payment') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Edit Bill Payment') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="monthlybillpayment/index">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Back') ?>
                    </a>
                    <button class="btn btn-primary" onclick="submit_form('#save_petty_cash')">
                        <i class="fa fa-floppy-o"></i>
                        <?= $this->lang->line('Save') ?>
                    </button>
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
                            <div class="col-lg-12">
                                <form action="monthlybillpayment/save_monthlybillpayment"  enctype="multipart/form-data"  method="POST" id="save_petty_cash">
								<?php 
								//echo "<pre>";
							//print_r($checkwriterlist);
								?>
                                    <input type="hidden" id="bill_id" name="bill_id" value="<?=$checkwriterlist['bill_id']?>" class="checkwriter_id">
                                    <div class="form-group has-feedback  col-md-5 no-padding">
                                        <label for="created_date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="created_date" id="created_date" value="<?php echo $checkwriterlist['bill_date']?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div> 
																			
									<div class="clearfix"></div>
        		                   <div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="bank_name" class="control-label"><?= $this->lang->line('Payto') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="payto" name="payto" class="form-control required">
										<option value="">Choose Bank From list</option>
                                            <?php foreach($banklist as $blist)

											{
												?>
												<option value="<?php echo $blist['billlist_id'];?>"  <?php if($checkwriterlist['payto']==$blist['billlist_id']){echo "selected=selected";};?>><?php echo $blist['list_name'];?></option>
												<?php
											}
											?>
											
                                        </select>
                                    </div>
									<div class="clearfix"></div>
									 <div class="form-group has-feedback col-lg-5 no-padding">
									 <label for="employee_id" class="control-label"><?= $this->lang->line('Bill No'); ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="bill_no" id="bill_no" class="form-control"   value= "<?php echo $checkwriterlist['bill_no'];?>">
									 </div>
									 <div class="form-group  col-lg-5" >
										<label for="Form_File" class="control-label"><?= $this->lang->line('Bill Attachment') ?></label>
										<?php $this->load->view('mix/attachments_list')?>
									</div>
									  <div class="clearfix"></div>
                                
                                  
									<div class="form-group col-lg-5 no-padding">
                                      
										<label for="expense" class="control-label"><?= $this->lang->line('Amount') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="amount" id="amount" class="form-control required" value="<?php echo $checkwriterlist['amount'];?>">
										
										
                                    </div>
									<div class="form-group  col-lg-5" >
										<label for="Form_File" class="control-label"><?= $this->lang->line('Payment Attachment') ?></label>
										<?php $this->load->view('mix/attachments_list2') ?>
									</div>
									
									<div class="clearfix"></div>
									 <div class="form-group col-lg-5 no-padding" id="employee_id_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Description') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="billing_period" id="billing_period" class="form-control" value="<?php echo $checkwriterlist['billing_period'];?>">
                                    </div>
									<div class="form-group" id="paidid_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Paid') ?><sup class="mandatory"></sup></label>
                                        <input type="checkbox" name="paid_status" id="paid_status" class="form-control" value="1">
                                    </div>
									
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('layout/footer') ?>

<?php $this->load->view('layout/header', array('title' => $this->lang->line('Monthly Bill Payment - Add new'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>

<script>
    $('document').ready(function () {
		function validate()
            {
             
                var pattern = document.getElementById("pattern").value;
                var patcheck = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
              
                
				 if(pattern==="")
                {
					document.getElementById("div4").style.color="Red";
				}
               else if(!patcheck.test(pattern))
                {
                    document.getElementById("div4").innerHTML="Only Alphabets/Numbers";
                    document.getElementById("div4").style.color="Red";
                }
                else
                {
                    document.getElementById("div4").innerHTML="";
                }
            }

        $('.datetimepicker').datetimepicker({pickTime: false});
//        $("#petty_item_id").select2({
//            placeholder: "Select Petty Cash Item",
//            allowClear: true
//      
          // $('#employee_id').magicSuggest({
            // allowFreeEntries: false,
            // data: 'petty/find_employee',
            // maxSelection: 1
        // });
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

<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'monthly_bill_payment')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Create New Payment') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Create New Payment') ?>
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
                                <form action="monthlybillpayment/save_monthlybillpayment"   method="POST" id="save_petty_cash">
                                    <input type="hidden" id="bill_id" name="bill_id" value="0" class="bill_id">
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="created_date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="created_date" id="created_date" value="<?php echo date('Y-m-d')?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div> 
									<div class="clearfix"></div>
									
									<div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="bank_name" class="control-label"><?= $this->lang->line('Pay To') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="payto" name="payto" class="form-control required">
										<option value="">Choose Payto From list</option>
                                            <?php foreach($banklist as $blist)

											{
												?>
												<option value="<?php echo $blist['billlist_id'];?>" ><?php echo $blist['list_name'];?></option>
												<?php
											}
											?>
											
                                        </select>
                                    </div>
									 
									  <div class="clearfix"></div>
                                    <div class="form-group col-lg-5 no-padding">
                                      
										<label for="" class="control-label"><?= $this->lang->line('Bill No.') ?></label>
                                        <input type="text" name="bill_no" value="" id="bill_no" class="form-control" >
										
										
                                    </div>
									<div class="form-group  col-lg-5" >
										<label for="Form_File" class="control-label"><?= $this->lang->line('Bill Attachment') ?></label>
										<?php $this->load->view('mix/attachments_list', array('attachments' => array())) ?>
									</div>									
								
                                   <div class="clearfix"></div>
									<div class="form-group col-lg-5 no-padding">
                                      
										<label for="expense" class="control-label"><?= $this->lang->line('Amount') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="amount" id="amount" class="form-control required">
										
										
                                    </div>
									<div class="form-group  col-lg-5" >
										<label for="Form_File" class="control-label"><?= $this->lang->line('Payment Attachment') ?></label>
										<?php $this->load->view('mix/attachments_list2', array('attachments2' => array())) ?>
									</div>
									
									<div class="clearfix"></div>
									 <div class="form-group no-padding col-lg-5" id="employee_id_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Billing Period') ?><sup class="mandatory"></sup></label>
                                       <input type="text" name="billing_period" id="amount"onblur="validate()" class="form-control pattern">
									    <div id="div4"></div>
                                    </div>
									<div class="clearfix"></div>
							
         <script>
             

                 
            function validate()
            {
             
                var pattern = document.getElementsByClassName("pattern").value;
                var patcheck = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
              
                 if (patcheck.length != 20) {
    alert("Please enter valid format")
  }
				 if(pattern==="")
                {
					document.getElementById("div4").style.color="Red";
				}
               else if(!patcheck.test(pattern))
                {
                    document.getElementById("div4").innerHTML="<p style='font-weight:bold;'>yyyy-mm-dd ~ yyyy-mm-dd</p>";
                    document.getElementById("div4").style.color="Red";
                }
                else
                {
                    document.getElementById("div4").innerHTML="";
                }
            }
        </script> 
                                    
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

<?php $this->load->view('layout/header', array('title' => $this->lang->line('Check - Edit'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
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
    <?php $this->load->view('layout/menu', array('active_menu' => 'check_writer')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit Check') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Petty Cash') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a class="btn btn-warning" href="checkwriter/index">
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
                                <form action="checkwriter/save_checkwriter"  enctype="multipart/form-data"  method="POST" id="save_petty_cash">
								<?php 
								//echo "<pre>";
							//print_r($checkwriterlist);
								?>
                                    <input type="hidden" id="checkwriter_id" name="checkwriter_id" value="<?=$checkwriterlist['checkwriter_id']?>" class="checkwriter_id">
                                    <div class="form-group has-feedback  col-md-5 no-padding">
                                        <label for="created_date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="created_date" id="created_date" value="<?php echo $checkwriterlist['check_date']?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div> 
										<div class="form-group has-feedback col-lg-7">
                                        <label for="petty_cash_type" class="control-label"><?= $this->lang->line('Petty Cash Type') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="petty_cash_type" name="petty_cash_type" class="form-control required">
                                            <option value="">Select Type</option>
                                            <option <?php echo ($checkwriterlist['check_cash_type'] == 'expense')? 'selected' : '' ?> value="expense">Expense</option>
                                            <option <?php echo ($checkwriterlist['check_cash_type'] == 'deposit')? 'selected' : '' ?> value="deposit">Deposit</option>                                               
                                        </select>
                                    </div>									
									<div class="clearfix"></div>
        		                   <div class="form-group has-feedback col-lg-5 no-padding">
                                        <label for="bank_name" class="control-label"><?= $this->lang->line('Bank Name') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="bank_name" name="bank_name" class="form-control required">
										<option value="">Choose Bank From list</option>
                                            <?php foreach($banklist as $blist)

											{
												?>
												<option value="<?php echo $blist['bank_id'];?>" data-account_no= <?php echo $blist['bank_acount_no'];?> <?php if($checkwriterlist['bankname']==$blist['bank_id']){echo "selected=selected";};?>><?php echo $blist['bank_name'];?></option>
												<?php
											}
											?>
											
                                        </select>
                                    </div>
									 <div class="form-group has-feedback col-lg-4">
									 <label for="employee_id" class="control-label"><?= $this->lang->line('Bank Account No'); ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="bank_account_no" id="bank_account_no" class="form-control"   value= "<?php echo $checkwriterlist['account_no'];?>"readonly>
									 </div>
									  <div class="clearfix"></div>
                                    <div class="form-group col-lg-5 no-padding">
                                      
										<label for="" class="control-label"><?= $this->lang->line('Check No') ?></label>
                                        <input type="text" name="ca_no" value="<?php echo $checkwriterlist['check_no'];?>" id="ca_no" class="form-control" >
										
										
                                    </div> 
									<div class="form-group col-lg-4" id="employee_id_area">
                                      
										<label for="employee_id" class="control-label"><?= $this->lang->line('Pay To/Form') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="payto" id="employee_id" class="form-control required" value="<?php echo $checkwriterlist['check_pay_to'];?>">
										
										
                                    </div>
                                   <div class="clearfix"></div>
									<div class="form-group col-lg-5 no-padding">
                                      
										<label for="expense" class="control-label"><?= $this->lang->line('Amount') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="expense" id="expense" class="form-control required" value="<?php echo $checkwriterlist['amount'];?>">
										
										
                                    </div>
									
									<div class="clearfix"></div>
									 <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Description') ?><sup class="mandatory"></sup></label>
                                        <textarea name="description" id="description" class="form-control "><?php echo $checkwriterlist['description'];?></textarea>
                                    </div>
									
                                    
									<div class="clearfix"></div>
									<!--table id="petty_items" class="table table-striped table-bordered table-hover" >
                                        <thead>                                            
                                            <tr>
                                                <th><?= $this->lang->line('Item') ?></th>
                                                <th><?= $this->lang->line('Description') ?></th>
                                                <th><?= $this->lang->line('Amount') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total_amount = 0;
                                            foreach($checkwriterlist['details'] as $petty_details) { 
                                                $total_amount += $petty_details['amount'];
                                                ?>
                                            <tr>
                                                <td width="30%">
                                                    <select name="petty_item_id[]" id="petty_item_id[]" class="form-control required">
                                                        <option value=""></option>
                                                        <?php foreach ($petty_items as $petty_item) { ?>
                                                            <option <?php echo ($petty_details['check_item_id'] == $petty_item['id']) ? 'selected' : ''?> value="<?= $petty_item['id'] ?>"><?= $petty_item['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><textarea name="item_description[]" id="description" class="form-control"><?=$petty_details['description']?></textarea></td>
                                                <td width="18%">
                                                    <input type="text" name="amount[]" id="amount" value="<?=$petty_details['amount']?>" class="form-control required item-amount ">
                                                    <input type="hidden" name="petty_detail_id[]" id="petty_detail_id" value="<?=$petty_details['id']?>" class="form-control ">
                                                </td>
                                            </tr>
                                            <?php } ?>                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right"><?= $this->lang->line('Total') ?></th>
                                                <th><span id="total_amount" class="autoNumeric"><?=$total_amount?></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback">
                                        <button type="button" class="btn btn-primary" id="add_item">
                                            <i class="fa fa-plus-square"></i>
                                            <?= $this->lang->line('Add Item') ?>
                                        </button>
                                    </div>
                                    <div class="clearfix"></-->
									
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

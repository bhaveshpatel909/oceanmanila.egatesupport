<?php $this->load->view('layout/header', array('title' => $this->lang->line('Check Writer - Add new'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<script>
    $('document').ready(function () {
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
    <?php $this->load->view('layout/menu', array('active_menu' => 'check_writer')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Create New Check') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Check Writer') ?>
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
                                <form action="checkwriter/save_checkwriter"  method="POST" id="save_petty_cash">
                                    <input type="hidden" id="checkwriter_id" name="checkwriter_id" value="0" class="checkwriter_id">
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="created_date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="created_date" id="created_date" value="<?php echo date('Y-m-d')?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div> 
									 <div class="form-group has-feedback col-lg-7">
                                        <label for="petty_cash_type" class="control-label"><?= $this->lang->line('Petty Cash Type') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="petty_cash_type" name="petty_cash_type" class="form-control required">
                                            <option value="">Select Type</option>
                                            <option value="expense">Expense</option>
                                            <option value="deposit">Deposit</option>                                               
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
												<option value="<?php echo $blist['bank_id'];?>" data-account_no= <?php echo $blist['bank_acount_no'];?>><?php echo $blist['bank_name'];?></option>
												<?php
											}
											?>
											
                                        </select>
                                    </div>
									 <div class="form-group has-feedback col-lg-4">
									 <label for="employee_id" class="control-label"><?= $this->lang->line('Bank Account No'); ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="bank_account_no" id="bank_account_no" class="form-control" readonly>
									 </div>
									  <div class="clearfix"></div>
                                    <div class="form-group col-lg-5 no-padding">
                                      
										<label for="" class="control-label"><?= $this->lang->line('Check No') ?></label>
                                        <input type="text" name="ca_no" value="" id="ca_no" class="form-control" >
										
										
                                    </div> 
									<div class="form-group col-lg-4" id="employee_id_area">
                                      
										<label for="employee_id" class="control-label"><?= $this->lang->line('Pay To/Form') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="payto" id="employee_id" class="form-control required">
										
										
                                    </div>
                                   <div class="clearfix"></div>
									<div class="form-group col-lg-5 no-padding">
                                      
										<label for="expense" class="control-label"><?= $this->lang->line('Amount') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="expense" id="expense" class="form-control required">
										
										
                                    </div>
									
									<div class="clearfix"></div>
									 <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Description') ?><sup class="mandatory"></sup></label>
                                        <textarea name="description" id="description" class="form-control "></textarea>
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
                                            <tr>
                                                <td width="30%">
                                                    <select name="petty_item_id[]" id="petty_item_id[]" class="form-control required">
                                                        <option value=""></option>
                                                        <?php foreach ($petty_items as $petty_item) { ?>
                                                            <option value="<?= $petty_item['id'] ?>"><?= $petty_item['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><textarea name="item_description[]" id="description" class="form-control"></textarea></td>
                                                <td width="18%">
                                                    <input type="text" name="amount[]" id="amount" class="form-control required item-amount ">
                                                    <input type="hidden" name="petty_detail_id[]" value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right"><?= $this->lang->line('Total') ?></th>
                                                <th><span id="total_amount" class="autoNumeric"></span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback">
                                        <button type="button" class="btn btn-primary" id="add_item">
                                            <i class="fa fa-plus-square"></i>
                                            <?= $this->lang->line('Add Item') ?>
                                        </button>
                                    </div-->
									
                                   
                                    
                                   
                                    
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

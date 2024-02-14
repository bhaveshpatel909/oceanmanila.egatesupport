<?php $this->load->view('layout/header', array('title' => $this->lang->line('Petty Cash - Edit'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => TRUE)) ?>
<script>
    $('document').ready(function () {        
        $('.datetimepicker').datetimepicker({pickTime: false});
//        $("#petty_item_id").select2({
//            placeholder: "Select Petty Cash Item",
//            allowClear: true
//        });
        $('#employee_id').magicSuggest({
            allowFreeEntries: false,
            data: 'petty/find_employee',
            maxSelection: 1,
            <?php if($petty_cash['employee_id']) {?> value: [{"id":"<?= $petty_cash['employee_id']?>","name":"<?= $petty_cash['employee_name']?>"}]
            <?php } ?>
        });
        
        $('#add_item').click(function () {
            var item_row = '<?= $item_row ?>';
            $('#petty_items tbody').append(item_row);
        }); 
		$('.remove_attachment1').click(function () {
			//alert("dgfd");
           $('#fileuploadname').val('');
           $('#attachment_').hide();
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
    <?php $this->load->view('layout/menu', array('active_menu' => 'petty_cash')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit Petty Cash') ?></h2>
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
                    <a class="btn btn-warning" href="petty/index">
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
                                <form action="petty/save_petty_cash"  enctype="multipart/form-data"  method="POST" id="save_petty_cash">
								<?php 
								//echo "<pre>";
								//print_r($petty_cash);
								?>
                                    <input type="hidden" id="petty_cash_id" name="petty_cash_id" value="<?=$petty_cash['petty_cash_id']?>" class="petty_cash_id">
                                    <div class="form-group has-feedback  col-md-5 no-padding">
                                        <label for="created_date" class="control-label"><?= $this->lang->line('Date') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="created_date" id="created_date" value="<?php echo $petty_cash['created_date']?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                    </div>   
        		                  <div class="form-group has-feedback col-md-1">
                                 <label for="petty_cash_type" class="control-label"><?= $this->lang->line('Liquidated') ?></label>
        						 <div class="clearfix"></div>
                                 <input type="checkbox" style="width: 109px; height: 21px;" name="alertchk" <?php if($petty_cash['liquidated']==1)
        											{ ?>
												checked
												<?php
											}    ?> value="1">
                                          </div>
                   
									
                                         <div class="form-group has-feedback col-md-6">
                                        <label for="petty_cash_type" class="control-label"><?= $this->lang->line('File Attachment') ?></label>
                                        <div class="clearfix"></div>
                                      <div id="attachments_list">
									<div class="file m-b-xs">
									<div class="file-name">
                                <input type="file"  name="new_attachments" >
								<input type="hidden" name="fileuploadname"  id ="fileuploadname" value="<?php echo $petty_cash['file'];?>">
								<input type="hidden" name="fileuploadname23"  id ="fileuploadname23" value="<?php echo $petty_cash['file'];?>">
                                     </div>
                                       </div>
									   <?php if($petty_cash['file']!="")
									   {
										   ?>
									    <div class="file m-b-xs" id="attachment_<?= $attachment['attachment_id']?>">
											<?php if (!isset($readonly)){?>
											<button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment1" attachment_id="<?= $attachment['attachment_id']?>">
												<i class="fa fa-trash-o"></i>
											</button>
											<?php }?>
											<div class="file-name">
												<a href="<?php echo base_url('files')?>/petty/<?= $petty_cash['file'] ?>" target="_blank">
													<?php echo  $petty_cash['file'];?>
												</a>
											</div>
											
											<div class="clearfix"></div>
										</div>
										<?php 
									   } ?>
										
                                    </div>
                                    </div>										
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback  col-lg-5 no-padding">
                                        <label for="ca_no" class="control-label"><?= $this->lang->line('Petty cash vocher no.') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="ca_no" id="ca_no" value="<?=$petty_cash['ca_no']?>" class="form-control">
                                    </div>
                                    <div class="form-group has-feedback col-lg-7">
                                        <label for="petty_cash_type" class="control-label"><?= $this->lang->line('Petty Cash Type') ?><sup class="mandatory">*</sup></label>
                                        <div class="clearfix"></div>
                                        <select id="petty_cash_type" name="petty_cash_type" class="form-control required">
                                            <option value="">Select Type</option>
                                            <option <?php echo ($petty_cash['petty_cash_type'] == 'expense')? 'selected' : '' ?> value="expense">Expense</option>
                                            <option <?php echo ($petty_cash['petty_cash_type'] == 'deposit')? 'selected' : '' ?> value="deposit">Deposit</option>                                               
                                        </select>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="employee_id" class="control-label"><?= $this->lang->line('Employee') ?><sup class="mandatory"></sup></label>
                                        <input type="text" name="employee_id" id="employee_id" class="form-control required">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback" id="employee_id_area">
                                        <label for="description" class="control-label"><?= $this->lang->line('Description') ?><sup class="mandatory"></sup></label>
                                        <textarea name="description" id="description" class="form-control "><?=$petty_cash['description']?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                    <table id="petty_items" class="table table-striped table-bordered table-hover" >
                                        <thead>                                            
                                            <tr>
                                                <th><?= $this->lang->line('Item') ?></th>
                                                <th><?= $this->lang->line('Description') ?></th>
                                                <th><?= $this->lang->line('Company') ?></th>
                                                <th><?= $this->lang->line('TIN NO') ?></th>
                                                <th><?= $this->lang->line('Amount') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $total_amount = 0;
                                            foreach($petty_cash['details'] as $petty_details) { 
                                                $total_amount += $petty_details['amount'];
                                                ?>
                                            <tr>
                                                <td width="30%">
                                                    <select name="petty_item_id[]" id="petty_item_id[]" class="form-control required">
                                                        <option value=""></option>
                                                        <?php foreach ($petty_items as $petty_item) { ?>
                                                            <option <?php echo ($petty_details['petty_item_id'] == $petty_item['id']) ? 'selected' : ''?> value="<?= $petty_item['id'] ?>"><?= $petty_item['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><textarea name="item_description[]" id="description" class="form-control"><?=$petty_details['description']?></textarea></td>
                                                <td><input type="text" name="company[]" id="company" value="<?=$petty_details['company']?>" class="form-control item-amount "></td>
                                                <td><input type="text" name="tin[]" id="tin" value="<?=$petty_details['tin_no']?>" class="form-control  item-amount "></td>
                                                <td width="18%">
                                                    <input type="text" name="amount[]" id="amount" value="<?=$petty_details['amount']?>" class="form-control required item-amount ">
                                                    <input type="hidden" name="petty_detail_id[]" id="petty_detail_id" value="<?=$petty_details['id']?>" class="form-control ">
                                                </td>
                                            </tr>
                                            <?php } ?>                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
											 <th colspan="2" class="text-right"></th>
											 
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
                                    <div class="clearfix"></div>
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

<?php $this->load->view('layout/header', array('title' => $this->lang->line('Check Writer'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $(".knob").knob();
        current_table = $('.data_table').dataTable({
            "order": [[9, "DESC"]],
            "columnDefs": [{
                    "targets": [1, 7],
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
      //  var options = {aSep: ',', aDec: '.', aSign: '₱ ', mDec: 0};
      //  $('.autoNumeric').autoNumeric('init', options);
    });
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'check_writer')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-2">
                <h2><?= $this->lang->line('Check Writer') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Check Writer') ?>
                    </li>
					
                </ol>
				
				
            </div>
			<div style="margin-top: 14px;" class="col-lg-9">
			<span class="paper-text" style='margin-left:10px;font-size:21px;color:red;'>Pls setup paper size option at printer as 2.95 inch x 8.07 inch and <br>&nbsp;&nbsp;Place Check Date in front direction when feeding check to printer</span>
			</div>
            <div style="float: right;"class="col-lg-1">
                <div class="title-action">
                    <a href="checkwriter/new_checkwriter" class="btn btn-primary">
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
						<div  class ="searchyfilter filter-1">
						<label style="height:35px;"></label>
						<?php
						// echo "<pre>";
						//print_r($bankaccountlist);
						?>
						<select name="bankaccount" id="bank_accnt_n">
						<option value="">Choose Account Number</option>
						<?php
						foreach($bankaccountlist as $accountlist)
						{
							?>
							<option value="<?php echo $accountlist['bank_acount_no'];?>" data-bank_id= "<?php echo $accountlist['bank_id'];?>"><?php echo  $accountlist["bank_name"].'-'.$accountlist['bank_acount_no']?></option>
							<?php
						}
						?>
						</select>
						<!--input type="button" id="filter_bankaccnt" value= "Go"></button-->
						</div>
                            <div id="save_result"></div>
                            <table class="table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
                                        <th width="8%"><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Check No.') ?></th>
                                        <th><?= $this->lang->line('Description') ?></th>
                                        <th><?= $this->lang->line('Pay to') ?></th>
                                        <th><?= $this->lang->line('Cash Type') ?></th>
                                        <th align="right"><?= $this->lang->line('Expense') ?></th>
                                        <th align="right"><?= $this->lang->line('Deposit') ?></th>
										<th align="right"><?= $this->lang->line('Balance') ?></th>
                                        <th align="right"><?= $this->lang->line('Bank Name') ?></th>
                                        <th align="right"><?= $this->lang->line('Account No') ?></th>
                                        <th width="12%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $expense = $deposit = $balance = 0;
									//echo "<pre>";
									//print_R($checkwriter_list);
                                    foreach ($checkwriter_list['data'] as $petty_cash) {
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
                                        ?>
                                        <tr entity_id="<?= $petty_cash['checkwriter_id'] ?>">
                                            <td><?= $petty_cash['check_date'] ?></td>
                                            <td><?= $petty_cash['check_no'] ?></td>
                                            <td>
                                               
                                                <?= $petty_cash['description'] ?>
                                            </td>
                                            <td><?= $petty_cash['check_pay_to'] ?></td>
                                            
											<td align="right">
                                                <span class=""><?= $petty_cash['check_cash_type'] ?></span>
                                            </td>
                                            <td align="right">
                                                <span class="autoNumeric"><?php if ($petty_cash['check_cash_type'] == 'expense') { echo $petty_cash['amount']; }?></span>
                                            </td>
                                            <td align="right">
                                                <span class="autoNumeric"><?php if ($petty_cash['check_cash_type'] == 'deposit') { echo $petty_cash['amount']; } ?></span>
                                            </td>
											 <td align="right"><span class="autoNumeric"></span></td>
                                            
                                            <td align="right">
                                                <span class=""><?= $petty_cash['banklist'] ?></span>
                                            </td>
                                            <td align="right">
                                                <span class=""><?= $petty_cash['account_no'] ?></span>
                                            </td>
                                            <td class="ghghghg" style="width: 105px;">
                                                
												 <a href="checkwriter/printcheck/<?= $petty_cash['checkwriter_id'] ?>" >
                                                        <img src="http://wshrms.peza.com.ph/images/if_print_172530.png">
                                                    </a>
                                                    <a class="btn btn-outline btn-success btn-xs" href="checkwriter/edit_checkwriter/<?= $petty_cash['checkwriter_id'] ?>" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Check Entry ?') && submit_form('#delete_petty_cash<?= $petty_cash['checkwriter_id'] ?>', '#save_result')" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
													<?php
													// echo '<pre>';
													// print_r($petty_cash);
													// echo '</pre>';
													// die('dfcf');
													
													
													
													?>
													
											
                                                <form action="checkwriter/delete_checkwriter" method="POST" id="delete_petty_cash<?= $petty_cash['checkwriter_id'] ?>">
                                                    <input type="hidden" id="checkwriter_id" name="checkwriter_id" value="<?= $petty_cash['checkwriter_id'] ?>" class="checkwriter_id<?= $petty_cash['checkwriter_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>                                    
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <th colspan="5"><?= $this->lang->line('Total') ?></th>
                                <td align="right"><span class="autoNumeric"  id= "expp" style="font-weight: 700;"><?= $expense ?></span></td>
                               <td align="right"><span class="autoNumeric"  id="depp"style="font-weight: 700;"><?= $deposit ?></span></td>
                                <td align="right"><span class="autoNumeric"  id="ball"style="font-weight: 700;"><?= $balance ?></span></td>
                                <th></th>
                                </tfoot>
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


<style>
.ghghghg {    padding-top:0px !important;}
.ghghghg input{     min-width: 18px;
    min-height: 22px;
    display: inline-block;
    position: relative;
    top: 10px;}
	
.searchyfilter.filter-1 {
    position: absolute;
    top: 3%;
    left: 30%;
    z-index: 99999;
}
.searchyfilter.filter-1 select#bank_accnt_n {
    height: 36px;
    border: 1px #e5e6e7 solid;
    /* margin-top: 10px !IMPORTANT; */
    border-radius: 4px;
}
tr.odd td:nth-child(11) {
    text-align: center;
}
tr.even td:nth-child(11) {
    text-align: center;
}

</style>


<?php $this->load->view('layout/header', array('title' => $this->lang->line('Lazada'), 'forms' => TRUE, 'tables' => TRUE, 'date_time' => TRUE, 'magicsuggest' => false)) ?>
<script>
    $(document).ready(function(){
		$('td.editable-col').on('focusout', function() {
			//alert('fbfht');
			data = {};
			data['val'] = $(this).text();
			data['id'] = $(this).parent('tr').attr('data-row-id');
			data['index'] = $(this).attr('col-index');
				if($(this).attr('oldVal') === data['val'])
					return false;
    
			$.ajax({   
          
				type: "POST",  
				url: "<?php echo base_url();?>reports/savedata", 
				cache:false,  
				data: data,
				dataType: "json",       
				success: function(response)  
				{   
            //$("#loading").hide();
					if(response.status) {
						$("#msg").removeClass('alert-danger');
						$("#msg").addClass('alert-success').html(response.msg);
					} else {
						$("#msg").removeClass('alert-success');
						$("#msg").addClass('alert-danger').html(response.msg);
					}
				}   
			});
		});
	});
</script>

<div id="wrapper">  
    <?php $this->load->view('layout/menu', array('active_menu' => 'lazada')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

		<?php
		if (isset($_GET['error1'])){
			echo'<div style="width:100%;padding:10px;font-size:18px;color:red;text-align:center">Please Select xlsx or xls File</div>' ;
		} ?>
		
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-5">
                <h2><?= $this->lang->line('Get record Xls to Pdf') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('lazada') ?>
                    </li>
                </ol>
            </div>
			<div class="col-lg-5">
				<form action="reports/ExcelDataAdd" method="post" enctype="multipart/form-data">
					<label for="Form_File" class="control-label">Please Select File First </label>
					<div style="clear both"></div>
					<div id="attachments_list" style="float:left;width:86%">
						<div class="file m-b-xs">
							<div class="file-name">
								<input multiple="multiple" name="userfile" id="userfile" type="file">
							</div>
						</div>
					</div> 
					<input type="submit" name="submit" value="Import" class="btn btn-warning" style="float:left">
				</form>
			</div>
            <div class="col-lg-2">
                <div class="title-action"style="text-align: left;padding-top: 24px;margin-left: -34px">
                    <a class="btn btn-warning" href="reports/pdfDatadelete">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Delete') ?>
                    </a>
                    
					<a class="btn btn-warning" href="reports/pdfDataAdd">
                        <i class="fa fa-arrow-left"></i>
                        <?= $this->lang->line('Pdf') ?>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="container" style="margin-top:50px;">
			<div class="col-md-10">
				<div class="table-responsive">
					<table id="employee_grid" class="table table-bordered table-hover table-striped bootgrid-table" width="100%">
						<thead>
							<tr>
								
								<th>Transaction Type</th>
								<th>Details</th>
								<th>Amount</th>
								<th>VAT in Amount</th>
								<th>WHT Amount</th>
								<th>WHT inc Amt</th>
								<th>Paid Status</th>
								<th>Order No</th>
							</tr>
						</thead>
						<tbody id="_editable_table">
					<?php 
					
					// echo'<pre>';
					// print_r($lazada);
					// echo'</pre>';
					// die('fgiru');
					
						foreach($lazada as $res) {?>
							<tr data-row-id="<?php echo $res['id'];?>">
								
								<td class="editable-col" contenteditable="true" col-index='Transaction_Type' oldVal ="<?php echo $res['Transaction_Type'];?>"><?php echo $res['Transaction_Type'];?></td>
								
								<td class="editable-col" contenteditable="true" col-index='Details' oldVal ="<?php echo $res['Details'];?>"><?php echo $res['Details'];?></td>
								
								<td class="editable-col" contenteditable="true" col-index='Amount' oldVal ="<?php echo number_format($res['Amount'], 2, '.', ',');?>"><?php echo number_format($res['Amount'], 2, '.', ',');?></td>
								
								<td class="editable-col" contenteditable="true" col-index='vat' oldVal ="<?php echo number_format($res['vat'], 2, '.', ',');?>"><?php echo number_format($res['vat'], 2, '.', ',');?></td>
								
								<td class="editable-col" contenteditable="true" col-index='wht_amount' oldVal ="<?php echo number_format($res['wht_amount'], 2, '.', ',');?>"><?php echo number_format($res['wht_amount'], 2, '.', ',');?></td>
								
								<td class="editable-col" contenteditable="true" col-index='wht_status' oldVal ="<?php echo $res['wht_status'];?>"><?php echo $res['wht_status'];?></td>
								
								<td class="editable-col" contenteditable="true" col-index='Status' oldVal ="<?php echo $res['Status'];?>"><?php echo $res['Status'];?></td>
								
								<td class="editable-col" contenteditable="true" col-index='Order_No' oldVal ="<?php echo $res['Order_No'];?>"><?php echo $res['Order_No'];?></td>
							</tr>
						<?php                          
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

    </div>
</div>
<?php
$this->load->view('layout/footer')?>

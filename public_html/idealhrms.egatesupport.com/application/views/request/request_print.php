<link href="css/pdfstyle.css" rel="stylesheet">
<style>


@page{ sheet-size: 80mm 150mm; }



</style>
<div class="pdf-wrapper">
   <div class="headding_wrap" style="width:100%;float:left; text-align:center;">
		<h1 style="text-transform:uppercase; font-size: 20px;"><?php echo "Request For Approval";?></h1>
		<p><strong>Date:</strong> <span style="font-size:14px;font-weight:bold;"><?php echo date($this->config->item('date_format_pdf'), strtotime($emp_request['uploaded'])) ?></p>
	
	</div>
	<div class="payment" style="width:100%;float:left;text-align:center;padding-top:0px;margin-top:12px;">
		<span style="font-size:18px;"><?php echo $emp_request['request_name'];?></span>
	</div>
	<div class="payment" style="width:100%;float:left;text-align:center;padding-top:0px;margin-top:11px;">
		<span>By.</span><span style="font-size:12px;"><?php echo $emp_request['name'];?></span>
	</div>
	<div class="payment" style="width:100%;float:left;padding-top:0px;margin-top:20px;text-align:center">
		<?php echo $emp_request['description'];?>
		<hr>
	</div>
	<div style="margin-top:10px;font-size:16px;forn-weight:bold;">Request:</div>
	<div><?php echo $emp_request['content'];?></div>
	<div style="margin-top:100px;text-align:center;width:100%" >
	
	<label style="text-align: center;">Approved By------------------</label>
	
	</div>
	
	
    
</div>
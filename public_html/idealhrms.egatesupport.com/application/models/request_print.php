<link href="css/pdfstyle.css" rel="stylesheet">
<style>


@page{ sheet-size: 80mm 150mm; }



</style>
<div class="pdf-wrapper">
   <div class="headding_wrap" style="width:100%;float:left;">
		<h1 style="text-transform:uppercase; font-size: 20px;"><?php echo "Request For Approval "; ?></h1>
		
	</div>
	<?php //echo "<pre>";
	//print_r($emp_request);
	
	
	?>
	<h3>Request Name:<?php echo $emp_request['request_name'];?></h3>
	<div>Description:<?php echo $emp_request['description'];?></div>
	
    
</div>
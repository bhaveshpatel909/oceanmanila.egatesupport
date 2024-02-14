<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">

 <div class="pdf-header" style="float:left; width:100%;">
        <span class="" style="display:inline-block;width: 15%;float:left">
            <img style="width: 150px; float:left;" class="" src="<?php echo base_url($logo) ?>">
        </span><h1 class="" style="padding-top:25;float:left; text-align:left;color:#ff0000; margin:0px 0px 0px 25px;font-weight:normal"><?= $this->lang->line('Job Report last 30 Days' ) ?></h1>
		
		 <div class="clearfix"> </div>
		 <div style="width:100%;float:right; text-align:right;">
		 <?php

	foreach($data as $dataa)
	{
	
	?>	<span>Employee Name:</span>
      <span style="width:100%; float:right; text-align:right; color:#ff0000;" class=""> <?php echo $dataa['employee_name'] ?></span> 
       
    </div>
    </div>

 
	
	

	<h4 style="color:#fff;background:grey;padding:5px;"><?= date($this->config->item('date_format_pdf'), strtotime($dataa['start'])) ?>-<?= $dataa['item_name'] ?></h4>
     <span><?= $dataa['remarks'] ?></span>
	 <?php if($dataa['remarks_admin'] != ''){?>
    </br> <span><label>Admin Message : </label><p style="color:red;font-weight:bolder;"><?= $dataa['remarks_admin'] ?></p></span>
	<?php
	 }	
	}
	?>
</div>
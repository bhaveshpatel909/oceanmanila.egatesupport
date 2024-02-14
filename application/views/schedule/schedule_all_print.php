<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('  Daily Schedule OF All Employee' ) ?></h1></div>
    </div>
	<?php
	// echo "<pre>";
	// print_r($data);
	foreach($data as $dataa)
	{
	
	?>	
	<h4 style="color:#fff;background:grey;padding:5px;"> <?php echo $dataa['employee_name'] ?>- <?= date($this->config->item('date_format_pdf'), strtotime($dataa['start'])) ?>-<?= $dataa['item_name'] ?></h4>
     <span><?= $dataa['remarks'] ?></span>
	 <?php if($dataa['remarks_admin'] != ''){?>
    </br> <span><label>Admin Message : </label><p style="color:red;font-weight:bolder;"><?= $dataa['remarks_admin'] ?></p></span>
	<?php
	 }	
	}
	?>
</div>
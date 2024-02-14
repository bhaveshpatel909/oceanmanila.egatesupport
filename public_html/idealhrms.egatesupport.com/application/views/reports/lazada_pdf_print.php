<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div style="float:left;width:99.5%;text-align:center;padding:5px;border:1px solid;font-size:18px;color:red">
			<span>Total:</span><span style="padding-left:5px"><?= number_format($grndtotl, 2, '.', ',') ?></span><?= str_repeat('&nbsp;', 5);?>
			<span>Deduction:</span><span style="padding-left:5px"><?= number_format($granddeduct, 2, '.', ',') ?></span><?= str_repeat('&nbsp;', 5);?>
			<span>Net:</span><span style="padding-left:5px"><?= number_format($grndblns, 2, '.', ',') ?></span>
            
        </div>
        <div class="clearfix"></div>
       
    </div>
    <div class="pdf-content">
	
	<div style="width:100%;text-align:center">
		<div style="width:14%;float:left;border:1px solid;"> <?= $this->lang->line('Order No.') ?></div>
		<div style="width:15%;float:left;border-right:1px solid;border-top:1px solid;height:20px;border-bottom:1px solid;"></div>
		<div style="width:50%;float:left;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;"> <?= $this->lang->line('Transaction Type') ?></div>
		<div style="width:19%;float:left;border-right:1px solid;border-top:1px solid;border-bottom:1px solid;"> <?= $this->lang->line('Total') ?></div>
	</div>
	 <?php
        foreach ($rows as $row) { ?>
		
	<div style="width:100%;">
		<div style="width:14%;float:left;border-right:1px solid;border-left:1px solid;border-bottom:1px solid;height:<?php if($row['tpnm'] < 3){ echo 21*3; }else{ echo 21*$row['tpnm']; } ?>px">
			<div style="padding-left:5px"><?= $row['order']?></div>
			<div style="text-align:right;color:red;padding-top:10px;padding-right:5px"><?= number_format($row['credit'], 2, '.', ',')?></div>
		</div>
		
		<div style="width:15%;float:left;border-right:1px solid;border-bottom:1px solid;height:<?php if($row['tpnm'] < 3){ echo 21*3; }else{ echo 21*$row['tpnm']; } ?>px">
			<div style="text-align:right;color:red;padding-right:5px"><?= number_format($row['totexp'], 2, '.', ',')?></div>
			<div style="text-align:right;color:blue;padding-right:5px"><?= number_format($row['blns'], 2, '.', ',')?></div>
		</div>
		
		<div style="width:50%;float:left;border-bottom:1px solid;border-right:1px solid;height:<?php if($row['tpnm'] < 3){ echo 21*3; }else{ echo 21*$row['tpnm']; } ?>px">
		<?php for($i=0; $i<$row['tpnm']; $i++) { ?>
			<div style="width:99%;border-bottom:1px solid;height:21px;padding-left:5px"> <?= $row['typenm'.$i]?></div>
		<?php } ?>
		</div>
		
		<div style="width:19%;float:left;border-bottom:1px solid;border-right:1px solid;height:<?php if($row['tpnm'] < 3){ echo 21*3; }else{ echo 21*$row['tpnm']; } ?>px">
		<?php for($i=0; $i<$row['tpnm']; $i++) { ?>
			<div style="width:98%;text-align:right;border-bottom:1px solid;padding-right:5px;height:21px;"> <?= number_format($row['typeamt'.$i], 2, '.', ',')?></div>
		<?php } ?>
		</div>
		
	</div>
	<div style="clear:both"></div>
	 <?php } ?>
    </div>
    
</div>

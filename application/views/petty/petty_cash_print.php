<link href="css/pdfstyle.css" rel="stylesheet">
<style>


@page{ sheet-size: 100mm 148mm; }



</style>
<div class="pdf-wrapper">
   <div class="headding_wrap" style="width:100%;float:left;text-align:center;">
   <?php  $total1 = 0;
        foreach($petty_cash['details'] as $detail1) {
            $total1 += $detail1['amount'];
		}
			?>
		<h1 style="text-transform:uppercase; font-size: 30px; text-align:center;"><?php echo "Petty Cash Request"; ?></h1>
		<h1 style="text-transform:uppercase; font-size: 25px;"><?php echo ($petty_cash['petty_cash_type'] == 'expense') ? 'EXPENSE' : 'DEPOSIT' ?>- <?php echo 'Php ' . number_format($total1);?></h1>
		<p><span style="font-size:20px;"><?php echo date($this->config->item('date_format_pdf'), strtotime($petty_cash['created_date'])) ?></span></p>
		<p><span style="font-size:20px;"><?php echo $petty_cash['ca_no']; ?></span></p>
		
		<!--p><?php echo $petty_cash['employee_name'] ?></p-->
	</div>
	<div class="headding_wrap" style="width:100%;float:left;display:block;margin-top:40px;text-align:center;">
		
		
		<!--span style="color:red; display:inline-block">By.</span-->
		<span style="font-size:24px;display:inline-block;">&nbsp;<?php echo $petty_cash['employee_name'] ?></span>
	</div>
	<div class="payment" style="width:100%;float:left;text-align:center;padding-top:0px;margin-top:10px;text-align:center;">
		<span style="font-size:16px;"><?php echo $petty_cash['description'] ?></span>
	</div>
	
	
    <table border="0" width="100%" align="center" style="margin-top: 20px;" cellpadding="3" >
        <tr>
           
            <td valign="top" class="line-height">Description</td>
            <td valign="top" class="line-height">AMT</td>
        </tr>
        <?php 
        $total = 0;
        foreach($petty_cash['details'] as $detail) {
            $total += $detail['amount'];
            ?>
        <tr>
			<td valign="top" class="line-height"><?=$detail['description']?></td>
            <td valign="top" class="line-height" style="text-align: right"><?php echo '₱ ' . number_format($detail['amount'])?></td>
        </tr>
        <?php } ?>
        <!--tr>
            <td  style="text-align: right" class="line-height" >Total</td>
            <td class="line-height" style="font-weight: 700;text-align: right"><?php echo '₱ ' . number_format($total)?></td-->
        </tr>
    </table>
	<div style="margin-top:20px;font-size:16px;forn-weight:bold;">Remarks:</div>
	<div style="margin-top:250px">
	<form>
	<div class ="top_filed" style="margin-bottom:10px;width:50%;float:left;">
	<label>Approved By</label>
	<div style="width:100%;height:20px;"></div>
	<label>Requidated By</label>
	</div>
	<div class=""style="margin-bottom:20px;width:50%;float:left;">
	<label>Recieved By</label>
	<div style="width:100%;height:20px;"></div>
	<label>Closed By</label>
	</div>
	
	</form>
	</div>
	<div style="margin-top:255px;">
	Notes: Please liquidated your petty cash as soon as possible.
	</div>
    
</div>
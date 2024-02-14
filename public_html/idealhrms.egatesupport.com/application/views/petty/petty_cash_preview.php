<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?php echo ($petty_cash['petty_cash_type'] == 'expense') ? 'EXPENSE' : 'DEPOSIT' ?></h1></div>
    </div>
    <div class="pdf-content">
        <p class="">
            <strong>Date:</strong> <?php echo date($this->config->item('date_format_pdf'), strtotime($petty_cash['created_date'])) ?> <br>
            <strong>Voucher No.:</strong> <?php echo $petty_cash['ca_no'] ?> <br>
            <strong>Name of employee:</strong> <?php echo $petty_cash['employee_name'] ?> <br>

        </p>
        <p><strong>Description:</strong><br>
            <?php echo $petty_cash['description'] ?></p>
    </div>
    <table border="0" width="100%" align="center" style="margin-top: 20px;" cellpadding="3">
        <tr>
            <td valign="top" class="line-height">Item</td>
            <td valign="top" class="line-height">Description</td>
            <td valign="top" class="line-height">Amount</td>
        </tr>
        <?php 
        $total = 0;
        foreach($petty_cash['details'] as $detail) {
            $total += $detail['amount'];
            ?>
        <tr>
            <td valign="top" class="line-height"><?=$detail['petty_item_name']?></td>
            <td valign="top" class="line-height"><?=$detail['description']?></td>
            <td valign="top" class="line-height" style="text-align: right"><?php echo '₱ ' . number_format($detail['amount'])?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2" style="text-align: right" class="line-height" >Total</td>
            <td class="line-height" style="font-weight: 700;text-align: right"><?php echo '₱ ' . number_format($total)?></td>
        </tr>
    </table>
    <pre>
        <?php //var_dump($petty_cash) ?>
    </pre>
</div>
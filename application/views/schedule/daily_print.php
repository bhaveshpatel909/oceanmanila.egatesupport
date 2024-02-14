<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('DAILY SCHEDULE') ?></h1></div>
    </div>
    <div class="pdf-content">
        <p class="">
            <strong>Date:</strong> <?php echo date($this->config->item('date_format_pdf'), strtotime($data[0]['schedule_date'])) ?> <br>   
        </p>
    </div>
    <table border="0" width="100%" align="center" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <td valign="top" class="line-height">Customer</td>
            <td valign="top" class="line-height">Item</td>
            <td valign="top" class="line-height">Remarks</td>
        </tr>
        <?php foreach ($data as $item) { ?>
            <tr>
                <td><?= $item['customer_name'] ?></td>
                <td><?= $item['item_name'] ?></td>
                <td width="50%"><?= $item['remarks'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
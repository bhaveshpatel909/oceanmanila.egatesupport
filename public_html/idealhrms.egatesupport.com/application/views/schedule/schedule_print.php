<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('SCHEDULE') ?></h1></div>
    </div>
    <table border="0" width="100%" align="center" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <td valign="top" class="line-height">Employee</td>
            <td><?= $data['employee_name'] ?></td>
        </tr>
        <tr>
            <td width="20%" valign="top" class="line-height">Date</td>
            <td><?= date($this->config->item('date_format_pdf'), strtotime($data['start_date'])) ?></td>
        </tr>
        <tr>
            <td valign="top" class="line-height">Item</td>
            <td><?= $data['item_name'] ?></td>
        </tr>
        <tr>
            <td valign="top" class="line-height">Customer</td>
            <td><?= $data['customer_name'] ?></td>
        </tr>
        <tr>
            <td valign="top" class="line-height">Remarks</td>
            <td><?= $data['remarks'] ?></td>
        </tr><tr>
            <td valign="top" class="line-height">Admin Remarks</td>
            <td><?= $data['remarks_admin'] ?></td>
        </tr><tr>
            <td valign="top" class="line-height">Employee Remarks</td>
            <td><?= $data['remarks_employe'] ?></td>
        </tr>
    </table>
</div>
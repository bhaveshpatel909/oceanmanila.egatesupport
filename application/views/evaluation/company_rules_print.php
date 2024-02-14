<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="clearfix"></div>
        <div><h1 class="title">TO DO AND NOT TO DO</h1></div>
    </div>
    <div class="pdf-content">
        <table border="0"  width="100%" align="center" style="border-color: #ccc;">
    <thead>
        <tr>
            <th><?= $this->lang->line('No.') ?></th>
            <th><?= $this->lang->line('Name') ?></th>
            <th><?= $this->lang->line('To do and Not to do') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($company_rules as $key => $company_rule) {
            ?>
            <tr>
                <td width="6%" style="text-align: center;"><?= ($key + 1)?></td>
                <td><?= $company_rule['name'] ?></td>
                <td><?= $company_rule['company_rules'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
    </div>
    
</div>
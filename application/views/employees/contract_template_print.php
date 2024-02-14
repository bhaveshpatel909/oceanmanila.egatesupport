<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="clearfix"></div>
        <div><h1 class="title">Contract Template List</h1></div>
    </div>
    <div class="pdf-content">
        <table border="0"  width="100%" align="center" style="border-color: #ccc;">
    <thead>
        <tr>
            <th><?= $this->lang->line('No.') ?></th>
            <th><?= $this->lang->line('Name') ?></th>
            <th><?= $this->lang->line('Content Template') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($contract_template as $key => $contract_temp) {
            ?>
            <tr>
                <td width="6%" style="text-align: center;"><?= ($key + 1)?></td>
                <td><?= $contract_temp['name'] ?></td>
                <td><?= $contract_temp['content'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
    </div>
    
</div>
<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('EMPLOYEE PERFORMANCE REPORT') ?></h1></div>
    </div>
    <p>From: <?php echo date($this->config->item('date_format_pdf'), strtotime($from)) ?> &nbsp; to: <?php echo date($this->config->item('date_format_pdf'), strtotime($to)) ?>
    </p>
    <table border="0" width="100%" cellpadding="5" class="table table-striped table-bordered table-hover data_table">
        <thead>
            <tr>
                <th><?= $this->lang->line('Employee') ?></th>
                <th><?= $this->lang->line('Date') ?></th>
                <th><?= $this->lang->line('Action taken') ?></th>
                <th><?= $this->lang->line('Reason') ?></th>
                <th><?= $this->lang->line('Score') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_score = 0;
            foreach ($data as $record) {
                $total_score += $record['score'];
                ?>
                <tr>
                    <td><?= $record['fullname'] ?></td>
                    <td><?= date($this->config->item('date_format_pdf'), strtotime($record['date'])) ?></td>
                    <td><?= $record['action_taken'] ?></td>
                    <td><?= $record['reason'] ?></td>
                    <td style="text-align: right"><?= $record['score'] ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" class="text-right text-danger" style="text-align: right;">Total Score</td>
                <td class="text-danger" style="text-align: right"><?= $total_score ?></td>
            </tr>
        </tbody>
    </table>
</div>
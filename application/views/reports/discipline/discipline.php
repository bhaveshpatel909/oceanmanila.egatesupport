<table class="table table-striped table-bordered table-hover data_table">
    <thead>
        <tr>
            <?php if (isset($data[0]['fullname'])) { ?>
                <th><?= $this->lang->line('Employee') ?></th>
            <?php } ?>
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
                <?php if (isset($record['fullname'])) { ?>
                    <td>
                        <?= $record['fullname'] ?>
                    </td>
                <?php } ?>
                <td><?= date($this->config->item('date_format_pdf'), strtotime($record['date'])) ?></td>
                <td><?= $record['action_taken'] ?></td>
                <td><?= $record['reason'] ?></td>
                <td><?= $record['score'] ?></td>
            </tr>
        <?php } ?>
        <tr>
            <?php if (isset($record['fullname'])) { ?>
                    <td>
                        
                    </td>
                <?php } ?>
            <td colspan="3" class="text-right text-danger">Total Score</td>
            <td class="text-danger"><?= $total_score ?></td>
        </tr>
    </tbody>
</table>
<form target="_blank" action="reports/print_report" method="POST" id="print_report">
    <div class="clearfix m-t-lg"></div>
    <button class="btn btn-primary pull-right" type="submit">
        <i class="fa fa-file-pdf-o"></i>
        <?= $this->lang->line('Print results') ?>
    </button>
    <input type="hidden" name="jsondata" id="jsondata" value='<?= $postdata ?>' />
</form>
<div class="clearfix m-t-lg"></div>
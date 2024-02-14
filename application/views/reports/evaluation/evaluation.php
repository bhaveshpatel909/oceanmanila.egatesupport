<table class="table table-striped table-bordered table-hover data_table">
    <thead>
        <tr>
            <th><?= $this->lang->line('Date') ?></th>
            <!--<th><?= $this->lang->line('Action taken') ?></th>-->
            <th><?= $this->lang->line('Evaluation Name') ?></th>
            <th><?= $this->lang->line('Score Point') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_score = 0;
        foreach ($data['evaluations'] as $record) {
            $total_score += $record['score'];
            ?>
            <tr>
                <td><?= date($this->config->item('date_format_pdf'), strtotime($record['date'])) ?></td>
                <!--<td><?= $record['action_taken'] ?></td>-->
                <td><?= $record['reason'] ?></td>
                <td><?= $record['score'] ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2" class="text-right text-danger">Total Score</td>
            <td class="text-danger"><?= $total_score ?></td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="color: #0088cc;font-size: 16px;">Discipline Score: <?= $data['discipline_score']?></div>
    <div class="col-lg-4" style="color: #0088cc;font-size: 16px;">Total: <?= ( (int)$data['discipline_score'] + $total_score )?></div>
</div>
<form target="_blank" action="reports/print_report" method="POST" id="print_report">
    <div class="clearfix m-t-lg"></div>
    <button class="btn btn-primary pull-right" type="submit">
        <i class="fa fa-file-pdf-o"></i>
        <?= $this->lang->line('Print results') ?>
    </button>
    <input type="hidden" name="jsondata" id="jsondata" value='<?= $postdata ?>' />
</form>
<div class="clearfix m-t-lg"></div>
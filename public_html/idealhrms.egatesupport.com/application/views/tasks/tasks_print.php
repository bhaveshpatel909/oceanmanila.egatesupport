<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div style="margin-top: 20px;"><h1 class="title"><?= $tasks[0]['task_responsible'] ?>'s Task List</h1></div>
    </div>
    <table border="0" width="100%" align="center" style="margin-top: 20px;" cellpadding="5">
        <tr>
            <th style="text-align: right;">#</th>
            <th style="text-align: left;" valign="top" class="line-height"><?= $this->lang->line('Title') ?></th>
            <th style="text-align: left;" valign="top" class="line-height"><?= $this->lang->line('Start Date') ?></th>
            <th style="text-align: left;" valign="top" class="line-height"><?= $this->lang->line('Due Date') ?></th>
        </tr>
        <?php foreach ($tasks as $key => $task) { ?>
            <tr>
                <td style="text-align: right;" width="5%"><?=($key +1)?></td>
                <td><?= $task['task_title'] ?></td>
                <td width="13%"><?= $task['start_date'] ?></td>
                <td width="13%"><?php echo ($task['due_date'] == '0000-00-00' || $task['due_date'] == null) ? '' : $task['due_date'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
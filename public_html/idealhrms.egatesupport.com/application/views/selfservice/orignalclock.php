<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->lang->line('In Time') ?></th>
            <th><?= $this->lang->line('Out Time') ?></th>
            <th><?= $this->lang->line('Task Description') ?></th>
            <th style="text-align: right"><?= $this->lang->line('Total working hours') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_hours = 0;
        foreach ($clock as $item) {
            ?>
            <tr>
                <td><?= date('Y-m-d', strtotime($item['start_time'])) ?> <span class="text-primary text-bold"><?= date('H:i', strtotime($item['start_time'])) ?></span></td>
                <td>
                    <?php if (date('Y-m-d',strtotime($item['start_time']))!=date('Y-m-d',strtotime($item['end_time']))) {?>
                    <?= date('Y-m-d', strtotime($item['end_time'])) ?> 
                    <?php } ?>
                    <span class="text-primary text-bold"><?= date('H:i', strtotime($item['end_time'])) ?></span>
                </td>
                <td><?= $item['comments'] ?></td>
                <td class="text-right text-danger text-bold">
                    <?php
                    $diff = strtotime($item['end_time']) - strtotime($item['start_time']);
                    if ($diff > 0) {
                        $days = floor($diff / 86400);
                        $hours = floor(($diff % 86400) / 3600);
                        $mins = floor((($diff % 86400) % 3600) / 60);
                        $senconds = floor((($diff % 86400) % 3600) % 60);
                        //echo (int) $days . ':'. ($diff % 86400);
                        echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                        $total_hours += $diff;
                    }
                    ?>
                </td>
            </tr>        
        <?php }
        ?>
    </tbody>
</table>
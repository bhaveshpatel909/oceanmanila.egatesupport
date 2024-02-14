<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('PUNCH CLOCK REPORT') ?></h1></div>
    </div>
    <p>From: <?php echo date($this->config->item('date_format_pdf'), strtotime($from)) ?> &nbsp; to: <?php echo date($this->config->item('date_format_pdf'), strtotime($to)) ?>
    </p>
    <table border="0" width="100%" cellpadding="5" class="table table-striped table-bordered table-hover data_table">
        <thead>
            <tr>
                <th><?= $this->lang->line('Employee') ?></th>
                <th><?= $this->lang->line('Dates') ?></th>
                <th><?= $this->lang->line('In Time') ?></th>
                <th><?= $this->lang->line('Out Time') ?></th>
                <th><?= $this->lang->line('Working Hour') ?></th>
                <th><?= $this->lang->line('Overtime Notes') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $current_date = '';
            $total_hours = $subtotal = 0;
            $employee_id = $data[0]['employee_id'];
            $i = 0;
            foreach ($data as $key => $record) {
                $i++;
                $start_time_unix = strtotime($record['start_time']);
                $end_time_unix = strtotime($record['end_time']);
                /*
                  if ($employee_id != $record['employee_id']) {
                  ?>
                  <tr>
                  <th colspan="4" style="text-align: right;font-weight: 700;"><?= $this->lang->line('SubTotal') ?></th>
                  <td style="font-weight: 700;text-align: right;"><?php
                  $days = floor($subtotal / 86400);
                  $hours = floor(($subtotal % 86400) / 3600);
                  $mins = floor((($subtotal % 86400) % 3600) / 60);
                  $senconds = floor((($subtotal % 86400) % 3600) % 60);
                  //echo (int) $days . ':'. ($diff % 86400);
                  echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                  ?></td>
                  <td></td>
                  </tr>
                  <?php
                  $subtotal = 0;
                  } */
                ?>
                <tr>
                    <td><?= $record['fullname'] ?></td>
                    <td>
                        <?php
                        if ($current_date != $record['date_id']) {
                            $current_date = $record['date_id'];
                            ?>
                            <strong><?= date($this->config->item('date_format'), $start_time_unix) ?></strong>
                        <?php } ?>
                    </td>
                    <td><?= date('Y-m-d H:i', strtotime($record['start_time'])) ?> </td>
                    <td><?php if ($record['end_time']) { ?>
                            <?= date('Y-m-d H:i', strtotime($record['end_time'])) ?>
                        <?php } ?></td>
                    <td style="text-align: right;" class="text-right">
                        <?php
                        $diff = strtotime($record['end_time']) - strtotime($record['start_time']);
                        if ($diff > 0) {
                            $days = floor($diff / 86400);
                            $hours = floor(($diff % 86400) / 3600);
                            $mins = floor((($diff % 86400) % 3600) / 60);
                            $senconds = floor((($diff % 86400) % 3600) % 60);
                            //echo (int) $days . ':'. ($diff % 86400);
                            echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                            $total_hours += $diff;
                            $subtotal += $diff;
                        }
                        ?>
                    </td>
                    <td><?= $record['comments'] ?></td>
                </tr>
                <?php
                if (isset($data[$i])) {
                    if (($data[$i]['employee_id'] != $record['employee_id'])){
                        ?>
                        <tr>
                            <th colspan="4" style="text-align: right;font-weight: 700;"><?= $this->lang->line('SubTotal') ?></th>
                            <td style="font-weight: 700;text-align: right;"><?php
                                $days = floor($subtotal / 86400);
                                $hours = floor(($subtotal % 86400) / 3600);
                                $mins = floor((($subtotal % 86400) % 3600) / 60);
                                $senconds = floor((($subtotal % 86400) % 3600) % 60);
                                echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                                ?></td>
                            <td></td>
                        </tr>
                        <?php
                        $subtotal = 0;
                    }
                } else if($i == count($data)) {
                    ?>
                        <tr>
                            <th colspan="4" style="text-align: right;font-weight: 700;"><?= $this->lang->line('SubTotal') ?></th>
                            <td style="font-weight: 700;text-align: right;"><?php
                                $days = floor($subtotal / 86400);
                                $hours = floor(($subtotal % 86400) / 3600);
                                $mins = floor((($subtotal % 86400) % 3600) / 60);
                                $senconds = floor((($subtotal % 86400) % 3600) % 60);
                                echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                                ?></td>
                            <td></td>
                        </tr>
                        <?php
                        $subtotal = 0;
                }
                ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;font-weight: 700;"><?= $this->lang->line('Total time') ?></th>
                <td style="font-weight: 700;text-align: right;"><?php
                    $days = floor($total_hours / 86400);
                    $hours = floor(($total_hours % 86400) / 3600);
                    $mins = floor((($total_hours % 86400) % 3600) / 60);
                    $senconds = floor((($total_hours % 86400) % 3600) % 60);
                    //echo (int) $days . ':'. ($diff % 86400);
                    echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
                    ?></td>
                <td>

                </td>
            </tr>
        </tfoot>
    </table>
</div>

<table class="table table-striped table-bordered table-hover data_table">
    <thead>
        <tr>
            <?php if (isset($data[0]['name'])){?>
            <th><?= $this->lang->line('Employee')?></th>
            <?php }?>
            <th><?= $this->lang->line('Dates')?></th>
            <th><?= $this->lang->line('Comments')?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $current_date='';
        foreach($data as $record){
            $record['start_time']=strtotime($record['start_time']);
            $record['end_time']=strtotime($record['end_time']);
        
            if ($current_date!=$record['date_id']){
                $current_date=$record['date_id'];
        ?>
        <tr>
            <td colspan="3"><strong><?= date($this->config->item('date_format'),$record['start_time'])?></strong></td>
        </tr>
        <?php }?>
        <tr>
            <?php if (isset($record['name'])){?>
            <td>
                <img src="<?= $record['avatar']?>" class="img-circle col-lg-3 col-md-3 col-sm-4 col-xs-5"/>
                <?= $record['name']?>, [<?= $record['department_name']?>] <?= $record['position_name']?>
            </td>
            <?php }?>
            <td><?= date($this->config->item('time_format'),$record['start_time'])?> - <?= (date('Y-m-d',$record['start_time'])!=date('Y-m-d',$record['end_time'])?date($this->config->item('date_format'),$record['end_time']):'')?> <?= date($this->config->item('time_format'),$record['end_time'])?></td>
            <td><?= $record['comments']?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="feed-activity-list" id="positions_list">
    <?php foreach($positions as $position){?>
    <div class="feed-element" id="position_<?= $position['id']?>">
        <?php if ($position['is_current']=='1'){?>
        <a data-toggle="modal" href="employees/position_edit/<?= $position['id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <?php }else{?>
        <a data-toggle="modal" href="employees/position_view/<?= $position['id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-info"></i>
        </a>
        <?php }?>
        <strong class="position"><?= ($position['is_current']=='1')?'<i class="fa fa-check"></i>':''?> [<?= $position['department_name']?>] <?= $position['position_name']?></strong>
        <br/><small><i class="start_date"><?= $position['start']?date($this->config->item('date_format'),strtotime($position['start'])):$this->lang->line('now')?></i> - <i class="end_date"> <?= $position['end']?date($this->config->item('date_format'),strtotime($position['end'])):$this->lang->line('now')?></i></small>
    </div>
    <?php }?>
</div>
<div class="feed-activity-list" id="employment_list">
    <?php foreach($employment as $item){?>
    <div class="feed-element" id="employment_<?= $item['employment_id']?>">
        <a data-toggle="modal" href="employees/edit_employment/<?= $item['employment_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <strong class="employment"><?= ($item['is_verified']=='1')?'<i class="fa fa-check"></i>':''?> <?= $item['position']?></strong>
        <p><?= $item['company']?></p>
        <small><i class="start_date"><?= $item['start']?date($this->config->item('date_format'),strtotime($item['start'])):$this->lang->line('now')?></i> - <i class="end_date"> <?= $item['end']?date($this->config->item('date_format'),strtotime($item['end'])):$this->lang->line('now')?></i></small>
    </div>
    <?php }?>
</div>
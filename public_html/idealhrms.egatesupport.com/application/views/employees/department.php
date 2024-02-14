<div class="feed-activity-list" id="department_list">
    <?php foreach($department as $item){?>
    <div class="feed-element" id="department_<?= $item['id']?>">
        <a data-toggle="modal" href="employees/edit_department/<?= $item['id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <strong class="institution_name"><?= ($item['is_verified']=='1')?'<i class="fa fa-check"></i>':''?><?= $item['institution']?></strong>
        <p class="institution_description"><?= $item['description']?></p>
        <small><i class="start_date"><?= $item['start']?date($this->config->item('date_format'),strtotime($item['start'])):$this->lang->line('now')?></i> - <i class="end_date"> <?= $item['end']?date($this->config->item('date_format'),strtotime($item['end'])):$this->lang->line('now')?></i></small>
    </div>
    <?php }?>
</div>
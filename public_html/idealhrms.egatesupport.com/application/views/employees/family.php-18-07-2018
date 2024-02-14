<div class="feed-activity-list" id="family_list">
    <?php foreach($family as $relative){?>
    <div class="feed-element" id="relative_<?= $relative['relative_id']?>">
        <a data-toggle="modal" href="employees/edit_relative/<?= $relative['relative_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <strong class="relative"><?= ($relative['is_verified']=='1')?'<i class="fa fa-check"></i>':''?> <?= $relative['relative_name']?></strong>
        <p><?= $this->lang->line(ucfirst($relative['relative_type']))?><?= ($relative['birht_date']?(', '.date($this->config->item('date_format'),strtotime($relative['birht_date']))):'')?></p>
    </div>
    <?php }?>
</div>
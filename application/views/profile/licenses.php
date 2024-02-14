<div class="feed-activity-list" id="license_list">
    <?php foreach($licenses as $license){?>
    <div class="feed-element" id="license_<?= $license['license_id']?>">
        <a data-toggle="modal" href="profile/edit_license/<?= $license['license_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <strong class="license"><?= ($license['is_verified']=='1')?'<i class="fa fa-check"></i>':''?> <?= $license['license_name']?></strong>
        <p>#<?= $license['license_id']?>,  <?= date($this->config->item('date_format'),strtotime($license['license_expiry']))?></p>
    </div>
    <?php }?>
</div>
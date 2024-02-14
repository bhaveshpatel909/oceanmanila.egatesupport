<div class="feed-activity-list" id="license_list">
    <?php foreach($licenses as $license){?>
    <div class="feed-element" id="license_<?= $license['license_id']?>">
        <a data-toggle="modal" href="employees/edit_license/<?= $license['license_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <div class="col-lg-4">
        <strong class="license"><?= ($license['is_verified']=='1')?'<i class="fa fa-check"></i>':''?> <?= $license['license_name']?></strong>
        <p>#<?= $license['license_id']?>,  <?= $license['license_expiry'] ? date($this->config->item('date_format'),strtotime($license['license_expiry'])) : "-" ?></br> Ref No: <?= $license['license_number']?></p>
        </div>
        <div class="col-lg-7">
                <?php foreach ($license['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/201File/' . $attachment['location']) ?>"download="<?php echo base_url('files/attachments/201File/' . $attachment['file']) ?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/201File/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
            </div>
    </div>
    <?php }?>
</div>
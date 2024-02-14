<div class="feed-activity-list" id="claim_list">
<?php //echo 'fffff'; ?>
    <?php foreach($claims as $claim){?>
    <div class="feed-element" id="claim_<?= $claim['claim_id']?>">
        <a data-toggle="modal" href="employees/edit_claim/<?= $claim['claim_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <div class="col-lg-4">
        <strong class="claim"><?= $claim['claim_name']?></strong>
        
        </div>
        <div class="col-lg-4">
                <?php foreach ($claim['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
            </div>
    </div>
    <?php }?>
</div>
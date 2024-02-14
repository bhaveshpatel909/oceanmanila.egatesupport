<div class="feed-activity-list" id="performance_list">
    <?php foreach($performances as $performance){?>
    <div class="feed-element" id="performance_<?= $performance['performance_id']?>">
        <a data-toggle="modal" href="employees/edit_performance/<?= $performance['performance_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <div class="col-lg-4">
        <strong class="performance"><?= $performance['performance_name']?></strong>
        
        </div>
        <div class="col-lg-7">
                <?php foreach ($performance['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/'.$attachment['file']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
            </div>
    </div>
    <?php }?>
</div>
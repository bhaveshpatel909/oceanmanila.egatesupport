<div class="feed-activity-list" id="assetbenefit_list">
    <?php foreach($assetbenefits as $assetbenefit){?>
    <div class="feed-element" id="assetbenefit_<?= $assetbenefit['assetbenefit_id']?>">
        <a data-toggle="modal" href="employees/edit_assetbenefit/<?= $assetbenefit['assetbenefit_id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
        <div class="col-lg-4">
        <strong class="assetbenefit"><?= $assetbenefit['assetbenefit_name']?></strong>
		
        
        </div>
        <div class="col-lg-4 returned">
                <?php foreach ($assetbenefit['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location'])  ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
				<?php if($assetbenefit['is_returned']==1)
				{
					echo "<span style='color:red;'>Returned</span>";
				}
				?>
            </div>
			
    </div>
    <?php }?>
</div>

<style type="text/css">
	.col-lg-4.returned span {
    float: right;
    position: relative;
    top: -17px;
    left: -78px;
}

.col-lg-4.returned {
    display: contents;
}
</style>
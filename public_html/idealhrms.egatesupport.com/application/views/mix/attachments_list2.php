<div id="attachments_list2">

    <?php if (!isset($readonly) OR !$readonly){?>

    <div class="file m-b-xs">

        <div class="file-name">

            <input type="file" multiple="multiple" name="new_attachments2[]" id="new_attachments2">

        </div>

    </div>

    <?php }?>

    <?php foreach($attachments2 as $attachment2){ ?>

    <div class="file m-b-xs" id="attachment_<?= $attachment2['attachment_id']?>">

        <?php if (!isset($readonly)){?>

        <button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment2['attachment_id']?>">

            <i class="fa fa-trash-o"></i>

        </button>

        <?php }?>

        <div class="file-name">

            <a href="<?= $base_url ?>/files/attachments/<?= $attachment2['file']?>" target="_blank">

                <i class="fa <?= get_fa_extension($attachment2['extenstion'])?> fa-1-5x"></i> <?= $attachment2['file']?>

                <br>

                <small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'),strtotime($attachment2['uploaded']))?></small>

            </a>

        </div>

        <div class="clearfix"></div>

    </div>

    <?php }?>

</div>
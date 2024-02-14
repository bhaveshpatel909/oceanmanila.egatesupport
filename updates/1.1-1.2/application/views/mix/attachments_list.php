<div id="attachments_list">
    <?php if (!isset($readonly) OR !$readonly){?>
    <div class="file m-b-xs">
        <div class="file-name">
            <input type="file" multiple="multiple" name="new_attachments[]" id="new_attachments">
        </div>
    </div>
    <?php }?>
    <?php foreach($attachments as $attachment){?>
    <div class="file m-b-xs" id="attachment_<?= $attachment['attachment_id']?>">
        <?php if (!isset($readonly)){?>
        <button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['attachment_id']?>">
            <i class="fa fa-trash-o"></i>
        </button>
        <?php }?>
        <div class="file-name">
            <a href="<?= (!isset($base_url)?'employees':$base_url)?>/download_attachment/<?= $attachment['attachment_id']?>" target="_blank">
                <i class="fa <?= get_fa_extension($attachment['extenstion'])?> fa-1-5x"></i> <?= $attachment['file']?>
                <br>
                <small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'),strtotime($attachment['uploaded']))?></small>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php }?>
</div>
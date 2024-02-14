<?php foreach ($documents['data'] as $index => $document) { ?>
    <div class="col-lg-3 col-sm-3 col-xs-12 col-md-3 document_area" id="document_<?= $document['document_id'] ?>">
        <div class="file">
            <a data-toggle="modal" href="documents/edit_document/<?= $document['document_id'] ?>" data-target="#modal_window">
                <div class="icon">
                    <i class="fa <?= get_fa_extension($document['extenstion']) ?>"></i>
                </div>

            </a>
            <div class="file-name wrapword">
                <?php foreach ($document['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" ><?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
                <br />
                <small class="description"><?= $document['description'] ?></small>
            </div>
        </div>
    </div>
    <?php if ($index % 4 == 0 && $index > 0) { ?>
        <div class="clearfix document_area"></div>
        <?php
    }
}
?>
<div class="clearfix document_area"></div>
<script>
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
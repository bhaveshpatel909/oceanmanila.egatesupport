<?php foreach($documents['data'] as $index=>$document){
if ($index%4==0){?>
<div class="clearfix document_area"></div>
<?php  } ?>
<div class="col-lg-3 col-sm-3 col-xs-12 col-md-3 document_area">
    <div class="file">
        <a href="dashboard/download_document/<?= $document['document_id']?>" target="_blank">
            <div class="icon">
                <i class="fa <?= get_fa_extension($document['extenstion'])?>"></i>
            </div>
            <div class="file-name wrapword">
                <?= $document['file']?>
                <br />
                <small class="description"><?= $document['description']?></small>
            </div>
        </a>
    </div>
</div>
<?php } ?>
<div class="clearfix document_area"></div>
<script src="js/jquery.raty.min.js"></script>
<script>
    $('document').ready(function(){
        $(".rating").raty({
            readOnly:true,
        });
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Assessment')?></h4>
            </div>
            <div class="modal-body">
                <ul class="unstyled no-padding" style="max-height: 400px;overflow: auto;">
                    <?php foreach($assessment as $category){?>
                    <li>
                        <?= $category[0]['category_name']?>
                        <ul class="unstyled">
                            <?php foreach($category as $item){?>
                            <li>
                                <strong><?= $item['skill_name']?></strong>
                                <p>
                                <div class="rating pull-left" data-score="<?= $item['level']?>"></div> - 
                                <i><?= $item['comment']?></i></p>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
            </div>
        </div>
    </div>
</div>
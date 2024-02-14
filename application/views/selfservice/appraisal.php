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
                <h4 class="modal-title"><?= $this->lang->line('Appraisal')?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Expectations')?></label>
                    <p class="text-justify"><i><?= $appraisal['expectations']?></i></p>
                </div>
                <?php if ($appraisal['is_completed']=='1'){?>
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Results')?></label>
                    <p class="text-justify"><i><?= $appraisal['results']?></i></p>
                </div>
                <?php }?>
                 <h2><?= $this->lang->line('Logs')?></h2>
                 <div class="feed-activity-list" style="max-height: 200px;overflow: auto;">
                    <?php foreach($logs as $log){?>
                    <div class="feed-element">
                        <div class="pull-right">
                            <span class="text-navy"><?= date($this->config->item('date_format'),strtotime($log[0]['date']))?></span>
                        </div>
                        <div class="clearfix"></div>
                        <p class="text-justify"><?= $log[0]['comment']?></p>
                        <ul class="unstyled">
                            <?php foreach($log as $item){?>
                            <li>
                                <?= $item['criterion_name']?>
                                <span class="rating" data-score="<?= $item['criteria_result']?>"></span>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                    <?php }?>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
            </div>
        </div>
    </div>
</div>
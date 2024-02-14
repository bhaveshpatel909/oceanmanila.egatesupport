<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
        $(".modal-body .rating").raty({
            cancel:true
        });
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Log')?></h4>
            </div>
            <div class="modal-body">
                <form action="performance/save_log" method="POST" id="save_log">
                    <input type="hidden" name="appraisal_id" id="appraisal_id" value="<?= $appraisal_id?>">
                    <div id="save_result2"></div>
                    <div class="form-group has-feedback">
                        <label for="date" class="control-label"><?= $this->lang->line('Date')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="date" id="date" class="form-control datetimepicker required" data-date-format="<?= $this->config->item('js_month_format')?>">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="comment" class="control-label"><?= $this->lang->line('Comment')?><sup class="mandatory">*</sup></label>
                        <textarea rows="4" name="comment" id="comment" class="form-control required"></textarea>
                    </div>
                    <h4><?= $this->lang->line('Criteria')?></h4>
                    <ul class="unstyled no-padding">
                        <?php foreach($criteria as $item){?>
                        <li>
                            <span class="criterion_name"><?= $item['criterion_name']?></span>
                            <div class="rating" data-score-name="results[<?= $item['criterion_id']?>]"></div>
                        </li>
                        <?php }?>
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_log','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
        </div>
    </div>
</div>
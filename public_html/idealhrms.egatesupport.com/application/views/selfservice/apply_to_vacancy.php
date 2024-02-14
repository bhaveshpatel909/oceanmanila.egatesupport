<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Apply to vacancy')?></h4>
            </div>
            <div class="modal-body">
                <form action="dashboard/proccess_apply" method="POST" id="proccess_apply">
                    <input type="hidden" name="vacancy_id" id="vacancy_id" value="<?= $vacancy['vacancy_id']?>">
                    <div id="save_result2"></div>
                </form>
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Position name')?></label>
                    <p class="text-justify">[<?= ($vacancy['department_name']?$vacancy['department_name']:'-')?>] <?= ($vacancy['position_name']?$vacancy['position_name']:'-')?></p>
                </div>
                <div class="form-group">
                    <label class="control-label"><?= $this->lang->line('Description')?></label>
                    <p class="text-justify"><?= $vacancy['description']?></p>
                </div>
                <?php $this->load->view('employees/position_compatible')?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#proccess_apply','#save_result2')"><?= $this->lang->line('Apply')?></button>
            </div>
        </div>
    </div>
</div>
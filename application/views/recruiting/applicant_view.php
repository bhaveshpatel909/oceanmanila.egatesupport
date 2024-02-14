<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Applicant')?></h4>
            </div>
            <div class="modal-body">    
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#main_tab" data-toggle="tab"><?= $this->lang->line('Main')?></a></li>
                  <li><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('Details')?></a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="main_tab">
                        <div class="col-lg-6 m-t-sm" style="padding-left: 0;">
                            <div class="form-group has-feedback">
                                <label for="applicant_name" class="control-label"><?= $this->lang->line('Name')?></label>
                                <input type="text" id="applicant_name" name="applicant_name" class="form-control required" value="<?= $applicant['applicant_name']?>" disabled="disabled">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="applicant_email" class="control-label"><?= $this->lang->line('Email')?></label>
                                <input type="text" name="applicant_email" id="applicant_email" class="form-control required email" value="<?= $applicant['applicant_email']?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-lg-6 m-t-sm">
                            <div class="form-group has-feedback">
                                <label for="birth_date" class="control-label"><?= $this->lang->line('Birth date')?></label>
                                <input type="text" name="birth_date" id="birth_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= date($this->config->item('date_format'),strtotime($applicant['birth_date']))?>" disabled="disabled">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="applicant_phone" class="control-label"><?= $this->lang->line('Phone')?></label>
                                <input type="text" name="applicant_phone" id="applicant_phone" class="form-control required" value="<?= $applicant['applicant_phone']?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <?php $this->load->view('mix/attachments_list',array('readonly'=>TRUE))?>        
                    </div>
                    <div class="tab-pane fade" id="details_tab">
                        <div class="form-group m-t-sm">
                            <label for="advantages" class="control-label"><?= $this->lang->line('Advantages')?></label>
                            <textarea rows="3" name="advantages" id="advantages" class="form-control" disabled="disabled"><?= $applicant['advantages']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="disadvantages" class="control-label"><?= $this->lang->line('Disadvantages')?></label>
                            <textarea rows="3" name="disadvantages" id="disadvantages" class="form-control" disabled="disabled"><?= $applicant['disadvantages']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('document').ready(function(){
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Applicant')?></h4>
            </div>
            <div class="modal-body">
                <form action="recruiting/save_applicant" method="POST" id="save_applicant">
                    <div id="save_result2"></div>
                    <input type="hidden" id="applicant_id" name="applicant_id" value="<?= $applicant['applicant_id']?>" class="applicant_id">
                    <input type="hidden" id="vacancy_id" name="vacancy_id" value="<?= $applicant['vacancy_id']?>" class="vacancy_id">
                    
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#main_tab" data-toggle="tab"><?= $this->lang->line('Main')?></a></li>
                      <li><a href="#details_tab" data-toggle="tab"><?= $this->lang->line('Details')?></a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="main_tab">
                            <div class="col-lg-6 m-t-sm" style="padding-left: 0;">
                                <div class="form-group has-feedback">
                                    <label for="applicant_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                                    <input type="text" name="applicant_name" id="applicant_name" class="form-control required" value="<?= $applicant['applicant_name']?>">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="applicant_email" class="control-label"><?= $this->lang->line('Email')?><sup class="mandatory">*</sup></label>
                                    <input type="text" name="applicant_email" id="applicant_email" class="form-control required email" value="<?= $applicant['applicant_email']?>">
                                </div>
                            </div>
                            <div class="col-lg-6 m-t-sm">
                                <div class="form-group has-feedback">
                                    <label for="birth_date" class="control-label"><?= $this->lang->line('Birth date')?><sup class="mandatory">*</sup></label>
                                    <input type="text" name="birth_date" id="birth_date" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= date($this->config->item('date_format'),strtotime($applicant['birth_date']))?>">
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="applicant_phone" class="control-label"><?= $this->lang->line('Phone')?><sup class="mandatory">*</sup></label>
                                    <input type="text" name="applicant_phone" id="applicant_phone" class="form-control required" value="<?= $applicant['applicant_phone']?>">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <?php $this->load->view('mix/attachments_list')?>        
                        </div>
                        <div class="tab-pane fade" id="details_tab">
                            <div class="form-group m-t-sm">
                                <label for="advantages" class="control-label"><?= $this->lang->line('Advantages')?></label>
                                <textarea rows="3" name="advantages" id="advantages" class="form-control"><?= $applicant['advantages']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="disadvantages" class="control-label"><?= $this->lang->line('Disadvantages')?></label>
                                <textarea rows="3" name="disadvantages" id="disadvantages" class="form-control"><?= $applicant['disadvantages']?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="recruiting/save_status" method="POST" id="save_status">
                    <input type="hidden" id="applicant_id" name="applicant_id" value="<?= $applicant['applicant_id']?>" class="applicant_id">
                    <input type="hidden" name="status" id="status">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <div class="btn-group dropup">
                    <button type="button" class="btn btn-primary" onclick="submit_form('#save_applicant','#save_result2')"><?= $this->lang->line('Save')?></button>
                    <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="#" onclick="$('#status').val('Enrolled');submit_form('#save_status','#save_result2');return false;"><?= $this->lang->line('Enroll')?></a>
                        </li>
                        <li>
                            <a href="#" onclick="$('#status').val('Ignored');submit_form('#save_status','#save_result2');return false;"><?= $this->lang->line('Ignore')?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
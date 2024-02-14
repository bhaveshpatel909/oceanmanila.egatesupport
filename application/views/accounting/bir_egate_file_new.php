<style>
.file .file-name{padding: 5px;}
.modal-footer { margin-top: 55px;}

</style>
<script>
function refreshPage(){
    //window.location.reload();
	$('.modal').hide();
	
} 
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="refreshPage()" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('BIR  File(Egate) Registration') ?></h4>
            </div>
            <div class="modal-body">
                <form action="accounting/save_bir_egate_file" method="POST" id="save_bir_file">
                    <div id="save_result2"></div>
                    <input type="hidden" id="bir_e_file_id" name="bir_e_file_id" value="0" class="bir_file_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="for_themonth" class="control-label"><?= $this->lang->line('For the month') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="for_themonth" id="for_themonth" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>
					
					 <div class="form-group has-feedback col-lg-6" style="padding-left: 0;">
                        <label for="form_id" class="control-label"><?= $this->lang->line('Form Name') ?><sup class="mandatory">*</sup></label>
                        <select name="form_id" id="form_id" class="form-control required">
                            <option value="">Select Form Name</option>
                            <?php foreach ($bir_forms as $bir_form) { ?>
                                <option value="<?= $bir_form['form_id'] ?>"><?= $bir_form['form_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
					<div class="clearfix"></div>
                   
					
                       <!-- <label for="alertchk"  class="control-label"><//?= $this->lang->line('Alert') ?></label>-->
                        <input type="hidden"  style="width: 109px; height: 21px;"  name="alertchk" checked id="alertchk" value='0'>
                    
					
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;">
                        <label for="Form_File" class="control-label"><?= $this->lang->line('Form File') ?></label>
                        <?php $this->load->view('mix/attachments_list', array('attachments' => array())) ?>
                    </div>
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;">
                        <label for="form_id" class="control-label"><?= $this->lang->line('Payment File') ?></label>
                        <?php $this->load->view('mix/attachments_list2', array('attachments2' => array())) ?>
                    </div>
					<div class="clearfix"></div>
					<div class="col-lg-6" style="padding-left: 0;" >
                        
                            <label for="reference" class="control-label"><?= $this->lang->line('Reference No.') ?><sup class="mandatory"></sup></label>
                            <input type="text" name="reference" id="reference" class="form-control" maxlength="60">
                       
                    </div>
                    <div class="col-lg-6" style="padding-left:10px;float:right;">
                        <div class="form-group has-feedback">
                            <label for="amount" class="control-label"><?= $this->lang->line('Paid Amount') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="amount" id="amount" class="form-control required" maxlength="12">
                        </div>
                    </div>
					
					
                    <div class="clearfix"></div>
     
                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?></label>
                        <textarea rows="1" id="remarks" name="remarks" class="form-control"></textarea>
                    </div>
					
					
                </form>
            </div>
            <div class="modal-footer" style="margin-top:68px;">
                <button type="button" onClick="refreshPage()" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_file', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<style>
.file .file-name{padding: 5px;}
.modal-footer { margin-top: 55px;}

</style>
<script>
function refreshPage(){
    window.location.reload();
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
                <h4 class="modal-title"><?= $this->lang->line('BIR File Registration') ?></h4>
            </div>
            <div class="modal-body">
                <form action="accounting/save_bir_file" method="POST" id="save_bir_file">
                    <div id="save_result2"></div>
                    <input type="hidden" id="bir_file_id" name="bir_file_id" value="0" class="bir_file_id">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="for_themonth" class="control-label"><?= $this->lang->line('For the month') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="for_themonth" id="for_themonth" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                        </div>
                    </div>
					
					
					
                    <div class="clearfix"></div>
                    <div class="form-group has-feedback col-lg-6" style="padding-left: 0;">
                        <label for="form_id" class="control-label"><?= $this->lang->line('Form Name') ?><sup class="mandatory">*</sup></label>
                        <select name="form_id" id="form_id" class="form-control required">
                            <option value="">Select Form Name</option>
                            <?php foreach ($bir_forms as $bir_form) { ?>
                                <option value="<?= $bir_form['form_id'] ?>"><?= $bir_form['form_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
					<div  class="form-group has-feedback col-lg-6" style="margin-top: -68px; color: red; font-size: 36px;">
                       <!-- <label for="alertchk"  class="control-label"><//?= $this->lang->line('Alert') ?></label>-->
                        <input type="hidden"  style="width: 109px; height: 21px;"  name="alertchk" checked id="alertchk" value='0'>
                    </div>
					
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;">
                        <label for="Form_File" class="control-label"><?= $this->lang->line('Form File') ?></label>
						
                        <?php //$this->load->view('mix/attachments_list', array('attachments' => array())) ?>
						<div id="attachments_list">
								<?php if (!isset($readonly) OR !$readonly){?>
								<div class="file m-b-xs">
									<div class="file-name">
										<input type="file" multiple="multiple" name="new_attachments[]" id="new_attachments" accept=".pdf,application/pdf">
									</div>
								</div>
								<?php }?>
								<?php foreach($attachments as $attachment){	
								
								  
								
								
								?>
								<div class="file m-b-xs" id="attachment_<?= $attachment['attachment_id']?>">
									<?php if (!isset($readonly)){?>
									<button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment['attachment_id']?>">
										<i class="fa fa-trash-o"></i>
									</button>
									<?php }?>
									<div class="file-name">
									<div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>"download="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>

											<br>

											<small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'),strtotime($attachment['uploaded']))?></small>

										</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<?php }?>
							</div>
                    </div>
					
                    <div class="clearfix"></div>
                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="amount" class="control-label"><?= $this->lang->line('Paid Amount') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="amount" id="amount" class="form-control required" maxlength="12">
                        </div>
                    </div>
					
					<div class="form-group has-feedback col-lg-6" style="padding-left: 10px;">
                        <label for="form_id" class="control-label m-t-sm"><?= $this->lang->line('Payment File') ?></label>
                        <?php //$this->load->view('mix/attachments_list2', array('attachments2' => array())) ?>
						<div id="attachments_list2">

    <?php if (!isset($readonly) OR !$readonly){?>

    <div class="file m-b-xs">

        <div class="file-name">

            <input type="file" multiple="multiple" name="new_attachments2[]" id="new_attachments2" accept=".pdf,application/pdf">

        </div>

    </div>

    <?php }?>

    <?php foreach($attachments2 as $attachment2){ ?>

    <div class="file m-b-xs" id="attachment_<?= $attachment2['attachment_id']?>">

        <?php if (!isset($readonly)){?>

        <button type="button" class="btn btn-danger pull-right m-r-sm m-t-sm m-b-none remove_attachment" attachment_id="<?= $attachment2['attachment_id']?>">

            <i class="fa fa-trash-o"></i>

        </button>

        <?php }?>

        <div class="file-name">

            <a href="<?= $base_url ?>/files/attachments/<?= $attachment2['file']?>" target="_blank">

                <i class="fa <?= get_fa_extension($attachment2['extenstion'])?> fa-1-5x"></i> <?= $attachment2['file']?>

                <br>

                <small><?= $this->lang->line('Added')?>: <?= date($this->config->item('date_format'),strtotime($attachment2['uploaded']))?></small>

            </a>

        </div>

        <div class="clearfix"></div>

    </div>

    <?php }?>

</div>
                    </div>
					
                    <div class="clearfix"></div>
     
                    <div class="form-group col-lg-6" style="padding-left: 0px;">
                        <label for="remarks" class="control-label"><?= $this->lang->line('Remarks') ?></label>
                        <textarea rows="1" id="remarks" name="remarks" class="form-control"></textarea>
                    </div>
					
					<div class="col-lg-6" style="padding-left:8px;float:right;">
                        <div class="form-group has-feedback">
                            <label for="reference" class="control-label"><?= $this->lang->line('Reference No.') ?><sup class="mandatory"></sup></label>
                            <input type="text" name="reference" id="reference" class="form-control" maxlength="60">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="refreshPage()" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_file', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
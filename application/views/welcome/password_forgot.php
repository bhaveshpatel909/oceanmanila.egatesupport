<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Forgot password')?></h4>
            </div>
            <div class="modal-body">
                <form action="welcome/get_password" method="POST" id="get_password">
                    <div id="save_result2"></div>
                    <div class="form-group has-feedback">
                        <label for="user_email" class="control-label"><?= $this->lang->line('Your email')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="user_email" id="user_email" class="form-control required email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#get_password','#save_result2')"><?= $this->lang->line('Get new password')?></button>
            </div>
        </div>
    </div>
</div>
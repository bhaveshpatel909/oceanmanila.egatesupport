<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Install'),'forms'=>TRUE))?>
<div class="middle-box loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name"><?= $this->lang->line('HRMS')?></h1>
        </div>
        <h3><?= $this->lang->line('Install HRMS')?></h3>
        <form class="m-t" role="form" action="install/save_config" method="POST" id="install_form">
            <div id="save_result"></div>
            <div class="form-group has-feedback">
                <label class="control-label" for="database_host"><?= $this->lang->line('Database host')?><sup class="mandatory">*</sup></label>
                <input type="text" id="database_host" name="database_host" class="form-control required" />
            </div>
            <div class="form-group has-feedback">
                <label class="control-label" for="database_name"><?= $this->lang->line('Database name')?><sup class="mandatory">*</sup></label>
                <input type="text" name="database_name" id="database_name" class="form-control required" />
            </div>
            <div class="form-group has-feedback">
                <label class="control-label" for="database_user"><?= $this->lang->line('Database user')?><sup class="mandatory">*</sup></label>
                <input type="text" name="database_user" id="database_user" class="form-control required" />
            </div>
            <div class="form-group has-feedback">
                <label class="control-label" for="database_password"><?= $this->lang->line('Database password')?><sup class="mandatory">*</sup></label>
                <input type="password" name="database_password" id="database_password" class="form-control required">
            </div>
            <div class="form-group has-feedback">
                <label for="username"><?= $this->lang->line('Your username')?><sup class="mandatory">*</sup></label>
                <input type="email" name="username" id="username" class="form-control required email">
            </div>
            <div class="form-group has-feedback">
                <label class="control-label" for="admin_password"><?= $this->lang->line('Your password')?><sup class="mandatory">*</sup></label>
                <input type="password" name="admin_password" id="admin_password" class="form-control required">
            </div>
            <button type="button" onclick="submit_form('#install_form')" class="btn btn-primary block full-width m-b"><?= $this->lang->line('Install')?></button>
        </form>
        <p class="m-t text-center"><small><?= $this->lang->line('HRMS')?> &copy; <?= date('Y')?></small></p>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
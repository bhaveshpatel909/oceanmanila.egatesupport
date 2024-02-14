<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Email'),'forms'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#email_method').change(function(){
            $("#smtp_settings").toggleClass('hide',$(this).val()!='smtp');
        })
    })
	$('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
    });
</script>
<div id="wrapper">


    <?php $this->load->view('layout/menu',array('active_menu'=>'company_email'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Email')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <button type="button" class="btn btn-primary" onclick="submit_form('#save_email')">
                        <i class="fa fa-save"></i>
                        <?= $this->lang->line('Save')?>
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <form role="form" action="settings/save_email" method="POST" id="save_email">
                                <div id="save_result"></div>
                                <div class="col-lg-6">
								<?php 
								
								?>
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Email method')?><sup class="mandatory">*</sup></label>
                                        <select name="email_method" class="form-control required" id="email_method">
                                            <option value="smtp" <?= ($email['email_method']=='smtp'?'selected="selected"':'')?>><?= $this->lang->line('SMTP')?></option>
                                            <option value="mail" <?= ($email['email_method']=='mail'?'selected="selected"':'')?>><?= $this->lang->line('Mail')?></option>
                                            <option value="sendmail" <?= ($email['email_method']=='sendmail'?'selected="selected"':'')?>><?= $this->lang->line('SendMail')?></option>
                                        </select>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Admin Email')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="admin_email" 
										value="<?php if(isset($adminemail['setting_value'])){echo $adminemail['setting_value'];}?>"
										id="adminemail" placeholder="Input Admin Email" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Task Manager Email')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="task_manager_email" value="<?php if(isset($manager['setting_value'])){echo $manager['setting_value']; }?>"id="task_manager_email" placeholder="Input Task Manager Email" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Accounting Email')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="accounting_email" value="<?php if(isset($accountingemail['setting_value'])){echo $accountingemail['setting_value']; }?>"id="accounting_email" placeholder="Accounting Email" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Admin Manager Name')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="admin_manager_name" value="<?php echo $admin_manager_name;?>"id="admin_manager_name" placeholder="Admin Manager Name" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Company Name')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="company_name" value="<?php echo $company_name;?>"id="company_" placeholder="Company Name" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Company Address')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="company_address" value="<?php echo $company_address;?>"id="company_address" placeholder="Company Address" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Company Phone')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="company_phone" value="<?php  echo $company_phone;?>"id="company_phone" placeholder="Company Phone" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>	<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Setting Number Of Employee')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="Text" name="no_employee" value="<?php  echo $no_employees;?>"id="no_employee" placeholder="No Of Employees" style="width:540px; height:35px;padding-left:15px;"/>
                                    </div>
									<div class="form-group has-feedback">
                                        <label class="control-label" for="email_method"><?= $this->lang->line('Service Expiration Date')?><sup class="mandatory">*</sup></label><br/>
                                        <input type="text" name="expire_date" id="expire_date" value ="<?php if(isset($expiration['setting_value'])){echo $expiration['setting_value']; }?>" class="form-control required datetimepicker" data-date-format="<?= $this->config->item('js_month_format') ?>">
                      </div>
									
                                </div>

                                <div class="clearfix"></div>
                                <div id="smtp_settings" class="<?= ($email['email_method']=='smtp'?'':'hide')?>">
                                    <div class="col-lg-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="smtp_server"><?= $this->lang->line('SMTP server')?><sup class="mandatory">*</sup></label>
                                            <input type="text" class="form-control required" name="smtp_server" id="smtp_server" maxlength="100" value="<?= $email['smtp_server']?>" placeholder="<?= $this->lang->line('Server:port')?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="smtp_username"><?= $this->lang->line('SMTP user')?><sup class="mandatory">*</sup></label>
                                            <input type="text" class="form-control required" name="smtp_username" id="smtp_username" maxlength="100" value="<?= $email['smtp_username']?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-lg-6">
                                        <div class="form-group has-feedback">
                                            <label class="control-label" for="smtp_password"><?= $this->lang->line('SMTP password')?><sup class="mandatory">*</sup></label>
                                            <input type="password" class="form-control required" name="smtp_password" id="smtp_password" maxlength="100" value="<?= $email['smtp_password']?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Profile'),'forms'=>TRUE,'date_time'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('.btn-group button').click(function(){
            $('.btn-group button').removeClass('active btn-primary');
            $(this).addClass('active btn-primary');
            $("#employee_gender").val($(this).attr('gender'));
        })
        
        $("#employee_avatar").change(function(){
           $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('Press Save button and photo will be updated')?></div>');
        })
        
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'profile'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Profile')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Profile')?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Details')?></h5>
                                </div>
                                <div>
                                    <form action="profile/save_profile" id="save_profile" method="POST">
                                        <div class="ibox-content no-padding border-left-right text-center">
                                            <a href="#" onclick="$('#employee_avatar').click();return false;">
                                                <img id="avatar_img" class="img-circle" src="<?= $profile['avatar']?>">
                                            </a>
                                            <input type="file" id="employee_avatar" name="employee_avatar" accept="image/*" class="hide">
                                        </div>
                                        <div class="ibox-content profile-content">
                                            <div class="form-group has-feedback">
                                                <label for="employee_name" class="control-label"><?= $this->lang->line('Name')?><sup class="mandatory">*</sup></label>
                                                <input type="text" name="employee_name" id="employee_name" class="form-control required" maxlength="100" value="<?= $profile['name']?>">
                                            </div>
                                            <div class="form-group has-feedback">
                                                <label for="employee_email" class="control-label"><?= $this->lang->line('Email')?><sup class="mandatory">*</sup></label>
                                                <input type="email" name="employee_email" id="employee_email" class="form-control required email" maxlength="100" value="<?= $profile['email']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="birth_date" class="control-label"><?= $this->lang->line('Birth date')?></label>
                                                <input type="text" name="birth_date" id="birth_date" class="form-control datetimepicker" value="<?= ($profile['birth_date'])?date($this->config->item('date_format'),strtotime($profile['birth_date'])):''?>" data-date-format="<?= $this->config->item('js_month_format')?>">
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="control-label"><?= $this->lang->line('Gender')?></label>
                                                <input type="hidden" name="employee_gender" id="employee_gender" value="<?= $profile['gender']?>">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <button type="button" class="btn btn-circle <?= ($profile['gender']=='male')?'btn-primary active':''?>" gender="male"><i class="fa fa-male" style="font-size: 19px;"></i></button>
                                                    <button type="button" class="btn btn-circle <?= ($profile['gender']=='female')?'btn-primary active':''?>" gender="female"><i class="fa fa-female" style="font-size: 19px;"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label for="employee_ssn" class="control-label"><?= $this->lang->line('SSN')?></label>
                                                    <input type="text" name="employee_ssn" id="employee_ssn" class="form-control" value="<?= $profile['ssn']?>">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_profile')">
                                                <i class="fa fa-save"></i>
                                                <?= $this->lang->line('Save')?>
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                           
                            <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="profile/new_license/" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add')?>
                                </a>
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Licenses')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_licenses" style="display: none;" ajax_link="profile/licenses"></div>
                            </div>
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Password')?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <form action="profile/save_password" id="save_password" method="POST">
                                        <div class="form-group has-feedback">
                                            <label for="current_password" class="control-label"><?= $this->lang->line('Current password')?><sup class="mandatory">*</sup></label>
                                            <input type="password" name="current_password" id="current_password" class="form-control required">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="new_password" class="control-label"><?= $this->lang->line('New password')?><sup class="mandatory">*</sup></label>
                                            <input type="password" name="new_password" id="new_password" class="form-control required">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="password_again" class="control-label"><?= $this->lang->line('Password again')?><sup class="mandatory">*</sup></label>
                                            <input type="password" name="password_again" id="password_again" class="form-control required" equalTo="#new_password">
                                        </div>
                                        <div class="clearfix"></div>
                                        <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_password')">
                                            <i class="fa fa-save"></i>
                                            <?= $this->lang->line('Change')?>
                                        </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
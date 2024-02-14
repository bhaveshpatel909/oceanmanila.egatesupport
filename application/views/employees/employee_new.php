<?php $this->load->view('layout/header',array('title'=>$this->lang->line('New employee'),'forms'=>TRUE,'date_time'=>TRUE)) ?>
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
		$("#signimag_1").change(function(){
           $("#save_result1").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('Press Save button and photo will be updated')?></div>');
        })
		
        
        $('.datetimepicker').datetimepicker({pickTime: false});
    })
</script>

<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'employees_new'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('New')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Employees')?>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                
                                <div>
                                    <form action="employees/save_employee" id="save_details" method="POST" role="form">
                                    <input type="hidden" name="employee_id" id="employee_id" value="0">
									<div class="avtar-main-div" style="width:100%; float:left; background:#fff;">
									<div class="col-sm-6 col-md-6" style="padding:0px;">
									<div class="ibox-title">
                                    <h5><?= $this->lang->line('Profile Image')?></h5>
                                </div>
                                        <div class="ibox-content no-padding border-left-right text-center">
                                            <a href="#" onclick="$('#employee_avatar').click();return false;">
                                                <img id="avatar_img" class="img-circle" src="images/no_avatar.jpg">
                                            </a>
                                            <input type="file" id="employee_avatar" name="employee_avatar" accept="image/*" class="hide">
                                            <br/><span class="badge badge-success m-t-xs"><?= $this->lang->line('Active')?></span>
                                        </div>
										</div>
										
										 <div id="save_result1"></div>
										<div class="col-sm-6 col-md-6" style="padding:0px;">
									<div class="ibox-title">
                                    <h5><?= $this->lang->line('Signature Image')?></h5>
                                </div>
                                        <div class="ibox-content no-padding border-left-right text-center">
                                            <a href="#" onclick="$('#signimag_1').click();return false;">
                                                <img id="signimg" class="img-rounded" src="images/no_avatar.jpg">
                                            </a>
                                            <input type="file" id="signimag_1" name="signimag_1" accept="image/*" class="hide">
                                            <br/><span class="badge badge-success m-t-xs"><?= $this->lang->line('Active')?></span>
											
										
											
                                        </div>
										</div>
									
                                        <div class="ibox-content profile-content">
										<div class="row">
										<div class="col-md-6 col-sm-6">
                                            <div class="form-group has-feedback">
                                                <label for="employee_name" class="control-label"><?= $this->lang->line('Name') ?><sup class="mandatory">*</sup></label>
                                                <input type="text" name="employee_name" id="employee_name" class="form-control required" maxlength="100" value="<?= $employee['name'] ?>">
												
                                            </div>
                                            </div>
											<div class="col-md-6 col-sm-6">
							           <div class="form-group has-feedback"> 
							<label for="nick_name" class="control-label"><?= $this->lang->line('Nick Name') ?><sup class="mandatory">*</sup></label> <input type="text" name="nick_name" id="nick_name" class="form-control required" maxlength="100" value="<?= $employee['nick_name'] ?>">
							                       </div>
							                       </div>
							                       </div>
												   <div class="row">
	<div class="col-md-6 col-sm-6">
	  <div class="form-group has-feedback">
                                                <label for="employee_email" class="control-label"><?= $this->lang->line('Email') ?><sup class="mandatory">*</sup>
												<span class="hover1"><img src="images/if_Help.png" style="width:12px;" >
                                           <span class="hover_text">Employee always need to check email using their mobile phone</span></span>
												</label>
                                                <input type="email" name="employee_email" id="employee_email" class="form-control required email" maxlength="100" value="<?= $employee['email'] ?>">
                                            </div>
</div>	
      <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
											
                                                <label for="birth_date" class="control-label"><?= $this->lang->line('Birth date') ?></label>
												<sup class="mandatory">*</sup>
                                                <input type="text" name="birth_date" id="birth_date" class="form-control datetimepicker required " value="<?= ($employee['birth_date']) ? date($this->config->item('date_format'), strtotime($employee['birth_date'])) : '' ?>" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                            </div>
                                            </div>

													   </div>
                                          
                                            <div class="row">
										  <div class="col-md-6 col-sm-6">
											<div class="form-group">
											
                                                <label for="hired_date" class="control-label"><?= $this->lang->line('Date Hired') ?></label>
												<sup class="mandatory">*</sup>
                                                <input type="text" name="hired_date" id="hired_date" class="form-control datetimepicker" value="<?= ($employee['hired_date']) ? date($this->config->item('date_format'), strtotime($employee['hired_date'])) : '' ?>" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                            </div>
                                            </div>
                                      
											<div class="col-lg-6">
												
                                      <label for="Employee NO" class="control-label"><?= $this->lang->line('Employee NO') ?></label><sup class="mandatory">*</sup>
                                               
      <div class="form-group">
                                                        <input type="text" name="employee_no" id="employee_no" class="form-control required " maxlength="40" value="<?= $employee['employee_no'] ?>">
                                                    </div>
											   </div>
										 <?php
								//print_r($employee_memor); 
									// echo"<pre>";
										//print_r($employee); 
							 //echo"</pre>";
				//die('xvdv');	?>		
                                            </div>
											
											<div class="row">
                                                
                                                <div class="col-lg-7">
                                              
                                                </div>
                                            </div>	

                                              <div class="row">
											   <div class="col-lg-6">
										
                                      <label for="department" class="control-label"><?= $this->lang->line('Department') ?></label>
									    <select name="department" class="form-control country">
                                                <option  value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $employee['department_id']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                                </div>
												  <div class="col-lg-6">
                                            					 <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control-label"><?= $this->lang->line('Hiring Status') ?></label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <select name="employee_memo" id="employee_memo" class="form-control" >
									<option></option>
								
									<?php foreach($employee_memor as $enum_value){   ?>					
										<option value="<?php echo $enum_value['id']; ?>"<?php if($enum_value['id'] ==$employee['status']) echo 'selected="selected"'; ?>><?php echo $enum_value['status']; ?></option>
														
										
									<?php }
									// }?>
									</select>
                                                    </div>
                                                </div>
                                            </div>							
											           </div>
											           </div>
                                      
											  <div class="row">
											  
                                                <div class="col-lg-6">
											  <div class="row">
                                                <div class="col-lg-12">
											
                                                    <label for="employee_ssn" class="control-label"><?= $this->lang->line('SSS No.') ?></label>
														<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
												
                                                        <input type="text" name="employee_ssn" id="employee_ssn" class="form-control required " maxlength="40" value="<?= $employee['ssn'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
											 <div class="col-lg-6">
											    <div class="row">
                                                <div class="col-lg-12">
												
                                                    <label class="control-label"><?= $this->lang->line('TIN No.') ?></label>
													<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" name="employee_tin" id="employee_tin" class="form-control required " maxlength="40" value="<?= $employee['tin'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                         
											 <div class="row">
											  <div class="col-lg-6">
											   <div class="row">
                                                <div class="col-lg-12">
											
                                                    <label class="control-label"><?= $this->lang->line('Pag-Ibig No.') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
													
                                                        <input type="text" name="Pag_Ibig_No" id="Pag_Ibig_No" class="form-control required" maxlength="40" value="<?= $employee['Pag_Ibig_No'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
											 <div class="col-lg-6">
											    <div class="row">
                                                <div class="col-lg-12">
												
                                                    <label class="control-label"><?= $this->lang->line('PhilHealth No.') ?></label><sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
													
                                                        <input type="text" name="employee_healthno" id="employee_healthno" class="form-control required " maxlength="40" value="<?= $employee['healthno'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
											
                                        
                                            <div class="row">
                                                <div class="col-lg-6 ">
												 <div class="row">
												      <div class="col-lg-12">
											
                                                    <label class="control-label"><?= $this->lang->line('Contact No.') ?></label>
														<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
												
                                                        <input type="text" name="employee_contactno" id="employee_contactno" class="form-control required " maxlength="40" value="<?= $employee['contactno'] ?>">
                                                    </div>
                                                </div>
												</div>
												</div>
                                            <div class="col-lg-6 ">
											  <div class="row">
                                                <div class="col-lg-12">
											
                                                    <label class="control-label"><?= $this->lang->line('Contact Person') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
													
                                                        <input type="text" name="employee_contactperson" id="employee_contactperson" class="form-control required " maxlength="40" value="<?= $employee['employee_contactperson'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
											
											<div class="row">
                                                <div class="col-lg-12">
												<div class="row">
                                                <div class="col-lg-12">
											
                                                    <label class="control-label"><?= $this->lang->line('Relation') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
											
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" name="employee_relation" id="employee_relation" class="form-control required " maxlength="40" value="<?= $employee['employee_relation'] ?>">
												
												   </div>
                                                </div>
                                            </div>
                                            </div>
											  <div class="col-lg-12">
											<div class="row">
                                                <div class="col-lg-12">
											
                                                    <label class="control-label"><?= $this->lang->line('Address') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
												
                                                <div class="col-lg-12">
                                                    <div class="form-group">
													
                                                        <textarea name="employee_address" id="employee_address" class="form-control required "><?= $employee['employee_address'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
											
                                            <div class="row">
                                                <!--div class="col-lg-6">
                                              <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control-label text-primary ppppp"><?= $this->lang->line('Contract Ends') ?></label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?php
                                                        $diff = strtotime($employee['contract_expiry']) - strtotime(date('Y-m-d'));
                                                        $days = 0;
                                                        if ($diff > 0) {
                                                            $days = floor($diff / 86400);
                                                        }
                                                        ?>

<input class="form-control ghghghh" type="text" value="<?= $days ?>">

                                                    </div>
                                                </div>
                                                </div>
                                                </div-->
												 <div class="col-lg-6">
												    <div class="row">
                                                <div class="col-lg-12">
												
										
											<!--	<label class="show-edit-ballon control-label"><?//= $this->lang->line('Late time in - Penalty') ?>&nbsp;<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="13%"></span>
													<span class="show-hover-ballon">For employees who timed in late, number of minutes will be added to actual time in as penalty</span></a>
													</label>
													<span style="display:inline-block;font-size:12px; font-weight:bold;margin-left:4px;  color: red;">Min</span>
                                                </div>-->
                                                <!--div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" name="late_time" id="late_time" class="form-control" maxlength="40" value="<?= $employee['late_time'] ?>" style="display:inline-block;">
                                                    </div>
                                                </div-->
                                            </div>
                                            </div>
                                            </div>
											
											  
											
											<!--div class="row">
                                                <div class="col-lg-12">
                                                    <label class="show-edit-ballon-noti control-label"><?= $this->lang->line('Notify-Need attention') ?>&nbsp;
												
													</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group rtytr">
													
													<label class="">
													  <input type="text" name="petteycashliquidate" id="petteycashliquidate" class="form-control" maxlength="40" value="<?php echo $employee['petteycashliquidate'];?>" style=" " >
													  
													 
													</label>
													</div>
												</div>
                                            </div-->
                                            <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_details')">
                                                <i class="fa fa-save"></i>
                                                <?= $this->lang->line('Save') ?>
                                            </button>
                                            <?php
                                            $userdata = $this->session->userdata();
                                            if ($this->user_actions->is_allowed('admin') && $employee['employee_id'] != '1') {
                                                ?>
                                                <a href="employees/set_password/<?= $employee['employee_id'] ?>" class="pull-right m-r-sm m-t-sm" data-target="#modal_window" data-toggle="modal"><?= $this->lang->line('Access') ?></a>
                                                <?php
                                            } elseif ($employee['employee_id'] == '1' && $userdata['employee_id'] == '1') {
                                                ?>
                                                <a href="employees/set_password/<?= $employee['employee_id'] ?>" class="pull-right m-r-sm m-t-sm" data-target="#modal_window" data-toggle="modal"><?= $this->lang->line('Access') ?></a>
                                                <?php
                                            }
                                            ?>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="clearfix"></div>
                    </div>
					   <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Contract')?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>             
                            
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Position')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_positions" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>  
									
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Department')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_positions" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Address')?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            
                            <!--
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Skills')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_skills" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            -->
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Employment')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_employment" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            
                           
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Family')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_family" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Required Documents')?></h5>
                                </div>
                                <div class="ibox-content" id="employees_licenses" style="display: none;">
                                    <?php $this->load->view('layout/info',array('message'=>$this->lang->line('Save employee to enable this tab')))?>
                                </div>
                            </div>
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="pop23456">
    <div class="pop234">
    <div class="modal-dialog modal-sm ">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      
        </div>
        <div class="modal-body pop_up_img" style="">
         <img class="avatar img-rounded" src="<?= $employee['avatar'] ?>" >
        </div>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <style>
  .hover_text { position: absolute; background: #000; color: #fff; padding: 5px 23px; border-radius: 15px;  display: none;  left: 13px;  top: -3px;  white-space: nowrap; z-index:99;}
.hover1:hover > .hover_text { display: block;}	
.hover1 { position:relative;}	

@media only screen and ( max-width:767px){
	
.hover_text{white-space: normal; min-width: 193px; font-size: 11px; padding: 5px 10px;}
	
	
}
  </style>
<?php $this->load->view('layout/footer')?>
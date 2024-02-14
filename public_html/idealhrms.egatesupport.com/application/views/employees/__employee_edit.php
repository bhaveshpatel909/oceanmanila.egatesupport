<?php $this->load->view('layout/header', array('title' => $this->lang->line('Edit employee'), 'forms' => TRUE, 'date_time' => TRUE, 'icheck' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $('.btn-group button').click(function () {
            $('.btn-group button').removeClass('active btn-primary');
            $(this).addClass('active btn-primary');
            $("#employee_gender").val($(this).attr('gender'));
        });

        $("#employee_avatar").change(function () {
            $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('Press Save button and photo will be updated') ?></div>');
        });

        $('.datetimepicker').datetimepicker({pickTime: false});
    });
</script>
<script language="JavaScript">
    Webcam.set({
        width: 320,
        height: 240,
        // device capture size
        dest_width: 320,
        dest_height: 240,
        // final cropped size
        crop_width: 240,
        crop_height: 240,
        image_format: 'jpeg',
        jpeg_quality: 100,
        force_flash: true
    });

    function setup() {
        $('#my_camera').show();
        Webcam.attach('#my_camera');
    }

    function take_snapshot() {
        // take snapshot and get image data
//        Webcam.freeze();
        Webcam.snap(function (data_uri) {
            // display results in page
            $('#avatar_img').attr('src', data_uri);
//            document.getElementById('results').innerHTML =
//                    '<h2>Here is your image:</h2>' +
//                    '<img src="' + data_uri + '"/>';
            var url = 'employees/upload_avatar?employee_id=' + <?= $employee['employee_id'] ?>;
            Webcam.upload(data_uri, url, function (code, text) {
                // Upload complete!
                // 'code' will be the HTTP response code from the server, e.g. 200
                // 'text' will be the raw response content
            });
        });
        Webcam.reset();
        $('#my_camera').hide();
        $('#takephoto').hide();
        $('#openCamera').show();
    }
</script>
<style>

.container34 {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container34 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: -14px;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #ccc;
}

/* On mouse-over, add a grey background color */
.container34:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container34 input:checked ~ .checkmark {
    background-color: grey;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container34 input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container34 .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.show-edit-ballon:hover .show-hover-ballon
{
display:block;	
}
.show-hover-ballon
{
position: absolute;
top: -2px;
color: #fff;

display: none;
background: #000;
padding: 4px 12px;
border-radius: 11px;
width: 400px;
z-index: 999999;
margin-left: 60%;	
}
.show-edit-ballon-noti:hover .show-hover-ballon-noti
{
display:block;	
}

.show-hover-ballon-noti
{
position: absolute;
top: 5px;
color: #fff;

display: none;
background: #000;
padding: 4px 12px;
border-radius: 11px;
width: 300px;
z-index: 999999;
margin-left: 60%;	
}
.button-add
{
	position:relative;
}
.button-add:hover .add-ballon-hover
{
	display:block;
}
.add-ballon-hover
{
position: absolute;
top: -42px;
color: #fff;
right: 0px;
display: none;
background: #000;
padding: 8px 12px;
border-radius: 11px;
z-index: 999999;		
}
.li_hover img { width: 10px;}
.ibox-content.profile-content .has-feedback .form-control { padding-right: 10px;}
.ibox-content.profile-content .row .col-md-6 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row .col-lg-5 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row .col-lg-4 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row .col-lg-6 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row .col-lg-7 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row .col-lg-8 { padding-left: 10px; padding-right: 10px;}
.ibox-content.profile-content .row { margin-left: -10px;  margin-right: -10px;}
form#save_details .row .col-md-6 { padding-left: 10px; padding-right: 10px;}
form#save_details .row .col-md-7 { padding-left: 10px; padding-right: 10px;}
form#save_details .row .col-md-12 { padding-left: 10px; padding-right: 10px;}
form#save_details .row .col-lg-12 { padding-left: 10px; padding-right: 10px;}
form#save_details .row { margin-left: -10px;  margin-right: -10px;}
form#save_details {background: #fff;}
.padd_lft_0{ padding-left:0px;}
.new_div { background: #fefefe; margin: 22px 0px; padding-bottom: 6px; }
.new_div th { background: #fefefe !important; border: 1px solid #dedee2 !important;}
.ibox_title222 {padding-top: 10px;}
.new_div .ibox-title { padding-top: 10px;}
</style>
		<style>
								.navbar-static-top a button i {  margin-right: 6px;}
.dddd h3 span {float: right; width: 100%; text-align: right;    font-size: 13px;}
.new_div .dddd h3 {   width: 67%;    color: #000;}
.new_div {
    background: #fefefe;
    margin: 22px 0px;
    padding-bottom: 0px;
    border: 2px solid #1ab394;
       box-shadow: 0px 1px 2px #908f8f;
}
.new_div22 {
    box-shadow: 0px 1px 2px #847c7c;
    padding-bottom: 6px;
}
.new_div .ibox_title22233 h3 {
    color: #1ab394;
}
.green_bg {
    background: #147c67;
    color: #fff;
    padding: 5px 0px;
    border-radius: 3px;
    min-width: 35px;
    display: inline-block;
    text-align: center;
    margin-right: 7px;
}		
.nes span.mnspan {
    font-size: 16px;
    font-weight: 700;
    text-align: center;
    display: inline-block;
    width: 100%;
}
.nes span.mnspan span {
    font-size: 14px;
}			</style>


<?php $this->load->view('mix/attachment_remove') ?>
<div id="wrapper">
<?php //echo '<pre>';print_r($employee);echo '</pre>'; die('test');?>
<?php if ($employee['is_active'] == 1)
{
	 $this->load->view('layout/menu', array('active_menu' => 'employees'));
}
else
{
     $this->load->view('layout/menu', array('active_menu' => 'inactive_employees'));

}	?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Edit') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Employees') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a target="_blank" href="employees/print_calling_card/<?= $employee['employee_id'] ?>"  class="btn btn-primary" >
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print Card') ?>
                    </a>
                    <a target="_blank" href="employees/print_employee/<?= $employee['employee_id'] ?>"  class="btn btn-primary" >
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print ID') ?>
                    </a>
                </div>
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
                               
                                <div>
                                    <form action="employees/save_employee" id="save_details" method="POST" role="form">

                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">
										<div class="row">
										<div class="col-md-6 col-sm-6">
										 <div class="ibox-title">
                                    <h5><?= $this->lang->line('Details') ?></h5>
                                </div>
                                        <div class="ibox-content no-padding border-left-right text-center">                            
                                            <img class="avatar img-rounded new-img" src="<?= $employee['avatar'] ?>" style="width: 140px;height: 140px; margin: 20px 0;" data-toggle="modal" data-target="#myModal">
											

                                            <!-- imgSelect Container -->
                                            <div id="imgselect_container">
                                                <!-- Upload & Webcam buttons -->
                                                <div class="btn btn-primary imgs-upload">Upload</div> <!-- .imgs-upload -->
                                                <button type="button" class="btn btn-success imgs-webcam">Webcam</button> <!-- .imgs-webcam -->

                                                <!-- Webcam & Crop containers -->
                                                <div class="imgs-webcam-container"></div> <!-- .imgs-webcam-container -->
                                                <div class="imgs-crop-container"></div> <!-- .imgs-crop-container -->

                                                <!-- Action buttons -->
                                                <div>
                                                    <button type="button" class="btn btn-primary imgs-save">Save Image</button> <!-- .imgs-save -->
                                                    <button type="button" class="btn btn-primary imgs-newsnap">New Snapshot</button> <!-- .imgs-newsnap -->
                                                    <button type="button" class="btn btn-primary imgs-capture">Capture</button> <!-- .imgs-capture -->
                                                    <button type="button" class="btn btn-default imgs-cancel">Cancel</button> <!-- .imgs-cancel -->
                                                </div>

                                                <div class="imgs-alert alert"></div> <!-- .imgs-alert -->
                                            </div>
                                            <script>
                                                // Call imgSelect with the container selector
                                                new ImgSelect($('#imgselect_container'), {
                                                    // See the documentation for all the options

                                                    url: 'employees/upload_avatar?employee_id=' + <?= $employee['employee_id'] ?>,
                                                    crop: {
                                                        aspectRatio: 1
                                                    },
                                                    // Upload complete callback: image properties: name, type, url, size, width, height
                                                    uploadComplete: function (image) {
                                                        // Calculate the default selection for the cropper
                                                        var select = (image.width > image.height) ?
                                                                [(image.width - image.height) / 2, 0, image.height, image.height] :
                                                                [0, (image.height - image.width) / 2, image.width, image.width];

                                                        this.crop.setSelect = select;
                                                    },
                                                    // Crop complete callback: image properties: name, type, url, width, height
                                                    cropComplete: function (image) {
                                                        // Set the new src
                                                        $('.avatar').attr('src', image.url + '?' + new Date().getTime());
                                                    },
                                                    /*
                                                     // Send custom data
                                                     data: {
                                                     post_id: 12,
                                                     custom_var: 'Hello'
                                                     }
                                                     */
                                                });
                                            </script>  <?php if ($employee['is_active'] == 1) { ?>
                                                <span class="badge badge-success m-t-xs" id="employee_status"><?= $this->lang->line('Active') ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-default m-t-xs" id="employee_status"><?= $this->lang->line('Inactive') ?></span>
                                            <?php } ?>  </div>
										
									
                                </div>
									<div class="col-md-6 col-sm-6">
											<div class="ibox-title">
                                    <h5>	<label for="sign_image" class="control-label"><?= $this->lang->line('Signature Image') ?></label></h5>
                                </div>
										   <div class="ibox-content no-padding border-left-right text-center">    
                       
                                            <img class="avatar img-rounded" src="<?= $employee['sign'] ?>" style="width: 140px;height: 140px; margin: 20px 0;" data-toggle="modal" data-target="#myModal111">
											

                                            <!-- imgSelect Container -->
                                            <div id="imgselect_container1">
                                                <!-- Upload & Webcam buttons -->
                                                <div class="btn btn-primary imgs-upload">Upload</div> <!-- .imgs-upload -->
                                                <button type="button" class="btn btn-success imgs-webcam">Webcam</button> <!-- .imgs-webcam -->

                                                <!-- Webcam & Crop containers -->
                                                <div class="imgs-webcam-container"></div> <!-- .imgs-webcam-container -->
                                                <div class="imgs-crop-container"></div> <!-- .imgs-crop-container -->

                                                <!-- Action buttons -->
                                                <div>
                                                    <button type="button" class="btn btn-primary imgs-save">Save Image</button> <!-- .imgs-save -->
                                                    <button type="button" class="btn btn-primary imgs-newsnap">New Snapshot</button> <!-- .imgs-newsnap -->
                                                    <button type="button" class="btn btn-primary imgs-capture">Capture</button> <!-- .imgs-capture -->
                                                    <button type="button" class="btn btn-default imgs-cancel">Cancel</button> <!-- .imgs-cancel -->
                                                </div>

                                                <div class="imgs-alert alert"></div> <!-- .imgs-alert -->
                                            </div>
                                            <script>
                                                // Call imgSelect with the container selector
                                                new ImgSelect($('#imgselect_container1'), {
                                                    // See the documentation for all the options

                                                    url: 'employees/upload_sign?employee_id=' + <?= $employee['employee_id'] ?>,
                                                    crop: {
                                                        aspectRatio: 1
                                                    },
                                                    // Upload complete callback: image properties: name, type, url, size, width, height
                                                    uploadComplete: function (image) {
                                                        // Calculate the default selection for the cropper
                                                        var select = (image.width > image.height) ?
                                                                [(image.width - image.height) / 2, 0, image.height, image.height] :
                                                                [0, (image.height - image.width) / 2, image.width, image.width];

                                                        this.crop.setSelect = select;
                                                    },
                                                    // Crop complete callback: image properties: name, type, url, width, height
                                                    cropComplete: function (image) {
                                                        // Set the new src
                                                        $('.avatar').attr('src', image.url + '?' + new Date().getTime());
                                                    },
                                                    /*
                                                     // Send custom data
                                                     data: {
                                                     post_id: 12,
                                                     custom_var: 'Hello'
                                                     }
                                                     */
                                                });
                                            </script>
                                           
                                        </div>
                                        </div>
                                        </div>
										
										
                                        <div class="ibox-content profile-content">
										<div class="row">
										<div class="col-md-12 col-sm-12">
                                            <div class="form-group has-feedback">
                                                <label for="employee_name" class="control-label"><?= $this->lang->line('Name') ?><sup class="mandatory">*</sup></label>
                                                <input type="text" name="employee_name" id="employee_name" class="form-control required" maxlength="100" value="<?= $employee['name'] ?>">
												
                                            </div>
                                            </div>
											<div class="col-md-12 col-sm-12">
							           <div class="form-group has-feedback"> 
							<label for="nick_name" class="control-label"><?= $this->lang->line('Nick Name') ?><sup class="mandatory">*</sup></label> <input type="text" name="nick_name" id="nick_name" class="form-control required" maxlength="100" value="<?= $employee['nick_name'] ?>">
							                       </div>
							                       </div>
							                       </div>
                                            <div class="form-group has-feedback">
                                                <label for="employee_email" class="control-label"><?= $this->lang->line('Email') ?><sup class="mandatory">*</sup>
												<span class="hover1"><img src="images/if_Help.png" style="width:12px;" >
                                           <span class="hover_text">Employee always need to check email using their mobile phone</span></span>
												</label>
                                                <input type="email" name="employee_email" id="employee_email" class="form-control required email" maxlength="100" value="<?= $employee['email'] ?>">
                                            </div>
                                            <div class="row">
											  <div class="col-md-5 col-sm-5">
											<div class="form-group">
											
                                                <label for="hired_date" class="control-label"><?= $this->lang->line('Date Hired') ?></label>
												<sup class="mandatory">*</sup>
                                                <input type="text" name="hired_date" id="hired_date" class="form-control datetimepicker required " value="<?= ($employee['hired_date']) ? date($this->config->item('date_format'), strtotime($employee['hired_date'])) : '' ?>" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                            </div>
                                            </div>
                                            <div class="col-md-7 col-sm-7">
                                            <div class="form-group">
											
                                                <label for="birth_date" class="control-label"><?= $this->lang->line('Birth date') ?></label>
												<sup class="mandatory">*</sup>
                                                <input type="text" name="birth_date" id="birth_date" class="form-control datetimepicker required " value="<?= ($employee['birth_date']) ? date($this->config->item('date_format'), strtotime($employee['birth_date'])) : '' ?>" data-date-format="<?= $this->config->item('js_month_format') ?>">
                                            </div>
                                            </div>
											
                                            </div>
											
											<div class="row">
                                                <div class="col-lg-5">
												
                                      <label for="Employee NO" class="control-label"><?= $this->lang->line('Employee NO') ?></label><sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <input type="text" name="employee_no" id="employee_no" class="form-control required " maxlength="40" value="<?= $employee['employee_no'] ?>">
                                                    </div>
                                                </div>
                                            </div>			
											
                                            <div class="row">
                                            <div class="col-md-5 col-sm-5">
                                            <div class="row">
                                                <div class="col-lg-12" >
                                                    <label class="control-label"><?= $this->lang->line('Gender') ?></label>                                                
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="employee_gender" id="employee_gender" value="<?= $employee['gender'] ?>">
                                                    <div class="btn-group" data-toggle="buttons">
                                                        <button type="button" class="btn btn-circle <?= ($employee['gender'] == 'male') ? 'btn-primary active' : '' ?>" gender="male"><i class="fa fa-male" style="font-size: 19px;"></i></button>
                                                        <button type="button" class="btn btn-circle <?= ($employee['gender'] == 'female') ? 'btn-primary active' : '' ?>" gender="female"><i class="fa fa-female" style="font-size: 19px;"></i></button>
                                                    </div>
                                                </div>
											<div class="clearfix"></div>
                                            </div>
                                            </div>
											<div class="col-md-7 col-sm-7">
											 <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control-label"><?= $this->lang->line('Status') ?></label>
                                                </div>
                                                <div class="col-lg-12 ">
                                                    <div class="form-group">
                                                        <input type="text" name="status" id="status" class="form-control" maxlength="40" value="<?= $employee['status'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
											  <div class="row">
                                                <div class="col-lg-5">
											
                                                    <label for="employee_ssn" class="control-label"><?= $this->lang->line('SSS No.') ?></label>
														<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
												
                                                        <input type="text" name="employee_ssn" id="employee_ssn" class="form-control required " maxlength="40" value="<?= $employee['ssn'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
												
                                                    <label class="control-label"><?= $this->lang->line('TIN No.') ?></label>
													<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <input type="text" name="employee_tin" id="employee_tin" class="form-control required " maxlength="40" value="<?= $employee['tin'] ?>">
                                                    </div>
                                                </div>
                                            </div>
											 <div class="row">
                                                <div class="col-lg-5">
											
                                                    <label class="control-label"><?= $this->lang->line('Pag-Ibig No.') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
													
                                                        <input type="text" name="employee_pag_ibigno" id="employee_pag_ibigno" class="form-control required" maxlength="40" value="<?= $employee['employee_pag_ibigno'] ?>">
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="row">
                                                <div class="col-lg-5">
												
                                                    <label class="control-label"><?= $this->lang->line('PhilHealth No.') ?></label><sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
													
                                                        <input type="text" name="employee_healthno" id="employee_healthno" class="form-control required " maxlength="40" value="<?= $employee['healthno'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5">
											
                                                    <label class="control-label"><?= $this->lang->line('Contact No.') ?></label>
														<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
												
                                                        <input type="text" name="employee_contactno" id="employee_contactno" class="form-control required " maxlength="40" value="<?= $employee['contactno'] ?>">
                                                    </div>
                                                </div>
                                            </div>
											  <div class="row">
                                                <div class="col-lg-5">
											
                                                    <label class="control-label"><?= $this->lang->line('Contact Person') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
													
                                                        <input type="text" name="employee_contactperson" id="employee_contactperson" class="form-control required " maxlength="40" value="<?= $employee['employee_contactperson'] ?>">
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-lg-5">
											
                                                    <label class="control-label"><?= $this->lang->line('Relation') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
											
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <input type="text" name="employee_relation" id="employee_relation" class="form-control required " maxlength="40" value="<?= $employee['employee_relation'] ?>">
												
												   </div>
                                                </div>
                                            </div>
											<div class="row">
                                                <div class="col-lg-5">
											
                                                    <label class="control-label"><?= $this->lang->line('Address') ?></label>	<sup class="mandatory">*</sup>
                                                </div>
												
                                                <div class="col-lg-7">
                                                    <div class="form-group">
													
                                                        <textarea name="employee_address" id="employee_address" class="form-control required "><?= $employee['employee_address'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
											
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <label class="control-label text-primary"><?= $this->lang->line('Contract Ends') ?></label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <?php
                                                        $diff = strtotime($employee['contract_expiry']) - strtotime(date('Y-m-d'));
                                                        $days = 0;
                                                        if ($diff > 0) {
                                                            $days = floor($diff / 86400);
                                                        }
                                                        ?>
                                                        <label class="control-label text-primary"><?= $days ?></label>
                                                    </div>
                                                </div>
                                            </div>
											
											    <div class="row">
                                                <div class="col-lg-5">
												
										
												<label class="show-edit-ballon control-label"><?= $this->lang->line('Late time in - Penalty') ?>&nbsp;<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="13%"></span>
													<span class="show-hover-ballon">For employees who timed in late, number of minutes will be added to actual time in as penalty</span></a>
													</label>
													
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
                                                        <input type="text" name="late_time" id="late_time" class="form-control" maxlength="40" value="<?= $employee['late_time'] ?>" style="width:166px;display:inline-block;"><span style="display:inline-block;font-size:16px; font-weight:bold;margin-left:4px;">Min</span>
                                                    </div>
                                                </div>
                                            </div> 
											
											<div class="row">
                                                <div class="col-lg-5">
                                                    <label class="show-edit-ballon-noti control-label"><?= $this->lang->line('Notify-Need attention') ?>&nbsp;
													<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="13%"></span>
													<span class="show-hover-ballon-noti">Notify employee for pending work or task</span>
													</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <div class="form-group">
													
													<label class="container">
													  <input type="text" name="petteycashliquidate" id="petteycashliquidate" class="form-control" maxlength="40" value="<?php echo $employee['petteycashliquidate'];?>" style="width:164px; margin-left:-14px;" >
													  
													 
													</label>
													</div>
												</div>
                                            </div>
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
								<script>
								$('document').ready(function () {
									//alert('enter');
									$(".searchInput").on("change", function() {
										//alert('enter2');
										var from = $("#frm_dat").val();
										var to = $("#to_dat").val();
											//alert(from);
											//alert(to);
										$(".fbody tr").each(function() {
											var row = $(this);
											var date = row.find("td").eq(0).text();
											//alert(date);
											//show all rows by default
											var show = true;

											//if from date is valid and row date is less than from date, hide the row
											if (from && date < from)
											show = false;
										
											//if to date is valid and row date is greater than to date, hide the row
											if (to && date > to)
											show = false;

											if (show)
											row.show();
											else
											row.hide();
										});
									});
								});
								</script>
								<div class="new_div">
								<div class="new_div22">
								<?php
								// echo'<pre>';
								// print_r($discipline);
								// echo'</pre>';
								?>
						
								
								
									<div class="ibox-title dddd nes">
										<span class="mnspan">Work Evaluation - Performance<br><span><?= $employee['name'] ?></span></span>
									</div>
									<div class="col-lg-6" style="margin:15px 0px">
										<input type="text" name="frm_dat" id="frm_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="From Date">
									</div>
									<div class="col-lg-6" style="margin:15px 0px">
										<input type="text" name="to_dat" id="to_dat" class="form-control datetimepicker searchInput" data-date-format="<?= $this->config->item('js_month_format') ?>" placeholder="To Date">
									</div>
									<div style="clear:both"></div>
									<div class="ibox-title ibox_title222 ibox_title22233">
									<div class="row">
										<div class="col-lg-7">
										<?php
											$tscor=0;
											foreach($evaluations as $evaluation){
											$tscor = $tscor + $evaluation['score'];
											}
											if($tscor < 0){
										?>
											<h3 style=""><span class="green_bg">(<?= $tscor;?>)</span>Work Evaluation </h3>
										<?php }else {?>  
											<h3 style=""><span class="green_bg"><?= $tscor;?></span> Work Evaluation </h3>
										<?php } ?>
										</div>
										<div class="col-lg-5">
											<a href="evaluation/new_evaluation?empid=<?= $employee['employee_id'] ?>&name=<?= $employee['name'] ?>"><button type="button" class="btn btn-primary pull-right">
												<i class="fa fa-plus-circle"></i>
												<?= $this->lang->line('Create') ?>
											</button></a>
											
											<a href="evaluation?id=<?= $employee['employee_id'] ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right:10px">
												<?= $this->lang->line('All') ?>
											</button></a>
										</div>
										</div>
										<div style="clear:both"></div>
									</div>
									<table class="table table-striped table-bordered table-hover data_table" >
										<thead>
											<tr>
                                        
												<th><?= $this->lang->line('Date')?></th>
												<th><?= $this->lang->line('Evaluation Name')?></th>
												<th><?= $this->lang->line('Score Point')?></th>
                                        
											</tr>
										</thead>
										<tbody class="fbody">
											<?php foreach($evaluations as $evaluation){?>
											<tr entity_id="<?= $evaluation['evaluation_id']; ?>">
												<td><?= date('Y-m-d',strtotime($evaluation['date'])) ; ?></td>
												<td><?= $evaluation['reason'];?></td>
												<td><?= $evaluation['score'];?></td>
											</tr>
											<?php }?>
										</tbody>
									</table>
								
							
									<div class="ibox-title  ibox_title22233 ibox_title222">
										<div class="row">
										<div class="col-lg-6">
										<?php
											$tscor=10;
											foreach($discipline as $evaluation){
											$tscor = $tscor - 1;
											}
											if($tscor < 0){
										?>
											<h3 style=""><span class="green_bg">(<?= $tscor;?>)</span>Disciplinary Action </span></h3>
										<?php }else {?>  
											<h3 style=""><span class="green_bg"><?= $tscor;?></span>Disciplinary Action </h3>
										<?php } ?>
										</div>
										<div class="col-lg-6">
											<a href="discipline/new_record?empid=<?= $employee['employee_id'] ?>&name=<?= $employee['name'] ?>"><button type="button" class="btn btn-primary pull-right" onclick="">
												<i class="fa fa-plus-circle"></i>
												<?= $this->lang->line('Create') ?>
											</button></a>
											
											<a href="discipline?id=<?= $employee['employee_id'] ?>"><button type="button" class="btn btn-primary pull-right" style="margin-right:10px">
												<?= $this->lang->line('All') ?>
											</button></a>
										</div>
										</div>
										<div style="clear:both"></div>
									</div>
									<table class="table table-striped table-bordered table-hover data_table" >
										<thead>
											<tr>
                                        
												<th><?= $this->lang->line('Date')?></th>
												<th><?= $this->lang->line('Reason')?></th>
												<th><?= $this->lang->line('Action Taken')?></th>
                                        
											</tr>
										
										</thead>
										<tbody class="fbody">
											<?php foreach($discipline as $evaluation){?>
											<tr entity_id="<?= $evaluation['evaluation_id']; ?>">
												<td><?= date('Y-m-d',strtotime($evaluation['date'])) ; ?></td>
												<td><?= $evaluation['reason'];?></td>
												<td><?= $evaluation['action_taken'];?></td>
											</tr>
											<?php }?>
											
										</tbody>
									</table>
									
									<table class="table table-striped table-bordered table-hover data_table" >
										<thead>
										<div class="col-md-6">
										<div class="ibox_title22233">
										<h3 style="font-weight:bold;clear:both;" ><span class="green_bg">10</span><?= $this->lang->line('Leave Tracking')?></h3>
										</div>
										</div>
											<tr>
                                        
												<th><?= $this->lang->line('Name')?></th>
												<th><?= $this->lang->line('Dates')?></th>
												<th><?= $this->lang->line('Types/Status')?></th>
												
											</tr>
											</thead>
										<tbody>
										 <?php foreach($record as $recod){
								
											  // print_r($recod);
											 
											 
											 
											 // $strrr= $recod['start_time'];
                                      // print_r(explode("",$strrr));
 
											 ?>
											 
									
									
											 
											 
											 
										
									    <tr entity_id="<?= $evaluation['evaluation_id']; ?>">
									
										 <?php if($recod['name']== $employee['name'] ){?>
												<td><?= $recod['name'];?> </td>
												<td><?= $recod['start_time'];?> TO <?= $recod['end_time'];?></td>
											   <td><?= $recod['type'];?>/<?= $recod['status'];?></td>
												
											
											</tr>
										 <?php }}?>
										</tbody>
										
										</table>
									
								</div>
								</div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_contract/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title " id="employees_contract_click">
                                    <h5><?= $this->lang->line('Contract') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_contract"  ajax_link="employees/contract/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/contract', $contracts) ?>
                                </div>
                            </div> 
							
                            <div class="ibox float-e-margins">
                                <a class="button-add pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_license/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									<span class="add-ballon-hover">Include High Resolution Picture</span>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_licenses_click">
                                    <h5><?= $this->lang->line('Required Documents') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_licenses"  ajax_link="employees/licenses/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/licenses', $licenses) ?>
                                </div>
                            </div>
                            
                            <div class="ibox float-e-margins">
                                <a class="button-add pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_performance/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									<span class="add-ballon-hover">Upload signed Memo, Warning, Disciplinary & Corrective Action document here</span>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_performances_click">
                                    <h5><?= $this->lang->line('Employee Performance Memo, Disciplinary & Corrective Action signed by Employee') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_performances"  ajax_link="employees/performances/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/performances', $performances) ?>
                                </div>
                            </div>
                             <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_education/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Benefit History') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_education" style="display: none;" ajax_link="employees/education/<?= $employee['employee_id'] ?>"></div>
                            </div>
                            <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_assetbenefit/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_assetbenefits_click">
                                    <h5><?= $this->lang->line('Assets & Benefits') ?></h5>
									<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="2%"></span>
									<span class="hover_button" style="margin-left: 7%;">This is for the issued company properties to employee for  company use. Employee need to return all company property before they can receive final salary.</span></a>
									<p class="move-too">To be returned before issuing final salary</p>
									<style>
									.move-too
									{
									color: #428bca;
										position: absolute;
										right: 100px;
										margin-top: -22px;
									}
									
									.baloon-msg {

										

									}
									</style>
                                </div>
                                <div class="ibox-content" id="employees_assetbenefits"  ajax_link="employees/assetbenefits/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/assetbenefits', $assetbenefits) ?>
									
                                </div>
                            </div>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Position') ?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <form action="employees/save_position" id="save_position" method="POST" role="form">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">

                                        <div class="col-lg-6 no-padding form-group">
                                            <select name="position_id" id="position_id" class="form-control required">
                                                <option value="">Select Position</option>
                                                <?php foreach ($positions as $position) { ?>
                                                    <option <?php echo ($position['position_id'] == $employee['position_id']) ? 'selected' : '' ?> value="<?= $position['position_id'] ?>"><?= $position['position_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="clearfix"></div>
                                        <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_position')">
                                            <i class="fa fa-save"></i>
                                            <?= $this->lang->line('Save') ?>
                                        </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>

                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Department') ?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <form action="employees/save_department" id="save_department" method="POST" role="form">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">

                                        <div class="col-lg-6 no-padding form-group">
                                            <select name="department_id" id="department_id" class="form-control required">
                                                <option value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $employee['department_id']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="clearfix"></div>
                                        <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_department')">
                                            <i class="fa fa-save"></i>
                                            <?= $this->lang->line('Save') ?>
                                        </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>

                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Address') ?></h5>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <form action="employees/save_address" id="save_address" method="POST" role="form">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">
                                        <div class="form-group">
                                            <label for="employee_address" class="control-label"><?= $this->lang->line('Address') ?></label>
                                            <input type="text" name="employee_address" id="employee_address" class="form-control" value="<?= $employee['address'] ?>" maxlength="100">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-5 form-group" style="padding-left: 0;">
                                            <label for="employee_city" class="control-label"><?= $this->lang->line('City') ?></label>
                                            <input type="text" name="employee_city" id="employee_city" class="form-control" value="<?= $employee['city'] ?>" maxlength="100">
                                        </div>
                                        <div class="col-lg-4 form-group" style="padding-left: 0;">
                                            <label for="employee_state" class="control-label"><?= $this->lang->line('State') ?></label>
                                            <input type="text" name="employee_state" id="employee_state" class="form-control" value="<?= $employee['state'] ?>" maxlength="100">
                                        </div>
                                        <div class="col-lg-3 form-group" style="padding-left: 0;">
                                            <label for="employee_zip" class="control-label"><?= $this->lang->line('Zip') ?></label>
                                            <input type="text" name="employee_zip" id="employee_zip" class="form-control" value="<?= $employee['zip_code'] ?>" maxlength="10">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-6 form-group" style="padding-left: 0;">
                                            <label for="employee_phone" class="control-label"><?= $this->lang->line('Phone') ?></label>
                                            <input type="tel" name="employee_phone" id="employee_phone" class="form-control" value="<?= $employee['phone'] ?>" maxlength="100">
                                        </div>
                                        <div class="col-lg-6 form-group" style="padding-left: 0;">
                                            <label for="employee_cell_phone" class="control-label"><?= $this->lang->line('Cell') ?></label>
                                            <input type="text" name="employee_cell_phone" id="employee_cell_phone" class="form-control" value="<?= $employee['cell_phone'] ?>" maxlength="100">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-lg-12 form-group" style="padding-left: 0;">
                                            <label for="contacts" class="control-label"><?= $this->lang->line('Emergency contacts') ?></label>
                                            <textarea rows="4" name="contacts" id="contacts" class="form-control"></textarea>
                                        </div>
                                        <div class="clearfix"></div>
                                        <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_address')">
                                            <i class="fa fa-save"></i>
                                            <?= $this->lang->line('Save') ?>
                                        </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>

                            <!--
                                                        <div class="ibox float-e-margins">
                                                            <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/edit_skills/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                                                <i class="fa fa-edit"></i>
                            <?= $this->lang->line('Edit') ?>
                                                            </a>
                                                            <div class="ibox-title collapse-link">
                                                                <h5><?= $this->lang->line('Skills') ?></h5>
                                                            </div>
                                                            <div class="ibox-content" id="employees_skills" style="display: none;" ajax_link="employees/skills/<?= $employee['employee_id'] ?>"></div>
                                                        </div>
                            -->
                            <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_employment/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Employment') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_employment" style="display: none;" ajax_link="employees/employment/<?= $employee['employee_id'] ?>"></div>
                            </div>

                           

                            <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_relative/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Relative Contact Person') ?></h5>
									<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="2%"></span>
									<span class="hover_button" style="margin-left: 7%;">Add employee's contact person here and attach document that proves that person's relation to the employee</span></a>
                                </div>
                                <div class="ibox-content" id="employees_family" style="display: none;" ajax_link="employees/relatives/<?= $employee['employee_id'] ?>"></div>
                            </div>
         <!-- /*****************************Quit claim**********************************/-->
      
                                 <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_claim/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									
                                </a>
                                <div class="ibox-title collapse-link" id="employees_claims_click">
                                    <h5><?= $this->lang->line('Quit Claim') ?></h5>
									<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="2%"></span>
									<span class="hover_button" style="margin-left: 2%;">If Quit Claim is already signed by employee. Attach the file here.</span></a>
                                </div>
                                <div class="ibox-content" id="employees_claims"  ajax_link="employees/claims/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/claim', $claims) ?>
                                </div>

                            </div>
   <!-- /*****************************Quit claim end**********************************/-->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
  

 

  <!-- Modal -->
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
    <div class="modal fade" id="myModal111" role="dialog">
    <div class="pop23456">
    <div class="pop234">
    <div class="modal-dialog modal-sm ">
      <div class="modal-content ">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      
        </div>
        <div class="modal-body pop_up_img" style="">
         <img class="avatar img-rounded" src="<?= $employee['sign'] ?>" >
        </div>
     
      </div>
      </div>
      </div>
    </div>
  </div>


<?php
$this->load->view('layout/footer')?>


<style>
.pop23456 {
    position: relative;
    padding: 0;
    top: 0;
    left: 0;
    width: auto;
    overflow: hidden;
    height: 100%;
    display: table;
    margin: auto;
}
.pop234 {
    display: table-cell;
    vertical-align: middle;
    text-align: center;    width: 400px;
}
.modal-dialog.modal-sm {
    width: 400px;
}
.modal-header {
    border-bottom: 0px;
    padding: 0px 15px;
    display: none;
}
.pop_up_img  {   }
.pop_up_img img {
    width: 100%;width: 400px;
}
.modal-body.pop_up_img {
    padding: 0px;
}
.hover_text { position: absolute; background: #000; color: #fff; padding: 5px 23px; border-radius: 15px;  display: none;  left: 13px;  top: -3px;  white-space: nowrap; z-index:99;}
.hover1:hover > .hover_text { display: block;}	
.hover1 { position:relative;}	

@media only screen and ( max-width:767px){
	
.hover_text{white-space: normal; min-width: 193px; font-size: 11px; padding: 5px 10px;}
	
	
}

	
</style>





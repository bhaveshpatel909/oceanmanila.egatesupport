<?php $this->load->view('layout/header', array('title' => $this->lang->line('Edit employee'), 'forms' => TRUE, 'date_time' => TRUE, 'icheck' => TRUE)) ?>
<script>
    $('document').ready(function () {
	
        $('.btn-group-1 button').click(function () {
            $('.btn-group-1 button').removeClass('active btn-primary');
            $(this).addClass('active btn-primary');
            $("#employee_gender").val($(this).attr('gender'));
        });

        $("#employee_avatar").change(function () {
            $("#save_result").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('Press Save button and photo will be updated') ?></div>');
        });
		
		  $("#signimag_1").change(function(){
           $("#save_result1").html('<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('Press Save button and photo will be updated')?></div>');
        })
		

        $('.datetimepicker').datetimepicker({pickTime: false});
    });
	
	function msend(id){
		var burl ="<?php echo base_url();?>";
			$.ajax({
            type: 'post',
			cache: false,
            url: burl+'discipline/send_mail/'+id,
           data : 'mid='+ id,
            success: function (response) {
				console.log(response);
              alert('Mail sent successfully');
            }
          });
		  
		}
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
.ibox.float-e-margins.fgertgr { margin-top: 20px;}
.green_bg p:last-child { color: #cecaca !important;padding-left: 0px;}
.green_bg p {  display: inline-block;    margin-bottom: 0px;    padding: 0px 5px;}
form#save_password ul {  border-bottom: 1px solid #e5e5e5;  padding-bottom: 15px !important;}
ul.unstyled.no-padding.m-t-sm .checkbox input[type=checkbox]{margin-left: 0px; margin-right:14px;}
div#permissions_tab b { font-weight: normal;}
.ccd .btn { padding: 6px 10px; margin-top:26px;}
span.imgbx {  height: 140px;  display: inline-block;  width: 100%;}
form#save_details .badge { border-radius: 3px; font-size: 18px; padding: 10px; margin-bottom:18px;}
.cstmcls { text-align: center; padding-top: 49px;}
.rtytr label { width: 100%;}
.bgsome {float: left; background: #428bca;  color: #fff; padding: 5px;}
.btnoknot { float: right;}
span.btnoknot a span { color: #f2720c;}
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
.new_div { background: #fefefe; margin: 22px 0px; padding-bottom: 6px; margin-top:0px; }
.new_div th { background: #fefefe !important; border: 1px solid #dedee2 !important;}
.ibox_title222 {padding-top: 10px;}
.new_div .ibox-title { padding-top: 10px;}

.new_div22 {
       border: 1px solid #1ab394;
    padding: 1px;
    box-sizing: border-box;
}
</style>
		<style>
.new_imges a { background: #ff6600; border-color: #ff6600;}		
.navbar-static-top a button i {  margin-right: 6px;}
.dddd h3 span {float: right; width: 100%; text-align: right;    font-size: 13px;}
.new_div .dddd h3 {   width: 67%;    color: #000;}
.new_div { background: #fefefe; margin: 22px 0px;  padding-bottom: 0px; 
       box-shadow: 0px 1px 2px #908f8f; margin-top:0px;}
.new_div22 {    box-shadow: 0px 1px 2px #847c7c;    padding-bottom: 6px;}
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
}	
.new_imges img {

}
p#profile_img {
    background: red;
   
   
}
p#profile_img1 {
    background: #000;
 
  color:#fff;
}

.new_imges {
    FLOAT: LEFT;
    width: 100%;
    text-align: center;
    margin-top:20px;
}
label.confrm_btn {padding-top: 7px; margin-bottom: 0px; width: 100%; padding-right: 5px;    background: #428bca;}
.data_label { padding-top: 10px;}
.new_id p { display:inline-block; width: auto;  text-align: center;  padding:3px 8px;    color: #fff;}
.new_id span { margin-left: 10px; color: #fff;  font-weight: normal;    padding-top: 4px; }
a.btn.btn-primary.btn_new {
    margin-bottom: 4px;
}
.cstmcls label {
    text-transform: uppercase;
    color: #bbb;
    font-size: 17px;
}
.title-action.np_paddtp { padding-top: 20px; text-align: center;}
.image_btmtxt {
    float: left;
    width: 100%;
    font-size: 17px;
    margin: 10px 0px;
    font-weight: 600;
    color: #bbb;
    text-transform: uppercase;
}
.new_imges img {
    width:140px;
}
.badge{ font-size:14px;}
.new_id span#employee_status { color: #fff; margin-left: 0px;}
.new_id {float: right; font-size: 14px; width:100%;    font-family: arial;
    font-weight: normal;}
.new_id span span { margin-left: 0px;  color: #ffffff;}
.to_confirm { float: right;    padding-right: 5px;}
.rrrrrr1 {border-radius: 0px;}
span.to_confirm span.anyelow, span.to_confirm span.anyelow span { color: yellow;}
.tablesty td.scrr { width: 74px; text-align: center;}
.prw {width: 54px; text-align: center;}
.wfix { width: 150px; text-align: center;}
td.prw.prw22 a.btn.btn-outline.btn-success {
    padding: 1px 5px;
    color: #1AB394;
    border-color: #1AB394;
}

		</style>


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
            <div class="col-lg-3">
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
			<div class="col-lg-7">
			<div class="row">
		

	<div class="col-lg-5 txt233">
	</div>
			</div>
			</div>
            <div class="col-lg-2">
                <div class="title-action">
                    <a target="_blank" href="employees/print_calling_card/<?= $employee['employee_id'] ?>"  class="btn btn-primary btn_new" >
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print Card') ?>
                    </a>
                    <a target="_blank" href="employees/print_employee/<?= $employee['employee_id'] ?>"  class="btn btn-primary " >
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
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                               
                                <div>
                                    <form action="employees/save_employee" id="save_details" method="POST" role="form">

                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">
										<div class="row">
										<div style="display:none;" class="col-md12 col-sm-12">
									
											
											
										<label class="confrm_btn">
	  <span class="checkmark"></span>
	
	  <div class="new_id">
	  
	  <span>If your details are correct click</span>
	 
	
	  
	  <img id="profile_img" onclick="profile_image(<?= $employee['employee_id'] ?>)" style="cursor:pointer;  width: 24px; margin-bottom: 5px;" 
	  src="<?php echo base_url();?>/files/logo/okay22.png">
	  
	 
	   <span>to confirm</span>
	  <span class="to_confirm">
	
	  
	 
	  
	  <a href="mailbox/compose_adminmail">  
   <span>If not, inform to admin email</span>
   <img id="profile_img1" value="<?= $employee['employee_id'] ?>" style="width: 29px;    margin-left: 5px;" src="<?php echo base_url();?>/files/logo/emailicn22.png">
  
  </a>
  <?php  if($employee['confirm_date_pp']){?><span class="anyelow">Updated : <span><?php echo $employee['confirm_date_pp'] ;?></span></span><?php } ?>	 
  <!--
 <//?php 
$pre_url =$_SERVER['HTTP_REFERER'];
 if($pre_url=="http://uplushrms.peza.com.ph/request/processcallingcard"){
 ?>
   <a href="request/processcallingcard">
  <p id="profile_img1" style="float:left; width:100%;    max-width: 100px; background:#1AB394;">Go Back</p>
  
  
  
  </a>
 <?//php } ?>
 -->
 </span>
</div>
</label>		</div>
										
										
										 
											<div style="display:none;" class="col-lg-5">
											
											<div class="row">
			
			<div class="new_imges">
	
	<div class="col-lg-6">
	<span class="imgbx">
	<?php
	//echo $employee['copy_avatar'];
	$xyz="/home1/pezacomph/public_html/uplushrms/system/../".$employee['copy_avatar'];
	//echo $xyz;
	
	 // print_r($employee);
	 
	  $directory = BASEPATH . '../files/ID_image/pic/';
                                              $files = glob($directory . '*');
	$k=0;
	//print_r($files);
	
	foreach($files as $file)
	{
		
		if($file==$xyz)
		{
			$k++;
		}
		
	}
		// echo $k;								 
	// die();
	?>
	<?php if($k>0){?>
	<img class="avatar img-rounded" src="<?= $employee['copy_avatar'] ?>" title="This is your ID card Profile Image1" style="" data-toggle="modal" data-target="#myModal"><?php } else { ?>
	
	
	 <img src="images/no_avatar.jpg" width="13%" title="This is your ID card Profile Image2">
	 
	
	<?php } ?>
	</span>
	<span class="image_btmtxt">ID Picture</span>
	
	  <div class="title-action np_paddtp">
                    <a target="_blank" href="employees/print_calling_card/<?= $employee['employee_id'] ?>"  class="btn btn-primary btn_new" >
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print Card') ?>
                    </a>
                   
                </div>
	
	
	
	</div>
	<?php
	
	// print_r($employee);
	// die();
	
	?>
	
	<div class="col-lg-6"><span class="imgbx">
	<?php if($employee['copy_sign']=="-" || $employee['copy_sign']=="" || $employee['copy_sign']=="_"){ ?>
       <img class="avatar img-rounded" title="This is your ID card Signature Image" 
	   src="images/dummy1.png" style="" data-toggle="modal" data-target="#myModal111"><?php } else { ?>
	<img class="avatar img-rounded" title="This is your ID card Signature Image1" src="<?= $employee['copy_sign'] ?>" style="" data-toggle="modal" data-target="#myModal111">
	<?php } ?>
	</span>
	
		<span class="image_btmtxt">Signature</span>
	  <div class="title-action np_paddtp">                   
                    <a target="_blank" href="employees/print_employee/<?= $employee['employee_id'] ?>"  class="btn btn-primary " >
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print ID') ?>
                    </a>
                </div>
	
	
		</div>
	
 <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">
<script>
$(document).ready(function(){
 $("select.country").change(function(){
       var slectet   =($(this).val());
	   var number=document.getElementById("employee_id").value;  
	   //alert(number);
	     $.ajax({
			   type: 'POST',
	     url:'employees/save_department1?empl='+number+'&department='+slectet,
        
        success: function(response) {
			//alert(response);
           
        }
   });
});


    $("#sign_img").click(function(){
		var id=($(this).val());
    
		   $.ajax({
			   type: 'POST',
        url: 'employees/update_sin?sign='+id,
        
        success: function(response) {
           
        }
    });
    });

});
</script>
<script>
function profile_image(id){
	
	$.ajax({
		type: 'POST',
        url: 'employees/confirm_pro?pro='+id,
        
        success: function(response) {
			alert(response);
           location.reload();
        }
    });
	
}

</script>
</div>
 </div>
</div>  </div> 
<div class ="newadd">
							<div class="row">
							    
							    <div class="col-lg-4" title="Picture should be lasted Photo with good resulution . It will also used for company ID Picture , Do not use picture from resume.  Take picture using phone application.">
							        <div class="uploade-menu">
									<?php if($employee['avatar']){ ?>                         
                                            <img class="avatar img-rounded " src="<?= $employee['avatar'] ?>" style="width: 140px;height: 140px;  border-radius:6px;" data-toggle="modal" data-target="#myModal">
										 <?php }
										 else
										 {
											 ?>
											  <img class="avatar img-rounded " src="files/avatars/blank-person.jpg" style="width: 140px;height: 140px;  border-radius:6px;" data-toggle="modal" data-target="#myModal">
											 <?php
											 }
										 ?>
							            <div class="row">
							            <div class="col-lg-12">
							                 <div class="button-uploade-1">
							                 <div id="imgselect_container">
                                                <!-- Upload & Webcam buttons -->
                                                <div class="btn btn-primary imgs-upload new-p">Upload</div> <!-- .imgs-upload -->
                                                <button type="button" class="btn btn-success imgs-webcam new-p-1">Webcam</button> <!-- .imgs-webcam -->

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
                                            </script> 
							                 </div>
							            </div>
							        </div>
							        </div>
							      
							    </div>
							    
							    
							    <div class="col-lg-4"  title="Picture should be lasted Photo with good resulution . It will also used for company ID Picture , Do not use picture from resume.  Take picture using phone application.">
							        <div class="uploade-menu upnew">
									 <?php 
											  
											  if($employee['sign']){ ?>
                                            <img class="avatar img-rounded" src="<?= $employee['sign'] ?>" style="width: 140px;height: 140px;  border-radius:6px;" data-toggle="modal" data-target="#myModal111">
											  <?php } else { ?>

											 <img class="avatar img-rounded " src="files/avatars/blank-person.jpg" style=width: 140px;height: 140px;  border-radius:6px;" data-toggle="modal" data-target="#myModal">
											  <?php } ?>
							         <div class="row">
							            <div class="col-lg-12">
							                <div class="button-uploade-1">
							                  <div id="imgselect_container1">
                                                <!-- Upload & Webcam buttons -->
                                                <div class="btn btn-primary imgs-upload new-p">Upload</div> <!-- .imgs-upload -->
                                                <button type="button" class="btn btn-success imgs-webcam new-p-1">Webcam</button> <!-- .imgs-webcam -->

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
							        </div>
							       
							    </div>
							    
							    <div class="col-lg-4">
	                                <div class="value-text">
									
									<div class="row">
									<div style="padding-left: 10px;"class="col-lg-3">
									<div class="gender-11">
                                    <label class="control-label">Gender</label>
									</div>
									</div>
									<div style="padding:0px;"class="col-lg-8">
                                                    <div class="btn-group-1" data-toggle="buttons">
                                                        <button type="button" class="rrrrrr1 btn btn-circle <?= ($employee['gender'] == 'male') ? 'btn-primary active' : '' ?>" gender="male"><i class="fa fa-male" style="font-size: 19px;"></i></button>
                                                        <button type="button" class=" rrrrrr1 btn btn-circle <?= ($employee['gender'] == 'female') ? 'btn-primary active' : '' ?>" gender="female"><i class="fa fa-female" style="font-size: 19px;"></i></button>
                                                    </div>
													</div>
									</div>
	                                       	 <div class= "value-2">
									<?php foreach ($positions as $position) { 
                                                   if($position['position_id'] == $employee['position_id'])
												   {
													   ?><span class="neww" style="color:#ff0000;">
													       <span class="d-22">Position:</span>
													   <?php
													 echo   $position['position_name'];
													 ?>
													 </span>
													 <?php
												   }
												  else
									{
									?>
									
<?php									
									}
									}
									
									foreach($groups as $group) { 
									if($group['group_id'] == $employee['group_id'])
									{
										?>
										<span class="neww-1" style="color:#ff0000;">
										    <span class="d-22">Group:</span>
										<?php echo $group['group_name'];
										?>
										</span>
										<?php
									}
									else
									{
									?>
									
<?php									
									}
									}
									foreach($departments as $department) { 
									if($department['department_id'] == $employee['department_id'])
									{
										?>
										<span class="neww-2"style="color:#ff0000;">
										    <span class="d-22">Department:</span>
										<?php echo $department['department_name'];
										?>
										</span>
										<?php
									}
									else
									{
									?>
									
<?php									
									}
									}?>
													  
                                                </div>	
	                                </div>						        
							    </div>
							    
							 
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
							<label for="nick_name" class="control-label"><?= $this->lang->line('Nick Name') ?><sup class="mandatory">*</sup>(Surname)</label> <input type="text" name="nick_name" id="nick_name" class="form-control required" maxlength="100" value="<?= $employee['nick_name'] ?>">
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
                                            					 <div class="row">
                                                <div class="col-lg-12">
                                                    <label class="control-label"><?= $this->lang->line('Hiring Status (Type Of Hiring)') ?></label>
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
											<div class="col-lg-6">
												
                                      <label for="Employee NO" class="control-label"><?= $this->lang->line('Employee NO') ?></label><sup class="mandatory">*</sup>
                                               
      <div class="form-group">
                                                        <input type="text" name="employee_no" id="employee_no" class="form-control required " maxlength="40" value="<?= $employee['employee_no'] ?>">
                                                    </div>
													
											   </div>
											   <div class="col-lg-6">
												<label title=" Extra Information Data Field"for="Employee NO" class="control-label"><?= $this->lang->line('Internal  ID NO#') ?></label><sup class="mandatory">*</sup>
                                               
      <div class="form-group">
                                                        <input type="text" name="internal_id_no" id="internal_id_no" class="form-control required " maxlength="40" value="<?= $employee['internal_id_no'] ?>">
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
											   <div class="col-lg-12">
										
                                      <label for="department" class="control-label"><?= $this->lang->line('Department') ?></label>
									    <select name="department" class="form-control country">
                                                <option  value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $employee['department_id']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select>
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
											
                                                    <label title="Person to contact at emergency" class="control-label"><?= $this->lang->line('Contact Person') ?></label>	<sup class="mandatory">*</sup>
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
                                                <div class="col-lg-12">
                                              <div class="row">
                                                <div class="col-lg-12">
                                                    <label title="Remaining days to end contract" class="control-label text-primary ppppp"><?= $this->lang->line('Remaining days to end contract') ?></label>
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
                                                </div>
												 <div style="display:none;" class="col-lg-6">
												    <div class="row">
                                                <div class="col-lg-12">
												
										
												<label class="show-edit-ballon control-label"><?= $this->lang->line('Late time in - Penalty') ?>&nbsp;<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="13%"></span>
													<span class="show-hover-ballon">For employees who timed in late, number of minutes will be added to actual time in as penalty</span></a>
													</label>
													<span style="display:inline-block;font-size:12px; font-weight:bold;margin-left:4px;  color:red;">Min</span>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input type="text" name="late_time" id="late_time" class="form-control" maxlength="40" value="<?= $employee['late_time'] ?>" style="display:inline-block;">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
											
											  
											
											<div class="row">
                                                <div class="col-lg-12">
                                                    <label class="show-edit-ballon-noti control-label"><?= $this->lang->line('Short notes for employee') ?>&nbsp;
													<a class="li_hover"><span class="baloon-msg li_hover"><img src="images/if_Help.png" width="13%"></span>
													</label>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group rtytr">
													
													<label class="">
													  <input type="text" name="petteycashliquidate" id="petteycashliquidate" class="form-control" maxlength="40" value="<?php echo $employee['petteycashliquidate'];?>" style=" " >
													  
													 
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
                                            if ($this->user_actions->is_allowed('Employees') && $employee['employee_id'] != '1') {
                                                ?>
                                                <a href="employees/set_password/<?= $employee['employee_id'] ?>" class="pull-right m-r-sm m-t-sm button-new" data-target="#modal_window" data-toggle="modal"><?= $this->lang->line('Access') ?></a>
                                                <?php
                                            } elseif ($employee['employee_id'] == '1' && $userdata['employee_id'] == '1') {
                                                ?>
                                                <a href="employees/set_password/<?= $employee['employee_id'] ?>" class="pull-right m-r-sm m-t-sm" data-target="#modal_window" data-toggle="modal"><?= $this->lang->line('Access') ?></a>
                                                <?php
                                            }
                                            ?>
											<div class="pull check-1" style="font-size:18px; margin:7px 10px 0px 0px;">
						<span style="color:#676a6c; font-weight:600;"class="this">	Is This Regular Employee? <input type="checkbox" name="is_regular" value ="1" <?php if($employee['is_regular']=='1'){echo "checked=checked";}?>></span>
							</div>
                                            <div class="clearfix emplyor"></div>
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
								        <div class="ibox float-e-margins fgertgr">
                                <a class="button-add pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_license/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									<span class="add-ballon-hover">Include High Resolution Picture</span>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_licenses_click">
                                    <h5><?= $this->lang->line('Required Documents ( 201 Files )') ?></h5>
                                </div>
                                <div class="ibox-content" id="employees_licenses"  ajax_link="employees/licenses/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/licenses', $licenses) ?>
                                </div>
                            </div>
							
							


					   </div>
                        </div>
                        <div class="col-lg-6">
													
								<div class="new_div">
								<div class="new_div22">
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
											} ?>
										
											<h3 style=""><span title="Work Evaluation" class="green_bg"><?= $count;?></span><span title="This is for keeping records of Employee Performance">Work Evaluation</span> <img src="images/if_Help.png" title="
1. Click create
2. Select Evaluation Category
3. Select Evaluation Name
4. Click Save" style="width:17px; cursor:pointer;"> </h3>
										
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
									<table class="tablesty table table-striped table-bordered table-hover data_table" >
										<thead>
											<tr>
                                        
												<th style="width:107px;"><?= $this->lang->line('Date')?></th>
												<th><?= $this->lang->line('Evaluation Name')?></th>
												<th style="text-align:center;"><?= $this->lang->line('Score')?></th>	
												<th><?= $this->lang->line(' ')?></th>
                                        
											</tr>
										</thead>
										<tbody class="fbody">
											<?php foreach($evaluations as $evaluation){?>
											<tr entity_id="<?= $evaluation['evaluation_id']; ?>">
												<td><?= date('Y-m-d',strtotime($evaluation['date'])) ; ?></td>
												<td><?= $evaluation['reason'];?></td>
												<td class="scrr"><?= $evaluation['score'];?></td>
												<td style="text-align:center;" class="prw">
			<a target="_blank" title="Print evaluation report" type="application/pdf" class="btn btn-outline btn-primary btn-xs" href="evaluation/preview_evaluation/<?= $evaluation['evaluation_id']?>" download="<?php echo base_url('files/attachments/' . $attachment['file']) ?>" target="_blank">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
											<a class="btn btn-outline btn-primary btn-xs" href="javascript:void(0);" onclick="msend_evaluation(<?php echo $evaluation['evaluation_id'];?>)">
												<img title="Send reminder email to employee for evaluation"src="<?php echo base_url();?>/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"></a>	</td>
												
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
											<h3 style=""><span title="Disciplinary Warning" class="green_bg">(<?= $displain;?>)</span>Disciplinary Action </span></h3>
										<?php }else {?>  
											<h3 style=""><span  title="Disciplinary Warning" class="green_bg"><?= $displain;?></span><span title="This is for the keeping of all issued reprimand and corrective action memo to employee">Disciplinary Action </span><span><img src="images/if_Help.png" title="
1. Click create
2. Select Disciplinary Category
3. Select Reason
3. Select Action Taken
4. Click Save" style="width:17px; cursor:pointer;"></span></h3>
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
									<table class="dfdf table table-striped table-bordered table-hover data_table" >
										<thead>
											<tr>
                                        
												<th style="width:106px;"><?= $this->lang->line('Date')?></th>
												<th><?= $this->lang->line('Reason')?></th>
												<th><?= $this->lang->line('File')?></th>
												<th style="text-align:center;"><?= $this->lang->line('Action Taken')?></th>
												<th style="text-align:center;"><?= $this->lang->line('File')?></th>
												
                                        
											</tr>
										
										</thead>
										<tbody class="fbody">
											<?php foreach($discipline as $evaluation){
												
												
												
												?>
											<tr entity_id="<?= $evaluation['evaluation_id']; ?>">
												<td><?= date('Y-m-d',strtotime($evaluation['date'])) ; ?></td>
												<td><?= $evaluation['reason'];?></td>
												<td> 
				<?php foreach ($evaluation['attachments'] as $attachment) {?>
							  <?php if (strpos($attachment['mime'], 'image') === false) { ?>
							  <a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']);?>" download="<?php echo base_url('files/attachments/' . $attachment['file']) ?>" target="_blank">
<i style='color: red;cursor: pointer;' title="<?php echo $attachment['file'];?>" class="fa fa-file-pdf-o"> &nbsp;</a></i>
							  <?php  } }?>
							
							  
							  
							  
							  </td>
												
												<td class="wfix"><?= $evaluation['action_taken'];?></td>
												<td  style="width:83px;text-align:center;"> 
												 <a target="_blank" title="<?php echo $evaluation['name']; ?><?php echo $evaluation['record_id']; ?><?php echo ".pdf"; ?>" class="btn btn-outline btn-primary btn-xs" href="discipline/preview_record/<?= $evaluation['record_id']; ?>">
                                                    <i class="fa fa-file-pdf-o" alt="<?php echo $evaluation['name']; ?><?php echo $evaluation['record_id']; ?><?php echo ".pdf"; ?>"></i>
													</a>
								<a class="btn btn-outline btn-primary btn-xs" href="javascript:void(0);" onclick="msend(<?php echo $evaluation['record_id'];?>)">
												<img src="http://uplushrms.peza.com.ph/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"></a>				
							
							  
													</td>
											</tr>
											<?php }?>
											
										</tbody>
									</table>
									
									<table class="table table-striped table-bordered table-hover data_table" >
										<thead>
										<div class="col-md-12">
										<div class="ibox_title22233 two-boxes">
										<div class="col-sm-5 col-md-5">
										<h3 style="font-weight:bold;clear:both;" ><span class="green_bg"><p title="Approved Leave"><?= $get_leave?> / <p style="color:red" title="Request Leave"><?= $get_leave2?></p></span><span title="This is for the storage and monitoring of employees Leave requests"><?= $this->lang->line('Leave Tracking')?></span><span><span><img title="
1. Go to Leave Tracking menu, then to Leave Request
2. Click add
3. Enter details (Employee, Start/End Time, Leave Type, Details). Then click Save
4. Wait for the admin to approve your request
5. You can also create Printable Leave Form to sign for the admin"src="images/if_Help.png" style="width:17px; cursor:pointer; margin-left:5px;"></span></span></h3>
										</div>
										
										<div class="col-sm-7 col-md-7">
										<ul class="status-unorderlist">
										<li><a href ="<?php echo base_url();?>timeoff/exportlistbyemployee?empidd=<?php echo $employee['employee_id'];?>&status=1">Approved (<?php echo $approve_record;?>)</a></li>
										<li class="denied-hover"><a href ="<?php echo base_url();?>timeoff/exportlistbyemployee?empidd=<?php echo $employee['employee_id'];?>&status=0">Denied (<?php echo $approve_denied;?>) </a>
										<span class="note-indicator" style="display:none;">Including Absent Without Approval </span>
										
										</li>
										</ul>
										</div>
										</div>
										</div>
											<tr>
                                        
												<th style="width:106px;"><?= $this->lang->line('Name')?></th>
												<th><?= $this->lang->line('Dates')?></th>
												<th><?= $this->lang->line('Types/Status')?></th>
												<th></th>
												
											</tr>
											</thead>
										<tbody>
										 <?php foreach($record as $recod){
								
											  // print_r($recod);
											 
											 
											 
											 // $strrr= $recod['start_time'];
                                      // print_r(explode("",$strrr));
 
											 ?>
											 
									
									
											 
											 
											 
										
									    <tr entity_id="<?= $evaluation['evaluation_id']; ?>">
									
										 <?php if($recod['name']== $employee['name'] ){
											 
										
											 
											 ?>
												<td><?= $recod['name'];?> </td>
												<td><?= $recod['start_time'];?> TO <?= $recod['end_time'];?></td>
											   <td><?= $recod['type'];?>/<?= $recod['status'];?></td>
												<td class="prw prw22">
												
												<a class="btn btn-outline btn-success" href="timeoff/edit_record/<?= $recod['record_id']?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-briefcase"></i>
                                                </a>	
												
												
												
												</td>
											
											</tr>
										 <?php }}?>
										</tbody>
										
										</table>
									
								</div>
								</div>
                       		 <!-- /*****************************Quit claim**********************************/-->
      
                                 <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_claim/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									
                                </a>
                                <div class="ibox-title collapse-link" id="employees_claims_click">
                                    <h5 title="Quit Claim is required to end employment. Print Quit Claim Form from the template.Get signed and attached file here.
" style="color:#ff0000;"><?= $this->lang->line('Quit Claim') ?></h5>
									<a class="li_hover"><span class="baloon-msg li_hover"><img title="
1. Click Add
2. Label the description, then attach the signed file
3. Then click Save." src="images/if_Help.png" width="17px"></span>
								
                                </div>
                                <div class="ibox-content" id="employees_claims"  ajax_link="employees/claims/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/claim', $claims) ?>
                                </div>

                            </div>
   <!-- /*****************************Quit claim end**********************************/-->
							  <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_assetbenefit/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_assetbenefits_click">
                                    <h5 title="Asset & Benefits are the additional benefits given to employees over and beyond their salaries and wages.All Issued Company property are subject for return upon receiving the final salary.Print Form from the template, get signed and attached file here for future references."><?= $this->lang->line('Assets & Benefits ( Company Properties )') ?></h5>
									<a class="li_hover"><span class="baloon-msg li_hover"><img title="
1.Click add 
2. Input the name of Issued Assets & benefits
3. attached the signed Memo for file storage
4. Then click Save" src="images/if_Help.png" width="2%"></span>
									</a>
									<p style="right:90px;"class="move-too">To be returned before issuing final salary</p>
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
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_contract/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title " id="employees_contract_click">
                                    <h5 title="Contract and Resignation form are essential upon start and end of employment.Print Document Form from Template. Get signed and attach file here."><?= $this->lang->line('Contract & Resignation') ?></h5>
									<span class="help"><img style="margin-left:5px;" src="images/if_Help.png" title="
1.Click add 
2. Select Document/Contract Type
3. Fill in the Contract Salary Amount, Performance Salary (if any), and Contract Expiration Date
4. Add Contract condition (if any)
5. click save" style="width:17px !important; max-width:4% !important;cursor:pointer;"></span>
                                </div>
                                <div class="ibox-content" id="employees_contract"  ajax_link="employees/contract/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/contract', $contracts) ?>
                                </div>
                            </div> 
					
							
                    
                            
                            <div class="ibox float-e-margins">
                                <a class="button-add pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_performance/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
									<span class="add-ballon-hover">Upload signed Memo, Warning, Disciplinary & Corrective Action document here</span>
                                </a>
                                <div class="ibox-title collapse-link" id="employees_performances_click">
                                    <h5 title="Employee Performance, Disciplinary & Corrective action, are the ways to determine the employees performance growth and review progress that needed to correct.Print Document Form from template. Get signed and attach the file here."><?= $this->lang->line('Employee Performance Memo, Disciplinary & Corrective Action signed by Employee') ?></h5>
									<span class="help"><img style="margin-left:5px;" src="images/if_Help.png" title="
1.Click add 
2. Input the name of Issued Employee Memo
3. Attach the signed memo for keeping records
4. click Save
" style="width:17px !important; max-width:4% !important;cursor:pointer;"></span>
                                </div>
                                <div class="ibox-content gggggggg" id="employees_performances"  ajax_link="employees/performances/<?= $employee['employee_id'] ?>">
                                    <?php $this->load->view('employees/performances', $performances) ?>
                                </div>
                            </div>
                             <div class="ibox float-e-margins">
                                <a class="pull-right btn btn-primary btn-sm m-t-sm m-r-sm" href="employees/new_education/<?= $employee['employee_id'] ?>" data-target="#modal_window" data-toggle="modal">
                                    <i class="fa fa-plus-circle"></i>
                                    <?= $this->lang->line('Add') ?>
                                </a>
                                <div class="ibox-title collapse-link">
                                    <h5 title="Benefit History will show all the list of benefits given to the employee. This will serve as a record file monitoring."><?= $this->lang->line('Benefit History') ?></h5>
									<span class="help"><img style="margin-left:5px;" src="images/if_Help.png" title="
1.Click add 
2. Input or select name of Benefit Form
3.Input the Start and End Dates
4. Upload the signed benefit memo for keeping records
5. Click Save" style="width:17px !important; max-width:4% !important;cursor:pointer;"></span>
                                </div>
                                <div class="ibox-content" id="employees_education" style="display: none;" ajax_link="employees/education/<?= $employee['employee_id'] ?>"></div>
                            </div>
                          
                            <div class="ibox float-e-margins">
                                <div class="ibox-title collapse-link">
                                    <h5><?= $this->lang->line('Position') ?></h5> <?php 
									foreach($positions as $position) { 
									if($position['position_id'] == $employee['position_id'])
									{
										?>
										<span style="color:#428bca">
										<?php echo $position['position_name'];
										?>
										</span>
										<?php
									}
									}?>
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
                                    <h5><?= $this->lang->line('Group') ?></h5>
									<?php 
									foreach($groups as $group) { 
									if($group['group_id'] == $employee['group_id'])
									{
										?>
										<span style="color:#428bca">
										<?php echo $group['group_name'];
										?>
										</span>
										<?php
									}
									}?>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                    <form action="employees/save_group" id="save_group" method="POST" role="form">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee['employee_id'] ?>">

                                        <div class="col-lg-6 no-padding form-group">
                                            <select name="group_id" id="group_id" class="form-control required">
                                                <option value="">Select Group</option>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option <?php echo ($group['group_id'] == $employee['group_id']) ? 'selected' : '' ?> value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="clearfix"></div>
                                        <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#save_group')">
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
									<?php 
									foreach($departments as $department) { 
									if($department['department_id'] == $employee['department_id'])
									{
										?>
										<span style="color:#428bca">
										<?php echo $department['department_name'];
										?>
										</span>
										<?php
									}
									}?>
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
      
                                 <div style="display:none;"class="ibox float-e-margins">
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
.two-boxes .col-md-5, .two-boxes .col-md-7
{
	margin:0px;
	padding:0px;
}
.status-unorderlist
{
	margin:0px;
	padding:0px;
	text-align:right;
}
.status-unorderlist li
{
	display: inline-block;
list-style: none;
margin: 6px 0px 0px 8px;
vertical-align: initial;
}
.status-unorderlist li a {
   color: #fff;
font-size: 15px;
background: #1AB394;
border-radius: 3px;
padding: 4px 16px;
}

.note-indicator
{
	position: absolute;
right: 0px;
width: 200px;
background: rgba(0,0,0,0.8);
text-align: center;
color: #fff;
margin-top: 10px;
border-radius: 3px;
padding: 5px 5px;
}
.status-unorderlist li.denied-hover:hover span
{
	display:block !important;
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
.li_hover img {
    width: 17px;
}
span.help img {
    width: 17px;
}
.button-new {
    background: #1d84c6;
    color: #fff;
    padding: 7px 16px;
    margin-top: 0px;
    border-radius: 3px;
    font-size: 14px;
}
.button-new:hover{
    background: #1d84c6;
    color: #fff;
    padding: 7px 16px;
    margin-top: 0px;
    border-radius: 3px;
    font-size: 14px;
}
span.neww {
    position: absolute;
    top: 124px !important;
}
span.neww-1 {
    position: absolute;
    top: 95px;
}
.value-2 {
    width: 262px;
    margin-top: 32px;
}
</style>





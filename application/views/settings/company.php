<?php $this->load->view('layout/header', array('title' => $this->lang->line('Company'), 'forms' => TRUE)) ?>

<script>
var valuee='<?php echo $abc ;?>';
if(valuee !=''){
setTimeout(function () {
	var  burl ="<?php echo base_url();?>";
//Redirect with JavaScript
window.location.href= burl+'settings/company';
}, 0);
}
</script>
<script>
var value='<?php echo $abcd ;?>';
if(value !=''){
setTimeout(function () {
	var  burl ="<?php echo base_url();?>";
//Redirect with JavaScript
window.location.href= burl+'settings/company';
}, 0);
}
</script>
<style>
.gallery.gal1 {float: left;width: 100%;margin-bottom: 25px;}
.img12345{float: left;width: 100%;overflow: hidden;
    border-radius: 3px;}
.img12345 img {height:75px;}	
.wrp123{ position:relative; width:auto;}
.wrp123 span.odd {
    position: absolute;
    right: 12px;
    z-index: 9;
    float: right;
    text-align: center;
    top: -9px;
}	
.rfgh.form-group.has-feedback {margin-bottom: 29px;}
span.odd img {
    float: none;
    margin-top: 12%;
    margin-right: 0px;
    width: 10px;
}	

</style>



<div id="wrapper">




    <?php 

	
	$this->load->view('layout/menu', array('active_menu' => 'company_settings')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Company') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <a><?= $this->lang->line('Settings') ?></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <button type="button" class="btn btn-primary" onclick="submit_form('#save_company')">
                        <i class="fa fa-save"></i>
                        <?= $this->lang->line('Save') ?>
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
						<div class="col-lg-6 hello">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="company_logo1"><?= $this->lang->line('Upload Company Related Image ( Other kind of Logo )') ?><sup class="mandatory">*</sup></label>
                                     <form method="post" action="settings/save2" enctype="multipart/form-data">
									 <div class="row">
<div class="col-lg-9">									 
    <div class="form-group">
	<input type="file" class="form-control filestyle" data-buttonName="btn-primary" name="files[]" id="company_logo1" maxlength="200" multiple/ > 
    </div>
    </div>
	<div class="col-lg-3">	
    <div class="form-group">
	<!--<button type="submit" class="form-control filestyle" data-buttonName="btn-primary" id="company_logo1" name="fileSubmit"><i class="fa fa-upload"></i> UPLOAD</button>-->
<input type="submit" class="form-control filestyle" data-buttonName="btn-primary" id="company_logo1" name="fileSubmit"  value="UPLOAD"/>
    </div>
    </div>
    </div>
</form>                                   
                                    </div>
                                   <div class="row">
		
    <div class="gallery gal1">
<?php 

$dirname = 'files/logoselect/';
$images = glob($dirname."*");

foreach($images as $image) {
	?>
	<div class=" col-md-3 col-sm-3 wrp123">
	<div class="img12345">
	<a href ="<?php echo $image; ?>" download >


<?php
echo '<img src="'.$image.'" download />'; ?>
</a></div><span class="odd"><a href="<?php echo base_url();?>settings/del?img=<?php echo $image;?>"><img src="http://wshrms.peza.com.ph/files/close/Cloz.png" value="<?php echo $image;?>" width="20px" height="20px" ></a></span>
</div>

<?php
   
}
?>
        
     
    </div>
 
	
</div>

                                </div>
						
                            <form role="form" action="settings/save_company" method="POST" id="save_company" enctype="multipart/form-data">
                                <div id="save_result"></div>
                                <div class="col-lg-6">
<div class="rfgh form-group has-feedback">
                                        <label class="control-label" for="company_logo"><?= $this->lang->line('Logo') ?><sup class="mandatory">*</sup></label>
                                        <input type="file" class="form-control filestyle" data-buttonName="btn-primary" name="company_logo" id="company_logo" maxlength="200" value="<?= $details['company_logo'] ?>">                                        
                                    </div>
                                    <?php
                                    if ($details['company_logo']) {
                                        $src = $controller->getBase64Image($details['company_logo']);
                                    } else {
                                        $src = '';
                                    }
                                    ?>
                                   <?php if (!empty($details['company_logo'])){?> <img id="logo" src="<?=$src?>" style="height:75px" /><?php } ?>
                                </div>
								
								<!--- start samares code --->

								<!-- <div class="col-lg-6">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="company_logo"><?= $this->lang->line('Upload Selected Logos') ?><sup class="mandatory">*</sup></label>
                                        <input type="file" class="form-control filestyle" data-buttonName="btn-primary" name="gallery-photo-add" id="gallery-photo-add" maxlength="200" value="<?= $details['company_logo'] ?>">                                        
                                    </div>
                                    <div class="gallery"></div>
                                </div>-->
								
								<!-- end samares code -->
                                <div class="clearfix mrspce"></div>
                                <div class="col-lg-6">
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="company_name"><?= $this->lang->line('Name') ?><sup class="mandatory">*</sup></label>
                                        <input type="text" class="form-control required" name="company_name" id="company_name" maxlength="200" value="<?= $details['company_name'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
								
								
								
								
								
                                    <div class="form-group has-feedback">
                                        <label class="control-label" for="company_email"><?= $this->lang->line('Email') ?><sup class="mandatory">*</sup></label>
                                        <input type="email" class="form-control required email" name="company_email" id="company_email" maxlength="50" value="<?= $details['company_email'] ?>">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label" for="company_phone"><?= $this->lang->line('Phone') ?></label>
                                    <input type="tel" class="form-control" name="company_phone" id="company_phone" maxlength="50" value="<?= $details['company_phone'] ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label" for="company_address"><?= $this->lang->line('Address') ?></label>
                                    <input type="text" class="form-control" name="company_address" id="company_address" maxlength="100" value="<?= $details['company_address'] ?>">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-6">
                                    <label class="control-label" for="company_city"><?= $this->lang->line('City') ?></label>
                                    <input type="text" class="form-control" name="company_city" id="company_city" maxlength="100" value="<?= $details['company_city'] ?>">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label class="control-label" for="company_state"><?= $this->lang->line('State') ?></label>
                                    <input type="text" class="form-control" name="company_state" id="company_state" maxlength="50" value="<?= $details['company_state'] ?>">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label class="control-label" for="company_zip"><?= $this->lang->line('Zip') ?></label>
                                    <input type="text" class="form-control" name="company_zip" id="company_zip" maxlength="50" value="<?= $details['company_zip'] ?>">
                                </div>
                                <div class="clearfix"></div>
								  <div class="form-group col-lg-6">
                                    <label class="control-label" for="company_city"><?= $this->lang->line('Work Start') ?></label>
                                    <input type="text" class="form-control" name="work_start" id="work_start" maxlength="100" value="<?= $details['work_start'] ?>">
                                </div>
								  <div class="form-group col-lg-6">
                                    <label class="control-label" for="company_city"><?= $this->lang->line('Work End') ?></label>
                                    <input type="text" class="form-control" name="work_end" id="work_end" maxlength="100" value="<?= $details['work_end'] ?>">
                                </div>
								 <div class="clearfix"></div>
								<div class="form-group col-lg-6">
                                    <label class="control-label hover1" for="company_city"><?= $this->lang->line('Late Time in Penalty') ?><span class="cvb"><img src="images/if_Help.png" width="4%"></span><span class="on_hover">If employee time in late . This penality time will be applied ( general setting )</span></label>
                                    <input type="text" class="form-control" name="overtime" id="overtime" maxlength="100" value="<?= $details['overtime'] ?>">
                                </div>
								<div class="form-group hover_width col-lg-6">
                                    <label class="control-label hover1" for="company_city"><?= $this->lang->line('Time Out Allowance') ?><span class="cvb"><img src="images/if_Help.png" width="4%"></span><span class="on_hover">Time allowance used for preparation for time out</span></label>
                                    <input type="text" class="form-control" name="timeout_allowance" id="timeout_allowance" maxlength="100" value="<?= $details['timeout_allowance'] ?>">
                                </div>
									<div class="form-group hover_target col-lg-6">
                                    <label class="control-label hover1" for="company_city"><?= $this->lang->line('Days') ?><span class="cvb"><img src="images/if_Help.png" width="4%"></span><span class="on_hover">AAAAAAA</span></label>
                                    <input type="text" class="form-control" name="days" id="days" maxlength="100" value="<?= $details['days'] ?>">
                                </div>
					
                            </form>
															 
							
							<div class="form-group col-lg-2">
								<form method="post" action="employees/work_menual_uploade" enctype="multipart/form-data">
    <div class="form-group grp_new">
      
     <input type="submit" name="fileSubmit"   title="you can uploade updated Workfile.zip and work file from here" value="WorkManual.doc"/>
 
<span class="input_new" >


<input type="file" class="btn btn-primary" name="files[]" multiple />	 </span>
    </div>
    <div class="form-group">
	
       
    </div>
	 </div>
</form>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<style>
input#company_logo1 {
    background-color: #1bb394;
    color: #fff;
    border: 0px;
    border-radius: 3px 3px 3px 3px;
}
.form-group.hover_target.col-lg-6 .on_hover {
    width: 450px;
}
.locan {
	color: #fff;
}
.form-group.hover_width.col-lg-6 .on_hover {
    width: 373px;
}
span.input_new {
    margin-left: 12px;
}
.form-group.grp_new {
    display: inline-flex;
    margin-top: 26px;
}
.form-group.new.hover2 {
    display: inline-flex;
    margin-bottom: 15px;

}
.form-group input[type=file] {
    display: inline-block;     margin-right: 20px; 
}
span.cvb { margin-left: 3px;}
.hover1{ position: relative; padding-right:15px;}
.hover1:hover > .on_hover{ display:block;}
.on_hover {
    position: absolute;
    background: #000;
    padding: 7px 26px;
    color: #fff;
    text-align: left;
    top: -8px;
    z-index: 99;
    width: 553px;
    border-radius: 15px;
    display: none;
    left: 95%;
}
.cvb img {
    width: 10px;
}

</style>

<script>
    document.getElementById("company_logo").onchange = function () {
        var reader = new FileReader();

        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("logo").src = e.target.result;
        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    };
</script>
<?php
$this->load->view('layout/footer')?>
<?php $this->load->view('layout/header', array('title' => $this->lang->line(isset($code) ? 'New password' : 'Login'), 'forms' => TRUE)) ?>
 <script>
$(document).ready(function(){
    $("#sub").click(function(){
  var  userip = $('#user_ip').val();
  
   $.ajax({
        type: 'POST',
        url: 'Welcome/check_user',
        data: 'user_ip':userip
        
    });

  
  
    });
});
</script>
<style>
    a:visited
    {
     color:white;   
    }

    
</style>
	
<?php if (isset($code)) { ?>

    <script>		
		$(document).ready(function(){	
			
            $('#new_password_window').modal('show');
       });
    </script>
       
	
    <div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="new_password_window">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                    <h4 class="modal-title"><?= $this->lang->line('New password') ?></h4>
                </div>
                <div class="modal-body">
                    <form action="welcome/new_password" method="POST" id="new_password_form">
                        <div id="save_result2"></div>
                        <input type="hidden" id="code" name="code" value="<?= $code ?>">
                        <div class="form-group has-feedback">
                            <label for="new_password" class="control-label"><?= $this->lang->line('New password') ?><sup class="mandatory">*</sup></label>
                            <input type="password" name="new_password" id="new_password" class="form-control required">
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password_again" class="control-label"><?= $this->lang->line('Password again') ?><sup class="mandatory">*</sup></label>
                            <input type="password" name="password_again" id="password_again" class="form-control required" equalTo="#new_password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submit_form('#new_password_form', '#save_result2')"><?= $this->lang->line('Save') ?></button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="middle-box loginscreen  animated fadeInDown">
    <div>
        <div style="width: 100%;padding-top: 20px;" class="text-center">
		
            <?php if (file_exists(FCPATH . $logo) && !empty($logo)) { ?>

                <img src="<?= $logo ?>" />
            <?php } else { ?>
                <h1 class="logo-name"><?= $this->lang->line('HRMS') ?></h1>
            <?php } ?>
        </div>
        <div style="width: 100%;padding-top: 20px;" class="text-center"><h3><?= $this->lang->line('Welcome to  ') . $company_name ?></h3></div>
        <!--div style="width: 100%;padding-top: 20px;" class="text-center"><h3><?php echo 'Welcome to smartoffice'; ?></h3></div -->
        <form class="m-t" role="form" action="welcome/check_user" id="check_user" method="POST">
            <div id="save_result"><?php echo ($this->session->flashdata('message')) ? '<div style="position: initial;"class="alert alert-danger">' . $this->session->flashdata('message') . '</div>' : '';?></div>
            <div class="form-group has-feedback">
                <label class="control-label" for="username"><?= $this->lang->line('Username') ?><sup class="mandatory">*</sup></label>
                <input type="email" class="form-control required email" placeholder="<?= $this->lang->line('Username') ?>" name="username" id="username" maxlength="50">
            </div>
            <div class="form-group has-feedback">
                <label class="control-label" for="password"><?= $this->lang->line('Password') ?><sup class="mandatory">*</sup></label>
                <input type="password" class="form-control required" placeholder="<?= $this->lang->line('Password') ?>" name="password" id="password">
				<input type="hidden" value="<?php echo  $_SERVER['REMOTE_ADDR'];?>"  name="user_ip" id="user_ip">
				
            </div>
            <button type="button" onclick="submit_form1('#check_user')" id="sub" class="btn btn-primary block full-width m-b"><?= $this->lang->line('Login') ?></button>
			
            <div class="text-center">
                <div class="" style="width: 45%; float: left">
                    <input id="remember_me" type="checkbox" name="remember_me" style="position: absolute;
    margin-left: -20px;">
                    <label class="text-navy"for="checkbox">Remember Me</label>
                </div>
                <div class="">
                    <a href="welcome/forgot_password" data-target="#modal_window" data-toggle="modal"><?= $this->lang->line('Forgot password?') ?></a>
                </div>
                
            </div>
            
			
        </form>
        <!-- p class="m-t text-center"><small><?= $company_name ?> &copy; <?= date('Y') ?></small> </p-->
        <p class="m-t text-center" style='color:white;font-size:20px;'><a href="https://smartoffice.com.ph/" target="_blank"><small><?= $company_name ?> &copy; <?= date('Y') ?></a></small></p>
        
    </div>
</div>



<script type="text/javascript">
    $.get('<?php echo base_url('welcome/getCookieDetails')?>')
    .done(function(data){
        var cre = JSON.parse(data);
        $('#username').val(cre.username);
        $('#password').val(cre.password);

        if(cre.remember_check == '1'){
            $('#remember_me').prop('checked', true);
        }else{
            $('#remember_me').prop('checked', false);
        }
    });
</script>


<?php
$this->load->view('layout/footer')?>
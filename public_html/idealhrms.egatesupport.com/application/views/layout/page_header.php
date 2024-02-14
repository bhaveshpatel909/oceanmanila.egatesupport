<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
	<!--span class="btn12343">
	<a href="http://wshrms.peza.com.ph/files/WorkManual.docx">
		<button class="btn btn-lg btn-primary ffgggg" type="button" style="margin-left: 26px;
    margin-top: 15px;}"><i class="fa fa-file-pdf-o"></i>Work Manual</button></a>
	<a href="http://wshrms.peza.com.ph/files/Workfile.zip">
		<button class="btn btn-lg btn-primary ffgggg" type="button" style="margin-left: 26px;
    margin-top: 15px;}"><i class="fa fa-file-pdf-o"></i>Work File</button></a>
	</span-->

        <div style="display:none;"class="navbar-header">
		
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right lng">
            <li class="dropdown">
		
                <a class="dropdown-toggle count-info" href="mailbox">
                    <i class="fa fa-envelope"></i>
                    <?php if ($messages>0){?>
                    <span class="label label-warning"><?= $messages?></span>
                    <?php }?>
                </a>
            </li>
            <li>
                <a href="profile/logout">
                    <i class="fa fa-sign-out"></i> <?= $this->lang->line('Log out')?>
                </a>
            </li>
         </ul>
		 	<a class="btn today_shed btn-primary" href="http://wshrms.peza.com.ph/schedule/index/">Today Schedule</a>
    </nav>
</div>
<style>button.btn.btn-lg.btn-primary.ffgggg {
    margin-top: 14px !important;
    padding-top: 5px !important;
    padding-bottom: 4px !important;
    font-size: 16px !important;
}
@media only screen and (max-width: 767px) {
.lng {
    float: left;
}
.today_shed {
    float: right;
    margin-right: 26px;
    font-size: 13px;
    padding: 6px 8px;
}
span.btn12343 {
    float: left;
    width: 100%;
}
span.btn12343 a:last-child {
    float: right;
    margin-right: 26px;
}
}
</style>







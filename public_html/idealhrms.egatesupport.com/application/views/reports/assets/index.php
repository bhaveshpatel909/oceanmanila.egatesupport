<?php $this->load->view('layout/header', array('title' => $this->lang->line('Reports'), 'forms' => TRUE, 'magicsuggest' => TRUE, 'date_time' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $("#start_date,#end_date").datetimepicker({pickTime: false});
		
		
    })
	function exportpunch()
		{
			var burl ="<?php echo base_url();?>";
			var value_input = $("input[name*='employee']").val();
			if(value_input=="")
			{
				value_input =0;
			}
			var sdate = $("#start_date").val();
			var enddate = $("#end_date").val();
			window.location.href= burl+"reports/export_puch_clock/"+value_input+"/"+sdate+"/"+enddate;
		}
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'assets_report')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Assets') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Reports') ?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
		
		 <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">  
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Options') ?></h5>                                    
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <form action="reports/proccess_assets_report" method="POST" id="proccess_report">
                                            <input type="hidden" name="report_category" id="report_category" value="clock">
                                            <input type="hidden" name="report_type" id="report_type" value="default">
                                            <div class="row">
                                                <div id="report_options" class="col-lg-6">
                                                    <?php $this->load->view('reports/employee') ?>
                                                </div>
                                                <button type="button" class="btn btn-success pull-right" onclick="exportpunch();" style="margin-right: 20px;">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                    <?= $this->lang->line('Export') ?>
                                                </button>
                                                
                                                <button type="button"  id="prr_reprt" class="btn btn-primary pull-right" onclick="submit_form('#proccess_report')">
                                                    <i class="fa fa-bar-chart-o"></i>
                                                    <?= $this->lang->line('Get results') ?>
                                                </button>
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Results') ?></h5>
                                </div>
                                <div class="ibox-content ibox-content_alt">
                                    <div>
                                        <div id="save_result" class="asdf"></div>
                                    </div>
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
<?php
$this->load->view('layout/footer')?>

<style>

@media only screen and (max-width: 990px) {

div#save_result table td, div#save_result table th { padding: 5px;font-size: 12px;}
.asdf{overflow-x: scroll;  width: 486px;}
}
@media only screen and (max-width: 550px) {
	
.asdf{  width: 377px;}
.ibox-content.ibox-content_alt {
    padding: 15px 10px 20px 10px;
}

}
@media only screen and (max-width: 400px) {
	
.asdf{width: 269px;}

}
button#prr_reprt {
    margin-right: 10px !important;
}
		</style>
		
		
		
		
		
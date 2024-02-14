<?php $this->load->view('layout/header', array('title' => $this->lang->line('Birthday List'), 'forms' => TRUE, 'magicsuggest' => TRUE, 'date_time' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $("#start_date,#end_date").datetimepicker({pickTime: false,format: 'DD/MM'});
		
    })
</script>
<script>
     
	 
  $('document').ready(function () {
	 
	  // var empiddd = $('#empideeee').val();
	  // var empna = $('#empnameeee').val();
        
			 // $.ajax({
	      // type: "post",
           // url: 'reports/orclock'+comments,
           // data: {'id' : comments,
		        // 'name':empna},
						 
             // cache: false,
			 // success: function(response);
			 // {
			 // }
        // });
        });
  

</script>

 


<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'Birthday List')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Birthday List') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Birthday List') ?>
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
									
                                        <form action="employees/getbdaylisst_report" method="POST" id="birthdaylist_report">
                                           
                                            <div class="row">
											
												   <div class="form-group has-feedback col-lg-3">
                                                    <label for="start_date"><?= $this->lang->line('Start date') ?><sup class="mandatory">*</sup></label>
                                                    <input type="text" name="start_date" id="start_date" value="<?= date('d/m', mktime(0, 0, 0, date('n'), 1)) ?>" class="form-control required datetimepicker" data-date-format='DD/MM'>
                                                </div>
                                                <div class="control-group has-feedback col-lg-3">
                                                    <label for="end_date"><?= $this->lang->line('End date') ?><sup class="mandatory">*</sup></label>
                                                    <input type="text" name="end_date" id="end_date" value="<?= date('d/m', mktime(0, 0, 0, date('n'))) ?>" class="form-control required datetimepicker" data-date-format="DD/MM">
                                                </div>
                                            </div>
                                            
													
                                            <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#birthdaylist_report')">
                                                <i class="fa fa-bar-chart-o"></i>
                                                <?= $this->lang->line('Get results') ?>
                                            </button>
										
                                            
                                              
													
 
																								
                                             
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
                                <div class="ibox-content" id ="emp_res">
								<div id="save_result"></div>
             
			
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
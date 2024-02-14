<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Employees'),'forms'=>TRUE,'scroll'=>TRUE));
// echo "<pre>";
// print_R($_SERVER);
if($_SERVER['argv'][0]=='/employees/filterdepart' && $_GET['is_active'] ==0)
					{
						$is_active=0;
					}elseif($_SERVER['argv'][0]=='/employees/filteremp' && $_GET['is_active'] ==0)
					{
						$is_active=0;
					}elseif($_SERVER['argv'][0]=='/employees/filtergroup' && $_GET['is_active'] ==0)
					{
						$is_active=0;
					}elseif($_SERVER['argv'][0]=='/employees/filterstatus' && $_GET['is_active'] ==0)
					{
						$is_active=0;
					}elseif($_SERVER['argv'][0]=='/employees/inactive' && $_GET['is_active'] ==0)
					{
						$is_active=0;
					}
else
{
	$is_active=1;
}	?>
<script>
    $('document').ready(function(){
		var s_url = '<?php echo base_url();?>';
		var is_active = '<?php echo $is_active;?>';
        $('#employees_list').infinitescroll({
            navSelector      : "#next:last",
            nextSelector     : "a#next:last",
            itemSelector     : "div.person_area",
            dataType         : 'html',
            loading:{
                msgText          : '<?= $this->lang->line('Processing')?>',
                finishedMsg      : '',    
            },
            maxPage          : <?= $employees['amount']?>,
            path: function(index) {return 'employees/index/'+index+'?search=<?= ($search?$search:'')?>';}
        });
		$("#rem-day-filter").change(function() { 
             // alert("hiiii");
			   var selval =$(this).val();
			  // alert(selval);
			  window.location.href=s_url+"employees/filteremp?type="+selval+"&is_active="+is_active;
			   
			  
            }); 
			$("#department_id").change(function() { 
             // alert("hiiii");
			   var selval =$(this).val();
			  // alert(selval);
			  window.location.href=s_url+"employees/filterdepart?depart="+selval+"&is_active="+is_active;
			   
			  
            }); 
			$("#group_id").change(function() { 
             // alert("hiiii");
			   var selval =$(this).val();
			  // alert(selval);
			  window.location.href=s_url+"employees/filtergroup?group_id="+selval+"&is_active="+is_active;
			   
			  
            }); 
			$("#hiring_status_id").change(function() { 
             // alert("hiiii");
			   var selval =$(this).val();
			  // alert(selval);
			  window.location.href=s_url+"employees/filterstatus?status_id="+selval+"&is_active="+is_active;
			   
			  
            }); 
				
		
		
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>$active_menu))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header'); ?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6 col-xs-12">
				<div class="col-lg-6">
				<?php //echo "<pre>";
				//print_R($_SERVER);
				?>
					<div class="bread-block">
						<h2 class="breadcrumb-heading"><?php if($active_menu =='inactive_employees'){ echo "Inactive Employees";}else{
							echo "Active Employees";}?>
							<h2 class="abcccc"><span class="emp-no" style="font-size:20px;color:red;font-weight:bolder;"> <?= $enumber ?></span></h2>

							</h2>
					
						<ol style="display:none;" class="breadcrumb">
							<li>
								<a href="dashboard"><?= $this->lang->line('Home')?></a>
							</li>
							<li >
							    <sapn class="top-heading">	<?= $this->lang->line('Employees')?></sapn>
							</li>
			
						</ol>
						
		
					</div>
				</div>
				

            </div>
            
			<div class="col-lg-6 col-xs-12">
			 <div class="title-action">
					<a href ="employees/getbirthdaylist" title="Employee List of birthday on this week
"class="btn btn-primary" target="_blank"><i class="fa fa-calendar"></i> Birthday</a>
					<a title="Print employee guide line ( To Do & Not To Do )
"href="reports/print_work_evaluation_rules"  class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Evaluation Guide')?>
                    </a>
					 <a href="discipline/print_company_rules" title="Print Company Rules & Regulations
" class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Rules & Regulation')?>
                    </a>
						<a title="Print contract  List
" href="employees/print_contract_type_list" class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        Print Contract List                   </a>
				<?php
				//echo $enumber;
				$no_employee =$emp_setting['setting_value'];
				if($no_employee=="")
				{
				?>
                    <a title="Print Company Rules & Regulations
" href="employees/new_employe"  class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
					<?php 	
				}
				elseif($enumber !=0 &&  $enumber < $no_employee)
				{
				?>
                    <a title="Add New Employee"href="employees/new_employe"  class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
					<?php 
				} 
				else
				{ ?>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
					
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						  
						  <div class="modal-body">
							<h4  style="color:red;">Number of your employee is exceeding allowed.Please contact administrator.</h4>
						  </div>
						  
						</div>

					  </div>
					</div>
								<?php 
				}
				?>
                </div>
				</div>
            
            <div class="clearfix"></div>
        </div>
    
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
			
                    <div class="row">
					<?php 
					//if($_SERVER['argv'][0]!='/employees/inactive')
					//{
						?>
					
<?php
					//}
					// echo '<pre>';
		  // print_r($employee_memorg);
		  // echo '</pre>';
		  // die('xvdv');
					
					if($active_menu != 'employees') { ?>
                        <div class="col-lg-12">
                        
			 <div class="form-groupp has-feedback m-t-sm custom-box1"><select name="rem-day-filter" id="rem-day-filter" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left; border:none!important;">
							  <option value=" "<?php if($_GET['type']== ' '){echo "selected=selected";}?>>Employment Type</option>
							  <option value="1"<?php if($_GET['type']== 1){echo "selected=selected";}?>>Regular</option>
							  <option value="0"<?php if($_GET['type']== 0 && $_GET['type']!=""){echo "selected=selected";}?>>Non-Regular</option>
							  </select>
							  
</div>
					 <div class="form-groupp has-feedback m-t-sm custom-box1">
                            <select name="department_id" id="department_id" class=""style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                                                <option value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $_GET['depart']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select>
</div>
 <div class="form-groupp has-feedback m-t-sm custom-box1">
                            <select name="group_id" id="group_id" class="" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                                                <option value="">Select Group</option>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option <?php echo ($group['group_id'] == $_GET['group_id']) ? 'selected' : '' ?> value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>
                                                <?php } ?>
                                            </select>
</div> 
 <div class="form-groupp has-feedback m-t-sm custom-box1 bb">
							 <select name="hiring_status_id" id="hiring_status_id" class="" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                            <option value="">Hiring Status Filter</option><?php foreach ($employee_memorg as  $employees_sts) {?>
							  <option  <?php echo ($employees_sts['id'] == $_GET['status_id']) ? 'selected' : '' ?>value="<?= $employees_sts['id'] ?>"><?= $employees_sts['status'] ?></option>
                            <?php } ?>  </select></div>
	


<div class="m-b-md custom-box1">
						
                            <div class="search-form">
							<?php 
							if($active_menu == 'employees'){
								$root = "employees/index";
							}else{
								$root = "employees/inactive";
							}
							?>
                                <form action="<?= $root ?>" method="GET" autocomplete="on">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control input-lg" value="<?= ($search)?$search:''?>" autocomplete="off">
                                        <div class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('Search')?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                    </div>
                        
<?php } 
else{

?>
<div class="col-lg-12 m-b-md"><span class="spce111"></span>
 <div class="form-groupp has-feedback m-t-sm custom-box1"><select name="rem-day-filter" id="rem-day-filter" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
							  <option value=" "<?php if($_GET['type']== ' '){echo "selected=selected";}?>>Employment Type</option>
							  <option value="1"<?php if($_GET['type']== 1){echo "selected=selected";}?>>Regular</option>
							  <option value="0"<?php if($_GET['type']== 0 && $_GET['type']!=""){echo "selected=selected";}?>>Non-Regular</option>
							  </select>
							  
</div>
					 <div class="form-groupp has-feedback m-t-sm custom-box1">
                            <select name="department_id" id="department_id" class=""style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                                                <option value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $_GET['depart']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select>
</div>
 <div class="form-groupp has-feedback m-t-sm custom-box1">
                            <select name="group_id" id="group_id" class="" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                                                <option value="">Select Group</option>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option <?php echo ($group['group_id'] == $_GET['group_id']) ? 'selected' : '' ?> value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>
                                                <?php } ?>
                                            </select>
</div> 
 <div class="form-groupp has-feedback m-t-sm custom-box1">
							 <select name="hiring_status_id" id="hiring_status_id" class="" style="margin-left: 2px; width: 100%; height: 44px;padding: 5px; float:left;border:none!important;">
                            <option value="">Hiring Status Filter</option><?php foreach ($employee_memorg as  $employees_sts) {?>
							  <option  <?php echo ($employees_sts['id'] == $_GET['status_id']) ? 'selected' : '' ?>value="<?= $employees_sts['id'] ?>"><?= $employees_sts['status'] ?></option>
                            <?php } ?>  </select></div>
                        <div class="m-b-md custom-box1">
                            <div class="search-form">
							<?php 
							if($active_menu == 'employees'){
								$root = "employees/index";
							}else{
								$root = "employees/inactive";
							}
							?>
				
                                <form action="<?= $root ?>" method="GET" autocomplete="on">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control input-lg" value="<?= ($search)?$search:''?>" autocomplete="off">
                                        <div class="input-group-btn">
                                            <button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('Search')?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
</div>
<?php  }?>
                        <a id="next" class="hide" href="#">#</a>
						</div>
						 <div class="row">
                        <div id="employees_list">
                            <?php $this->load->view('employees/list')?>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.custom-box1
{
	width:20%;
	float:left;
	padding-right:10px;
}
.breadcrumb-heading, .breadcrumb, .abcccc, .emp-no{
	display: inline-block;
}
ol.breadcrumb, .emp-no {
    margin-left: 10px;
}
.breadcrumb-heading, .abcccc{
	margin: 0px;
}
.bread-block, .emp-block{ margin-top: 30px; }
select {
    border: 0px!important;
}
</style>

<?php $this->load->view('layout/footer')?>







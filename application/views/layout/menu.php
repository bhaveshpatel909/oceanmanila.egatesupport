<nav class="navbar-default navbar-static-side" role="navigation">
<script>

$(document).ready(function() {
	baseurl ="<?php echo $this->config->item('base_url') ?>";
    $('#employee_tab').click(function(e) {  
      window.location.href = baseurl+ "employees";
    });
	$('#compm').click(function(e) {  
      window.location.href = baseurl+ "settings/company";
    });
});

</script>
<?php  global $processclass; ?>


    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span class="pull-left">
                        <img class="img-circle avatar" src="<?= $this->session->current->userdata('avatar') ?>" style="width: 45px" />&nbsp;
                    </span>
                    <a href="profile" class="pull-left m-l-sm">
                        <span class="clear"> 
                            <span class="block m-t-xs"> 
                                <strong class="font-bold user_name"><?= $this->session->current->userdata('name') ?></strong>
                            </span> 
						 <strong class="font-bold user_name"><?php echo $depatmentdata[0]['department_name']; ?></strong>
                            <span class="text-muted text-xs block"><?= $this->session->current->userdata('position') ?></span>
                        </span> 
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="logo-element">
                    <a href="profile">
                        <img class="img-circle avatar" src="<?= $this->session->current->userdata('avatar') ?>" style="width: 45px" />
						<strong class="font-bold user_name"><?php echo $depatmentdata[0]['department_name']; ?></strong>
                            <span class="text-muted text-xs block"><?= $this->session->current->userdata('position') ?></span>
                    </a>
                </div>
            </li>
            <li <?= ($active_menu == 'dashboard') ? 'class="active"' : '' ?>>
                <a href="dashboard">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label"><?= $this->lang->line('Dashboard') ?></span> 
                </a>
				
            </li>
			
 
            <?php if ($this->user_actions->is_selfservice()) { ?>
			<li  <?= ($active_menu == 'orignalclock') ? 'class="active"' : '' ?>  >
			 
                            <a href="dashboard/orignaldashboard">
							 <i class="fa fa-th-large"></i>
							 <span class="nav-label"><?php echo "Task Tracker"; ?></span> 
                          
                            </a>
                            
                        </li>
			
			
			<li <?= (in_array($active_menu, array('selftask','myperformance','open_vacancies','my_documents'))) ? 'class="active"' : '' ?>  >
			 
                           <a href="">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-label"><?= $this->lang->line('My Pages') ?></span>
                        <span class="fa arrow"></span>
                    </a>
						
                            
             
			  <ul class="nav nav-second-level circle1">
			 <li  <?= ($active_menu == 'selftask') ? 'class="active"' : '' ?>  >
			 
                            <a href="tasks/selftask">
							 <i class="fa fa-th-large"></i>
							 <span class="nav-label"><?php echo "My Work"; ?></span> 
                          
                            </a>
                            
                        </li>
			<li <?= ($active_menu == 'myperformance') ? 'class="active"' : '' ?>>
                <a href="dashboard/myperformance">
                    <i class="fa fa-th-large"></i> 
                    <span class="nav-label"><?php echo "My Performance"; ?></span> 
                </a>
				
            </li>
                <li <?= (in_array($active_menu, array('open_vacancies'))) ? 'class="active"' : '' ?>>
                    <a href="dashboard/vacancies">
                        <i class="fa fa-users"></i>
                        <span class="nav-label"><?= $this->lang->line('Open vacancies') ?></span>
                    </a>
                </li>
                <li <?= (in_array($active_menu, array('my_documents'))) ? 'class="active"' : '' ?>>
                    <a href="dashboard/my_documents">
                        <i class="fa fa-users"></i>
                        <span class="nav-label"><?= $this->lang->line('My documents') ?></span>
                    </a>
                </li>
				</ul>
				</li>
            <?php } ?>


            <?php if ($this->user_actions->is_allowed(array('admin','Employee Work Calender','document_expiration','schedule_calendar', 'Employees', 'evaluations', 'discipline','reminder','request','performance'))) { ?>
                <li <?= (in_array($active_menu, array('employees','schedule_calendar','document_expiration','inactive_employees', 'employees_new', 'contract_history', 'discipline', 'discipline_new','processcallingcard','processcallingcardnew', 'evaluations', 'evaluation_new', 'evaluation_edit','employee_reminder','reminder','request','employee_request','performance','evaluation'))) ? 'class="active"' : '' ?>>
                    <a href="employees">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-label"><?= $this->lang->line('Admin') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level circle1">
                        <?php if ($this->user_actions->is_allowed('Employees')) { ?>
                            <li <?= (in_array($active_menu, array('employees', 'employees_new', 'contract_history','inactive_employees','employee_reminder','request','processcallingcard','processcallingcardnew','evaluations','evaluation','performance','discipline'))) ? 'class="active"' : '' ?>>
                                <a href="employees">
                                    <i class="fa fa-circle"></i>
                              <span id="employee_tab" class="nav-label"><?= $this->lang->line('Employees') ?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-third-level">
                                    <li <?= ($active_menu == 'employees' ? 'class="active"' : '') ?>>
                                        <a href="employees"><?= $this->lang->line('Active Employees') ?></a>
                                    </li>
                                    <li <?= ($active_menu == 'inactive_employees' ? 'class="active"' : '') ?>>
                                        <a href="employees/inactive"><?= $this->lang->line('Inactive Employees') ?></a>
                                    </li> 
                             
		                     
		                        
								
                                </ul>
                          
						  </li>
							 <?php if ($this->user_actions->is_allowed('Employee Reminder')) { ?>
								 <li <?= (in_array($active_menu, array('reminder', 'employee_reminder'))) ? 'class="active"' : '' ?>>
								<a href="employeereminder/index">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee Reminder') ?>
								</span>
								</a>
								</li>
								 <?php } ?>
								 <?php if ($this->user_actions->is_allowed('Employee Request')) { ?>
								 <li <?= (in_array($active_menu, array('request', 'employee_request'))) ? 'class="active"' : '' ?>>
								<a href="request/index">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee Request') ?>
								</span>
								</a>
								</li>
								 <?php } ?>
								 <?php 
									$userid = $this->session->userdata('user_id');
								if($userid==1)
								{
									
								// if ($this->user_actions->is_allowed('Employee Master List')) { ?>
								 <li <?= (in_array($active_menu, array('processcallingcard'))) ? 'class="active"' : '' ?>>
								<a href="request/processcallingcard">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee Master List') ?>
								</span>
								</a>
								</li>
								
								 <?php 
								 //}
								}								 ?>
								 <?php if ($this->user_actions->is_allowed('Employee List')) { ?>
								 <li <?= (in_array($active_menu, array('processcallingcardnew'))) ? 'class="active"' : '' ?>>
								<a href="request/processcallingcardnew">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee List') ?>
								</span>
								</a>
								</li>
								
								 <?php } ?>
								 
								 <?php if ($this->user_actions->is_allowed('Employee Performance')) { ?>
							<?php //echo $active_menu;
							$test='';
							if (in_array($active_menu, array('evaluations','evaluation','performance','discipline')))
							{
								$test= 'active';
							}
							?>
							
							<li class="<?php echo $test;?>">
							
								<a class="li_hover" href="evaluation">
								<i class="fa fa-circle"></i>
                                <span class="nav-label">
								<?= $this->lang->line('Employee Performance') ?>
								</span>
								 <span class="fa arrow"></span>
								 	<span class="hover_button">View employee performance report</span>
								</a>
							
								
								 <ul class="nav nav-third-level">
                                  
                                 <?php if ($this->user_actions->is_allowed('Employees')) { ?>
		                            <li <?= (in_array($active_menu, array('evaluations', 'evaluation_new', 'evaluation_edit','performance','request'))) ? 'class="active"' : '' ?>>
		                                <a href="evaluation">
		                                   <?= $this->lang->line('Evaluation Report') ?>
										   <span class="hoveron-menu">Work Evaluation Report</span>
		                                </a>
										
		                            </li>
		                        <?php } ?>
		                         <?php if ($this->user_actions->is_allowed('Employees')) { ?>
		                            <li <?= (in_array($active_menu, array('discipline', 'discipline_new','performance'))) ? 'class="active"' : '' ?>>
		                                <a href="discipline"><?= $this->lang->line('Disciplinary  Report') ?>
										<span class="hoveron-menu2">Disciplinary & Corrective Action Report</span>
										</a>
		                            </li>
		                        <?php } ?>
								
                                </ul>
								</li>
								 <?php } ?>
                        <?php //} 
						} ?>
						
						<?php if ($this->user_actions->is_allowed('Employee Work Calender')) { ?>
								 <li <?= (in_array($active_menu, array('schedule_calendar'))) ? 'class="active"' : '' ?>>
								<a href="schedule/index">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Work Calendar') ?>
								</span>
								</a>
								</li>
								 <?php } ?>
						<?php if ($this->user_actions->is_allowed('Expiration Date Permission')) { ?>
								 <li <?= (in_array($active_menu, array('document_expiration'))) ? 'class="active"' : '' ?>>
								<a href="employees/document_expiration">
								 <i class="fa fa-circle"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Document Expiration') ?>
								</span>
								</a>
								</li>
								 <?php } ?>

                       <!--  <?php if ($this->user_actions->is_allowed('evaluations')) { ?>
                            <li <?= (in_array($active_menu, array('evaluations', 'evaluation_new', 'evaluation_edit'))) ? 'class="active"' : '' ?>>
                                <a href="evaluation">
                                    <i class="fa fa-files-o"></i>
                                    <span class="nav-label"><?= $this->lang->line('Work Evaluation') ?></span>
                                </a>
                            </li>
                        <?php } ?> -->
                       

                    </ul>
                </li>
            <?php } ?>
               
            <!--
            <?php if ($this->user_actions->is_allowed('Employees')) { ?>
                                                                    <li <?= (in_array($active_menu, array('employees', 'employees_new', 'contract_history'))) ? 'class="active"' : '' ?>>
                                                                        <a href="employees">
                                                                            <i class="fa fa-users"></i>
                <?= $this->lang->line('Employees') ?>
                                                                        </a>
                                                                    </li>
            <?php } ?>
			
            -->
			
            <?php if ($this->user_actions->is_allowed(array('Bir File List','BIR Calander','Accounting Calender','Petty Cash','CheckWriter','Monthly Bill Payment','Company Registration','Lazada','bir_files','petty_cash','lazada','schedule_bir_calendar' ,'bir_calender_files','bir_egate_files','bir_calender_filesE','bir_egate_filesE','bir_modory_filesE','bir_modory_files','monthly_bill_payment','document_category_id'))) { ?>
                <li <?= (in_array($active_menu, array('accounting','Company_Registration','schedule_accounting_calendar','bir_files','petty_cash','schedule_bir_calendar','bir_calender_files','bir_egate_files','bir_calender_filesE','bir_egate_filesE','bir_modory_filesE','bir_modory_files','employee_Lazada','lazada','check_writer','monthly_bill_payment','document_category_id'))) ? 'class="active"' : '' ?>>
                    <a href="accounting">
                     <!--  <i class="fa fa-calculator"></i>-->
<span class="peso">&#8369;</span>
						
                        <span class="nav-label"><?= $this->lang->line('Accounting') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level circle1">
					<?php if ($this->user_actions->is_allowed('Bir File List')) { ?>
                        <li <?= ($active_menu == 'bir_files' ? 'class="active"' : '') ?>>
						    <a href="accounting/bir_files"><i class="fa fa-circle"></i><?= $this->lang->line('BIR File List') ?>

							<span class="nav-label"> 
							</span>
							</a>
							
                        </li>
					<?php } ?>
						<!--li <?= ($active_menu == 'bir_calender_files' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_calender_files"><?= $this->lang->line('BIR file ( Uplus )') ?></a>
                        </li-->
						<!--li <?= ($active_menu == 'bir_egate_files' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_egate_files"><?= $this->lang->line('BIR file ( Egate )') ?></a>
                        </li-->
						<!--li <?= ($active_menu == 'bir_modory_files' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_modory_files"><?= $this->lang->line('BIR file ( Modory )') ?></a>
                        </li-->
						<!--li <?= ($active_menu == 'bir_calender_filesE' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_calender_filesE"><?= $this->lang->line('Employee Benefit ( Uplus )') ?></a>
                        </li-->
						<!--li <?= ($active_menu == 'bir_egate_filesE' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_egate_filesE"><?= $this->lang->line('Employee Benefit( Egate )') ?></a>
                        </li-->
						<!--li <?= ($active_menu == 'bir_modory_filesE' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_modory_filesE"><?= $this->lang->line('Employee Benefit ( Modory )') ?></a>
                        </li-->
						
						
						
						
						
			<!--			/**********************BIR calender start*****************************/     -->
			
			<?php //if ($this->user_actions->is_allowed(array('accounting'))) { ?>
			<?php //if ($this->user_actions->is_allowed('BIR Calander')) { ?>
                <!--li <?= (in_array($active_menu, array('schedule_bir_calendar'))) ? 'class="active"' : '' ?>>
                    <a href="schedule/bir_calendar">
                        
                        <span class="nav-label"><?= $this->lang->line('BIR Calendar ') ?></span>
                    </a>
			<?php //} ?>
                </li-->
				<?php if ($this->user_actions->is_allowed('Accounting Calender')) { ?>
				<li <?= (in_array($active_menu, array('schedule_accounting_calendar'))) ? 'class="active"' : '' ?>>
				    
                    <a href="schedule/accounting_calendar">
                        <i class="fa fa-circle"></i>
                        <span class="nav-label"><?= $this->lang->line('Accounting Calendar ') ?></span>
                    </a>
                </li>
            <?php } ?>    
			
			
			<!--			/************************BIR calendar end***************************/     -->
						<?php //if ($this->user_actions->is_allowed('Petty Cash')) { ?>
                        <!--li <?= ($active_menu == 'petty_cash' ? 'class="active"' : '') ?>>
                            <a href="petty/index"><?= $this->lang->line('Petty Cash') ?></a>
                        </li-->
						<?php //}
						?>
                       <?php if ($this->user_actions->is_allowed('CheckWriter')) { ?>
						<li <?= ($active_menu == 'check_writer' ? 'class="active"' : '') ?>>
						    
                            <a href="checkwriter/index"><i class="fa fa-circle"></i><?= $this->lang->line('Check Writer') ?></a>
                        </li>
					   <?php } ?>
						<?php if ($this->user_actions->is_allowed('Monthly Bill Payment')) { ?>
						<li <?= ($active_menu == 'monthly_bill_payment' ? 'class="active"' : '') ?>>
						    
                            <a href="monthlybillpayment/index"><i class="fa fa-circle"></i><?= $this->lang->line('Monthly bills Payments') ?></a>
                        </li>
						<?php } ?>
						
						  <?php $categories = get_document_category(); ?>
						<?php 
						// echo '<pre>';
						// print_r($categories);
						// echo '</pre>';
						//foreach ($categories as $category) { ?>
						<?php 
						// echo '<pre>';
						// print_r($categories);
						// echo '</pre>';
						// die('dfd');
 // [2] => Array
        // (
            // [document_category_id] => 3
            // [document_category_name] => Company Registration
        // )
						// ?>
						
							<?php //if ($this->user_actions->is_allowed('Lazada')) { ?>
							<!--li <?= $active_menu == 'lazada' ? 'class="active"' : '' ?>>
                    <a href="reports/lazada">
                        <?= $this->lang->line('Lazada') ?>
                    </a>
                </li-->
				 
				
				
			
   <?php //} ?>
                    </ul>
                </li>
            <?php } ?>
 <?php if ($this->user_actions->is_allowed(array('Tasks'))) {
             if (1 == 1) { 
                
				//$this->user_actions->is_allowed('tasks');
                $tasks_number = get_tasks_number(); 



				
                ?>
                <li <?= (in_array($active_menu, array('tasks', 'attention_updated_tasks', 'regular_tasks', 'all_tasks', 'assigned_tasks', 'unassigned_tasks', 'completed_tasks','pending_task', 'attention_tasks'))) ? 'class="active"' : '' ?>>
                    <a href="tasks">
                        <i class="fa fa-tasks"></i>
                        <span class="nav-label"><?= $this->lang->line('Tasks') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level circle1">
                        <li <?= ((in_array($active_menu, array('all_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/all"><i class="fa fa-circle"></i><?= $this->lang->line('All Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['all']?></span>
                            </a>
                            
                        </li>
						<li <?= ((in_array($active_menu, array('pending_task'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/pending_task"><i class="fa fa-circle"></i><?= $this->lang->line('Pending Task') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['<100%']?></span>
							
                            </a>
                            
                        </li>
						
						
						
						
						
                        <li <?= ((in_array($active_menu, array('unassigned_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/unassigned"><i class="fa fa-circle"></i><?= $this->lang->line('UnAssigned Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['unassigned']?></span>
                            </a>
                            
                        </li>
                        <li <?= ((in_array($active_menu, array('assigned_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/assigned"><i class="fa fa-circle"></i><?= $this->lang->line('Assigned & Accepted') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['assigned']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('attention_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/attention_tasks"><i class="fa fa-circle"></i><?= $this->lang->line('Questioned Task') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['attention_required']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('attention_updated_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/attention_updated_tasks"><i class="fa fa-circle"></i><?= $this->lang->line('Answered Task') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['attention_updated']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('completed_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/completed"><i class="fa fa-circle"></i><?= $this->lang->line('Completed Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['completed']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('regular_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/regular"><i class="fa fa-circle"></i><?= $this->lang->line('Regular Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['regular']?></span>
                            </a>
                        </li>

                    </ul>
                </li>
            <?php } 
			}
			?>    

            <?php if ($this->user_actions->is_allowed('Documents')) { ?>
                <?php $categories = get_document_category(); ?>
                <?php
                $categories_menu = array('documents');
                foreach ($categories as $category) {
                    array_push($categories_menu, $category['document_category_name']);
                }
                ?>
                <li <?= (in_array($active_menu, $categories_menu)) ? 'class="active"' : '' ?>>
                    <!--                    <a href="documents">
                                            <i class="fa fa-files-o"></i>
                                            <span class="nav-label"><?= $this->lang->line('Documents') ?></span>
                                        </a>-->
                    <a href="documents">
                        <i class="fa fa-files-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Document Storage') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level circle1">
					
						<li <?= ($active_menu == 'documents' ? 'class="active"' : '') ?>>
                            <a href="documents"><i class="fa fa-circle"></i><?= $this->lang->line('All') ?></a>
                        </li>
                        <?php 
							// echo "<pre>";
							// print_r($categories);
						foreach ($categories as $kk=>$cat_menu)
					{
						//echo "<pre>";
						?>
						 <li <?= ((in_array($active_menu, $categories[$kk])) ? 'class="active"' : '') ?>>
						      <a href="documents/cat/<?= $cat_menu['document_category_id'] ?>"><i class="fa fa-circle"></i><?= $cat_menu['document_category_name'] ?></a>
                            </li>
							<?php 
						
					}
					?>
						
                           
							<!--li <?= ((in_array($active_menu, $categories[1])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[1]['document_category_id'] ?>"><i class="fa fa-circle"></i><?= $categories[1]['document_category_name'] ?></a>
                            </li-->
							<!--li <?= ((in_array($active_menu, $categories[3])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[3]['document_category_id'] ?>"><i class="fa fa-circle"></i><?= $categories[3]['document_category_name'] ?></a>
                            </li-->
                        <?php //} ?>
                    </ul>
                </li>
            <?php } ?>
			 <?php if ($this->user_actions->is_allowed('Work Manual')) { ?>
		
			 <li <?= (in_array($active_menu, array('workmanual'))) ? 'class="active"' : '' ?>>
                    <a href="workmanual/index">
                        <i class="fa fa-files-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Work Manual') ?></span>
                    </a>
             </li>
			 <?php 
			 }
			 ?>
			 
            <?php if ($this->user_actions->is_allowed(array('Letter'))) { ?>
                <li <?= (in_array($active_menu, array('letters'))) ? 'class="active"' : '' ?>>
				
                    <a href="letter/index">
                        <i class="fa fa-sticky-note-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Outgoing Letter') ?></span>
                    </a>
                </li>
            <?php } ?>      

            <?php /* if ($this->user_actions->is_allowed('skills')) { ?>
              <li <?= (in_array($active_menu, array('skills', 'skills_categories', 'assessments'))) ? 'class="active"' : '' ?>>
              <a href="skills">
              <i class="fa fa-cubes"></i>
              <span class="nav-label"><?= $this->lang->line('Skills') ?></span>
              <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
              <li <?= ($active_menu == 'skills' ? 'class="active"' : '') ?>>
              <a href="skills"><?= $this->lang->line('List') ?></a>
              </li>
              <li <?= ($active_menu == 'skills_categories' ? 'class="active"' : '') ?>>
              <a href="skills/categories"><?= $this->lang->line('Categories') ?></a>
              </li>
              <li <?= ($active_menu == 'assessments' ? 'class="active"' : '') ?>>
              <a href="skills/assessments"><?= $this->lang->line('Assessments') ?></a>
              </li>
              </ul>
              </li>
              <?php } */ ?>

            <?php //if ($this->user_actions->is_allowed('Provision')) { ?>
                <!--li <?= (in_array($active_menu, array('performance', 'performance_criteria'))) ? 'class="active"' : '' ?>>
                    <a href="performance">
                        <i class="fa fa-location-arrow"></i>
                        <span class="nav-label"><?= $this->lang->line('Provision (Not Use)') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ($active_menu == 'performance' ? 'class="active"' : '') ?>>
                            <a href="performance"><?= $this->lang->line('Appraisal') ?></a>
                        </li>
                        <li <?= ($active_menu == 'performance_criteria' ? 'class="active"' : '') ?>>
                            <a href="performance/criteria"><?= $this->lang->line('Criteria') ?></a>
                        </li>
                    </ul>
                </li-->
            <?php //} ?>
            <!--
            <?php if ($this->user_actions->is_allowed('evaluations')) { ?>
                                                                                        <li <?= (in_array($active_menu, array('evaluations', 'evaluation_new', 'evaluation_edit'))) ? 'class="active"' : '' ?>>
                                                                                            <a href="evaluation">
                                                                                                <i class="fa fa-files-o"></i>
                                                                                                <span class="nav-label"><?= $this->lang->line('Work Evaluation') ?></span>
                                                                                            </a>
                                                                                        </li>
            <?php } ?>
            
            <?php if ($this->user_actions->is_allowed('discipline')) { ?>
                                                                                        <li <?= (in_array($active_menu, array('discipline', 'discipline_new'))) ? 'class="active"' : '' ?>>
                                                                                            <a href="discipline"><i class="fa fa-dot-circle-o"></i> <?= $this->lang->line('Discipline') ?></a>
                                                                                        </li>
            <?php } ?>
            -->
            <?php /* if ($this->user_actions->is_allowed('discipline_actions')) { ?>
              <li <?= (in_array($active_menu, array('discipline_actions', 'discipline_action_attendance', 'discipline_action_attendance_late', 'discipline_action_attendance_absent', 'discipline_action_attitude', 'discipline_action_work'))) ? 'class="active"' : '' ?>>
              <a href="discipline">
              <i class="fa fa-sitemap"></i>
              <span class="nav-label"><?= $this->lang->line('Discipline actions') ?></span>
              <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
              <li <?= (in_array($active_menu, array('discipline_action_attendance', 'discipline_action_attendance_late', 'discipline_action_attendance_absent'))) ? 'class="active"' : '' ?>>
              <a href="discipline/action_attendance">
              <span class="nav-label"><?= $this->lang->line('Attendance') ?></span>
              <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-third-level">
              <li <?= ($active_menu == 'discipline_action_attendance_late' ? 'class="active"' : '') ?>>
              <a href="discipline/action_attendance_late"><?= $this->lang->line('Late') ?></a>
              </li>
              <li <?= ($active_menu == 'discipline_action_attendance_late' ? 'class="active"' : '') ?>>
              <a href="discipline/action_attendance_absent"><?= $this->lang->line('Absent') ?></a>
              </li>
              </ul>
              </li>
              <li <?= ($active_menu == 'discipline_action_attitude' ? 'class="active"' : '') ?>>
              <a href="discipline/action_attitude"><?= $this->lang->line('Attidute') ?></a>
              </li>
              <li <?= ($active_menu == 'discipline_action_work' ? 'class="active"' : '') ?>>
              <a href="discipline/action_work"><?= $this->lang->line('Work Performance') ?></a>
              </li>
              </ul>
              </li>
              <?php } */ 
			  // echo '<pre>';
			  // print_r($this->user_actions->is_allowed());
			  // echo '</pre>';
			  ?>

            <?php if ($this->user_actions->is_allowed('Leave Tracking')) { ?>
                <li <?= (in_array($active_menu, array('leave_tracking', 'timeoff_requests'))) ? 'class="active"' : '' ?>>
                    <a href="timeoff">
                        <i class="fa fa-briefcase"></i>
                        <span class="nav-label"><?= $this->lang->line('Leave Tracking') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level circle1">
                        <li <?= ($active_menu == 'leave_tracking') ? 'class="active"' : '' ?>>
                            <a href="timeoff">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i><?= $this->lang->line('Approved') ?></a>
                        </li>
						  
                        <li <?= ($active_menu == 'timeoff_requests') ? 'class="active"' : '' ?>>
						      
                            <a href="timeoff/requests" title="You can Apply leave From here">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle"></i><?= $this->lang->line('Leave Request') ?></a>
                        </li>
                    </ul>
                </li>
				<?php } ?>
          

				
			
            <?php if ($this->user_actions->is_allowed('Recruiting')) { ?>
                <li <?= in_array($active_menu, array('recruiting', 'applicants')) ? 'class="active"' : '' ?>>
                    <a href="recruiting">
                        <i class="fa fa-certificate"></i>
                        <span class="nav-label"><?= $this->lang->line('Recruiting') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ($active_menu == 'recruiting') ? 'class="active"' : '' ?>>
                            <a href="recruiting"><?= $this->lang->line('Vacancies') ?></a>
                        </li>
                        <li <?= ($active_menu == 'applicants') ? 'class="active"' : '' ?>>
                            <a href="recruiting/applicants"><?= $this->lang->line('Applicants') ?></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->user_actions->is_allowed('Report')) { ?>
                <li <?= (in_array($active_menu, array('work_evaluation_rules','asset_issuance_status', 'reports_skills', 'reports_clock','assets_report','orignalreports_clock', 'report_discipline', 'employee_evaluation', 'company_rules'))) ? 'class="active"' : '' ?>>
                    <a href="reports">
                        <i class="fa fa-bar-chart-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Reports') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <!--<li <?= ($active_menu == 'reports_skills' ? 'class="active"' : '') ?>>
                            <a href="reports/skills"><?= $this->lang->line('Skills') ?></a>
                        </li>-->
                        <li <?= ($active_menu == 'reports_clock' ? 'class="active"' : '') ?>>
                            <a href="reports/clock"><?= $this->lang->line('Punch Clock') ?></a>
                        </li>
						
						 <li <?= ($active_menu == 'assets_report' ? 'class="active"' : '') ?>>
                            <a href="reports/assets"><?= $this->lang->line('Assets Report') ?></a>
                        </li>
						
						
						<li <?= ($active_menu == 'orignalreports_clock' ? 'class="active"' : '') ?>>
                            <a href="reports/orclock"><?= $this->lang->line('Work Detail Report') ?></a>
                        </li>
						
                        <li <?= ($active_menu == 'report_discipline' ? 'class="active"' : '') ?>>
                            <a href="reports/discipline"><?= $this->lang->line('Employee Performance') ?></a>
                        </li>
                        <li <?= ($active_menu == 'employee_evaluation' ? 'class="active"' : '') ?>>
                            <a href="evaluation/employee_evaluation"><?= $this->lang->line('Employee Evaluation') ?></a>
                        </li>
                        <li <?= ($active_menu == 'company_rules' ? 'class="active"' : '') ?>>
                            <a href="discipline/company_rules"><?= $this->lang->line('Company Rules') ?></a>
                        </li>
                        <li <?= ($active_menu == 'work_evaluation_rules' ? 'class="active"' : '') ?>>
                            <a href="reports/work_evaluation_rules"><?= $this->lang->line('Work Evaluation') ?></a>
                        </li> <li <?= ($active_menu == 'asset_issuance_status' ? 'class="active"' : '') ?>>
                            <a href="reports/asset_issuance_status"><?= $this->lang->line('Asset Issuance Status') ?></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->user_actions->is_allowed('Admin','Company','Admin Employee','Admin Work Evalutiation','Admin Calendar','Setting Accounting','Setting Task')) { ?>
                <li <?= (in_array($active_menu, array('document_category','bir_formsb','requestt', 'setting_letter', 'evaluation_templates', 'customer_item', 'schedule_item', 'company_settings', 'company_email', 'company_positions', 'resign_reasons', 'departments', 'grouplist', 'processing_errors', 'unsent_emails', 'discipline_actions', 'discipline_reasons', 'discipline_category', 'task_status', 'task_category', 'task_type','evaluation_list', 'evaluation_category', 'contract_type','bank_list','bir_forms','petty_cash_item','monthly_bill_list', 'employee_memo', 'reminder_list','vendor_list','customer_list','process_list','product_list'))) ? 'class="active"' : ''; ?>>
                    <a href="settings/company">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label"><?= $this->lang->line('Settings') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
					
					<?php if ($this->user_actions->is_allowed('Company')) { ?>
                <li <?= (in_array($active_menu, array('company_settings','company_email','setting_letter','document_category'))) ? 'class="active"' : '' ?>>
					
                            <a href="settings/company" id ="compm"><?= $this->lang->line('Company') ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<?php $uid =$this->session->current->userdata('user_id');
								if($uid==1)
								{
									?>
                                 <li <?= ($active_menu == 'company_email' ? 'class="active"' : '') ?>>
                                    <!--a href="dashboard"><?= $this->lang->line('Email') ?></a-->
                                    <a href="settings/email"><?= $this->lang->line('Admin Setup') ?></a>
                                </li> 
								<?php 
								} ?>
                                <li <?= ($active_menu == 'document_category' ? 'class="active"' : '') ?>>
                                    <a href="settings/document_categorys"><?= $this->lang->line('Doc Folder Category') ?></a>
                                </li>
                                 <li <?= ($active_menu == 'setting_letter' ? 'class="active"' : '') ?>>
                                    <a href="settings/letters"><?= $this->lang->line('Letter Template') ?></a>
                                </li>
                            </ul>
                        </li>
						
					<?php } ?>
                          <?php if ($this->user_actions->is_allowed('Admin Employee')) { ?>                    
                        <li <?= (in_array($active_menu, array('contract_type','requestt','company_positions', 'departments', 'grouplist', 'employee_memo', 'reminder_list' , '201_file_document_type'))) ? 'class="active"' : '' ?>>
                            <a href="discipline">
                                <span class="nav-label"><?= $this->lang->line('Admin-Employee') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'company_positions' ? 'class="active"' : '') ?>>
                                    <a href="settings/positions"><?= $this->lang->line('Designation') ?></a>
                                </li> 
								<li <?= ($active_menu == 'grouplist' ? 'class="active"' : '') ?>>
                                    <a href="settings/grouplist/"><?= $this->lang->line('Group Lists') ?></a>
                                </li>
                                <!--<li <?= ($active_menu == 'resign_reasons' ? 'class="active"' : '') ?>>
                                    <a href="settings/resign_reasons"><?= $this->lang->line('Resign reasons') ?></a>
                                </li>-->
                                <li <?= ($active_menu == 'departments' ? 'class="active"' : '') ?>>
                                    <a href="settings/departments"><?= $this->lang->line('Departments') ?></a>
                                </li>
                                <li <?= ($active_menu == 'contract_type' ? 'class="active"' : '') ?>>
                                  <a href="employees/contract_type"><?= $this->lang->line(' Contract Template List') ?></a>
                                </li>
								<li <?= ($active_menu == 'employee_memo' ? 'class="active"' : '') ?>>
                                    <a href="employees/employee_memo"><?= $this->lang->line('Hiring Status List') ?></a>
                                </li>
								<li <?= ($active_menu == 'reminder_list' ? 'class="active"' : '') ?>>
                                    <a href="reminderlist/index"><?= $this->lang->line('Reminder List') ?></a>
                                </li>
								<li <?= ($active_menu == 'requestt' ? 'class="active"' : '') ?>>
                                    <a href="settings/request"><?= $this->lang->line('Request Category List') ?></a>
                                </li>
								<li <?= ($active_menu == '201_file_document_type' ? 'class="active"' : '') ?>>
                                    <a href="document_type/index"><?= $this->lang->line('201 File Document Type') ?></a>
                                </li>
								
                            </ul>
                        </li>
						  <?php } ?>
                          <?php if ($this->user_actions->is_allowed('Admin Work Evalutiation')) { ?>  
						   <li <?= (in_array($active_menu, array('discipline_actions', 'discipline_reasons', 'discipline_category','evaluation_templates', 'evaluation_category','bir_formsb'))) ? 'class="active"' : '' ?>>
                            <a href="#">
                                <span class="nav-label"><?= $this->lang->line('Admin - Work Evaluation') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                   <li <?= (in_array($active_menu, array('discipline_actions', 'discipline_reasons', 'discipline_category'))) ? 'class="active"' : 'class="nonactive"' ;?>>
                            <a href="discipline">
                                <span class="nav-label"><?= $this->lang->line('Disciplinary Action') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'discipline_actions' ? 'class="active"' : '') ?>>
                                    <a class="li_hover" href="discipline/discipline_actions"><?= $this->lang->line('Penalty Point') ?><span class="hover_button hover_button33">Disciplinary Action Penalty Point</span></a>
                                </li>
								<li <?= ($active_menu == 'discipline_category' ? 'class="active"' : '') ?>>
                                    <a class="li_hover" href="discipline/discipline_category"><?= $this->lang->line('DA Category') ?><span class="hover_button hover_button33">Disciplinary Action Category</span></a>
                                </li>
                                <li <?= ($active_menu == 'discipline_reasons' ? 'class="active"' : '') ?>>
                                    <a class="li_hover" href="discipline/discipline_reasons"><?= $this->lang->line('DA Document Template') ?><span class="hover_button hover_button33">Disciplinary Action Document Template</span></a>
                                </li>
                            </ul>
                        </li>
						<li <?= (in_array($active_menu, array('evaluation_templates', 'evaluation_category'))) ? 'class="active"' : 'class="nonactive"' ;?>>
							<a href="discipline">
								<span class="nav-label"><?= $this->lang->line('Work Evaluation') ?></span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-third-level">
								<li <?= ($active_menu == 'evaluation_category' ? 'class="active"' : '') ?>>
									<a href="discipline/evaluation_category"><?= $this->lang->line('Evaluation Category') ?></a>
								</li>
								<li <?= ($active_menu == 'evaluation_templates' ? 'class="active"' : '') ?>>
									<a class="li_hover" href="evaluation/evaluation_templates"><?= $this->lang->line('Evaluation Doc Template') ?>
                                      <span class="hover_button hover_button33">Work Evaluaction Doc Template</span>
									</a>
								</li>
							</ul>
						</li>
						
						 <li <?= ($active_menu == 'bir_formsb' ? 'class="active"' : '') ?>>
                            <a href="settings/bir_formsb"><?= $this->lang->line('Employee Benefit') ?></a>
                        </li>
						
                            </ul>
                        </li>
						  <?php } ?>

					<?php if ($this->user_actions->is_allowed('Admin Calendar')) { ?>  
                         <li <?= (in_array($active_menu, array('schedule_item', 'customer_item'))) ? 'class="active"' : '' ?>>
                            <a href="schedule_setting">
                                <span class="nav-label"><?= $this->lang->line('Admin - Calendar') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'schedule_item' ? 'class="active"' : '') ?>>
                                    <a href="settings/schedule_items"><?= $this->lang->line('Schedule Type') ?></a>
                                </li>
                                <li <?= ($active_menu == 'customer_item' ? 'class="active"' : '') ?>>
                                    <a href="settings/customer_items"><?= $this->lang->line('Customer List') ?></a>
                                </li>
                            </ul>
                        </li>
					<?php } ?>
					<?php if ($this->user_actions->is_allowed('Setting Accounting')) { ?>  
                         <li <?= (in_array($active_menu, array('accounting', 'bir_forms', 'bank_list','petty_cash_item','monthly_bill_list'))) ? 'class="active"' : '' ?>>
                            <a href="accounting">
                                <span class="nav-label"><?= $this->lang->line('Accounting') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'bir_forms' ? 'class="active"' : '') ?>>
                                    <a href="settings/bir_forms"><?= $this->lang->line('BIR Form Registration') ?></a>
                                </li>
                                 <li <?= ($active_menu == 'bank_list' ? 'class="active"' : '') ?>>
                                    <a href="banklist/index"><?= $this->lang->line('Bank List') ?></a>
                                </li>
                                <li <?= ($active_menu == 'monthly_bill_list' ? 'class="active"' : '') ?>>
                                    <a href="monthlybilllist/index"><?= $this->lang->line('Monthly Bill List') ?></a>
                                </li>
                                <li <?= ($active_menu == 'petty_cash_item' ? 'class="active"' : '') ?>>
                                    <a href="settings/petty_items"><?= $this->lang->line('Petty Cash Item') ?></a>
                                </li>
                            </ul>
                        </li>
					<?php } ?>
						
               <?php if ($this->user_actions->is_allowed('Setting Task')) { ?> 
						 <li <?= (in_array($active_menu, array('task_status', 'task_category', 'task_type'))) ? 'class="active"' : '' ?>>
                            <a href="task_setting">
                                <span class="nav-label"><?= $this->lang->line('Task') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
    <!--                                <li <?= ($active_menu == 'task_status' ? 'class="active"' : '') ?>>
                                    <a href="settings/task_status"><?= $this->lang->line('Task Status') ?></a>
                                </li>-->
                                <li <?= ($active_menu == 'task_category' ? 'class="active"' : '') ?>>
                                    <a href="settings/task_category"><?= $this->lang->line('Task Category') ?></a>
                                </li>
								<li <?= ($active_menu == 'task_type' ? 'class="active"' : '') ?>>
                                    <a href="settings/task_type"><?= $this->lang->line('Task Type') ?></a>
                                </li>
                            </ul>
                        </li>
			   <?php } ?>
			   <?php //if ($this->user_actions->is_allowed('Setting Task')) { ?> 
						 <li <?= (in_array($active_menu, array('vendor_list', 'customer_list', 'product_list','process_list'))) ? 'class="active"' : '' ?>>
                            <a href="task_setting">
                                <span class="nav-label"><?= $this->lang->line('Production') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
									<!--<li <?= ($active_menu == 'task_status' ? 'class="active"' : '') ?>>
                                    <a href="settings/task_status"><?= $this->lang->line('Task Status') ?></a>
                                </li>-->
                                <li <?= ($active_menu == 'vendor_list' ? 'class="active"' : '') ?>>
                                    <a href="vendorlist/index"><?= $this->lang->line('Vendor List') ?></a>
                                </li>
								<li <?= ($active_menu == 'customer_list' ? 'class="active"' : '') ?>>
                                    <a href="customerlist/index"><?= $this->lang->line('Customer List') ?></a>
                                </li>
								
								<li <?= ($active_menu == 'process_list' ? 'class="active"' : '') ?>>
                                    <a href="processlist/index"><?= $this->lang->line('Process List') ?></a>
                                </li>
								<li <?= ($active_menu == 'product_list' ? 'class="active"' : '') ?>>
                                    <a href="productlist/index"><?= $this->lang->line('Product List') ?></a>
                                </li>
                            </ul>
                        </li>
			   <?php //} ?>
                        <!--li <?= ($active_menu == 'evaluation_templates' ? 'class="active"' : '') ?>>
                            <a href="evaluation/evaluation_templates"><?= $this->lang->line('Work Evaluation List') ?></a>
                        </li-->
    <!--                        <li <?= ($active_menu == 'processing_errors' ? 'class="active"' : '') ?>>
                            <a href="processing_errors"><?= $this->lang->line('Processing errors') ?></a>
                        </li>-->
                        
    <!--                        <li <?= ($active_menu == 'schedule_item' ? 'class="active"' : '') ?>>
                            <a href="settings/schedule_items"><?= $this->lang->line('Schedule Type') ?></a>
                        </li>
                        <li <?= ($active_menu == 'customer_item' ? 'class="active"' : '') ?>>
                            <a href="settings/customer_items"><?= $this->lang->line('Customer List') ?></a>
                        </li>-->
                       
                       
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<style>
.nav-third-level li.active ul li.active a {
    background: #5ba3e2;
}
.nav-third-level li.active ul li.active {
    border-left: 5px solid #18A78A;
}
.nav-third-level li.active ul li a {
   /* padding-left: 50px;*/
}
.nav-third-level li.active ul li.active a {
    padding-left: 40px;
}
.peso { font-size: 19px;  vertical-align: middle;  margin-right: 6px;}
.nav-second-level li ul li a {
    padding: 7px 3px 7px 10px;
    padding-left: 45px;
}
.nav-second-level li .arrow {
    margin-top: 5px;
    margin-right: 3px;
}
.hover_button {
    margin-left: 18%;
    margin-top: -26px;
    display: none;
    background: #000;
    position: absolute;
    z-index: 9999;
    width: 280px;
    text-align: center;
    padding: 10px 8px;
    border-radius: 8px;
    left: 180px;
    font-weight: normal;
    color: #fff;
}
.li_hover:hover > .hover_button {
    display: block;
}
.nav-second-level li a {
    padding: 7px 7px 7px 10px;
    padding-left: 26px;
}
.circle1 i.fa.fa-circle {
    color: #1ab394;
    font-size: 9px;
}
.nav > li.active {
    border-left: 0px solid #18A78A !important;
    
}
.hoveron-menu
{
	display:none;
	background: #000;
position: absolute;
z-index: 9999;
width: 231px;
text-align: center;
padding: 10px 8px;
border-radius: 8px;
left: 223px;
font-weight:normal;
color:#fff;
}
#side-menu li a:hover .hoveron-menu
{
	display:block
}
.hoveron-menu2
{
	display:none;
	background: #000;
position: absolute;
z-index: 9999;
width: 280px;
text-align: center;
padding: 10px 8px;
border-radius: 8px;
left: 223px;
font-weight:normal;
color:#fff;
}

#side-menu li a:hover .hoveron-menu2
{
	display:block
}
@media only screen and (max-width: 767px) {

	
#side-menu li ul li a span { display: block; font-size: 9px; float: left;}	
.circle1 i.fa.fa-circle{ float:left;}
#side-menu li ul li a {float: left;     padding-right: 4px;
    padding-left: 6px;   width: 100%;}
#side-menu li ul { padding-left: 0px;  padding-right: 0px;}
#side-menu li ul li a i {
    margin-right: 4px;    font-size: 7px;
 
    margin-top: 3px;
}
	
#side-menu li ul li a span.fa.arrow {
    float: right;
    padding-right: 7px;
    margin-top: 2px;
}	
.hover_button{ left:100%; margin-left:0px;}	
.hoveron-menu2{    left: 100%;}
#side-menu li ul li a{ font-size:9px;}
.hoveron-menu{ left:100%;}
#side-menu li ul li a span.hover_button { display: none;}	
.nav-second-level li, .nav-third-level li{ width:100%;    float: left;}
#side-menu li ul li a span{ text-align:left;}
.body-small .navbar-static-side { z-index: 999999;}
#side-menu li ul li a span.hoveron-menu {
    display: none;
}
#side-menu li ul li a span.hoveron-menu2 {
    display: none;
}	
	
}
.nav > li > a i {
    margin-right: 1px !important;
}




</style>
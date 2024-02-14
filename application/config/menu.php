<nav class="navbar-default navbar-static-side" role="navigation">
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
            <?php } ?>


            <?php if ($this->user_actions->is_allowed(array('admin', 'employees', 'evaluations', 'discipline','reminder','request'))) { ?>
                <li <?= (in_array($active_menu, array('employees','inactive_employees', 'employees_new', 'contract_history', 'discipline', 'discipline_new', 'evaluations', 'evaluation_new', 'evaluation_edit','employee_reminder','reminder','request','employee_request'))) ? 'class="active"' : '' ?>>
                    <a href="employees">
                        <i class="fa fa-dashboard"></i>
                        <span class="nav-label"><?= $this->lang->line('Admin') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->user_actions->is_allowed('employees')) { ?>
                            <li <?= (in_array($active_menu, array('employees', 'employees_new', 'contract_history','inactive_employees','evaluations', 'discipline','employee_reminder'))) ? 'class="active"' : '' ?>>
                                <a href="employees">
                                    <i class="fa fa-users"></i>
                                    <span class="nav-label"><?= $this->lang->line('Employees') ?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-third-level">
                                    <li <?= ($active_menu == 'employees' ? 'class="active"' : '') ?>>
                                        <a href="employees"><?= $this->lang->line('Active employees') ?></a>
                                    </li>
                                    <li <?= ($active_menu == 'inactive_employees' ? 'class="active"' : '') ?>>
                                        <a href="employees/inactive"><?= $this->lang->line('Inactive employees') ?></a>
                                    </li> 
                                 <?php if ($this->user_actions->is_allowed('evaluations')) { ?>
		                            <li <?= (in_array($active_menu, array('evaluations', 'evaluation_new', 'evaluation_edit'))) ? 'class="active"' : '' ?>>
		                                <a href="evaluation">
		                                   <?= $this->lang->line('Work Evaluation') ?>
		                                </a>
		                            </li>
		                        <?php } ?>
		                         <?php if ($this->user_actions->is_allowed('discipline')) { ?>
		                            <li <?= (in_array($active_menu, array('discipline', 'discipline_new'))) ? 'class="active"' : '' ?>>
		                                <a href="discipline"><?= $this->lang->line('201 File ( DA,CA,Etc)') ?></a>
		                            </li>
		                        <?php } ?>
								
                                </ul>
                            </li>
							 <?php if ($this->user_actions->is_allowed('reminder')) { ?>
								 <li <?= (in_array($active_menu, array('reminder', 'employee_reminder'))) ? 'class="active"' : '' ?>>
								<a href="employeereminder/index">
								 <i class="fa fa-users"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee Reminder') ?>
								</span>
								</a>
								</li>
								 <?php } ?>
								 <?php if ($this->user_actions->is_allowed('request')) { ?>
								 <li <?= (in_array($active_menu, array('request', 'employee_request'))) ? 'class="active"' : '' ?>>
								<a href="request/index">
								 <i class="fa fa-users"></i>
                        <span class="nav-label">
								<?= $this->lang->line('Employee Request') ?>
								</span>
								</a>
								</li>
								 <?php } ?>
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
            <?php if ($this->user_actions->is_allowed(array('schedule'))) { ?>
                <li <?= (in_array($active_menu, array('schedule_calendar'))) ? 'class="active"' : '' ?>>
                    <a href="schedule/index">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label"><?= $this->lang->line('Calendar') ?></span>
                    </a>
                </li>
            <?php } ?>    
            <!--
            <?php if ($this->user_actions->is_allowed('employees')) { ?>
                                                                    <li <?= (in_array($active_menu, array('employees', 'employees_new', 'contract_history'))) ? 'class="active"' : '' ?>>
                                                                        <a href="employees">
                                                                            <i class="fa fa-users"></i>
                <?= $this->lang->line('Employees') ?>
                                                                        </a>
                                                                    </li>
            <?php } ?>
			
            -->
			
            <?php if ($this->user_actions->is_allowed(array('accounting','bir_files','petty_cash','lazada','schedule_bir_calendar' ,'bir_calender_files','monthly_bill_payment','document_category_id'))) { ?>
                <li <?= (in_array($active_menu, array('accounting','bir_files','petty_cash','schedule_bir_calendar','bir_calender_files','employee_Lazada','lazada','check_writer','monthly_bill_payment','document_category_id'))) ? 'class="active"' : '' ?>>
                    <a href="accounting">
                        <i class="fa fa-calculator"></i>
                        <span class="nav-label"><?= $this->lang->line('Accounting') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ($active_menu == 'bir_files' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_files"><?= $this->lang->line('BIR File List') ?></a>
                        </li>
						<li <?= ($active_menu == 'bir_calender_files' ? 'class="active"' : '') ?>>
                            <a href="accounting/bir_calender_files"><?= $this->lang->line('BIR file ( Uplus )') ?></a>
                        </li>
			<!--			/**********************BIR calender start*****************************/     -->
			<?php 
			// echo '<pre>';
			// print_r($active_menu);
			// echo '</pre>';
			// die('ddv');
			
			?>
			<?php //if ($this->user_actions->is_allowed(array('accounting'))) { ?>
                <li <?= (in_array($active_menu, array('schedule_bir_calendar'))) ? 'class="active"' : '' ?>>
                    <a href="schedule/bir_calendar">
                        
                        <span class="nav-label"><?= $this->lang->line('BIR Calendar ') ?></span>
                    </a>
                </li>
            <?php //} ?>    
			
			
			<!--			/************************BIR calendar end***************************/     -->
						
                        <li <?= ($active_menu == 'petty_cash' ? 'class="active"' : '') ?>>
                            <a href="petty/index"><?= $this->lang->line('Petty Cash') ?></a>
                        </li>
                       
						<li <?= ($active_menu == 'check_writer' ? 'class="active"' : '') ?>>
                            <a href="checkwriter/index"><?= $this->lang->line('Check Writer') ?></a>
                        </li>
						<li <?= ($active_menu == 'monthly_bill_payment' ? 'class="active"' : '') ?>>
                            <a href="monthlybillpayment/index"><?= $this->lang->line('Monthly Bill Payment') ?></a>
                        </li>
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
						
                            <li <?= ((in_array($active_menu, $categories[2])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[2]['document_category_id'] ?>"><?= $categories[2]['document_category_name'] ?></a>
                            </li>
							
							<li <?= $active_menu == 'lazada' ? 'class="active"' : '' ?>>
                    <a href="reports/lazada">
                        <?= $this->lang->line('Lazada') ?>
                    </a>
                </li>
				 
				
				
			
   <?php //} ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if (1 == 1) { ?>
                <?php
				//$this->user_actions->is_allowed('tasks');
                $tasks_number = get_tasks_number();                
                ?>
                <li <?= (in_array($active_menu, array('tasks', 'attention_updated_tasks', 'regular_tasks', 'all_tasks', 'assigned_tasks', 'unassigned_tasks', 'completed_tasks', 'attention_tasks'))) ? 'class="active"' : '' ?>>
                    <a href="tasks">
                        <i class="fa fa-tasks"></i>
                        <span class="nav-label"><?= $this->lang->line('Tasks') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ((in_array($active_menu, array('all_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/all"><?= $this->lang->line('All Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['all']?></span>
                            </a>
                            
                        </li>
                        <li <?= ((in_array($active_menu, array('unassigned_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/unassigned"><?= $this->lang->line('UnAssigned Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['unassigned']?></span>
                            </a>
                            
                        </li>
                        <li <?= ((in_array($active_menu, array('assigned_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/assigned"><?= $this->lang->line('Assigned Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['assigned']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('attention_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/attention_tasks"><?= $this->lang->line('Tasks for Attention') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['attention_required']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('attention_updated_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/attention_updated_tasks"><?= $this->lang->line('Attention Updated') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['attention_updated']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('completed_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/completed"><?= $this->lang->line('Completed Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['completed']?></span>
                            </a>
                        </li>
                        <li <?= ((in_array($active_menu, array('regular_tasks'))) ? 'class="active"' : '') ?>>
                            <a href="tasks/index/regular"><?= $this->lang->line('Regular Tasks') ?>
                            <span class="text-warning pull-right"><?=$tasks_number['regular']?></span>
                            </a>
                        </li>

                    </ul>
                </li>
            <?php } ?>    

            <?php if ($this->user_actions->is_allowed('documents')) { ?>
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
                        <span class="nav-label"><?= $this->lang->line('Doc Templates') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
						<li <?= ($active_menu == 'documents' ? 'class="active"' : '') ?>>
                            <a href="documents"><?= $this->lang->line('All') ?></a>
                        </li>
                        <?php //foreach ($categories as $category) { ?>
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
						?>
						
                            <li <?= ((in_array($active_menu, $categories[0])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[0]['document_category_id'] ?>"><?= $categories[0]['document_category_name'] ?></a>
                            </li>
							<li <?= ((in_array($active_menu, $categories[1])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[1]['document_category_id'] ?>"><?= $categories[1]['document_category_name'] ?></a>
                            </li>
							<li <?= ((in_array($active_menu, $categories[3])) ? 'class="active"' : '') ?>>
                                <a href="documents/cat/<?= $categories[3]['document_category_id'] ?>"><?= $categories[3]['document_category_name'] ?></a>
                            </li>
                        <?php //} ?>
                    </ul>
                </li>
            <?php } ?>
			 <li <?= (in_array($active_menu, array('workmanual'))) ? 'class="active"' : '' ?>>
                    <a href="workmanual/index">
                        <i class="fa fa-files-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Work Manual') ?></span>
                    </a>
             </li>
			 
            <?php if ($this->user_actions->is_allowed(array('letters'))) { ?>
                <li <?= (in_array($active_menu, array('letters'))) ? 'class="active"' : '' ?>>
				
                    <a href="letter/index">
                        <i class="fa fa-sticky-note-o"></i>
                        <span class="nav-label"><?= $this->lang->line('Letter & Memo') ?></span>
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

            <?php if ($this->user_actions->is_allowed('performance')) { ?>
                <li <?= (in_array($active_menu, array('performance', 'performance_criteria'))) ? 'class="active"' : '' ?>>
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
                </li>
            <?php } ?>
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
              <?php } */ ?>

            <?php if ($this->user_actions->is_allowed('timeoff')) { ?>
                <li <?= (in_array($active_menu, array('timeoff', 'timeoff_requests'))) ? 'class="active"' : '' ?>>
                    <a href="timeoff">
                        <i class="fa fa-briefcase"></i>
                        <span class="nav-label"><?= $this->lang->line('Leave tracking') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ($active_menu == 'timeoff') ? 'class="active"' : '' ?>>
                            <a href="timeoff"><?= $this->lang->line('Approved') ?></a>
                        </li>
                        <li <?= ($active_menu == 'timeoff_requests') ? 'class="active"' : '' ?>>
                            <a href="timeoff/requests"><?= $this->lang->line('Requests') ?></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

				
			
            <?php if ($this->user_actions->is_allowed('recruiting')) { ?>
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

            <?php if ($this->user_actions->is_allowed('reports')) { ?>
                <li <?= (in_array($active_menu, array('work_evaluation_rules', 'reports_skills', 'reports_clock', 'report_discipline', 'employee_evaluation', 'company_rules'))) ? 'class="active"' : '' ?>>
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
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->user_actions->is_allowed('admin')) { ?>
                <li <?= (in_array($active_menu, array('document_category','requestt', 'setting_letter', 'evaluation_templates', 'customer_item', 'schedule_item', 'company_settings', 'company_email', 'company_positions', 'resign_reasons', 'departments', 'processing_errors', 'unsent_emails', 'discipline_actions', 'discipline_reasons', 'discipline_category', 'task_status', 'task_category', 'task_type','evaluation_list', 'evaluation_category', 'contract_type','bank_list','bir_forms','petty_cash_item','monthly_bill_list'))) ? 'class="active"' : ''; ?>>
                    <a href="settings/company">
                        <i class="fa fa-cogs"></i>
                        <span class="nav-label"><?= $this->lang->line('Settings') ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li <?= ($active_menu == 'company_settings' ? 'class="active"' : '') ?>>
                            <a href="settings/company"><?= $this->lang->line('Company') ?></a>
                        </li>
                        <li <?= ($active_menu == 'company_email' ? 'class="active"' : '') ?>>
                            <a href="settings/email"><?= $this->lang->line('Email') ?></a>
                        </li>                        
                        <li <?= (in_array($active_menu, array('contract_type', 'company_positions', 'departments'))) ? 'class="active"' : '' ?>>
                            <a href="discipline">
                                <span class="nav-label"><?= $this->lang->line('Employee') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'company_positions' ? 'class="active"' : '') ?>>
                                    <a href="settings/positions"><?= $this->lang->line('Desigation') ?></a>
                                </li>
                                <!--<li <?= ($active_menu == 'resign_reasons' ? 'class="active"' : '') ?>>
                                    <a href="settings/resign_reasons"><?= $this->lang->line('Resign reasons') ?></a>
                                </li>-->
                                <li <?= ($active_menu == 'departments' ? 'class="active"' : '') ?>>
                                    <a href="settings/departments"><?= $this->lang->line('Departments') ?></a>
                                </li>
                                <li <?= ($active_menu == 'contract_type' ? 'class="active"' : '') ?>>
                                    <a href="employees/contract_type"><?= $this->lang->line('Contract type') ?></a>
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
								
								
                            </ul>
                        </li>
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
                        <li <?= (in_array($active_menu, array('discipline_actions', 'discipline_reasons', 'discipline_category'))) ? 'class="active"' : 'class="nonactive"' ;?>>
                            <a href="discipline">
                                <span class="nav-label"><?= $this->lang->line('201 File') ?></span>
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-third-level">
                                <li <?= ($active_menu == 'discipline_actions' ? 'class="active"' : '') ?>>
                                    <a href="discipline/discipline_actions"><?= $this->lang->line('201 File List') ?></a>
                                </li>
								<li <?= ($active_menu == 'discipline_category' ? 'class="active"' : '') ?>>
                                    <a href="discipline/discipline_category"><?= $this->lang->line('201 File Category') ?></a>
                                </li>
                                <li <?= ($active_menu == 'discipline_reasons' ? 'class="active"' : '') ?>>
                                    <a href="discipline/discipline_reasons"><?= $this->lang->line('Reason & Details') ?></a>
                                </li>
                            </ul>
                        </li>
						<li <?= (in_array($active_menu, array('evaluation_templates', 'evaluation_category'))) ? 'class="active"' : 'class="nonactive"' ;?>>
							<a href="discipline">
								<span class="nav-label"><?= $this->lang->line(' Work Evaluation') ?></span>
								<span class="fa arrow"></span>
							</a>
							<ul class="nav nav-third-level">
								<li <?= ($active_menu == 'evaluation_category' ? 'class="active"' : '') ?>>
									<a href="discipline/evaluation_category"><?= $this->lang->line('Evaluation Category') ?></a>
								</li>
								<li <?= ($active_menu == 'evaluation_templates' ? 'class="active"' : '') ?>>
									<a href="evaluation/evaluation_templates"><?= $this->lang->line('Evaluation List') ?></a>
								</li>
							</ul>
						</li>
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
                        <!--li <?= ($active_menu == 'evaluation_templates' ? 'class="active"' : '') ?>>
                            <a href="evaluation/evaluation_templates"><?= $this->lang->line('Work Evaluation List') ?></a>
                        </li-->
    <!--                        <li <?= ($active_menu == 'processing_errors' ? 'class="active"' : '') ?>>
                            <a href="processing_errors"><?= $this->lang->line('Processing errors') ?></a>
                        </li>-->
                        <li <?= ($active_menu == 'document_category' ? 'class="active"' : '') ?>>
                            <a href="settings/document_categorys"><?= $this->lang->line('Document Category') ?></a>
                        </li>
    <!--                        <li <?= ($active_menu == 'schedule_item' ? 'class="active"' : '') ?>>
                            <a href="settings/schedule_items"><?= $this->lang->line('Schedule Type') ?></a>
                        </li>
                        <li <?= ($active_menu == 'customer_item' ? 'class="active"' : '') ?>>
                            <a href="settings/customer_items"><?= $this->lang->line('Customer List') ?></a>
                        </li>-->
                        <li <?= (in_array($active_menu, array('schedule_item', 'customer_item'))) ? 'class="active"' : '' ?>>
                            <a href="schedule_setting">
                                <span class="nav-label"><?= $this->lang->line('Calendar') ?></span>
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
                        <li <?= ($active_menu == 'setting_letter' ? 'class="active"' : '') ?>>
                            <a href="settings/letters"><?= $this->lang->line('Letter Template') ?></a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>

<style>

</style>
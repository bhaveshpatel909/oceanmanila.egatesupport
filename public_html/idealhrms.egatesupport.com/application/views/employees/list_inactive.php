<div class="col-lg-4 person_area fghj">
        <div class="contact-box">
            <a href="employees/edit_employee/<?= $employee['employee_id'] ?>">
                <div class="col-sm-3">
                    <div class="text-center">
                        <img class="img" style="width: 80%;" src="<?= $employee['avatar'] ?>">
                        <?php if ($employee['is_active'] == 1) { ?>
                            <span class="badge badge-success m-t-xs"><?= $this->lang->line('Active') ?></span>
                        <?php } else { ?>
                            <span class="badge badge-default m-t-xs"><?= $this->lang->line('Inactive') ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-8">
				<div class="row">
				<div class="col-md-6 col-sm-6">
				<h3><strong><?= $employee['name'] ?></strong></h3>
				</div>
				
				<div class="col-md-4 col-sm-4">
				<?php if ($employee['is_active'] != 1) { ?>
				<span style="padding:5px; text-align: center; display:block; border:1px solid #000;"><?= $employee['status'] ?></span>
					<!--<span style="z-index:9999;"><div class="form-group has-feedback m-t-sm">
								<select name="employee_memo" id="employee_memo" >
								
								<?php// foreach($enum_values as $enum_value){
									//if($enum_value !== Active){
									?>
								
								<option value="<?php// echo $enum_value; ?>"<?php// if($employee_memo['status']==$enum_value) echo 'selected="selected"'; ?>><?php// echo $enum_value; ?></option>
													
									<?php //}
								//	}?>
								</select>
							
                            						
                        </div></span>  -->
						
					<?php }// print_r($employee); ?>
				</div>
				<div class="col-md-12 col-sm-12">
				 <span>[<?= $employee['department_name'] ?>] <?= $employee['position_name'] ?></span>
				 
				</div>
				</div>
				<br/>
				
				<div class="row">
				<?php if ($employee['is_active'] != 1) { ?>
				<div class="col-sm-6 "><span><b><?= $this->lang->line('Employee Status Note') ?></b></span><br/><br/>
				<?php// print_r($employee) ;  ?>
				<span style="padding:7px; display:block; border:1px solid #000;"> <?= $employee['employee_status_note']   ?></span>
				</div>
				<?php } ?>
				</div>
                    
					
                   
					
                </div>
                <?php
                $diff = strtotime($employee['contract_expiry']) - strtotime(date('Y-m-d'));
                $days = 0;
                if ($diff > 0) {
                    $days = floor($diff / 86400);
                }
                ?>
                <label class="control-label text-danger " style="font-size: 17px"><?= $days ?></label>
				
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
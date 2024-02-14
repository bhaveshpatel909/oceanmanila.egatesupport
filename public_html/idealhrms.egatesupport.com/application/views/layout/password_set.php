<script>
    $('document').ready(function(){
     //init_icheck();
	   
	           $('#is_active').click(function(){

            if($(this).prop("checked") == false){

             // $("#myModal11").modal();
			 $(".first-model").hide();
			 $(".second-model").show();
  
            }

			
			  $('#hhhhh').click(function(){
				  
			    $(".first-model").show();
			 $(".second-model").hide();
				  
				  
			
			
		
			  });
        });
    })
</script>

	<script>
	$("#employee_memo option[value='Select']").each(function() {
    $(this).remove();
});
	</script>

<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="show"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Assign pending task to follow employee')?></h4>
            </div>
			<div class="first-model">
            <div class="modal-body">
                <div id="save_result2"></div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#password_tab" data-toggle="tab"><?= $this->lang->line('New password')?></a></li>
                    <li><a href="#permissions_tab" data-toggle="tab"><?= $this->lang->line('Permissions')?></a></li>
                    <li><a href="#temp_permissions_tab" data-toggle="tab"><?= $this->lang->line('Temporaray Permissions')?></a></li>
                </ul>
             
                <form action="employees/save_password" method="POST" id="save_password">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="password_tab">
                            <input type="hidden" id="employee_id" name="employee_id" value="<?= $employee_id?>">
                            <div class="form-group has-feedback">
                                <label for="new_password" class="control-label"><?= $this->lang->line('New password')?></label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="password_again" class="control-label"><?= $this->lang->line('Password again')?></label>
                                <input type="password" name="password_again" id="password_again" class="form-control" equalTo="#new_password">
                            </div>
                            <div class="form-group">
								<div class="col-md-6">
                                <div class="checkbox i-checks m-b-none">
								<?php //echo $is_active;?>
                                    <input type="checkbox" name="is_active" id="is_active" <?= ($is_active)?'checked="checked"':'data-target="#modal_window"'?> class="i-checks">
                                    <label for="is_active" class="control-label"><?= $this->lang->line('Is active')?></label>
                                </div>
                                </div>
								
								<?php //print_r($enum_values); 
							  // echo '<pre>';
							  // print_r($employee_id);
							  // echo '</pre>';
							  // die('xvdv');	?>
													
								<?php //echo "<pre>"; print_r($employee_memo); echo "</pre>";?>
						<div class="col-md-6">
							<div class="form-group has-feedback m-t-sm">
									
								<select name="employee_memo" id="employee_memo" >
									<option></option>
									<?php foreach($employee_memor as $enum_value){   ?>					
										<option value="<?php echo $enum_value['id']; ?>"<?php if($enum_value['id'] ==$employee_memo['status']) echo 'selected="selected"'; ?>><?php echo $enum_value['status']; ?></option>
														
										
									<?php }
									// }?>
									</select>			     
									</div>       						
								</div>
								
                            </div>
							
							<?php// echo $employee_memo['employee_status_note']; ?>
							<div class="form-group">
                                <div class="checkbox i-checks m-b-none">
								<label for="is_active" class="control-label"><?= $this->lang->line('Employee Status Note')?></label>
                                <input type="text" name="employee_status_note" id="employee_status_note" class="form-control required" maxlength="100" 
								value="<?= $employee_memo['employee_status_note'] ?>">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="permissions_tab">
                            <!--ul class="unstyled no-padding m-t-sm">
                            <?php foreach($this->config->item('possible_permissions') as $index=>$permission){
								 // echo '<pre>';
								 // print_r($permission);
								 // echo '</pre>';
								?>
                            <li>
                                <div class="checkbox i-checks m-b-none">
                                    <input type="checkbox" name="permissions[<?= $permission?>]" id="permission_<?= $index?>" <?= (isset($permissions[$permission]))?'checked="checked"':''?> class="i-checks">
                                    <label for="permission_<?= $index?>" class="control-label"><?= $this->lang->line(ucfirst($permission))?></label>
                                </div>
                            </li>
                            <?php }
							
							// echo '<pre>';
							// print_r($employee_memo);
							// echo '</pre>';
							?>
							
							
                            </ul-->
							<!--span class="inone">
							<b>Employee Reminder</b>&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							
							&nbsp;&nbsp;<input type="checkbox" name="write_rem"  <?= (isset($employee_memo['write_rem']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_rem" <?= (isset($employee_memo['edit_rem']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_rem" <?= (isset($employee_memo['delete_rem']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							
							</span>
							
								<span class="inone">
							<b>Work Manual</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							&nbsp;&nbsp;<input type="checkbox" name="write_man"  <?= (isset($employee_memo['write_man']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_man" <?= (isset($employee_memo['edit_man']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_man" <?= (isset($employee_memo['delete_man']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							
						</span>
							<span class="inone">
								<b>Leave Tracking</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							&nbsp;&nbsp;<input type="checkbox" name="write_lea"  <?= (isset($employee_memo['write_lea']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_lea" <?= (isset($employee_memo['edit_lea']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_lea" <?= (isset($employee_memo['delete_lea']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							</span-->
                        </div>
						<div class="tab-pane fade" id="temp_permissions_tab">
                            <ul class="unstyled no-padding m-t-sm">
							<?php $perm =$this->config->item('possible_permissions'); 
								 
								 ?>
							
                            <?php foreach($this->config->item('possible_permissions') as $key=>$perm){
								 // echo '<pre>';
								 // print_r($permission);
								 // echo '</pre>';
								?>
								<h3><?php echo $key;?>
								<hr/></h3>
								<?php foreach($perm as $index=>$permission) 
								{
									?>
                            <li>
                                <div class="checkbox i-checks m-b-none">
								
                                    <input type="checkbox" name="permissions[<?= str_replace(' ','_',$permission);?>]" id="<?= $key?>'_permission_'<?= $index?>" <?= (isset($permissions[$permission]))?'checked="checked"':''?> class="i-checks">
                                    <label for="permission_<?= $index?>" class="control-label"><?= $this->lang->line(ucfirst($permission))?></label>
                                </div>
                            </li>
							
                            <?php 
								}
								}
							
							// echo '<pre>';
							// print_r($employee_memo);
							// echo '</pre>';
							?>
							
							
                            </ul>
							<span class="inone">
							<b>Employee Reminder</b>&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							
							&nbsp;&nbsp;<input type="checkbox" name="write_rem"  <?= (isset($employee_memo['write_rem']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_rem" <?= (isset($employee_memo['edit_rem']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_rem" <?= (isset($employee_memo['delete_rem']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							
							</span>
							
								<span class="inone">
							<b>Work Manual</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							&nbsp;&nbsp;<input type="checkbox" name="write_man"  <?= (isset($employee_memo['write_man']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_man" <?= (isset($employee_memo['edit_man']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_man" <?= (isset($employee_memo['delete_man']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							
						</span>
							<span class="inone">
								<b>Leave Tracking</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							 
							
							&nbsp;&nbsp;<input type="checkbox" name="write_lea"  <?= (isset($employee_memo['write_lea']))?'checked="checked"':''?>class="i-checks" >&nbsp;&nbsp;<b>Write</b>&nbsp;&nbsp;
							
							&nbsp;&nbsp;<input type="checkbox" name="edit_lea" <?= (isset($employee_memo['edit_lea']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Edit</b>&nbsp;&nbsp;
							&nbsp;&nbsp;<input type="checkbox" name="delete_lea" <?= (isset($employee_memo['delete_lea']))?'checked="checked"':''?> class="i-checks" >&nbsp;&nbsp;<b>Delete</b>
							</span>
                        </div>
                    </div>
                </form>
            </div>
	<script>		
			$( "#employee_memo" ).change(function() {
              var status_id =($(this).val());
			 
			  var emp_id='<?= $employee_id ;?>';
			xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("demo").innerHTML = this.responseText;
  }
};
xhttp.open("GET", "ajax_info.txt?emp_id="+emp_id+'&sta='+status_id, true);
xhttp.send();
});
</script>
			<style>
.des_text { float: left; width: 60%; color: #ff6600; font-size: 15px;}	
.selectttt { float: right;}	
.body_popup { display: inline-block; width: 100%; padding-bottom: 15px;}
span.inone { display: block; width: 100%; margin: 6px 0px;}
span.inone:last-child{ margin-bottom:0px;}
.modal-footer{ margin-top:0px;}
			</style>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_password','#save_result2')"><?= $this->lang->line('Save')?></button>
            </div>
			</div>
			
			   
			<!--------------Second Model---------------->
			<div class="second-model" style="display:none;">
				
			<form action="employees/task_assignto" method="POST" id="task_assignt">
			 <div class="modal-body body_popup">
			  <div id="save_result21"></div>
			  <div class="des_text">
			  This employee has pending task, <br>
			  Pls assign his task to other employee<br>
			  before making this employee inactive
			  </div>
			 <?php //echo'<pre>';print_r($tasks);echo'</pre>';?>
				<select class="selectttt" name="employee_id" id="employee_id" >
			
					<option>Select Employee</option>
						<?php foreach($all_active_user['data'] as $all_active_usr){  ?>
					<option value="<?php echo $all_active_usr['employee_id']; ?>"><?php echo $all_active_usr['name']; ?></option>		
									<?php }
									?>
				</select>
				
		
									<input type="hidden" id="emp_id" name="emp_id" value="<?= $employee_id?>">
									
									 
									
									
									
									
									<!--<select name="employee_memo" id="employee_memo" >
									<option>Select Task</option>
									<?php //foreach ($tasks as $task) { ?>
									<option value="<?php //$task['task_title']?>"><?php //$task['task_title']?></option>
									<?php 
									 //}?>
									</select>-->
									
				
        </div>
			 <div class="modal-footer">
          <button type="button" class="btn btn-default" id="hhhhh" >Close</button>
		   <button type="submit" class="btn btn-primary" onclick="submit_form('#save_password','#save_result2')" ><?= $this->lang->line('Save')?></button>
        </div>
		</form>
			</div>
        </div>
    </div>
</div>
  
</div>

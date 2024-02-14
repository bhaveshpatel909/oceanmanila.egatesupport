<div id="" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Employee Status List') ?></h4>
            </div>
            <div class="modal-body">
			
               <form action="employees/delete_emp" method="POST" id="delete_employee_memo">
				
				<?php
				
				// echo '<pre>';
				// print_r($employee_memo);
				// echo '</pre>';
					$gidss= $_GET['page'];
						    foreach($employee_memo as $emp_memo){
						  if($emp_memo['id']==$gidss ){
					?>
                    <input type="hidden" id="employee_memo_id" name="employee_memo_id" value="<?php echo $emp_memo['id'] ?>" class="contract_type_id">
					<?php }
							} ?>
							
							<?php 
						  
						  // echo '<pre>';
						  // print_r($employee_memo);
						  // echo '</pre>';
						$gidss= $_GET['page'];
						    foreach($employee_memo as $emp_memo){
						  if($emp_memo['id']==$gidss ){
						  ?>
						  <input type="hidden" name="employee_memoo" id="employee_memo_name" class="form-control required"  value="<?php echo $emp_memo['status']; ?>">
							<?php }
							} ?>
                </form>
                <form action="employees/up_employee_memo" method="POST" id="up_employee_memo">
                   <div id="save_result2"></div>
					
					<?php
					$gidss= $_GET['page'];
						    foreach($employee_memo as $emp_memo){
						  if($emp_memo['id']==$gidss ){
					?>
                    <input type="hidden" id="employee_memo_id" name="employee_memo_id" value="<?php echo $emp_memo['id'] ?>" class="employee_memo_id">
					
					<?php }
							} ?>
					<!--<div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback m-t-sm">
                            <label for="employee_memo_name" class="control-label"><?php//= $this->lang->line('Employee name') ?><sup class="mandatory">*</sup></label>
                            <input type="text" name="employee_memo_name" id="employee_memo_name" class="form-control required" maxlength="100" value="<?php//= $employee_memo['name'] ?>">
                        </div>
                    </div> -->
					
					
					<div class="row">
					<div class="col-lg-6 col-sm-6" style="padding-left: 0;">
					
                        <div class="form-group has-feedback m-t-sm">
                            <label for="employee_memo_name" class="control-label"><?= $this->lang->line('Status Item') ?><sup class="mandatory">*</sup></label>
						
                        </div>
                    </div>
					
					<div class="col-lg-6 col-sm-6" style="padding-left: 0;">
					
                        <div class="form-group has-feedback m-t-sm">
                        <!--  <label for="employee_memo_name" class="control-label"><?php//= $this->lang->line('Employee Status') ?><sup class="mandatory">*</sup></label>--> 
						  <?php 
						  
						  // echo '<pre>';
						  // print_r($employee_memo);
						  // echo '</pre>';
						$gidss= $_GET['page'];
						    foreach($employee_memo as $emp_memo){
						  if($emp_memo['id']==$gidss ){
						  ?>
						  <input type="text" name="employee_memoo" id="employee_memo_name" class="form-control required"  value="<?php echo $emp_memo['status']; ?>">
							<?php }
							} ?>
                        </div>
                    </div>  
				<!--	<div class="col-lg-6 col-sm-6" style="padding-left: 0;">
					
                        <div class="form-group has-feedback m-t-sm">
								<select name="employee_memo" id="employee_memo" >
								
								<?php// foreach($enum_values as $enum_value){?>
								
								<option value="<?php// echo $enum_value; ?>"<?php// if($employee_memo['status']==$enum_value) echo 'selected="selected"'; ?>><?php// echo $enum_value; ?></option>
													
								<?php// }?>
								</select>
							
                            						
                        </div>
                    </div> -->
				
					
					
                    </div>
				
					

                    
                    
                </form>
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete discipline reason ?') && submit_form('#delete_employee_memo', '#save_result2')"><?= $this->lang->line('Delete') ?></button> 
                <button type="button" class="btn btn-default savereload" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#up_employee_memo', '#save_result2')"><?= $this->lang->line('Save') ?></button> 
            </div>
        </div>
    </div>
</div>
<?php $content = addslashes($contract_type["content"]);?>
<script type="text/javascript">
    $(document).ready(function () {
		
		$('.close').click(function() {
    location.reload();
});
		$('.savereload').click(function() {
    location.reload();
});
		
        $('.summernote-modal').summernote({
            height: 200,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
        var content = $('textarea[name="content"]').text();
        $('.summernote-modal').summernote('code', content);
    });
</script>
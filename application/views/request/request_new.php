<script>
    var employees_list, positions_list, departments_list;
    $('document').ready(function () {
        init_icheck();

        $('#permissions_all').on('ifToggled', function (event) {
            $('#more_permissions').toggleClass('hide')
        });

        employees_list = $('#employees_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_employee'
        });

        positions_list = $('#positions_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_position'
        });

        departments_list = $('#departments_list').magicSuggest({
            allowFreeEntries: false,
            data: 'documents/find_department'
        });
        $("#document_category_id").select2({
            placeholder: "Select Category",
            allowClear: true
        });
        
        $('.summernote-modal').summernote({
            height: 150,
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
    });
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?php echo  $ggfg = $emppdata[0]['name']; ?>
				</h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="request/update_request" method="POST" id="save_document">
				<?php 
				// echo '<pre>';
				// print_r($_GET['cat']);
				// echo '</pre>';
				// die('vfvf');
				$cat = $_GET['cat'];
				?>
				     <input type="hidden" name="emp_name" id="emp_name" value="<?php echo  $ggfg = $emppdata[0]['name']; ?>">
                    <input type="hidden" name="document_id" id="document_id" value="0">
                    <div class="form-group">
                        <label class="control-label"><?= $this->lang->line('Permissions') ?></label>
                        <div class="checkbox i-checks">
                            <input type="checkbox" name="permissions_all" id="permissions_all" checked="checked" class="i-checks">
                            <label for="permissions_all" class="control-label"><?= $this->lang->line('For everyone') ?></label>
                        </div>

                        <div class="hide" id="more_permissions">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#employees_tab" data-toggle="tab"><?= $this->lang->line('Employees') ?></a></li>
                                <li><a href="#positions_tab" data-toggle="tab"><?= $this->lang->line('Positions') ?></a></li>
                                <li><a href="#request_tab" data-toggle="tab"><?= $this->lang->line('Request') ?></a></li>
                            </ul>

                            <div class="tab-content space-15">
                                <div class="tab-pane fade active in" id="employees_tab">
                                    <input type="text" id="employees_list" name="employees_list">
                                </div>
                                <div class="tab-pane fade" id="positions_tab">
                                    <input type="text" id="positions_list" name="positions_list">
                                </div>
                                <div class="tab-pane fade" id="request_tab">
                                    <input type="text" id="request_list" name="request_list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php $this->load->view('mix/attachments_list', array('attachments' => array())) ?>
<!--                        <label class="control-label" for="document"><?= $this->lang->line('Document') ?><sup class="mandatory">*</sup></label>
                        <div class="file">
                            <div class="file-name" id="document_area">
                                <input type="file" name="document" id="document" class="required">
                            </div>
                        </div>-->
                    </div>
					<?php 
					
						
						?>
                    <div class="form-group">
                        <label class="control-label" for="document_category_id"><?= $this->lang->line('Category') ?><sup class="mandatory">*</sup></label>
                        <?php
                         $catss= $_GET['cat'];
						//$categories = get_document_category(); 
						// if($catss=="")
						// {
							// echo '<pre>';
							// print_r($category);
							// echo '</pre>';
							//echo $category_id;
						?>
                        
                        <select name="request_category_id" id="request_category_id" class="form-control required">
                            <option value="">Select</option>
                            <?php foreach ($request as $category) { ?>
                                <option <?php echo ($document['request_category_id']== $category['requestlist_id'])? 'selected' : ''?> value="<?= $category['requestlist_id'] ?>"><?= $category['request_name'] ?></option>
                            <?php } ?>
                        </select>
						
						
						 <input type="hidden" name="status" id="status" style="width: 20px; height: 30px;" 
						value="0"  class="form-control required" />
						<?php //}
						//else {
						
						?>
						  <!--<input type="text" name="request_category_id" value="<//?php echo $catss;?> " readonly id="request_category_id" class="form-control required" />-->
                   <?php //} ?>
				   
				   
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Description') ?></label>
                        <input type="text" name="description" id="description" class="form-control required" />
                   
				   </div>
                    <div class="form-group">
                        <label class="control-label" for="description"><?= $this->lang->line('Content') ?></label>
                        <textarea rows="4" name="content" id="content" class="form-control summernote-modal"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_document', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
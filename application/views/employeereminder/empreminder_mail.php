<script>
    var employees_list,positions_list,departments_list;
    $('document').ready(function(){
        init_icheck();
        
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
        
        $('#permissions_all').on('ifToggled', function(event){
            $('#more_permissions').toggleClass('hide')
        });
        $("#document_category_id").select2({
            placeholder: "Select Category",
            allowClear: true
        });
        
        employees_list=$('#employees_list').magicSuggest({
            allowFreeEntries:false,
            data:'documents/find_department'
        });
        
        <?php if (isset($document['permissions']['employees'])){?>
        employees_list.addToSelection(<?= json_encode($document['permissions']['employees'])?>);
        <?php }?>
            
        
        positions_list=$('#positions_list').magicSuggest({
            allowFreeEntries:false,
            data:'documents/find_position'
        });
        
        <?php if (isset($document['permissions']['positions'])){?>
        positions_list.addToSelection(<?= json_encode($document['permissions']['positions'])?>);
        <?php }?>
        
        
        departments_list=$('#departments_list').magicSuggest({
			 placeholder: "select departments",
            allowFreeEntries:false,
            data:'documents/find_department'
			
        });
		
        
        <?php if (isset($document['permissions']['departments'])){?>
        departments_list.addToSelection(<?= json_encode($document['permissions']['departments'])?>);
        <?php }?>
    })
</script>


<style>

.dropdown-menu > div:nth-child(2)
{
  color:red;	
}

.dropdown-menu > div:nth-child(2)
{
  option:selected;	
}


</style>
<?php $this->load->view('mix/attachment_remove') ?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title">Document Mail</h4>
            </div>
            <div class="modal-body">
			 <h4 class="modal-title" style="color:#358635;"><?php echo $result; ?></h4>
                <div id="save_result2"></div>
                <form action="workmanual/delete_document" method="POST" id="delete_document">
                    <!--<input type="hidden" id="document_id" name="document_id" value="<//?= $document['workmanual_id']?>">-->
                </form>
                <form action="employeereminder/mail_empreminder" method="POST" id="save_document">
                   <!-- <input type="hidden" name="document_id" id="document_id" value="<//?= $document['workmanual_id']?>">-->
                    <div class="form-group">
                        
                        <?php $id = $_GET['id']; ?>
                        <div >
                           <!-- <ul class="nav nav-tabs">
                              <li class="active"><a href="#employees_tab" data-toggle="tab"><//?= $this->lang->line('Employees')?></a></li>
                              <li><a href="#positions_tab" data-toggle="tab"><//?= $this->lang->line('Positions')?></a></li>
                              <li><a href="#departments_tab" data-toggle="tab"><//?= $this->lang->line('Departments')?></a></li>
                            </ul>-->
                            <?= $this->lang->line('Departments')?>
                            <div class="tab-content space-15">
							 <input type="hidden" id="idwork"  value="<?php echo $id; ?>" name="idwork">
                                <div  class="tab-pane fade active in" id="employees_tab">
                                    <input type="text"  id="employees_list"  name="employees_list">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                   
                
                
                    
                </form>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-danger pull-left" onclick="confirm('Delete document ?') && submit_form('#delete_document','#save_result2')"><//?= $this->lang->line('Delete')?></button>-->
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close')?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_document','#save_result2')"><?= $this->lang->line('Send')?></button>
            </div>
        </div>
    </div>
</div>
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
            data:'documents/find_employee'
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
            allowFreeEntries:false,
            data:'documents/find_department'
        });
        
        <?php if (isset($document['permissions']['departments'])){?>
        departments_list.addToSelection(<?= json_encode($document['permissions']['departments'])?>);
        <?php }?>
    })
</script>
<style>
.dataTables_wrapper th:nth-child(1)
{
width:6%;	
}
.dataTables_wrapper td:nth-child(1)
{
width:6%;	
}
.first-box2
{
	width:50%;
	float:left;
}
.first-box2 strong
{
	margin-right:5px;
	
}
.first-box2 span
{
	
}
.second-row 
{
	width:100%;
	float:left;
}
.second-row strong
{
margin-right:5px;
	float:left;	
}
.second-row span
{
	float:left;
	width:78%;
}
.third-row
{
	width:100%;
	float:left;
}
.third-row strong
{
margin-right:5px;
	float:left;	
}
.third-row span
{
	float:left;
	width:78%;
}
.modal-body
{
	width:100%;
	float:left;
}
.modal-footer
{
width:100%;
	float:left;	
}
.modal-content
{
width:100%;
	float:left;	
}
.outer-info
{
	width:100%;
	float:left;
	margin-bottom:10px;
}
.modal-content .btn-default
{
	margin:10px;
}
.modal-dialog {
    width: 950px;
}
</style>

<?php $this->load->view('mix/attachment_remove') ?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close')?></span></button>
                <h4 class="modal-title">Document Details </h4>
            </div>
		
		<p style="display:none;">	<?php  $document['workmanual_id']?></p>
			
			
			    <div  style="display:none;">
                           
                            <?php foreach ($deparment as $category) { ?>
                                <p style="display:none" <?php echo ($document['workmanual_category_id'] == $category['department_id'])? 'selected' : ''?> value="<?= $category['department_id'] ?>"><?= $category['department_name'] ?></p>
                            <?php } ?>
                        </div>
			
			
            <div class="modal-body">
<div class="outer-info">
<div class="rTableCell first-box2"><strong>Date:</strong> <span> <?= $document['uploaded']?></span></div>
<div class="rTableCell first-box2"><strong>Category Name:</strong><span> <?= $category['department_name'] ?> </span></div>
</div>	




		<div class="outer-info">
<div class="rTableCell second-row"><strong>Description:</strong> <span><?= $document['description']?></span></div>
</div>


<div class="outer-info">
<div class="rTableCell third-row"><strong>Content:</strong> <span><?= $document['content']?></span></div>
</div>

</div>

<button type="button" style="margin-top: -14px;float: right;"

    class="btn btn-default" data-dismiss="modal" ><?= $this->lang->line('Close')?></button>		
    </div>
	

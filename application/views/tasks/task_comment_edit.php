<script>
    $('document').ready(function () {
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
        var comment = $('textarea[name="comment"]').text();
        $('.summernote-modal').summernote('code', comment);
    });
    
    function update_comment(f) {
        var url = $(f).attr('action');
        var comment = $('.summernote-modal').eq(0).summernote('code');

        $('#save_result2').html('<img src="images/ajax-loader.gif" />');
        var comment_id = $('#task_comment_id').val();
        $.ajax({
            url: url,
            type: 'POST',
       data: {'task_comment_id': $('#task_comment_id').val(), 'task_id': $('#task_id').val(), 'comment': comment},
            success: function (response) {
                $('#save_result2').html('<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));?>');
                $('#comment_' + comment_id).html(comment);
            }
        });

    }
</script>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Edit Comment') ?></h4>
            </div>
            <div class="modal-body">
                <form action="tasks/delete_task_comment" method="POST" id="delete_task_comment">
                    <input type="hidden" id="task_comment_id" name="task_comment_id" value="<?= $task_comment['id'] ?>" class="task_comment_id">
                </form>
                <form action="tasks/save_edit_comment" method="POST" id="save_edit_comment">
                    <div id="save_result2"></div>
                    <input type="hidden" id="task_comment_id" name="task_comment_id"  value="<?= $task_comment['id']?>" class="task_comment_id">
                    <input type="hidden" id="task_id" name="task_id"  value="<?= $task_comment['task_id']?>" class="task_id">

                    <textarea class="form-control summernote-modal" id="comment" name="comment"><?= $task_comment['comment']?></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="update_comment('#save_edit_comment')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
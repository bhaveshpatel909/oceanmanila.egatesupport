<?php $this->load->view('layout/success',array('message'=>$this->lang->line(is_numeric($result['result'])?'Added':'Updated')))?>
<script>
    $('document').ready(function(){
    <?php if (is_numeric($result['result'])){?>
    $('#document_id').val(<?= $result['result']?>);
    $('#documents_list').append('<div class="col-lg-3 col-sm-3 col-xs-12 col-md-3" id="document_<?= $result['result']?>"><div class="file"><a data-toggle="modal" href="documents/edit_document/<?= $result['result']?>" data-target="#modal_window"><div class="icon"><i class="fa <?= get_fa_extension($result['extenstion'])?>"></i></div><div class="file-name wrapword"><?= $result['file']?><br><small class="description"><?= $result['description']?></small></div></a></div></div>');
    $('.modal-title').html('<?= $result['file']?>');
    $('label[for=document]').html('<?= $this->lang->line('Document')?>');
    $('#document_area').html('<a href="documents/download_document/<?= $result['result']?>" target="_blank"><i class="fa <?= get_fa_extension($result['extenstion'])?> fa-1-5x"></i> <?= $result['file']?></a>');
    <?php }else{?>
        $('#document_'+$('#document_id').val()+' .description').html($('#description').val());
    <?php }?>
})
</script>
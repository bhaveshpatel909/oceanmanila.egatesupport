<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Saved'))); ?>
<script>
    $('document').ready(function(){
        $('.avatar').attr('src','<?= $this->session->current->userdata('avatar')?>');
        $('.user_name').html('<?= $this->session->current->userdata('name')?>');
        $('#avatar_img').attr('src','<?= $this->session->current->userdata('avatar')?>?t=<?= time()?>');
        $("#employee_avatar").val('');
    })
</script>
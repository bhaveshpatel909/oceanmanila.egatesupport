<?php if ($avatar){?>
<script>
    $('document').ready(function(){
        $('#avatar_img').attr('src','<?= $avatar?>?t=<?= time()?>');
        $("#employee_avatar").val('');
    })
</script>
<?php }?>

<?php if ($sign){?>
<script>
    $('document').ready(function(){
        $('#signimg').attr('src','<?= $sign?>?t=<?= time()?>');
        $("#signimag_1").val('');
    })
</script>
<?php }?>





<?php if (is_numeric($result)){
$this->load->view('layout/success',array('message'=>$this->lang->line('Added')));
$this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'employees/edit_employee/'.$result));
}else{
    $this->load->view('layout/success',array('message'=>$this->lang->line('Updated')));
}?>
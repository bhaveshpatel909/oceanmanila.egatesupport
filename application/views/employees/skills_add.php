<?php 
    $this->load->view('layout/success',array('message'=>$this->lang->line('Changed')));
?>
<script>
    $('document').ready(function(){
        $("#employees_skills").html('<img src="images/ajax-loader.gif"/>');
        $.ajax({
            url:$('#employees_skills').attr('ajax_link'),
            success:function(html){
                $('#employees_skills').html(html);
            }
        })
    })
</script>
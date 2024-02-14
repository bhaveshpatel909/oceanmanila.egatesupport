<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Added')))?>
<script>
    $('document').ready(function(){
        $("#employees_positions").html('<img src="images/ajax-loader.gif"/>');
        $.ajax({
            url:$('#employees_positions').attr('ajax_link'),
            success:function(html){
                $('#employees_positions').html(html);
                $("#modal_window").modal('hide');
            }
        })
    })
</script>
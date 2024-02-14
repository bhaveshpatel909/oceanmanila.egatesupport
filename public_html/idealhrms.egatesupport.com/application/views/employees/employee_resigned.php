<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Done')))?>
<script>
    $('document').ready(function(){
        $("#employees_positions").html('<img src="images/ajax-loader.gif"/>');
        $.ajax({
            url:$('#employees_positions').attr('ajax_link'),
            success:function(html){
                $('#employees_positions').html(html);
                $("#modal_window").modal('hide');
                $("#position_actions").remove();
                $("#employee_status").html('<?= $this->lang->line('Resigned')?>');
            }
        })
    })
</script>
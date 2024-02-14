<?php $this->load->view('layout/success',array('message'=>$this->lang->line(is_numeric($result)?'Added':'Updated')))?>
<script>
    $('document').ready(function(){
        <?php if (is_numeric($result)){?>
        $('.employment_id').val(<?= $result?>);
        <?php }?>
        $("#employees_employment").html('<img src="images/ajax-loader.gif"/>');
        $.ajax({
            url:$('#employees_employment').attr('ajax_link'),
            success:function(html){
                $('#employees_employment').html(html);
            }
        })
    })
</script>
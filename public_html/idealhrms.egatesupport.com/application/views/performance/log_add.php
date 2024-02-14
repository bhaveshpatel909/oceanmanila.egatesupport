<?php $this->load->view('layout/success',array('message'=>$this->lang->line('Added')))?>
<script>
    $('document').ready(function(){
        var new_element='<div class="feed-element" id="log_<?= $log_id?>"><div class="pull-right"><span class="text-navy">'+$('#date').val()+'</span>&nbsp;<button type="button" class="btn btn-sm btn-danger" onclick="delete_log(<?= $log_id?>)"><i class="fa fa-trash-o"></i></button></div><div class="clearfix"></div><p class="text-justify">'+$('#comment').val()+'</p><ul class="unstyled">';
        
        $('.modal-body .rating input[type=hidden]').each(function(){
            if ($(this).val())
            {
                new_element+=('<li>'+$(this).parent().parent().find('.criterion_name').html()+'<span class="rating" data-score="'+$(this).val()+'"></span></li>');
            }
        })
        
        new_element+='</ul></div>';
        
        $('#performance_logs').append(new_element);
        $("#performance_logs .rating").raty({
            readOnly:true,
            score: function() {
                return $(this).attr('data-score');
            }
        });
    })
</script>
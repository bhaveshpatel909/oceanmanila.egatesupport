<script>
    $('document').ready(function(){
        $('body').on('click','.remove_attachment',function(){
            if (confirm('<?= $this->lang->line('Are you sure?')?>'))
            {
                attachment_id = $(this).attr('attachment_id');
                $("#attachment_"+attachment_id).remove();
                $.ajax({
                    url:'employees/remove_attachment/'+attachment_id
                })
            }
        })
    })
</script>
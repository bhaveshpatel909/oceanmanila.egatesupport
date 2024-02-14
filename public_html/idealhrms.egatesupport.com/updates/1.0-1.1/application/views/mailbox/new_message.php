<script>
    $('document').ready(function(){
        $("#messages_list").append('<div class="feed-element" id="message_<?= $message_id?>"><img alt="image" class="img-circle pull-left" src="<?= $this->session->current->userdata('avatar')?>"><div class="media-body "><div class="pull-right"><div><?= date($this->config->item('date_format').' '.$this->config->item('time_format'))?></div><button type="button" class="btn btn-sm btn-danger pull-right remove_message" message_id="<?= $message['message_id']?>"><i class="fa fa-trash-o"></i></button></div><strong><?= $this->session->current->userdata('full_name')?></strong><br/><p><?= nl2br($message)?></p></div></div>');
        $('#message').val('');
        $("html, body").animate({ scrollTop: $(document).height() },1);
    })
</script>
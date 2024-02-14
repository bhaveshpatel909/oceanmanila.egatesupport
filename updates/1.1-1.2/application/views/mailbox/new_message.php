<script>
    $('document').ready(function(){
        <?php 
            $attachments=(!is_null($message['attachments']))?$this->load->view('mix/attachments_list',array('readonly'=>TRUE,'attachments'=>json_decode('['.$message['attachments'].']',TRUE),'base_url'=>'profile'),TRUE):'';
            $attachments=str_replace("\r\n",'',$attachments);
        ?>
        
        $("#messages_list").append('<div class="feed-element" id="message_<?= $message['message_id']?>"><img alt="image" class="img-circle pull-left" src="<?= $message['avatar']?>"><div class="media-body "><div class="pull-right"><div><?= date($this->config->item('date_format').' '.$this->config->item('time_format'))?></div><button type="button" class="btn btn-sm btn-danger pull-right remove_message" message_id="<?= $message['message_id']?>"><i class="fa fa-trash-o"></i></button></div><strong><?= $this->session->current->userdata('full_name')?></strong><br/><p><?= nl2br($message['message'])?></p><?= $attachments?></div></div>');
        $('#message').val('');
        $("html, body").animate({ scrollTop: $(document).height() },1);
    })
</script>
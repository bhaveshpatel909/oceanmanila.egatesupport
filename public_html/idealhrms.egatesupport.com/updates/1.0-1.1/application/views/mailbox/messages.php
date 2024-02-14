<?php foreach(array_reverse($messages) as $message){?>
<div class="feed-element" id="message_<?= $message['message_id']?>">
    <img alt="image" class="img-circle pull-left" src="<?= $message['avatar']?>">
    <div class="media-body ">
        <div class="pull-right">
            <div><?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($message['date']))?></div>
            <?php if ($message['author_id']==$this->session->current->userdata('employee_id')){?>
                <button type="button" class="btn btn-sm btn-danger pull-right remove_message" message_id="<?= $message['message_id']?>">
                    <i class="fa fa-trash-o"></i>
                </button>
            <?php }?>
        </div>
        <strong><?= $message['name']?></strong><br/>
        <p><?= $message['message']?></p>
    </div>
</div>
<?php }?>
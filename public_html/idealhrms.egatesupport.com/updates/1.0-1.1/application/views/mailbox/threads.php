<?php foreach($threads['data'] as $thread){?>
<tr class="<?= ($thread['new_message']=='1'?'unread':'read')?>">
    <td class="mail-ontact"><a href="mailbox/thread/<?= $thread['thread_id']?>">
        <img src="<?= $thread['avatar']?>" class="col-lg-4 img-circle">
        <?= $thread['name']?>
    </a></td>
    <td class="mail-subject"><a href="mailbox/thread/<?= $thread['thread_id']?>"><?= $thread['subject']?></a></td>
    <td class="text-right mail-date" title="<?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($thread['last_message']))?>"><?= date($this->config->item('date_format'),strtotime($thread['last_message']))?></td>
</tr>
<?php }?>
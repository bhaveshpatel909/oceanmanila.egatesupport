<?php foreach($clock as $item){?>
<div class="feed-element">
    <p class="text-justify">
        <span class="text-navy"><?= dates_format($item['start_time'],$item['end_time'])?></span>
        <br/><?= $item['comments']?>
    </p>
</div>
<?php }?>
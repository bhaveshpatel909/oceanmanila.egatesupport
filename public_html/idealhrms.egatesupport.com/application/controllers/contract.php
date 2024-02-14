<div class="feed-activity-list" id="contract_list">
    <?php foreach ($contracts as $item) { ?>
        <div class="feed-element" id="contract_<?= $item['contract_id'] ?>">
            <a data-toggle="modal" href="employees/edit_contract/<?= $item['contract_id'] ?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
                <i class="fa fa-edit"></i>
            </a>
            <a style="margin-right: 5px;" target="_blank" href="employees/print_contract/<?php echo $item['contract_id'] ?>" class="btn btn-outline btn-primary btn-xl pull-right">
                <i class="fa fa-file-pdf-o"></i>
            </a>
            <div class="col-lg-4">
                <strong class="contract"><?= $item['contract_type_name'] ?></strong><br>
                <small><span>Salary:</span> <span class="autoNumeric"><?= $item['contract_salary'] ?></span></small><br>
                <small><span>Expiration Date:</span> <i class="start_date"><?= $item['contract_expiry'] ? date($this->config->item('date_format'), strtotime($item['contract_expiry'])) : '' ?></i> </small>
            </div>
            <div class="col-lg-4">
                <?php foreach ($item['attachments'] as $attachment) { ?>
                    <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                        <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>"download="<?php echo base_url('files/attachments/' . $attachment['file']) ?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } else { ?>
                        <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<script>
    $(document).ready(function () {
        var options = {aSep: ',', aDec: '.', aSign: '₱ ', mDec: 0};
        $('.autoNumeric').autoNumeric('init', options);
    });
</script>
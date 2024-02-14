<tr>
    <td>
	<?php
	// echo "<pre>";
	//print_R($petty_items);
	?>
        <select name="petty_item_id[]" class="form-control">
            <option value=""></option>
            <?php foreach ($petty_items as $petty_item) { ?>
                <option value="<?= $petty_item['id'] ?>"><?= $petty_item['name'] ?></option>
            <?php } ?>
        </select>
    </td>
    <td><textarea name="item_description[]" class="form-control"></textarea></td>
    <td>
        <input type="text" name="amount[]" class="form-control item-amount">
        <input type="hidden" name="petty_detail_id[]" value="0">
    </td>
</tr>
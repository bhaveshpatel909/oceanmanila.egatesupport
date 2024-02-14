<tr>
    <td>
        <select name="petty_item_id[]" class="form-control">
            <option value=""></option>
            <?php foreach ($petty_items as $petty_item) { ?>
                <option value="<?= $petty_item['id'] ?>"><?= $petty_item['name'] ?></option>
            <?php } ?>
        </select>
    </td>
    <td><textarea name="item_description[]" class="form-control"></textarea></td>
	 <td><input type="text" name="company[]" id="company"  class="form-control item-amount "></td>
    <td><input type="text" name="tin[]" id="tin"  class="form-control  item-amount "></td>
    <td>
        <input type="text" name="amount[]" class="form-control item-amount">
        <input type="hidden" name="petty_detail_id[]" value="0">
    </td>
</tr>
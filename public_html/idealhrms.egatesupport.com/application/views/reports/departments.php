<script>
    $('document').ready(function(){
        $('#department').magicSuggest({
            allowFreeEntries:false,
            data:<?= json_encode($departments)?>,
            valueField:'department_id',
            displayField:'department_name',
            maxSelection:1
        });
    })
</script>
<div class="form-group has-feedback">
    <label for="department" class="control-label"><?= $this->lang->line('Department')?><sup class="mandatory">*</sup></label>
    <input type="text" name="department" id="department" class="form-control">
</div>
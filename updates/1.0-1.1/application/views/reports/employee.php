<script>
    $('document').ready(function(){
        $('#employee').magicSuggest({
            allowFreeEntries:false,
            data:'reports/find_employee',
            maxSelection:1
        });
    })
</script>
<div class="form-group">
    <label for="employees"><?= $this->lang->line('Employee')?></label>
    <input type="text" id="employee" name="employee">
</div>
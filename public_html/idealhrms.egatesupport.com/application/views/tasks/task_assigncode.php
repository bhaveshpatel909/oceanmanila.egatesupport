<script>

    // var employees_list
    // $('document').ready(function () {
        // var ms = $('#taskcod').magicSuggest({
            // placeholder: 'Assign task code',
            // allowFreeEntries: false,
            // data: 'tasks/find_taskcode',
            // maxSelection: 1
        // });
        // $(ms).on('selectionchange', function (e, m) {
                // $('#taskcodid').val(this.getValue());
            // });
    // });
	
	
</script>
<?php
// echo'<pre>';
// print_r($task_idss);
// print_r($taskcood);
// echo'</pre>';
?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Assign Task Code') ?></h4>
            </div>
            <div class="modal-body">
                <div id="save_result2"></div>
                <form action="tasks/save_codeassignment" method="POST" id="save_codeassignment">
                    <input type="hidden" name="task_ids" id="task_ids" value='<?= $task_idss ?>'>
                    <div class="form-group" style="font-size:16px">
                        <select id="taskcod" name="taskcod" style="width:80%;height:45px;">
							<option value="">Select Code</option>
							<?php
							foreach($taskcood as $cood){ ?>
								<option value="<?= $cood['id']; ?>"><?= $cood['code']; ?>-<?= $cood['type']; ?></option>
							<?php } ?>
                        </select>
                    </div>
					<div class="modal-footer">
					<button type="submit" class="btn btn-primary" onclick="submit_form('#save_codeassignment', '#save_result2')" ><?= $this->lang->line('Save') ?></button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
					</div>
                </form>
            </div>
            
                
                
            
        </div>
    </div>
</div>
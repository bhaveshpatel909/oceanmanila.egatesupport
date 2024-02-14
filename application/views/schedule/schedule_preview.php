<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 130% !important;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Preview Schedule') ?></h4>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Employee:</label></div>
                    <div class="col-lg-10"><?= $schedule['employee_name']?></div>
                </div>
                <div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Date:</label></div>
                    <div class="col-lg-10"><?= date('Y-m-d H:i',  strtotime($schedule['start_date']))?></div>
                </div>
				<div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Update Time:</label></div>
					<?php if($schedule['updated_date']!="")
					{
						?>
                    <div class="col-lg-10"><?= date('Y-m-d H:i',  strtotime($schedule['updated_date']))?></div>
					<?php 
					}
					else
					{
						?>
						 <div class="col-lg-10"></div>
						<?php
					}
					?>
                </div>
                <div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Item:</label></div>
                    <div class="col-lg-10"><?= $schedule['item_name']?></div>
                </div>
                <div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Customer:</label></div>
                    <div class="col-lg-10"><?= $schedule['customer_name']?></div>
                </div>
                <div class="row">
                    <div class="col-lg-2"><label for="" class="control-label">Remarks:</label></div>
                    <div class="col-lg-10"><?= $schedule['remarks']?></div>
                </div>
				<?php if($schedule['remarks_admin'] != ''){?>
				 <div class="row">
                    <div class="col-lg-2"><label for="remarks_admin" class="control-label">Admin Remarks:</label></div>
					
                    <div class="col-lg-10"><p style="color:red;font-weight:bolder;"><?= $schedule['remarks_admin']?></div>
                </div>
				<?php } ?>
				<?php if($schedule['remarks_employe'] != ''){
					
					$empd=$schedule['remarks_employe_detail'];
					$str = $empd;
					$name = explode(',',$str);
					?>
				 <div class="row">
                    <div class="col-lg-12"><label style="color:green;font-weight:bolder;"><?php echo $name[0].'&nbsp;&nbsp;(&nbsp;'.$name[1].'&nbsp;)&nbsp;&nbsp;'?> Remarks :</label></div>
					<div class="col-lg-2"></div>
                    <div class="col-lg-10"><p style="color:red;font-weight:bolder;"><?= $schedule['remarks_employe']?></div>
                </div>
				<?php } ?>
				
					
            </div>
            <div class="modal-footer">
			<?php
               if(isset($perrmi['Edit_Calandare_Schedule']) || isset($perrmi['global_admin']))
				{	?>	
                <a href="schedule/edit_schedule/<?= $schedule['schedule_id']?>" class="btn btn-default"><?= $this->lang->line('Edit') ?></a>
				<?php } ?>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <a class="btn btn-primary" href="schedule/print_schedule/<?= $schedule['schedule_id']?>" target="_blank" ><?= $this->lang->line('Print') ?></a>
                
            </div>
        </div>
    </div>
</div>
<?php $pdata = json_decode($postdata);
			?>
<button type="button" class="btn btn-success pull-right" style="margin-right: 20px;">
                                                <i class="fa fa-file-pdf-o"></i>
                                                <a href ="employees/printbdaylisst_report?start_date=<?php echo $pdata->start_date;?>&end_date=<?php echo $pdata->end_date;?>" style ="color:#fff;"><?= $this->lang->line('Print List') ?></a>
                                            </button>                   
				   <table class="table table-striped table-bordered table-hover data_tablee">
		
			<thead>
				<tr>
				  
					<th  style="width: 8%; text-align: center;"><?= $this->lang->line('Employee Name') ?></th>
					<th style="width: 12%; text-align: center;"><?= $this->lang->line('Employee No.') ?></th>
					<th style="width: 8%; text-align: center;"><?= $this->lang->line('Birthday date') ?></th>
					<!--th style="width: 11%; text-align: center;"><?= $this->lang->line('Working Hour') ?></th>
					<th  ><?= $this->lang->line('Comments') ?></th-->
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($employees))
			{
				foreach($employees as $employ)
				{
					?>
					<tr>
					<td><?php echo $employ['name'];?></td>
					<td><?php echo $employ['employee_no'];?></td>
					<td><?php echo $employ['birth_date'];?></td>
					<!--td><?php echo $employ['name'];?></td-->
					</tr>
					<?php
				}
			}
			?>
			</tbody>
			<tfoot>
			</tfoot>
			</table>
			
			 
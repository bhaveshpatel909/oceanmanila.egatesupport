<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->lang->line('Actual Time In ') ?></th>
			  <th><?= $this->lang->line('Time In') ?></th>
            <th><?= $this->lang->line(' Actual Time Out') ?></th>
            <th><?= $this->lang->line(' Time Out') ?></th>
			<th>Comment</th>
            <th>Remarks</th>
            <th>Overtime</th>
            <th style="text-align: right"><?= $this->lang->line('Working Hour') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_hours = 0;
        foreach ($clock as $item) {
			
			 // echo '<pre>';
			 // print_r($clock);
			 // echo '<pre>';
			// die('vdvd');
            ?>
            <tr>
                <td><?= date('Y-m-d', strtotime($item['start_time'])) ?> <span class="text-primary text-bold"><?= date('H:i', strtotime($item['start_time'])) ?></span></td>
				<td><?= date('Y-m-d', strtotime($item['penality_time'])) ?> <span class="text-primary text-bold" style ="color:red;"><?= date('H:i', strtotime($item['penality_time'])) ?></span></td>
                 
                 <td>
				<?php if($item['end_time']!="")
				{ ?>
                   
                    <?= date('Y-m-d', strtotime($item['end_time'])) ?> 
                   
                    <span class="text-primary text-bold"><?= date('H:i', strtotime($item['end_time'])) ?></span>
					<?php 
				} ?>
                </td>
               
                
				<td>
				<?php if($item['time_out']!="")
				{ ?>
                   <?php
				//str_replace('-',)
				// echo $item['time_out'];
					if($item['time_out']!="Work end time out")
					{
						$timeout =explode('-',$item['time_out']);
						
						 $timmeout= $timeout[0].'-'.$timeout[1].'-'.$timeout[2].' ' .$timeout[3].$timeout[4];
						echo 	date('Y-m-d', strtotime($timmeout));
						?>
						<span class="text-primary text-bold" style="color:red;"><?= date('H:i', strtotime($timmeout)) ?></span>
						<?php 
					}
					else
					{
						echo "Work end time out";
						
					}
				} ?>
                </td>
				<td><?= $item['comments'] ?></td>
                <td><?php if($item['overtime_remark']!="" && $item['remarks']!=""){ echo  $item['remarks'].'/'. $item['overtime_remark'];}
				elseif ($item['overtime_remark']!="")
				{
					echo  $item['overtime_remark'];
				}
				else { echo  $item['remarks'];}?></td>
                <td><?= trim(str_replace('-',' ',$item['overtime'])); ?></td>
                <td class="text-right text-danger text-bold">
                    <?php
					if(strtotime($item['end_time'])> strtotime($item['penality_time']))
					{
						$diff = strtotime($item['end_time']) - strtotime($item['penality_time']);
						if ($diff > 0) {
							$days = floor($diff / 86400);
							$hours = floor(($diff % 86400) / 3600);
							$mins = floor((($diff % 86400) % 3600) / 60);
							$senconds = floor((($diff % 86400) % 3600) % 60);
							//echo (int) $days . ':'. ($diff % 86400);
							echo sprintf("%'.02d", ($days * 24 + $hours)) . ':' . sprintf("%'.02d", $mins); //. ':' . sprintf("%'.02d", $senconds);
							$total_hours += $diff;
						}
					}
                    ?>
                </td>
            </tr>        
        <?php }
        ?>
    </tbody>
</table>
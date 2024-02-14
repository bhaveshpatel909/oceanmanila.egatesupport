<div class="feed-activity-list" id="education_list">
    <?php foreach($education as $item){?>
    <div class="feed-element" id="education_<?= $item['id']?>">
        <a data-toggle="modal" href="employees/edit_education/<?= $item['id']?>" data-target="#modal_window" class="btn btn-outline btn-success btn-xl pull-right">
            <i class="fa fa-edit"></i>
        </a>
		<div class="datesec" style="float:left;margin-right:8px;">
		<small><i class="start_date"><?= $item['start']?date($this->config->item('date_format'),strtotime($item['start'])):$this->lang->line('now')?></i> - <i class="end_date"> <?= $item['end']?date($this->config->item('date_format'),strtotime($item['end'])):$this->lang->line('now')?></i></small>
        
		</div>
		<div class="compute_date"  style="float:left;margin-right:8px;">
					<?php
				// echo 	$item['start'];
				// echo "<br/>";
				// echo 	$item['end'];
					$date1 = date_create($item['start']);
			$date2 = date_create($item['end']);

			//difference between two dates
			$diff = date_diff($date1,$date2);

			//count days
			echo '<strong style="color:blue;">'.$diff->format("%a").'</strong>';
			 
					
					?>
		</div>
		<div class="name"  style="float:left;margin-right:8px;">
		<strong class="institution_name"><?= ($item['is_verified']=='1')?'<i class="fa fa-check"></i>':''?><?= $item['institution']?></strong>
		</div>
		<div class="desced"  style="float:left;margin-right:8px;">
        <p class="institution_description"><?= $item['description']?></p>
		</div>
		
        
		
    </div>
    <?php }?>
</div>
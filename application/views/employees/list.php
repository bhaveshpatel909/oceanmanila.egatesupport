<script>
$('document').ready(function () {
$('#mySelectorr').change( function(e) { 
		var letter = $(this).val();
	window.location.href="<?php echo base_url();?>employees/inactive?xy="+letter;
	//	alert(letter);
	});
	
 $('#mySelector1').change( function(e) { 
		var letterrr = $(this).val();
		window.location.href="<?php echo base_url();?>tasks/index/all/"+letterrr;
	});
 
 
	});
	
	
	</script>
		<style>
span.active_wrap .badge { font-weight: normal;}	
.title-action.row22222 a { line-height: 100%;}	
span.mijhy img {border-radius: 4px;width: 100%; max-height: 188px; max-width: 188px; }
.row.no_margin {margin-top: 8px;}
.onhover:hover > .show_text { display: block;}
.contact-box {min-height: 186px;}
.show_text {
      left: 80px;
    position: absolute;
    top: 69px;
    color: #fff;
    display: none;
    background: #000;
    padding: 4px 12px;
    border-radius: 11px;
    width: 152px;
    z-index: 99999;
}
.orange-circlee:hover > .orangehover
{
display:block;	
}
.orangehover
{
    left: 13px;
    position: absolute;
    top: 0px;
    color: #fff;
    display: none;
    background: #000;
    padding: 4px 12px;
    border-radius: 11px;
    width: 129px; z-index:99999;
}
.fgfgfggfg {
    right: 21px;
    width: 198px;
    left: auto;
    top: 25px;
}
.rrddrd {
   width: 198px;
    left: 0px;
    top: -19px; font-size:13px;
    z-index: 999;
}
span.orange-circlee {
    position: relative;
}
.rrddrdd {
        width: 150px;
    left: 21px;
    top: -24px;
    z-index: 999;
	font-weight:bold;
}
@media only screen and (max-width: 767px)
{
.no_margin { margin: 0px;}	
.padd_lft{ padding-left:0px;}
.dgftg h3{ font-size:14px;}
span.hgcgv { font-size: 13px; margin-bottom: 4px;  display: inline-block;}
.page-heading h2 { font-size: 20px;}	
label.control-label.text-danger.onhover.fghgfh {
    position: absolute;
    right: 27px;
    top: 13px;
}	
.fgfgfggfg { right: 21px;left: auto;  width: 193px;  font-size: 12px;  top: -1px;}
.title-action.row22222 { margin-top: 32px;}


}

.row.no_margin.nnmmrgn {
    margin-left: 0px;
    margin-right: 0px;
}
label.control-label.text-danger.onhover.fghgfh {
    float: right;
}
.active_wrap {float: left;}
.active_wrap span.badge.badge-success.m-t-xs { font-size: 14px;    margin-right: 4px;}
.hjkhjkhjk{top:1px; right: 4px;}
span.badge.badge-success.m-t-xs {    margin-top: 4px;}
.col-sm-1.hrtyy {
    padding-left: 0px;
}
.col-sm-11.gyhhi {
    padding-right: 5px;
}
.col-sm-9.npppppp {
    padding-left: 6px;
}
.col-sm-11.gyhhi h3 {
    font-size: 15px;
}
.circle_wrap {    float: right;}
.circle_wrap span { display: inline-block; height: 20px;  width: 20px; border-radius: 50%;
    color: #fff;    text-align: center;    line-height: 20px;    vertical-align: middle;}
.circle_wrap .orange{ background:#cccccc; color:#000;}	
.circle_wrap .green{background: #888888;    color: yellow;}	
.circle_wrap .red{background: #ff7f00;    color: yellow;}	
span.mijhy {  }
li.paginate_button.active a {
    cursor: pointer !important;
}	
	.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
	.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    z-index: auto !important;
}
span.peety {
    position: relative;
    top: 3px;
}
.active_wrap span.badge.badge-success.m-t-xs {
    border-radius: 0px;
}
span.badge.badge-success.m-t-xs {
    margin-top: 0px;
    padding: 7px 13px;
    border-radius: 3px !important;
    font-weight: 400;
}
.emp-block {
    text-align: right;
    margin-top: 31px !important;
    position: relative;
    left: 44%;
}
h2.abcccc {
    font-size: 13px;
    text-align: center;
}
sapn.top-heading {
    font-size: 11px !important;
}
.badge {
    padding: 8px 8px;
    font-size: 13px !important;
    border-radius: 3px !important;
    margin-top: 0px !important;
    font-weight:400 !important;
    color: #fff !important;
}
.title-action.row22222 a.wred span.badge.badge-default.m-t-xs {
    background: #ed5666;
}

	</style>
<?php 

 // echo "<pre>";

// print_r($disciplinary_action);
//print_r($leave_rec['record_id']);
 // echo "</pre>";
?>
<?php 

foreach ($employees['data'] as $employeee) { 
          

} 

 $idss= $_GET['xy'];
 $gidss= $_GET['page'];
 

?>
	 <!--   <?php if ($employeee['is_active'] == 1) { ?>
<div class="form-group has-feedback m-t-sm">
									<select name="employee_memo" id="mySelectorr" style="margin-left: 16px; width: 180px; height: 40px;padding: 5px;">
									<option value="">Select</option>
										<option value="">All</option>
															<?php foreach($employee_memor as $enum_value){ 
															
		  
													if($enum_value['status']!='Active')
													{	

                                                     									
															?>
									 
									<option value="<?php echo $enum_value['status']; ?>"<?php if($idss ==$enum_value['status']) echo 'selected="selected"'; ?>><?php echo $enum_value['status']; ?></option>
														
									<?php }
															}?>
																		</select>
							      </div>
								  
 <?php } ?>  -->
<?php 
$i = 0;
foreach ($employees['data'] as $employee) { 


	
    
    $i++;

    ?>
	

	
	
	

    <div class="col-lg-4 person_area">
        <div class="contact-box">
            <a class="wred" href="employees/edit_employee/<?= $employee['employee_id'] ?>">
                <div class="col-sm-3 col-xs-4 padd_lft ffffff">
                    <div class="text-center">
                    <span class="mijhy">
                        <img class="img" style="" src="<?= $employee['avatar'] ?>">
						</span>
					
						
					
						
					
						
                    </div>
                </div>
                <div class="col-sm-9 npppppp">
				<div class="ftghfrtyh">
				<div class="dgftg">
				
				<div class="row">
			
				
				  <div class="col-sm-11 gyhhi">
			
				<h3>
					<b title="Penalty Time" class="onhover onhover2" style="color:red;"><?php if($employee['late_Time']!=""){ echo $employee['late_Time'];};?>
					<!--<span class="show_text show_text1">Penalty Time</span>--></b>  <strong style="position: relative;
right: 1px;"><?= $employee['name'] ?> &nbsp;-</strong>	
					<p style=" color: red;margin-left: 0px;padding-top: 8px; margin-bottom: 8px;"><span title="Employee No"> <?= $employee['employee_no'] ?></span><span title="Internal ID No">	/<?= $employee['internal_id_no'];?></span>	&nbsp; <span class="hgcgv" ><?php foreach ($employee_memorg as  $employees_sts) {?>
							                 <?php if($employee['status'] == $employees_sts['id']){ echo  $employees_sts['status']; } } ?></span>
				
					<div class="tooltip" style="opacity: 9!important;">
				<span style="color:#428bca;font-size:13px;font-weight:500; font-family: 'Arial';position: relative;right: 1px;" class="hypn" title="Department"><?= $employee['department_name'] ?> </span>
				
				 </div>
				
				
				<span class="hypn" title="Group"> <?php echo $employee['group_name'];?></span>
				
				
			
				
				 <div class="tooltip" style="opacity: 9!important;">
				<span title="Position" style="color:#676a6c;font-size:13px;font-weight:500;" class="hypn">-&nbsp;
				
				
				
				
				
				
				
				<?= $employee['position_name'] ?></span>
				 </div></br>
				 <span style="position:relative; left:1px;"title="Short notes for this employee"class="peety"><?php echo $employee['petteycashliquidate'];?></span>
				
				
				</p></h3>
			
			
	     
	</div>
		  <div class="col-sm-1 hrtyy">
				  <?php
                $diff = strtotime($employee['contract_expiry']) - strtotime(date('Y-m-d'));
                $days = 0;
                if ($diff > 0) {
                    $days = floor($diff / 86400);
                }
                ?>
                <label title="Remaining days of contract" class="control-label text-danger onhover fghgfh" style="font-size: 17px"><?= $days ?>
				<!--<span class="show_text fgfgfggfg">Remaining days of contract</span>-->
				</label>
				</div>
	</div>
	
	
	
	
			
		
				

				<span style="float: right !important;
    position: absolute;
    top: 55%;
    left: 72%;"				class="circle_wrap">
				<?php 
				$i=0;
				foreach($leave_rec as $leave){
					 if($employee['employee_id']==$leave['employee_id'])
				  {
					  $i++;
					  
				  }
					
				}
				foreach($leave_rec as $leave){
					
              
				  if($employee['employee_id']==$leave['employee_id'])
				  {
				
				?>
				
				<span title="Request Leave" class="orange"><?= $i;?></span>
			
				<?php 
				 break;	
				}
				}?>
				
				<?php 
				$i=0;
				foreach($work_evaluation as $work_ev){
					 if($employee['employee_id']==$work_ev['employee_id'])
				  {
					  $i++;}
					}
				foreach($work_evaluation as $work_ev){
				if($employee['employee_id']==$work_ev['employee_id'])
				  {
				
				?><span title="Work Evaluation" class="green"><?= $i;?></span><?php
 break;				}
				}?>
				
				<?php 
				$i=0;
				foreach($disciplinary_action as $disp_ac){
					 if($employee['employee_id']==$disp_ac['employee_id'])
				  {
					  $i++;}
					}
				foreach($disciplinary_action as $disp_ac){
				if($employee['employee_id']==$disp_ac['employee_id'])
				  {
				
				?><span title="Disciplinary Action" class="red"><?= $i;?></span><?php
 break;				}
				}?>
				</span>
				</span>
				</div>
			 <div class="row no_margin nnmmrgn">
                <div class="title-action row22222" style="padding-top:11px;">
				<span class="active_wrap">
				   <?php if ($employee['is_active'] == 1) { ?>
						
						
                            <span class="badge badge-success m-t-xs">
								
							
							
							
							
							<?= $this->lang->line('Active') ?></span>
							
					
                        <?php } else { ?>
                            <span class="badge badge-default m-t-xs"><?= $this->lang->line('Inactive') ?></span>
                        <?php } ?>
					<?php 
						 $petteycashliquidate= $employee['petteycashliquidate'];
						if($petteycashliquidate!="" && $petteycashliquidate!=0 ){
							//echo "gfgj";
					?> 
					<span title="<?php echo $employee['petteycashliquidate'];?>" class="onhover dtdtdtd" style="height:10px;width:10px; background:red;display:inline-block; border-radius:50%"><!--<span class="show_text rrddrd gthyu"><?//php echo $employee['petteycashliquidate'];?> </span>--></span>
					
					
				<?php
					};?>
						
                     
					<?php if(!empty($employee['punchclock'])){
					foreach($employee['punchclock'] as $empclck)
					{
						if($empclck['end_time']!="")
						{
							?> 
					<span title="Employee Timed Out" class="onhover fghgfhrr" style="height:10px;width:10px; background:#2c34d7;display:inline-block; border-radius:50%;"><!--<span class="show_text gggggggf">Employee Timed Out</span>-->
					
					<?php
						}
						else {
					?> 
					<span class="orange-circlee" style="height:10px;width:10px;border-radius:50%; background:#ff7e00;display:inline-block;">
					<span class="orangehover">Time In Already</span>
					</span>
					<?php
						}
					}
					};?>
					</span>
				
				</span>
			
				
					
					
				<span class="onhover dtdtdtd hjkhjkhjk" style=" margin-top: -11px; margin-left: -9px;"> 
				<?php $i=1;$t=0;
				foreach($taskscount as $task){
					$notify_emps = explode(" ",preg_replace('/\s+/', ' ', $task['notify']));
					if(in_array($employee['employee_id'],$notify_emps)){
						 //$t=$t+$i;
						 //echo'';
						$t++;
					}
					
				};
				if($t !='0'){
					
				echo '<span title="Total Pending Task" class="task_total grhy" style="background: #1C84C6;border-radius: 50%;padding: 2px 5px;color: #fff; font-weight:700;">'.$t.'</span>';}
				?><!--<span  class="show_text rrddrdd">Total Pending Task</span>-->
				</span> 
                    <a title="Employee's Pending Task" href="<?php echo base_url();?>tasks/index/all/?xy=<?php echo $employee['name'];?>
					&employee_id=<?php echo $employee['employee_id'];?>&&de=<?php echo $employee['department_name'] ?>" id="classss" class="btn btn-primary hover1 on_hover" style="color:white;width:64px;height:29px;text-align:center;">
                     <!--   <i class="fa fa-fa-circle"></i>-->
                        <?= $this->lang->line('Task')?><!-- <span class="hover_text hover_text345">Employee's Pending Task</span>-->
                    </a>
          
				   
                    <a title="View this employee's task history with time" href="<?php echo base_url();?>reports/orclock/?xy=<?php echo $employee['name'];?>&&id=<?php echo $employee['employee_id']; ?>
					&&de=<?php echo $employee['department_name']; ?> " id="classss" class="btn btn-primary" style="color:white;width:64px;height:29px;text-align:center;">
                      <!--  <i class="fa fa-fa-circle"></i>-->
                        <?= $this->lang->line('Detail')?>
                    </a>
           
            </div>
			</div>
			
			
				
		
				
				<?php if ($employeee['is_active'] != 1) { ?>
				
				<?php   foreach($claims as $claim){  
				//$claim['file'];
				 ?>
				 <?php   foreach($claim['attachments'] as $cl){
							 ?>
				
				<?php if($claim['employee_id'] == $employee['employee_id'] ){ ?>
				<span ><a style="border: 1px solid; color: #ef1f0f !important;font-weight: bold; padding: 5px;" target="_blank" href="<?php echo base_url('files')?>/attachments/<?php echo $cl['location']; ?>" >Quit Claim</a></span>
				
				
				
				
				<?php  
				}
				}
				}
				}
				?>
				
				<!-- <div class="col-md-4 col-sm-4"> -->
				<!--<//?php if ($employee['is_active'] != 1) { ?>-->
				
					<!--<span style="z-index:9999;"><div class="form-group has-feedback m-t-sm">
								<select name="employee_memo" id="employee_memo" >
								
								<?php// foreach($enum_values as $enum_value){
									//if($enum_value !== Active){
									?>
								
								<option value="<?php// echo $enum_value; ?>"<?php// if($employee_memo['status']==$enum_value) echo 'selected="selected"'; ?>><?php// echo $enum_value; ?></option>
													
									<?php //}
								//	}?>
								</select>
							
                            						
                        </div></span>  -->
						
				<!--<//?php }// print_r($employee); ?>-->
				<!-- </div> -->
			<!-- 	<div class="col-md-12 col-sm-12">
				 <span>[<?= $employee['department_name'] ?>] <?= $employee['position_name'] ?></span>
				 
				</div> -->
				</div>
			
				
				<!-- <div class="row"> -->
				<!--<//?php if ($employee['is_active'] != 1) { ?>
				<div class="col-sm-12 col-md-12 "><span><b> <?= $this->lang->line('Employee Status Note') ?> </b></span><br/><br/>
				<?php// print_r($employee) ;  ?>
				<span class="aaaa" style="padding:7px; display:block; border:1px solid #000;"> <?= $employee['employee_status_note']   ?></span>
				</div>
				<//?php } ?>
				</div>-->
                    
					
                   
					
                </div>
				<div class="col-md-12">	<span style="display:none;"title="Employee Status Note - Separation Date " class="dfsdfs"> <?= $employee['employee_status_note']   ?></span> 
				</div>
				
         
				
                <div class="clearfix"></div>
            </a>
        </div>
    </div>
    <?php
    if($i % 3 == 0) {
        echo '<div class="clearfix"></div>';
    }
}?>
	<div id="row">
		<div class="col-sm-12" style="float:right;">
		<?php
		$gidssg= $_GET['page'];
	
		
		 	$ctp=$page_id;
			$d=$enumber;
			$t=	$enumber/30 + 1;
		$tt =(int)$t+1;
		$prspg=$ctp-1;
				$nextpg=$ctp+1;
				$ii= 1;
				
		?>
			<div class="dataTables_paginate paging_simple_numbers" id="table_paginate">
				<ul class="pagination">
				
				<?php if($inactive == 1){ ?>
						
					<li class="paginate_button previous <?php if($ctp==1){?> disabled <?php } ?>" aria-controls="table" tabindex="0" id="table_previous">
					
					<a href="employees/inactive/<?=$prspg;?>">Previous</a></li>
					
					<li class="paginate_button active" aria-controls="table" tabindex="0">
					<?php  
					  
					//echo '<a href="index.php?page='.$i.'&rpp=20">['.$i.']</a>';
					for ($ii;$ii<$t; $ii++){
						
						if($ctp==$ii)
    {
        $c="activegb";
    }
    else
    {
        $c="";
    }
           echo " <a class='$c' href='employees/inactive/".$ii."'>".$ii."</a>" ;
					}
					
					?></li>
					
					<li class="paginate_button next<?php if($ctp==$tt){?> disabled <?php } ?>" aria-controls="table" tabindex="0" id="table_next"><a href="employees/inactive/<?=$nextpg;?>">Next</a></li>	
				
				
					
			<?php	}else{ ?>
					
				
					<li class="paginate_button previous <?php if($ctp==1){?> disabled <?php } ?>" aria-controls="table" tabindex="0" id="table_previous"><a href="employees/index/<?=$prspg;?>">Previous</a></li>
					
					<li class="paginate_button active" aria-controls="table" tabindex="0">
					<?php  
					//echo '<a href="index.php?page='.$i.'&rpp=20">['.$i.']</a>';
					for ($ii; $ii<$t; $ii++){
						
						if($ctp==$ii)
    {
        $cd="activegb";
    }
    else
    {
        $cd="";
    }
           echo " <a class='$cd' href='employees/index/".$ii."'>".$ii."</a>" ;
					}
					
					?>
					</li>
				
					
					<li class="paginate_button next<?php if($ctp==$tt){?> disabled <?php } ?>" aria-controls="table" tabindex="0" id="table_next"><a href="employees/index/<?=$nextpg;?>">Next</a></li>
					
	
					
			<?php	}?>
				
				
					
				</ul>
			</div>
		</div>
	</div>

<style>
span.show_text.rrddrd.gthyu {
    top: 18px;
    left: 0px; text-align:left;
}
span.onhover.dtdtdtd {
    position: relative;
}
.mijhy {
    width: 100%;
    display: block;
}
.onhover.dtdtdtd { z-index: 99;}
b.onhover.onhover2 { position: relative;}
span.show_text.show_text1 {top: 0px; left: 25px; font-size: 13px;width: auto; white-space: nowrap;}
.hover_text { position: absolute;  background: #000;  color: #fff;  padding: 5px 15px;border-radius: 10px;  width: 148px;  margin-left: 7px;  display: none;  text-align: center;    z-index: 9;    left: 100%; top: 0px;}
.on_hover:hover > .hover_text { display: block;}	
.on_hover { position: relative;}
span.hover_text.hover_text345 { margin-left: 0px;  padding-right: 10px; width: auto;}

.dfsdfs { padding-top:10px;  display: block;    padding-left: 5px; height: 45px; overflow:hidden;}
span.task_total.grhy {
    min-width: 23px;
    min-height: 23px;
    display: inline-block;
    text-align: center;    line-height: 21px;
}
.hypn { margin-left: 2px;}
 .activegb{
    background-color: #c7b8b8 !important;
}
span.aaaa {
    min-height: 56px;
    border: 1px solid #bbb !important;
}
span.hgcgv {
    border: none !important;
    font-weight: bold;
    color: #428bca;
    font-size: 15px;
}
</style>
<script>
 $('document').ready(function(){
	 
 });
</script>
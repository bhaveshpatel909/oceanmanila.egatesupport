<link href="css/pdfstyle.css" rel="stylesheet">
<style>
table td, table th {font-size:180px;}
body {
     
     font-size: 18px!important;
    
}
.table-class-tem{
	font-size: 44pt !important;
	padding-left: 10px !important;
}
</style>
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $this->lang->line('Happy Birthday') ?></h1></div>
    </div>
    <p>From: <?php echo $_GET['start_date']; ?> &nbsp; to: <?php echo $_GET['end_date']; ?>
    </p>
	 <table class="table table-striped table-bordered table-hover">
		
			<thead>
				<tr>
				  
					<th class="table-class-temp"  style="width: 8%; font-size: 400pt !important; text-align: center;"><?= $this->lang->line('Employee Name') ?></th>
					<th class="table-class-temp" style="width: 12%; font-size: 400pt !important; text-align: center;"><?= $this->lang->line('Employee No.') ?></th>
					<th class="table-class-temp" style="width: 8%; font-size: 400pt !important; text-align: center;"><?= $this->lang->line('Birthday date') ?></th>
					<!--th style="width: 11%; text-align: center;"><?= $this->lang->line('Working Hour') ?></th>
					<th  ><?= $this->lang->line('Comments') ?></th-->
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($data))
			{
				foreach($data as $employ)
				{
					?>
					<tr style="color:red;">
					<td class="table-class-tem" padding-left="10"  style="font-size: 350pt !important;"><?php echo $employ['name'];?></td>
					<td class="table-class-tem" style="font-size: 350pt !important;"><?php echo $employ['employee_no'];?></td>
					<td class="table-class-tem" style="font-size: 350pt !important;"><?php echo $employ['birth_date'];?></td>
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
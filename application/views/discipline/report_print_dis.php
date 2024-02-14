<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
	
<!--        <div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div>-->
        <div class="clearfix"></div>
        

		
    </div>
    <div class="pdf-content">
        <p class="">
           
            <?php echo $documents['fullname'] ?> <br>
            <?php echo $documents['position_name'] ?> <br>
<?php echo $documents['department_name'] ?> 

        </p>
        <p>RE: <?php echo $evaluation['evaluation_name'] ?> </p>
        <p><?php echo $evaluation['evaluation_content'] ?></p>
        <p>Score Point: <?php echo $evaluation['score'] ?></p>
    </div>
 
    <pre>
        <?php //var_dump($evaluation) ?>
    </pre>
</div>
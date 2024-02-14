<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
		<div class="pull-right" style="float: right; width: 20%;">
            <img class="images" src="<?php echo $evaluation['avatar'] ?>"/>
        </div>
<!--        <div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div>-->
        <div class="clearfix"></div>
        <div><h2 class="title">WORK EVALUATION</h2></div>

		
    </div>
    <div class="pdf-content">
        <p class="">
            Date: <?php echo $evaluation['date'] ?> <br>
            Name of employee: <?php echo $evaluation['fullname'] ?> <br>
            Position Title: <?php echo $evaluation['position_name'] ?> <br>
            Department: <?php echo $evaluation['department_name'] ?> 

        </p>
        <p>RE: <?php echo $evaluation['evaluation_name'] ?> </p>
        <p><?php echo $evaluation['evaluation_content'] ?></p>
        <p>Score Point: <?php echo $evaluation['score'] ?></p>
    </div>
    <div class="pdf-footer">
        <div style="float: left;width: 40%;">
            <p style="margin-bottom: 50px;">Signature of Employee</p>
            <p>Date</p>
        </div>
        <div style="float: right;width: 40%;">
            <p style="margin-bottom: 50px;">Signature of Supervisor</p>
            <p>Date</p>
        </div>
    </div>
    <pre>
        <?php //var_dump($evaluation) ?>
    </pre>
</div>
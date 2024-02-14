<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
		
		 <div class="pull-right" style="float: right;width: 20%;">
            <img class="logo" src="<?php echo $discipline['avatar'] ?>"/>
        </div>
		
        <!--div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div-->
        <div class="clearfix"></div>
        <div><h2 class="title">DISCIPLINARY ACTION FORM</h2></div>
    </div>
    <div class="pdf-content">
        <p class="">
            Date: <?php echo $discipline['date'] ?> <br>
            Name of employee: <?php echo $discipline['fullname'] ?> <br>
            Position Title: <?php echo $discipline['position_name'] ?> <br>
            Department: <?php echo $discipline['department_name'] ?> 

        </p>
        <p>RE: <?php echo $discipline['reason_name'] ?> </p>
        <p><?php echo $discipline['reason_content'] ?></p>
        <p>Action Given to Employee: <?php echo $discipline['action_name'] ?></p>
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
        <?php //var_dump($discipline) ?>
    </pre>
</div>
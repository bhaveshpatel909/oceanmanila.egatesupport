<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div>
        <div class="clearfix"></div>
        <div><h2 class="title">CONTRACT</h2></div>
    </div>
    <div class="pdf-content">
        <p class="">
            <strong>Name of employee:</strong> <?php echo $contract['fullname'] ?> <br>
            <strong>Position Title:</strong> <?php echo $contract['position_name'] ?> <br>
            <strong>Department:</strong> <?php echo $contract['department_name'] ?> 

        </p>
        <p>
            <strong>Contract type:</strong> <?php echo $contract['contract_type_name'] ?><br>
            <strong>Contract salary:</strong> ₱ <?php echo number_format($contract['contract_salary']) ?><br>
            <strong>Contract Expiration Date:</strong> <?= $contract['contract_expiry'] ? date($this->config->item('date_format'), strtotime($contract['contract_expiry'])) : '' ?>
        </p>
        <strong>Contract content:</strong><br>
            <?php echo $contract['contract_content'] ?>
        <p>
            <strong>Contract condition:</strong><br>
            <?php echo $contract['contract_condition'] ?></p>
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
</div>
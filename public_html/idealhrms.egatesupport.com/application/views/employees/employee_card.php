<link href="css/print_employee_id.css" rel="stylesheet">
<?php for($i=0;$i<10;$i++) {
    $float = ($i % 2 == 0) ? 'float: left;' : 'float: right;';
    if($i % 2 == 0) {
        echo '<div style="clear: both;"></div>';
    }
    ?>
<div style="width: 340px;height: 189px;border: solid 1px #f1f1f1;margin-bottom: 10px;<?php echo $float?>">
    <table border="0" width="100%" align="center" height="100%">
        <tr>
            <td align="center" width="100px" style="padding-top: 10px"><img class="logo" style="width: 60px;" src="<?php echo base_url($company['logo']) ?>"/></td>
            <td align="left" class="" style="padding-top: 10px">
                <div class="upper-text strong-text employee-name "  style="font-size:14px;"><?php echo $company['name'] ?></div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="padding-top: 30px">
                <div class="upper-text strong-text employee-name " style="line-height: 2em;"><?php echo $employee['fullname'] ?></div>
                <div class="employee-position" style="text-transform: capitalize;line-height: 2em;"><?php echo $employee['position_name'] ?></div>
                <div class="employee-position" style="line-height: 2em;">Mobile:<?php echo $employee['contactno'] ?></div>
                <div class="employee-position">Email: <?php echo $employee['email'] ?></div>

            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" style="padding-top: 30px;"><div><?php echo $company['address'] ?></div></td>
        </tr>
    </table>
</div>
<?php } ?>
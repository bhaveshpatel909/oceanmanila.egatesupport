<link href="css/print_employee_id.css" rel="stylesheet">
<?php //echo'<pre>';print_r($company);echo'</pre>'; //die('testing');?>
<h3 style ="text-align:center; margin-bottom:30px !important;">Regular Employee ID</h3>
<table border="0" border-collapse="collapse" width="60%" align="center">
    <tr>
        <td width="48%" valign="top" style="border: solid 1px #ccc;">
            <table border="0" width="100%" align="center">
                <tr>
                    <td align="center" class="" style="text-align: center; padding-top: 0px;"><img class="logo" style="width: 100px;" src="<?php echo base_url($company['logo']) ?>"/></td>
                </tr>
                <!--tr>
                    <td align="center" class="padding-left-20 padding-right-20" style="text-align: center; padding-top: -5px;">
                        <?php echo $company['address'] ?>
                    </td>
                </tr>
				<tr>
                    <td align="center" class="padding-left-20 padding-right-20" style="text-align: center; padding-top: -10px;">
                        <?php //echo $company['name'] ?><br>
                        <?php echo "Tel.No.: ".$company['phone'] ?>
                    </td>
                </tr-->
            </table>            
            <hr style="margin-top:2px;">
            <table border="0" width="100%" align="center">
                <tr>
                    <td style="text-align:center;" width="100%"><img class="avatar" style="width: 80px;border: solid 1px #ccc; text-align:center;" src="<?php echo base_url($employee['avatar']) ?>"/></td>
                </tr>
				<tr>
                    <td width="100%" valign="middle" style="text-align: center">ID NO.: <?php echo $employee['employee_no'];?></td>
                </tr>
            </table>
            <table border="0" width="90%" align="center">
                <tr>
                    <td valign="middle" style="text-align: center; padding-top: 10px;">
                        <div class="upper-text strong-text employee-name "><?php echo $employee['fullname'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Name</div>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="text-align: center;padding-top: 5px;">
                        <div class="upper-text employee-position"><?php echo $employee['department_name'].' '. $employee['position_name']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px; padding-bottom: 10px;" class="border-top">
                        <div class="upper-text small-text ">Position</div>
                    </td>
                </tr>
                <!--tr>
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                        <div class="upper-text strong-text employee-name">&nbsp;</div>
                    </td>
                </tr-->
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Employee's Signature</div>
						
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                     <?php echo $company['admin_manager_name'];?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Admin Manager</div>
                    </td>
                </tr>
            </table>
        </td>
        <td width="4%">&nbsp;</td>
        <td width="48%" valign="top" style="border: solid 1px #ccc;">
            <table border="1" width="90%" align="center" style="margin-top: 15px;">
                <tr>
                    <td style="padding: 4px 2px">SSS NO.: &nbsp; <?php echo $employee['ssn'] ?></td>
                </tr>
                <tr>
                    <td style="padding: 4px 2px">TIN: &nbsp; <?php echo $employee['tin'] ?></td>
                </tr>
                <tr>
                    <td style="padding: 4px 2px">PHILHEALTH NO.: &nbsp; <?php echo $employee['healthno'] ?></td>
                </tr>
            </table>
            <table border="0" width="90%" align="center" style="margin-top: 3px;">
                <tr>
                    <td valign="top" class="line-height" width="30%">Address:</td>
					
                    <td valign="top" class="line-height"><?php echo $employee['employee_address'] ?></td>
                </tr>
                <tr>
                    <td valign="top" class="line-height">Contact No.:</td>
                    <td valign="top" class="line-height"><?php echo $employee['contactno'] ?></td>
                </tr>
                <tr>
                    <td valign="top" class="line-height">Birth date:</td>
                    <td valign="top" class="line-height"><?= ($employee['birth_date']) ? date($this->config->item('date_format_pdf'), strtotime($employee['birth_date'])) : '' ?></td>
                </tr>
            </table>
            <table border="0" width="90%" align="center" style="margin-top: 5px;">
                <tr>
                    <td colspan="2" style="text-align: center;padding-bottom: 10px;">In Case of Emergency, Please Notify:</td>
                </tr>
                <tr>
                    <td valign="top" class="line-height" width="40%">Contact Person:</td>
					<?php //foreach($family as $family_contact){?>
                    <td valign="top" class="line-height"><?php echo $employee['employee_contactperson'] ?></td><?php //}?>
                </tr>
                <tr>
                    <td valign="top" class="line-height">Address:</td>
                    <td valign="top" class="line-height"><?php //echo $employee['address'] ?></td>
                </tr>
                <tr>
                    <td valign="top" class="line-height">Contact No.:</td>
                    <td valign="top" class="line-height"><?php //echo $family[0]['birht_date'] ?></td>
                </tr>
            </table>
            <table border="0" width="90%" align="center" style="margin-top: 3px;">
                <tr>
                    <td class="line-height" colspan="2" style="text-align: center;">This is to certify that the person who picture and signature appear on this card is employed to <strong> <?php echo $company['name'] ?> </strong>located at <strong><?php echo $company['address'] ?></strong> with contact number<strong> <?php echo $company['phone'] ?></strong>  </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<!--------- duplicate Id card--------------------------->
<br/>
<br/>
<br/>
<h3 style ="text-align:center; margin-bottom:30px !important;">Contractual Employee ID</h3>
<table border="0" border-collapse="collapse" width="60%" align="center">
    <tr>
        <td width="48%" valign="top" style="border: solid 1px #ccc;">
            <table border="0" width="100%" align="center">
                <tr>
                    <td align="center" class="" style="text-align: center; padding-top: 0px;"><img class="logo" style="width: 100px;" src="<?php echo base_url($company['logo']) ?>"/></td>
                </tr>
                <!--tr>
                    <td align="center" class="padding-left-20 padding-right-20" style="text-align: center; padding-top: -5px;">
                        <?php echo $company['address'] ?>
                    </td>
                </tr>
				<tr>
                    <td align="center" class="padding-left-20 padding-right-20" style="text-align: center; padding-top: -10px;">
                        <?php //echo $company['name'] ?><br>
                        <?php echo "Tel.No.: ".$company['phone'] ?>
                    </td>
                </tr-->
            </table>            
            <hr style="margin-top:2px;">
            <table border="0" width="90%" align="center">
                <tr>
                    <td style="text-align:center;" width="100%">
					<?php if($employee['sign']!="")
					{
						?><img class="avatar" style="width: 80px;border: solid 1px #ccc;" src="<?php echo base_url($employee['sign']) ?>"/><?php 
					}
					else
					{
						?>
						<img class="avatar" style="width: 80px;border: solid 1px #ccc;" src="files/avatars/blank-person.jpg"/>
						<?php
					}
					?></td>
                </tr>

				<tr>
								                    <td style="text-align:center;" width="100%" valign="middle" style="text-align: center">ID NO.: <?php echo $employee['employee_no'];?></td>

				</tr>
            </table>
            <table border="0" width="90%" align="center">
                <tr>
                    <td valign="middle" style="text-align: center; padding-top: 10px;">
                        <div class="upper-text strong-text employee-name "><?php echo $employee['fullname'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Name</div>
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="text-align: center;padding-top: 5px;">
                        <div class="upper-text employee-position"><?php echo $employee['department_name'].' '. $employee['position_name']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px; padding-bottom: 10px;" class="border-top">
                        <div class="upper-text small-text ">Position</div>
                    </td>
                </tr>
                <!--tr>
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                        <div class="upper-text strong-text employee-name">&nbsp;</div>
                    </td>
                </tr-->
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Employee's Signature</div>
						
                    </td>
                </tr>
                <tr>
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                     <?php echo $company['admin_manager_name'];?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;padding-top: 5px;" class="border-top">
                        <div class="upper-text small-text ">Admin Manager</div>
                    </td>
                </tr>
            </table>
        </td>
        <td width="4%">&nbsp;</td>
        <td width="48%" valign="top" style="border: solid 1px #ccc;">
            <table  width="90%" align="center" style="margin-top: 50px;">
                <tr>
                    <td style="padding: 4px 2px">This Identification Card will be only used as Temporary and will not consider as Valid.</td>
                </tr>
               
            </table>
           
            <table border="0" width="90%" align="center" style="margin-top: 5px;">
                <tr>
                    <td colspan="2" style="padding-bottom: 10px;">This will only be used for the retainer service  purposes needed as part of the services to be performed.</td>
                </tr>
               
            </table>
            
        </td>
    </tr>
</table>
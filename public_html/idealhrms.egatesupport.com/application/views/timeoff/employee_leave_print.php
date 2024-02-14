<link href="css/print_employee_id.css" rel="stylesheet">
<table border="0" border-collapse="collapse" width="80%" height="900px" align="center">
    <tr>
        <td width="100%" valign="top" style="border: none;">
            <table border="0" width="100%" align="left">
                <tr>
                    <td align="left"  style="text-align: left; padding-top: 0px;"><img class="logo" style="width: 100px;" src="<?php echo base_url($company['logo']) ?>"/></td>
					  <td style="text-align:center;"><span style="color:red; font-size:20px;">Leave Form</span><br>
					   Request Date :  <span class="upper-text employee-position">
						<?php echo $employee['register_date']; ?></span>
					  </td>
					<td   align="right" width="30%"><img class="avatar" style="width: 50px;border: none;" 
					
					   src="<?php echo base_url($employee['av']) ?>"/></td>
                </tr>
			
               <tr>
			 <td valign="right" style=" padding-top:30px;">
                        <div class="upper-text strong-text employee-name "><?php echo $employee['fullname'] ?></div>
						    <span class="upper-text employee-position"><?php echo $employee['department_name'].' '. $employee['position_name']; ?></span><br>
							<br><p style="font-size:14px; color:#ff6600;"> Start Date :  <span class="upper-text employee-position">
						<?php echo $employee['start_time']; ?></span></p>
                    </td>
			   <td></td>
			   <td style=" padding-top: 30px;">
			     Type Of Leave :  
			   <span class="upper-text employee-position">
						<?php echo $employee['type']?></span>
						<br> 
					
						
						<br>
						<br>
						<p style="color:#ff6600; font-size:14px;text-align:right;"> End Time :  <span class="upper-text">
						<?php echo $employee['end_time']?></span></p>
						</td>
			   </tr>
            </table>            
          <br>
            
            <table border="0" width="100%" >
			
			
			<tr>
			<td>  
			<div style="float:left; width:50%;" class=" ">Employee Comment :</div></td>
			
			<td style="text-align:right;"> 			
			<div style="float:right; text-align:right; " class=" small-text">Requested By..............................</div></td>
			
			</tr>
			<tr style="width:100%;">
			
			   <td colspan="2"  style=" padding:10px 7px 90px 7px;border:1px solid #8f8d8d; "  >
                     <div style="width:100%; float:left;padding:50px 10px; ">					 
					   <?php echo $employee['employee_comment']?></div>
                    
			
			
			</td>
			<td></td>
			</tr>
            <br>
            <br>
                <tr >
                     <td style="padding-top:25px;">  
					  <div style="float:left; width:50%;" class=" ">Admin Comments :</div>
					   </td>
				
					    <td style="padding-top:25px; text-align:right; 	">  
<div style="float:right; text-align:right; " class=" small-text">Confirmed By..............................</div>
					 </td>
					
                    </tr>
					<tr>
					<tr style="">
					  <td colspan="2"  style=" padding:10px 7px 110px 7px;border:1px solid #8f8d8d;"  >
					  <div style="width:100%; float:left;padding:10px 10px;  ">	
					</div>
					</td>
					</tr>
				
                   <td >
                       
                    </td>
                    </td> <td>
					 
                        
                    </td>
					
					</tr>
                  <tr>
				   <td>
					 
                        
                    </td>
              
					</tr>
             
			
			</tr>	
                    

                <tr>
				
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                 
                    </td>
                </tr>
				<tr>
				<td>
                       
						
                    </td>
                    <td valign="middle" style="text-align: center;padding-top: 7px;">
                 
                    </td>
                </tr>
				
				
				
                <tr>
                    <td style="text-align:left;padding-top: 5px;" class="">
                       
                    </td>
                         <td valign="left" style="text-align: center;padding-top: 7px;">
                </tr>
				 <tr>
                    <td class="line-height" colspan="2" style="text-align: center;">Filing of leave is all subject for approval, in case of your request is declined, Your leave request will affect your work performance. Because management will consider your request is like non sense.  Be advised that management will give consideration for all emergency cases but upon reporting you need to submit your supporting documents automatically  to justify your absence or else it will be considered as fraud information . Management will not follow up your your supporting document, If you do not submit proper document, It will be considered as fraud as well automatically </td>
                </tr>
            </table>
        </td>
        <td width="4%">&nbsp;</td>
        
    </tr>
</table>
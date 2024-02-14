<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="pull-right" style="float: right;width: 20%;text-align: right;"></div>
        <div class="clearfix"></div>
        <div><h1 class="title" style="color:red;"><?= $this->lang->line('Payment Request Form') ?></h1></div>
    </div>
    <p style="font-size:15px;"><b>I have already attached BIR document to your system with details bellow</b>
    </p>
    <table border="1px" width="100%" style='text-align:left;' height='400px !important' cellpadding="10px">
               <tr><td><b>Document Name :</b></td><td><?= $form_name ?><br/></td>
			   </tr>
			   <tr>
               <td><b> Date : </b></td><td><?= date($this->config->item('date_format_pdf'), strtotime($date)) ?><br/><br/></td></tr>
			   <tr>
			   <td><b>Attachement : </b></td><td><?= $loc2 ?> <br/><br/>
			   </td>
			   </tr>
			   <tr><td colspan='2' align='left'><b>Requested By</b><br/></td></tr>
			   <tr><td colspan='2' align='left'><b>Checked By Accounting</b></td></tr>
			   <tr><td colspan='2' align='left'><b>Approved By</b><br/></td></tr>
			   <tr><td colspan='2' align='left'><b>Note: Plz attach this Form for the Payment Processing</b></td></tr>
			   
    </table>
</div>
<script>
function refreshPage(){
  window.location.reload(history.back());
} 
    $('document').ready(function () {
        $('.datetimepicker').datetimepicker({pickTime: false});
    });
</script>
 <script>
// $(document).ready(function(){
   
   // var multipleValues = $( "#form_id" ).html() || [];
   // alert(multipleValues);
        // $("#test1").val(bla);
    
   
// });
</script>
<style>
td
{
	padding-left:5px !important;
	
}



</style>
<?php $this->load->view('mix/attachment_remove') ?>
<div class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="refreshPage()"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title" style="text-align:center;font-size:20px;color:red;"><?= $this->lang->line('Payment Request Form') ?></h4>
            </div>
			<h1 style="font-size:15px;padding-left:29px;"><b>I have already attached BIR document to your system with details bellow</b></h1>
            <div class="modal-body">
			    
                <table border="1px" width="100%" style='text-align:left;' height='288px !important'>
               <tr><td><b>Document Name :</b></td><td><?php echo $bir_forms;?><br/></td>
			   </tr>
			   <tr>
               <td><b> Date : </b></td><td><?php echo $date;?><br/><br/></td></tr>
			   <tr>
			   <td><b>Attachement : </b></td><td><?php echo $attachments2;?> <br/><br/>
			   </td>
			   </tr>
			   <tr><td colspan='2' align='left'><b>Requested By</b><br/></td></tr>
			   <tr><td colspan='2' align='left'><b>Checked By Accounting</b></td></tr>
			   <tr><td colspan='2' align='left'><b>Approved By</b><br/></td></tr>
			   <tr><td colspan='2' align='left'><b>Note: Plz attach this Form for the Payment Processing</b></td></tr>
			   
			   </table>
			   <div style="float:right;margin-top:10px;color:red;"><b>
			   <a href="accounting/getprint_data/?form_name=<?php echo $bir_forms;?>
&date=<?php echo $date;?>&loc2=<?php echo $attachments2;?>"><span style='color:red;'>Print</span></a>
			   
			   </b></div>
            </div>
            <div class="modal-footer">
               
            </div>
        </div>
    </div>
</div>
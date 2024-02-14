<?php $this->load->view('layout/header',array('title'=> 'processcallingcard','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('employees').ready(function () {
		
        current_table = $('.data_table').dataTable({
            "order": [[2, "desc"]],
			"bFilter": true, 
			
            "columnDefs": [{
//                    "targets": [0, 6],
                  
//                    "orderable": false

                }]
        });
        $('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
		
	$('#request_category_id').change( function() {
       
	
            current_table.fnFilter( $(this).val(), 9); 
       });	
		
	$('#new_view').click( function() {
       
	
            current_table.fnFilter($(this).val(),7); 
       });	
		
	
    });
    
</script>


<script>
    $('employees').ready(function(){
        $('#documents_list').infinitescroll({
            navSelector      : "#next:last",
            nextSelector     : "a#next:last",
            itemSelector     : "div.document_area",
            dataType         : 'html',
            loading:{
                msgText          : '<?= $this->lang->line('Processing')?>',
                finishedMsg      : '',    
            },
            maxPage          : <?= $documents['amount']?>,
            path: function(index) {return 'documents/index/'+index+'?search=<?= ($search?$search:'')?>'}
        });
		
	
    });
    
</script>
<script>
$(document).ready(function(){
		$('#emaill').click(function () {
			
           var valuess = new Array();
		  
            $.each($("input[name='checkHead[]']:checked"), function () {
              valuess.push($(this).val());
			  
			  
            });
			
		
		location.href="employees/callaing_card_mail?q="+valuess;
	

});
});

</script>

<script>
$(document).ready(function(){

		
  	$('#new_view').click(function () {
         var checkval = '1';
		 
		 location.href="request/processcallingcard?checkval="+checkval; 
		  
	 });  
	 
	 $('#reset_con').click(function () {
         var checkval = 'delete';
		 
		
		 
		 location.href="employees/delete_datepp?reset_id="+checkval; 
		  
	 });
	 
	 
	 
	 
	 
	 
	 
	 });
</script>

<script>
$(document).ready(function(){
  $('#data_table').on('ifChecked', '.checkpin', function (event) {
	 
         var id=($(this).val());
		  
		   $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/unpin?id='+id,
        
        success: function(response) {
           
        }
    }); });  });
</script>
<script>
$(document).ready(function(){
  $('#data_table').on('ifUnchecked', '.checkpin', function (event) {
	 
         var id=($(this).val());
		  
		   $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/pinemp?id='+id,
        
        success: function(response) {
           
        }
    }); });  });
</script>
<style>
.delete_date {
    display: inline-block;
    vertical-align: middle;
}
table#data_table tr td:nth-child(5) {
    min-width: 120px;
}
			td {
			width:9%!important;
			}
			.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;
}


#xls2 {
    margin-top: 32px;
   
    color: #000;
    font-weight: bolder;
    
	font-size: 15px;
}
#emaill {

    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 32px;
   font-size:15px;
    padding: 8px 13px;
    border-radius: 3px;
}
.view_sece
{
	float:left;
}
#new_view, #reset_con  {
  
    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 32px;
    margin-left:14px;
    padding: 8px 13px;
   border-radius: 3px;
	display:inline-block;
	border:0px;
	text-align:center;
	font-size:15px;
}
.email_sec {
    width:auto;
	float:left;
}
.view_sec{
    width:auto;float:left;
}

.on_hover_text {     position: absolute;
    background: #fff;
    padding: 10px;
    box-shadow: 2px 2px 4px #999;
    display: none;
    z-index: 9999;
       left: 108px;color:#333;
    min-width: 304px;
    top: 0px;
    border-radius: 7px;}
.on_hover_con:hover > .on_hover_text {  display: block;}
.on_hover_con { position: relative;
    cursor: pointer;
    color: #428bca;
    width: 86%;
    display: inline-block;
    vertical-align: top;}
	
.dataTables_wrapper table
{
	background:#fff;
}	
.dataTables_wrapper table th
{
	text-align:center;
}
.dataTables_wrapper table td
{
	vertical-align: middle !important;
}
.dataTables_wrapper table td:nth-child(1) 
{   min-width: 40px !important;
max-width:40px !important; 
}

.dataTables_wrapper table th:nth-child(1) 
{   min-width: 40px !important;
max-width:40px !important; 
}
.dataTables_wrapper table td:nth-child(2) 
{   min-width: 50px !important;
max-width:50px !important; 
}

.dataTables_wrapper table th:nth-child(2) 
{   min-width: 50px !important;
max-width:50px !important; 
}
.dataTables_wrapper table td:nth-child(3) 
{   min-width: 70px !important;
max-width:70px !important; 
}

.dataTables_wrapper table th:nth-child(3) 
{   min-width: 70px !important;
max-width:70px !important; 
}
.dataTables_wrapper table td:nth-child(4) 
{   min-width: 90px !important;
max-width:90px !important; 

}

.dataTables_wrapper table th:nth-child(4) 
{  min-width: 90px !important;
max-width:90px !important; 
}
.dataTables_wrapper table td:nth-child(6) 
{   min-width: 247px !important;}

.dataTables_wrapper table th:nth-child(6) 
{    min-width: 247px !important;}

.dataTables_wrapper table td:nth-child(7) 
{   min-width: 50px !important;
text-align:center;

}
.dataTables_wrapper table th:nth-child(6), .dataTables_wrapper table td:nth-child(6)
{    min-width: 100px !important;}



.dataTables_wrapper table td:nth-child(7) img
{
	width:35px !important;
	height:35px !important;
	margin:0px !important;
}

.dataTables_wrapper table td:nth-child(8) img
{
	width:50px !important;
	height:50px !important;
	margin:0px !important;
}
.dataTables_wrapper table td:nth-child(13) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table td:nth-child(14) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table td:nth-child(14) {
    min-width: 88px;
}
.dataTables_wrapper table th:nth-child(7) 
{    min-width: 50px !important;
}

.dataTables_wrapper table td:nth-child(8) 
{   min-width:88px !important;
text-align:center;
}
.dataTables_wrapper table td:nth-child(8) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table th:nth-child(8) 
{    min-width: 50px !important;}

.dataTables_wrapper table td:nth-child(9) 
{   min-width: 88px !important;

}
.dataTables_wrapper table td:nth-child(9) input{    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;}

.dataTables_wrapper table th:nth-child(9) 
{    min-width: 40px !important;}


.dataTables_wrapper table td:nth-child(10) 
{   min-width: 100px !important;

}

.dataTables_wrapper table th:nth-child(10) 
{    min-width: 100px !important;}


.dataTables_wrapper table td:nth-child(11) 
{   min-width: 160px !important;

}

.dataTables_wrapper table th:nth-child(11) 
{    min-width: 160px !important;}

.dataTables_wrapper table td:nth-child(12) 
{   min-width: 100px !important;
max-width: 100px !important;
}

.dataTables_wrapper table th:nth-child(12) 
{    min-width: 100px !important;
max-width: 100px !important;
}

.dataTables_wrapper table td:nth-child(13) 
{   min-width: 100px !important;
max-width: 100px !important;

}

.dataTables_wrapper table th:nth-child(13) 
{    min-width: 100px !important;
max-width: 100px !important;
}

.dataTables_wrapper table td:nth-child(15) 
{   min-width: 80px !important;
max-width: 80px !important;

}

.dataTables_wrapper table th:nth-child(15) 
{    min-width: 80px !important;
max-width: 80px !important;
}
.dataTables_wrapper table td:nth-child(16) 
{   min-width: 160px !important;

}

.dataTables_wrapper table th:nth-child(16) 
{    min-width: 160px !important;}

.dataTables_wrapper table td:nth-child(19) 
{   min-width: 110px !important;
max-width: 110px !important;

}

.dataTables_wrapper table th:nth-child(19) 
{    min-width: 110px !important;
max-width: 110px !important;
}
.dataTables_wrapper table td:nth-child(20) 
{   min-width: 120px !important;
max-width: 120px !important;

}

.dataTables_wrapper table th:nth-child(20) 
{    min-width: 120px !important;
max-width: 120px !important;
}
.dataTables_filter
{
	position: absolute;

left: -434px;
}
@media only screen and (max-width: 767px) {

.on_hover_text {
padding: 10px 11px;
    display: none;
    z-index: 9999;
    left: auto;
    color: #333;
    min-width: 100%;
    top: 0px;
    border-radius: 7px;
    right: 100%;
    width: 167px;
    min-width: auto;
    margin-right: 7px;
}




</style>

<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'processcallingcard'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-3 col-sm-3">
                <h2><?php echo "Process ID & CallingCard"?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Process ID & CallingCard";?>
                    </li>
                </ol>
            </div>
			<div class="col-lg-2">
			<div class="new_bt">
			
        <form action="<?php echo base_url();?>employees/uploadData" method="post" enctype="multipart/form-data"><input type="file" name="uploadFile" id="xls2" value="" /><input type="submit" name="submit" value="Upload" />
          </form></div>
			</div>
			<div class="col-lg-6 col-sm-6">
			<div class="email_sec">
			<p id="emaill"><i class="fa fa-user "></i>   Email For Update</p>
			</div>
			<div class="view_sec">
			<button id="new_view" value="checked"><i class="fa fa-eye"></i>    View Pinned List</button>
			
		</div>
		<div class="view_sece">
			<a href="employees/outputCSV" id="new_view" title="You Can Download Employee Data Files Here" value="checked"><i class="fa fa-download"> </i> Download </a>
			
		</div>
<a href="http://uplushrms.peza.com.ph/request/processcallingcard" 
id=""title="Go Back"><img style="vertical-align: top;width: 39px; margin-left: 21px;
  margin-right: 6px;margin-top: 33px;" 
  src="http://uplushrms.peza.com.ph/files/logo/resetsearch.png"></a>
  <div class="view_sece">
			<p  id="reset_con" title="You Can Reset All Employee Confirmed Date From Here"><i class="fa fa-trash"> </i>   Reset Confirmed</p>
			
		</div>
		</div>
            <div class="col-lg-1">
                <div class="title-action">
                    <a href="request/new_request" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
			
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
					
                        <div class="row">
                            <div id="save_result"></div>
							 
                            <table  id="data_table" class="tblecus table table-striped table-bordered table-hover data_table"  >
						<div class="col-md-3" style="float: right; margin-right: 0px;">
						<div class="my-slect">
							 <select name="request_category_id" id="request_category_id" class="form-control required">
                            <option value="">Category Filter</option>
                             <?php foreach ($employees['data'] as $index => $employees11) {?>
							  
                                <option  value="<?= $employees11['name'] ?>"><?= $employees11['name'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
                                <thead>
                                    <tr>
									 <th class="text-center">
                                            <label>
                                                <input type="checkbox" name="checkHead" class="i-checks checkHead" id="selectall"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th style="width:50px!important;">ID</th>
                                        <th style="width:50px!important;">Action</th>
										<th style="width:50px!important;"><?= $this->lang->line('Date Hired') ?></th>
										<th style="width:50px!important;"><?= $this->lang->line('Confirmed') ?></th>
										 <th><?= $this->lang->line('Emp No.') ?></th>
										 <th><?= $this->lang->line('Email Id') ?></th>
                                         <th><?= $this->lang->line('PIC') ?></th>
										 <th><?= $this->lang->line('SIG') ?></th>
										 <th><?= $this->lang->line('PIN') ?></th>
										 <th><?= $this->lang->line('Nick Name') ?></th>
                                        <th><?= $this->lang->line('Employee Name') ?></th>
										 <th><?= $this->lang->line('PIC') ?></th>
										 <th><?= $this->lang->line('SIG') ?></th>
                                        <th><?= $this->lang->line('SSS #') ?></th>
                                        <th><?= $this->lang->line('TIN #') ?></th>
                                        <th><?= $this->lang->line('Pag-ibig #') ?></th>
                                        <th><?= $this->lang->line('Birth Date') ?></th>
                                        <th><?= $this->lang->line('Contact Person') ?></th>
                                        <th><?= $this->lang->line('Relation') ?></th>
                                        <th><?= $this->lang->line('Address') ?></th>
                                        <th><?= $this->lang->line('Contact #') ?></th>
                                        <th><?= $this->lang->line('Status') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								
							
                      <?php foreach ($employees['data'] as $index => $employees) { 
									
									
								// echo "<pre>";
								// print_r($employees);
								// echo"</pre>";
									
									?>
                                      
                                
								
                                        <tr entity_id="<?= $employees->employee_id ?>">
										  <td class="text-center">
                                                <label>
                                                    <input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="<?= $employees['employee_id'] ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td class="idmanual" style="width:5%!important;"><?= $employees['employee_id'] ?>	</td>
											<td>
											 <a class="btn btn-outline btn-success btn-xs" href="request/edit_document/<?= $employees['employee_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                           <!--     <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Reset Password ?') && submit_form('#delete_document<?= $employees['employee_id'] ?>', '#save_result')" title="Reset Password">
                                               
                                                </a>
												-->

												
												  <a id="delete_document<?= $employees['employee_id'] ?>" href="employees/set_password/<?= $employees['employee_id'] ?>" class="btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>
													
	<script>							            
	function copysign_img(id){
	
		  $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/upload_sign?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
        }
    }); 
	}
	
	
	
	function copyavatar_img(id){
		
		  $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/upload_avatar?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
		   
        }
    }); 
	}
	
	function delete_img(id){
		
		  $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/delete_copyimpg?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
        }
    }); 
	}
	function delete_date(id){
	
		 $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/delete_ppdate?id='+id,
        
        success: function(response) {
           alert(response);
		   location.reload();
        }
    }); 
		}
		</script>							            
											</td>
										
											<td style="width:5%!important;"><?= date('Y-m-d', strtotime($employees['hired_date'])) ?></td>
											
											<?php $contant_req =$employees['content']; ?>
											<td ><?=$employees['confirm_date_pp'];?>
											<?php if($employees['confirm_date_pp']){?>
											
											<p class="delete_date"  title="Delete Date" value="<?php echo $employees['employee_id']; ?>" onclick="delete_date(<?php echo $employees['employee_id']; ?>)" ><img  style="    vertical-align: top; width: 31px;  margin-left: 10px; margin-right: 3px; margin-top: 0px;" 
                                               src="http://uplushrms.peza.com.ph/files/logo/resetsearch.png"></p>
											
											<?php }?>
											</td>
											<td > <?= $employees['employee_no'] ?></td>
                                            <td > <?= $employees['email'] ?></td>
                                              <td>
											  <img class="avatar img-rounded" src="<?php echo base_url().$employees['avatar'];  ?>" style="width: 50px;height: 50px; margin: 20px 0;" data-toggle="modal" data-target="#myModal">
											  
											  
											  <input type="hidden" value="<?= $employees['employee_id'] ?>" name="emp_id">
											  
											  <input type="button" 
											 id="sign_img" onClick="copyavatar_img('<?php echo $employees['employee_id'];   ?>')"/>
											   </td>
											  <td>
											 <?php if($employees['sign']){ ?>
											  <img class="avatar img-rounded" src="<?php echo base_url().$employees['sign'];  ?>" style="width:50px;height: 50px; margin: 20px 0;" data-toggle="modal" data-target="#myModal">
											  
											  <input type="hidden" value="<?= $employees['employee_id'] ?>" name="emp_idd">
											  
											  <input type="button" 
											 id="sign_img" onClick="copysign_img('<?php echo $employees['employee_id'];   ?>')"/>
											 <?php } ?>
											  </td> <td class="text-center"><label> <input type="checkbox" class="i-checks checkpin" <?php   if($employees['pin']=='1'){echo "checked";  }else{echo "unchecked";} ?> name="checkpin[]" value="<?= $employees['employee_id'] ?>" />
                                                     <span class="lbl"></span>
                                                </label>
                                            </td>
											  
												<td><?= $employees['nick_name'] ?></td>
												
											 <td><?= $employees['name'] ?>
											</td>
											<td>
											<?php if(!empty($employees['copy_avatar'])){
												$image_name=basename($employees['copy_avatar']);?>
											<img class="avatar img-rounded" src="<?php echo base_url().$employees['copy_avatar'];  ?>" title="<?php echo $image_name;?>" style="width:50px;height: 50px; margin: 20px 0;" data-toggle="modal" data-target="#myModal">
											<?php }?>
											  <input type="hidden" value="<?= $employees['employee_id'] ?>" name="emp_id">
											  <?php if($employees['copy_avatar']){?>
											  <input type="button" 
											 id="sign_img" title="Click Here To Delete Image" onClick="delete_img('<?php echo $employees['employee_id'];   ?>')"/>
											  <?php } ?>
											</td>
											<td>
											<?php if(!empty($employees['copy_sign'])){
												$image_name=basename($employees['copy_sign']);?>
											<img class="avatar img-rounded" src="<?php echo base_url().$employees['copy_sign'];  ?>" title="<?php echo $image_name;?>" style="width:50px;height: 50px; margin: 20px 0;" data-toggle="modal" data-target="#myModal">
											<?php }?>
                                            </td>
                                            <td>
                                                
													<?= $employees['ssn'] ?>
                                                    
                                            </td>                                            
                                            <td >
                                        <?= $employees['tin'] ?>
                                               
                                            </td>
											<td><?= $employees['employee_pag_ibigno'] ?></td>
											<td><?= $employees['birth_date'] ?></td>
											<td><?= $employees['employee_contactperson'] ?></td>
											<td><?= $employees['employee_relation'] ?></td>
											<td><?= $employees['employee_address'] ?></td>
											<td><?= $employees['cell_phone'] ?></td>
											<td><?= $employees['status'] ?></td>
											
                                        </tr>
								
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>



<?php $this->load->view('layout/header',array('title'=> 'Employee Reminder','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function () {
		
        current_table = $('.data_table').dataTable({
            "order": [[2, "desc"]],
            "columnDefs": [{
//                    "targets": [0, 6],
//                    "orderable": false
                }]
        });
        $('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
    });
    
</script>
<style>
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 50%;
    min-height: 30%;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
   
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    position: absolute;
    top: -17px;
right: -16px;
    font-size: 19px;
    line-height: 30px;
    width: 36px;
    height: 36px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 10px;
    
    display: inline-block;
    font-weight: bold;
}
.dataTables_wrapper td
{
	padding: 6px 6px !important;
}
.align-cen
{
	text-align:left;
}
.align-censs
{
	text-align:left;
}
.align-right
{
	text-align:right;
}
.align-censs-right
{
text-align:right;	
}
.align-cen a
{
	font-size:16px;
}
.popupdiv-new
{
padding: 0px;
}
.popupdiv-new {
    padding: 17px;
    overflow-x: scroll;
  
}
</style>

<script>

$(window).load(function () {
    $(".trigger_popup_fricc").click(function(){
       $('.hover_bkgr_fricc').show();
    });
    $('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});

</script>


<script>

    $('document').ready(function(){
        // $('#documents_list').infinitescroll({
            // navSelector      : "#next:last",
            // nextSelector     : "a#next:last",
            // itemSelector     : "div.document_area",
            // dataType         : 'html',
            // loading:{
                // msgText          : '<?= $this->lang->line('Processing')?>',
                // finishedMsg      : '',    
            // },
            // maxPage          : <?= $documents['amount']?>,
            // path: function(index) {return 'documents/index/'+index+'?search=<?= ($search?$search:'')?>'}
        // });
		
	
			 current_tablem = $('.gbb').dataTable({
            "order": [[1, "DESC"]],
			"autoWidth": false,
			"ordering": false,
			"columnDefs": [{
                    "targets": [1, 3],
                    "orderable": true
                }]
        });
		
		
$(document).on("click", ".neww11", function(e) {
     var trId = $(this).closest('td').attr('id');
     alert (trId);

	  $.ajax({
                type: "GET",
               url: 'employeereminder/modelview/?id='+trId,
               //--> send id of checked checkbox on other page
                success: function(data) {
                    //alert('it worked');
                    
                    //$('#container').html(data);
					
                }, 
					 
					 
              
                 });
	 
	 
	 
	 }); 
	
//alert('dcdcd');
	
 //current_table.fnFilter($(this).html() ,3); 
			//alert($(this).html());

	   
	
    });
    
</script>
<style>
			td {
			width:9%!important;
			}
			tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td {
    text-align: center;
}
			</style>
<?php
// echo'<pre>';
// print_r($allvieww);
// echo'</pre>';
?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'employee_reminder'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?php echo "Employee Reminder"?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Employee Reminder";?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
				<?php if(isset($employee_memo['write_rem']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                    <a href="employeereminder/new_employeereminder" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
											<?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
			
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content ibox-content_alt">
                        <div class="row">
                            <div id="save_result"></div>
                            <div class="asdf asdfff">
                            <table class="table table-striped table-bordered table-hover data_table  bbb" >
                                <thead>
                                    <tr>
                                         <th style="width:30px!important; text-align:center">ID</th>
										<th style="width:30px!important;"><?= $this->lang->line('Date') ?></th>
										 <th style="width:30px!important;"><?= $this->lang->line('Category Name') ?></th>
                                        <th><?= $this->lang->line('Description') ?></th>
                                        <th style="text-align:center;"><?= $this->lang->line('File Attachment') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employeereminder['data'] as $index => $document) {


// echo '<pre>';
// print_r($document);
// echo '</pre>';




									?>
                                        <tr   entity_id="<?= $document['employeereminder_id'] ?>">
                                            <td class="idmanual" style="width:2%!important;"><?= $document['employeereminder_id'] ?></td>
											<td style="width:3%!important;"><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td style="width:5%!important;"> <?= $document['cname'] ?></td>
                                            <td id= "<?= $document['employeereminder_id'] ?>" class="">
											 <a class="btn   btn-xs" href="employeereminder/edit_document2/<?= $document['employeereminder_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                   <?= $document['description'] ?>
                                                </a>
											
											</td>
                                            <td >
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) { ?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="../images/file-icon.png"></a></div>
                                                        <?php } else { ?>
                                                            <div style="text-align:center;"><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><img src="../images/file-icon.png"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td style="text-align:center;">
<?php if(isset($employee_memo['edit_rem']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                                                <a class="btn btn-outline btn-success btn-xs" href="employeereminder/edit_document/<?= $document['employeereminder_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
												<?php 
											}
											?>
											<?php if(isset($employee_memo['del_rem']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['employeereminder_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												<?php 
											}
											?>
												
                                           <a 
											 href="employeereminder/mail_document/?id=<?= $document['employeereminder_id'] ?>" data-toggle="modal" data-target="#modal_window" style="border:1px solid #00b440; border-radius: 3px; padding: 0px 5px 2px;display: inline-block;">													
								<img src="http://uplushrms.peza.com.ph/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"></a>
                                                <form action="employeereminder/delete_document" method="POST" id="delete_document<?= $document['employeereminder_id'] ?>">
                                                    <input type="hidden" id="employeereminder_id" name="employeereminder_id" value="<?= $document['employeereminder_id'] ?>" class="employeereminder_id<?= $document['employeereminder_id'] ?>">
                                                </form>
                                            </td>
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
	
	<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
	<div class="popupdiv-new">
        <div class="popupCloseButton">X</div>
		
											
                                     <table  class="table table-striped table-bordered table-hover gbb" >
							
                                <thead>
                                    <tr>
                                         <th style="width:30px!important;">ID</th>
										<th style="width:30px!important;"><?= $this->lang->line('Date') ?></th>
										 <th style="width:30px!important;"><?= $this->lang->line('Category Name') ?></th>
                                        <th><?= $this->lang->line('Desciption') ?></th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr entity_id="<?= $document['employeereminder_id'] ?>">
                                            <td class="idmanual" style="width:2%!important;"><?= $document['employeereminder_id'] ?></td>
											<td style="width:3%!important;"><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td style="width:5%!important;"> <?= $document[''] ?></td>
                                            <td style="text-align:left;"><a class="trigger_popup_fricc"><?= $document['content'] ?></a></td>
                                                                              

                                        </tr>
                                  
								  
                                </tbody>
                            </table>
									</div>
    </div>
</div>
		
	
	
</div>
<?php $this->load->view('layout/footer')?>



<style>
@media only screen and (max-width: 990px) {
	
.asdf table tr td, .asdf table tr th {
    padding: 5px;
    font-size: 12px;
}
div#save_result table td, div#save_result table th { padding: 5px;font-size: 12px;}
.asdf{overflow-x: scroll;  width: 486px;}
}
@media only screen and (max-width: 550px) {
	
.asdf{  width: 377px;}
.ibox-content.ibox-content_alt {
    padding: 15px 10px 20px 10px;
}

}
@media only screen and (max-width: 400px) {
	
.asdf{width: 269px;}

}
tr.even td:nth-child(3) {
    text-align: inherit;
}
tr.even td:nth-child(2) {
    text-align: inherit;
}
select#mystatus {
    width: 90% !IMPORTANT;
}
</style>
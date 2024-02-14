<?php $this->load->view('layout/header',array('title'=> 'Employee Request','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function () {
		
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
            current_table.fnFilter( $(this).val() ); 
       });	
		
	
	
    });
    
</script>


<script>
    $('document').ready(function(){
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
<style>
			td {
			width:9%!important;
			}
			.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;
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


}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
			</style>
<?php
// echo'<pre>';
// print_r($documents);
// echo'</pre>';
?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'request'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?php echo "Employee Request"?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Employee Request";?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
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
							 
                            <table class="table table-striped table-bordered table-hover data_table" >
						<div class="col-md-3" style="float: right; margin-right:56%;">
						<div class="my-slect">
							 <select name="request_category_id" id="request_category_id" class="form-control required">
                            <option value="">Category Filter</option>
                            <?php foreach ($requestt as $category) { ?>
                                <option  value="<?= $category['request_name'] ?>"><?= $category['request_name'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
                                <thead>
                                    <tr>
                                        <th style="width:50px!important; text-align:center">ID</th>
										<th style="width:50px!important;"><?= $this->lang->line('Date') ?></th>
										 <th><?= $this->lang->line('Category Name') ?></th>
                                         <th><?= $this->lang->line('Description') ?></th>
										 <th><?= $this->lang->line('Requested by') ?></th>
										 <th><?= $this->lang->line('Status') ?></th>
                                        <th style="text-align:center;"><?= $this->lang->line('File Attachment') ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								// echo '<pre>';
									// print_r($request);
									// echo '</pre>';
									
								?>
                                    <?php foreach ($request['data'] as $index => $document) { 
									
									?>
                                        <tr entity_id="<?= $document['request_id'] ?>">
                                            <td class="idmanual" style="width:5%!important;"><?= $document['request_id'] ?></td>
											<td style="width:5%!important;"><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											
											<?php $contant_req =$document['content']; ?>
											
											<td > <?= $document['cname'] ?></td>
                                            <td style="width:17%!important;">
											<a class="btn btn-outline btn-primary btn-xs" style="margin-right:8px;" target="_blank" href="request/print_employee_request/<?= $document['request_id']; ?>" >
                                                    <i class="fa fa-print"></i> </a>
													<a class="  " href="request/edit_document/<?= $document['request_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                               <span class="on_hover_con">
                                                <?php echo $document['description'] ?>
												<span class="on_hover_text">
												
												
												<?php echo $contant_req ?></a></span></span>
												
											
												
											</td>
												<td><?= $document['name'] ?></td>
											 <td><?php if($document['status']==1){?><span class="badge badge-success m-t-xs" style="width: 86px;">Approved</span>
											 <?php } else if($document['status']==2){ ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: green !important;">Completed</span>
											 <?php  } else {?>
											  <span class="badge badge-success m-t-xs" style="width: 86px; background-color: orange !important;">Pending</span>
											<?php  } ?>
											</td>
                                            <td>
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) { ?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div style="text-align:center;"><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachment['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"style="width:16px !important;"></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><img src="http://wshrms.peza.com.ph/images/if_clip_115756.png" style="width:16px !important;"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td style="text-align:center;">

                                                <a class="btn btn-outline btn-success btn-xs" href="request/edit_document/<?= $document['request_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['request_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <form action="request/delete_document" method="POST" id="delete_document<?= $document['request_id'] ?>">
                                                    <input type="hidden" id="document_id" name="document_id" value="<?= $document['request_id'] ?>" class="request_id<?= $document['request_id'] ?>">
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
<style>
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !IMPORTANT;
}
</style>
<?php $this->load->view('layout/footer')?>



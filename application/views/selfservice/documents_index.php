<?php $this->load->view('layout/header',array('title'=>$this->lang->line('My documents'),'forms'=>TRUE,'scroll'=>TRUE)) ?>
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
            path: function(index) {return 'dashboard/my_documents/'+index+'?search=<?= ($search?$search:'')?>'}
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'my_documents'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('My documents')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Selfservice')?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-3 m-b-md">
                                <div class="search-form">
                                    <form action="documents" method="GET">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control input-lg" value="<?= ($search)?$search:''?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('Search')?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
                            <a id="next" class="hide" href="#">#</a>
                            <div id="documents_list">
                                <?php $this->load->view('selfservice/documents_list')?>
                            </div>
                        </div>
						
						
						<div class="row">
							<div class="col-lg-12">
								<div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content ibox-content2">
                        <div class="row">
                            <div id="save_result"></div>
							<div class="ibox-title" style="border: none; margin-top: -15px; margin-bottom: 13px; padding-left:1px;">
							
		<a style="float:right;"href="request/new_request/<?php echo '?cat='.$nameee; ?>" style=" margin-right:10px;margin-top: 15px;" class="btn btn-primary" 
			 data-toggle="modal" data-target="#modal_windowww">
                    <i class="fa fa-plus-circle"></i>
                 <?= $this->lang->line('Add')?>
                </a>			
   <span style="font-size: 23px; vertical-align:bottom; padding-top: 15px; color: #232b32;">My documents
 <!--<//?php echo "Employee Request";?> --> </span>
 <div class="col-md-3" style="float: right;margin-top:5px; margin-right:50%;">
								<div class="my-slect">
							 <select name="request_category_id" id="request_category_id"  style="margin-bottom: -33px;" class="form-control required">
                            <option value="">view all</option>
                            <?php foreach ($requestt as $category) { ?>
                                <option  value="<?= $category['request_name'] ?>"><?= $category['request_name'] ?></option>
                            <?php } ?>
                        </select>
						</div>
						</div>
 
        
                        </div>
						<div class="responsive2">
                            <table class="  table table-striped table-bordered table-hover data_tab" >
							
                                <thead>
                                    <tr>
									
                                        <th>ID</th>
										<th><?= $this->lang->line('Date') ?></th>
										 <th><?= $this->lang->line('Category Name') ?></th>
                                        <th><?= $this->lang->line('Desciption') ?></th>
										 <th><?= $this->lang->line('Requested by') ?></th>
										 <th class="ornge11"><?= $this->lang->line('Status') ?></th>
                                        <th style="text-align:center;"><?= $this->lang->line('File Attachment') ?></th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									// echo '<pre>';
									// print_r($requestemp);
									// echo '</pre>';
									
									foreach ($requestemp['data'] as $index => $documentt) { ?>
                                        <tr entity_id="<?= $documentt['request_id'] ?>">
                                            <td class="idmanual" ><?= $documentt['request_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($documentt['uploaded'])) ?></td>
											<td> <?= $documentt['cname'] ?></td>
                                            <td class="resp"><a class="btn btn-outline btn-primary btn-xs" style="margin-right:8px;" target="_blank" href="request/print_employee_request/<?= $documentt['request_id']; ?>" >
                                                    <i class="fa fa-print"></i>
                                                </a><?= $documentt['description'] ?></td>
											  <td><?= $documentt['name'] ?></td>
 <td class="ornge11"><?php if($documentt['status']==1){?><span class="badge badge-success m-t-xs" style="width: 86px;">Approved</span>
											 <?php } else if($documentt['status']==2){ ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: green !important;">Completed</span>
											 <?php  } else { ?>
											 <span class="badge badge-success m-t-xs" style="width: 86px; background-color: orange !important;">Pending</span>
											 <?php } ?>
											</td>
                                            <td style="text-align:center;">
                                                <div class="file-name wrapword">
                                                    <?php foreach ($documentt['attachments'] as $attachmentt) { ?>
                                                        <?php if (strpos($attachmentt['mime'], 'image') === false) { ?>
                                                            <div><a class='preview ' target="_blank" href="<?php echo base_url('documents/download_attachment/' . $attachmentt['attachment_id']) ?>" > <img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } else { ?>
                                                            <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachmentt['location']) ?>" ><img src="http://wshrms.peza.com.ph/images/if_clip_115756.png"></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td style="text-align:center;">

                                                <a class="btn btn-outline btn-success btn-xs" href="request/edit_document/<?= $documentt['request_id'] ?><?php echo '?page=selfservice'; ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $documentt['request_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                               <form action="request/delete_document" method="POST" id="delete_document<?= $documentt['request_id'] ?>">
                                                    <input type="hidden" id="document_id" name="document_id" value="<?= $documentt['request_id'] ?>" class="request_id<?= $documentt['request_id'] ?>">
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
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
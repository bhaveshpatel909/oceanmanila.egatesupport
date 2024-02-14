<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Documents'),'forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function () {
		
        current_table = $('.data_table').dataTable({
            "order": [[6, "asc"]],
            "columnDefs": [{
//                    "targets": [0, 6],
//                    "orderable": false
                }]
        });
		$('#request_no_days').change( function() { 
            //current_table.fnFilter( $(this).val() );
current_table.fnFilter( this.value, 6);			
       });	
        $('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
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

<?php
// echo'<pre>';
// print_r($documents);
// echo'</pre>';
?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'documents'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('All Documents')?></h2>
                <ol style="display:none;" class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('All Documents')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="documents/new_document" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
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
							
					 Days to expire 
					 <input type="text" id="request_no_days" name="request_no_days" value="">
					 <a href ="documents/exportalldocument"> Export</a>
					
                            <table class="table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
                                        <td style="text-align:center;"width="4%">ID</td>
										<th><?= $this->lang->line('Category Name') ?></th>
                                      
                                        <th ><?= $this->lang->line('Date') ?></th>
                                          <th width="30%"><?= $this->lang->line('Description') ?></th>
                                        <th><?= $this->lang->line('Attachments') ?></th>
                                        <th><?= $this->lang->line('Date Reminder') ?></th>
											 <th><?= $this->lang->line('Day to Expire') ?></th>
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($documents['data'] as $index => $document) { ?>
                                        <tr entity_id="<?= $document['document_id'] ?>">
                                            <td><?= $document['document_id'] ?></td>
                                           	<td><?= $document['cname'] ?></td>
                                            <td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
										
											 <td><?= $document['description'] ?></td>
                                             <td>
 <div class="file-name wrapword">
 <?php foreach ($document['attachments'] as $attachment) { ?>
 <?php if (strpos($attachment['mime'], 'image') === false) { ?>
 <div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>"download="<?php echo base_url('files/attachments/' . $attachment['file']) ?>" target="_blank"><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
    <?php } else { ?>
 <div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" ><i class="fa <?= get_fa_extension($attachment['extenstion']) ?>"></i> <?= $attachment['file'] ?></a></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>   
<td><?php if($document['date_reminder']!= '0000-00-00 00:00:00'){echo date('Y-m-d',strtotime($document['date_reminder']));}?></td>
<td><?php if($document['date_reminder']!= '0000-00-00 00:00:00'){
	$date1 = date('Y-m-d');
											 $diff = strtotime($document['date_reminder']) - strtotime($date1);
  
											  // 1 day = 24 hours
											  // 24 * 60 * 60 = 86400 seconds
											  $day_left = round($diff / 86400); 
											  if ($day_left > 0)
											  {
												  echo $day_left;
											  }
											  else
											  {
												?>
													<p style="color:red;"><?php echo $day_left;?></p>
													<?php
											  }
}?></td>												
                                            <td>

                                                <a class="btn btn-outline btn-success btn-xs" href="documents/edit_document/<?= $document['document_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['document_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												<?php if($document['email_for_reminder']==1)
												{
													?>
													<a class="btn btn-outline btn-success btn-xs" href="documents/email_reminder/<?= $document['document_id'] ?>">
                                                    <img src="<?php echo base_url();?>images/email-icon.png " style="width:15px; height:10px; border-radius:2px;">
													</a>
													<?php
												}
												?>

                                                <form action="documents/delete_document" method="POST" id="delete_document<?= $document['document_id'] ?>">
                                                    <input type="hidden" id="document_id" name="document_id" value="<?= $document['document_id'] ?>" class="document_id<?= $document['document_id'] ?>">
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
    border-top: 1px #ddd solid !important;
}
table#DataTables_Table_0 {
    width: 100% !important;
}

</style>
  
<?php $this->load->view('layout/footer')?>

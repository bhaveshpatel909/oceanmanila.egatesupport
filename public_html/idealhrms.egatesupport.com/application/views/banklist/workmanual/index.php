<?php $this->load->view('layout/header',array('title'=> 'Work Manual','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function () {
		
        current_table = $('.data_table').dataTable({
            "order": [[1, "desc"]],
			 "aoColumnDefs": [
		{ "sWidth": "10%",}],
			
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
<style>

th.dateee {
    width: 5% !important;

}

 th.idddd {
	width: 3% !important; 
 }

 
 th.cattgre {
	 
width:9% !important;
 }
 th.discrip{
width:9% !important;
 }
 th.fileee{
	 width:8% !important;
  
 }
 th.edittt{
	 
	 width:8% !important;
 }
 
 
			td {
			width:30px!important;
			}
			
.atttt ul{float: left;
    list-style: none;
	padding-right: 10px;
	padding-left: 0px;
	}
	
.ttt00 {
  
}



			</style>




<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'workmanual'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?php echo "Work Manual"?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Work Manual";?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
				<?php if(isset($employee_memo['write_man']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                    <a href="workmanual/new_workmanual" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
                    </a>
					<?php 
						} ?>
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
                                <thead>
                                    <tr>
                                        <th class="idddd">ID</th>
										<th  class="dateee"> <?=$this->lang->line('Date') ?></th>
										 <th class="cattgre"><?= $this->lang->line('Category Name') ?></th>
                                        <th  class="discrip"><?= $this->lang->line('Desciption') ?></th>
                                        <th class="fileee"></th>
                                        <th class="edittt"></th>
										    
                                      
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								// echo "<pre>";
								// print_R($employee_memo);
								?>
                                    <?php foreach ($workmanual['data'] as $index => $document) { 
									// echo '<pre>';
									// print_r($workmanual['data']);
									// echo '</pre>';
									?>
                                        <tr entity_id="<?= $document['workmanual_id'] ?>">
                                            <td class="idmanual"><?= $document['workmanual_id'] ?></td>
											<td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
											<td > <?= $document['cname'] ?></td>
                                            
											
											<td><?php 
											 $cday = $settings['days'];
											
											$newdate = date('Y-m-d');
												
											 $udate = date('Y-m-d', strtotime($document['uploaded']));
											 $daysting = "+".$cday."  day";
											 $enddate = date('Y-m-d',strtotime($daysting, strtotime($udate)));
											
											if( $newdate < $enddate && $udate >= $newdate || $enddate > $newdate ){ ?>
											
											<div style="color:red"><?= $document['description'] ?></div>
											<?php }  else { ?>
											
											<div style="color:black;"><?= $document['description'] ?></div>
												<?php } ?>
											</td>
                                            <td>
                                                <div class="file-name wrapword">
                                                    <?php foreach ($document['attachments'] as $attachment) { ?>
                                                        <?php if (strpos($attachment['mime'], 'image') === false) { ?>
                                                            <div  class="atttt"><ul><li><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" >
															
															<img src="http://wshrms.peza.com.ph/images/if_clip_115756.png" style=""></a></li></ul></div>
                                                        <?php } else { ?>
                                                            <div class="atttt"><ul><li><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" >
															
															<img src="http://wshrms.peza.com.ph/images/if_clip_115756.png "style=""></a></li></ul></div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </td>                                            
                                            <td>
											<?php if(isset($employee_memo['edit_man']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                                                <a class="btn btn-outline btn-success btn-xs" href="workmanual/edit_document/<?= $document['workmanual_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
												<?php 
											} ?>
											<?php if(isset($employee_memo['delete_man']) || $this->session->current->userdata('employee_id')==1)
											{ ?>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete document ?') && submit_form('#delete_document<?= $document['workmanual_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
												<?php 
											} ?>
												<a 
											 href="workmanual/mail_document/?id=<?= $document['workmanual_id'] ?>" data-toggle="modal" data-target="#modal_window" style="border:1px solid #00b440; border-radius: 3px; padding: 0px 5px 2px;display: inline-block;">													
								<img src="http://wshrms.peza.com.ph/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;"></a>
                                              
                                                <form action="workmanual/delete_document" method="POST" id="delete_document<?= $document['workmanual_id'] ?>">
                                                    <input type="hidden" id="workmanual_id" name="workmanual_id" value="<?= $document['workmanual_id'] ?>" class="workmanual_id<?= $document['workmanual_id'] ?>">
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
<?php $this->load->view('layout/footer')?>

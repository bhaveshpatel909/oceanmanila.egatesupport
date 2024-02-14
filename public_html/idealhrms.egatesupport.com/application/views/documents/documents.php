<?php $this->load->view('layout/header', array('title' => $this->lang->line('Documents'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE, 'magicsuggest' => TRUE)) ?>
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
.tblsty td:nth-child(2) { min-width: 255px;}
.tblsty th:nth-child(5) {width: 200px !important;}
.tblsty td:nth-child(6) { text-align: center;}
.discrib_css:hover > .contnt_onhover {
    display: block;
}

.contnt_onhover {
    display: none;
	background: #ffffff;
    position: absolute;
    margin-top: 3px;
    margin-left: 134px;
    width: 472px;
    border-radius: 3px;
    text-align: justify;
	padding: 10px;
}
.breadcrumb {
    display: none !important;
}

</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => $active_menu)) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line($active_menu) ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Template Document') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="documents/new_document/<?= $category_id ?>" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
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
                            <table class="tblsty table table-striped table-bordered table-hover data_table" >
                                <thead>
                                    <tr>
                                        <td width="52px;">ID</td>
                                        <th ><?= $this->lang->line('Description') ?></th>
                                        <th width="10%"><?= $this->lang->line('Date') ?></th>
                                        <th width="10%"><?= $this->lang->line('Attachments') ?></th>
                                      <!--th><?= $this->lang->line('Remarks') ?></th-->
                                      <th  width="4%" ><?= $this->lang->line('Date Reminder') ?></th>
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($documents['data'] as $index => $document) { ?>
                                        <tr entity_id="<?= $document['document_id'] ?>">
                                            <td><?= $document['document_id'] ?></td>
                                            <td><span class="discrib_css"><?= $document['description'] ?>
											<span class="contnt_onhover"><?php echo strip_tags($document['content']);?></span></span></td>
                                            <td><?= date('Y-m-d', strtotime($document['uploaded'])) ?></td>
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
											<!--td>
											</td-->	
<td><?php if($document['date_reminder']!= '0000-00-00 00:00:00'){echo date('Y-m-d',strtotime($document['date_reminder']));}?></td>												
                                            <td>
								             
											<a class="btn btn-outline btn-success btn-xs" href="documents/print_pdf_duco/<?= $document['document_id'] ?>">
                                                    <i class="fa fa-file-pdf-o" ></i>
                                                </a>

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
<?php
$this->load->view('layout/footer')?>
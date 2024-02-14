<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Group Lists'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'201_file_document_type'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('201 Document Type')?><span style="font-size:13px; font-weight:600;" class="sml"> <span><img title="-You can register additional Specific Job Group to easily designate the employee"style="margin-left:5px;margin-right:5px;" src="images/if_Help.png" width="17px"></span></span></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                    <li>
                        <?= $this->lang->line('201 Document Type')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="document_type/new_document_type" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add')?>
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
                                    <thead>
                                        <tr>
                                            <th><?= $this->lang->line('Name')?></th>
                                            <th><?= $this->lang->line('Days to alert')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
                                        <?php 
										// echo "<pre>";
										// print_r($grouplist);
										foreach($document_typelist as $document_type){?>
                                        <tr entity_id="<?= $document_type['document_type_id']?>">
                                            <td><?= $document_type['document_type_name']?></td>
                                            <td><?= $document_type['days_to_alert']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="document_type/edit_document_type/<?= $document_type['document_type_id']?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
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
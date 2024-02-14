<?php
 $this->load->view('layout/header',array('title'=>$this->lang->line('Evaluation List'),'forms'=>TRUE,'tables'=>TRUE)) 
 ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'evaluation_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Evaluation List')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Evaluation List')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="discipline/new_evaluation"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th><?= $this->lang->line('ID')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Remarks')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									$cout = 1;
									foreach($evaluation_templates as $evaluation_template){?>
                                    <tr entity_id="<?= $evaluation_template['id']?>">
                                        <td width="6%"><?= $cout ?></td>
                                        <td><?= $evaluation_template['name']?></td>
                                        <td><?= $evaluation_template['remarks']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success " data-target="#modal_window" data-toggle="modal" href="discipline/edit_evaluation/<?= $evaluation_template['id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
											<a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="evaluation/preview_evaluationeditpdf/<?= $evaluation_template['id']?>">
                                            <i class="fa fa-file-pdf-o"></i>
                                            </a>
											
                                        </td>
                                    </tr>
                                    <?php $cout++; }?>
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
<?php
 $this->load->view('layout/header',array('title'=>$this->lang->line('Employee Work Evaluation'),'forms'=>TRUE,'tables'=>TRUE)) 
 ?>
<script>
    $('document').ready(function(){
       $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'evaluation_templates'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Employee Work Evaluation')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Employee Work Evaluation')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
				<!--form name="" method ="post" action ="evaluation/import_evaluation_template" enctype="multipart/form-data">
				<input type="file" name ="file_name">
				<input type ="submit" name ="submit" value ="Import">
				</form-->
				
                    <a href="evaluation/export_evaluation_template"  class="btn btn-primary">
                        
                        <?= $this->lang->line('Export')?>
                    </a>
					<a href="evaluation/new_evaluation_template"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th><?= $this->lang->line('Score')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Evaluation Category')?></th>
                                        <th><?= $this->lang->line('Remarks')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($evaluation_templates as $evaluation_template){?>
                                    <tr entity_id="<?= $evaluation_template['id']?>">
                                        <td width="6%"><?= $evaluation_template['id']?></td>
                                        <td><?= $evaluation_template['score']?></td>
                                        <td><?= $evaluation_template['name']?></td>
                                        <td><?= $evaluation_template['ecategory']?></td>
                                        <td><?= $evaluation_template['remarks']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success " data-target="#modal_window" data-toggle="modal" href="evaluation/edit_evaluation_template/<?= $evaluation_template['id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
											<a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="evaluation/preview_evaluationeditpdf/<?= $evaluation_template['id']?>">
                                            <i class="fa fa-file-pdf-o"></i>
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
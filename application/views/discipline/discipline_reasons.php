<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Discipline Reasons'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        mcurrent_table = $('.data_table').dataTable();
		
		
		
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'discipline_reasons'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('201 File Reasons & Details')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Discipline Reasons')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="discipline/new_discipline_reason"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th><?= $this->lang->line('Category')?></th>
                                        <th><?= $this->lang->line('Remarks')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($discipline_reasons as $discipline_reason){?>
                                    <tr entity_id="<?= $discipline_reason['id']?>">
                                        <td width="6%"><?= $discipline_reason['id']?></td>
                                        <td><?= $discipline_reason['score']?></td>
                                        <td><?= $discipline_reason['name']?></td>
                                        <td><?= $discipline_reason['category']?></td>
                                        <td><?= $discipline_reason['remarks']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success btn-xs" data-target="#modal_window" data-toggle="modal" href="discipline/edit_discipline_reason/<?= $discipline_reason['id']?>">
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
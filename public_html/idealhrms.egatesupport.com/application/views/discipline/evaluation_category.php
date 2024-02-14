<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Discipline Actions'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'evaluation_category'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Evaluation Category')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Category List')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="discipline/new_evaluation_category"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <!--th><?= $this->lang->line('Score')?></th-->
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									$cont = 1;
									foreach($discipline_actions as $discipline_action){?>
                                    <tr entity_id="<?= $discipline_action['id']?>">
                                        <td width="6%"><?= $cont ?></td>
                                        <td><?= $discipline_action['name']?></td>
                                        <!--td><?= $discipline_action['score']?></td-->
                                        <td>
                                            <a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="discipline/edit_evaluation_category/<?= $discipline_action['id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $cont++; }?>
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
	table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none;
    text-align: center;
}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
</style>
<?php $this->load->view('layout/footer')?>
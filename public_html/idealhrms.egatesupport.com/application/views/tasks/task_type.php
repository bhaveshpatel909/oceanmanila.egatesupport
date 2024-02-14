<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Task Type'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'task_type'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Task Type')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="settings/new_task_type" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th  width="51px"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Task Code')?></th>
                                            <th><?= $this->lang->line('Task Type')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$count = 1;
										foreach($task_type_list as $task_type){
											
											?>
                                        <tr entity_id="<?= $task_type['id']?>">
                                            <td><?= $count?></td>
                                            <td><?= $task_type['code']?></td>
                                            <td><?= $task_type['type']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="settings/edit_task_type/<?= $task_type['id']?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $count++; }?>
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
    background: none !important;
    text-align: center !important;
}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
</style>
<?php $this->load->view('layout/footer')?>
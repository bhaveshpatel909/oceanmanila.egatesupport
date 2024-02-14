<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Schedule Item'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable({
            "order": [[0, "asc"]],
            "columnDefs": [{
                    "targets": [3],
                    "orderable": false
                }]
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'schedule_item'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Schedule Item')?></h2>
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
                    <a href="settings/new_schedule_item" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="background:none !important;text-align:center;"width="6%"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Schedule Item Name')?></th>
                                            <th><?= $this->lang->line('Color')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($schedule_items as $schedule_item){?>
                                        <tr entity_id="<?= $schedule_item['id']?>">
                                            <td><?= $schedule_item['id']?></td>
                                            <td><?= $schedule_item['name']?></td>
                                            <td><span class="label" style="background-color: <?= $schedule_item['color']?>"><?= $schedule_item['color']?></span></td>
                                            <td style="text-align:center !important;">
                                                <a class="btn btn-outline btn-success btn-xs" href="settings/edit_schedule_item/<?= $schedule_item['id']?>" data-target="#modal_window" data-toggle="modal">
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
<style>
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
tr.odd td:nth-child(4) {
    text-align: center !important;
}
tr.even td:nth-child(4) {
    text-align: center !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: center !important;
    background: #fff !important;
}
</style>
<?php $this->load->view('layout/footer')?>
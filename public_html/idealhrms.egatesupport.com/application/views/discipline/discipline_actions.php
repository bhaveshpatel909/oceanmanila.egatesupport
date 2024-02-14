<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Discipline Actions'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'discipline_actions'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Penalty Point')?></h2>
                <ol style="display:none;"class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Actions List')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="discipline/new_discipline_action"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th style="text-align:center;"><?= $this->lang->line('ID')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th style="width:10%;text-align:center;"><?= $this->lang->line('Score')?></th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($discipline_actions as $discipline_action){?>
                                    <tr entity_id="<?= $discipline_action['id']?>">
                                        <td width="6%"><?= $discipline_action['id']?></td>
                                        <td><?= $discipline_action['name']?></td>
                                        <td><?= $discipline_action['score']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="discipline/edit_discipline_action/<?= $discipline_action['id']?>">
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
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tbody tr.odd td:nth-child(4) {
    text-align: center !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tr.even td:nth-child(4) {
    text-align: center !IMPORTANT;
}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
tr.odd td:nth-child(3) {
    text-align: center;
}
tr.even td:nth-child(3) {
    text-align: center;
}
table#DataTables_Table_0 {
    border: 1px #ddd solid !important;
}
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none !IMPORTANT;
}
</style>
<?php $this->load->view('layout/footer')?>
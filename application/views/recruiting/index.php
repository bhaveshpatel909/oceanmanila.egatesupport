<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Recruiting'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'recruiting'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Vacancies')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Recruiting')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="recruiting/new_vacancy" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                            <table class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('For position')?></th>
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($vacancies as $vacancy){?>
                                        <tr>
                                            <td>[<?= ($vacancy['department_name']?$vacancy['department_name']:'-')?>] <?= ($vacancy['position_name']?$vacancy['position_name']:'-')?></td>
                                            <td><?= $this->lang->line($vacancy['status'])?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="recruiting/vacancy/<?= $vacancy['vacancy_id']?>">
                                                    <i class="fa fa-tasks"></i>
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
tr.odd td:nth-child(3) {
    text-align: center !important;
}
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none;
}
tr.odd td:nth-child(1) {
    background: none !important;
}
tr.odd td:nth-child(2) {
    background: none !important;
    border-left: 1px #ddd solid !important;
}
tr.even td:nth-child(3) {
    text-align: center !important;
}
tr.even td:nth-child(2) {
    border-left: 1px #ddd solid !important;
}
tr.odd td:nth-child(3) {
    text-align: center !important;
    background: none !important;
    border-left: 1px #ddd solid !important;
}
tr.even td:nth-child(3) {
    text-align: center !important;
    border-left: 1px #ddd solid !important;
}
</style>
<?php $this->load->view('layout/footer')?>
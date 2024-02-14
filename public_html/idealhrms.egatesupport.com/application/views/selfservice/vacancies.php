<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Vacancies'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'open_vacancies'))?>
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
                        <?= $this->lang->line('Selfservice')?>
                    </li>
                </ol>
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
                                        <th><?= $this->lang->line('Position')?></th>
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th style="width:8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($vacancies as $vacancy){?>
                                        <tr entity_id="<?= $vacancy['vacancy_id']?>">
                                            <td>[<?= ($vacancy['department_name']?$vacancy['department_name']:'-')?>] <?= ($vacancy['position_name']?$vacancy['position_name']:'-')?></td>
                                            <td><?= $this->lang->line($vacancy['status']?$vacancy['status']:'-')?></td>
                                            <td>
                                                <?php if(is_null($vacancy['status'])){?>
                                                <a class="btn btn-outline btn-success" href="dashboard/apply_to_vacancy/<?= $vacancy['vacancy_id']?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <?php }elseif($vacancy['status']=='Active'){?>
                                                -
                                                <?php }?>
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
</style>
<?php $this->load->view('layout/footer')?>
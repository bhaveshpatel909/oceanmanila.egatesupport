<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Applicants'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'applicants'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Applicants')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Recruiting')?>
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
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Position')?></th>
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($applicants as $applicant){?>
                                    <tr>
                                        <td><?= $applicant['applicant_name']?></td>
                                        <td>[<?= $applicant['department_name']?>] <?= $applicant['position_name']?></td>
                                        <td><?= $this->lang->line($applicant['status'])?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success" href="recruiting/applicant/<?= $applicant['applicant_id']?>" data-target="#modal_window" data-toggle="modal">
                                                <i class="fa fa-info"></i>
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
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !important;
}
</style>
<?php $this->load->view('layout/footer')?>
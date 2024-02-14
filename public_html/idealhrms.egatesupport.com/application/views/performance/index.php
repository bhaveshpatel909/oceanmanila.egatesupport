<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Appraisal'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'performance'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Appraisal')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Performance')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="performance/new_appraisal" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th><?= $this->lang->line('Employee')?></th>
                                        <th><?= $this->lang->line('Dates')?></th>
                                        <th><?= $this->lang->line('Is completed')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($appraisals as $appraisal){?>
                                        <tr>
                                            <td><?= $appraisal['name']?></td>
                                            <td><?= $appraisal['start_date']?date($this->config->item('date_format'),strtotime($appraisal['start_date'])):'-'?> - <?= $appraisal['start_date']?date($this->config->item('date_format'),strtotime($appraisal['end_date'])):'-'?></td>
                                            <td><?= $this->lang->line($appraisal['is_completed']=='1'?'Yes':'No')?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="performance/appraisal/<?= $appraisal['appraisal_id']?>">
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
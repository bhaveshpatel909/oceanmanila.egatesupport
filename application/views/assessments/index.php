<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Assessments'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'assessments'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Assessments')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Skills')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="skills/new_assessment" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
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
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Date')?></th>
                                        <th><?= $this->lang->line('Department')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($assessments as $assessment){?>
                                    <tr entity_id="<?= $assessment['assessment_id']?>">
                                        <td><?= $assessment['assessment_name']?></td>
                                        <td><?= date($this->config->item('date_format'),strtotime($assessment['assessment_date']))?></td>
                                        <td><?= $assessment['department_name']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success" href="skills/edit_assessment/<?= $assessment['assessment_id']?>" data-target="#modal_window" data-toggle="modal">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-outline btn-success" href="skills/set_assessments/<?= $assessment['assessment_id']?>">
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
<?php $this->load->view('layout/footer')?>
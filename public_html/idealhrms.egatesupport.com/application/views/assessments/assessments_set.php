<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Add assessments'),'forms'=>TRUE)) ?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'assessments'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $assessment['assessment_name']?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Skills')?>
                    </li>
                    <li>
                        <?= $this->lang->line('Assessments')?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                            <?php foreach($employees as $employee){?>
                            <div class="col-lg-4 person_area">
                                <div class="contact-box">
                                    <a href="skills/assessment_results/<?= $employee['employee_id']?>/<?= $assessment['assessment_id']?>">
                                        <div class="col-sm-4">
                                            <div class="text-center">
                                                <img class="img-circle" src="<?= $employee['avatar']?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <h3><strong><?= $employee['name']?></strong></h3>
                                            <span class="badge badge-info"><?= $employee['completed']?></span> / <span class="badge badge-warning-light"><?= $employee['waiting']?></span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
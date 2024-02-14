<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Dashboard'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'dashboard'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="clearfix"></div>
                        <div class="col-lg-5">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Newly hired')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <div class="feed-activity-list">
                                            <?php foreach($newly_hired as $person){?>
                                            <div class="feed-element">
                                                <a href="employees/edit_employee/<?= $person['employee_id']?>" class="pull-left">
                                                    <img class="img-circle" src="<?= $person['avatar']?>">
                                                </a>
                                                <div class="media-body ">
                                                    <small class="pull-right"><?= date($this->config->item('date_format'),strtotime($person['hired_at']))?></small>
                                                    <strong><?= $person['name']?></strong> 
                                                    <br/>[<?= $person['department_name']?>] <?= $person['position_name']?>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Discipline')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <div class="feed-activity-list">
                                            <?php foreach($discipline as $record){?>
                                            <div class="feed-element">
                                                <a href="#" class="pull-left">
                                                    <img class="img-circle" src="<?= $record['avatar']?>">
                                                </a>
                                                <div class="media-body ">
                                                    <small class="pull-right"><?= date($this->config->item('date_format'),strtotime($record['date']))?></small>
                                                    <strong><?= $record['name']?></strong> 
                                                    <br/> [<?= $record['department_name']?>] <?= $record['position_name']?>
                                                    <br/><small class="text-muted"><?= $record['headline']?></small>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Statistics')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <?php if ($unsent_emails>0){?>
                                        <button class="btn btn-info" onclick="ajax_query('dashboard/send_emails')">
                                            <?= $this->lang->line('Send unsent emails')?> (<?= $unsent_emails?>)
                                        </button>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
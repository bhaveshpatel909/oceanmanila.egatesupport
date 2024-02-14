<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Vacancy'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
        
        $("#cancel_vacancy").click(function(){
            $.ajax({
                url:'recruiting/cancel_vacancy/<?= $vacancy['vacancy_id']?>',
                success:function(){
                    location.reload();
                }
            })
            return false;
        })
    })
</script>
<?php $this->load->view('mix/attachment_remove')?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'recruiting'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Vacancy')?></h2>
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
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button" onclick="submit_form('#save_vacancy')">
                            <i class="fa fa-save"></i>
                            <?= $this->lang->line('Save')?>
                        </button>
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#" id="cancel_vacancy"><?= $this->lang->line('Cancel')?></a>
                            </li>
                        </ul>
                    </div>
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
                            <form action="recruiting/save_vacancy" method="POST" id="save_vacancy">
                                <input type="hidden" name="vacancy_id" id="vacancy_id" value="<?= $vacancy['vacancy_id']?>">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label class="control-label"><?= $this->lang->line('Position')?></label>
                                        <p>[<?= ($vacancy['department_name']?$vacancy['department_name']:'-')?>] <?= ($vacancy['position_name']?$vacancy['position_name']:'-')?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label"><?= $this->lang->line('Description')?></label>
                                        <textarea rows="5" class="form-control" name="description" id="description"><?=  $vacancy['description']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= $this->lang->line('Status')?></label>
                                        <p><?= $this->lang->line($vacancy['status'])?></p>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <label class="control-label"><?= $this->lang->line('Skills')?></label>
                                    <ul class="unstyled no-padding" style="max-height: 250px;overflow: auto;">
                                        <?php foreach($skills as $category){?>
                                        <li>
                                            <?= $category[0]['category_name']?>
                                            <ul class="unstyled">
                                                <?php foreach($category as $skill){?>
                                                <li><?= $skill['skill_name']?></li>
                                                <?php }?>
                                            </ul>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <hr/>
                            <div class="clearfix"></div>
                            <a href="recruiting/new_applicant/<?= $vacancy['vacancy_id']?>" class="btn btn-primary pull-right" data-target="#modal_window" data-toggle="modal">
                                <i class="fa fa-plus-circle"></i>
                                <?= $this->lang->line('Add')?>
                            </a>
                            <h3 class="pull-left"><?= $this->lang->line('Applicants')?></h3>
                            <div class="clearfix space-15"></div>
                            <table class="table table-striped table-bordered table-hover data_table">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($applicants as $applicant){?>
                                    <tr entity_id="<?= $applicant['applicant_id']?>">
                                        <td>
                                        <?php if ($applicant['current_employee']>0){
                                        if ($this->user_actions->is_allowed('employees')){?>
                                        <a href="employees/edit_employee/<?= $applicant['current_employee']?>" class="btn btn-xs btn-info" target="_blank">
                                            <i class="fa fa-user" title="<?= $this->lang->line('Current employee')?>"></i>
                                        </a>
                                        <?php }else{?>
                                        <i class="fa fa-user" title="<?= $this->lang->line('Current employee')?>"></i>
                                        <?php } }?>
                                        <?= $applicant['applicant_name']?></td>
                                        <td><?= $this->lang->line($applicant['status'])?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success" href="recruiting/edit_applicant/<?= $applicant['applicant_id']?>" data-target="#modal_window" data-toggle="modal">
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
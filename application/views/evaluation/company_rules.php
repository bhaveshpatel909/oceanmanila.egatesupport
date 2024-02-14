<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Work Evaluation'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'work_evaluation_rules'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Work Evaluation')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Work Evaluation')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="reports/print_work_evaluation_rules"  class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print')?>
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
                                        <th><?= $this->lang->line('No.')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th><?= $this->lang->line('To do and Not to do')?></th>
                                        <!--<th></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($company_rules as $key => $company_rule){?>
                                    <tr entity_id="<?= $company_rule['id']?>">
                                        <td width="6%"><?= ($key + 1)?></td>
                                        <td><?= $company_rule['name']?></td>
                                        <td><?= $company_rule['company_rules']?></td>
<!--                                        <td>
                                            <a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="discipline/edit_company_rule/<?= $company_rule['id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>-->
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
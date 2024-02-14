<?php $this->load->view('layout/header', array('title' => $this->lang->line('Schedule'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE)) ?>
<script>
    $('document').ready(function () {
        $(".knob").knob();
        current_table = $('.data_table').dataTable({
            "order": [[0, "asc"]],
            "columnDefs": []
        });
    });
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_daily')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Daily Schedules') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Schedule') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
<!--                    <a href="schedule/new_schedule" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
                    </a>-->
<a target="_blank" href="schedule/print_daily" class="btn btn-primary">
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print') ?>
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
                                        <th><?= $this->lang->line('Customer') ?></th>
                                        <th><?= $this->lang->line('Item') ?></th>
                                        <th><?= $this->lang->line('Remarks') ?></th>
                                        <th width="7%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($schedules as $schedule) { ?>
                                        <tr entity_id="<?= $schedule['schedule_id'] ?>">
                                            <td><?= $schedule['customer_name'] ?></td>
                                            <td><?= $schedule['item_name'] ?></td>
                                            <td width="50%"><?= $schedule['remarks'] ?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success btn-xs" href="schedule/edit_schedule/<?= $schedule['schedule_id'] ?>" >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete schedule ?') && submit_form('#delete_schedule<?= $schedule['schedule_id'] ?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <form action="schedule/delete_schedule" method="POST" id="delete_schedule<?= $schedule['schedule_id'] ?>">
                                                    <input type="hidden" id="schedule_id" name="schedule_id" value="<?= $schedule['schedule_id'] ?>" class="schedule_id<?= $schedule['schedule_id'] ?>">
                                                </form>
                                            </td>
                                        </tr>                                    
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer')?>
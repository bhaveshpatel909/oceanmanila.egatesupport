<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Petty Cash Item'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable({
            "order": [[0, "asc"]],
            "columnDefs": [{
                    "targets": [2],
                    "orderable": false
                }]
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'petty_cash_item'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Petty Cash Item')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="settings/new_petty_item" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="background:none; text-align:center;"width="51px;"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Petty Item Name')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($petty_items as $petty_item){?>
                                        <tr entity_id="<?= $petty_item['id']?>">
                                            <td><?= $petty_item['id']?></td>
                                            <td><?= $petty_item['name']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="settings/edit_petty_item/<?= $petty_item['id']?>" data-target="#modal_window" data-toggle="modal">
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
<style>
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
</style>
<?php $this->load->view('layout/footer')?>
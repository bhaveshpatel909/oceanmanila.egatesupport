<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Monthly Bill List'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'monthly_bill_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Monthly Bill List')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Monthly Bill List')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="monthlybilllist/new_monthlybilllist" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="text-align:center;background:none;"width="6%"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Pay To');?></th>
                                            <th><?= $this->lang->line('Remarks');?></th>
                                            <th style="width:10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$count = 1;
										foreach($monthlybilllist as $banklistt){
											
											?>
                                        <tr entity_id="<?= $banklistt['billlist_id']?>">
                                            <td><?= $banklistt['billlist_id']?></td>
                                            <td><?= $banklistt['list_name']?></td>
                                            <td><?= $banklistt['remarks']?></td>
                                           
                                            <td style="text-align:center !important;">
                                                <a class="btn btn-outline btn-success" href="monthlybilllist/edit_monthlybilllist/<?= $banklistt['billlist_id']?>" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $count++; }?>
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
.align-cen a {
    font-size: 12px !important;
    font-weight: normal !Important;
}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
tr.odd td:nth-child(4) {
    text-align: center !important;
}
tr.even td:nth-child(4) {
    text-align: center !important;
}
</style>
<?php $this->load->view('layout/footer')?>
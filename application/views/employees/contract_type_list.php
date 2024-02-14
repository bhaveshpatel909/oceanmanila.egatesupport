<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Contract Type'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'contract_type'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-9">
                <h2><?= $this->lang->line(' Contract Template List')?> <span><img title="- Add and register ready made Contract Template to easily create employee contract" style="margin-left:5px;" src="images/if_Help.png" width="17px"></span></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Contract Type')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-3">
                <div class="title-action">
				<a title="Print employee guide line ( To Do &amp; Not To Do )
" href="employees/print_contract_type_list" class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        Print Contract List                   </a>
                    <a href="employees/new_contract_type"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th style="width:4%;text-align:center;"><?= $this->lang->line('ID')?></th>
                                        <th><?= $this->lang->line('Name')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($contract_types as $contract_type){?>
                                    <tr entity_id="<?= $contract_type['id']?>">
                                        <td><?= $contract_type['id']?></td>
                                        <td><?= $contract_type['name']?></td>
                                        <td style="width:8%;">
                                            <a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="employees/edit_contract_type/<?= $contract_type['id']?>">
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


<style>
.sml {
    font-size: 13px;
    font-weight: 600;
}

tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
tr.odd td:nth-child(3) {
    text-align: center;
}
tr.even td:nth-child(3) {
    text-align: center;
}
</style>





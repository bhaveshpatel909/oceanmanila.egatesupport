<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Bank List'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'bank_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Bank List')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Bank list')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="banklist/new_banklist" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="text-align:center;background:none;" width="51px"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Bank Name')?></th>
                                            <th><?= $this->lang->line('Account Number')?></th>
                                            <th style="text-align:left;"><?= $this->lang->line('Phone# & Contact')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$count = 1;
										foreach($banklist as $banklistt){
											
											?>
                                        <tr entity_id="<?= $banklistt['bank_id']?>">
                                            <td><?= $banklistt['bank_id']?></td>
                                            <td><?= $banklistt['bank_name']?></td>
                                            <td><?= $banklistt['bank_acount_no']?></td>
                                            <td><?= $banklistt['contact_no']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="banklist/edit_banklist/<?= $banklistt['bank_id']?>" data-target="#modal_window" data-toggle="modal">
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
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
tr.odd td:nth-child(5) {
    text-align: center;
}
tr.even td:nth-child(5) {
    text-align: center;
}

tr.odd td:nth-child(4) {
    text-align: center;
}
tr.even td:nth-child(4) {
    text-align: center;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}
</style>
<?php $this->load->view('layout/footer')?>
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Document Category'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
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
    <?php $this->load->view('layout/menu',array('active_menu'=>'document_category'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Document Category')?></h2>
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
                    <a href="settings/new_document_category" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="text-align:center;" width="51px"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Document Category Name')?></th>
                                            <th style="width:8%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($document_categorys as $document_category){?>
                                        <tr entity_id="<?= $document_category['document_category_id']?>">
                                            <td><?= $document_category['document_category_id']?></td>
                                            <td><?= $document_category['document_category_name']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="settings/edit_document_category/<?= $document_category['document_category_id']?>" data-target="#modal_window" data-toggle="modal">
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
    border-right: 1px #ddd solid !important;
	text-align:center;
}
tr.even td:nth-child(1) {
    border-right: 1px #ddd solid !important;
		text-align:center;

}

tr.odd td:nth-child(3) {
	text-align:center;
}
tr.even td:nth-child(3) {
		text-align:center;

}
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none;
}
table#DataTables_Table_0 thead tr th:nth-child(3) {
    background: none;
}
</style>
<?php $this->load->view('layout/footer')?>
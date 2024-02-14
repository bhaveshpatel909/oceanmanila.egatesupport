<?php $this->load->view('layout/header',array('title'=>$this->lang->line('BIR Form Registration'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>

    $('document').ready(function(){
        current_tablem = $('.data_table').dataTable();
	  $("#delete_bir_form").click(function (e) {
            oEmployeesTable.fnDraw();
        });
    })
</script>
<style>
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none !important;
}
tr.odd td:nth-child(1) {
    width: 15%;
}
tr.even td:nth-child(1) {
    width: 17% !important;
}
tr.odd td:nth-child(4) {
    text-align:center !important;
}
tr.even td:nth-child(4) {
    text-align:center !important;
}
</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'bir_formsb'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-9">
                <h2><?= $this->lang->line('201 File-Employee Benefit List ( SSS , Pag lbig , Philhealth , others )')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-1">
                <div class="title-action">
                    <a href="settings/new_bir_formb" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="width:12%"><?= $this->lang->line('Name')?></th>
                                            <th style="width:12%"><?= $this->lang->line('Due Date')?></th>
                                            <th style="width:25%"><?= $this->lang->line('Remarks')?></th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($bir_forms as $bir_form){	
										
									
										
										?>
                                        <tr entity_id="<?= $bir_form['form_id']?>">
                                            <td><?= $bir_form['form_name']?></td>
                                            <td><?= $bir_form['due_date']?></td>
                                            <td><?= $bir_form['remarks']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="settings/edit_bir_formb/<?= $bir_form['form_id']?>" data-target="#modal_window" data-toggle="modal">
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
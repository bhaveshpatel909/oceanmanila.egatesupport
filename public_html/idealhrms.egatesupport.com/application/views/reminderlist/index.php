<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Reminder List'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'reminder_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Reminder List')?><img title="-You may register additional category name for all the List of Reminder based on the specific issues or concerns" style="margin-left:5px;margin-right:5px;" src="images/if_Help.png" width="17px"><span style="font-size:13px; font-weight:600;" class="sml"> </span></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Reminder List')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="reminderlist/new_reminderlist" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th style="text-align:center;"width="6%"><?= $this->lang->line('ID')?></th>
                                            <th><?= $this->lang->line('Reminder Name')?></th>
                                             <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
										$count = 1;
										foreach($reminderlist as $reminderlistt){
											
											?>
                                        <tr entity_id="<?= $reminderlistt['reminder_id']?>">
										
                                            <td><?= $reminderlistt['reminder_id']?></td>
                                            <td><?= $reminderlistt['reminder_name']?></td>
                                           
                                            <td>
                                                <a class="btn btn-outline btn-success" href="reminderlist/edit_reminderlist/<?= $reminderlistt['reminder_id']?>" data-target="#modal_window" data-toggle="modal">
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
thead tr th:nth-child(1) {
    background: none;
}


</style>
<?php $this->load->view('layout/footer')?>
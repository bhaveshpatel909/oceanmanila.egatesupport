<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Letter'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'letters'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Outgoing Letter')?></h2>
                <ol style="display:none;"class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Letter')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="letter/new_letter" class="btn btn-primary">
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
                                        <th width="8%"><?= $this->lang->line('Date')?></th>
                                        <th width="18%"><?= $this->lang->line('To')?></th>
                                        <th width="22%"><?= $this->lang->line('Regarding')?></th>
                                        <th  style="text-align:left;"><?= $this->lang->line('Attention')?></th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($letters as $letter){?>
                                    <tr entity_id="<?= $letter['letter_id'] ?>">
                                        <td><?= date('Y-m-d',strtotime($letter['letter_date']))?></td>
                                        <td><?= $letter['letter_to']?></td>
                                        <td><?= $letter['regarding']?></td>
                                        <td><?= $letter['attention']?></td>
                                        <td>
                                            <a class="btn btn-outline btn-success btn-xs" href="letter/edit_letter/<?= $letter['letter_id']?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a target="_blank" title="preview" class="btn btn-outline btn-primary btn-xs" href="letter/preview_letter/<?= $letter['letter_id']?>">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                            <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete Letter ?') && submit_form('#delete_letter<?= $letter['letter_id']?>', '#save_result')" title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                
                                                <form action="letter/delete_letter" method="POST" id="delete_letter<?= $letter['letter_id']?>">
                                                    <input type="hidden" id="letter_id" name="letter_id" value="<?= $letter['letter_id']?>" class="letter_id<?= $letter['letter_id']?>">
                                                </form>
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
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tbody tr.odd td:nth-child(4) {
    text-align:left !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align:left !important;
}
</style>
<?php $this->load->view('layout/footer')?>
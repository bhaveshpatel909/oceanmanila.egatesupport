<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Processing errors'),'forms'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#delete_errors').click(function(){
            $("#save_result").html('<img src="images/ajax-loader.gif" />');
            $.ajax({
                url:'processing_errors/delete_errors',
                success:function(){
                    $('#save_result').html('');
                    $('#errors_list tbody tr').remove();
                }
            })
        })
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'processing_errors'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Processing errors')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <a><?= $this->lang->line('Settings')?></a>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <button type="button" class="btn btn-primary" id="delete_errors">
                        <i class="fa fa-times"></i>
                        <?= $this->lang->line('Delete errors')?>
                    </button>
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
                            <table class="table table-hover table-mail" id="errors_list">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('Type')?></th>
                                        <th><?= $this->lang->line('Error')?></th>
                                        <th><?= $this->lang->line('Date')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($errors as $error){?>
                                    <tr>
                                        <td><?= $this->lang->line(ucfirst($error['error_type']))?></td>
                                        <td><?= $error['error_text']?></td>
                                        <td class="text-right mail-date"><?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($error['error_date']))?></td>
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
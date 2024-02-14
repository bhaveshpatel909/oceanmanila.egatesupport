<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Contract Type'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'employee_memo'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Hiring Status List')?><img style="margin-left:5px; width:17px;" src="images/if_Help.png" title="-An Employment type list where you can add the status of the newly hired employee"></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Hiring Status List')?>
                    </li>
                </ol>
            </div>
          <div class="col-lg-4">
                <div class="title-action">
                    <a href="employees/add_employee_memoo/"  class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                        <th><?= $this->lang->line('ID')?></th>
                                       <!-- <th><?php//= $this->lang->line('Name')?></th>-->
                                        <th><?= $this->lang->line('Status')?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($employee_memo as $emp_memo){?>
									<?php if($emp_memo['status']!= ""){ ?>
                                    <tr entity_id="<?= $contract_type['id']?>">
                                        <td><?= $emp_memo['id']?></td>
                                      <!--  <td><?php//= $emp_memo['name']?></td> -->
										<td><?= $emp_memo['status']?></td>
                                        <td>
                                         <a class="btn btn-outline btn-success" data-target="#modal_window" data-toggle="modal" href="employees/edit_employee_memo/?page=<?= $emp_memo['id']?>"> 
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td> 
                                    </tr>
									<?php } ?>
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
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Assets Issuance Status'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'asset_issuance_status'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Asset Issuance Status')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Employee Name')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Assets Issuance Status')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="reports/print_asset_isuance_status"  class="btn btn-primary" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>
                        <?= $this->lang->line('Print')?>
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
                                        <th><?= $this->lang->line('Employee name.')?></th>
                                        <th><?= $this->lang->line('Employee No#')?></th>
                                        <th><?= $this->lang->line('Assets & Benefit Name')?></th>
                                        <th><?= $this->lang->line('File Attachment')?></th>
                                        <!--<th></th>-->
                                    </tr>
                                </thead>
                                <tbody>
								
                                    <?php
									
									
									if(!empty($assetnenefit))
									{
									//echo "ddd";
									foreach($assetnenefit as $key => $assetbenefit){
										$eid =$assetbenefit['employe'][0]['employee_id'];?>
                                    <tr entity_id="">
                                       <td><a href ="<?php echo base_url('employees/edit_employee/' . $eid)  ?>"><?php echo $assetbenefit['employe'][0]['fullname'];?></a></td>
                                        <td><?php echo $assetbenefit['employe'][0]['employee_id'];?></td>
                                        <td><?php echo $assetbenefit['assetbenefit_name'];?></td>
                                        <td>
										<?php foreach ($assetbenefit['attachments'] as $attachment) { ?>
										<?php if (strpos($attachment['mime'], 'image') === false) { ?>
											<div><a class='preview ' target="_blank" href="<?php echo base_url('files/attachments/' . $attachment['location'])  ?>" > <?= $attachment['file'] ?></a></div>
										<?php } else { ?>
											<div><a class='preview ' data-toggle='lightbox' href="<?php echo base_url('files/attachments/' . $attachment['location']) ?>" > <?= $attachment['file'] ?></a></div>
										<?php } ?>
									<?php } ?>
										</td>

                                    </tr>
									<?php 
									}
									}
									else
									{
										
									}
									?>
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
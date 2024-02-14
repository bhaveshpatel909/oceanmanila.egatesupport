<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <div class="clearfix"></div>
        <div><h1 class="title">Assets Issuance Status</h1></div>
    </div>
    <div class="pdf-content">
        <table border="0"  width="100%" align="center" style="border-color: #ccc;">
    <thead>
        <tr>
          <th><?= $this->lang->line('Employee name.')?></th>
                                        <th><?= $this->lang->line('Employee No#')?></th>
                                        <th><?= $this->lang->line('Assets & Benefit Name')?></th>
                                        <th><?= $this->lang->line('File Attachment')?></th>
        </tr>
    </thead>
    <tbody>
	<?php 
        if(!empty($assets_isuance_statu))
									{
									//echo "ddd";
									foreach($assets_isuance_statu as $key => $assetbenefit){
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
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Product List'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
		
		$('#pliststatus').change( function(e) {
			
   var ddddd = $(this).val();
   
   alert(ddddd);
	
  current_table.fnFilter( $(this).val() , 2); 	 
 });
		var s_url = '<?php echo base_url();?>';
		//$('td#active_cust'). click(function() { if($(this).is(':checked')) alert('checked'); else alert('unchecked'); });
		$('input[type=checkbox]').on('change',function(){
     var c_id = $(this).attr('data-cid');
    // var cat_idText = $("input[type=checkbox]:checked").val();
    
     if(jQuery(this).is(':checked')) {
       //alert('You have checked the checkbox'); 
				   $.ajax({
			  method: "POST",
			  url: s_url+'productlist/status_update',
			  data: { cid: c_id,status:1}
			})
			  .done(function( msg ) {
				alert( "Status Updated" );
			  });
     } else {
       //alert('You have unchecked the checkbox'); 
				 $.ajax({
			  method: "POST",
			  url: s_url+'productlist/status_update',
			  data: { cid: c_id,status:0}
			})
			  .done(function( msg ) {
				alert( "Status Updated" );
			  });
     }
}); 
    })
</script>
<style>
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: center !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tbody tr.odd td:nth-child(4) {
    text-align: center !important;
}
div#DataTables_Table_0_wrapper table#DataTables_Table_0 tr.even td:nth-child(4) {
    text-align: center !important;
}
tr.odd td:nth-child(9) {
    text-align: center !important;
}
tr.even td:nth-child(9) {
    text-align: center !important;
}
input#active_cust {
    font-size: !important;
    width: 21px;
    height: 33px;
}
tr.odd td:nth-child(3) {
    text-align: center;
}
tr.even td:nth-child(3) {
    text-align: center;
}

</style>
<div id="wrapper">
    <?php 

	$this->load->view('layout/menu',array('active_menu'=>'product_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('product List')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('product list')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="productlist/new_productlist" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
						Filter By status : <select name="pliststatus" id="pliststatus">
						<option value="1">Active</option>
						<option value="0">InActive</option>
						</select>
                                <table class="table table-striped table-bordered table-hover data_table" >
                                    <thead>
                                        <tr>
                                            <th width="6%"><?= $this->lang->line('ID')?></th>
											<th style ="display:none;"></th>
											<th></th>
											<th >Image</th>
                                            <th style="width:12%"><?= $this->lang->line('Product Name')?></th>
                                            <th style="width:8%;"><?= $this->lang->line('Sku No')?></th>
                                            <th style="width:18%;"><?= $this->lang->line('Remarks')?></th>
                                            <th style="width:9%;"><?= $this->lang->line('Date')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
										$count = 1;
										
										
										
										foreach($productlist as $banklistt){
											
											?>
                                        <tr entity_id="<?= $banklistt['product_id']?>">
                                            <td><?= $banklistt['product_id']?></td>
											<td style ="display:none;"><?php echo $banklistt['is_active'];?></td>
											 <td>
										<input type="checkbox" name="active_cust" id="active_cust" data-cid ="<?php echo $banklistt['product_id'];?>"<?php if($banklistt['is_active']=='1'){echo "checked=checked";}?>></td>
                                            <td><?php foreach ($banklistt['attachments'] as $attachment) {
// echo "<pre>";
// print_r($attachment);												?>
                  <a href="<?php echo base_url('files/attachments/ProductImages/' . $attachment['location']) ?>" class='preview ' data-toggle='lightbox'> <img height="100px" width="100px" src="<?php echo base_url('files/attachments/ProductImages/' . $attachment['location']) ?>"></a>
                       
                <?php } ?></td>
											<td><?= $banklistt['product_name']?></td>
                                            <td><?= $banklistt['sku']?></td>
                                            <td><?= $banklistt['remarks']?></td>
                                            <td><?= $banklistt['product_date']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="productlist/edit_productlist/<?= $banklistt['product_id']?>" data-target="#modal_window" data-toggle="modal">
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
<?php $this->load->view('layout/footer')?>
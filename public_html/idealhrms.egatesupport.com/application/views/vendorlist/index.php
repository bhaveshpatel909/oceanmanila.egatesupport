<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Vendor List'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable();
		var s_url = '<?php echo base_url();?>';
		//$('td#active_cust'). click(function() { if($(this).is(':checked')) alert('checked'); else alert('unchecked'); });
		$('input[type=checkbox]').on('change',function(){
     var c_id = $(this).attr('data-cid');
    // var cat_idText = $("input[type=checkbox]:checked").val();
    
     if(jQuery(this).is(':checked')) {
       //alert('You have checked the checkbox'); 
				   $.ajax({
			  method: "POST",
			  url: s_url+'vendorlist/status_update',
			  data: { cid: c_id,status:1}
			})
			  .done(function( msg ) {
				alert( "Status Updated" );
			  });
     } else {
       //alert('You have unchecked the checkbox'); 
				 $.ajax({
			  method: "POST",
			  url: s_url+'vendorlist/status_update',
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
table#DataTables_Table_0 thead tr th:nth-child(2) {
    display: none;
}
tr.odd td:nth-child(2) {
    display: none !important;
}
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none !important;
    width:44px !important;
}
tr.even td:nth-child(2) {
    display: none;
}
table#DataTables_Table_0 thead tr th:nth-child(1) {
    background: none !important;
    width: 44px !important;
    text-align: center;
}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
</style>
<div id="wrapper">
    <?php 

	$this->load->view('layout/menu',array('active_menu'=>'vendor_list'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Vendor List')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Vendor list')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="vendorlist/new_vendorlist" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
                                            <th width="6%"><?= $this->lang->line('ID')?></th>
											<th></th>
                                            <th><?= $this->lang->line('Vendor Name')?></th>
                                            <th style="width:10%;"><?= $this->lang->line('Contact Info')?></th>
                                            <th><?= $this->lang->line('Remarks')?></th>
                                            <th ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
										$count = 1;
										foreach($vendorlist as $banklistt){
											
											?>
                                        <tr entity_id="<?= $banklistt['vendor_id']?>">
                                            <td><?= $banklistt['vendor_id']?></td>
											 <td>
										<input type="checkbox" name="active_cust" id="active_cust" data-cid ="<?php echo $banklistt['vendor_id'];?>"<?php if($banklistt['is_active']=='1'){echo "checked=checked";}?>></td>
                                            <td><?= $banklistt['vendor_name']?></td>
                                            <td><?= $banklistt['contactinfo']?></td>
                                            <td><?= $banklistt['remarks']?></td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="vendorlist/edit_vendorlist/<?= $banklistt['vendor_id']?>" data-target="#modal_window" data-toggle="modal">
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
div#DataTables_Table_0_wrapper table#DataTables_Table_0 thead tr th:nth-child(4) {
    text-align: left !important;
}
</style>
<?php $this->load->view('layout/footer')?>
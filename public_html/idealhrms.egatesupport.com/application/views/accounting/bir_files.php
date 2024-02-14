<?php $this->load->view('layout/header',array('title'=>$this->lang->line('BIR File List1'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
<script>
function test(id)

{
	 if(this.checked){
		  alert('checked');
            $.ajax({
                type: "GET",
               url: 'accounting/updatebirfile/'+ id,
               //--> send id of checked checkbox on other page
                success: function(data) {
                    //alert('it worked');
                    //alert(data);
                    //$('#container').html(data);
					
                },
                 error: function() {
                    //alert('it broke');
                },
                complete: function() {
                   // alert('it completed');
                }
            });

            }
			 else{
			   $.ajax({
                type: "GET",
               url: 'accounting/updatebirfile/'+ id,
               //--> send id of checked checkbox on other page
                success: function(data) {
                    //alert('it worked');
                    //alert(data);
                    //$('#container').html(data);
					
                },
                 error: function() {
                    //alert('it broke');
                },
                complete: function() {
                   // alert('it completed');
                }
            });
		  }
}
    $('document').ready(function(){
        current_table = $('.data_table').dataTable({
        "order": [[ 0, "desc" ]]
    });
		

		
		//$('td#alertchk').click(function() {


	/* $( "#alertchk" ).on( "click", function() {
			alert("fgs00");
    var id =$(this).attr('data-id');  //-->this will alert id of checked checkbox.
       if(this.checked){
		  alert('checked');
            $.ajax({
                type: "GET",
               url: 'accounting/updatebirfile/'+ id,
               //--> send id of checked checkbox on other page
                success: function(data) {
                    //alert('it worked');
                    //alert(data);
                    //$('#container').html(data);
					
                },
                 error: function() {
                    //alert('it broke');
                },
                complete: function() {
                   // alert('it completed');
                }
            });

            }
			 else{
			   $.ajax({
                type: "GET",
               url: 'accounting/updatebirfile/'+ id,
               //--> send id of checked checkbox on other page
                success: function(data) {
                    //alert('it worked');
                    //alert(data);
                    //$('#container').html(data);
					
                },
                 error: function() {
                    //alert('it broke');
                },
                complete: function() {
                   // alert('it completed');
                }
            });
		  }
		}); */
    
	 
		
		
	(function($) {
		$("#table tbody").addClass("search");
		$('#filter').change(function() {
			var rex = new RegExp($(this).val(), 'i');
			// var $t = $(this).children(":eq(4))");
			$('.search tr ').hide();

			//Recusively filter the jquery object to get results.
			$('.search tr ').filter(function(i, v) {
			  //Get the 3rd column object here which is userNamecolumn
				var $t = $(this).children(":eq(" + "1" + ")");
				return rex.test($t.text());
			}).show();
		})

	}(jQuery));
		
    })
	

</script>
<style>
td.alrtchkk input:checked {
    position: absolute;
    background: red !important;
    z-index: 9999999999999;
    height: 25px;
    width: 25px;
}
td.alrtchkk input:after{
    position: absolute;
    background: red !important;
    height: 25px;
    width: 25px;content:"";z-index: -9;
}
.alrtchkk { text-align:center}
.ttt00{height: 25px; width:25px; background-color:red;display:inline-block; margin-top: 5px;}
.sustmclas th:nth-child(1) {    min-width: 76px !important;}

td.rfp-test a {
    border-radius: 4px;
    float: right;
    margin-left: 5px;
}

</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'bir_files'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-2">
                <h2><?= $this->lang->line('BIR File List12')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
                    </li>
                </ol>
            </div>
						<?php 
						// echo'<pre>';
						// print_r($bir_forems);
						// echo'</pre>';
						 ?>
			<div style="margin-top:14px;" class="col-lg-9">
			<span class="bir-22" style="color:red; font-size:21px;">The uploaded file will be automatically sent to an assigned email  address,<span><img style="margin-left:5px;"title="This email will be set by admin  If email does not displayed .Pls contact admin 
Accounting department email address will be recomended" src="images/if_Help.png" width="17px" ></span><span style="color:#1ab394; font-weight:bold;font-size: 17px;margin-left: 10px;"><?php echo $to_email;?></span> <br>So BIR report files will never be LOST.
</span>
			</div>
            <div style="float: right;"class="col-lg-1">
                <div class="title-action">
                    <a href="accounting/new_bir_file" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add')?>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
		<style>
	.three-but
	{
		       border: 1px solid #afadad;
    display: inline-block;
    width: 38px;
    padding: 3px 0px;
	}	
	.three-but img
	{
		    width: 15px;
	}	

    #attachments_list {
    overflow: hidden !important;
}
select#filter\ newfliter-1 {
    height: 36px !important;
    border: 1px #e5e6e7 solid;
    border-radius: 3px;
}
tr.eachro.even td:nth-child(6) {
    text-align: left;
}
tr.eachro.odd td:nth-child(6) {
    text-align: left;
}
tr.eachro.odd td:nth-child(7) {
    text-align: left;
}
tr.eachro.even td:nth-child(7) {
    text-align: left;
}
table#table {
    border-top: 1px #ddd solid !important;
}
table#table thead tr th:nth-child(7) {
    text-align: left !IMPORTANT;
}
		</style>
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
						<div style="margin-left: 195px;position: absolute;">
						<label> Filter By</label>
						<select id="filter newfliter-1" style="z-index:999999; position: relative;width:580px;height: 30px;">
							<option value="">select</option>
						<?php foreach($bir_forems as $bir_foerm){
						$string1 = substr($bir_foerm['due_date'],0,30).'...';
						$string2 = substr($bir_foerm['remarks'],0,60).'...';

						?>
							<option value="<?= $bir_foerm['form_name']; ?>"><?php echo $bir_foerm['form_name']."&nbsp;&nbsp;&nbsp;&nbsp; - ".$string1."&nbsp;&nbsp;&nbsp;&nbsp; - ".$string2; ?></option>
						<?php } ?>
						</select>
						</div>
                            <div id="save_result"></div>
                                <table class="sustmclas table table-striped table-bordered table-hover data_table" id="table">
                                    <thead>
                                        <tr>
                                            <th  style="text-align:center;"><?= $this->lang->line('Due Date')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Form Name')?></th>
                                            <th  ><?= $this->lang->line('Form File')?></th>
                                            <th title="Amount to pay" style="text-align:center;"><?= $this->lang->line('Amount')?></th>
                                            <th  ><?= $this->lang->line('Payment Proof')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Reference No')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Remark')?></th>
                                            <th style="text-align:center;"><?= $this->lang->line('Alert')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <?php foreach($bir_files as $bir_file){?>
                                        <tr entity_id="<?= $bir_file['bir_file_id']?>" class="eachro">
                                            <td><?= $bir_file['for_themonth']?></td>
                                            <td class="col2"><?= $bir_file['form_name']?></td>
										<?php 
											$bir_file_id = $bir_file['bir_file_id'];
											$type = 'bir_file';
											$this->load->model('accounting_actions');
											$bir_attach = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
											$bir_attach1 = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
										?>	
                                            <td style="text-align:left;"><a href="<?php echo  $this->config->item('base_url')?>/files/attachments/BIRFileList/<?= $bir_attach['location']?>" "download="<?php echo base_url('files/attachments/BIRFileList' . $bir_attach['location']) ?>" target="_blank"><?php echo $bir_attach['file'] ?></a></td>
											<?php 
											$amount = number_format($bir_file['amount']);
											?>
                                            <td style="text-align:center;"><?= $amount?></td>
											
										<?php 
											$bir_file_id = $bir_file['bir_file_id'];
											$type = 'bir_file2';
									       $this->load->model('accounting_actions');
											$bir_attach = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
											$bir_attach2 = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
										?>	
					                  
                                            <td style="text-align:left;"><a href="<?php echo  $this->config->item('base_url')?>files/attachments/BIRFileList/<?= $bir_attach['location']?>" "download="<?php echo base_url('files/attachments/BIRFileList' . $bir_attach['file']) ?>" target="_blank"><?php echo $bir_attach['file'] ?></a></td>
                                            <td><?= $bir_file['reference']?></td>
                                            <td><?= $bir_file['remarks']?></td>
											<td class="alrtchkk">
											<?php 
											if($bir_file['alertchk']==1)
											{
												?>
												<span class="ttt00" ></span>
												<?php 
												};
												?>
												
												</td>
                                            <td class="rfp-test">
											<?php if($bir_attach2['location']!="")
												{ ?>
												<a
												 title="
If your service provider had uploaded file,then click 
to print Payment Request Form for service retainer." class="three-but" href="accounting/getpfile_data/?birfile_id='<?php echo  $bir_file['bir_file_id']?>&form_name=<?php echo $bir_file['form_name'];?>&date=<?php echo $bir_file['for_themonth'];?>&loc2=<?php echo $bir_attach2['file'];?>" 
												data-target="#modal_window" data-toggle="modal">
                                                    <b style="color:red;">PRF</b>
                                                </a>
												<?php 
												}
												?>
											<a title="Resend BIR files to assigned email
( <?php echo $to_email;?> )" class="onhover three-but" href="accounting/mail_birfiles?frmname=<?php echo $bir_file['form_name'];?>&date=<?php echo $bir_file['for_themonth'];?>&loc1=<?php echo $bir_attach1['location'];?>&loc2=<?php echo $bir_attach2['location'];?>&filename1=<?php echo $bir_attach1['file'];?>&filename2=<?php echo $bir_attach2['file'];?>">													
											<img src="<?php echo  $this->config->item('base_url')?>/images/email-icon.png"></a>
                                                <a class="three-but" href="accounting/edit_bir_file/<?= $bir_file['bir_file_id']?>" data-target="#modal_window" data-toggle="modal">
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
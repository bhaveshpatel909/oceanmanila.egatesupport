<?php $this->load->view('layout/header',array('title'=>$this->lang->line('BIR file ( Modory )'),'forms'=>TRUE,'tables'=>TRUE,'icheck'=>TRUE)) ?>
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
        "order": [[ 0, "desc" ]],
		"pageLength": 100
    });
		
var oTable;
      oTable = $('.data_table').dataTable();
			 $('#filter').change( function() { 
			
            oTable.fnFilter(  $(this).val() , 1); 
					
       });
	   
	   var oTable;
      oTable = $('.data_table').dataTable();
			 $('#filter_year').change( function() { 
			
            oTable.fnFilter(  $(this).val() , 0); 
					
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
    
	 
		
		
	//(function($) {
	//	$("#table tbody").addClass("search");
	//	$('#filter').change(function() {
		/* 	var rex = new RegExp($(this).val(), 'i');
			// var $t = $(this).children(":eq(4))");
			$('.search tr ').hide();

			//Recusively filter the jquery object to get results.
			$('.search tr ').filter(function(i, v) {
			  //Get the 3rd column object here which is userNamecolumn
				var $t = $(this).children(":eq(" + "1" + ")");
				return rex.test($t.text());
			}).show(); */
			//var ddd =$('#filter_year').val();
		//current_table.fnFilter( $(this).val() );
			//current_table.fnFilter( ddd,0 );
			//var rows = $(".data_table").dataTable()._('tr', {"filter":"applied"});
			//alert(rows.length);
			//$("#listcnt").html(rows.length);
		//})
		
		//$('#filter_year').change(function() {
		//	var dd =$('#filter').val();
			//alert(dd);
			//current_table.fnFilter( $(this).val() );
			//current_table.fnFilter(dd,1)
			//var rows = $(".data_table").dataTable()._('tr', {"filter":"applied"});
			//alert(rows.length);
			//$("#listcnt").html(rows.length);
			/* var rex = new RegExp($(this).val(), 'i');
			// var $t = $(this).children(":eq(4))");
			$('.search tr ').hide();

			//Recusively filter the jquery object to get results.
			$('.search tr ').filter(function(i, v) {
			  //Get the 3rd column object here which is userNamecolumn
				var $t = $(this).children(":eq(" + "0" + ")");
				return rex.test($t.text());
			}).show(); */
		//})

	//}(jQuery));
	
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
.ttt01{height: 25px; width:25px; background-color:orange;display:inline-block; margin-top: 5px;}

</style>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'bir_modory_filesE'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Employee Benefit ( Modory )')?></h2>
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
			
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="accounting/new_bir_modory_filee" class="btn btn-primary" data-target="#modal_window" data-toggle="modal">
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
						
						<div style="margin-left: 195px;position: absolute;">
						<span class="listcnt" style="color:red;" id="listcnt"></span>
						<label> Filter By</label>
						<select id="filter" style="z-index:999999; position: relative;width:580px;height: 30px;">
							<option value="">select</option>
						<?php foreach($bir_forems as $bir_foerm){
						$string1 = substr($bir_foerm['due_date'],0,30).'...';
						$string2 = substr($bir_foerm['remarks'],0,60).'...';

						?>
							<option value="<?= $bir_foerm['form_name']; ?>"><?php echo $bir_foerm['form_name']."&nbsp;&nbsp;&nbsp;&nbsp; - ".$string1."&nbsp;&nbsp;&nbsp;&nbsp; - ".$string2; ?></option>
						<?php } ?>
						</select>
						<label style="margin-left:12px;"> Filter By Year</label>
						<select id="filter_year" style="z-index:999999; position: relative;width:116px;height: 30px;">
							<option value="">select</option>
						<?php for($i=2010;$i<=2030;$i++){
						
						?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php } ?>
						</select>
						</div>
                            <div id="save_result"></div>
                                <table class="table table-striped table-bordered table-hover data_table" id="table">
                                    <thead>
                                        <tr>
                                            <th  style="text-align:center;"><?= $this->lang->line('Due Date')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Form Name')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Form File')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Paid Amount')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Payment File')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Reference No')?></th>
                                            <th  style="text-align:center;"><?= $this->lang->line('Remark')?></th>
                                            <th style="text-align:center;"><?= $this->lang->line('Alert')?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <?php foreach($bir_files as $bir_file){?>
                                        <tr entity_id="<?= $bir_file['bir_m_file_id']?>" class="eachro">
                                            <td><?= $bir_file['for_themonth']?></td>
                                            <td class="col2"><?= $bir_file['form_name']?></td>
										<?php
										
										
											$bir_file_id = $bir_file['bir_m_file_id'];
											$type = 'bir_modory_file';
											$this->load->model('accounting_actions');
											$bir_attach = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
										?>	
                                            <td><a href="<?php echo base_url(); ?>files/attachments/<?= $bir_attach['file']?>" target="_blank"><?php echo $bir_attach['file'] ?></a></td>
											<?php 
											$amount = number_format($bir_file['amount']);
											?>
                                            <td style="text-align:right;"><?= $amount?></td>
											
										<?php 
											$bir_file_id = $bir_file['bir_m_file_id'];
											$type = 'bir_modory_file2';
											//$this->load->model('accounting_actions');
											$bir_attach = $this->accounting_actions->get_bir_file_attach($bir_file_id, $type);
										?>	
					
                                            <td><a href="<?php echo base_url(); ?>files/attachments/<?= $bir_attach['file']?>" target="_blank"><?php echo $bir_attach['file'] ?></a></td>
                                            <td><?= $bir_file['reference']?></td>
                                            <td><?= $bir_file['remarks']?></td>
											<?php 
											// echo'<pre>';
											// print_r($bir_file['form_id']);
											// echo'</pre>';
											?>
											<td class="xyz">
											
												<input type="checkbox" style="width: 109px; height: 21px;" <? if($bir_file['alertchk']== 1){ ?> checked <?php } ?> name="alertchk" id="mySelectorr"  value="<? echo 'check='. $bir_file['alertchk'];echo '&formid='.$bir_file['bir_m_file_id'];
											
											
											?>"  >
											<b style='color: #ffffff30;'><?php echo $bir_file['alertchk'];  ?></b>
											
											</td>
                                            <td>
                                                <a class="btn btn-outline btn-success" href="accounting/edit_bir_modory_file/<?= $bir_file['bir_m_file_id']?>" data-target="#modal_window" data-toggle="modal">
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
<?php  

// echo '<pre>';
// print_r($bir_files);
// echo '</pre>';
// die('vfv');
?>
<script>
$('document').ready(function () {
	 
$('td #mySelectorr').click( function(e) { 
		var letter = $(this).val();
		var val = $(this).find('input').val();
 // alert(letter);
   // var iddd = $("#mySelectorr1").html(data);
   
		 $.ajax({
        type: "GET",
        url: 'accounting/updatealertmodory/?',
        data:letter,
        success: function(data) {
			 
            //$('#mySelectorr').html(data);

			alert('Your value updated Successfully');
			 location.reload();
			//alert(iddd);
        }
    })

	
	});
	
	///$('.ttt01').click( function(e) { 
	//	var letter = $(this).val();
		//var vall = $(this).find('input').val();
  //alert(val);
   // var iddd = $("#mySelectorr1").html(data);
   
		// $.ajax({
//type: "GET",
      //  url: 'accounting/updatealert/?',
//data:vall,
        //success: function(data) {
			 
            //$('#mySelectorr').html(data);

			//alert('Your value updated Successfully');
			// location.reload();
			//alert(iddd);
      //  }
    //})

	
	//});
	
	
	
	// $(".gbp").click(function(){

	// $('#fall').removeClass('current');
	 // $('.gbp').addClass('current');
	  
 // });
	});
	
	



</script>

<?php $this->load->view('layout/footer')?>

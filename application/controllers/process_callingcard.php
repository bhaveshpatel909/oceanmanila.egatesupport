<?php $this->load->view('layout/header',array('title'=> 'processcallingcard','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('employees').ready(function () {
		var s_url = '<?php echo base_url();?>';
        current_table = $('.data_table').dataTable({
			//"bRetrive": true,
			//"retrieve": true,
			//"aasearching": true,
			//"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
           // 'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards",
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = current_table.fnSettings();
                nRow.id = 'myidd'+aData[0];
				
                nRow.className = "product_lin";
				
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
						"columnDefs": [
    { className: "my_class", "targets": [ 2] ,visible:'false'}
  ],
		
		
		})
        $('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
		
	
			$('#hiring_status_id').change( function() {
      //alert($(this).val());
            //current_table.fnFilter( $(this).val(), 7); 
			 var hs_id =$(this).val();
           // current_table.fnFilter( $(this).val(), 26); 
			$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?hs_id="+hs_id,
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
							cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
       });		
	   $('#department_id').change( function() {
     // alert($(this).val());
	  var d_id =$(this).val();
           // current_table.fnFilter( $(this).val(), 26); 
			$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?d_id="+d_id,
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
       });
	   /**********search **********/
	   $(document).on('keyup', "input[type=search]",function () {
	  // $("input[type=search]").keyup(function () {
      var s_id =$(this).val();
      var d_id =$('#department_id').val();
      var g_id =$('#group_id').val();
      var hs_id =$('#hiring_status_id').val();
	 // alert(s_id);
	  $("input[type=search]").val(s_id);
           // current_table.fnFilter( $(this).val(), 26); 
			$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?s_id="+s_id+'&d_id='+d_id+'&g_id='+g_id+'&hs_id='+hs_id,
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
		$("input[type=search]").val(s_id);
});
	   /*********search code enda here*************/
	   $('#group_id').change( function() {
			//alert($(this).val());
            //current_table.fnFilter( $(this).val(), 27); 
			 var g_id =$(this).val();
           // current_table.fnFilter( $(this).val(), 26); 
			$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?g_id="+g_id,
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
       });	
		
	/************active checkbox code start here*************************/
	 $(document).on('click', "#check_active_inactive",function () {
		 //alert("dfvfd");
	// $(document).on("#check_active_inactive").click(function() { 
	var isChecked = $("#check_active_inactive").is(":checked");
                    if (isChecked) { 
                       // alert("Check box in Checked"); 
						$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards",
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
                    } else { 
                        //alert("Check box is Unchecked"); 
						$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?is_active=0",
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							var days =0;
							var burl ="<?php echo base_url();?>";
							$.ajax({
							type: 'post',
							cache: false,
							url: burl+'request/emp_cont_reminer/',
						   data : 'eid='+ row[0],
							success: function (response) {
								//console.log(response);
								$("#emp_r_d_"+row[0]).html(response);
							}
						  });
						  $( "#emp_r_d_"+row[0] ).hover(function() {
							 // alert("hiver");
							 $('.hov_rem_con').hide();
							  $("#hov_rem_text_"+row[0] ).show();
							  
						  })
							return '<span id ="emp_r_d_'+row[0]+'"></span><p  id="hov_rem_text_'+row[0]+'"  class ="hov_rem_con" style="display:none">Contract Remaining Days</p>';
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="'+s_url+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="'+s_url+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		})
                    } 
                }); 
	
	/************** active checkbox ends here****************************/
	   

    });
    
</script>
<script>
    $('employees').ready(function(){
        $('#documents_list').infinitescroll({
            navSelector      : "#next:last",
            nextSelector     : "a#next:last",
            itemSelector     : "div.document_area",
            dataType         : 'html',
            loading:{
                msgText          : '<?= $this->lang->line('Processing')?>',
                finishedMsg      : '',    
            },
            maxPage          : <?= $documents['amount']?>,
            path: function(index) {return 'documents/index/'+index+'?search=<?= ($search?$search:'')?>'}
        });
		
	
    });
    
</script>
<script>
function checkbox(x) {
    return '<div class="text-center"><input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="'+x+'" /><span class="lbl"></span></div>';
}
$(document).ready(function(){
		$('#emaill').click(function () {
			
           var valuess = new Array();
		   var x="";
		  
            $.each($("input[name='checkHead[]']:checked"), function () {
              x=valuess.push($(this).val());
			  
			  
            });
			if(x=="")
			{
				 alert('Please Select  Checkbox First Then Click Here');
			}
			else
			{
					
			    location.href="employees/callaing_card_mail?q="+valuess;
		    }
		
	
});

$('#image_up').click(function () {
			
           var empl_id = new Array();
		   var x="";
            $.each($("input[name='checkHead[]']:checked"), function () {
              x=empl_id.push($(this).val());
			 	  
            });
			
		if(x=="")
		{
			    alert('Please Select  Checkbox First Then Click Here');
	            
		}
		else
		{
			   location.href="employees/image_path_copy?empi="+empl_id;
			
		}
});
});

</script>
<style>
	.three-but
	{
     border: 1px solid #afadad;
     display: inline-block;
     width: 29px;
     padding: 3px 0px;
	}	
	.three-but img
	{
		   height: 32px;
           border:0px !important;
	}	
</style>

<script>
$(document).ready(function(){

 $('.new_view').click(function () {
         var checkval = '1';
		 
		// var g_id =$(this).val();
           // current_table.fnFilter( $(this).val(), 26); 
			$(".data_table").dataTable().fnDestroy();
			current_table = $('.data_table').dataTable({
			"bRetrive": true,
			"retrieve": true,
			"aasearching": false,
			"bFilter": true,
			//"deferRender": true,
			"iDisplayLength": 50,
            'bProcessing': true, 'bServerSide': true,
             "sAjaxSource":"<?php echo base_url(); ?>request/p_calling_cards?checkval="+checkval,
			 
		 'fnServerData': function (sSource, aoData, fnCallback) {
			 
			 
			
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
			'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                
            },
			"aoColumns": [
			
               {"bSortable": false, "mRender": checkbox},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							return row[0];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							// row.className = "reminder_lin";
							var From_date = new Date(row[30]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							//var newStr = days.replace(/-/g, "");
							//var newstring = days.replace('-', 'GfG'); 
							return   days;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							var eid = row[0];
							var cl3_data='<a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/'+eid+'"  data-toggle="modal" data-target="#modal_window"> <i class="fa fa-edit"></i></a><a id="delete_document'+eid+'" href="employees/set_password/'+eid+'" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>';
							if(row[17])
							{
								cl3_data +='<img class="three-but" style="border:0px;" title="Reset confrim date" onclick="date_dele('+eid+')" src="'+s_url+'files/logo/resetsearch.png">';
							}
							return cl3_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							//alert(row[21])
							if(row[21]==1)
							{
								var chk ="checked";
							}
							else
							{
								var chk ="unchecked";
							}
							
							var cl4_data='<label> <input type="checkbox" class="i-checks checkpin"   name="checkpin[]" value="'+row[0]+'" '+chk+'/>  <span class="lbl"></span> </label>';
							return  cl4_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{	if(row[17]!=null)
							{
								var cl5_data = row[17];
								cl5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							}
							else
								{
									var cl5_data = '';
								}
								
							return  cl5_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
								var cl6_data = row[5];
								//cll5_data += '<p class=""   value="'+row[0]+'"  ></p>';
							return  cl6_data;
						}},{"bSortable": false, "mRender":  function ( data, type, row )
						{
							
							var From_date = new Date(row[14]);
							var To_date = new Date();
							var diff_date =  To_date - From_date;
							 
							var years = Math.floor(diff_date/31536000000);
							var months = Math.floor((diff_date % 31536000000)/2628000000);
							var days = Math.floor(((diff_date % 31536000000) % 2628000000)/86400000);
							if(row[14]== "0000-00-00")
							{
							var cl7_data ='';	
							}
							else
							{
							var cl7_data =row[14]+' <span style="color:red;font-weight:bolder;">&nbsp;&nbsp;('+months+')</span>';
							}
							return cl7_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[27];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[28];
						}},
						{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[4];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<a href="employees/edit_employee/'+row[0]+'">'+row[1] + '</a>';
						}},{"bSortable": true, "sClass": "onhover222222", "mRender":  function ( data, type, row )
						{
							var  cl12_data ='<img class="avatar img-rounded " src="http://wshrms1.peza.com.ph/'+row[2]+'" style="width: 40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"><input type="hidden" value="'+row[0]+'" name="emp_id"><div class="confirmwrap23456">Copy Picture Image?  <div class="confirmation-buttons text-center"><div class="btn-group">  <span class=" btn btn-xs btn-primary"  onClick="copyavatar_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							
							return cl12_data;
						}},{"bSortable": true,"sClass":"onhover222222 onhover22222234", "mRender":  function ( data, type, row )
						{
							if(row[3]!=null)
							{
								var cl13_data='<img class="avatar img-rounded" src="http://wshrms1.peza.com.ph/'+row[3]+'" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal"> <input type="hidden" value="'+row[0]+'" name="emp_idd"> <img id="sign_img" onClick="copysign_img('+row[0]+')"  style=" vertical-align: top; width:18px;    margin-right:0px;    margin-left: 3px;    margin-top:12px;    cursor: pointer; "> <div class="confirmwrap23456">Copy Signature Image?<div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary"   onClick="copysign_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span> <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl13_data='';
							}
							return cl13_data;
							
						}},{"bSortable": true,"sClass":"onhover222222 onhover222223456", "mRender":  function ( data, type, row )
						{
							if(row[8]!=null)
							{
								var arr = row[8].split('/');
							var cl14_data = arr[arr.length-1]+'<div class="confirmwrap23456 confirmwrap23456789">Delete ID Picture Image? <div class="confirmation-buttons text-center"><div class="btn-group"><span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span> </div></div></div>';
							}
							else
							{
								var cl14_data = '';
							}
							return cl14_data;
						}},{"bSortable": true, "sClass":"onhover222222 onhover465453","mRender":  function ( data, type, row )
						{
							if(row[9]!=null)
							{
								var arr = row[9].split('/');
							var cl15_data = arr[arr.length-1]+' <div class="confirmwrap23456 confirmwrap242423424"> Delete Signature Image? <div class="confirmation-buttons text-center"><div class="btn-group"> <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('+row[0]+')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span><span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span></div></div></div> ';
							}
							else
							{
								var cl15_data = '';
							}
							return cl15_data;
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[10];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[7];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[11];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[24];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[6];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[13];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[20];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[16];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[15];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return row[18];
						}},{"bSortable": true, "mRender":  function ( data, type, row )
						{
							return '<span class="address_infos"><span class="span11">'+row[19]+'</span></span>';
						}}],
		
		
		}) 
		  
	 });  
	 
	
		 
	 $('.reset_con').click(function () {
         var checkval = 'delete';
		  location.href="employees/delete_datepp?reset_id="+checkval; 
		 });
		 
		  $('.image_all').click(function () {
         var checkval = 'all';
		 location.href="employees/getallid?allvalue="+checkval; 
		 }); 
	$('#download_images').click(function () {
         var checkval = 'save_image';
		 location.href="employees/save_image_desktop?allvalue="+checkval; 
		 }); 	 

		 $('.signature_all').click(function () {
         var checkval = 'all';
		 location.href="employees/signature_all?allvalue="+checkval; 
		 }); 
		
	  $('.delete_file_from_folder').click(function () {
         var checkval = 'Deletefiles';
		// alert(checkval);
		    // $.ajax({
			   
			  
        // type: 'POST',
        // url: 'employees/delete_file_from_folder?allvalue='+checkval,
        
        // success: function(response) {
           
        // }
    // });
		location.href="employees/delete_file_from_folder?allvalue="+checkval; 
		 });
	  
	  $('.delete_sigfile_from_folder').click(function () {
         var checkval = 'Deletefiles';
		 //alert(checkval);
		 location.href="employees/delete_sigfile_from_folder?allvalue="+checkval; 
		 });
	 
	  });
</script>

<script>
$(document).ready(function(){
  $('#data_table').on('ifChecked', '.checkpin', function (event) {
	 
         var id=($(this).val());
		  
		   $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/unpin?id='+id,
        
        success: function(response) {
           
        }
    }); }); 

$("#rem-day-filter").keyup(function() { 
              // alert("hiiii");
			   var selval =$(this).val();
			  // alert(selval);
			   
			   current_table.fnFilter( selval, 2); 
            }); 
				});
</script>
<script>
$(document).ready(function(){
  $('#data_table').on('ifUnchecked', '.checkpin', function (event) {
	 
         var id=($(this).val());
		  
		   $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/pinemp?id='+id,
        
        success: function(response) {
           
        }
    }); });  
	});
</script>
<style>
.new_bt {float: left; }
.decd {float: left;  width: auto;  margin-top: 74px; border: 1px solid #bbb;padding: 10px 6px 8px 15px;
    border-radius: 4px;}
.decd div {
    float: left;
}
button#download_images {
    margin-left: 10px;
    margin-top: 14px;
}
.image_up.image_up222 .form-group { margin-bottom: 0px;margin-left: 15px;}
.image_up.image_up222 {  float: left;  margin-top: 15px;}
.alignment22 button, .alignment22 a { font-weight: normal !important;   border: none;}
.image_up.image_up222 form { float: left;}
.btnorng button {
    box-shadow: none !important;
    border: none;
}
.new_bt input {
    display: inline-block;
}
.btnorng div {
    float: left;    margin-right: 7px;
}
.image_up.imgup22 {
    margin-top: 2px;
}
 .address_infos:hover .span22 {
    display: block;
}
.address_infos {
    position: relative;
}
.span22 {
    display: none;
    position: absolute;
    background: #fff;
    top: 0px;
    width: 238px;
    left: 0px;
    white-space: normal;
    float: left;
    padding: 9px 6px;
    box-shadow: 2px 2px 3px #f5f5f5;
    border-radius: 5px;
    border: 1px solid #e4e2e2;
}
span.span11 {
    height: 17px;
    overflow: hidden;
    float: left;
    padding-right: 10px;
}

div.dataTables_paginate{ float:left;}
.select_333 { position: relative; float: right; width: 89%;  margin-right: 66%;}
div#data_table_wrapper .row:first-child .col-md-6:first-child { width: 25%;}
div#data_table_wrapper .row:first-child .col-sm-6 {width: 19%;}
div#data_table_wrapper .row:last-child .col-sm-6:nth-child(1) {
    width: auto;
    float: none;
    display: inline-block;
}
div#data_table_wrapper .row:last-child .col-sm-6:nth-child(2) {
  float:left; width: auto; 
}
div#data_table_wrapper .row:last-child{ width:auto;}
table#data_table td:nth-child(18) {  min-width: 104px;}
.delete_date {
    display: inline-block;
    vertical-align: middle;
}
table#data_table tr td:nth-child(5) {
    min-width: 120px;
}
			td {
			width:9%!important;
			}
			.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;
}


#xls2 {
  
   
    color: #000;
    font-weight: bolder;
    
	font-size: 15px;
}
#emaill {

    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 8px;
   font-size:15px;
    padding: 8px 13px;
    border-radius: 3px;
}
.view_sece
{
	float:left;
}
#reset_con {
  
    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 8px;
    margin-left:14px;
    padding: 8px 13px;
   border-radius: 3px;
	display:inline-block;
	border:0px;
	text-align:center;
	font-size:15px;
}
#new_view11 {
  
    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 8px;
    margin-left:14px;
    padding: 8px 13px;
   border-radius: 3px;
	display:inline-block;
	border:0px;
	text-align:center;
	font-size:15px;
}
 #image_up {
  
    background: #F9812A;
    font-size: medium;
    color: white;
    font-weight: bolder;
    margin-top: 8px;
    margin-left:14px;
    padding: 8px 13px;
   border-radius: 3px;
	display:inline-block;
	border:0px;
	text-align:center;
	font-size:15px;
}

.email_sec {
    width:auto;
	float:left;
}
.view_sec{
    width:auto;float:left;
}

.on_hover_text {     position: absolute;
    background: #fff;
    padding: 10px;
    box-shadow: 2px 2px 4px #999;
    display: none;
    z-index: 9999;
       left: 108px;color:#333;
    min-width: 304px;
    top: 0px;
    border-radius: 7px;}
.on_hover_con:hover > .on_hover_text {  display: block;}
.on_hover_con { position: relative;
    cursor: pointer;
    color: #428bca;
    width: 86%;
    display: inline-block;
    vertical-align: top;}
	
.dataTables_wrapper table
{
	background:#fff;
}	
.dataTables_wrapper table th
{
	text-align:center;
}
.dataTables_wrapper table td
{
	vertical-align: middle !important;
}
.dataTables_wrapper table td:nth-child(1) 
{   min-width: 40px !important;
max-width:40px !important; 
}

.dataTables_wrapper table th:nth-child(1) 
{   min-width: 40px !important;
max-width:40px !important; 
}
.dataTables_wrapper table td:nth-child(2) 
{   min-width: 50px !important;
max-width:50px !important; 
}

.dataTables_wrapper table th:nth-child(2) 
{   min-width: 50px !important;
max-width:50px !important; 
}
.dataTables_wrapper table td:nth-child(3) 
{   min-width: 70px !important;
max-width:70px !important;
display:none!important; 
}

.dataTables_wrapper table th:nth-child(3) 
{   min-width: 70px !important;
max-width:70px !important; 
display:none!important; 
}
.dataTables_wrapper table td:nth-child(4) 
{   min-width: 36px !important;
/* max-width:90px !important; */

}

.dataTables_wrapper table th:nth-child(4) {min-width: 59px;}
.dataTables_wrapper table td:nth-child(6) 
{   min-width: 247px !important;}

.dataTables_wrapper table th:nth-child(6) 
{    min-width: 247px !important;}

.dataTables_wrapper table td:nth-child(7) 
{   min-width: 72px !important;
text-align:center;

}
.dataTables_wrapper table th:nth-child(6), .dataTables_wrapper table td:nth-child(6)
{    min-width:66px !important;}



.dataTables_wrapper table td:nth-child(7) img
{
	width:35px !important;
	height:35px !important;
	margin:0px !important;
}

.dataTables_wrapper table td:nth-child(8) img
{
	width:50px !important;
	height:50px !important;
	margin:0px !important;
}
.dataTables_wrapper table td:nth-child(13) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table td:nth-child(14) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table td:nth-child(14) {
    min-width:103px;
}
.dataTables_wrapper table th:nth-child(7) 
{    min-width: 179px !important;
}

.dataTables_wrapper table td:nth-child(8) 
{   min-width:88px !important;
}
.dataTables_wrapper table td:nth-child(12) input {
    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;
}
.dataTables_wrapper table th:nth-child(12) 
{    min-width: 50px !important;}

.dataTables_wrapper table td:nth-child(10) 
{   min-width: 150px !important;

}
.dataTables_wrapper table td:nth-child(10) input{    vertical-align: middle;
    margin-left: 5px;
    min-width: 25px;}

.dataTables_wrapper table th:nth-child(10) 
{    min-width: 150px !important;}


.dataTables_wrapper table td:nth-child(25) 
{   min-width: 186px !important;

}

.dataTables_wrapper table th:nth-child(25) 
{    min-width: 100px !important;}


.dataTables_wrapper table td:nth-child(12) 
{   min-width:68px !important; text-align:center;

}
.dataTables_wrapper table th:nth-child(11) {
    min-width: 200px;max-width: 250px
}
.dataTables_wrapper table td:nth-child(11) {
    min-width: 200px;max-width: 250px
}
.dataTables_wrapper table th:nth-child(17) {
    min-width: 82px;
}
.dataTables_wrapper table td:nth-child(13) 
{   min-width: 68px !important; text-align:center;

}
.dataTables_wrapper table th:nth-child(12) p {display: inline-block;}
.dataTables_wrapper table th:nth-child(13) p {display: inline-block;}
table#data_table td:nth-child(22) {
    min-width: 157px;
}
table#data_table th:nth-child(24) { min-width: 200px;}
.dataTables_wrapper table th:nth-child(11) 
{   /* min-width: 116px !important;*/
}
.dataTables_wrapper table th:nth-child(14) p {
    float: left;
}
.dataTables_wrapper table th:nth-child(13) p {
    float: left;
}
.dataTables_wrapper table td:nth-child(8) 
{   min-width: 156px !important;
max-width: 156px !important;
}

.dataTables_wrapper table th:nth-child(8) 
{    /* min-width: 200px !important;
max-width: 200px !important; */
}

.dataTables_wrapper table td:nth-child(13) 
{   min-width: 81px !important;  text-align:center;
max-width: 81px !important;

}
.dataTables_wrapper table td:nth-child(14) 
{    text-align:center;


}
.dataTables_wrapper table th:nth-child(13) 
{    min-width: 137px !important;
max-width: 137px !important;
}

.dataTables_wrapper table td:nth-child(15) 
{   min-width:116px !important;
max-width: 116px !important;

}

.dataTables_wrapper table th:nth-child(15) 
{    min-width: 80px !important;
max-width: 80px !important;
}
.dataTables_wrapper table td:nth-child(16) 
{   min-width: 105px !important;

}

.dataTables_wrapper table th:nth-child(16) 
{ /*   min-width: 160px !important;*/}

.dataTables_wrapper table td:nth-child(19) 
{   min-width: 200px !important;
max-width: 250px !important;

}

.dataTables_wrapper table th:nth-child(19) 
{   /* min-width: 200px !important;
max-width: 250px !important;*/
}
.dataTables_wrapper table td:nth-child(20) 
{   min-width: 120px !important;
max-width: 120px !important;

}

.dataTables_wrapper table th:nth-child(20) 
{    min-width: 120px !important;
max-width: 120px !important;
}
.dataTables_filter
{
	position: absolute;

left: -434px;
}
#wrapper {
    width: 100%;
    float: left;
    display: inline-flex;
}
.form-group {
    width: auto;
    display: inline-block;
}
.confirmwrap22 { display: none; border: 1px solid #dad2d2; padding: 13px; border-radius: 6px;
    position: absolute;  top: -78px;    width: 230px;    left: -68px;}
	.confirmwrap33 { display: none; border: 1px solid #dad2d2; padding: 13px; border-radius: 6px;
    position: absolute;  top: -78px;    width: 215px;left: -54px;}
.view_sece .nwdesgn { background: none !important; border:none;}
.view_sec .nwdesgn { background: none !important; border:none;}
@media only screen and (max-width: 767px) {
.on_hover_text {
padding: 10px 11px;
    display: none;
    z-index: 9999;
    left: auto;
    color: #333;
    min-width: 100%;
    top: 0px;
    border-radius: 7px;
    right: 100%;
    width: 167px;
    min-width: auto;
    margin-right: 7px;
}

.frame_wrap {  position: relative;    float: left;}
.new_bt input {
    display: inline-block;
}
.image_up.image_up222 { margin-top: 16px;}

div#data_table_wrapper table#data_table thead th {
    padding: 6px 15px 0 13px !important;
}

div#data_table_wrapper table#data_table {
    width: max-content !important;
}
div#data_table_wrapper table#data_table thead th.my_class{display:none!important;}

</style>

<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'processcallingcard'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
           <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-4 col-sm-5">
                <h2><?php echo "Process ID & CallingCard"?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Process ID & CallingCard";?>
                    </li>
                </ol>
				
				
			  <div class="row">	
			  <div class="col-lg-12 col-sm-12 alignment22">	
			  
			  
			  
			<div class="email_sec">
<button id="emaill" title="Send email to all employee for data confirmation">Email to all</button>
			</div>
				<div class="view_sece view_sece222">
			<a href="employees/outputCSV" id="new_view11" title="You Can Download Employee Data Files Here" value="checked"><i class="fa fa-download"> </i> Download </a>
			
		</div><div class="view_sece view_sece222">
			<a href="employees/outputCSVwithexp" id="new_view11" title="You Can Download Employee Data Files Here" value="checked"><i class="fa fa-download"> </i> Download with Expiry </a>
			
		</div>
			  	<div class="image_up image_up222">
			<form method="post" action="employees/multiple_file" enctype="multipart/form-data">
    <div class="form-group">
      
     <input type="submit" name="fileSubmit"  title="Click Here To Uploade Your Selected Images" value="ID Picture File"/>   
    </div>
    <div class="form-group">
	 <input type="file" name="files[]" multiple />
       
    </div>
</form>
	<form method="post" action="employees/multiple_sign_upload" enctype="multipart/form-data">
    <div class="form-group">
      
     <input type="submit" name="fileSubmit"  title="Click Here To Uploade Your Selected Signature Images" value="SIG Picture File"/>   
    </div>
    <div class="form-group">
	 <input type="file" name="files[]" multiple />
       
    </div>
</form>

			</div>
				</div>
				</div>
            </div>
		

			<div class="dataTables_info" id="data_table_info" role="alert" aria-live="polite" aria-relevant="all"></div>
			<div class="col-lg-3">
			<div class="row">			
		  	<div class="col-lg-12">		  
			
		  <div class="decd">
		  	<div class="new_bt">			
        <form action="<?php echo base_url();?>employees/uploadData" method="post" enctype="multipart/form-data"><input type="submit"  title="Import employee list for initial setup" name="submit" value="Import list" />
		<input type="file" name="uploadFile" id="xls2" value="" />
          </form>
		  </div>
		  	<div class="image_up imgup22">
<button class="image_all" title="Create image file name for picture & signature">Image File Name</button>
			</div>
			<!--<div class="image_up">
			<button id="image_up"><i class="fa fa-upload"></i>   Fill Up Image</button>
			</div>
		
			<div class="">
			<button id="download_images"><i class="fa fa-user "></i>All Image</button>
			</div>
			
			<div class="view_sec">
			<button class="nwdesgn new_view"  value="checked" title="You Can See All Pined Employee From Here">			
			
			<img  style=" vertical-align: top; width:25px;    margin-right:4px;    margin-left: 6px;    margin-top:13px;    float: left;" 
                                               src="http://wshrms.peza.com.ph/files/logo/pin.png">
			</button>
			
		</div>-->
		<!--<div class="image_up">
		<span class="frame_wrap">
			<p class="delete_file_from_folder" title="You Can Delete All Copy Images from  Here">
				<div class="confirmwrap33 cmnwrap" >
										  Delete All Profile image Files ? 
										  
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class="delete_file_from_folder btn btn-xs btn-primary" data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class="off_popup33 off_popupcmn  btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										  </div>
										  </span>
			<img  class="ontoclick33 rtfrtr" style="vertical-align: top;  width: 27px; cursor: pointer; margin-right: 0px;  margin-left: 2px; margin-top:12px;
    float: left;"    src="http://wshrms.peza.com.ph/files/logo/delete_png.png">
			</p>
			</div>
			<div class="image_up">
			<span class="frame_wrap">
			<p  title="You Can Delete All Copy Signature Images from  Here">
			<img  class="ontoclick22 rtfrtr" style="vertical-align: top;  width: 27px; cursor: pointer; margin-right: 6px;  margin-left: 8px; margin-top: 12px;
    float: left;"    src="http://wshrms.peza.com.ph/files/logo/delete_png.png">
			</p>
			<div class="confirmwrap22 cmnwrap" >
										  Delete All Signature Image Files ? 
										  
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class="delete_file_from_folder btn btn-xs btn-primary" data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class="off_popup22 off_popupcmn  btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										  </div></span>
			</div>-->
	
<a href="<?php echo base_url();?>request/processcallingcardnew" 
id=""title="Go Back"><img style="vertical-align: top; width: 27px; margin-left: 8px; margin-right:7px;
  " 
  src="<?php echo base_url();?>files/logo/resetsearch.png"></a>
  <!--div class="view_sece">
			<button style="margin-top:7px;" class="nwdesgn reset_con"  title="You Can Reset All Employee Confirmed Date From Here">	<img  style="     vertical-align: top;    width: 25px;
    margin-right: 4px;    margin-left: -2px;    margin-top: 5px;    float: left;" 
                                               src="http://wshrms.peza.com.ph/files/logo/delete_date.png"></button>
		
			
		</div-->
			</div>
			</div>
			</div>
		  
		  <div class="row">
		  	<div class="col-lg-12 col-sm-12 btnorng">
		
		
		</div>
			</div>
			</div>
		
            <div class="col-lg-1">
                <div class="title-action">
                    <a href="request/new_request" class="btn btn-primary" data-toggle="modal" data-target="#modal_window">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('New')?>
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
	
                            <table  id="data_table" class="tblecus table table-striped table-bordered table-hover data_table"  >
							<div class="select_333" style="margin-right: 61.5% !important">
							
						<div class="col-md-1" style="float: right; margin-right: 0px;"><div class="my-slect">
							 <select name="hiring_status_id" id="hiring_status_id" class="form-control required">
                            <option value="">Hiring Status Filter</option><?php foreach ($employee_memor as  $employees_sts) {?>
							  <option  value="<?= $employees_sts['id'] ?>"><?= $employees_sts['status'] ?></option>
                            <?php } ?>  </select></div></div>
							<div class="col-md-1" style="float: right; margin-right: 0px;"><div class="my-slect">
							R-day Filter <input type="text" id="rem-day-filter" value="" style="width:38px;"></div></div>
						<div class="col-md-1" style="float: right; margin-right: 0px;"><div class="my-slect">
                            <select name="group_id" id="group_id" class="form-control required">
                                                <option value="">Select Group</option>
                                                <?php foreach ($groups as $group) { ?>
                                                    <option <?php echo ($group['group_id'] == $employee['group_id']) ? 'selected' : '' ?> value="<?= $group['group_id'] ?>"><?= $group['group_name'] ?></option>
                                                <?php } ?>
                                            </select></div>
</div> 

	<div class="col-md-1" style="float: right; margin-right: 0px;"><div class="my-slect">
                            <select name="department_id" id="department_id" class="form-control required">
                                                <option value="">Select Department</option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option <?php echo ($department['department_id'] == $employee['department_id']) ? 'selected' : '' ?> value="<?= $department['department_id'] ?>"><?= $department['department_name'] ?></option>
                                                <?php } ?>
                                            </select></div>
</div>
<div class="col-md-1" style="float: right; width:100px; margin-right: 0px;"><div class="my-slect">
                            Active <input type ="checkbox"  name ="check_active_inactive"  id ="check_active_inactive" value ="1" checked="checked"></div>
</div>	
 </div><thead><tr> <th class="text-center"><label><input type="checkbox" name="checkHead" class="i-checks checkHead" id="selectall"/>
                                        <span class="lbl"></span></label> </th>
                                        <th style="width:50px!important;">ID</th>
                                        <th style="width:50px!important;" style="display:none;">tt</th>
                                        <th style="width:50px!important;">Action</th>
										<th><img title="You Can See All Pined Employee From Here" class="new_view" value="checked"  style=" vertical-align: top; width: 18px;    margin-right:4px;    margin-left: 3px;    margin-top: 0px;    float: left;" 
                                               src="<?php echo base_url();?>files/logo/pin.png"><?= $this->lang->line('PIN') ?></th>
										<th style="width:50px!important;">	<img title="You Can Reset All Employee Confirmed Date From Here" class="reset_con" style=" vertical-align: top; width: 18px;    margin-right:4px;    margin-left: 3px;    margin-top: 0px;    float: left;" 
                                               src="<?php echo base_url();?>files/logo/delete_date.png"><?= $this->lang->line('Confirmed') ?></th>
										 <th><?= $this->lang->line('Emp No.') ?></th>
										 <th style="width:50px!important;"><?= $this->lang->line('D-Hired ( Month )') ?></th>
										 <th style="width:50px!important;">R-days</th>
										  
                                        <th><?= $this->lang->line('Department') ?></th> 
                                        <th><?= $this->lang->line('Group') ?></th> 
										 <th><?= $this->lang->line('Status') ?></th>
										 
										 <th><?= $this->lang->line('Employee Name') ?></th>
										 <th><?= $this->lang->line('PIC') ?></th>
										 <th><?= $this->lang->line('SIG') ?></th>
										  <th>
										  
<img title="Generate Picture Image File Name" class="image_all" value="checked"  style=" vertical-align: top; width: 18px;    margin-right:4px;    margin-left: 7px;    margin-top: 0px;    float: left;" 
                                               src="http://wshrms.peza.com.ph/files/logo/edit_icon_new.png">
										  <div class="confirmwrap">
										  Delete All Image Files ? 
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class="delete_file_from_folder btn btn-xs btn-primary" data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class="off_popup  btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										  </div>
									<?php $directory = BASEPATH . '../files/ID_image/pic/';
                                              $files = glob($directory . '*');
if ( $files !== false )
{
    $filecount = count( $files );
    echo '<p  >ID PIC :&nbsp;<span style="color:red;">'. $filecount .'</span></p>';
}
else
{
    echo 0;
}
?>  
<script>
    $(document).ready(function(){
        $(".ontoclick1").click(function(){
            $(".confirmwrap").slideToggle("show");
        });
		$(".off_popup").click(function(){
            $(".confirmwrap").slideToggle("hide");
        });
		
		$(".off_popup1").click(function(){
            $(".confirmwrap2").slideToggle("hide");
        });
		  $(".ontoclick22").click(function(){
            $(".confirmwrap22").slideToggle("show");
        });
		$(".off_popup22").click(function(){
            $(".confirmwrap22").slideToggle("hide");
        });
		 $(".ontoclick33").click(function(){
            $(".confirmwrap33").slideToggle("show");
        });
		$(".off_popup33").click(function(){
            $(".confirmwrap33").slideToggle("hide");
        });
			// $(".off_popup1zxc").click(function(){
            // $(".confirmwrap23456").slideToggle("hide");
        // });
		 $(".off_popup1zxc").click(function(){
        $(".confirmwrap23456").hide();
    });
    });
    </script>   
	<script>
$(document).ready(function(){
   
   
});
</script>
	<style>
	.confirmwrap23456{ display:none;}
.confirmwrap {
    display: none;
    position: absolute;
    top: 14px;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    padding: 16px;
    z-index: 999999999999;
    background: #ffffff;
    margin-left: 26px;
}
.confirmwrap span {
    margin: 0px 6px;
}
span.frame_wrap {
    float: left;
    position: relative;
}
	</style>
		  <p  title="You Can Delete All Copy Images from  Here">
			<img class="ontoclick1"  style="vertical-align: top;  width:24px; cursor: pointer; margin-right: 4px;  margin-left: 3px; margin-top: 0px;
    float: left;"    src="<?php echo base_url();?>files/logo/delete_png.png"></p>
</th>
 <th>

<img title="Generate Signature Image File Name" class="signature_all" value="checked"  style=" vertical-align: top; width: 18px;    margin-right:4px;    margin-left: 11px;    margin-top: 0px;    float: left;" 
                                               src="<?php echo base_url();?>files/logo/edit_icon_new.png">


 <div class="confirmwrap1">
 
										  Delete All Signature Files ? 
										  
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class="delete_sigfile_from_folder btn btn-xs btn-primary" data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class="off_popup  btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										  </div>
										<?php $directory = BASEPATH . '../files/ID_image/sig/';
                                              $files = glob($directory . '*');
if ( $files !== false )
{
    $filecount = count( $files );
    echo '<p >ID SIG :&nbsp;<span style="color:red;">'. $filecount .'</span></p>';
}
else
{
    echo 0;
}
?> 

<script>
    $(document).ready(function(){
        $(".ontoclick0").click(function(){
            $(".confirmwrap1").slideToggle("show");
        });
		$(".off_popup").click(function(){
            $(".confirmwrap1").slideToggle("hide");
        });
		
		 $(".ontoclick1").click(function(){
            $(".confirmwrap2").slideToggle("show");
        });
		
		
		
    });
    </script>   
	
<style>
.confirmwrap1 {
    display: none;
    position: absolute;
    top: 14px;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    padding: 16px;
    z-index: 999999999999;
    background: #ffffff;
    margin-left: 26px;
}
.confirmwrap1 span {
    margin: 0px 6px;
}
.dataTables_wrapper table th:nth-child(14) {
    min-width: 149px;
}
.dataTables_wrapper table th:nth-child(14) p {
    float: left;
}
.confirmwrap23456.confirmwrap23456789 {
    left: 110px;
}
.confirmwrap23456.confirmwrap242423424 {
    width: 159px;
    left: 112px;
}
							
		.copy_img:hover > .confirmwrap23456{ display:block }	
.confirmwrap23456 {    position: absolute;    width: 153px;    background: #fff;
    padding: 10px 5px;    box-shadow: 0px 2px 2px #979897;    border-radius: 5px;    left:65px;    top: -14px;    z-index: 99;}
.confirmation-buttons.text-center { margin-top: 5px;}
.copy_img{ position:relative;}	
td.onhover222222:hover > .confirmwrap23456 {
    display: block;
}
.onhover222222 {
    position: relative;
}
.confirmwrap23456789{ width:165px;}	
										</style>
  <p  title="You Can Delete All Copy Signature Images from  Here">
			<img class="ontoclick0"  style="    vertical-align: top;
    width: 24px;
    cursor: pointer;
    margin-right: 4px;
    margin-left: 7px;
    margin-top: 0px;
    float: left;"    src="<?php echo base_url();?>files/logo/delete_png.png"></p>

</th>      <th><?= $this->lang->line('TIN #') ?></th>
                                        <th><?= $this->lang->line('SSS #') ?></th>
                                        
                                        <th><?= $this->lang->line('Pag-ibig #') ?></th>
                                        <th><?= $this->lang->line('Phil-Health #.') ?></th>
										 <th><?= $this->lang->line('Nick Name') ?></th>
                                        <th><?= $this->lang->line('Birth Date') ?></th>
										<th><?= $this->lang->line('Email') ?></th>
                                        <th><?= $this->lang->line('Contact Person') ?></th>
                                        <th><?= $this->lang->line('Relation') ?></th>
                                        <th><?= $this->lang->line('Address') ?></th>
                                        <th><?= $this->lang->line('Contact #') ?></th>
                                       

										</tr></thead>
                                <tbody> <?php foreach ($employees['data'] as $index => $employees) { ?>
                                      <tr entity_id="<?= $employees->employee_id ?>">
										  <td class="text-center">
                                                <label>
                                                    <input type="checkbox" class="i-checks checkItem" name="checkHead[]" value="<?= $employees['employee_id'] ?>" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td class="idmanual" style="width:5%!important;"><?= $employees['employee_id'] ?>	</td>
										
											<td>
											 <a class="btn btn-outline btn-success btn-xs three-but" href="request/edit_document/<?= $employees['employee_id'] ?>"  data-toggle="modal" data-target="#modal_window">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                           <!--     <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Reset Password ?') && submit_form('#delete_document<?= $employees['employee_id'] ?>', '#save_result')" title="Reset Password">
                                               
                                                </a>
												-->
<a id="delete_document<?= $employees['employee_id'] ?>" href="employees/set_password/<?= $employees['employee_id'] ?>" class="three-but btn btn-outline btn-danger btn-xs" data-target="#modal_window" data-toggle="modal"><i class="fa fa-key" aria-hidden="true"></i></a>
													
								            
	<?php if($employees['confirm_date_pp']){?><img class="three-but" style='border:0px;' title="Reset confrim date" onclick="date_dele(<?php echo $employees['employee_id']; ?>)" src="<?php echo base_url();?>files/logo/resetsearch.png"><?php }?></td>	<td class="text-center"><label> <input type="checkbox" class="i-checks checkpin" <?php   if($employees['pin']=='1'){echo "checked";  }else{echo "unchecked";} ?> name="checkpin[]" value="<?= $employees['employee_id'] ?>" />  <span class="lbl"></span>
                                                </label> </td>	
												<td>
											
												<?=$employees['confirm_date_pp'];?>
											
												
											<p class=""   value="<?php echo $employees['employee_id']; ?>"  ></p>
											
											</td>
												<td > <?= $employees['employee_no'] ?></td>
												
												<td style="width:5%!important;">
												<?= date('Y-m-d', strtotime($employees['hired_date'])) ?><span style="color:red;font-weight:bolder;">&nbsp;&nbsp;(<?php $current= Date('Y-m-d'); 
												$hired = date('Y-m-d', strtotime($employees['hired_date']));
												// $diff       = date_diff($current,$hired);
												// $val= $current-$hired;
												// echo $val.'/';
												$date1 = new DateTime($current);
                                                $date2 = new DateTime($hired);

                                            $diff = $date1->diff($date2, true);
                                             $date =$diff->format('%a'); 
											   $fdate =$date/30;
											   $ldate = explode(".",$fdate);
                                             echo $ldate[0];
												?>)</span></td>
												 <td>  <?php foreach ($employee_memor as  $employees_sts) {?>
							                 <?php if($employees['status'] == $employees_sts['id']){ echo  $employees_sts['status']; } } ?></td>
											  
											<td><?= $employees['department_name'] ?></td>
											<td><?= $employees['group_name'] ?></td>
									<td><a href="employees/edit_employee/<?= $employees['employee_id'] ?>"><?= $employees['name'] ?></a>
											</td>
											
											<?php $contant_req =$employees['content']; ?>
											
										
                                            <!--td class="onhover222222"> 
											
											
											  
							
											   </td-->
											  <!--td class="onhover222222 onhover22222234"> 
											
											 
											  </td--> 
											
											
											  <td class="onhover222222 onhover222223456"> 
										
											<?php 
											//if(!empty($employees['copy_avatar'])){
												$image_name=basename($employees['copy_avatar']);
												$image_path=basename($employees['copy_image_path']);
												
												if ($image_name == $image_path){
												
												$image_name=basename($employees['copy_avatar']);?>
											<img class="avatar img-rounded" src="<?php echo base_url().$employees['copy_avatar'];  ?>" title="<?php echo $image_name;?>" style="width:40px;height: 40px; margin: 3px 0;" data-toggle="modal" data-target="#myModal">
											<?php }
											else
											{
											echo $image_path ; } ?>
											
										
											  <input type="hidden" value="<?= $employees['employee_id'] ?>" name="emp_id">
									<?php if($employees['copy_avatar']){?>
											  
											  
									
											  <?php } ?>
											 
											   <div class="confirmwrap23456 confirmwrap23456789">
										 Delete ID Picture Image?
										  
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class=" btn btn-xs btn-primary"  id="avatar_img" title="Click Here To Delete Image" onClick="delete_img('<?php echo $employees['employee_id'];   ?>')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										
										  </div>  
											 
											 
											</td>
											
												  <td class="onhover222222 onhover465453"> 
												  
											<?php 
											
											//if(!empty($employees['copy_sign'])){
													
												$image_name1=basename($employees['copy_sign']);
												$image_path1=basename($employees['copy_sig_path']);
												if ($image_name1 == $image_path1){
												?>
												
												
												
										
											<img class="sign_img img-rounded hhhhh" src="<?php echo base_url().$employees['copy_sign'];  ?>" title="<?php echo $image_name1;?>" style="width:40px;height: 40px; margin: 3px 0;"
											data-toggle="modal" data-target="#myModal">
											
											<?php }
											else
											{
											echo $image_path1 ; } ?>
											 <input type="hidden" value="<?= $employees['employee_id'] ?>" name="emp_id">
											  <?php if($employees['copy_sign']){?>
											
											
												  <div class="confirmwrap23456 confirmwrap242423424">
										 Delete Signature Image? 
									
										  <div class="confirmation-buttons text-center"><div class="btn-group">
										  <span class=" btn btn-xs btn-primary" onclick="sign_delete_img('<?php echo $employees['employee_id'];   ?>')"  data-apply="confirmation"><i class="glyphicon glyphicon-ok"></i> Yes</span>
										  
										  <span class=" off_popup1zxc btn btn-xs btn-default" data-dismiss="confirmation"><i class="glyphicon glyphicon-remove"></i> No</span>
										  
										 </div></div>
										
										  </div> 
											<?php }?> 
											
										
											
											
											</td>
                                                                                        
                                            <td > <?= $employees['tin'] ?></td>
											<td><?= $employees['ssn'] ?> </td>
											<td><?= $employees['Pag_Ibig_No'] ?></td>
											<td><?= $employees['healthno'] ?></td>
											<td><?= $employees['nick_name'] ?></td>
											<td><?= $employees['birth_date'] ?></td>
											 <td > <?= $employees['email'] ?></td>
											<td><?= $employees['employee_contactperson'] ?></td>
											<td><?= $employees['employee_relation'] ?></td>
											<td ><span class="address_infos"><span class="span11"><?= $employees['employee_address'] ?></span><span class="span22"><?= $employees['employee_address'] ?></span></span></td>
											<td><?= $employees['contactno'] ?></td>
											    
											
 </tr>
 
 
  
  
 
 <?php } ?>
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

.popup{
    width: 900px;
    margin: auto;
    text-align: center
}
.popup img{
    width: 200px;
    height: 200px;
    cursor: pointer
}
.show22{
    z-index: 999;
    display: none;
}
.show22 .overlay{
   
    height: 100%;

    position: absolute; width:100%;
    top: 0;
    left: 0;    background: rgba(0,0,0,0.3);
}

.show22 .img-show{
    width: 600px;
    height:600px;
    background: #FFF;
    overflow: hidden;
    margin: 30px auto;
    position: relative;
    /* background-clip: padding-box; */
    display: inline-block; margin-top:130px;
}
.img-show span:hover {
    background: red;
    color: #fff;
    border-color: red;
}
.img-show span{
position: absolute;
    top: 6px;
    right: 6px;
    z-index: 99;
    cursor: pointer;
    background: #f1f0f0;
    font-size: 29px;
    padding: 0px 10px;
    border: 1px solid #ab9f9f;
    border-radius: 7px;
}
.img-show img{
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
/*End style*/

.show22{ display:none;}
.show22 {
    overflow: auto;
    overflow-y: scroll;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    -webkit-overflow-scrolling: touch;
    outline: 0;
    text-align: center;
}
.show22 {
    overflow: auto;
    overflow-y: scroll;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1050;
    -webkit-overflow-scrolling: touch;
    outline: 0;
}


table.dataTable thead .sorting:after {
    margin-left: 17px !important;
    content: "\f0dc";
    float: inherit !important;
    font-family: fontawesome;
    color: rgba(50,50,50,.5);
}


div#data_table_wrapper table#data_table thead th {
    padding: 7px 34px 1px 10px !important;
    white-space: nowrap;
}

div#data_table_wrapper table#data_table thead th:nth-child(15) p {
    float: left;
}

div#data_table_wrapper table#data_table thead th:nth-child(15) {
    min-width: 156px !important;
}

.dataTables_wrapper table td:nth-child(7) {
    text-align: left !important;
}



</style>
<script>
$(function () {
    "use strict";
    
    $("img").click(function () {
        var $src = $(this).attr("src");
        $(".show").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });
    
});
</script>
<script>
$(function () {
    "use strict";
    
    $(".avatar, .hhhhh").click(function () {
        var $src = $(this).attr("src");
        $(".show22").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .overlay").click(function () {
        $(".show22").fadeOut();
    });
    
});
</script>
<script>	
function date_dele(id){
		
		
		
		 $.ajax({
		  type: 'POST',
        url: 'employees/delete_ppdate?id='+id,
        
        success: function(response) {
           alert(response);
		   location.reload();
        }
    }); 
		}	
	function copysign_img(id){
	
		  $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/upload_sign?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
        }
    }); 
	}
	function copyavatar_img(id){
		//alert("hiii");
		//alert(id);
		  $.ajax({
			   
			  
        type: 'POST',
        url: 'employees/upload_avatar?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
		 }
    }); 
	}
	
	function delete_img(id){
		
		  $.ajax({
		 type: 'POST',
        url: 'employees/delete_copyimpg?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
        }
    }); 
	}
	function sign_delete_img(id){
		
		  $.ajax({
		 type: 'POST',
        url: 'employees/sign_delete_img?id='+id,
        
        success: function(response) {
           alert(response);
		     location.reload();
        }
    }); 
	}
	
		</script>
<div class="show22">
  <div class="overlay"></div>
  <div class="img-show">
   <!-- <span>X</span>-->
    <img src="">
  </div>
</div>
   <!-- Modal -->

<?php $this->load->view('layout/footer')?>
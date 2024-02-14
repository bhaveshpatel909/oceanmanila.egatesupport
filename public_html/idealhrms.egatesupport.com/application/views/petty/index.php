<?php $this->load->view('layout/header', array('title' => $this->lang->line('Petty Cash'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE)) ?>

<script>
    $('document').ready(function () {
        $(".knob").knob();
        current_table = $('.data_table').dataTable({
			 oLanguage: {
      sSearch: "Filter Data"
    },
            order: [[3, "DESC"]],
            columnDefs: [{
                    targets: [1, 7],
                    orderable: true,
					 bFilter: true, 
        bInfo : false,
                }]
        });
		
		var oTable;
      oTable = $('.data_table').dataTable();
			 $('#msds-select').change( function() { 
			
            oTable.fnFilter(  $(this).val() , 0); 
					
       });
	   
	   var oTabled;
      oTabled = $('.data_table').dataTable();
			 $('#year').change( function() { 
			
            oTabled.fnFilter( $(this).val() , 1);
  			
       });
 
      
 //$('#month').change( function(e) {
			
  // var letter = $(this).val();
  //  $("#mon").val(letter);
  //alert('skjfhdkjgsd');
 //current_table.fnFilter( $(this).val() , 0); 	 
// });
 
 //$('#year').change( function(e) {
			
 //  var letterg = $(this).val();
 //   $("#mon").val(letterg);
  //alert('skjfhdkjgsd');
 //current_table.fnFilter( $(this).val() , 0); 	 
 //});
 
 
////////////////////////////////////////////////


    
    
 /*  $("#datepicker_from").datepicker({
   // showOn: "button",
    // buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
  
      minDateFilter = new Date(date).getTime();
 alert( minDateFilter);
      current_table.fnDraw();
    }
  }).keyup(function() {
    minDateFilter = new Date(this.value).getTime();
    current_table.fnDraw();
  });

  $("#datepicker_to").datepicker({
   //showOn: "button",
    // buttonImage: "images/calendar.gif",
    buttonImageOnly: false,
    "onSelect": function(date) {
      maxDateFilter = new Date(date).getTime();
      current_table.fnDraw();
    }
  }).keyup(function() {
    maxDateFilter = new Date(this.value).getTime();
    current_table.fnDraw();
  });
 */


//   $('.item-amount').click(function() {
//    $('#datepicker_from, #datepicker_to').val('');
//   maxDateFilter = new Date(this.value).getTime();
 //   minDateFilter = new Date(this.value).getTime();
   //required after
//oTable.fnDraw();
//}); 
// Date range filter
minDateFilter = "";
maxDateFilter = "";

/* $.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[0]).getTime();
    }

    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
); */

 $.fn.dataTable.ext.search.push(
          function (settings, data, dataIndex) {
        var min = $('#datepicker_from').datepicker("getDate");
		//var min1= minn.getMonth() + 1;
        var max = $('#datepicker_to').datepicker("getDate");
		//var max1= maxx.getMonth() + 1;
        var startDate = new Date(data[2]);
		//var startDate = dateObj.getUTCMonth() + 1;
		//alert(startDate);
        if (min == null && max == null) { return true; }
        if (min == null && startDate <= max) { return true;}
        if(max == null && startDate >= min) {return true;}
        if (startDate <= max && startDate >= min) { return true; }
        return false;
    }
    );
	
	$("#datepicker_from").datepicker({ onSelect: function () { current_table.draw(); }, changeMonth: true, changeYear: true });
        $("#datepicker_to").datepicker({ onSelect: function () { current_table.draw(); }, changeMonth: true, changeYear: true });
        var current_table = $('.data_table').DataTable();

        // Event listener to the two range filtering inputs to redraw on input
        $('#datepicker_from, #datepicker_to').change(function () {
            current_table.draw();
        });


////////////////////////

/////////////////////////////////////////////////////////////////
/* $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#msds-select').val(), 10 );
        var max = parseInt( $('#year').val(), 10 );
        var age = parseFloat( data[0] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);
 

    var table = $('.data_table').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#msds-select, #year').change( function() {
        table.draw();
    } );
 */

//////////////////////////////////////////////////////////////////

		
        var options = {aSep: ',', aDec: '.', aSign: '₱ ', mDec: 0};
        $('.autoNumeric').autoNumeric('init', options);
		
		$("td#writememo").click(function(){
			//alert("hiiii");
			var pid= $(this).attr('data-pid');
			var comm= $(this).attr('data-pc');
			$("#pettyid").val(pid);
			$("#comm").text(comm);
			 $('#memomodel').modal('show');
		})
    });
	function refreshPage()
	{
		//location.reload();
	}
</script>
		
	<script>
	$(document).ready(function(){
		 $('#msds-select').change( function(e) 
		 {
				$("#mth").val($(this).val());
		 })
		 $('#year').change( function(e) 
		 {
		$("#yr").val($(this).val());
		 })
		
		/*  $("#Export").click(function(e){
	e.preventDefault();
var yearr =	$('#year option:selected').text();
var month =	$('#msds-select option:selected').text();
  // alert(yearr);
  // alert(month);
  
			 $.ajax({
	      type: "post",
           url: 'petty/export_excel',
           data: {'year' : yearr,
		        'month': month ,
				},
						 
             cache: false,
			 success: function(response)
			 {
				 
			 }
        }); */
  
});

		
		</script>	
			



<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'petty_cash')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-3">
                <h2><?= $this->lang->line('Petty Cash') ?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Petty Cash') ?>
                    </li>
                </ol>
            </div>
			
			  <div class="col-lg-3">
			              <div class="title-action">
           <h2 style="float: left !important;">From</h2>  <input type="text"  id="datepicker_from" class="form-control item-amount "><br>
			
						<select id="year" class="form-control item-amount ">
			<option value="" >Select Year</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
			<option value="2020">2020</option>
			<option value="2021">2021</option>
			<option value="2022">2022</option>
			<option value="2023">2023</option>
			<option value="2024">2024</option>
			<option value="2025">2025</option>
			<option value="2026">2026</option>
			<option value="2027">2027</option>
			<option value="2028">2028</option>
			<option value="2029">2029</option>
			<option value="2030">2030</option>
			<option value="2031">2031</option>
			<option value="2032">2032</option>
			<option value="2033">2033</option>
			<option value="2034">2034</option>
			<option value="2035">2035</option>
			<option value="2036">2036</option>
			<option value="2037">2037</option>
			<option value="2038">2038</option>
			<option value="2040">2040</option>
			<option value="2041">2041</option>
			<option value="2042">2042</option>
			<option value="2043">2043</option>
			<option value="2044">2044</option>
			<option value="2045">2045</option>
			<option value="2046">2046</option>
			<option value="2047">2047</option>
			<option value="2048">2048</option>
			<option value="2049">2049</option>
			<option value="2050">2050</option>
			
			</select>
			
			
        </div>
            </div>
			
			 <div class="col-lg-3">
			             <div class="title-action">
           <h2 style="float: left !important;" >To</h2><input type="text"  id="datepicker_to" class="form-control item-amount ">
			<br>
	<select id="msds-select" class="form-control item-amount ">
			<option value="" >Select Month</option>
			<option value="01">January</option>
			<option value="02">February</option>
			<option value="03">March</option>
			<option value="04">April</option>
			<option value="05">May</option>
			<option value="06">June</option>
			<option value="07">July</option>
			<option value="08">August</option>
			<option value="09">September</option>
			<option value="10">October</option>
			<option value="11">November</option>
			<option value="12">December</option>
			
			</select>
        </div>
            </div>
	
			
			
			
			
			
			 <div class="col-lg-1">
			 <br>
			 <br>
			 <br><br><br><br>
			
            <div class="title-action">
 <form action="petty/export_excel" method="POST" id="export_petty_cash">
                                                    <input type="hidden" id="yr" name="yr" value="" class="petty_cash_id">
                                                    <input type="hidden" id="mth" name="mth" value="" class="petty_cash_id">
													<input type="submit" name="dfd" value='export' class="btn btn-primary">
												
                                                </form>
                  
					
                </div>
        
            </div>
			
            <div class="col-lg-2">
                <div class="title-action">
                    <a href="petty/new_petty_cash" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i>
                        <?= $this->lang->line('Add') ?>
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
                            <table class="table table-striped table-bordered table-hover data_table" id="employee_grid">
                                <thead>
                                    <tr>
									<th style="display:none;">fgfg</th>
									<th style="display:none;">fgfg</th>
                                        <th width="90.031px"><?= $this->lang->line('Date') ?></th>
                                        <th><?= $this->lang->line('Voucher No.') ?></th>
                                        <th><?= $this->lang->line('Description') ?></th>
                                        <th style="width:20%;"><?= $this->lang->line('Note') ?></th>
                                         <th width="188.0313px"><?= $this->lang->line('Pay to') ?></th>
                                        <th align="right"width="66.0313px"><?= $this->lang->line('Expense') ?></th>
                                        <th align="right" width="66.0313px"><?= $this->lang->line('Deposit') ?></th>
                                        <th align="right" width="66.0313px"><?= $this->lang->line('Balance') ?></th>
                                        <th width="7%"></th>
                                        <th class="note" width="">Note</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									//echo "<pre>";
									//print_r($petty_cash_list);
                                    $expense = $deposit = $balance = 0;
                                    foreach ($petty_cash_list as $petty_cash) {
                                        if ($petty_cash['petty_cash_type'] == 'expense') {
                                            $petty_cash['expense'] = $petty_cash['total'];
                                            $petty_cash['deposit'] = 0;
                                            $expense += $petty_cash['total'];
                                            $balance = $balance - $petty_cash['total'];
                                        } else {
                                            $petty_cash['expense'] = 0;
                                            $petty_cash['deposit'] = $petty_cash['total'];
                                            $deposit += $petty_cash['total'];
                                            $balance = $balance + $petty_cash['total'];
                                        }
										
									$rest = substr($petty_cash['created_date'], 0, -6);
									$grest = substr($petty_cash['created_date'], 5, -3);
                                        ?>
                                        <tr entity_id="<?= $petty_cash['petty_cash_id'] ?>">
										
                                            <td style="display:none;"><?php echo $grest; ?></td>
                                            <td style="display:none;"><?php echo $rest; ?></td>
                                            <td><?= $petty_cash['created_date'] ?></td>
                                            <td><?= $petty_cash['ca_no'] ?></td>
                                            <td>
                                                <a class="btn btn-outline btn-primary btn-xs" target="_blank" href="petty/preview_petty_cash/<?= $petty_cash['petty_cash_id'] ?>" >
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
												<a class="btn btn-outline btn-primary btn-xs" target="_blank" href="petty/print_petty_cash/<?= $petty_cash['petty_cash_id'] ?>" >
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                <?= $petty_cash['description'] ?>
                                            </td>
                                            <td id="comment_p" style="width:20%;"><?php echo $petty_cash['comment_p'];?></td>
											<td><?= $petty_cash['fullname'] ?></td>
                                            <td align="right">
                                                <span class="autoNumeric"><?= $petty_cash['expense'] ?></span>
                                            </td>
                                            <td align="right">
                                                <span class="autoNumeric"><?= $petty_cash['deposit'] ?></span>
                                            </td>
                                            <td align="right"><span class="autoNumeric"><?= $balance ?></span></td>
                                            <td class="ghghghg" style="width: 105px;">
                                                <?php if ($this->user_actions->is_allowed('admin')) { ?>
                                                 <input type="checkbox" disabled readonly   name="alertchk"  value="1"
                                                     <?php if($petty_cash['liquidated']==1)
                                                        { ?>
                                                            checked
                                                            <?php
                                                        }    ?>>
                                                    <a class="btn btn-outline btn-success btn-xs" href="petty/edit_petty_cash/<?= $petty_cash['petty_cash_id'] ?>" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline btn-danger btn-xs" onclick="confirm('Delete petty_cash ?') && submit_form('#delete_petty_cash<?= $petty_cash['petty_cash_id'] ?>', '#save_result')" title="Delete">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
													<?php
													// echo '<pre>';
													// print_r($petty_cash);
													// echo '</pre>';
													// die('dfcf');
													
													
													
													?>
													
											
											<?php if($petty_cash['file']!="") {?>
													<a class="btn btn-outline btn-primary btn-xs" target="_blank" href="<?php echo base_url('files')?>/petty/<?= $petty_cash['file'] ?>">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
												
												
                                                <?php 
											}
											} ?>

                                                <form action="petty/delete_petty_cash" method="POST" id="delete_petty_cash<?= $petty_cash['petty_cash_id'] ?>">
                                                    <input type="hidden" id="petty_cash_id" name="petty_cash_id" value="<?= $petty_cash['petty_cash_id'] ?>" class="petty_cash_id<?= $petty_cash['petty_cash_id'] ?>">
                                                </form>
                                            </td>
										<td style="width:important;" id="writememo" data-pid="<?= $petty_cash['petty_cash_id'] ?>" data-pc="<?= $petty_cash['comment_p'] ?>"><a class="btn btn-outline btn-success btn-xs" href="javascript:void(0);">
                                                        <i class="fa fa-edit"></i>
                                                    </a></td>
                                        </tr>                                    
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                <th colspan="5"><?= $this->lang->line('Total') ?></th>
                                <td align="right"><span class="autoNumeric" style="font-weight: 700;"><?= $expense ?></span></td>
                                <td align="right"><span class="autoNumeric" style="font-weight: 700;"><?= $deposit ?></span></td>
                                <td align="right"><span class="autoNumeric" style="font-weight: 700;"><?= $balance ?></span></td>
                                <th></th>
                                <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="memomodel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onClick="refreshPage()"  class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $this->lang->line('Close') ?></span></button>
                <h4 class="modal-title"><?= $this->lang->line('Add Memo') ?></h4>
            </div>
            <div class="modal-body">
                
                <form action="petty/save_comment_petty" method="POST" id="save_bir_file">
                    <div id="save_result2"></div>
                    <input type="hidden" id="pettyid" name="pettyid"  value="" class="pettyid">

                    <div class="col-lg-6" style="padding-left: 0;">
                        <div class="form-group has-feedback">
                            <label for="for_themonth" class="control-label"><?= $this->lang->line('Memo') ?></label>
                            <textarea  id="comm" style="width:500px;height:90px;"name="comment"></textarea>
                        </div>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer" style="margin-top: 95px;">
               
                <button type="button" onClick="refreshPage()" class="btn btn-default" data-dismiss="modal"><?= $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary" onclick="submit_form('#save_bir_file', '#save_result2')"><?= $this->lang->line('Save') ?></button>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer')?>


<style>
.ghghghg {    padding-top:0px !important;}
.ghghghg input{     min-width: 18px;
    min-height: 22px;
    display: inline-block;
    position: relative;
    top: 10px;}
th.note.sorting {
    width: 44px !important;	
</style>


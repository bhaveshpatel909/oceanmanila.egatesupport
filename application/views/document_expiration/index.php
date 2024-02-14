<?php $this->load->view('layout/header',array('title'=> 'Employee Request','forms'=>TRUE, 'tables' => TRUE,'scroll'=>TRUE,'icheck'=>TRUE,'magicsuggest'=>TRUE)) ?>

<script>

// Custom filtering function which will search data in column four between two values

    $('document').ready(function () {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        
		// $('#to_date_filter').val(today);
        $('#from_date_filter').val(today);
		$("#ClearFilter").click(function (e) {
            e.preventDefault();
            $('#from_date_filter').val(today);
            $('#to_date_filter').val("");
            $('#request_no_days').val("");
            $('#list_201_document_type').val("");
            $('#expired_filter').val("all");
            $('#list_201_document_type').select2("val","");
            current_table.fnFilter();
        });
        $("#exportByFilter").click(function(e){
            e.preventDefault();
            changeURL();
        });
        $('#Filter').click(function(e){
            e.preventDefault();
            current_table.fnFilter();
        });
        $('#list_201_document_type').select2({
            placeholder: "Select 201 File Document Type",
            allowClear: true,
        })
        // .change(function(e){
        //     current_table.fnFilter();
        // });
 
        current_table = $('.data_table').dataTable({
            "order": [[5, "asc"]],
			"bFilter": true, 
            "autoWidth": false,
            "columnDefs": [
                { "width": "2%", "targets": 0 },
                { "width": "14%", "targets": 1 },
                { "width": "14%", "targets": 2 },
                { "width": "14%", "targets": 3 },
                { "width": "2%", "targets": 4 },
                { "width": "2%", "targets": 5 },
                { "width": "2%", "targets": 6 },
                { "width": "14%", "targets": 7 }
            ]
        });
        $('#modal_window').on('hidden.bs.modal', function (e) {
            window.location.reload();
        })
		
	// $('#request_no_days').change( function() { 
    //         //current_table.fnFilter( $(this).val() );
    //     // current_table.fnFilter( this.value, 5);		
    //     current_table.fnFilter();	
    //    });	
	   // Refilter the table
    // $('#min, #max').on('change', function () {
        // current_table.draw();
    // });
	$('#min, #max').keyup(function () {
        // current_table.draw();
		current_table.fnFilter();
        
    });
	
	
	})
	$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var MinDateValue = $('#from_date_filter').val();
        var MaxDateValue = $('#to_date_filter').val();
        var requestNoDays = $('#request_no_days').val();

        var dataDocumentType = $('#list_201_document_type').select2('data');
        var documentType = dataDocumentType.length > 0 ? dataDocumentType[0].text : "";
        var documentName = data[2];
        var request_exp_date = parseFloat(requestNoDays);
        var age = parseFloat(data[5]) || -1; // use data for the age column
        
        var minDate = new Date(MinDateValue);
        var MaxDate = new Date(MaxDateValue);
        var date = new Date( data[4] );

        //expired
        var remaining_days = data[5];
        var expiredfilter = $('#expired_filter').val();

        var returnValue = false;
        if(requestNoDays == "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "all"){
            returnValue = true;
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "all"){
            if(age <= request_exp_date){
                returnValue = true;
            }  
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "all"){
            if((date >= minDate && date <= MaxDate) && age <= request_exp_date){
                returnValue = true;
            }    
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "all"){
            if(documentType == documentName && age <= request_exp_date){
                returnValue = true;
            }  
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "all"){
            if((date >= minDate && date <= MaxDate)){
                returnValue = true;
            }    
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "all"){
            if((date >= minDate && date <= MaxDate) && documentType == documentName){
                returnValue = true;
            }    
        }else if(requestNoDays == "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "all"){
            if(documentType == documentName){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "all"){
            if(documentType == documentName && age <= request_exp_date && (date >= minDate && date <= MaxDate)){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "all"){
            if((date >= minDate && date <= MaxDate) && age <= request_exp_date){
                returnValue = true;
            }    
        }

        // EXPIRED
        else if(requestNoDays == "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "1"){
            if(age < 0){
                returnValue = true;
            }  
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "1"){
            if(age < 0 && documentType == documentName && age <= request_exp_date){
                returnValue = true;
            }  
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "1"){
            if(age < 0 && (date >= minDate && date <= MaxDate)){
                returnValue = true;
            }    
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "1"){
            if(age < 0 && (date >= minDate && date <= MaxDate) && documentType == documentName){
                returnValue = true;
            }    
        }else if(requestNoDays == "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "1"){
            if(age < 0 && documentType == documentName){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "1"){
            if(age < 0 && documentType == documentName && age <= request_exp_date && documentType == documentName){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "1"){
            if(age < 0 && age <= request_exp_date){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "1"){
            if(age < 0 && age <= request_exp_date && (date >= minDate && date <= MaxDate)){
                returnValue = true;
            }   
        }

        // NOT EXPIRED
        else if(requestNoDays == "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "2"){
            if(age > 0){
                returnValue = true;
            }  
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "2"){
            if(age > 0 && documentType == documentName && age <= request_exp_date){
                returnValue = true;
            }  
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "2"){
            if(age > 0 && (date >= minDate && date <= MaxDate)){
                returnValue = true;
            }    
        }
        else if(requestNoDays == "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "2"){
            if(age > 0 && (date >= minDate && date <= MaxDate) && documentType == documentName){
                returnValue = true;
            }    
        }else if(requestNoDays == "" && (MaxDateValue == "") && documentType != "" && expiredfilter == "2"){
            if(age > 0 && documentType == documentName){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType != "" && expiredfilter == "2"){
            if(age > 0 && documentType == documentName && age <= request_exp_date){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue == "") && documentType == "" && expiredfilter == "2"){
            if(age > 0 && age <= request_exp_date){
                returnValue = true;
            }   
        }
        else if(requestNoDays != "" && (MaxDateValue != "") && documentType == "" && expiredfilter == "2"){
            if(age > 0 && age <= request_exp_date && (date >= minDate && date <= MaxDate)){
                returnValue = true;
            }   
        }
        
        
        


        

        if( data[4]  == ""){
            returnValue = false;
        }
        return returnValue;

});
	

    
</script>

<!-- from diky -->
<script>
    function changeURL(){
        var fromDate = $('#from_date_filter').val() ||  "0";
        var todate = $('#to_date_filter').val() || "0";
        var request_no_days = $('#request_no_days').val() ||  "0";
        var document_type = $('#list_201_document_type').val() ||  "0";
        var expired = $('#expired_filter').val() == "all" ? "0" : $('#expired_filter').val();
        currentURL = "employees/exportdocumentexp";
        currentURL += "/"+ fromDate +'/';
        currentURL += todate +"/";
        currentURL += request_no_days +"/";
        currentURL += document_type +"/";
        currentURL += expired;
        window.open(currentURL, '_blank')
    }
    function isValidDate(d) {
        return d instanceof Date && !isNaN(d);
    }
    
</script>


<style>
			td {
			width:9%!important;
			}
			.my-slect {
    position: absolute;
    z-index: 99999999999;
    width: 91%;
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


}
tr.odd td:nth-child(1) {
    text-align: center;
}
tr.even td:nth-child(1) {
    text-align: center;
}
.d-flex{
    display: flex;
}
.mt-1{
    margin-top: 10px;
}
.ml-1{
    margin-left: 10px;
}
.mb-1{
    margin-bottom: 10px;
}
.p-0{
    padding: 0;
}
			</style>
<?php
// echo'<pre>';
// print_r($documents);
// echo'</pre>';
?>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'document_expiration'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?php echo "Document Expiration "?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?php echo "Document Expiration";?>
                    </li>
                </ol>
            </div>
          
        
        <div class="row">
            <div class="col-lg-12">
			
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content"> 
                        <!-- <div class="row">
                            <div class="form-group col-md-3 d-flex">
                                <label class="col-md-5">Days to expire </label>
                                <input type="text" id="request_no_days" name="request_no_days" value="" class="form-control col-md-2" >
                                <a href ="employees/exportdocumentexp" class="col-md-5  mt-1"> Export All</a>
                            </div>
                            <div class="form-group col-md-9 d-flex">
                               <label class="col-md-2 mt-1">From</label>
                               <input type="date" name="from_date" id="from_date_filter" value="" class="form-control col-md-1" >
                               <label class="col-md-1 mt-1 ml-1">To</label>
                               <input type="date" name="to_date" id="to_date_filter" value="" class="form-control col-md-1" >
                               <a href ="#" class="col-md-1 ml-1 btn btn-success" id="Filter"> Filter</a>
                               <a href ="#" class="col-md-1 btn btn-danger" id="ClearFilter"> Reset</a>
                               <a href ="#" class="col-md-2 mt-1" id="exportByFilter"> Export</a>
                            </div>
                        </div> -->
                        <div class="row mb-1">
                            <div class="col-md-1">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <label>Days to expire </label>
                                        <input type="text" id="request_no_days" name="request_no_days" value="" class="form-control" >
                                    </div>
                                    <!-- <div class="col-md-5  p-0">
                                        <a href ="employees/exportdocumentexp" class="btn btn-link"> Reset</a>
                                        <a href ="employees/exportdocumentexp" class="btn btn-link"> Export All</a>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="col-md-2">
                                    <label>Document Type</label>
                                    <select id="list_201_document_type" class="form-control" name="document_type">
                                        <option value=""></option>
                                        <?php 
                                            foreach ($list_document_type as $key => $document_type) {
                                        ?>
                                        <option value="<?= $document_type["document_type_id"] ?>"><?= $document_type["document_type_name"] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label>Expired</label>
                                    <select id="expired_filter" class="form-control" name="expired_filter">
                                        <option value="all">All</option>
                                        <option value="1">Expired</option>
                                        <option value="2">Not Expired</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>From</label>
                                    <input type="date" name="from_date" id="from_date_filter" value="" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <label>To</label>
                                    <input type="date" name="to_date" id="to_date_filter" value="" class="form-control" >
                                </div>
                                <div class="col-md-3">
                                    <div class="row" style="margin-top:20px">
                                        <div class="col-md-3">
                                            <a href ="#" class="btn btn-success" id="Filter"> Filter</a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href ="#" class="btn btn-danger" id="ClearFilter"> Reset</a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href ="#" class="btn btn-warning" id="exportByFilter"> Export</a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href ="employees/exportdocumentexp" class="btn btn-warning"> Export All</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>



							
                        <div class="row">
                            <div id="save_result"></div>
							
                        <table class="table table-striped table-bordered table-hover data_table" >
						<div class="col-md-3" style="float: right; margin-right:56%;">
						<div class="my-slect">
							 
						</div>
						</div>
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">ID</th>
									
										 <th><?= $this->lang->line('Employee Name ') ?></th>
                                         <th><?= $this->lang->line('Document Type') ?></th>
										 <th><?= $this->lang->line('Dcoument File Name') ?></th>
										 <th><?= $this->lang->line('Expiration Date') ?></th>
										 <th><?= $this->lang->line('Day to Expire') ?></th>
										 <th><?= $this->lang->line('Day to Alert') ?></th>
										 <th><?= $this->lang->line('Remaining Days') ?></th>
                                        <th style="text-align:center;"><?= $this->lang->line(' Ref.No') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach ($licenses as $licensess) { 
							
									   
									?>
                                        <tr>
                                            <td><?php echo $licensess['license_id']; ?></td>
                                             <td><a href ="employees/edit_employee/<?php echo $licensess['employee_id'];?>"><?php echo $licensess['name']; ?></a></td>
                                            <td><?php echo $licensess['license_name']; ?></td>
                                            <td><?php if($licensess['attachments'][0]['file']){
												echo substr($licensess['attachments'][0]['file'],0,20).'...'; 
											}												?></td>
                                            <td><?php echo $licensess['license_expiry']; ?></td>
                                            <td><?php 
											$date1 = date('Y-m-d');
											 $diff = strtotime($licensess['license_expiry']) - strtotime($date1);
											 $remaining_days_diff = strtotime($date1) - strtotime($licensess['license_expiry']);
                                             $remaining_days = round($remaining_days_diff / 86400); 
											  // 1 day = 24 hours
											  // 24 * 60 * 60 = 86400 seconds
											  $day_left = round($diff / 86400); 
                                              $current_remaining_days = $day_left - $licensess['days_to_alert'];
											  if ($day_left > 0)
											  {
												  echo $day_left;
											  }
											  else
											  {
												?>
													<p style="color:red;"><?php echo $day_left;?></p>
													<?php
											  }
											?></td>

                                            
                                            <td><?php echo $licensess['days_to_alert']; ?></td>
                                            <td>
                                                <?= 
                                                    $day_left < 0 ? "<p class='text-danger'>EXPIRED</p>" : $current_remaining_days;
                                                ?>
                                            </td>
                                            <td><?php echo $licensess['license_number']; ?></td>
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
table#DataTables_Table_0 {
    border-top: 1px #ddd solid !IMPORTANT;
}
</style>
<?php $this->load->view('layout/footer')?>



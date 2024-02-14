<?php $this->load->view('layout/header', array('title' => $this->lang->line('Calendar'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE, 'magicsuggest' => TRUE)) ?>
<?php
//$msg=$this->input->get('msg', TRUE);
if($res)
{
   echo "<script>alert('Email sent successfully')</script>";
   ?>
 <script>
 var burl = '<?php echo base_url();?>';
//Using setTimeout to execute a function after 5 seconds.
setTimeout(function () {
//Redirect with JavaScript
window.location.href= burl+'schedule/index';
}, 200);
</script>
<?php 

}
// else
// {
	// echo "<script>alert('message not sent')</script>";
	
// }

?>
<style>
.fc button{text-transform:capitalize}.schedule-popover{right:0;top:22px;left:auto}.fc-content{text-align:right}.fc-slats{display:none!important}.fc-add_pdf-button{background:red;color:#fff;padding:left: 1;padding-left:23px;padding-right:23px;font-size:16px}.hover_text{position:absolute;background:#000;color:#fff;font-size:13px;width:894px;padding:13px 6px;text-align:center;border-radius:20px;display:none;left:85%;top:17px;z-index:99;float:right;cursor:pointer}.on_hover span img{width:15px;margin-left:3px}.on_hover:hover>.hover_text{display:block}.fc-content span span:last-child{margin-right:96px}.fc-time-grid-container td.fc-today{background:#fefefe}.fc-time-grid-container td{border-width:0!important}.fc-time-grid-container{height:auto!important}.fc-center h2{color:red;font-weight:500}.fc-view.fc-agendaDay-view td.fc-head-container.fc-widget-header th.fc-axis.fc-widget-header{display:none}.fc-view.fc-agendaDay-view.fc-agenda-view .fc-content-skeleton tr td.fc-axis{display:none}.fc-agendaWeek-view #uptimeee{display:none!important}.fc-agendaWeek-view span#updateeee{display:none}.fc-agendaWeek-view .fc-content span.btn{white-space:normal;margin-left:0!important;text-align:left}.fc-agendaWeek-view .fc-content span span:last-child{margin-right:0;float:left!important}
</style>
<script>
    $('document').ready(function () {
		var burl = '<?php echo base_url();?>';
		var uri = window.location.toString();
	if (uri.indexOf("?") > 0) {
	    var clean_uri = uri.substring(0, uri.indexOf("?"));
	    window.history.replaceState({}, document.title, clean_uri);
	}
		 $('#calendar').fullCalendar({
			
			customButtons: {
				add_pdf: {
					text: 'PDF',
					click: function() {
						//alert("hiii");
						 var moment = $('#calendar').fullCalendar('getDate');
						var currrdate=  moment.format();
					 window.location.href = burl+'schedule/print_all_schedule/'+currrdate ;
					}
				},
				
				add_monthpdf: {
					text: 'Monthly Report',
					click: function() {
						//alert("hiii");
			 var moment = $('#calendar').fullCalendar('getmonth');
			
window.location.href =burl+'schedule/printschedule_month/?emp="<?=$employee_id ?>"';
					}
				}
			},
            header: {
                left: 'prev,next today, add_pdf add_monthpdf',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
			agenda: {
		  eventLimit: false, // adjust to 6 only for agendaWeek/agendaDay
			},
			 views: {
			month: { // name of view
			   eventLimit: true,
			  // other view-specific options here
			}
			 },
			 
			
            defaultView: 'month',
            defaultDate: '<?= date("Y-m-d") ?>',
            editable: true,
             // allow "more" link when too many events
            events: {
                url: 'schedule/calendar/<?= $employee_id ?>/<?= $schedule_item_id ?>',
                error: function () {
                    $('#script-warning').show();
                }
            },
		
			eventDrop: function(info) {
    // alert( );
	// console.log(currentDate.toDate());
	// console.log(info.id);
	
	 console.log(info.start);
	 console.log(info.end);
	// console.log(info.title);
		var id= info.id;
		var sd= info.start._d;
		var date    = new Date(sd);
   var  yr      = date.getFullYear();
   var month=  date.getMonth() + 1;
   var  mth   = month < 10 ? '0' + month : month;
   //var m= month++;
 
    var day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate();
	
   var  newDate = yr + '-' + mth + '-' + day;
console.log(newDate);
	$.ajax({
		type: "POST",
            url: 'schedule/drag_drop_schedule/' + id,
			data: { sid: id, sd: newDate },
            success: function (resp) {
                //console.log(resp);
				window.location.href=burl+"schedule/index";
            }
        });

    // if (!confirm("Are you sure about this change?")) {
      // info.revert();
    // }
  },
			
			  //events: [
    // {
      // title: 'Meeting',
      // start: '2019-05-21',
      // end: '2019-05-25'
    // }
  // ],
            loading: function (bool) {
                $('#loading').toggle(bool);
            },
            eventMouseover: function (event, jsEvent, view) {
                var buttons = '<div class="schedule-popover">';
                buttons += '<button title="Edit" type="button" class="btn btn-outline btn-success btn-xs" onclick="window.location=\'schedule/edit_schedule/' + event.id + '\'" >';
                buttons += '<i class="fa fa-edit"></i>';
                buttons += '</button> &nbsp;&nbsp;';
                buttons += '<button title="Delete" type="button" class="btn btn-outline btn-danger btn-xs" onclick="confirm(\'Delete Schedule?\') && deleteSchedule(' + event.id + ')" >';
                buttons += '<i class="fa fa-trash-o"></i>';
                buttons += '</button>&nbsp;&nbsp;';
				buttons += '<button title="Email" type="button" class="btn btn-outline btn-success btn-xs" onclick="window.location=\'schedule/email_emp/' + event.id + '\'" >';
                buttons += '<img src="http://wshrms.peza.com.ph/images/email-icon.png " style="width:15px; height:10px; border-radius:2px;">';
                buttons += '</button>';
                buttons += '</div>';
                $(this).append(buttons);
            },
            eventMouseout: function (event, jsEvent, view) {
                $('.schedule-popover').remove();
            }
        });
        var ms = $('#employee').magicSuggest({
            placeholder: 'Filter By Employee',
            allowFreeEntries: false,
            data: 'schedule/find_employee',
            maxSelection: 1

        });
<?php if (!is_null($employee_id) && $employee_id != 0) { ?>
            ms.setSelection([{name: '<?= $employee['name'] ?>', id:<?= $employee['employee_id'] ?>}]);
<?php } ?>
        $(ms).on('selectionchange', function (e, m) {
            //window.location.href = 'schedule/index/' + this.getValue();
        });

        var schedule_type = $('#schedule_type').magicSuggest({
            placeholder: 'Filter By Type',
            allowFreeEntries: false,
            data: 'schedule/find_schedule_item',
            maxSelection: 1

        });
<?php if (!is_null($schedule_item)) { ?>
            schedule_type.setSelection([{name: '<?= $schedule_item['name'] ?>', id:<?= $schedule_item['id'] ?>}]);
<?php } ?>

        $('#filter-button').click(function (e) {
            e.preventDefault();
            var emp_id = (ms.getValue() != '') ? ms.getValue() : 0;
            var schedule_item_id = (schedule_type.getValue() != '') ? schedule_type.getValue() : 0;
            //if (emp_id != 0 || schedule_item_id != 0) {
                window.location.href = 'schedule/index/' + emp_id + '/' + schedule_item_id;
            //}
        });
		// $('.fc-agendaWeek-button').click(function (e) {
            // alert("hiii");
			// $(".f-title #uptimeee").hide();
        // });
		// $('.fc-agendaDay-button').click(function (e) {
            // alert("fgvhdf");
			// $("#uptimeee").show();
        // });
		
		
	
    });
    function deleteSchedule(id) {
        $('#save_result').html('<img src="images/ajax-loader.gif" />');
        $.ajax({
            url: 'schedule/delete_schedule/' + id,
            success: function (data) {
                response = $.parseJSON(data);
                if (response.error != 1) {
                    $('#calendar').fullCalendar('removeEvents', id);
                    $("#save_result").html('<?php $this->load->view('layout/success', array('message' => $this->lang->line('Deleted'))) ?>');
                } else {
                    $("#save_result").html('<?php $this->load->view('layout/error', array('message' => $this->lang->line('Error! Cannot delete event. Please try again!'))) ?>');
                }
            }
        });
    }

</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_calendar')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
		<script>
    $('document').ready(function () {
		$(document).on('click', '.abc', function(){
			 var vall = $(this).closest('td').attr('data-date');			
			window.location.href = burl+"schedule/new_schedule/?selected="+vall;
		 });
		 
		 $(document).on('click', '#emailemployee', function(id){
			 var vall = $(this).val;
alert(vall);			 
			//window.location.href = "http://uplushrms.peza.com.ph/schedule/new_schedule/?selected="+vall;
		 });
		 
		 
	});
		 
		 </script>
		
		<?php 
		if(isset($message)){
			echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		} ?>
            <div class="col-lg-3">
                <h2 class="on_hover"><?= $this->lang->line('Schedule Calendar') ?><span><img title="In calendar - Indicate daily highlights, issues, problems which needs to be 
reported and shared. Ordinary Task will be recorded under employee's task."src="images/if_Help.png" width="13%"></span></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home') ?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Schedule Calendar') ?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
                <div class="form-group" style="padding-top: 30px;">
                    <input type="text" id="schedule_type" name="schedule_type">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group" style="padding-top: 30px;">
                    <input type="text" id="employee" name="employee">
                </div>
            </div>
            <div class="col-lg-1">
                <div class="form-group" style="padding-top: 30px;">
                    <a id="filter-button" class="btn btn-success">
                        <i class="fa fa-filter"></i>
                        <?= $this->lang->line('Filter') ?>
                    </a>
                </div>                
            </div>
            <div class="col-lg-2">
                <div class="title-action">                    
                    <a href="schedule/new_schedule" class="btn btn-primary">
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
                            <div id='loading'>loading...</div>
                            <div id='calendar' class="col-lg-12"></div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php
$this->load->view('layout/footer')?>
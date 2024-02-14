<?php $this->load->view('layout/header', array('title' => $this->lang->line(' Bir Calendar'), 'forms' => TRUE, 'tables' => TRUE, 'icheck' => TRUE, 'magicsuggest' => TRUE)) ?>
<style>
.schedule-popover{
	right:0px;
	top:22px;
	left:auto;
}
.fc-title{font-size: 14px;}
.fc-content{
	text-align:right;
}
.yes .testfile
	{
		
		width:20px;
		height:20px;
		border-radius:50%;
		background:red;
		display:inline-block;
		margin-left:10px;
	}
.yess .testfile2
	{
		
		width:20px;
		height:20px;
		border-radius:50%;
		background:red;
		display:inline-block;
		margin-left:10px;
	}
.no .testfile
	{
		
		width:20px;
		height:20px;
		border-radius:50%;
		background:blue;
		display:inline-block;
		margin-left:10px;
	}
.noo .testfile2
	{
		
		width:20px;
		height:20px;
		border-radius:50%;
		background:blue;
		display:inline-block;
		margin-left:10px;
	}
	
#editformentry .fa-edit
{
font-size: 16px;
margin-left: 15px;
}
	
	

</style>
<script>
    $('document').ready(function () {
		
			var defaultEvents = getJson();
		//alert("dfghdf");	
			
			
			//console.log(myJsonObj.);
	
	
// Any value represanting monthly repeat flag
var REPEAT_MONTHLY = 1;
// Any value represanting yearly repeat flag
var REPEAT_YEARLY = 2;
    
$('#calendar').fullCalendar({
  header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	},
  editable: true,
  
  defaultDate: '2018-02-10',
	eventSources: [defaultEvents],
	eventRender: function( event, element, view ) {
		//console.log(element);
		// var htm= $(".fc-event-container").find('.scheduler_basic_event .yes').html();
		// alert(htm);
		//alert(event.id);
		//alert("dgsf");
		var tit= $.trim(element.find('.fc-title').text());
		var style= $.trim(element.find('.fc-title').attr('style'));
		//alert(style);
		
       element.find('.fc-title[style="float:left"]').append('<span class="testfile"></span><span class="testfile2"></span><span id="editformentry" data-title= '+event.id+'><i class="fa fa-edit"></i></span>'); 
		
	   element.on('click', function (e) {
        e.preventDefault();
		//alert("dsfgf");
		return false
    });  
      // element.find('.fc-title').append('<span class="testfilee"></span> ');    
},
  dayRender: function( date, cell ) {
    // Get all events
    var events = $('#calendar').fullCalendar('clientEvents').length ? $('#calendar').fullCalendar('clientEvents') : defaultEvents;
		// Start of a day timestamp
    var dateTimestamp = date.hour(0).minutes(0);
    var recurringEvents = new Array();
    
		// find all events with monthly repeating flag, having id, repeating at that day few months ago  
    var monthlyEvents = events.filter(function (event) {
      return event.repeat === REPEAT_MONTHLY &&
        event.id &&
        moment(event.start).hour(0).minutes(0).diff(dateTimestamp, 'months', true) % 1 == 0
    });
    
    // find all events with monthly repeating flag, having id, repeating at that day few years ago  
    var yearlyEvents = events.filter(function (event) {
      return event.repeat === REPEAT_YEARLY &&
        event.id &&
        moment(event.start).hour(0).minutes(0).diff(dateTimestamp, 'years', true) % 1 == 0
    });

    recurringEvents = monthlyEvents.concat(yearlyEvents);

    $.each(recurringEvents, function(key, event) {
      var timeStart = moment(event.start);

      // Refething event fields for event rendering 
      var eventData = {
        id: event.id,
        allDay: event.allDay,
        title: event.title,
        description: event.description,
        start: date.hour(timeStart.hour()).minutes(timeStart.minutes()).format("YYYY-MM-DD"),
        end: event.end ? event.end.format("YYYY-MM-DD") : "",
        url: event.url,
        className: 'scheduler_basic_event',
        repeat: event.repeat
      };
			
      // Removing events to avoid duplication
      $('#calendar').fullCalendar( 'removeEvents', function (event) {
          return eventData.id === event.id &&
          moment(event.start).isSame(date, 'day');      
      });
      // Render event
      $('#calendar').fullCalendar('renderEvent', eventData, true);

    });

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
	function getJson() {
 return JSON.parse($.ajax({
     type: 'GET',
     url: 'schedule/bircalendar',
     dataType: 'json',
     global: false,
     async:false,
     success: function(data) {
         return data;
     }
 }).responseText);
}
// function toObject(arr) {
  // var defaultEvent = {};
  // for (var i = 0; i < arr.length; ++i)
    // defaultEvent[i] = arr[i];
  // return defaultEvent;
// }
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu', array('active_menu' => 'schedule_bir_calendar')) ?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header') ?>

        <div class="row wrapper border-bottom white-bg page-heading">
		<script>
    $('document').ready(function () {
		$(document).on('click', '.abc', function(){
			var burl ="<?php echo base_url();?>";
			 var vall = $(this).closest('td').attr('data-date');			
			window.location.href = burl+"schedule/new_schedule/?selected="+vall;
		 });
		 
		   $('.fc-title #editformentry').click(function (e) {
            e.preventDefault();
			var burl ="<?php echo base_url();?>";
			var datatitle =$(this).attr('data-title');
			//alert(datatitle);
			var dddd= $.trim(datatitle);
          //alert(dddd);
		   	window.location.href = burl+"schedule/newbitform_entry/?selected="+dddd;
            //}
        }); 
	});
		 
		 </script>
		
		<?php 
		if(isset($message)){
			echo '<div style="padding:5px;background-color:red;color:#fff;font-size:16px;text-align:center">'.$message.'</div>';
		} ?>
            <div class="col-lg-3">
                <h2><?= $this->lang->line('Schedule Calendar') ?></h2>
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
                    <input type="hidden" id="employee" name="employee">
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
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Self service'),'forms'=>TRUE,'tables'=>TRUE,'date_time'=>TRUE,'countdown'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        current_table = $('.data_table').dataTable({
            pageLength:5
        });
        
        $('#update_comments').click(function(){
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/update_clock_comments',{comments:$('#comments').val()},function(){
                $("#save_result2").html('');
            });
        })
        
        $("#complete_clock").click(function(){
            $('#save_result2').html('<img src="images/ajax-loader.gif" />');
            $.post('dashboard/complete_clock',{comments:$('#comments').val()},function(html){
                $("#save_result2").html('');
                $('#comments').val('');
                $('#active_clock,#start_clock').toggleClass('hide show');
                $('#punch_clock').prepend(html);
                $('#sinceCountdown').countdown('destroy');
            });
        })
        
        $('#start_clock_button').click(function(){
            $.ajax({url:'dashboard/start_clock'});
            $('#active_clock,#start_clock').toggleClass('hide show');
            start_counter(new Date());
        })
        
        
        <?php $active_clock=(isset($clock[0]) AND is_null($clock[0]['end_time']))?strtotime($clock[0]['start_time']):FALSE;
        
        if ($active_clock){?>
        start_counter(new Date(<?= date('Y',$active_clock)?>,<?= date('n',$active_clock)?>-1 ,<?= date('d',$active_clock)?>, <?= date('H',$active_clock)?>,<?= date('i',$active_clock)?>, <?= date('s',$active_clock)?>));
        <?php } ?>
    })
    
    function start_counter(start_date)
    {
        $('#sinceCountdown').countdown({since: start_date, format: 'HMS', description:' '});
    }
    
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'dashboard'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div id="save_result"></div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Punch Clock')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <?php if ($active_clock){$active_clock=array_shift($clock);}?>
                                    <div id="start_clock" class="col-lg-offset-3 m-b-sm <?= $active_clock?'hide':'show'?>">
                                        <button type="button" class="btn btn-primary btn-lg" id="start_clock_button">
                                            <i class="fa fa-thumb-tack"></i>
                                            <?= $this->lang->line('Start clock')?>
                                        </button>
                                    </div>
                                    <div id="active_clock" class="<?= $active_clock?'show':'hide'?>">
                                        <div id="sinceCountdown"></div>
                                        <div id="save_result2"></div>
                                        <div class="form-group">
                                            <label for="comments"><?= $this->lang->line('Comments')?></label>
                                            <textarea rows="3" id="comments" class="form-control"><?= $active_clock?$active_clock['comments']:''?></textarea>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-primary btn-sm" id="complete_clock">
                                                <i class="fa fa-check-circle">
                                                <?= $this->lang->line('Complete')?></i>
                                            </button>
                                            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">  
                                                <li>
                                                    <a href="#" id="update_comments" onclick="return false;"><?= $this->lang->line('Update comments')?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr class="m-b-sm m-t-sm"/>
                                    </div>
                                    <div class="feed-activity-list" id="punch_clock">
                                        <?php $this->load->view('selfservice/clock',array('clock'=>$clock))?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Leave tracking')?></h5>
                                    <a href="dashboard/new_timeoff" class="btn btn-primary btn-sm pull-right" data-target="#modal_window" data-toggle="modal">
                                        <i class="fa fa-plus-circle"></i>
                                        <?= $this->lang->line('Add')?>
                                    </a>
                                </div>
                                <div class="ibox-content">
                                    <table class="table table-striped table-bordered table-hover data_table">
                                        <thead>
                                            <tr>
                                                <th><?= $this->lang->line('Dates')?></th>
                                                <th><?= $this->lang->line('Type / Status')?></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($timeoff as $record){?>
                                                <tr entity_id="<?= $record['record_id']?>">
                                                    <td><?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['start_time']))?> - <?= date($this->config->item('date_format').' '.$this->config->item('time_format'),strtotime($record['end_time']))?></td>
                                                    <td><?= $this->lang->line(ucfirst($record['type']))?> / <?= $this->lang->line(ucfirst($record['status']))?></td>
                                                    <td>
                                                        <a class="btn btn-outline btn-success" href="dashboard/timeoff/<?= $record['record_id']?>" data-target="#modal_window" data-toggle="modal">
                                                            <i class="fa fa-briefcase"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Discipline')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        <?php foreach($discipline as $record){?>
                                        <div class="feed-element">
                                            <p class="text-justify">
                                                <a href="dashboard/discipline/<?= $record['record_id']?>" class="btn btn-sm btn-success btn-outline pull-right m-l-sm" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <span class="text-navy"><?= date($this->config->item('date_format'),strtotime($record['date']))?></span>
                                                <br/><?= $record['headline']?>
                                            </p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Skills')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        <?php foreach($skills as $skill){?>
                                        <div class="feed-element">
                                            <p class="text-justify">
                                                <a href="dashboard/assessment/<?= $skill['assessment_id']?>" class="btn btn-sm btn-success btn-outline pull-right m-l-sm" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <span class="text-navy"><?= date($this->config->item('date_format'),strtotime($skill['assessment_date']))?></span>
                                                <br/><?= $skill['assessment_name']?>
                                            </p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $this->lang->line('Performance')?></h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="feed-activity-list">
                                        <?php foreach($performance as $item){?>
                                        <div class="feed-element">
                                            <p class="text-justify">
                                                <a href="dashboard/appraisal/<?= $item['appraisal_id']?>" class="btn btn-sm btn-success btn-outline pull-right m-l-sm" data-target="#modal_window" data-toggle="modal">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                                <?php if ($item['is_completed']=='1'){?>
                                                <span class="fa fa-check"></span>
                                                <?php }?>
                                                <span class="text-navy"><?= $item['start_date']?date($this->config->item('date_format'),strtotime($item['start_date'])):'-'?> - <?= $item['end_date']?date($this->config->item('date_format'),strtotime($item['end_date'])):'-'?></span>
                                                <br/><?= $item['expectations']?>...
                                            </p>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
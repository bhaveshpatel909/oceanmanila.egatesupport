<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Appraisal'),'forms'=>TRUE,'date_time'=>TRUE)) ?>
<script src="js/jquery.raty.min.js"></script>
<script>
    $('document').ready(function(){
        $(".rating").raty({
            readOnly:true,
            score: function() {
                return $(this).attr('data-score');
            }
        });
    })
    
    function delete_log(log_id)
    {
        if(confirm('<?= $this->lang->line('Delete log?')?>'))
        {
            $("#save_result").html('<img src="images/ajax-loader.gif" />');
            $.ajax({
                url:'performance/remove_log/'+log_id,
                success:function(html){
                    $("#save_result").html(html);
                    $("#log_"+log_id).remove();
                }
            })
        }
    }
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'performance'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $appraisal['name']?>, [<?= $appraisal['department_name']?$appraisal['department_name']:'-'?>] <?= $appraisal['position_name']?$appraisal['position_name']:'-'?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Performance')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <?php if ($appraisal['is_completed']=='0'){?>
                    <div class="btn-group">
                        <button type="button" onclick="submit_form('#save_appraisal')" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            <?= $this->lang->line('Save')?> 
                        </button>
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="performance/new_log/<?= $appraisal['appraisal_id']?>" data-target="#modal_window" data-toggle="modal">
                                    <?= $this->lang->line('Add log')?>
                                </a>
                            </li>
                            <li>
                                <a href="performance/mark_completed/<?= $appraisal['appraisal_id']?>" data-target="#modal_window" data-toggle="modal">
                                    <?= $this->lang->line('Mark as completed')?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php }?>
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
                            <form action="performance/save_appraisal" method="POST" id="save_appraisal">
                                <input type="hidden" name="appraisal_id" id="appraisal_id" value="<?= $appraisal['appraisal_id']?>">
                                <input type="hidden" name="employee_id[]" id="employee_id" value="<?= $appraisal['employee_id']?>">
                                <div class="col-lg-2">
                                    <img src="<?= $appraisal['avatar']?>" class="img-circle">
                                </div>
                                <div class="col-lg-7">
                                    <div class="col-lg-6" style="padding-left: 0px;">
                                        <div class="form-group">
                                            <label for="start_date" class="control-label"><?= $this->lang->line('Start date')?></label>
                                            <?php if ($appraisal['is_completed']=='1'){?>
                                            <p><?= ($appraisal['start_date'])?date($this->config->item('date_format'),strtotime($appraisal['start_date'])):''?></p>
                                            <?php }else{?>
                                            <input type="text" name="start_date" id="start_date" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= ($appraisal['start_date'])?date($this->config->item('date_format'),strtotime($appraisal['start_date'])):''?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="end_date" class="control-label"><?= $this->lang->line('End date')?></label>
                                            <?php if ($appraisal['is_completed']=='1'){?>
                                            <p><?= ($appraisal['end_date'])?date($this->config->item('date_format'),strtotime($appraisal['end_date'])):''?></p>
                                            <?php }else{?>
                                            <input type="text" name="end_date" id="end_date" class="form-control datetimepicker" data-date-format="<?= $this->config->item('js_month_format')?>" value="<?= ($appraisal['end_date'])?date($this->config->item('date_format'),strtotime($appraisal['end_date'])):''?>">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group has-feedback">
                                        <label for="expectations" class="control-label"><?= $this->lang->line('Expectations')?><?= ($appraisal['is_completed']=='0')?'<sup class="mandatory">*</sup>':''?></label>
                                        <?php if ($appraisal['is_completed']=='1'){?>
                                        <p class="text-justify"><i><?= $appraisal['expectations']?></i></p>
                                        <?php }else{?>
                                        <textarea rows="5" name="expectations" id="expectations" class="form-control required"><?= $appraisal['expectations']?></textarea>
                                        <?php }?>
                                    </div>
                                    <?php if ($appraisal['is_completed']=='1'){?>
                                    <div class="form-group">
                                        <label class="control-label"><?= $this->lang->line('Results')?></label>
                                        <p class="text-justify"><i><?= $appraisal['results']?></i></p>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <div class="clearfix"></div>
                            <hr/>
                            <h2 class="m-l-lg"><?= $this->lang->line('Logs')?></h2>
                            <div class="feed-activity-list col-lg-7 m-l-lg" id="performance_logs">
                                <?php foreach($logs as $log){?>
                                <div class="feed-element" id="log_<?= $log[0]['log_id']?>">
                                    <div class="pull-right">
                                        <span class="text-navy"><?= date($this->config->item('date_format'),strtotime($log[0]['date']))?></span>
                                        <?php if ($appraisal['is_completed']=='0'){?>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="delete_log(<?= $log[0]['log_id']?>)">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                        <?php }?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p class="text-justify"><?= $log[0]['comment']?></p>
                                    <ul class="unstyled">
                                        <?php foreach($log as $item){?>
                                        <?php if ($item['criteria_result']>0){?>
                                        <li>
                                            <?= $item['criterion_name']?>
                                            <span class="rating" data-score="<?= $item['criteria_result']?>"></span>
                                        </li>
                                        <?php }?>
                                        <?php }?>
                                    </ul>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
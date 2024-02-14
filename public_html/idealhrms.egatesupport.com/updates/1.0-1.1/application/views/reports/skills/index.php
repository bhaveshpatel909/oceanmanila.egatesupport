<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Reports'),'forms'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#report_type').change(function(){
            switch($('#report_type').val())
            {
                case 'gap_department':{
                    $('#report_options').show().html('<img src="images/ajax-loader.gif" />');
                    $.ajax({
                        url:'reports/get_departments',
                        success:function(html){
                            $('#report_options').html(html);
                        }
                    })
                    break;
                }
                default:{
                    $('#report_options').hide();
                    break;
                }
            }
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'reports_skills'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Skills')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Reports')?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="row">
                        <div class="col-lg-12 m-b-md">
                            <div class="col-lg-3">
                                <form action="reports/proccess_report" method="POST" id="proccess_report">
                                    <input type="hidden" name="report_category" id="report_category" value="skills">
                                    <div class="form-group has-feedback">
                                        <label for="report_type" class="control-label"><?= $this->lang->line('Report')?><sup class="mandatory">*</sup></label>
                                        <select name="report_type" id="report_type" class="form-control required">
                                            <optgroup label="<?= $this->lang->line('Gap analysis')?>">
                                                <option value="gap_department"><?= $this->lang->line('By department')?></option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div id="report_options">
                                        <?php $this->load->view('reports/departments')?>
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#proccess_report')">
                                        <i class="fa fa-bar-chart-o"></i>
                                        <?= $this->lang->line('Get results')?>
                                    </button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div class="col-lg-9">
                                <div id="save_result"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
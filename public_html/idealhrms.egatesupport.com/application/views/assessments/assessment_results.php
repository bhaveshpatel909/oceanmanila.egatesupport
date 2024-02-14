<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Assessment results'),'forms'=>TRUE)) ?>
<script src="js/jquery.raty.min.js"></script>
<script>
    $('document').ready(function(){
        $(".rating").raty({
            cancel:true,
            score: function() {
                return $(this).attr('data-score');
            },
            hints: ['<?= $this->lang->line('Recognizes a technology or technique, knows its purpose, can describeit, and understand its value and limitations')?>',
                    '<?= $this->lang->line('Has attended a relevant course or training that covers principles and can explain and apply technology under supervision')?>',
                    '<?= $this->lang->line('Applies the knowledge and skills, regulary and independently, in projects and can demonstrate their use')?>',
                    '<?= $this->lang->line('Advises others engaged in applying the skill and can teach or mentor others. Has applied the technology on numerous projects in several diverse, complex areas')?>',
                    '<?= $this->lang->line('Advises the company on the strategic value and direction of the technology. Is considered an authority on the technology by peers and company')?>']
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'assessments'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $employee['name']?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Skills')?>
                    </li>
                    <li>
                        <?= $this->lang->line('Assessments')?>
                    </li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <button type="button" class="btn btn-primary" onclick="submit_form('#save_results')">
                        <i class="fa fa-save"></i>
                        <?= $this->lang->line('Save')?>
                    </button>
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
                            <form action="skills/save_results" method="POST" id="save_results">
                                <input type="hidden" name="employee_id" id="employee_id" value="<?= $employee_id?>">
                                <input type="hidden" name="assessment_id" id="assessment_id" value="<?= $assessment_id?>">
                                
                                <ul class="unstyled no-padding">
                                    <?php foreach($results as $result){?>
                                    <li>
                                        <strong><?= $result[0]['category_name']?></strong>
                                        <ul class="unstyled">
                                        <?php foreach($result as $index=>$item){?>
                                            <li>
                                                <div class="form-group col-lg-8">
                                                    <?= $item['skill_name']?>
                                                    <div class="rating" data-score="<?= $item['level']?>" data-score-name="levels[<?= $item['skill_id']?>]"></div>
                                                    <textarea rows="3" class="form-control" name="comments[<?= $item['skill_id']?>]" id="comment_<?= $index?>"><?= $item['comment']?></textarea>
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                        <?php }?>
                                        </ul>
                                    </li>
                                    <?php }?>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
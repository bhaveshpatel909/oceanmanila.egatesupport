<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Compose mail'),'forms'=>TRUE,'magicsuggest'=>TRUE)) ?>
<script>
   /*  $('document').ready(function(){
        $('#employees').magicSuggest({
            allowFreeEntries:false,
            data:'mailbox/find_admin'
        });
        $('#departments').magicSuggest({
            allowFreeEntries:false,
            data:'mailbox/find_department'
        });
        $('#positions').magicSuggest({
            allowFreeEntries:false,
            data:'mailbox/find_position'
        });
    }) */
</script>
<?php //echo'<pre>'; print_r($details);die('dffdfdf');?>

<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'mailbox'))?>
    <div id="page-wrapper" class="gray-bg"> 
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Compose mail')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li><?= $this->lang->line('Mailbox')?></li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div id="save_result"></div>
                            <form action="mailbox/send_mailtoadmin" method="POST" id="create_thread">
                                
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#employees_tab" data-toggle="tab"><?= $this->lang->line('Employees')?></a></li>
                                 <!-- <li><a href="#departments_tab" data-toggle="tab"><?= $this->lang->line('Departments')?></a></li>
                                  <li><a href="#positions_tab" data-toggle="tab"><?= $this->lang->line('Positions')?></a></li>-->
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="m-t-sm"></div>
                                    <div class="tab-pane fade active in" id="employees_tab">
                                        <input type="text" id="employees1" class="form-control" name="employees1" value="Admin" readonly>
										
										
                                        <input type="hidden" id="employees" name="employees"  value="1" readonly>
                                    </div>
                                   <!-- <div class="tab-pane" id="departments_tab">
                                        <input type="text" id="departments" name="departments">
                                    </div>
                                    <div class="tab-pane" id="positions_tab">
                                        <input type="text" id="positions" name="positions">
                                    </div>-->
                                </div>
        							 
                                <div class="col-lg-9">
                                    <div class="form-group has-feedback m-t-sm">
                                        <label for="subject"><?= $this->lang->line('Subject')?><sup class="mandatory">*</sup></label>
                                        <input type="text" name="subject" id="subject" class="form-control" value="Request Change of My information" >
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="message"><?= $this->lang->line('Message')?><sup class="mandatory">*</sup></label>
                                        <textarea rows="4" name="message" id="message" class="form-control required"></textarea>
                                    </div>
                                    <!--<div class="form-group">
									<input type="file" multiple="multiple" name="userfile[]" id="userfile">
									
                                        <?php //$this->load->view('mix/attachments_list',array('attachments'=>array()))?>
                                    </div>-->
                                    <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#create_thread')">
                                        <span class="fa fa-send-o"></span>
                                        <?= $this->lang->line('Send')?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
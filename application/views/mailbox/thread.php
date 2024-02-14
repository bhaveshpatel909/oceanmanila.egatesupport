<?php $this->load->view('layout/header',array('title'=>$thread['thread']['subject'],'forms'=>TRUE)) ?>
<script>
    var pages=<?= $thread['amount']?>,current_page=1;
    $('document').ready(function(){
        $('#show_more').click(function(){
            $('#show_more').html('<img src="images/ajax-loader.gif" />');
            current_page++;
            $.ajax({
                url:'mailbox/messages/<?= $thread['thread']['thread_id']?>/'+current_page,
                success:function(messages)
                {
                    $('#show_more').html('<i class="fa fa-arrow-up"></i><?= $this->lang->line('Show More')?>');
                    $("#messages_list").prepend(messages);
                    if (pages<current_page)
                    {
                        $("#show_more").remove();
                    }
                }
            })
        })
        
        $('.remove_message').on('click',function(){
            message_id=$(this).attr('message_id');
            $.ajax({
                url:'mailbox/remove_message/'+message_id
            })
            $('#message_'+message_id).remove();
        })
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'mailbox'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $thread['thread']['subject']?></h2>
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
                            <?php if ($thread['amount']>1){?>
                            <button class="btn btn-primary btn-block m-b-lg" id="show_more">
                                <i class="fa fa-arrow-up"></i>
                                <?= $this->lang->line('Show More')?>
                            </button>
                            <?php }?>
                            <div class="feed-activity-list" id="messages_list">
                                <?php $this->load->view('mailbox/messages',array('messages'=>$thread['messages']))?>
                            </div>
                            <form action="mailbox/send_message" method="POST" id="send_message">
                                <div id="save_result"></div>
                                <input type="hidden" name="thread_id" id="thread_id" value="<?= $thread['thread']['thread_id']?>">
                                <div class="col-lg-9">
                                    <div class="form-group has-feedback">
                                        <label for="message"><?= $this->lang->line('Message')?><sup class="mandatory">*</sup></label>
                                        <textarea rows="4" name="message" id="message" class="form-control required"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <?php $this->load->view('mix/attachments_list',array('attachments'=>array(),'readonly'=>FALSE))?>
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" onclick="submit_form('#send_message')">
                                        <span class="fa fa-send-o"></span>
                                        <?= $this->lang->line('Send')?>
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Mailbox'),'forms'=>TRUE,'scroll'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#threads_list').infinitescroll({
            navSelector      : "#next:last",
            nextSelector     : "a#next:last",
            itemSelector     : "tr",
            dataType         : 'html',
            loading:{
                msgText          : '<?= $this->lang->line('Processing')?>',
                finishedMsg      : '',    
            },
            maxPage          : <?= $threads['amount']?>,
            path: function(index) {return 'mailbox/threads/'+index;}
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'mailbox'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Inbox')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li><?= $this->lang->line('Mailbox')?></li>
                </ol>
            </div>
            <div class="col-lg-4">
                <div class="title-action">
                    <a href="mailbox/compose_mail" class="btn btn-primary">
                        <i class="fa fa-envelope"></i>
                        <?= $this->lang->line('Compose Mail')?>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="mail-box">
                        <a id="next" class="hide" href="#">#</a>
                        <table class="table table-hover table-mail" id="threads_list">
                            <tbody>
                                <?php $this->load->view('mailbox/threads')?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer')?>
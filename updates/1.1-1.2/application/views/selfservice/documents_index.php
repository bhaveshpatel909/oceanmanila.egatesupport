<?php $this->load->view('layout/header',array('title'=>$this->lang->line('My documents'),'forms'=>TRUE,'scroll'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#documents_list').infinitescroll({
            navSelector      : "#next:last",
            nextSelector     : "a#next:last",
            itemSelector     : "div.document_area",
            dataType         : 'html',
            loading:{
                msgText          : '<?= $this->lang->line('Processing')?>',
                finishedMsg      : '',    
            },
            maxPage          : <?= $documents['amount']?>,
            path: function(index) {return 'dashboard/my_documents/'+index+'?search=<?= ($search?$search:'')?>'}
        });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'my_documents'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('My documents')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Selfservice')?>
                    </li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInDown">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12 m-b-md">
                                <div class="search-form">
                                    <form action="documents" method="GET">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control input-lg" value="<?= ($search)?$search:''?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-primary" type="submit"><?= $this->lang->line('Search')?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <a id="next" class="hide" href="#">#</a>
                            <div id="documents_list">
                                <?php $this->load->view('selfservice/documents_list')?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
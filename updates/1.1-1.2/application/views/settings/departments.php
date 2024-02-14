<?php $this->load->view('layout/header',array('title'=>$this->lang->line('Departments'),'forms'=>TRUE,'tables'=>TRUE,'jstree'=>TRUE)) ?>
<script>
    $('document').ready(function(){
        $('#tree')
                .jstree({
                    'core' : {
                        'data' : {
                            'url' : function (node){
                                return 'settings/view_department/'+node.id;
                            },
                            'dataType':'json'
                        },
                        'check_callback' : function(o, n, p, i, m) {
                            if(m && m.dnd && m.pos !== 'i') { 
                                return false; 
                            }
                            if(o === "move_node") {
                                if(this.get_node(n).parent === this.get_node(p).id) { 
                                    return false; 
                                }
                            }
                            return true;
                        }
                    },
                    'contextmenu' : {
                        'items' : function(node) {
                            var tmp = $.jstree.defaults.contextmenu.items();
                            delete tmp.ccp;
                            return tmp;
                        }
                    },
                    'types' : {
                        'default' : { 'icon' : 'folder' },
                        'file' : { 'valid_children' : [], 'icon' : 'file' }
                    },
                    'plugins' : ['state','dnd','contextmenu','unique']
                })
                .on('delete_node.jstree', function (e, data) {
                    if (confirm('<?= $this->lang->line('Delete department ?')?>'))
                    {
                        $.get('settings/delete_department/'+data.node.id)
                         .fail(function () {
                             data.instance.refresh();
                         });    
                    }
                })
                .on('create_node.jstree', function (e, data) {
                    $.get('settings/create_department', {'parent_department' : data.node.parent, 'department_name' : data.node.text,'department_id':0 })
                        .done(function (d) {
                            data.instance.set_id(data.node, d.id);
                        })
                        .fail(function () {
                            data.instance.refresh();
                        });
                })
                .on('rename_node.jstree', function (e, data) {
                    $.get('settings/rename_department', { 'department_id' : data.node.id, 'department_name' : data.text })
                        .done(function (d) {
                            data.instance.set_id(data.node, d.id);
                        })
                        .fail(function () {
                            data.instance.refresh();
                        });
                })
                .on('move_node.jstree', function (e, data) {
                    $.get('settings/move_department', { 'department_id' : data.node.id, 'new_parent' : data.parent })
                        .done(function (d) {
                            //data.instance.refresh();
                        })
                        .fail(function () {
                            data.instance.refresh();
                        });
                });
    })
</script>
<div id="wrapper">
    <?php $this->load->view('layout/menu',array('active_menu'=>'departments'))?>
    <div id="page-wrapper" class="gray-bg">
        <?php $this->load->view('layout/page_header')?>
        
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-8">
                <h2><?= $this->lang->line('Departments')?></h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="dashboard"><?= $this->lang->line('Home')?></a>
                    </li>
                    <li>
                        <?= $this->lang->line('Settings')?>
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
                            <div id="save_result"></div>
                            <div id="tree"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php $this->load->view('layout/footer')?>
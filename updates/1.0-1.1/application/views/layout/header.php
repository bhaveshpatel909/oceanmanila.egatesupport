<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?= $this->config->item('base_url')?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.js"></script>
    
    <?php if (isset($forms)){?>
    <script src="js/forms.min.js"></script>
    <?php }?>
    
    <?php if (isset($icheck)){?>
    <link href="css/icheck/green.css" rel="stylesheet">
    
    <script src="js/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            init_icheck();
        });
    </script>
    <?php }?>
    
    <?php if (isset($steps)){?>
    <link href="css/jquery.steps.css" rel="stylesheet">
    <script src="js/jquery.steps.min.js"></script>
    <?php }?>
        
    <?php if (isset($scroll)){?>
    <script src="js/jquery.infinitescroll.min.js"></script>
    <?php }?>
    
    <?php if (isset($date_time)){?>
    <link href="css/bootstrap3-datetimepicker.min.css" rel="stylesheet">
    <script src="js/moment-with-langs.min.js"></script>
    <script src="js/bootstrap3-datetimepicker.min.js"></script>
    <?php }?>
    
    <?php if (isset($tables)){?>
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <?php }?>
    
    <?php if (isset($jstree)){?>
    <link href="css/jstree.min.css" rel="stylesheet">
    <script src="js/jstree.min.js"></script>
    <?php }?>
    
    <?php if (isset($magicsuggest)){?>
    <link href="css/magicsuggest-min.css" rel="stylesheet">
    <script src="js/magicsuggest-min.js"></script>
    <?php }?>
    
    <?php if (isset($countdown)){?>
    <link href="css/jquery.countdown.css" rel="stylesheet">
    <script src="js/jquery.countdown.min.js"></script>
    <?php }?>
    
    <link href="css/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/jquery.gritter.css" rel="stylesheet">
    
    <script src="js/jquery.metisMenu.js"></script>
    <script src="js/inspinia.js"></script>
    
</head>
<body>
    <div id="modal_window"></div>
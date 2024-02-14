<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="<?= $this->config->item('base_url') ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="js/summernote/summernote.css" rel="stylesheet">
        <link href="js/select2/css/select2.css" rel="stylesheet">
        
        <link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='js/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='js/fullcalendar/lib/moment.min.js'></script>
        <script src="js/jquery-1.10.2.js"></script>
        <script src='js/fullcalendar/fullcalendar.min.js'></script>
        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/summernote/summernote.min.js"></script>
        <script src="js/bootstrap-filestyle.min.js"></script>
        
        
        <!--<link rel="stylesheet" href="js/imageselect/css/demo.css">-->
    <link rel="stylesheet" href="js/imageselect/css/buttons.css">
    <link rel="stylesheet" href="js/imageselect/css/imgSelect.css">
        <script src="js/select2/js/select2.min.js"></script>
    <script src="js/imageselect/js/jquery.Jcrop.min.js"></script>
    <script src="js/imageselect/js/imgSelect.js"></script>

        <?php if (isset($forms)) { ?>
            <script src="js/forms.min.js"></script>
        <?php } ?>

        <?php if (isset($icheck)) { ?>
            <link href="css/icheck/green.css" rel="stylesheet">

            <script src="js/icheck.min.js"></script>
            <script>
                $(document).ready(function () {
                    init_icheck();
                });
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            </script>
        <?php } ?>
	

        <?php if (isset($steps)) { ?>
            <link href="css/jquery.steps.css" rel="stylesheet">
            <script src="js/jquery.steps.min.js"></script>
        <?php } ?>

        <?php if (isset($scroll)) { ?>
            <script src="js/jquery.infinitescroll.min.js"></script>
        <?php } ?>

        <?php //if (isset($date_time)){?>
        <link href="css/bootstrap3-datetimepicker.min.css" rel="stylesheet">
        <script src="js/moment-with-langs.min.js"></script>
        <script src="js/bootstrap3-datetimepicker.min.js"></script>
        <?php //}?>

        <?php if (isset($tables)) { ?>
            <link href="css/dataTables.bootstrap.css" rel="stylesheet">
            <script src="js/jquery.dataTables.js"></script>
            <script src="js/dataTables.bootstrap.js"></script>
        <?php } ?>

        <?php if (isset($jstree)) { ?>
            <link href="css/jstree.min.css" rel="stylesheet">
            <script src="js/jstree.min.js"></script>
        <?php } ?>

        <?php if (isset($magicsuggest)) { ?>
            <link href="css/magicsuggest-min.css" rel="stylesheet">
            <script src="js/magicsuggest-min.js"></script>
        <?php } ?>

        <?php if (isset($countdown)) { ?>
            <link href="css/jquery.countdown.css" rel="stylesheet">
            <script src="js/jquery.countdown.min.js"></script>
        <?php } ?>

        <link href="css/morris-0.4.3.min.css" rel="stylesheet">
        <link href="css/jquery.gritter.css" rel="stylesheet">

        <link href="js/bs-slider/css/bootstrap-slider.css" rel="stylesheet">
        <script src="js/bs-slider/bootstrap-slider.js"></script>

        <script src="js/jquery.metisMenu.js"></script>
        <script src="js/inspinia.js"></script>

        <script src="js/autoNumeric.min.js"></script>
        <script src="js/jquery.knob.min.js"></script>
        <link href="js/bs-lightbox/ekko-lightbox.min.css" rel="stylesheet">
        <script src="js/bs-lightbox/ekko-lightbox.min.js"></script>
        <link href="js/bs-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <script src="js/bs-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="js/webcamjs/webcam.js"></script>

    </head>
    <body>
        <div id="modal_window"></div>
        <div id="modal_windoww"></div>
        <div id="modal_windowww"></div>
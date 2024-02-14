<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
	
<!--        <div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div>-->
        <div class="clearfix"></div>
        <div></div>

		
    </div>
    <div class="pdf-content">
        <p class="">
<?php echo $document['content'] ?> <br>
 <pre>
        <?php //var_dump($evaluation) ?>
    </pre>
</div>
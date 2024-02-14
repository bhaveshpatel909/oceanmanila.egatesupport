<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
		<div class="pull-left" style="float: none; margin:0px auto; width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
		<div class="pull-right" style="float: right; width: 20%;">
            <img class="images" src="<?php echo $evaluation['avatar'] ?>"/>
        </div>
        <div class="clearfix"></div>
        <div><h2 class="title" style="margin-bottom:20px;">Company Guide lines</h2></div>
		
		
    </div>
	<?php 
	//print_r($evaluation);

	?>
	
    <div class="pdf-content">
	<div style="display:inline-flex;">
      <p> <span style=" font-size: 19.0117px; font-family:sans-serif;"> Subject  : </span><?php echo $evaluation['name'] ?> </p>
		</div>
		
		
		<h3>Guidelines</h3>
		
        <p><?php echo $evaluation['company_rules'] ?></p>
        
	
		
		
		
    </div>
    <div class="pdf-footer">
        <div style="float: left;width: 40%;">
            <p style="margin-bottom: 50px;">Signed by __________________</p>
         
        </div>
        
    </div>
    <pre>
        <?php //var_dump($evaluation) ?>
    </pre>
</div>
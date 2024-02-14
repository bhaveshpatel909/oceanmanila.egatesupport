<link href="css/pdfstyle.css" rel="stylesheet">
<div class="pdf-wrapper">
    <div class="pdf-header">
        <div class="pull-left" style="float: left;width: 20%;">
            <img class="logo" src="<?php echo base_url($logo) ?>"/>
        </div>
        <!--        <div class="pull-right" style="float: right;width: 20%;text-align: right;">Letter Type</div>-->
        <div class="clearfix"></div>
        <div><h1 class="title"><?= $company_name ?></h1></div>
    </div>
    <div class="pdf-content">
<!--        Date: <?php echo date($this->config->item('date_format_pdf'), strtotime($letter['letter_date'])); ?> <br><br>
        To: <?php echo $letter['letter_to'] ?> <br>-->
        <table style="border: 0 none;" cellpadding="5">
            <?php 
                if($letter['display_date'] == 1){
            ?>
                <tr>
                    <td style="border: 0 none;font-weight: bold;" valign="top">Date:</td>
                    <td style="border: 0 none;" valign="top"><?php echo date($this->config->item('date_format_pdf'), strtotime($letter['letter_date'])); ?><br></td>
                </tr>
            <?php
                }
            ?>
            <?php 
                if($letter['display_letter_to'] == 1){
            ?>
                <tr>
                    <td style="border: 0 none;font-weight: bold;" valign="top">To:</td>
                    <td style="border: 0 none;" valign="top"><?php echo $letter['letter_to'] ?></td>
                </tr>
            <?php
                }
            ?>
            <?php 
                if($letter['display_attention'] == 1){
            ?>
                <tr>
                    <td style="border: 0 none;font-weight: bold;" valign="top">ATTN:</td>
                    <td style="border: 0 none;line-height: 18px;" valign="top"><?php echo $letter['attention'] ?></td>
                </tr>
            <?php
                }
            ?>
           
            <tr>
                <td style="border: 0 none;" valign="top"></td>
                <td style="border: 0 none;" valign="top">&nbsp;</td>
            </tr>
        </table>
        <table style="border: 0 none;" cellpadding="5">
            <?php 
                if($letter['display_regarding'] == 1){
            ?>
                <tr>
                    <td style="border: 0 none;font-weight: bold;" valign="top">Regarding:</td>
                    <td style="border: 0 none;" valign="top"><?php echo $letter['regarding'] ?></td>
                </tr>
            <?php
                }
            ?>
           
            <tr>
                <td style="border: 0 none;" valign="top"></td>
                <td style="border: 0 none;" valign="top">&nbsp;</td>
            </tr>
        </table>
        <?php 
            if($letter['display_content'] == 1){
        ?>
            <div style="padding: 0 5px;"><?php echo $letter['content'] ?></div>
        <?php
            }
        ?>

    </div>

</div>
<?php 
    foreach ($assets as $asset) {
    
?>
<div class="ibox float-e-margins">
                                
    <div class="ibox-title collapse-link" id="employees_assetbenefits_click">
        <h5><?php echo $asset['employee']['name']?></h5>
    </div>
    <div class="ibox-content" id="employees_assetbenefits" ajax_link="employees/assetbenefits/82">
        <div class="feed-activity-list" id="assetbenefit_list">
            <div class="feed-element" id="assetbenefit_3">
                <div class="col-lg-4">
                <strong class="assetbenefit">Name</strong>
                </div>
                <div class="col-lg-4">
                    <div><strong class="assetbenefit">Description</strong></div>
                </div>
            </div>
            <?php 
                foreach ($asset['data'] as $ass_details) {
                 
            ?>
            <div class="feed-element" id="assetbenefit_3">
                <div class="col-lg-4">
                <?php echo $ass_details['assetbenefit_name'];?>
                </div>
                <div class="col-lg-4">
                    <div><?php echo $ass_details['attachments'][0]['file'];?></div>
                </div>
            </div>
            <?php 
                }
            ?>  
        </div>									
    </div>
</div>

<?php 
}

?>
<ul class="unstyled no-padding">
    <?php foreach($skills as $category){?>
    <li>
        <strong><?= $category[0]['category_name']?></strong>
        <ul class="unstyled">
            <?php foreach($category as $skill){?>
            <li><?= $skill['skill_name']?></li>
            <?php }?>
        </ul>
    </li>
    <?php }?>
</ul>
<div class="row">
    <div class="row">
        <div class="split-container">
            <div class="split-small-element">
                <p class="split"><?=$date;?></p> 
            </div>

            <div class="split-small-element split-delimiter">
                <p class="split"><?=$time;?></p> 
            </div>
        </div>

        
    </div>

    <?php if(count($subposts) && $subposts !== '') { ?>
    <div class="row">
        <?php foreach($subposts as $subpost) { ?>
        <?=$subpost.PHP_EOL;?>
        <?php } ?>
    </div>
    <?php } ?>
</div>
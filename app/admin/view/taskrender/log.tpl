
    <div class="row clear-row log-topic-margin">
        <div class="split-container">
            <div class="split-small-element">
                <p class="split"><?=$date;?></p> 
            </div>

            <div class="split-small-element split-delimiter">
                <p class="split"><?=$time;?></p> 
            </div>
        </div>

        <div class="long-container">
            <div class="long-container-element">
                <label class="caption" for="field_from"><?=$from_title;?>:</label>
                <p id="field_from" class="caption"><?=$author;?></p>
            </div>
            
            <div class="long-container-element split-delimiter">
                <label for="field_to" class="caption"><?=$to_title;?>:</label>
                <p id="field_to" class="caption"><?=$reciver;?></p>
            </div>
        </div>
        
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
    <div class="row clear-row">
        <?php foreach($subposts as $subpost) { ?>
        <?=$subpost.PHP_EOL;?>
        <?php } ?>
    </div>
    <?php } ?>

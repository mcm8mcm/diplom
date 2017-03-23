
<div class="row clear-row log-topic-margin log-topic-padding">
    <div class="split-container">
        <div class="split-small-element">
            <p class="split"><?=$date;?></p> 
        </div>

        <div class="split-small-element split-delimiter topic-pointer">
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

    <div class="split-container btn-container">
        <div class="split-small-element btn-container btn-small-container">
            <span class="fa fa-edit btn-success btn fa-btn-fit">  </span>
        </div>

        <div class="split-small-element split-delimiter btn-container btn-small-container-bottom">
            <span class="fa fa-plus-square-o btn-warning btn fa-btn-fit">  </span>
        </div>
    </div>

    <div style="clear: both;">
        <fieldset class="topic-content">
            <legend class="topic-title"><?=$title?></legend>
            <p class="topic-limit"><?=$post_content?></p>
            
            <?php if(count($subposts) && $subposts !== '') { ?>
            <div class="row clear-row" style="border-left: 2px solid blue;">
                <?php foreach($subposts as $subpost) { ?>
                <?=$subpost.PHP_EOL;?>
                <?php } ?>
            </div>
            <?php } ?>
        </fieldset>         
    </div>        
</div>





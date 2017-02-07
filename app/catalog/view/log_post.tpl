<div>  
    <div class="log-title">
        
        <div class="date-holder">
            <div class="date-title"><?=$day_nom;?></div>
            <div class="date-title"><?=$month_nam;?></div>
            <div class="date-title"><?=$full_year;?></div>        
        </div>   

        <div class="post-title log-title-block">
            <div><label class="log-title-label"><?=$caption_from;?></label><label class="log-caption-label"><?=$from;?></label></div>
            <div><label class="log-title-label"><?=$caption_to;?></label><label class="log-caption-label"><?=$to;?></label></div>
            <div><label class="log-title-label"><?=$caption_title;?></label><label class="log-caption-label"><?=$post_title;?></label></div>        
        </div>  
        
        <div class="log-add"><a class="log-add-a">+</a></div>
    </div>
    
    <div>
        <p class="log-content"><?=$post_content;?></p>
    </div>
        
    <div style="clear: both; padding-left: 10px;">
        <?=$subposts;?>
    </div>   
</div>

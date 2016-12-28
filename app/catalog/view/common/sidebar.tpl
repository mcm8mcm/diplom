<div class="firm-border">
    <?php if(count($news)) { ?>
        <?php foreach($news as $article) { ?>
            <div class="panel panel-default">
                <div class="panel-heading bg-color-corp-soft color-corp"><?=$article['date'].' '.$article['title']?></div>
                <div class="panel-body"><?=$article['article']?></div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
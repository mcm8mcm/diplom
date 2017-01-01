<div class="firm-border container-hi">
    <?php if(count($news)) { ?>
        <?php foreach($news as $article) { ?>
            <div class="panel panel-success article">
                <div class="panel-heading bg-color-corp-soft color-corp"><?=$article['date'].'<br>'.$article['title']?></div>
                <div class="panel-body"><?=$article['content']?></div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
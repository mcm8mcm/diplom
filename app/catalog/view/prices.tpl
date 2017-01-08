<dev class="panel panel-success">
    <div class="panel-heading">
        <h1><?=$prices_title?></h1>
    </div>
    <div class="panel-body">
        <?php if(!count($prices)) { ?>
        <h2><?=$no_prices; ?></h2>
        <?php } else {
            foreach($prices as $price) { 
            echo $price.PHP_EOL; 
            }
        } ?>
    </div>
</dev>
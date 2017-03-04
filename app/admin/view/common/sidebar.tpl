<div class="firm-border container-control-menu">
    <div class="list-group admin-sbmenu-container">
        <?php foreach($items as $item) { ?>
        <a href="<?=$item['href'];?>" class="list-group-item admin-sbmenu-href-bpadd <?=$item['active'] ? 'active' : '';?>"><?=$item['title']?></a>
        <?php } ?>
    </div>
</div>
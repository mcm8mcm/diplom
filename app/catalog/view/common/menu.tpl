<!-- <nav class="navbar navbar-default"> -->
<!--   <div class="container-fluid"> -->
    <div class="container">
        <div class='pull-left'>
            <?=$langmenu;?> 
        </div>
    </div>
    
    <ul class="nav navbar-nav">
        <?php foreach($menu as $item) { ?>
            <li <?php echo($item['active'] == 0 ? "" : 'class="active"'); ?>><a href="<?=$item['link'];?>"><?=$item['caption'];?></a></li>
        <?php } ?>
    </ul>

<!--   </div> -->
<!-- </nav> -->
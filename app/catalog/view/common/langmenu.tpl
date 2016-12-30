 <div class="btn-group">
    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
    <img src="<?=$actlang['flag']?>" alt="<?=ucfirst($actlang['name'])?>" title="<?=ucfirst($actlang['name'])?>">
    <span class="hidden-xs hidden-sm hidden-md">Language</span> <i class="fa fa-caret-down"></i></button>
    <ul class="dropdown-menu">
        <?php foreach($languages as $lang) { ?>    
        <li><a href="<?=$lang['action'];?>"><img src="<?=$lang['flag']?>" alt="<?=ucfirst($lang['name'])?>" title="<?=ucfirst($lang['name'])?>" /><?=ucfirst($lang['name'])?></a></li>
        <?php }?>
    </ul>
  </div>
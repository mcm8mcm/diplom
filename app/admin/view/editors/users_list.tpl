<div class="list-group">
    <?php foreach($user_list['user'] as $curr_user) { ?>
    <a href="<?=$base_link.'?user_id='.$curr_user['id']?>" class="list-group-item list-group-item-succes admin-sbmenu-href-bpadd<?=$active_id === $curr_user['id'] ? ' active' : '';?>"><?=$curr_user['first_name'].' '.$curr_user['patronymic'].' '.$curr_user['last_name'];?></a>
    <?php } ?>
</div>
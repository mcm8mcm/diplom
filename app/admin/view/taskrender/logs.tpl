<div class="panel panel-success">
    <div class="panel-heading tight-pheader">
        <h3 class="admin-row-correct-vert"><?=$log_title?>
            <buton class="btn-tgl" data-toggle="collapse" aria-expanded="true" data-target="#log_body_<?=$order_id;?>"/>
        </h3>
    </div>
    
    <div id="log_body_<?=$order_id;?>" aria-expanded="true" class="panel-body tight-pbody collapse in">
        <?php foreach($log_list as $log) { ?>
            <?=$log;?>
        <?php } ?>
    </div>
</div>
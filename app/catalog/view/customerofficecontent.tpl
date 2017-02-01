<div class="row">
    <div class="firm-border container-hi">
        <div class="col-lg-8">
            <h1><?=$content;?></h1>
        </div>

        <div class="col-lg-4 def-margin">
            <div class="list-group">
                <a class="list-group-item list-group-item-success<?php if(!$active_count) { echo(' disabled'); } ?>" href="<?=$inprogress_link;?>"><?=$inprogress;?><span class="badge"><?=$active_count;?></span></a>
                <a class="list-group-item list-group-item-success<?php if(!$closed_count) { echo(' disabled'); } ?>" href="<?=$closed_link;?>"><?=$closed;?><span class="badge"><?=$closed_count;?></span></a>
            </div>    
        </div>
    </div>
</div>
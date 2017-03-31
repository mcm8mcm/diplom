<div id="control_container" class="panel panel-success std-col-margin">
    <div class="panel-heading centred">
        <h5><?=$control_title;?></h5>
    </div>

    <?php if(isset($succ_warn['success'])) { ?>
    <div class="alert alert-success alert-dismissable">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?= isset($succ_warn['del']) ? $success_del_msg : $success_msg;?>
    </div>
    <?php } ?>

    <?php if(isset($succ_warn['error'])) { ?>
    <div class="alert alert-warning alert-dismissable">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?=$succ_warn['error'];?>
    </div>
    <?php } ?>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8 task-container">
                <div class="row" style="width: 100%;margin-left: 2px;margin-right: 2px;" id="content">
                    <div class="panel-group" id="accordion">
                        <?=$task_list;?>
                    </div>   
                </div>

            </div>

            <div class="col-lg-4 task-container task-users-container">
                <?=$user_list;?>
            </div>
        </div>
    </div>
</div>   


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
                <div class="row admin-row-correct" id="tb_add_task">
                    <div class="pull-right user-ctl-btn-add">
                        <button title=""  type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-warning flag-marging"><span class="fa fa-plus-circle"></span></button>                
                    </div>
                </div>

                <div class="row" style="width: 100%;margin-left: 2px;margin-right: 2px;" id="content">

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                        Collapsible Group 1</a>
                                </h4>
                            </div>
                            
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                    minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                    commodo consequat.
                                </div>
                            </div>
                        </div>
                    </div>   

                </div>

            </div>

            <div class="col-lg-4 task-container task-users-container">
                <?=$user_list;?>
            </div>
        </div>
    </div>
</div>   


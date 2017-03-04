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
        <ul class="nav nav-tabs">
            <li <?=$curr_tab === 'first' ? 'class="active"' : ''?>><a href="#first_tab" data-toggle="tab"><?=$first_tab_title;?></a>
            </li>
            <li <?=$curr_tab === 'second' ? 'class="active"' : ''?>><a href="#second_tab" data-toggle="tab"><?=$second_tab_title;?></a>
            </li>
            <li <?=$curr_tab === 'third' ? 'class="active"' : ''?>><a href="#third_tab" data-toggle="tab"><?=$third_tab_title;?></a>
            </li>
        </ul>  
        
        <div class="tab-content clearfix">
                <div class="tab-pane<?=$curr_tab === 'first' ? ' active' : ''?>" id="first_tab">
                    <form>
                        <p>Preved</p>
                    </form>
                </div>

                <div class="tab-pane<?=$curr_tab === 'second' ? ' active' : ''?>" id="second_tab">
                    <form>
                        <p>Preved</p>
                    </form>
                </div>

                <div class="tab-pane<?=$curr_tab === 'third' ? ' active' : ''?>" id="third_tab">
                    <form>
                        <p>Preved</p>
                    </form>
                </div>                        
        </div>
    </div>
</div>
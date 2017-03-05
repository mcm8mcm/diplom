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
                <form class="user-ctl-descr-form user-add-form footer-form" id="first_area_content" name="first_area_content" method="post" action="<?=$action?>" enctype="multipart/form-data">
                    <input type="hidden" name="zone" value="first">
                    <div class="form-group">
                        <label class="required" for="html_aria"><?=$editor_title;?>:</label>
                        <textarea name="content" class="footer_content user-ctl-descr-form" id="first_area_content_ta"><?=$first_content;?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" form="first_area_content" onclick="edit_footer.preview('first_area_content_ta')" class="btn btn-default pull-left flag-marging" value="<?=$btn_preview;?>"><span class="fa fa-eye flag-marging"></span><?=$btn_preview;?></button>
                            <button form="first_area_content" type="submit" class="btn btn-success pull-right" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>    
                        </div>
                    </div>                    
                </form>

                <div class="user-ctl-descr-form user-add-form footer-form" id="preview_container" name="preview_container">
                    <div class="form-group">
                        <label for="html_aria"><?=$preview_title;?>:</label>     
                        <div class="footer_content user-ctl-descr-form" id="first_preview">

                        </div>
                    </div>
                </div>    
            </div>

            <div class="tab-pane<?=$curr_tab === 'second' ? ' active' : ''?>" id="second_tab">
                <form class="user-ctl-descr-form user-add-form footer-form" id="second_area_content" name="second_area_content" method="post" action="<?=$action?>" enctype="multipart/form-data">
                    <input type="hidden" name="zone" value="second">
                    <div class="form-group">
                        <label class="required" for="html_aria"><?=$editor_title;?>:</label>
                        <textarea name="content" class="footer_content user-ctl-descr-form" id="second_area_content_ta"><?=$second_content;?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" form="second_area_content" onclick="edit_footer.preview('second_area_content_ta')" class="btn btn-default pull-left flag-marging" value="<?=$btn_preview;?>"><span class="fa fa-eye flag-marging"></span><?=$btn_preview;?></button>
                            <button form="second_area_content" type="submit" class="btn btn-success pull-right" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>    
                        </div>
                    </div>                    
                </form>

                <div class="user-ctl-descr-form user-add-form footer-form" id="preview_container" name="preview_container">
                    <div class="form-group">
                        <label for="html_aria"><?=$preview_title;?>:</label>     
                        <div class="footer_content user-ctl-descr-form" id="second_preview">

                        </div>
                    </div>
                </div>    
            </div>

            <div class="tab-pane<?=$curr_tab === 'third' ? ' active' : ''?>" id="third_tab">
                <form class="user-ctl-descr-form user-add-form footer-form" id="third_area_content" name="third_area_content" method="post" action="<?=$action?>" enctype="multipart/form-data">
                    <input type="hidden" name="zone" value="third">
                    <div class="form-group">
                        <label class="required" for="html_aria"><?=$editor_title;?>:</label>
                        <textarea name="content" class="footer_content user-ctl-descr-form" id="third_area_content_ta"><?=$third_content;?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" form="third_area_content" onclick="edit_footer.preview('third_area_content_ta')" class="btn btn-default pull-left flag-marging" value="<?=$btn_preview;?>"><span class="fa fa-eye flag-marging"></span><?=$btn_preview;?></button>
                            <button form="third_area_content" type="submit" class="btn btn-success pull-right" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>    
                        </div>
                    </div>                    
                </form>

                <div class="user-ctl-descr-form user-add-form footer-form" id="preview_container" name="preview_container">
                    <div class="form-group">
                        <label for="html_aria"><?=$preview_title;?>:</label>     
                        <div class="footer_content user-ctl-descr-form" id="third_preview">

                        </div>
                    </div>
                </div>    
            </div>                        
        </div>
    </div>
</div>
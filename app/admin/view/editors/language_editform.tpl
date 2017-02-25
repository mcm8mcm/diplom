<div class="panel panel-success std-col-margin">
    <div class="panel-heading centred">
        <h5><?=$control_title;?></h5>
    </div>

    <?php if(isset($succ_warn['success'])) { ?>
    <div class="alert alert-success alert-dismissable">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?=$success_msg;?>
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
            <div class="pull-right user-ctl-btn-add">
                <button type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-primary flag-marging"><span class="fa fa-plus"></span></button>
            </div>  
            <div  id="add_form_holder" class="user-add-form-holder">
            </div>
        </div>

        <?php foreach($lang_data['user'] as $user) { ?>
        <?php } ?>
    </div>
</div>
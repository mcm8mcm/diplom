<div class="col-lg-9"> 
    <div class="panel panel-success">
        <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-lock gliph-margin"></i><?=$form_title?></h1>
            <?php if($warning !== '') { ?>
            <div class="alert alert-warning fade in">
                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$warning?>
            </div>
            <?php } ?>
        </div>

        <div class="panel-body">
            <form mame="login_form" id="login_form" method="post" enctype="multipart/form-data" action="<?=$action?>">
                <div class="form-group">
                    <label for="input-username"><?=$login_title?></label>
                    <div class="input-group">
                        <span class="input-group-addon success-bg"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" value="" placeholder="<?=$login_title?>" id="input-username" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="input-password"><?=$password_title?></label>
                    <div class="input-group">
                        <span class="input-group-addon success-bg"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" value="" placeholder="<?=$password_title?>" id="input-password" class="form-control" />
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i><span class="gliph-margin"></span><?=$submit_title;?></button>
                </div> 
                <input type="hidden" name="redirect" value="<?=$redirect?>">
            </form>
        </div>
    </div>
</div>
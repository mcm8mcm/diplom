<nav class="navbar navbar-default">
    <div class="container-fluid without-side-padding bg-grad-vert">
        <div class="navbar-header navbar-header-left-padding">
            <a class="navbar-brand">My site</a>
        </div>
        <div class="container">
            <div class="pull-left">         
                <?=$langmenu;?>
            </div>
            
            <?=$menu;?>

            <?php if(!empty($user)) { ?>
                <div class="navbar-brand pull-right logout-btn">
                    <form name="logout_form" id="logout_form" method="post" enctype="multipart/form-data" action="<?=$action_logout?>">
                        <button type="submit" form="logout_form" class="btn btn-success" style="clear: both;"><i class="fa fa-sign-out"></i><?=$exit_caption;?></button>
                        <input type="hidden" name="redirect" value="<?=$redirect?>">
                    </form>
                </div>        

                <div class="navbar-brand pull-right">         
                        <?=$user; ?>
                </div>
            <?php } ?>        
        </div>  
    </div>   
</nav>
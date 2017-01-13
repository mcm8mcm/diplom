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
                <div class="navbar-brand pull-right">         
                    <?=$user; ?>
                </div>
            <?php } ?>        
        </div>  
    </div>   
</nav>
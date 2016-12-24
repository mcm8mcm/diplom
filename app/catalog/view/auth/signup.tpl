<div class="content-container">
<div class="well bg-color-corp col-lg-offset-2 col-lg-8">
    <form id="reg_form" name="reg_form" action="<?=$reg_action?>">
        <div class="form-group">
            <label for="first_name" class="color-corp required"><?=$fn_first_name?></label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?=$fn_first_name?>" required="1">
        </div>

        <div class="form-group">
            <label for="patronymic" class="color-corp required"><?=$fn_patronymic?></label>
            <input type="text" class="form-control" id="patronymic" name="patronymic" placeholder="<?=$fn_patronymic?>" required="1">
        </div>

        <div class="form-group">
            <label for="last_name" class="color-corp required"><?=$fn_last_name?></label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?=$fn_last_name?>" required="1">
        </div>  

        <div class="form-group">
            <label for="login" class="color-corp required"><?=$fn_login?></label>
            <input type="text" class="form-control" id="login" name="login" placeholder="<?=$fn_login?>" required="1">
        </div>  

        <div class="form-group">
            <label for="password" class="color-corp required"><?=$fn_password?></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="<?=$fn_password?>" required="1">
        </div>  

        <div class="form-group">
            <label for="password1" class="color-corp required"><?=$fn_password1?></label>
            <input type="password" class="form-control" id="password1" name="password1" placeholder="<?=$fn_password1?>" required="1">
        </div>  
        
        <div class="form-group">
            <label for="address" class="color-corp required"><?=$fn_address?></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="<?=$fn_address?>" required="1">
        </div>  
        
        <div class="form-group">
            <label for="email" class="color-corp required"><?=$fn_email?></label>
            <input type="email" class="form-control" id="last_name" name="email" placeholder="<?=$fn_email?>" required="1">
        </div>  
        
        <input type="submit" class="btn btn-success" form="reg_form" value="<?=$bn_sign_up?>" /> <a class="btn btn-danger" href="<?=$cancel_action?>"><?=$bn_cancel?></a>
    </form>
</div> 
</div>
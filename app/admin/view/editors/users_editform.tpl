<div class="panel panel-success std-col-margin">
    <div class="panel-heading centred">
        <h5><?=$control_title;?></h5>
    </div>
    
    <div class="panel-body">
        <?php foreach($users_data['user'] as $user) { ?>
        <form id="data_form_<?=$user['id'];?>">
            <div id="control_part" class="row">
                Preved
            </div>

            <div id="data_part" class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="first_name"><?=$ufirstname_field_title;?>:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$user['first_name'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="patronymic"><?=$upatronymic_field_title;?>:</label>
                        <input type="text" class="form-control" id="patronymic" name="patronymic" value="<?=$user['patronymic'];?>">                        
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname"><?=$ulastname_field_title;?>:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$user['last_name'];?>">                        
                    </div>                    
                </div>
                
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="login"><?=$ulogim_field_title;?>:</label>
                        <input type="text" class="form-control" id="login" name="login" value="<?=$user['login'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd"><?=$upwd_field_title;?>:</label>
                        <input type="text" class="form-control" id="pwd" name="pwd" value="<?=$user['pwd'];?>">                        
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><?=$uemail_field_title;?>:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?=$user['email'];?>">                        
                    </div>                    
  
                    <div class="form-group">
                        <label for="reg_expired"><?=$uregexpired_field_title;?>:</label>
                        <input type="text" class="form-control" id="reg_expired" name="reg_expired" value="<?=$user['reg_expired'];?>">                        
                    </div>                    
                
                </div>
                
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="user_group"><?=$ugroup_field_title;?>:</label>
                        <input type="text" class="form-control" id="user_group" name="user_group" value="<?=$user['group_name'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="isactive"><?=$uactive_field_title;?>:</label>
                        <input type="text" class="form-control" id="isactive" name="isactive" value="<?=$user['active'];?>">                        
                    </div>

                    <div class="form-group">
                        <label for="user_lang"><?=$ulanguage_field_title;?>:</label>
                        <input type="text" class="form-control" id="user_lang" name="user_lang" value="<?=$user['language'];?>">                        
                    </div>                                       
                                                           
                    <div class="form-group">
                        <label for="cur_sess_id"><?=$usessionid_field_title;?>:</label>
                        <input type="text" class="form-control" id="cur_sess_id" name="cur_sess_id" value="<?=$user['session_id'];?>">                        
                    </div>   
                </div>                
            </div>            
        </form>
        <?php } ?>
    </div>
</div>
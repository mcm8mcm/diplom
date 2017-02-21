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
        <?php foreach($users_data['user'] as $user) { ?>
        <form id="data_form_<?=$user['id'];?>" action="<?=$action;?>" class="user-ctl-descr-form"  method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?=$user['id'];?>">
            <div id="control_part" class="row user-ctl-btn-block">
                <div class="col-lg-12">
                    <div class="pull-right">
                        <button type="button" onclick="edit_users.cancel_edit()" disabled="" form_id="data_form_<?=$user['id'];?>" id="btn_cancel" class="btn btn-warning flag-marging"><span class="fa fa-times-circle"/></button>
                    </div>                                        
                    
                    <div class="pull-right">
                        <button disabled="" form_id="data_form_<?=$user['id'];?>" id="btn_save" class="btn btn-default flag-marging"><span class="fa fa-save"/></button>
                    </div>
                    
                    <div class="pull-right">
                        <button type="button" onclick="edit_users.start_edit(<?='\''. 'data_form_'.$user['id'] . '\'';?>)" id="btn_edit" form_id="data_form_<?=$user['id'];?>" class="btn btn-primary flag-marging"><span class="fa fa-edit"/></button>
                    </div>
                </div>          
            </div>

            <div id="data_part" class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="first_name"><?=$ufirstname_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="first_name" name="first_name" value="<?=$user['first_name'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="patronymic"><?=$upatronymic_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="patronymic" name="patronymic" value="<?=$user['patronymic'];?>">                        
                    </div>
                    
                    <div class="form-group">
                        <label for="lastname"><?=$ulastname_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="lastname" name="lastname" value="<?=$user['last_name'];?>">                        
                    </div>                    
                </div>
                
                <div class="col-lg-4 user-ctl-descr-block">
                    <div class="form-group">
                        <label for="login"><?=$ulogim_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="login" name="login" value="<?=$user['login'];?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="pwd"><?=$upwd_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="pwd" name="pwd" value="<?=$user['pwd'];?>">                        
                    </div>
                    
                    <div class="form-group">
                        <label for="email"><?=$uemail_field_title;?>:</label>
                        <input disabled="" type="email" class="form-control" id="email" name="email" value="<?=$user['email'];?>">                        
                    </div>                    
  
                    <div class="form-group">
                        <label ><?=$uregexpired_field_title;?>:</label>
                        <div disabled="" class="input-group date" id="reg_expired">
                            <input disabled="" type="text" class="form-control" size="16" id="reg_expired_input" name="reg_expired" value="<?=$user['reg_expired'];?>">                        
                            <span disabled="" class="input-group-addon">
                                <span disabled="" class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>                    
                
                </div>
                
                <div class="col-lg-4 user-ctl-descr-block">
                    <div class="form-group">
                        <label for="user_group"><?=$ugroup_field_title;?>:</label>
                        <select disabled="" class="form-control" id="user_group" name="user_group">
                            <?php foreach($users_data['groups'] as $group) { ?>
                                <option <?=$group['name'] === $user['group_name'] ? 'selected' : '';?>><?=$group['name'];?></option>
                            <?php } ?>
                        </select>            
                    </div>
                 
                    <div class="form-group">
                        <label for="isactive"><?=$uactive_field_title;?>:</label>
                        <select disabled="" class="form-control" id="isactive" name="isactive">
                            <option <?=$user['active'] === '1' ? 'selected' : '';?>><?=$yes;?></option>
                            <option <?=$user['active'] === '1' ? '' : 'selected';?>><?=$no;?></option>
                        </select>            
                    </div>
                    
                    <div class="form-group">
                        <label for="user_lang"><?=$ulanguage_field_title;?>:</label>
                        <select disabled="" class="form-control" id="user_lang" name="user_lang" value="<?=$user['language'] === '' ? $not_selected : $user['language'];?>">
                            <option <?=$user['language'] === '' ? 'selected' : ''?>><?=$not_selected;?></option>
                            
                            <?php foreach($users_data['lang'] as $curr_lang) { ?>
                                <option <?=$curr_lang['name'] !== '' && $curr_lang['name'] === $user['language'] ? 'selected' : '';?>><?=$curr_lang['name'];?></option>
                            <? } ?>
                        </select> 
                    </div>                                       
                                                           
                    <div class="form-group">
                        <label for="cur_sess_id"><?=$usessionid_field_title;?>:</label>
                        <input disabled="" type="text" class="form-control" id="cur_sess_id" name="cur_sess_id" value="<?=$user['session_id'];?>">                        
                    </div>
                                        
                </div>                
            </div>            
        </form>
        <?php } ?>
    </div>


</div>
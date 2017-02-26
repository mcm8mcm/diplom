<div id="control_container" class="panel panel-success std-col-margin">
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
                <button title="<?=$new_lang_title?>"  type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-primary flag-marging"><span class="fa fa-plus"></span></button>
            </div>  
            <div id="add_form_holder" class="user-add-form-holder">
            </div>
        </div>

        <table class="common-ctl-table">
            <thead>
                <tr>
                    <th><?=$lname;?></th>
                    <th><?=$lshort_name;?></th>
                    <th><?=$currency_name;?></th>
                    <th><?=$lflag;?></th>
                    <th><?=$lactive;?></th>
                    <th><?=$ldesc;?></th>                    
                </tr>
            </thead>

            <tbody>
                <?php foreach($lang_data as $lang) { ?>
                <tr langid="<?=$lang['name'];?>">
                    <td><?=$lang['name'];?></td>
                    <td><?=$lang['short_name'];?></td>
                    <td class='centered'><?=$lang['currency'];?></td>
                    <td class='centered'><img src="<?=$lang['flag'];?>"></td>
                    <td class='centered'><?=$lang['active'] === '1' ? $yes : $no;?></td>
                    <td>
                        <div class="pull-left edit-btn-container"><?=$lang['lang_word'];?></div>
                        <div disabled="" class="pull-right" id="CUD_toolbar">
                            <button type="button" title="<?=$edit_lang_title?>" onclick="edit_languages.start_edit(<?='\''.$lang['name'].'\'';?>)" id="btn_edit_language" class="btn btn-primary flag-marging"><span class="fa fa-pencil"></span></button>
                            <button type="button" title="<?=$del_lang_title?>" onclick="edit_languages.del_language(<?='\''.$lang['name'].'\'';?>)" id="btn_del_language" class="btn btn-danger flag-marging"><span class="fa fa-times-circle"></span></button>                            
                        </div>
                    </td>
                </tr>
                <?php } ?>                
            </tbody>
        </table>

    </div>
</div>
<form id="edit_form" add_action="<?=$add_action;?>" edit_action="<?=edit_action;?>" class=" user-ctl-descr-form mcm-hidden" method="post" enctype="multipart/form-data" action="<?=$add_action;?>">
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="lang_name"><?=$lname;?>:</label>
                <input required="" type="text" class="form-control" id="lang_name" name="lang_name">
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                <label for="short_name"><?=$lshort_name;?>:</label>
                <input required="" type="text" maxlength="3" class="form-control" id="short_name" name="short_name">   
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                <label for="currency"><?=$currency_name;?>:</label>
                <input required="" type="text" maxlength="3" class="form-control" id="currency" name="currency">
            </div>
        </div>
        
        <div class="col-lg-2">
            <div class="form-group">
                <label for="is_active"><?=$lactive;?>:</label>
                <select required="" id="is_active" name="is_active" >
                    <option><?=$yes;?></option>
                    <option selected=""><?=$no;?></option>        
                </select>
            </div>
        </div>
        
        <div class="col-lg-2">
            <div class="form-group">
                <label for="flag"><?=$lflag;?>:</label>
                <select required="" id="flag" name="flag" class="selectpicker">
                    <?php foreach($lang_flags as $flag) { ?>
                    <option data-thumbnail="<?=$flag['path'];?>"><?=$flag['name'];?></option>
                    <?php } ?>        
                </select>
            </div>
        </div>
        
        <div class="col-lg-2">
            <div class="form-group">
                <label for="description"><?=$ldesc;?>:</label>
                <input  required="" type="text" class="form-control" id="description" name="description">
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success pull-left flag-marging" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>
            <button type="button" onclick="edit_languages.cancel_edit_language()" class="btn btn-warning pull-left" value="<?=$btn_cancel;?>"><span class="fa fa-times-circle flag-marging"></span><?=$btn_cancel;?></button>    
        </div>
    </div>
</form>

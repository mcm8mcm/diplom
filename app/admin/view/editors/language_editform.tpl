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
                <tr>
                    <td><?=$lang['name'];?></td>
                    <td><?=$lang['short_name'];?></td>
                    <td class='centered'><?=$lang['currency'];?></td>
                    <td class='centered'><img src="<?=$lang['flag'];?>"></img></td>
                    <td class='centered'><?=$lang['active'] === '1' ? $yes : $no;?></td>
                    <td>
                        <div class="pull-left edit-btn-container"><?=$lang['lang_word'];?></div>
                        <div disabled="" class="pull-right" id="CUD_toolbar">
                            <button type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-primary flag-marging"><span class="fa fa-pencil"></span></button>
                            <button type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-default flag-marging"><span class="fa fa-save"></span></button>
                            <button type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-warning flag-marging"><span class="fa fa-times"></span></button>                            
                        </div>
                    </td>
                </tr>
                <?php } ?>                
            </tbody>
        </table>
        
    </div>
</div>
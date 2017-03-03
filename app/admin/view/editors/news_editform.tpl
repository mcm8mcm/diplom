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
        <div class="row">
            <div class="pull-right user-ctl-btn-add">
                <button title="<?=$new_article_title?>" type="button" onclick="edit_news.new_atricle()" id="btn_new_language" class="btn btn-primary flag-marging"><span class="fa fa-plus"></span></button>
            </div>  
            
            <div id="add_form_holder" class="user-add-form-holder">
            </div>
        </div>

        <?php foreach($news_data as $article) { ?>
        <form id="art_form_<?=$article['id']?>" action="<?=$action?>" class=" user-ctl-descr-form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required" for="creation_date"><?=$fld_added;?>:</label>
                        <div class="input-group date" id="creation_date">
                            <input type="text" class="form-control" size="16" id="creation_date_input" name="creation_date" value="<?=$article['added'];?>">                        
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required" for="article_title"><?=$fld_title;?>:</label>
                        <input required="" type="text" class="form-control" id="article_title" name="article_title" value="<?=$article['title'];?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required" for="is_archive"><?=$fld_archive;?>:</label>
                        <select class="form-control" required="" id="is_archive" name="is_archive" >
                            <option <?=$article['archive'] === '1' ? "selected" : "";?>><?=$yes;?></option>
                            <option <?=$article['archive'] === '0' ? "selected" : "";?>><?=$no;?></option>        
                        </select>
                    </div>
                </div>
            </div>        

            <div class="row">        
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="required" for="article_content"><?=$fld_article;?>:</label>
                        <textarea placeholder="<?=$fld_article;?>" class="news_content form-control" required="" id="article_content" name="article_content"><?=trim($article['article']);?></textarea>
                    </div>
                </div>
            </div>  

            <div class="row">
                <div class="col-lg-12">
                    <button form="art_form_<?=$article['id']?>" type="submit" onclick="edit_news.dispatch('edit', <?='\''.$article['id'].'\'';?>)" class="btn btn-success pull-left flag-marging" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>
                    <button form="art_form_<?=$article['id']?>" type="button" onclick="edit_news.dispatch('delete', <?='\''.$article['id'].'\'';?>)" class="btn btn-danger pull-left" value="<?=$btn_delete;?>"><span class="fa fa-times-circle flag-marging"></span><?=$btn_delete;?></button>    
                </div>
            </div>
            
            <input type="hidden" id="curr_action" name="curr_action" value="">
            <input type="hidden" id="art_id" name="art_id" value="<?=$article['id']?>">
        </form>
        <?php } ?>
    </div>
</div>

<form id="art_form_new" action="<?=$action?>" class="user-ctl-descr-form user-add-form mcm-hidden" method="post" enctype="multipart/form-data">
    <div id="control_part" class="row user-ctl-btn-block">
        <div class="col-lg-12 usr-add-title-holder">

            <div class="pull-right">
                <button type="button" onclick="edit_news.cancel_add()" form_id="data_form_<?=$user['id'];?>" id="btn_cancel" class="btn btn-warning flag-marging"><span class="fa fa-times-circle"></span></button>
            </div>                                        

            <div class="pull-right">
                <button type="submit" id="btn_save" class="btn btn-default flag-marging"><span class="fa fa-save"></span></button>
            </div>

            <h3 class="admin-row-correct-vert usr-add-title"><?=$new_article_title;?>:</h3>
        </div>          
    </div>

    <div class="row">
        <div id="alert_holder" class="col-lg-12">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="required" for="creation_date"><?=$fld_added;?>:</label>
                <div class="input-group date" id="creation_date">
                    <input required type="text" class="form-control" size="16" id="creation_date_input" name="creation_date" value="">                        
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>                    
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="required" for="article_title"><?=$fld_title;?>:</label>
                <input type="text" class="form-control" id="article_title" name="article_title" required value="">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label class="required" for="is_archive"><?=$fld_archive;?>:</label>
                <select class="form-control" id="is_archive" name="is_archive" required>
                    <option><?=$yes;?></option>
                    <option selected=""><?=$no;?></option>        
                </select>
            </div>
        </div>
    </div>        

    <div class="row">        
        <div class="col-lg-12">
            <div class="form-group">
                <label class="required" for="article_content"><?=$fld_article;?>:</label>
                <textarea placeholder="<?=$fld_article;?>" class="news_content form-control" id="article_content" name="article_content" required></textarea>
            </div>
        </div>
    </div> 
    
    <input type="hidden" id="curr_action" name="curr_action" value="add_new">
    <input type="hidden" id="art_id" name="art_id" value="NONE">
</form>
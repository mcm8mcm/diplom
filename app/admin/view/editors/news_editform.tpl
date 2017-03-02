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
                <button title="<?=$new_article_title?>" type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-primary flag-marging"><span class="fa fa-plus"></span></button>
            </div>  
            <div id="add_form_holder" class="user-add-form-holder">
            </div>
        </div>

        <?php foreach($news_data as $article) { ?>
        <form id="art_form_<?=$article['id']?>" action="<?=$action?>" class=" user-ctl-descr-form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="creation_date"><?=$fld_added;?>:</label>
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
                        <label for="article_title"><?=$fld_title;?>:</label>
                        <input required="" type="text" class="form-control" id="article_title" name="article_title" value="<?=$article['title'];?>">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="is_archive"><?=$fld_archive;?>:</label>
                        <select required="" id="is_archive" name="is_archive" >
                            <option <?=$article['archive'] === '1' ? "selected" : "";?>><?=$yes;?></option>
                            <option <?=$article['archive'] === '0' ? "selected" : "";?>><?=$no;?></option>        
                        </select>
                    </div>
                </div>
            </div>        

            <div class="row">        
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="article_content"><?=$fld_article;?>:</label>
                        <textarea placeholder="<?=$fld_article;?>" class="news_content form-control" required="" id="article_content" name="article_content"><?=trim($article['article']);?></textarea>
                    </div>
                </div>
            </div>  

            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success pull-left flag-marging" value="<?=$btn_save;?>"><span class="fa fa-save flag-marging"></span><?=$btn_save;?></button>
                    <button type="button" onclick="edit_languages.cancel_edit_language()" class="btn btn-danger pull-left" value="<?=$btn_delete;?>"><span class="fa fa-times-circle flag-marging"></span><?=$btn_delete;?></button>    
                </div>
            </div>
        </form>
        <?php } ?>

    </div>
</div>

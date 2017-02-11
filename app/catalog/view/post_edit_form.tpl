<form class="edit-post mcm-hidden" id="post_edit_form" name="post_edit_form" action="<?=$action;?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title"><?=$title;?>:</label>
        <input placeholder="<?=$title;?>" required="1" type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
        <label for="post_content"><?=$content;?>:</label>
        <textarea placeholder="<?=$content;?>" required="1" rows="5" wrap="soft" name="post_content" class="form-control" id="post_content"></textarea>
    </div>

    <button onclick="edit_funct.on_cancel()" type="button" class="btn btn-warning"><span class="fa fa-times" style="padding-right: 5px;"></span><?=$cancle_btn;?></button>        
    <button onclick="edit_funct.submit()" form="post_edit_form" type="submit" class="btn btn-success"><span class="fa fa-floppy-o" style="padding-right: 5px;"></span><?=$save_btn;?></button>
    <input type="hidden" id="parent_post_id" name="parent_post_id" value="0">
    <input type="hidden" id="order_id" name="order_id" value="0">
    <input type="hidden" id="recipient_id" name="recipient_id" value="0">
    <input type="hidden" id="author_id" name="author_id" value="0">    
</form>
<div class="row admin-row-correct" id="tb_add_task">
    <div class="pull-right user-ctl-btn-add">
        <button title=""  type="button" onclick="edit_languages.new_language()" id="btn_new_language" class="btn btn-warning flag-marging"><span class="fa fa-plus-circle"></span></button>                
    </div>
</div>

<?php foreach($data as $task) { ?>
    <?=$task['view'].PHP_EOL;?>
<?php } ?>
<form method="post" enctype="multipart/form-data" id="form-topic-edit" class="form-horizontal clear-margin">
    <fieldset>
        <legend>
            <?=$form_title;?>
        </legend>

        <div class="form-group required">
            <label class="col-sm-3 control-label" for="parent-topic"><?=$parent_topic_title;?>:</label>
            <div class="col-sm-8">
                <input type="text" disabled="" class="col-sm-12 form-control" id="parent-topic" value="<?=$parent_topic;?>"></input>
            </div>
        </div> 

        <div class="form-group required">
            <label class="col-sm-3 control-label" for="topic-date"><?=$topic_date_title;?>:</label>
            <div class="col-sm-5">
                <div class="input-group date" data-provide="datepicker">
                    <input name="topic_date" value="<?=$topic_date;?>" placeholder="<?=$topic_date_title;?>:" data-date-format="DD.MM.YYYY HH.mm.ss" id="input-date-topic-date" class="form-control" type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-default datepickerbutton" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </span>
                </div>
            </div>        
        </div> 

        <div class="form-group required">
            <label class="col-sm-2 control-label" for="topic-from"><?=$title_from;?>:</label>
            <div class="col-sm-10">
                <label class="col-sm-2 control-label" id="topic-from"><?=$topic_from;?>:</label>
            </div>
        </div> 



    </fieldset>
</form>
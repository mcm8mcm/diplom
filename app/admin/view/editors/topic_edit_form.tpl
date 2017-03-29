<form>
    <fieldset>
        <legend>
            <?=$form_title;?>
        </legend>

        <div class="form-group required">
            <label class="col-sm-2 control-label" for="parent-topic"><?=$parent_topic_title;?>:</label>
            <div class="col-sm-10">
                <label class="col-sm-2 control-label" id="parent-topic"><?=$parent_topic;?>:</label>
            </div>
        </div> 

        <div class="form-group required">
            <label class="col-sm-2 control-label" for="topic-date"><?=$topic_date;?>:</label>
            <div class="col-sm-3">
                <div class="input-group date">
                    <input name="topic_date" value="2017-03-29" placeholder="<?=$topic_date_title;?>:" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span>
                </div>
            </div>        
        </div> 

        <div class="form-group required">
            <label class="col-sm-2 control-label" for="parent-topic"><?=$title_from;?>:</label>
            <div class="col-sm-10">
                <label class="col-sm-2 control-label" id="parent-topic"><?=$parent_topic;?>:</label>
            </div>
        </div> 



    </fieldset>
</form>
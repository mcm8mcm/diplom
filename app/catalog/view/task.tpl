<div class="panel panel-success">
    <div class="panel-heading">
        <table class="tab-task-head">
            <tr>
                <td colspan="2" class="task-head task-head-spanned"><?=$title;?></td>
            </tr>

            <tr>
                <td colspan="2" class="task-head task-head-spanned"><?=$device_title;?></td>
            </tr>
            
            <?php foreach($params as $curr_task) { ?>
            <tr>
                <td class="task-head task-params"><?=$curr_task[0];?></td>
                <td class="task-head task-params"><?=$curr_task[1];?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    
    <div class="panel-body">
        <div class="panel panel-success">
            <div class="panel-heading task-head-spanned">
                <h4><?=$caption_task_log;?></h4>
            </div>
            
            <div class="panel-body">
                <?=$log?>
            </div>
        </div>
            
        
    </div>
</div>
    
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?=$task_id;?>">
                <?=$order_title;?> <?=$task_id;?></a>
        </h4>
    </div>

    <div id="collapse_<?=$task_id;?>" class="panel-collapse collapse in">
        <div class="panel-body">
            <table id="order_descr" dev_id="<?=$task_id;?>">
                <thead>
                    <tr>
                        <th colspan="2"><?=$order_header_title;?>
                <buton class="btn-tgl" data-toggle="collapse" aria-expanded="true" data-target="#order_desc_body_<?=$task_id;?>"></buton>
                </th>
                </tr>
                </thead>

                <tbody id="order_desc_body_<?=$task_id;?>" aria-expanded="true" class="collapse in">
                    <tr>
                        <td class="field-label"><?=$order_customer_title;?></td>
                        <td class="value"><?=$customer_name;?></td>
                    </tr>

                    <tr>
                        <td class="field-label"><?=$order_master_title;?></td>
                        <td class="value"><?=$master_name;?></td>
                    </tr>

                    <tr>
                        <td class="field-label"><?=$order_startdate_title;?></td>
                        <td class="value"><?=$start_date;?></td>
                    </tr>

                    <tr>
                        <td class="field-label"><?=$order_finishdate_title;?></td>
                        <td class="value"><?=$finish_date;?></td>
                    </tr>
                </tbody>
            </table>   
            
            <?=$device_view;?>
        </div>
    </div>
</div>

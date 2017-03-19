<table id="device_descr" dev_id="<?=$device['id'];?>">
    <thead>
        <tr>
            <th colspan="2"><?=$device_title;?>
                <buton class="btn-tgl" data-toggle="collapse" aria-expanded="true" data-target="#dev_desc_body_<?=$device['id'];?>"/>
            </th>
        </tr>
    </thead>

    <tbody id="dev_desc_body_<?=$device['id'];?>" aria-expanded="true" class="collapse in">
        <tr>
            <td class="field-label"><?=$device_type_title;?></td>
            <td class="value"><?=$device['type'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_brand_title;?></td>
            <td class="value"><?=$device['brand'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_model_title;?></td>
            <td class="value"><?=$device['model'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_serial_title;?></td>
            <td class="value"><?=$device['serial'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_condition_title;?></td>
            <td class="value"><?=$device['condition'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_complaint_title;?></td>
            <td class="value"><?=$device['complaint'];?></td>
        </tr>

        <tr>
            <td class="field-label"><?=$device_complect_title;?></td>
            <td class="value"><?=$device['complect'];?></td>
        </tr>

    </tbody>
</table>

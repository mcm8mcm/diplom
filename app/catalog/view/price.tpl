<div class="panel panel-success">
    <div class="panel-heading">
        <h3><?=$content['price_desc']; ?></h3>
    </div>
    
    <div class="panel-body">
        <table class="price-table">
            <thead>
                <tr>
                    <th><?=$col_nom; ?></th>
                    <th><?=$col_stc_name; ?></th>
                    <th><?=$col_price; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($content['content'] as $line) { ?>
                <tr>
                    <td><?=$line[0]; ?></td>
                    <td><?=$line[1]; ?></td>
                    <td class="price"><?=$line[2]; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div><?=PHP_EOL;?>
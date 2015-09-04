<h3>Items</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Item</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character->characters_items as $link): ?>
        <tr id="item_<?= $link->id ?>">
            <td><?= $link->item->name ?></td>
            <td class="col-md-1 actions">
                <?php if ($link->equipped): ?>
                    <i class="btn btn-success btn-xs" id="toggle_item_<?= $link->id ?>">Equipped</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_item_<?= $link->id ?>">not equipped</i>
                <?php endif; ?>
                <i class="btn btn-warning btn-xs" id="drop_item_<?= $link->id ?>">drop</i>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr class="hidden-print">
        <td>Add:<input id="new_item_autocomplete"/><input type="hidden" id="new_item_id"/></td>
    </tr>
    </tbody>
</table>


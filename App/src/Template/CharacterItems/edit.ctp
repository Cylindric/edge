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
                    <i class="btn btn-success btn-xs" id="toggle_item_equip_<?= $link->id ?>">equipped</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_item_equip_<?= $link->id ?>">not equipped</i>
                <?php endif; ?>
                <?php if ($link->carried): ?>
                    <i class="btn btn-success btn-xs" id="toggle_item_carry_<?= $link->id ?>">carried</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_item_carry_<?= $link->id ?>">not carried</i>
                <?php endif; ?>
                <i class="btn btn-warning btn-xs" id="drop_item_<?= $link->id ?>">drop</i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <input type="hidden" id="new_item_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Item:</div>
                <input type="text" id="new_item_autocomplete" placeholder="enter item name" class="form-control"/>
            </div>

        </div>
    </form>
</div>

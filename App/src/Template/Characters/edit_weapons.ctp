<h3>Weapons</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Weapon</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character->weapons as $weapon): ?>
        <tr id="weapon_<?= $weapon->_joinData->id ?>">
            <td><?= $weapon->name ?></td>
            <td class="col-md-1">
                <?php if ($weapon->_joinData->equipped): ?>
                    <i class="btn btn-success btn-xs" id="toggle_weapon_<?= $weapon->_joinData->id ?>">Equipped</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_weapon_<?= $weapon->_joinData->id ?>">not equipped</i>
                <?php endif; ?>
                <i class="btn btn-warning btn-xs" id="drop_weapon_<?= $weapon->_joinData->id ?>">drop</i>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td>Add:<input id="new_weapon_autocomplete"/><input type="hidden" id="new_weapon_id"/></td>
        <td></td>
    </tr>
    </tbody>
</table>

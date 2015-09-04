    <h3>Weapons</h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Weapon</th>
            <th>Qty</th>
            <th>Skill</th>
            <th>Damage</th>
            <th>Range</th>
            <th>Crit</th>
            <th>Special</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($character->characters_weapons as $link): ?>
            <tr id="weapon_<?= $link->id ?>">
                <td><?= $link->weapon->name ?></td>
                <td>
                <span class="decrease glyphicon glyphicon-minus" aria-label="Decrease"
                      id="decrease_weapon_<?= $link->id ?>"></span>
                    <?= $link->quantity ?>
                    <span class="increase glyphicon glyphicon-plus" aria-label="Increase"
                          id="increase_weapon_<?= $link->id ?>"></span>
                </td>
                <td><?= $link->weapon->skill->name ?></td>
                <td><?= $link->weapon->damage ?></td>
                <td><?= $link->weapon->range->name ?></td>
                <td><?= $link->weapon->crit ?></td>
                <td><?= $link->weapon->special ?></td>
                <td class="col-md-1 actions">
                    <?php if ($link->equipped): ?>
                        <i class="btn btn-success btn-xs" id="toggle_weapon_<?= $link->id ?>">Equipped</i>
                    <?php else: ?>
                        <i class="btn btn-default btn-xs" id="toggle_weapon_<?= $link->id ?>">not equipped</i>
                    <?php endif; ?>
                    <i class="btn btn-warning btn-xs hidden-print" id="drop_weapon_<?= $link->id ?>">drop</i>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="hidden-print">
            <td>Add:<input id="new_weapon_autocomplete"/><input type="hidden" id="new_weapon_id"/></td>
        </tr>
        </tbody>
    </table>

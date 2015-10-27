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
        <th>Status</th>
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
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <input type="hidden" id="new_weapon_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Weapon:</div>
                <input type="text" id="new_weapon_autocomplete" placeholder="enter weapon name" class="form-control"/>
            </div>

        </div>
    </form>
</div>

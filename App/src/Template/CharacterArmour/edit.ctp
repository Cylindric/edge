<h3>Armour</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Armour</th>
        <th>Defence</th>
        <th>Soak</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character->characters_armour as $link): ?>
        <tr id="armour_<?= $link->id ?>">
            <td><?= $link->armour->name ?></td>
            <td><?= $link->armour->defence ?></td>
            <td><?= $link->armour->soak ?></td>
            <td class="col-md-1">
                <?php if ($link->equipped): ?>
                    <i class="btn btn-success btn-xs" id="toggle_armour_<?= $link->id ?>">Equipped</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_armour_<?= $link->id ?>">not equipped</i>
                <?php endif; ?>
                <i class="btn btn-warning btn-xs" id="drop_armour_<?= $link->id ?>">drop</i>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td>Add:<input id="new_armour_autocomplete"/><input type="hidden" id="new_armour_id"/></td>
    </tr>
    </tbody>
</table>


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
            <td class="col-md-1 actions">
                <?php if ($link->equipped): ?>
                    <i class="btn btn-success btn-xs" id="toggle_armour_<?= $link->id ?>">Equipped</i>
                <?php else: ?>
                    <i class="btn btn-default btn-xs" id="toggle_armour_<?= $link->id ?>">not equipped</i>
                <?php endif; ?>
                <i class="btn btn-warning btn-xs hidden-print" id="drop_armour_<?= $link->id ?>">drop</i>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <input type="hidden" id="new_armour_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Armour:</div>
                <input type="text" id="new_armour_autocomplete" placeholder="enter armour name" class="form-control"/>
            </div>

        </div>
    </form>
</div>

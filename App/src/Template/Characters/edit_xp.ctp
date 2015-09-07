<h3>Experience - <?= $this->Number->format($character->totalXp) ?></h3>

<?php if (count($character->xp) == 0): ?>
    <p>There is no XP yet.</p>
<?php else: ?>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th>Date</th>
            <th class="text-right">XP</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($character->xp as $xp): ?>
            <tr id="xp_<?= $xp->id ?>">
                <td class="col-md-2">
                    <span class="decrease glyphicon glyphicon-trash" aria-label="Delete" id="remove_xp_<?= $xp->id ?>"></span><?= $xp->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                </td>
                <td class="text-right"><?= $this->Number->format($xp->value) ?></td>
                <td><?= $xp->note ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New XP:</div>
                <input type="number" id="new_xp" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" id="new_xp_note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" id="new_xp_submit">Add</a>
            </div>

        </div>
    </form>
</div>

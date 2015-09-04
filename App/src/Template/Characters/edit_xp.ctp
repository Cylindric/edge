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

    <form class="form-inline hidden-print">
        <div class="form-group">
            <label for="new_xp">New XP</label>
            <input type="text" id="new_xp"></input>
            <input type="text" id="new_xp_note"></input>
        </div>
        <a class="btn btn-default" id="new_xp_submit">Submit</a>
    </form>
<h3>Experience - <?= $this->Number->format($total) ?></h3>
<?php if (count($xp) == 0): ?>
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
        <?php
        foreach ($xp as $x):
            $gm_id = $x->character->group->groups_users[0]->user_id;
            ?>
            <tr id="xp_<?= $x->id ?>">
                <td class="col-md-2">
                    <span class="decrease glyphicon glyphicon-trash" aria-label="Delete" id="remove_xp_<?= $x->id ?>"></span><?= $x->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                </td>
                <td class="col-md-1 text-right"><?= $this->Number->format($x->value) ?></td>
                <td><?= $x->note ?>
                    <?php if ($x->created_user->id == $gm_id): ?>
                        <span class="btn btn-xs btn-warning">GM <?= $x->created_user->username ?></span>
                    <?php endif; ?>
                </td>
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

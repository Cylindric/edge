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
            $created_by_gm = ($x->created_user->id == $gm_id);
            ?>
            <tr id="xp_<?= $x->id ?>">
                <td class="col-md-2" style="white-space: nowrap;">
                    <?= $x->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                    <?php if ($x->isLocked($user['id'], $gm_id)): ?>
                    <?php else: ?>
                        <span class="btn btn-xs btn-danger hidden-print" id="remove_xp_<?= $x->id ?>">delete</span>
                    <?php endif; ?>
                    <?php if ($created_by_gm): ?>
                        <span class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM <?= $x->created_user->username ?></span>
                    <?php endif; ?>
                </td>
                <td class="col-md-1 text-right"><?= $this->Number->format($x->value) ?></td>
                <td><?= $x->note ?>
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
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>
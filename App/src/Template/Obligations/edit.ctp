<h3>Obligation - <?= $this->Number->format($total) ?></h3>

<?php if (count($obligations) == 0): ?>
    <p>There is no Obligation.</p>
<?php else: ?>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th>Date</th>
            <th class="text-right">Obligation</th>
            <th>Type</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($obligations as $obligation):
            $gm_id = $obligation->character->group->groups_users[0]->user_id;
            $created_by_gm = ($obligation->created_by == $gm_id);
            ?>
            <tr id="obligation_<?= $obligation->id ?>">
                <td class="col-md-2" style="white-space: nowrap;">
                    <?php if ($obligation->isLocked($user['id'], $gm_id)): ?>
                    <?php else: ?>
                        <span class="decrease glyphicon glyphicon-trash hidden-print" aria-label="Delete" id="remove_obligation_<?= $obligation->id ?>"></span>
                    <?php endif; ?>
                    <?= $obligation->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                    <?php if ($created_by_gm): ?>
                        <span class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM <?= $obligation->created_user->username ?></span>
                    <?php endif; ?>
                </td>
                <td class="col-md-1 text-right"><?= $this->Number->format($obligation->value) ?></td>
                <td class="col-md-2"><?= $obligation->type ?></td>
                <td><?= $obligation->note ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">Obligation</div>
                <input type="number" id="new_obligation" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Type</div>
                <input type="text" id="new_obligation_type" placeholder="enter obligation type" class="form-control"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" id="new_obligation_note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" id="new_obligation_submit">Add</a>
            </div>

        </div>
    </form>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
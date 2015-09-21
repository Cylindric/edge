<h3>Credits - <?= $this->Number->format($total) ?></h3>

<?php if (count($credits) == 0): ?>
    <p>There are no transactions yet.</p>
<?php else: ?>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
        <tr>
            <th>Date</th>
            <th class="text-right">Value</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($credits as $credit):
            $gm_id = $credit->Gms['id'];
            $created_by_gm = $credit->created_by_gm;
            $locked = $created_by_gm && ($gm_id != $user['id']);
            ?>
            <tr id="credits_<?= $credit->id ?>">
                <td class="col-md-2"><?= $gm_id ?>
                    <?= $credit->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                    <?php if ($locked): ?>
                    <?php else: ?>
                        <span class="btn btn-xs btn-danger hidden-print" id="remove_credits_<?= $credit->id ?>">delete</span>
                    <?php endif; ?>
                    <?php if ($created_by_gm): ?>
                        <span class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM <?= $credit->created_user['username']?></span>
                    <?php endif; ?>
                </td>
                <td class="col-md-1 text-right"><?= $this->Number->format($credit->value) ?></td>
                <td><?= $credit->note ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">Credits:</div>
                <input type="number" id="new_credits" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" id="new_credits_note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" id="new_credits_submit">Add</a>
            </div>

        </div>
    </form>
</div>

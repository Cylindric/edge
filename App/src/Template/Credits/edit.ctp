<h3>Credits - <?= $this->Number->format($balance) ?></h3>

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
        <?php foreach ($credits as $credit): ?>
            <tr id="credits_<?= $credit->id ?>">
                <td class="col-md-2">
                    <span class="decrease glyphicon glyphicon-trash" aria-label="Delete" id="remove_credits_<?= $credit->id ?>"></span><?= $credit->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                </td>
                <td class="text-right"><?= $this->Number->format($credit->value) ?></td>
                <td><?= $credit->note ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<form class="form-inline hidden-print">
    <div class="form-group">
        <label for="new_credits">New Credits</label>
        <input type="text" id="new_credits"></input>
        <input type="text" id="new_credits_note"></input>
    </div>
    <a class="btn btn-default" id="new_credits_submit">Submit</a>
</form>
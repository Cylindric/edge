    <h3>Obligation - <?= $this->Number->format($character->totalObligation) ?></h3>

    <?php if (count($character->obligations) == 0): ?>
        <p>There is no Obligation.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Date</th>
                <th class="text-right">XP</th>
                <th>Type</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($character->obligations as $obligation): ?>
                <tr id="obligation_<?= $obligation->id ?>">
                    <td class="col-md-2">
                        <span class="decrease glyphicon glyphicon-trash" aria-label="Delete" id="remove_obligation_<?= $obligation->id ?>"></span><?= $obligation->created->i18nFormat([\IntlDateFormatter::SHORT, \IntlDateFormatter::NONE], 'Europe/London') ?>
                    </td>
                    <td class="text-right"><?= $this->Number->format($obligation->value) ?></td>
                    <td><?= $obligation->type ?></td>
                    <td><?= $obligation->note ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <div class="row">
        <form class="form-inline hidden-print">
            <div class="form-group">
                <label class="sr-only" for="new_obligation">Amount:</label>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-addon">Obligation</div>
                        <input type="number" id="new_obligation" placeholder="0" class="form-control text-right"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-addon">Type</div>
                        <input type="text" id="new_obligation_type" placeholder="enter obligation type" class="form-control"/>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-addon">Notes</div>
                        <input type="text" id="new_obligation_note" placeholder="enter any notes" class="form-control"/>
                    </div>
                    <div class="input-group">
                        <a class="btn btn-primary" id="new_obligation_submit">Add</a>
                    </div>
                </div>

            </div>
    </div>
    </form>

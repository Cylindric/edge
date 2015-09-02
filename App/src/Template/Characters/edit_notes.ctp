<div class="col-md-12">
    <h3>Notes</h3>

    <?php if (count($character->notes) == 0): ?>
        <p>There are no notes yet.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>Date</th>
                <th>Note</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($character->notes as $note): ?>
                <tr id="note_<?= $note->id ?>">
                    <td class="col-md-2"><span class="decrease glyphicon glyphicon-trash" aria-label="Delete"
                                               id="remove_note_<?= $note->id ?>"></span><?= $note->created->i18nFormat(null, 'Europe/London') ?>
                    </td>
                    <td>
                        <?php if ($note->private): ?>
                            <span class="glyphicon glyphicon-eye-close private hidden-print" data-toggle="tooltip" data-placement="left" title="This note is private. Click to make it public."></span>
                        <?php else: ?>
                            <span class="glyphicon glyphicon-eye-open public hidden-print" data-toggle="tooltip" data-placement="left" title="This note is public. Click to make it private."></span>
                        <?php endif; ?>
                        <?= $note->note ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <form class="form-inline hidden-print">
        <div class="form-group">
            <label for="new_note">New Note</label>
            <textarea id="new_note"></textarea>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" checked="checked" value="1" id="new_note_private">Private?</label>
        </div>
        <a class="btn btn-default" id="new_note_submit">Submit</a>
    </form>
</div>
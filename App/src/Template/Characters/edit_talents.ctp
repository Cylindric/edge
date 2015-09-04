    <h3>Talents</h3>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Talent</th>
            <th>Rank</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($character->talents as $talent): ?>
            <tr id="talent_<?= $talent->_joinData->id ?>">
                <td><span class="decrease glyphicon glyphicon-trash" aria-label="Delete"
                          id="remove_talent_<?= $talent->_joinData->id ?>"></span><?= $talent->name ?>
                </td>
                <td><?php if ($talent->ranked): ?>
                        <span class="decrease glyphicon glyphicon-minus" aria-label="Decrease"
                              id="decrease_talent_<?= $talent->_joinData->id ?>"></span>
                        <?= $talent->_joinData->rank ?>
                        <span class="increase glyphicon glyphicon-plus" aria-label="Increase"
                              id="increase_talent_<?= $talent->_joinData->id ?>"></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="hidden-print">
            <td>Add:<input id="new_talent_autocomplete"/><input type="hidden" id="new_talent_id"/></td>
            <td></td>
        </tr>
        </tbody>
    </table>

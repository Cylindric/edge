<h3>Talents</h3>
<?php if (count($character->talents) == 0): ?>
    <p>Coming soon...</p>
<?php else: ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Talent</th>
            <th>Rank</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($character->talents as $talent): ?>
            <tr>
                <td><?= $talent->name ?></td>
                <td><?= $talent->_joinData->rank ?></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

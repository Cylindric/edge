<h3>Talents</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Talent</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character_talents as $talent): ?>
        <tr>
            <td><?= $talent->name ?><?= $talent->ranked ? ' ('.$talent->_joinData->rank.')' : '' ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
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
        <tr>
            <td><?= $talent->name ?></td>
            <td><?= $talent->_joinData->rank ?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td><input id="autocomplete" /></td>
            <td>Add</td>
        </tr>
    </tbody>
</table>

<h3>Armour</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Armour</th>
        <th>Defence</th>
        <th>Soak</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character_armour as $armour): ?>
        <tr>
            <td><?= $armour->name ?></td>
            <td><?= $armour->defence ?></td>
            <td><?= $armour->soak ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

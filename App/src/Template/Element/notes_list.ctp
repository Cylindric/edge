<h3>Notes</h3>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Date</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($character_notes as $note): ?>
        <tr>
            <td><?= $note->created->i18nFormat(null, 'Europe/London');?></td>
			<td><?= $note->note ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

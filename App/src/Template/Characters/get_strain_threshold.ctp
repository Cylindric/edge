<table class="table table-condensed table-striped">
    <tbody>
    <?php foreach ($breakdown as $type => $value): ?>
        <?php if ($value != 0): ?>
            <tr class="<?=($value < 0) ? 'danger' : 'success' ?>">
                <td><?= $type ?></td><td class="text-right"><?= $value ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>
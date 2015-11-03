<h3><?= $title ?></h3>
<table class="table table-condensed">
    <?php foreach (array_filter($skills->toArray(), function ($s) use ($skilltype_id) {
        return $s->skilltype_id == $skilltype_id;
    }) as $skill): ?>
        <tr>
            <td><?= $skill->name ?> (<?= $skill->stat->code ?>)</td>
            <td class="col-md-2 text-center">
                <?= $skill->level == 0 ? '' : $skill->level ?>
            </td>
            <td class="col-md-3">
                <?= $this->RpgText->dice($skill->dice($character)) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
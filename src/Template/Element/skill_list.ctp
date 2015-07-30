<h3><?= $title ?></h3>
<table class="table table-condensed">
    <?php foreach (array_filter($skills->toArray(), function ($s) use ($skilltype_id) {
        return $s->skilltype_id == $skilltype_id;
    }) as $skill): ?>
        <tr>
            <td><?= $skill->name ?> (<?= $skill->characteristic->code ?>)</td>
            <td class="col-md-2 text-center">
                <?php if ($skill->level > 0): ?>
                    <a class="btn btn-sm btn-skill-adjust" href="#" id="decrease_<?= $skill->id ?>"><i class="stat_edit_button decrease fa fa-minus-square"></i> </a>
                <?php endif; ?>
                <?= $skill->level ?>
                <a class="btn btn-sm btn-skill-adjust" href="#" id="increase_<?= $skill->id ?>"><i class="increase fa fa-plus-square"></i> </a>
            </td>
            <td class="col-md-3">
                <?= str_repeat($this->Html->image('dice-proficiency.png'), $skill->dice($character)[0]) ?>
                <?= str_repeat($this->Html->image('dice-ability.png'), $skill->dice($character)[1]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
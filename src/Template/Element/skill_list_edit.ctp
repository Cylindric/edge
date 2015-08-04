<h3><?= $title ?></h3>
<table class="table table-condensed">
    <?php foreach (array_filter($skills->toArray(), function ($s) use ($skilltype_id) {
        return $s->skilltype_id == $skilltype_id;
    }) as $skill): ?>
        <tr id="skill_<?= $skill->id ?>">
            <td><span class="skill_name"><?= $skill->name ?> (<?= $skill->stat->code ?>)</span></td>
            <td class="col-md-2 text-center">
                <?php if ($skill->level > 0): ?>
                    <i class="decrease fa fa-minus-square" id="skilldecrease_<?= $skill->id ?>" style="<?= ($skill->level > 0) ? "" : "display:none;"; ?>"></i>
                <?php endif; ?>
                <span class="skill_level"><?= $skill->level == 0 ? '' : $skill->level ?></span>
                <i class="increase fa fa-plus-square" id="skillincrease_<?= $skill->id ?>"></i>
            </td>
            <td class="col-md-3">
                <span class="skill_dice">
                     <?= str_repeat($this->Html->image('dice-proficiency.png'), $skill->dice($character)['proficiency']) ?><?= str_repeat($this->Html->image('dice-ability.png'), $skill->dice($character)['ability']) ?>
                    </span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
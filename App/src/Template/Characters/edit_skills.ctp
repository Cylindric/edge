<div class="col-md-5">
    <?= $this->element('skill_list_edit', [
        'title' => 'General Skills',
        'skilltype_id' => 1
    ]); ?>
</div>

<div class="col-md-5">
    <?= $this->element('skill_list_edit', [
        'title' => 'Combat Skills',
        'skilltype_id' => 2
    ]); ?>

    <?= $this->element('skill_list_edit', [
        'title' => 'Knowledge Skills',
        'skilltype_id' => 3
    ]); ?>
</div>

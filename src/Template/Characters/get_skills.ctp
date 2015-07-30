<div class="col-md-5">
    <?= $this->element('skill_list', [
        'title' => 'General Skills',
        'skilltype_id' => 1
    ]); ?>
</div>

<div class="col-md-5">
    <?= $this->element('skill_list', [
        'title' => 'Combat Skills',
        'skilltype_id' => 2
    ]); ?>

    <?= $this->element('skill_list', [
        'title' => 'Knowledge Skills',
        'skilltype_id' => 3
    ]); ?>
</div>

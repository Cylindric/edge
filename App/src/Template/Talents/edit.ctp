<?php
$this->Html->addCrumb('Talents', '/talents');
$this->Html->addCrumb($talent->name, ['action' => 'view', $talent->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
    <?=
    $this->Form->postLink(
            __('Delete'), ['action' => 'delete', $talent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talent->id), 'class' => 'btn btn-default']
    )
    ?>
</div>

<div class="row">
    <div class="col-md-12">

        <?= $this->Form->create($talent); ?>
        <?= $this->Form->input('name'); ?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label for="ranked">
                        <input type="hidden" name="ranked" value="0"/>
                        <input type="checkbox" cb name="ranked" value="1" id="ranked" checked="<?= $talent->ranked ? 'checked' : '' ?>">Ranked
                    </label>
                </div>
            </div>
        </div>

        <?= $this->Form->input('strain_per_rank'); ?>
        <?= $this->Form->input('soak_per_rank'); ?>
        <?= $this->Form->input('description'); ?>
        <?= $this->Form->input('source_id'); ?>
        <?= $this->Form->submit(); ?>
        <?= $this->Form->end() ?>

    </div>
</div>

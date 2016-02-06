<?php
$this->Html->addCrumb('Talents', '/talents');
$this->Html->addCrumb($talent->name, ['action' => 'view', $talent->id]);
?>
<div class="btn-group" role="group" aria-label="Controls">
<?= $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $talent->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $talent->id), 'class' => 'btn btn-default']
    )
?>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <?= $this->Form->create($talent, ['class' => 'form-horizontal']) ?>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Name" value="<?=$talent->name?>">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="ranked" value="1" checked="<?=$talent->ranked?'checked':''?>" /> Ranked
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="strain_per_rank" class="col-sm-2 control-label">Strain Per Rank</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="strain_per_rank" placeholder="0" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="soak_per_rank" class="col-sm-2 control-label">Soak Per Rank</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="soak_per_rank" placeholder="0">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="description" placeholder="Description" value="<?=$talent->description?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= $this->Form->button(__('Save'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

    </div>
</div>


<?php
$this->Html->addCrumb('Characters', '/characters');
$this->Html->addCrumb($character->name);
$this->Html->script('rpgCharacterEdit', ['block' => true]);
$this->assign('title', $character->name);
?>

<?= $this->Form->create($character); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end() ?>

<div class="row">
    <div class="col-md-12 col-lg-10 col-lg-offset-1">

        <div class="row">
            <h2><a href="#" id="name" data-type="text" data-pk="<?= $character->id ?>"
                   data-url="/characters/edit/<?= $character->id ?>.json"
                   data-title="Character name"><?= h($character->name) ?></a>
                <?= $this->Html->link('<span class="glyphicon glyphicon-eye-open" aria-label="Edit"></span>', ['action' => 'view', $character->id], ['escape' => false, 'class' => 'hidden-print']) ?>
            </h2>
            <?php echo $this->Html->scriptBlock("
            $(document).ready(function() {
                $('#name').editable({
                success: function(response, newValue) {
                    if(response.response.status == 'error') return response.msg; //msg will be shown in editable form
                }
                });
            });
            ", ['block' => true]); ?>
            <?php if ($character->group_id == 0): ?>
                <div
                    class="row"><?= $this->Html->link('Join Group', ['controller' => 'characters', 'action' => 'join_group', $character->id]) ?></div>
            <?php else: ?>
                <h3><?= $character->group->name ?></h3>
            <?php endif; ?>
        </div>
        <?= $this->element('status_block', [
            'character' => $character
        ]); ?>

        <h3>Characteristics</h3>

        <div class="row pagebreak" id="stats_list_edit">
        </div>

        <div class="row" id="skills_list_edit">
        </div>

        <div class="row">
            <!-- Nav tabs -->
            <ul class="nav nav-pills hidden-print" role="tablist">
                <li role="presentation" class="btn-lg active"><a href="#talents" aria-controls="talents" role="tab" data-toggle="tab">Talents</a></li>
                <li role="presentation" class="btn-lg"><a href="#weapons" aria-controls="weapons" role="tab" data-toggle="tab">Weapons</a></li>
                <li role="presentation" class="btn-lg"><a href="#armour" aria-controls="armour" role="tab" data-toggle="tab">Armour</a></li>
                <li role="presentation" class="btn-lg"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
                <li role="presentation" class="btn-lg"><a href="#credits" aria-controls="credits" role="tab" data-toggle="tab">Credits (<span class="character_credits_total"><?= $this->RpgNumber->toReadableSize($character->totalCredits) ?></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#xp" aria-controls="xp" role="tab" data-toggle="tab">Experience (<span class="character_xp_total"><?= $this->RpgNumber->toReadableSize($character->totalXp) ?></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#obligation" aria-controls="obligation" role="tab" data-toggle="tab">Obligation (<span class="character_obligation_total"><?= $this->RpgNumber->toReadableSize($character->totalObligation) ?></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#bio" aria-controls="bio" role="tab" data-toggle="tab">Bio</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="talents">
                    <div class="col-md-12" id="talents_list_edit"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="weapons">
                    <div class="col-md-12" id="weapons_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="armour">
                    <div class="col-md-12" id="armour_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="items">
                    <div class="col-md-12" id="item_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="credits">
                    <div class="col-md-12" id="credits_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="xp">
                    <div class="col-md-12" id="xp_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="obligation">
                    <div class="col-md-12" id="obligation_list_edit">
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="bio">
                    <div class="col-md-12" id="bio_edit">
                        <h3>Bio</h3>
                        <?= $this->Text->autoParagraph($character->biography) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="notes_list_edit">
        </div>
    </div>

</div>
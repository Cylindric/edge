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

        <div class="row" id="talents_list_edit">
        </div>

        <div class="row" id="inventory">
            <div class="col-md-12" id="weapons_list_edit">
            </div>
            <div class="col-md-6" id="armour_list_edit">
            </div>
            <div class="col-md-6" id="item_list_edit">
            </div>

            <div class="col-md-3">
                <h3>Inventory</h3>
                Credits: <span id="credits" data-type="text" data-pk="<?= $character->id ?>"
                               data-url="/characters/edit/<?= $character->id ?>.json"
                               data-title="Character credits"><?= $this->Number->format($character->credits) ?></span>.
                <?php echo $this->Html->scriptBlock("
            $(document).ready(function() {
                $('#credits').editable({
                success: function(response, newValue) {
                    if(response.response.status == 'error') return response.msg;
                },
                display: function(value, response) {
                    if(typeof response != 'undefined') {
                        $(this).text(response.response.data.credits);
                    }
                },
                });
            });
            ", ['block' => true]); ?>
            </div>
        </div>

        <div class="row" id="notes_list_edit">
        </div>

        <div class="row" id="bio_edit">
            <div class="col-md-12">
            <h3>Bio</h3>
            <?= $this->Text->autoParagraph($character->biography) ?>
            </div>
        </div>
    </div>

</div>

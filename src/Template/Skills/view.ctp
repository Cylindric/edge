<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Skill'), ['action' => 'edit', $skill->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Skill'), ['action' => 'delete', $skill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skill->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Skills'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skill'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Characteristics'), ['controller' => 'Characteristics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characteristic'), ['controller' => 'Characteristics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Training'), ['controller' => 'Training', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Training'), ['controller' => 'Training', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="skills view large-10 medium-9 columns">
    <h2><?= h($skill->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Characteristic') ?></h6>
            <p><?= $skill->has('characteristic') ? $this->Html->link($skill->characteristic->name, ['controller' => 'Characteristics', 'action' => 'view', $skill->characteristic->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($skill->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($skill->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Training') ?></h4>
    <?php if (!empty($skill->training)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Character Id') ?></th>
            <th><?= __('Skill Id') ?></th>
            <th><?= __('Level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($skill->training as $training): ?>
        <tr>
            <td><?= h($training->id) ?></td>
            <td><?= h($training->character_id) ?></td>
            <td><?= h($training->skill_id) ?></td>
            <td><?= h($training->level) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Training', 'action' => 'view', $training->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Training', 'action' => 'edit', $training->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Training', 'action' => 'delete', $training->id], ['confirm' => __('Are you sure you want to delete # {0}?', $training->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

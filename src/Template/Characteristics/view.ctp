<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Characteristic'), ['action' => 'edit', $characteristic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Characteristic'), ['action' => 'delete', $characteristic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $characteristic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Characteristics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Characteristic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Growth'), ['controller' => 'Growth', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Growth'), ['controller' => 'Growth', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="characteristics view large-10 medium-9 columns">
    <h2><?= h($characteristic->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($characteristic->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($characteristic->id) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Growth') ?></h4>
    <?php if (!empty($characteristic->growth)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Character Id') ?></th>
            <th><?= __('Characteristic Id') ?></th>
            <th><?= __('Level') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($characteristic->growth as $growth): ?>
        <tr>
            <td><?= h($growth->id) ?></td>
            <td><?= h($growth->character_id) ?></td>
            <td><?= h($growth->characteristic_id) ?></td>
            <td><?= h($growth->level) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Growth', 'action' => 'view', $growth->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Growth', 'action' => 'edit', $growth->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Growth', 'action' => 'delete', $growth->id], ['confirm' => __('Are you sure you want to delete # {0}?', $growth->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Skills') ?></h4>
    <?php if (!empty($characteristic->skills)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Characteristic Id') ?></th>
            <th><?= __('Name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($characteristic->skills as $skills): ?>
        <tr>
            <td><?= h($skills->id) ?></td>
            <td><?= h($skills->characteristic_id) ?></td>
            <td><?= h($skills->name) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Skills', 'action' => 'view', $skills->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Skills', 'action' => 'edit', $skills->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Skills', 'action' => 'delete', $skills->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skills->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>

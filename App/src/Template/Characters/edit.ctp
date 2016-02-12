<?php

$this->Html->addCrumb('Characters', ['action' => '']);
$this->Html->addCrumb($character->name);
$this->assign('title', $character->name);
?>

<?= $this->Form->create($character); ?>
<?= $this->Form->hidden('id'); ?>
<?= $this->Form->end() ?>

<div class="row" ng-controller="CharacterCtrl as ctrl">
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
            <ul class="list-inline">
				<?php foreach ($character->characters_groups as $character_group): ?>
                <li><?= $character_group->group->name ?></li>
				<?php endforeach; ?>
                <li class="hidden-print"><?= $this->Html->link('Join Group', ['controller' => 'characters', 'action' => 'join_group', $character->id]) ?></li>
            </ul>
        </div>
		<?= $this->element('status_block', ['character' => $character]); ?>

        <h3>Characteristics</h3>

        <div class="row pagebreak">
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-4 text-center stat" ng-repeat="(id,stat) in stats">
                    <div class="row value">
                        <div class="col-md-12">

                            <i ng-show="stat.value === 0" class="stat_edit_button glyphicon glyphicon-minus hidden-print"></i>
                            <i ng-show="stat.value > 0" class="stat_edit_button decrease glyphicon glyphicon-minus hidden-print" ng-click="changeStat(id, -1)"></i>

                            <span class="stat_edit_value">{{stat.value}}</span>
                            <i class="stat_edit_button increase glyphicon glyphicon-plus hidden-print" ng-click="changeStat(id, 1)"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row name">
                            {{stat.name| uppercase}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div ng-repeat="category in skill_categories" class="col-lg-4 col-md-6">
                <h3>{{category.name}}</h3>
                <table class="table table-condensed">
                    <tr ng-repeat="skill in category.skills">
                        <td>
                            <span class="skill_name">{{skill.name}} ({{skill.stat.code}})</span>
                        </td>
                        <td>
                            <i ng-hide="!skill.career" class="btn btn-success btn-xs" ng-click="toggleCareer(skill.id)">career</i>
                            <i ng-hide="skill.career" class="btn btn-default btn-xs" ng-click="toggleCareer(skill.id)">standard</i>
                        </td>
                        <td class="col-md-2 text-center">
                            <i ng-hide="skill.level === 0" class="decrease glyphicon glyphicon-minus" ng-click="changeSkill(skill.id, -1)"></i>
                            <span class="skill_level">{{skill.level}}</span>
                            <i class="increase glyphicon glyphicon-plus" ng-click="changeSkill(skill.id, 1)"></i>
                        </td>
                        <td class="col-md-3">
                            <span class="skill_dice">
                                <?= $this->Html->image('dice-proficiency.png', ['alt' => 'Proficiency Dice', 'ng-repeat' => 'n in range(skill.dice_details.proficiency)']) ?><?= $this->Html->image('dice-ability.png', ['alt' => 'Ability Dice', 'ng-repeat' => 'n in range(skill.dice_details.ability)']) ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <!-- Navigation tabs -->
            <ul class="nav nav-pills hidden-print" role="tablist">
                <li role="presentation" class="btn-lg active"><a href="#talents" aria-controls="talents" role="tab" data-toggle="tab">Talents</a></li>
                <li role="presentation" class="btn-lg"><a href="#weapons" aria-controls="weapons" role="tab" data-toggle="tab">Weapons</a></li>
                <li role="presentation" class="btn-lg"><a href="#armour" aria-controls="armour" role="tab" data-toggle="tab">Armour</a></li>
                <li role="presentation" class="btn-lg"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
                <li role="presentation" class="btn-lg"><a href="#credits" aria-controls="credits" role="tab" data-toggle="tab">Credits (<span ng-bind="totalCredits | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#xp" aria-controls="xp" role="tab" data-toggle="tab">Experience (<span ng-bind="totalXp | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#obligation" aria-controls="obligation" role="tab" data-toggle="tab">Obligation (<span ng-bind="totalObligation | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#bio" aria-controls="bio" role="tab" data-toggle="tab">Bio</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="talents">
                    <div class="col-md-12" id="talents_list_edit">
                        <?= $this->element('character/talents') ?>
                    </div>
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
                    <div class="col-md-12">
			<?= $this->element('character/credits') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="xp">
                    <div class="col-md-12">
			<?= $this->element('character/xp') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="obligation">
                    <div class="col-md-12">
			<?= $this->element('character/obligation') ?>
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
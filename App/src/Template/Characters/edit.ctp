<?php

$this->Html->addCrumb('Characters', ['action' => 'index']);
$this->Html->addCrumb($character->name);
$this->assign('title', $character->name);

echo $this->Form->create($character);
echo $this->Form->hidden('id', ['id' => 'character_id']);
echo $this->Form->end();
?>

<div class="row" ng-cloak ng-controller="CharacterEditCtrl">
    <div class="col-md-12 col-lg-10 col-lg-offset-1">
        <div class="row">
            <h2 id="character_name">{{character.name}}</h2>
            <ul class="list-inline">
                <li ng-repeat='cg in character.characters_groups'>{{cg.group.name}}</li>
                <li class="hidden-print" ng-show='character.characters_groups.length === 0'><a href="<?=$this->Url->build(['controller'=>'Characters', 'action' => 'join_group' , $character->id]);?>">Join a group</a></li>
            </ul>
        </div>

        <?= $this->element('status_block', ['character' => $character]); ?>

        <h3>Characteristics</h3>

        <div class="row pagebreak hidden">
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

        <div class="row hidden">
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
                <li role="presentation" class="btn-lg"><a href="#talents" aria-controls="talents" role="tab" data-toggle="tab">Talents</a></li>
                <li role="presentation" class="btn-lg"><a href="#weapons" aria-controls="weapons" role="tab" data-toggle="tab">Weapons</a></li>
                <li role="presentation" class="btn-lg"><a href="#armour" aria-controls="armour" role="tab" data-toggle="tab">Armour</a></li>
                <li role="presentation" class="btn-lg active"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
                <li role="presentation" class="btn-lg"><a href="#credits" aria-controls="credits" role="tab" data-toggle="tab">Credits (<span ng-bind="totalCredits | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#xp" aria-controls="xp" role="tab" data-toggle="tab">Experience (<span ng-bind="totalXp | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#obligation" aria-controls="obligation" role="tab" data-toggle="tab">Obligation (<span ng-bind="totalObligation | number"></span>)</a></li>
                <li role="presentation" class="btn-lg"><a href="#bio" aria-controls="bio" role="tab" data-toggle="tab">Bio</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="talents">
                    <div class="col-md-12">
                        <?= $this->element('character_edit/talents') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="weapons">
                    <div class="col-md-12">
                        <?= $this->element('character_edit/weapons') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="armour">
                    <div class="col-md-12">
                        <?= $this->element('character_edit/armour') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade in active" id="items">
                    <div class="col-md-12">
                        <?= $this->element('character_edit/items') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="credits">
                    <div class="col-md-12">
			<?= $this->element('character_edit/credits') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="xp">
                    <div class="col-md-12">
			<?= $this->element('character_edit/xp') ?>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="obligation">
                    <div class="col-md-12">
			<?= $this->element('character_edit/obligation') ?>
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
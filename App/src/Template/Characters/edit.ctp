<?php
$this->Html->addCrumb('Characters', ['action' => 'index']);
$this->Html->addCrumb($character->name);
$this->assign('title', $character->name);

echo $this->Form->create($character);
echo $this->Form->hidden('id', ['id' => 'character_id']);
echo $this->Form->end();
?>

<div class="row" ng-cloak ng-controller="CharacterEditCtrl as ctrl">
    <div class="col-md-12 col-lg-10 col-lg-offset-1">
        <div class="row">
            <h2 id="character_name">{{character.name}}</h2>
            <ul class="list-inline">
                <li ng-repeat='cg in character.characters_groups'><a href="/groups/view/{{cg.group.id}}">{{cg.group.name}}</a></li>
                <li class="hidden-print" ng-show='character.characters_groups.length === 0'><a href="<?= $this->Url->build(['controller' => 'Characters', 'action' => 'join_group', $character->id]); ?>">Join a group</a></li>
            </ul>
        </div>

        <?= $this->element('status_block', ['character' => $character]); ?>

        <h3>Characteristics</h3>

        <div class="row pagebreak">
            <div class="row">
                <div class="col-sm-2 col-xs-4 text-center stat" ng-repeat="(id,stat) in stats" ng-mouseenter="highlightSkills(id)" ng-mouseleave="highlightSkills()">
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
            <div ng-repeat="category in skill_categories" class="col-md-4 col-sm-6">
                <h3>{{category.name}}</h3>

                <div class="hidden-print row skill_row {{skill.highlight}}" ng-repeat="skill in category.skills">
                    <div class="col-xs-7 col-md-6 no-right-padding">{{skill.name}} ({{skill.stat.code}})</div>
                    <div class="col-xs-1 col-md-2 no-padding hidden-print">
                        <i ng-hide="!skill.career" class="btn btn-success btn-xs" ng-click="toggleCareer(skill.id)">c<span class="hidden-xs hidden-sm">areer</span></i>
                        <i ng-hide="skill.career" class="btn btn-default btn-xs" ng-click="toggleCareer(skill.id)">c<span class="hidden-xs hidden-sm">areer</span></i>
                    </div>
                    <div class="col-xs-2 no-padding hidden-print">
                        <i ng-hide="skill.level === '0'" class="decrease glyphicon glyphicon-minus" ng-click="changeSkill(skill.id, -1)"></i>
                        <i ng-show="skill.level === '0'" class="glyphicon glyphicon-minus"></i>
                        <span class="skill_level">{{skill.level}}</span>
                        <i class="increase glyphicon glyphicon-plus" ng-click="changeSkill(skill.id, 1)"></i>
                    </div>
                    <div class="col-xs-2 no-left-padding text-nowrap">
                        <?= $this->Html->image('dice-proficiency.png', ['alt' => 'Proficiency Dice', 'ng-repeat' => 'n in range(skill.dice_details.proficiency)']) ?><?= $this->Html->image('dice-ability.png', ['alt' => 'Ability Dice', 'ng-repeat' => 'n in range(skill.dice_details.ability)']) ?>
                    </div>
                </div>

                <div class="visible-print" ng-repeat="skill in category.skills">
                    <div class="col-xs-8 no-right-padding"><span ng-class="{'text-uppercase': skill.career}">{{skill.name}}</span> ({{skill.stat.code}})</div>
                    <div class="col-xs-4 no-left-padding text-nowrap">
                        <?= $this->Html->image('dice-proficiency.png', ['alt' => 'Proficiency Dice', 'ng-repeat' => 'n in range(skill.dice_details.proficiency)']) ?><?= $this->Html->image('dice-ability.png', ['alt' => 'Ability Dice', 'ng-repeat' => 'n in range(skill.dice_details.ability)']) ?>
                    </div>

                </div>
            </div>
        </div>

        <div ng-cloak class="hidden-print">
            <md-content>
                <md-tabs md-dynamic-height md-border-bottom md-swipe-content="true">
                    <md-tab label="Talents">
                        <md-content>
                            <?= $this->element('character_edit/talents') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Weapons">
                        <md-content>
                            <?= $this->element('character_edit/weapons') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Armour">
                        <md-content>
                            <?= $this->element('character_edit/armour') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Items">
                        <md-content>
                            <?= $this->element('character_edit/items') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Credits ({{totalCredits| number}})">
                        <md-content>
                            <?= $this->element('character_edit/credits') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Experience ({{totalXp| number}})">
                        <md-content>
                            <?= $this->element('character_edit/xp') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Obligation ({{totalObligation| number}})">
                        <md-content>
                            <?= $this->element('character_edit/obligation') ?>
                        </md-content>
                    </md-tab>
                    <md-tab label="Bio">
                        <md-content>
                            <?= $this->element('character_edit/bio') ?>
                        </md-content>
                    </md-tab>
                </md-tabs>
            </md-content>
        </div>

        <div ng-cloak class="visible-print">
            <?= $this->element('character_print/talents') ?>
            <?= $this->element('character_print/weapons') ?>
            <?= $this->element('character_print/armour') ?>
            <?= $this->element('character_print/items') ?>
            <?= $this->element('character_print/credits') ?>
            <?= $this->element('character_print/xp') ?>
            <?= $this->element('character_print/obligation') ?>
            <?= $this->Text->autoParagraph($character->biography) ?>
        </div>

    </div>
</div>
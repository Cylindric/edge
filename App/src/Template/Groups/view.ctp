<?php
$this->Html->script('rpgGroupEdit', ['block' => true]);
$this->Html->addCrumb('Groups', '/Groups');
$this->Html->addCrumb('Edit');
$this->assign('title', $group->name);
$editing = false;

echo $this->Form->create($group);
echo $this->Form->hidden('id', ['id' => 'group_id']);
echo $this->Form->end();
?>
<div class="row" ng-controller="GroupEditCtrl as ctrl">
    <div class="col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">

        <h1>{{group.name}}</h1>

        <div class="col-sm-12 text-center group_view">
            <div class="row title text-uppercase">
                <div class="col-sm-4 col-md-4"></div>
                <div class="col-sm-2 col-md-2">Soak</div>
                <div class="col-sm-3 col-md-3">Strain</div>
                <div class="col-sm-3 col-md-3">Wounds</div>
            </div>

            <div class="row" ng-repeat="cg in group.characters_groups">
                <div class="col-sm-4 col-md-4">
                    <div class="row name">
                        <span class="hidden-print"><a href="#" ng-href="/characters/edit/{{cg.character.id}}">{{cg.character.name}}</a></span>
                        <span class="visible-print">{{cg.character.name}}</span>
                    </div>
                    <div class="row species">
                        {{character.species.name}}
                        <span class="career">{{cg.character.career.name}}</span>
                        <span class="specialisation">{{cg.character.specialisation.name}}</span>
                        <span class="owner">({{cg.character.user.username}})</span>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 value">{{cg.character.total_soak}}</div>
                <div class="col-sm-3 col-md-3">
                    <div class="col-sm-8 value">
                        {{cg.character.strain}}/<span>{{cg.character.total_strain_threshold}}</span>
                    </div>
                    <div class="col-sm-2 buttons">
                        <i class="btn btn-md btn-danger btn-skill-adjust">increase</i>
                        <i class="btn btn-md btn-success btn-skill-adjust">decrease</i>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="col-sm-8 value">
                        {{cg.character.wounds}}/<span>{{cg.character.total_wound_threshold}}</span>
                    </div>
                    <div class="col-sm-4 buttons">
                        <div><i class="btn btn-md btn-success btn-skill-adjust">increase</i></div>
                        <div><i class="btn btn-md btn-danger btn-skill-adjust">decrease</i></div>
                    </div>
                </div>
            </div>

            <div class="row subtitle text-uppercase">
                <div class="col-sm-4 col-md-4">&nbsp;</div>
                <div class="col-sm-2 col-md-2"></div>
                <div class="col-sm-3 col-md-3"></div>
                <div class="col-sm-3 col-md-3"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-sm-6">
                <h2>Weaponry</h2>
                <table class="table table-condensed">
                    <tr>
                        <th>Character</th>
                        <th>Weapon</th>
                        <th>Range</th>
                        <th class="text-right">Damage</th>
                        <th class="text-right">Crit</th>
                        <th>Dice Pool</th>
                        <th>Special</th>
                    </tr>
                    <tr ng-repeat="w in weapons">
                        <td class="text-capitalize">{{w._matchingData.Characters.name}}</td>
                        <td class="text-capitalize">{{w.name}}</td>
                        <td class="text-capitalize">{{w.range.name}}</td>
                        <td class="text-right">{{w.damage}}</td>
                        <td class="text-right">{{w.crit}}</td>
                        <td><?= $this->Html->image('dice-proficiency.png', ['alt' => 'Proficiency Dice', 'ng-repeat' => 'n in range(w.dice_details.proficiency)']) ?><?= $this->Html->image('dice-ability.png', ['alt' => 'Ability Dice', 'ng-repeat' => 'n in range(w.dice_details.ability)']) ?></td>
                        <td>{{w.special}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-sm-3 col-md-3">
                <h2>XP</h2>

                <table class="table table-condensed">
                    <tr ng-repeat="cg in group.characters_groups">
                        <td class="text-capitalize">{{cg.character.name}}</td>
                        <td class="text-right">{{cg.character.total_xp}}</td>
                    </tr>
                    <tr class="success">
                        <td class="text-capitalize">Total</td>
                        <td class="text-right">{{total_xp}}</td>
                    </tr>
                </table>
            </div>

            <div class="col-sm-3 col-md-3">
                <h2>Obligation</h2>
                <table class="table table-condensed">
                    <?php $total = 0; ?>
                    <?php foreach ($obligations as $obligation): $total += $obligation->value; ?>
                        <tr>
                            <td class="text-capitalize"><?= $obligation->type ?></td>
                            <td class="text-right"><?= $obligation->value ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="success">
                        <td class="text-capitalize">Total</td>
                        <td class="text-right"><?= $total ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-sm-3 col-md-3">
                <h2>Credits</h2>
                <table class="table table-condensed">
                    <?php $total = 0; ?>
                    <?php foreach ($group->characters_groups as $character_group): $total += $character_group->character->totalCredits; ?>
                        <tr>
                            <td class="text-capitalize"><?= $character_group->character->name ?></td>
                            <td class="text-right"><?= $this->Number->format($character_group->character->totalCredits) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="success">
                        <td class="text-capitalize">Total</td>
                        <td class="text-right"><?= $this->Number->format($total) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Chronicles</h2>
            <?= $this->Html->link('Add new Chronicle', ['controller' => 'chronicles', 'action' => 'add', $group->id]) ?>
            <div class="row chronicles">
                <div class="col-md-12" ng-repeat="c in chronicles">
                    <h2 class="title">

                        {{c.title}} </h2>
                    <div class="story" marked="c.story"></div>
                    <nav>
                        <ul class="pagination pagination-sm">
                            <li ng-class="{disabled: !c.has_previous}"><a ng-click="getChronicle(total_chronicles)" href='#'><span aria-hidden="true">&larr;</span> Oldest</a></li>
                            <li ng-class="{disabled: !c.has_previous}"><a ng-click="getChronicle(current + 1)" href='#'><span aria-hidden="true">&larr;</span> Older</a></li>
                            <li ng-repeat='page in range(total_chronicles + 1)' ng-class="{active: page === total_chronicles-current}"><a ng-click="getChronicle(total_chronicles - page)" href='#'>{{page + 1}}</a></li>
                            <li ng-class="{disabled: !c.has_next}"><a ng-click="getChronicle(current - 1)" href='#'>Newer <span aria-hidden="true">&rarr;</span></a></li>
                            <li ng-class="{disabled: !c.has_next}"><a ng-click="getChronicle(0)" href='#'>Newest <span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

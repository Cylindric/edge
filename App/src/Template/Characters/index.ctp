<?php $this->Html->addCrumb('Characters'); ?>
<div class="row" ng-controller="CharacterIndexCtrl">
    <div class="col-md-12 col-lg-10 col-lg-offset-1">
        <div class="row" ng-show="characters.length === 0">
            <div class="col-md-12">
                <p>You don't have any characters yet. Why not <?= $this->Html->link('create one', ['action' => 'add']) ?>?</p>
            </div>
        </div>

        <table class="table table-condensed" ng-hide="characters.length === 0">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('species_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="character in characters">
                    <td ng-click="editCharacter(character.id)">{{character.name}}</td>
                    <td>{{character.species.name}}</td>
                    <td class="actions">
                        <span class="glyphicon glyphicon-search" ng-click="viewCharacter(character.id)"></span>
                        <span class="glyphicon glyphicon-pencil" ng-click="editCharacter(character.id)"></span>
                        <span class="glyphicon glyphicon-trash" ng-click="deleteCharacter(character.id)"></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

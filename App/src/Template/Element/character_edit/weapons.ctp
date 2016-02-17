<h3>Weapons</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Weapon</th>
            <th>Qty</th>
            <th>Skill</th>
            <th>Damage</th>
            <th>Range</th>
            <th>Crit</th>
            <th>Special</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="cw in character_weapons">
            <td>{{cw.weapon.name}}</td>
            <td class="actions">
                <span class="decrease glyphicon glyphicon-minus" aria-label="Decrease" ng-click="changeWeaponQty(cw.id, -1)"></span>
                {{cw.quantity}}
                <span class="increase glyphicon glyphicon-plus" aria-label="Increase" ng-click="changeWeaponQty(cw.id, 1)"></span>
            </td>
            <td>{{cw.weapon.skill.name}}</td>
            <td>{{cw.weapon.damage}}</td>
            <td>{{cw.weapon.range.name}}</td>
            <td>{{cw.weapon.crit}}</td>
            <td>{{cw.weapon.special}}</td>
            <td class="col-md-1 actions">
                <i class="btn btn-success btn-xs" ng-show="cw.equipped" ng-click="changeWeaponEquip(cw, false)">Equipped</i>
                <i class="btn btn-default btn-xs" ng-hide="cw.equipped" ng-click="changeWeaponEquip(cw, true)">not equipped</i>
                <i class="btn btn-warning btn-xs hidden-print" ng-click="dropWeapon(cw)">drop</i>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <md-autocomplete 
        md-selected-item="selectedWeapon"
        md-search-text="weaponSearchText" 
        md-selected-item-change="ctrl.selectedWeaponChange(item)"
        md-items="item in ctrl.weaponSearch(weaponSearchText)" 
        md-item-text="item.name" 
        md-min-length="0" 
        placeholder="Enter a new weapon">
        <md-item-template>
            <span md-highlight-text="weaponSearchText" md-highlight-flags="^i">{{item.name}}</span>
        </md-item-template>
        <md-not-found>
            No weapon matching "{{weaponSearchText}}" were found.
        </md-not-found>
    </md-autocomplete>
    <md-button class="md-raised md-primary" ng-click="addWeapon()" ng-disabled="selectedWeaponId === 0">Add</md-button>
</div>

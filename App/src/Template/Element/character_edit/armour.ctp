<h3>Armour</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Armour</th>
            <th>Defence</th>
            <th>Soak</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="ca in character_armour">
            <td>{{ca.armour.name}}</td>
            <td>{{ca.armour.defence}}</td>
            <td>{{ca.armour.soak}}</td>
            <td class="col-md-1 actions">
                <i class="btn btn-success btn-xs" ng-show="ca.equipped" ng-click="changeArmourEquip(ca, false)">Equipped</i>
                <i class="btn btn-default btn-xs" ng-hide="ca.equipped" ng-click="changeArmourEquip(ca, true)">not equipped</i>
                <i class="btn btn-warning btn-xs hidden-print" ng-click="dropArmour(ca)">drop</i>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <md-autocomplete 
        md-selected-item="selectedArmour"
        md-search-text="armourSearchText" 
        md-selected-item-change="ctrl.selectedArmourChange(item)"
        md-items="item in ctrl.armourSearch(armourSearchText)" 
        md-item-text="item.name" 
        md-min-length="0" 
        placeholder="Enter a new armour">
        <md-item-template>
            <span md-highlight-text="armourSearchText" md-highlight-flags="^i">{{item.name}}</span>
        </md-item-template>
        <md-not-found>
            No armour matching "{{armourSearchText}}" were found.
        </md-not-found>
    </md-autocomplete>
    <md-button class="md-raised md-primary" ng-click="addArmour()" ng-disabled="selectedArmourId === 0">Add</md-button>
</div>

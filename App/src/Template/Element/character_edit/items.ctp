<h3>Items</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Item</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="ci in character_items">
            <td>{{ci.item.name}}</td>
            <td class="col-md-1 actions">
                <i class="btn btn-success btn-xs" ng-show="ci.equipped" ng-click="changeWeaponEquip(ci, false)">Equipped</i>
                <i class="btn btn-default btn-xs" ng-hide="ci.equipped" ng-click="changeWeaponEquip(ci, true)">not equipped</i>
                <i class="btn btn-success btn-xs" ng-show="ci.carried" ng-click="changeWeaponEquip(ci, false)">Carried</i>
                <i class="btn btn-default btn-xs" ng-hide="ci.carried" ng-click="changeWeaponEquip(ci, true)">not carried</i>
                <i class="btn btn-warning btn-xs hidden-print" ng-click="dropWeapon(ci)">drop</i>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <md-autocomplete 
        md-selected-item="selecteditem"
        md-search-text="itemSearchText" 
        md-selected-item-change="ctrl.selectedItemChange(item)"
        md-items="item in ctrl.itemSearch(itemSearchText)" 
        md-item-text="item.name" 
        md-min-length="0" 
        placeholder="Enter a new item">
        <md-item-template>
            <span md-highlight-text="itemSearchText" md-highlight-flags="^i">{{item.name}}</span>
        </md-item-template>
        <md-not-found>
            No items matching "{{itemSearchText}}" were found.
        </md-not-found>
    </md-autocomplete>
    <md-button class="md-raised md-primary" ng-click="addItem()" ng-disabled="selectedItemId === 0">Add</md-button>
</div>

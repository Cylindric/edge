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
    <form class="form-inline">
        <input type="hidden" id="new_item_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Item:</div>
                <input type="text" id="new_item_autocomplete" placeholder="enter item name" class="form-control"/>
            </div>

        </div>
    </form>
</div>

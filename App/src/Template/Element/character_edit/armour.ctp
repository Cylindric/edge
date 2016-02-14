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
    <form class="form-inline">
        <input type="hidden" id="new_armour_id"/>

        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">New Armour:</div>
                <input type="text" id="new_armour_autocomplete" placeholder="enter armour name" class="form-control"/>
            </div>

        </div>
    </form>
</div>

<h3>Armour</h3>

<table class="table table-condensed table-bordered">
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
                <i ng-show="ca.equipped">equipped</i>
            </td>
        </tr>
    </tbody>
</table>

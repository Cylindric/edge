<h3>Items</h3>

<table class="table table-condensed table-bordered">
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
                <i ng-show="ci.equipped">equipped</i>
                <i ng-show="ci.carried">carried</i>
            </td>
        </tr>
    </tbody>
</table>

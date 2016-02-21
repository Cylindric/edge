<h3>Experience: <span ng-bind="totalXp"></span></h3>

<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th class="hidden-print">Actions</th>
        <th>Date</th>
        <th class="text-right">XP</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
        <tr ng-repeat="x in xp | orderBy:'-created'  ">
            <td class="col-md-1 text-nowrap hidden-print actions">
                <span class="btn btn-xs btn-danger" ng-click="removeXp(x)">delete</span>
                <span ng-if="x.created_by_gm" class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM {{ x.created_user.username }}</span>
            </td>
            <td class="col-md-2">{{ x.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ x.value | number }}</td>
            <td>{{ x.note }}</td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form ng-submit="addXp()">
        <md-input-container>
            <label>Experience</label>
            <input ng-model="new_xp.value" type="number">
        </md-input-container>
        <md-input-container>
            <label>Note</label>
            <input ng-model="new_xp.note">
        </md-input-container>
        <md-input-container>
            <md-button type="submit" class="md-raised md-primary">Add</md-button>
        </md-input-container>
    </form>
</div>

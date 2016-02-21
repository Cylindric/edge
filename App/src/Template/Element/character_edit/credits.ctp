<h3>Credits: <span ng-bind="totalCredits | number"></span></h3>

<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th class="hidden-print">Actions</th>
            <th>Date</th>
            <th class="text-right">Value</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="credit in credits| orderBy:'-created'">
            <td class="col-md-1 text-nowrap hidden-print actions">
                <span class="btn btn-xs btn-danger" ng-click="removeCredits(credit)">delete</span>
                <span ng-if="credit.created_by_gm" class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM {{ credit.created_user.username}}</span>
            </td>
            <td class="col-md-1 text-nowrap">{{ credit.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ credit.value | number }}</td>
            <td>{{ credit.note}}</td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form ng-submit="addCredits()">
        <md-input-container>
            <label>Credits</label>
            <input ng-model="new_credit.value" type="number">
        </md-input-container>
        <md-input-container>
            <label>Note</label>
            <input ng-model="new_credit.note">
        </md-input-container>
        <md-input-container>
            <md-button type="submit" class="md-raised md-primary">Add</md-button>
        </md-input-container>
    </form>
</div>

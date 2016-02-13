<h3>Credits: {{totalCredits | number}}</h3>

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
        <tr ng-repeat="x in credits | orderBy:'-created'  ">
            <td class="col-md-1 text-nowrap hidden-print actions">
                <span class="btn btn-xs btn-danger" ng-click="removeCredits(x)">delete</span>
                <span ng-if="x.created_by_gm" class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM {{ x.created_user.username }}</span>
            </td>
            <td class="col-md-1 text-nowrap">{{ x.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ x.value | number }}</td>
            <td>{{ x.note }}</td>
        </tr>
    </tbody>
</table>


<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">Credits:</div>
                <input type="number" ng-model="new_credit.value" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" ng-model="new_credit.note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" ng-click="addCredits()">Add</a>
            </div>

        </div>
    </form>
</div>

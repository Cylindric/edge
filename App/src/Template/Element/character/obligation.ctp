<h3>Obligation - <span ng-bind="totalObligation"></span></h3>

<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th class="hidden-print">Actions</th>
        <th>Date</th>
        <th class="text-right">Obligation</th>
        <th>Type</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
        <tr ng-repeat="x in obligations | orderBy:'-created'  ">
            <td class="col-md-1 text-nowrap hidden-print actions">
                <span class="btn btn-xs btn-danger" ng-click="removeObligation(x)">delete</span>
                <span ng-if="x.created_by_gm" class="label label-xs label-warning hidden-print" data-toggle="tooltip" data-placement="right" title="This entry was created by the GM, and can only be deleted by the GM.">GM {{ x.created_user.username }}</span>
            </td>
            <td class="col-md-2">{{ x.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ x.value }}</td>
            <td class="col-md-2">{{ x.type }}</td>
            <td>{{ x.note }}</td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">Obligation</div>
                <input type="number" ng-model="new_obligation.value" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Type</div>
                <input type="text" ng-model="new_obligation.type" placeholder="enter obligation type" class="form-control"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" ng-model="new_obligation.note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" ng-click="addObligation()">Add</a>
            </div>

        </div>
    </form>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
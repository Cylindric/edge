<h3>Obligation: <span ng-bind="totalObligation | number"></span></h3>

<table class="table table-condensed table-bordered">
    <thead>
    <tr>
        <th>Date</th>
        <th class="text-right">Obligation</th>
        <th>Type</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
        <tr ng-repeat="obligation in obligations | orderBy:'-created'  ">
            <td class="col-md-2 text-nowrap">{{ obligation.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ obligation.value }}</td>
            <td class="col-md-2">{{ obligation.type }}</td>
            <td>{{ obligation.note }}</td>
        </tr>
    </tbody>
</table>

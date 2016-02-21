<h3>Credits: <span ng-bind="totalCredits | number"></span></h3>

<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th class="text-right">Value</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="credit in credits | orderBy:'-created'">
            <td class="col-md-2 text-nowrap">{{ credit.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ credit.value | number }}</td>
            <td>{{ credit.note}}</td>
        </tr>
    </tbody>
</table>

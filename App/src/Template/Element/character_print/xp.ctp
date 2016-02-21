<h3>Experience: <span ng-bind="totalXp"></span></h3>

<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th class="text-right">XP</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="x in xp| orderBy:'-created'  ">
            <td class="col-md-2 text-nowrap">{{ x.created | date:'dd/MM/yyyy HH:mm' }}</td>
            <td class="col-md-1 text-right">{{ x.value | number }}</td>
            <td>{{x.note}}</td>
        </tr>
    </tbody>
</table>

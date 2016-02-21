<h3>Talents</h3>

<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Talent</th>
            <th>Rank</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="ct in character_talents">
            <td class="text-nowrap">{{ct.talent.name}}</td>
            <td class="actions">
                <div ng-hide="!ct.talent.ranked">
                    {{ct.rank}}
                </div>
            </td>
            <td>{{ct.talent.description}}</td>
        </tr>
    </tbody>
</table>

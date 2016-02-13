<h3>Talents</h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Talent</th>
            <th>Rank</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="ct in character_talents">
            <td class="text-nowrap"><span class="decrease glyphicon glyphicon-trash" aria-label="Delete" ng-click="deleteTalent(ct.talent_id)"></span> {{ct.talent.name}}</td>
            <td class="actions">
                <div ng-hide="!ct.talent.ranked">
                    <span class="decrease glyphicon glyphicon-minus" aria-label="Decrease" ng-click="changeTalentRank(ct.talent_id, -1)"></span>
                    {{ct.rank}}
                    <span class="increase glyphicon glyphicon-plus" aria-label="Increase" ng-click="changeTalentRank(ct.talent_id, 1)"></span>
                </div>
            </td>
            <td>
                {{ct.talent.description}}
            </td>
        </tr>
    </tbody>
</table>

<div class="col-md-12 hidden-print">
    <md-autocomplete 
        md-selected-item="selectedTalent"
        md-search-text="talentSearchText" 
        md-selected-item-change="ctrl.selectedTalentChange(item)"
        md-items="item in ctrl.talentSearch(talentSearchText)" 
        md-item-text="item.name" 
        md-min-length="0" 
        placeholder="Enter a new talent">
        <md-item-template>
            <span md-highlight-text="talentSearchText" md-highlight-flags="^i">{{item.name}}</span>
        </md-item-template>
        <md-not-found>
            No talents matching "{{talentSearchText}}" were found.
        </md-not-found>
    </md-autocomplete>
    <md-button class="md-raised md-primary" ng-click="addTalent()" ng-disabled="selectedTalentId === 0">Add</md-button>
</div>

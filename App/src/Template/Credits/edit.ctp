<h3>Credits: <span ng-bind="totalCredits"></span></h3>

<table class="table table-striped table-bordered table-condensed">
    <thead>
    <tr>
        <th>Date</th>
        <th class="text-right">Value</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
        <tr ng-repeat="x in credits">
            <td class="col-md-2">
                {{x.created}}
            </td>
            <td class="col-md-1 text-right">{{x.value}}</td>
            <td>{{x.note}}</td>
        </tr>
    </tbody>
</table>


<div class="col-md-12 hidden-print">
    <form class="form-inline">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-addon">Credits:</div>
                <input type="number" id="new_credits" placeholder="0" class="form-control text-right"/>
            </div>

            <div class="input-group">
                <div class="input-group-addon">Notes</div>
                <input type="text" id="new_credits_note" placeholder="enter any notes" class="form-control"/>
            </div>

            <div class="input-group">
                <a class="btn btn-primary" id="new_credits_submit">Add</a>
            </div>

        </div>
    </form>
</div>

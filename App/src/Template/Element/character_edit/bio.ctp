<h3>Bio</h3>
<div class="col-md-12 hidden-print">
    <form ng-submit="updateBio()">
        <md-input-container class="md-block">
            <label>Biography</label>
            <textarea ng-model="character.biography" rows="15"></textarea>
        </md-input-container>
        <md-progress-linear md-mode="indeterminate" ng-class="{'invisible' : !bio_saving}"></md-progress-linear>
        <md-input-container>
            <md-button type="submit" class="md-raised md-primary">Update</md-button>
        </md-input-container>
    </form>
</div>
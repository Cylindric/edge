<?php
echo $this->Form->create($group);
echo $this->Form->hidden('id', ['id' => 'group_id']);
echo $this->Form->end();
?>
<div class="row" ng-cloak ng-controller="ChronicleIndexCtrl as ctrl">
    <div class="col-md-12">
        <h3>Chronicles</h3>
        <div class="row">
            <div class="col-md-12 story" ng-repeat="c in chronicles">
                <div class="row">
                    <div class="col-md-10 bottom" ng-class="{ 'not_published': !c.published }" ><a name="chronicle_{{c.id}}"></a>
                        <h2 class="title">{{c.title}}</h2>
                    </div>
                    <div class="col-md-2 text-right">
                        <button type="button" class="btn btn-success" aria-label="Un-Publish" ng-show="c.editable && c.published" ng-click="publish(c, false)"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-warning" aria-label="Publish" ng-show="c.editable && !c.published" ng-click="publish(c, true)"><span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-primary" aria-label="Edit" ng-show="c.editable" ng-click="edit(c)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-danger" aria-label="Delete" ng-show="c.editable" ng-click="delete(c, $event)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 story" ng-class="{ 'not_published': !c.published }" marked="c.story">
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn btn-default" aria-label="Add new Chronicle" ng-click='add()'>
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Chronicle
        </button>

    </div>
</div>

rpgAppNg.controller('ChronicleIndexCtrl', ['$scope', '$http', '$mdDialog', '$location', '$window', 'chronicleService',
    function ($scope, $http, $mdDialog, $location, $window, chronicleService) {

        $scope.group_id = $location.path().split(/[\s/]+/).pop();
        chronicleService.groupIndex($scope.group_id, function (data) {
            $scope.chronicles = data;
        });

        $scope.add = function () {
            $window.location.href = '/chronicles/add/' + $scope.group_id;
        };

        $scope.publish = function (item, published) {
            chronicleService.publishStory(item, published, function (data) {

            });
        };

        $scope.delete = function (item, ev) {

            var confirm = $mdDialog.confirm()
                    .title('Are you sure you want to delete this story?')
                    .textContent(item.title)
                    .ariaLabel('Delete Chronicle')
                    .targetEvent(ev)
                    .ok('Delete it!')
                    .cancel('No! Go back...');

            $mdDialog.show(confirm).then(function () {
                console.log("test");
//                chronicleService.deleteChronicle(item, function (item, data) {
//                    $scope.chronicles.splice(item, 1);
//                });
            }, function () {
                // don't delete
            });
        };
    }
]);
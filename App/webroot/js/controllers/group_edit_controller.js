rpgAppNg.controller('GroupEditCtrl', ['$scope', '$http',
    function ($scope, $http) {

        // Get the Group ID
        var group_id = angular.element('#group_id')[0].value;

        ////////////////////////////////////////////////////////////////////////
        // GROUP MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateGroup() {
            $http
                    .get("/groups/edit/" + group_id + ".json")
                    .success(function (response) {
                        $scope.group = response.group;
                        $scope.weapons = response.weapons;
                        $scope.obligations = response.obligations;

                        $scope.total_xp = 0;
                        angular.forEach($scope.group.characters_groups, function (v, k) {
                            $scope.total_xp = $scope.total_xp + parseInt(v.character.total_xp);
                        });
                    });
        }
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // CHRONICLES MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateChronicles() {
            $http
                    .post("/chronicles/edit_for_group.json", {
                        group_id: group_id
                    })
                    .then(function (response) {
                        $scope.chronicles = response.data.chronicles;
                    });
        }
        // </editor-fold>

        $scope.range = function (count) {
            var list = [];
            for (var i = 0; i < count; i++) {
                list.push(i);
            }
            return list;
        };

        // Call all the functions to populate the initial data
        updateGroup();
        updateChronicles();

    }]);
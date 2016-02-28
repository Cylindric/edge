rpgAppNg.controller('GroupViewCtrl', ['$scope', '$http', '$window',
    function ($scope, $http, $window) {

        // Get the Group ID
        var group_id = angular.element('#group_id')[0].value;

        ////////////////////////////////////////////////////////////////////////
        // GROUP MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateGroup() {
            $http
                    .get("/groups/view/" + group_id + ".json")
                    .success(function (response) {
                        $scope.group = response.group;
                        $scope.weapons = response.weapons;
                        $scope.obligations = response.obligations;

                        $scope.total_credits = 0;
                        $scope.total_obligation = 0;
                        $scope.total_xp = 0;
                        angular.forEach($scope.group.characters_groups, function (v, k) {
                            $scope.total_credits += parseInt(v.character.total_credits);
                            $scope.total_obligation += parseInt(v.character.total_obligation);
                            $scope.total_xp += parseInt(v.character.total_xp);
                        });
                    });
        }
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // CHRONICLES MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        $scope.current = 0;

        $scope.getChronicle = function (c) {
            $scope.current = c;
            updateChronicles();
        };

        $scope.addChronicle = function () {
            $window.location.href = '/chronicles/add/' + group_id;
        };
        
        function updateChronicles() {
            $http
                    .post("/chronicles/index.json", {
                        group_id: group_id,
                        offset: $scope.current
                    })
                    .then(function (response) {
                        $scope.chronicles = response.data.chronicles;
                        $scope.total_chronicles = response.data.total_chronicles - 1;
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
var rpgControllers = angular.module('rpgControllers', []);

rpgAppNg.controller('CharacterCtrl', ['$scope', '$routeParams', '$http',
    function ($scope, $routeParams, $http) {

        // Get the Character ID
        var character_id = $(document).find('input[name="id"]').val();

        $scope.updateStats = function () {
            $http.get("/characters/get_stats/" + character_id + ".json")
                .success(function (response) {
                    $scope.soak = response.soak;
                    $scope.soak_breakdown = response.soak_breakdown;
                    $scope.strain_threshold = response.strain_threshold;
                    $scope.strain = response.strain;
                    $scope.strain_threshold_breakdown = response.strain_threshold_breakdown;
                    $scope.wound_threshold = response.wound_threshold;
                    $scope.wound_threshold_breakdown = response.wound_threshold_breakdown;
                    $scope.wounds = response.wounds;
                    $scope.defence_melee = response.defence_melee;
                    $scope.defence_ranged = response.defence_ranged;
                    $scope.stats = response.stats;
                });
        };

        $scope.updateStats();

        // Get the initial list of Credits
        $http.get("/credits/edit/" + character_id + ".json")
            .success(function (response) {
                $scope.credits = response.credits;
                $scope.totalCredits = response.total;
            });

        // Get the initial list of XP
        $http.get("/xp/edit/" + character_id + ".json")
            .success(function (response) {
                $scope.xp = response.xp;
                $scope.totalXp = response.total;
            });

        // Get the initial list of Obligations
        $http.get("/obligations/edit/" + character_id + ".json")
            .success(function (response) {
                $scope.obligations = response.obligations;
                $scope.totalObligation = response.total;
            });

        // Edits
        $scope.changeAttribute = function (item, change) {
            $http.post("/characters/change_attribute.json", {
                character_id: character_id,
                attribute_code: item,
                delta: change
            }).then(function successCallback(response) {
                $scope.updateStats();
            });
        }

        $scope.changeStat = function (item, change) {
            $http.post("/characters/change_stat.json", {
                character_id: character_id,
                stat_code: item,
                delta: change
            }).then(function successCallback(response) {
                $scope.updateStats();
            });
        }

        // Adds
        $scope.addCredits = function () {
            $http.post("/credits/add.json", {
                character_id: character_id,
                value: $scope.new_credit.value,
                note: $scope.new_credit.note
            }).then(function successCallback(response) {
                $scope.credits.push(response.data.data);
                $scope.totalCredits = response.data.total;
            });
        }

        $scope.addObligation = function () {
            $http.post("/obligations/add.json", {
                character_id: character_id,
                value: $scope.new_obligation.value,
                type: $scope.new_obligation.type,
                note: $scope.new_obligation.note
            }).then(function successCallback(response) {
                $scope.obligations.push(response.data.data);
                $scope.totalObligation = response.data.total;
            });
        }

        $scope.addXp = function () {
            $http.post("/xp/add.json", {
                character_id: character_id,
                value: $scope.new_xp.value,
                note: $scope.new_xp.note
            }).then(function successCallback(response) {
                $scope.xp.push(response.data.data);
                $scope.totalXp = response.data.total;
            });
        }

        // Removes
        $scope.removeCredits = function (item) {
            var index = $scope.credits.indexOf(item);
            $http.post("/credits/delete.json", {
                character_id: character_id,
                credit_id: item.id
            }).then(function successCallback(response) {
                $scope.credits.splice(index, 1);
                $scope.totalCredits = response.data.total;
            });

        }

        $scope.removeXp = function (item) {
            var index = $scope.xp.indexOf(item);
            $http.post("/xp/delete.json", {
                character_id: character_id,
                xp_id: item.id
            }).then(function successCallback(response) {
                $scope.xp.splice(index, 1);
                $scope.totalXp = response.data.total;
            });
        }

        $scope.removeObligation = function (item) {
            var index = $scope.obligations.indexOf(item);
            $http.post("/obligations/delete.json", {
                character_id: character_id,
                obligation_id: item.id
            }).then(function successCallback(response) {
                $scope.obligations.splice(index, 1);
                $scope.totalObligation = response.data.total;
            });
        }

    }]);
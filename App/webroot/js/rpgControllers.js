var rpgControllers = angular.module('rpgControllers', []);

rpgAppNg.factory('talentService', function ($http) {
    var getTalents = function (callbackFn) {
        $http.get("/talents.json").then(function (response) {
            callbackFn(response);
        });
    };

    var addTalent = function (talent_id, character_id, callbackFn) {
        $http.post("/character_talents/add.json", {
            character_id: character_id,
            talent_id: talent_id
        }).then(function (response) {
            if (response.data.response.result == 'success') {
                callbackFn(response.data.response.data);
            }
        });
    };

    var deleteTalent = function (talent_id, character_id, callbackFn) {
        $http.post("/character_talents/delete.json", {
            character_id: character_id,
            talent_id: talent_id
        }).then(function (response) {
            if (response.data.response.result == 'success') {
                callbackFn(response.data.response.data);
            }
        });
    };

    var changeRank = function (talent_id, character_id, delta, callbackFn) {
        $http.post("/character_talents/change_rank.json", {
            character_id: character_id,
            talent_id: talent_id,
            delta: delta
        }).then(function (response) {
            callbackFn(response.data.response);
        });
    };

    return {
        getTalents: getTalents,
        addTalent: addTalent,
        deleteTalent: deleteTalent,
        changeRank: changeRank
    };
});

rpgAppNg.controller('CharacterCtrl', ['$scope', 'talentService', '$http', '$filter',
    function ($scope, talentService, $http, $filter) {

        // Get the Character ID
        var character_id = $(document).find('input[name="id"]').val();

        // Talent auto-complete
        talentService.getTalents(function (talents) {
            this.talentList = talents.data.talents;
        });

        this.talentSearch = talentSearch;
        this.selectedTalentChange = selectedTalentChange;

        function talentSearch(query) {
            var results = query ? $filter('filter')(talentList, {name: createTalentFilterFor(query)}) : talentList,
                    deferred;
            return results;
        }

        function selectedTalentChange(item) {
            if (item) {
                talentService.addTalent(item.id, character_id, function (result) {
                    updateTalents();
                });
                $scope.searchText = '';
                $scope.selectedTalent = undefined;
            }
        }

        function createTalentFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);
            return lowercaseQuery;
        }

        function updateStats() {
            $http
                    .get("/characters/get_stats/" + character_id + ".json")
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
        }
        ;

        // Get the initial list of Credits
        function updateCredits() {
            $http
                    .get("/credits/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.credits = response.credits;
                        $scope.totalCredits = response.total;
                    });
        }
        ;

        // Get the initial list of Obligations
        function updateObligations() {
            $http
                    .get("/obligations/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.obligations = response.obligations;
                        $scope.totalObligation = response.total;
                    });
        }
        ;

        // Get the initial list of Skills
        function updateSkills() {
            $http
                    .get("/characters/get_skills/" + character_id + ".json")
                    .success(function (response) {
                        var list = [];
                        list.push({'name': "General Skills", 'skills': response.skills.filter(function (value) {
                                return value.skilltype_id === 1;
                            })});
                        list.push({'name': "Combat Skills", 'skills': response.skills.filter(function (value) {
                                return value.skilltype_id === 2;
                            })});
                        list.push({'name': "Knowledge Skills", 'skills': response.skills.filter(function (value) {
                                return value.skilltype_id === 3;
                            })});
                        $scope.skill_categories = list;
                    });
        }
        ;

        // Get the initial list of Talents
        function updateTalents() {
            $http
                    .get("/character_talents/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.talents = response.talents;
                    });
        }

        // Get the initial list of XP
        function updateXp() {
            $http
                    .get("/xp/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.xp = response.xp;
                        $scope.totalXp = response.total;
                    });
        }
        ;

        // Edits
        $scope.changeTalentRank = function (talent_id, delta) {
            talentService.changeRank(talent_id, character_id, delta, function (result) {
                updateTalents();
            });
        };

        $scope.deleteTalent = function (talent_id, delta) {
            talentService.deleteTalent(talent_id, character_id, function (result) {
                updateTalents();
            });
        };

        $scope.changeAttribute = function (item, change) {
            $http.post("/characters/change_attribute.json", {
                character_id: character_id,
                attribute_code: item,
                delta: change
            }).then(function successCallback(response) {
                $scope.updateStats();
                $scope.updateSkills();
            });
        };

        $scope.changeStat = function (item, change) {
            $http.post("/characters/change_stat.json", {
                character_id: character_id,
                stat_code: item,
                delta: change
            }).then(function successCallback(response) {
                $scope.updateStats();
                $scope.updateSkills();
            });
        };

        $scope.changeSkill = function (item, change) {
            $http.post("/character_skills/change.json", {
                character_id: character_id,
                skill_id: item,
                delta: change
            }).then(function successCallback(response) {
                $scope.updateSkills();
            });
        };

        $scope.toggleCareer = function (item) {
            $http.post("/character_skills/toggle_career.json", {
                character_id: character_id,
                skill_id: item
            }).then(function successCallback(response) {
                $scope.updateSkills();
            });
        };

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
        };

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
        };

        $scope.addXp = function () {
            $http.post("/xp/add.json", {
                character_id: character_id,
                value: $scope.new_xp.value,
                note: $scope.new_xp.note
            }).then(function successCallback(response) {
                $scope.xp.push(response.data.data);
                $scope.totalXp = response.data.total;
            });
        };

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

        };

        $scope.removeXp = function (item) {
            var index = $scope.xp.indexOf(item);
            $http.post("/xp/delete.json", {
                character_id: character_id,
                xp_id: item.id
            }).then(function successCallback(response) {
                $scope.xp.splice(index, 1);
                $scope.totalXp = response.data.total;
            });
        };

        $scope.removeObligation = function (item) {
            var index = $scope.obligations.indexOf(item);
            $http.post("/obligations/delete.json", {
                character_id: character_id,
                obligation_id: item.id
            }).then(function successCallback(response) {
                $scope.obligations.splice(index, 1);
                $scope.totalObligation = response.data.total;
            });
        };

        $scope.range = function (count) {
            var list = [];
            for (var i = 0; i < count; i++) {
                list.push(i);
            }
            return list;
        };

        // Call all the functions to populate the initial data
        updateCredits();
        updateStats();
        updateSkills();
        updateTalents();
        updateObligations();
        updateXp();

    }]);
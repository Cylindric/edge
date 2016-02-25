rpgAppNg.controller('CharacterEditCtrl', ['$scope', 'armourService', 'creditService', 'itemService', 'obligationService', 'talentService', 'weaponService', 'xpService', '$http',
    function ($scope, armourService, creditService, itemService, obligationService, talentService, weaponService, xpService, $http) {

        // Get the Character ID
        var character_id = angular.element('#character_id')[0].value;

        // Armour auto-complete
        armourService.getArmour(function () {});
        this.armourSearch = armourService.armourSearch;
        this.selectedArmourChange = selectedArmourChange;
        $scope.selectedArmourId = 0;

        function selectedArmourChange(item) {
            if (item) {
                $scope.selectedArmourId = item.id;
            }
        }

        // Item auto-complete
        itemService.getItems(function () {});
        this.itemSearch = itemService.itemSearch;
        this.selectedItemChange = selectedItemChange;
        $scope.selectedItemId = 0;

        function selectedItemChange(item) {
            if (item) {
                $scope.selectedItemId = item.id;
            }
        }

        // Talent auto-complete
        talentService.getTalents(function () {});
        this.talentSearch = talentService.talentSearch;
        this.selectedTalentChange = selectedTalentChange;
        $scope.selectedTalentId = 0;

        function selectedTalentChange(item) {
            if (item) {
                $scope.selectedTalentId = item.id;
            }
        }

        // Weapon auto-complete
        weaponService.getWeapons(function () {});
        this.weaponSearch = weaponService.weaponSearch;
        this.selectedWeaponChange = selectedWeaponChange;
        $scope.selectedWeaponId = 0;

        function selectedWeaponChange(item) {
            if (item) {
                $scope.selectedWeaponId = item.id;
            }
        }

        // Highlight skills
        $scope.highlightSkills = function (id) {
            $scope.skill_categories.forEach(function (skill_category) {

                skill_category.skills.forEach(function (skill) {
                    if (skill.stat.code === id) {
                        skill.highlight = 'skill_row_highlight';
                    } else {
                        skill.highlight = '';
                    }
                });
            });
        };

        function updateCharacter() {
            $http
                    .get("/characters/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.character = response.character;
                    });
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

        // Get the initial list of Skills
        function updateSkills() {
            $http
                    .get("/characters/get_skills/" + character_id + ".json")
                    .success(function (response) {
                        var list = [];

                        response.skills.forEach(function (skill) {
                            skill.highlight = '';
                        });

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

        ////////////////////////////////////////////////////////////////////////
        // ARMOUR MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateArmour() {
            $http
                    .get("/character_armour/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.character_armour = response;
                    });
        }

        $scope.addArmour = function () {
            if ($scope.selectedArmourId > 0) {
                armourService.addArmour($scope.selectedArmourId, character_id, function (result) {
                    $scope.character_armour.push(result);
                    $scope.armourSearchText = '';
                });
            }
        };

        $scope.dropArmour = function (link) {
            armourService.deleteArmour(link, function (link, result) {
                $scope.character_armour.splice(link, 1);
            });
        };

        $scope.changeArmourEquip = function (link, equipped) {
            armourService.setEquipped(link, equipped, function (link, result) {
                link.equipped = result.equipped;
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // BIOGRAPHY MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        $scope.bio_saving = false;

        $scope.updateBio = function () {
            $scope.bio_saving = true;
            $http.post("/characters/update_bio.json", {
                character_id: character_id,
                biography: $scope.character.biography
            }).then(function (response) {
                if (response.status === 200) {
                    $scope.character.biography = response.data.biography;
                    $scope.bio_saving = false;
                }
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // CREDIT MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateCredits() {
            $http
                    .get("/credits/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.credits = response.credits;
                        $scope.totalCredits = response.total;
                    });
        }

        $scope.addCredits = function () {
            $scope.new_credit.character_id = character_id;
            creditService.addCredits($scope.new_credit, function (result) {
                $scope.credits.push(result.data);
                $scope.totalCredits = result.total;
                $scope.new_credit = null;
            });
        };

        $scope.removeCredits = function (record) {
            creditService.deleteCredits(record, function (record, result) {
                var index = $scope.credits.indexOf(record);
                $scope.credits.splice(index, 1);
                $scope.totalCredits = result.total;
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // ITEM MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateItems() {
            $http
                    .get("/character_items/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.character_items = response;
                    });
        }

        $scope.addItem = function () {
            if ($scope.selectedItemId > 0) {
                itemService.addItem($scope.selectedItemId, character_id, function (result) {
                    $scope.character_items.push(result);
                    $scope.itemSearchText = '';
                });
            }
        };

        $scope.dropItem = function (link) {
            itemService.deleteItem(link, function (link, result) {
                var index = $scope.character_item.indexOf(link);
                $scope.character_item.splice(index, 1);
            });
        };

        $scope.changeItemEquip = function (link, equipped) {
            itemService.setEquipped(link, equipped, function (link, result) {
                link.equipped = result.equipped;
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // OBLIGATION MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateObligations() {
            $http
                    .get("/obligations/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.obligations = response.obligations;
                        $scope.totalObligation = response.total;
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
                $scope.new_obligation = null;
            });
        };

        $scope.removeObligation = function (item) {
            obligationService.deleteObligation(item, function (item, result) {
                var index = $scope.obligations.indexOf(item);
                $scope.obligations.splice(index, 1);
                $scope.totalObligation = result.total;
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // TALENT MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateTalents() {
            $http
                    .get("/character_talents/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.character_talents = response.talents;
                    });
        }

        $scope.addTalent = function () {
            if ($scope.selectedTalentId > 0) {
                talentService.addTalent($scope.selectedTalentId, character_id, function (result) {
                    updateTalents();
                    $scope.talentSearchText = '';
                });
            }
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // WEAPON MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateWeapons() {
            $http
                    .get("/character_weapons/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.character_weapons = response;
                    });
        }

        $scope.addWeapon = function () {
            if ($scope.selectedWeaponId > 0) {
                weaponService.addWeapon($scope.selectedWeaponId, character_id, function (result) {
                    $scope.character_weapons.push(result);
                    $scope.weaponSearchText = '';
                });
            }
        };

        $scope.dropWeapon = function (link) {
            weaponService.deleteWeapon(link, function (link, result) {
                $scope.character_weapons.splice(link, 1);
            });
        };

        $scope.changeWeaponEquip = function (link, equipped) {
            weaponService.setEquipped(link, equipped, function (link, result) {
                link.equipped = result.equipped;
            });
        };
        // </editor-fold>

        ////////////////////////////////////////////////////////////////////////
        // XP MANAGEMENT
        ////////////////////////////////////////////////////////////////////////
        // <editor-fold>
        function updateXp() {
            $http
                    .get("/xp/edit/" + character_id + ".json")
                    .success(function (response) {
                        $scope.xp = response.xp;
                        $scope.totalXp = response.total;
                    });
        }

        $scope.addXp = function () {
            $scope.new_xp.character_id = character_id;
            xpService.addXp($scope.new_xp, function (result) {
                $scope.xp.push(result.data);
                $scope.totalXp = result.total;
                $scope.new_xp = null;
            });
        };

        $scope.removeXp = function (record) {
            xpService.deleteXp(record, function (record, result) {
                var index = $scope.xp.indexOf(record);
                $scope.xp.splice(index, 1);
                $scope.totalXp = result.total;
            });
        };
        // </editor-fold>



        // Edits
        $scope.changeTalentRank = function (talent_id, delta) {
            talentService.changeRank(talent_id, character_id, delta, function (result) {
                updateTalents();
                updateXp();

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
                updateStats();
                updateSkills();
                updateXp();
            });
        };

        $scope.changeStat = function (item, change) {
            $http.post("/characters/change_stat.json", {
                character_id: character_id,
                stat_code: item,
                delta: change
            }).then(function successCallback(response) {
                updateStats();
                updateSkills();
            });
        };

        $scope.changeSkill = function (item, change) {
            $http.post("/character_skills/change.json", {
                character_id: character_id,
                skill_id: item,
                delta: change
            }).then(function successCallback(response) {
                updateSkills();
                updateXp();
            });
        };

        $scope.toggleCareer = function (item) {
            $http.post("/character_skills/toggle_career.json", {
                character_id: character_id,
                skill_id: item
            }).then(function successCallback(response) {
                updateSkills();
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
        updateCharacter();
        updateCredits();
        updateStats();
        updateSkills();
        updateTalents();
        updateObligations();
        updateXp();
        updateWeapons();
        updateArmour();
        updateItems();

    }]);
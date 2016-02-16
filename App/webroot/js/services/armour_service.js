rpgAppNg.factory('armourService', function ($http) {

    var getArmour = function (callbackFn) {
        $http.get("/armour.json").then(function (response) {
            callbackFn(response);
        });
    };

    var addArmour = function (armour_id, character_id, callbackFn) {
        $http.post("/character_armour/add.json", {
            character_id: character_id,
            armour_id: armour_id
        }).then(function (response) {
            if (response.data.response.result === 'success') {
                callbackFn(response.data);
            }
        });
    };

    var deleteArmour = function (link, callbackFn) {
        $http.post("/character_armour/delete.json", {
            character_id: link.character_id,
            armour_id: link.armour_id,
            id: link.id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(link, response.data);
            }
        });
    };

    var setEquipped = function (link, equipped, callbackFn) {
        $http.post("/character_armour/set_equipped.json", {
            character_id: link.character_id,
            armour_id: link.armour_id,
            id: link.id,
            equipped: equipped
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(link, response.data);
            }
        });
    };

    return {
        getArmour: getArmour,
        addArmour: addArmour,
        deleteArmour: deleteArmour,
        setEquipped: setEquipped
    };
});


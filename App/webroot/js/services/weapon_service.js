rpgAppNg.factory('weaponService', function ($http) {

    var getWeapons = function (callbackFn) {
        $http.get("/weapons.json").then(function (response) {
            callbackFn(response);
        });
    };

    var addWeapon = function (weapon_id, character_id, callbackFn) {
        $http.post("/character_weapons/add.json", {
            character_id: character_id,
            weapon_id: weapon_id
        }).then(function (response) {
            if (response.data.response.result === 'success') {
                callbackFn(response.data);
            }
        });
    };

    var deleteWeapon = function (link, callbackFn) {
        $http.post("/character_weapons/delete.json", {
            id: link.id,
            character_id: link.character_id,
            weapon_id: link.weapon_id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(response.data);
            }
        });
    };

    var setEquipped = function (link, equipped, callbackFn) {
        $http.post("/character_weapons/set_equipped.json", {
            character_id: link.character_id,
            weapon_id: link.weapon_id,
            id: link.id,
            equipped: equipped
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(link, response.data);
            }
        });
    };

    return {
        getWeapons: getWeapons,
        addWeapon: addWeapon,
        deleteWeapon: deleteWeapon,
        setEquipped: setEquipped
    };
});


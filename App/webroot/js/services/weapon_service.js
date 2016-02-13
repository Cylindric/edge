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
                callbackFn(response.data.response.data);
            }
        });
    };

    var deleteWeapon = function (weapon_id, character_id, callbackFn) {
        $http.post("/character_weapons/delete.json", {
            character_id: character_id,
            weapon_id: weapon_id
        }).then(function (response) {
            if (response.data.response.result === 'success') {
                callbackFn(response.data.response.data);
            }
        });
    };

    var setEquipped = function (link_id, character_id, equipped, callbackFn) {
        $http.post("/character_weapons/set_equipped.json", {
            character_id: character_id,
            link_id: link_id,
            equipped: equipped
        }).then(function (response) {
            if (response.data.result === 'success') {
                callbackFn(response.data.character_weapon);
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


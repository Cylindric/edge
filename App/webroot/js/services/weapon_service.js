rpgAppNg.factory('weaponService', ['$http', '$filter', function ($http, $filter) {

        var weaponList;

        /*
         * Get a list of every weapon available.
         * The result is internally cached for auto-complete lookups.
         */
        var getWeapons = function (callbackFn) {
            $http.get("/weapons.json").then(function (response) {
                weaponList = response.data;
                callbackFn(response);
            });
        };

        /*
         * Return a list of all weapons matching the supplied query
         */
        var weaponSearch = function (query) {
            var results = query ? $filter('filter')(weaponList, {name: query}) : weaponList, deferred;
            return results;
        };

        var addWeapon = function (weapon_id, character_id, callbackFn) {
            $http.post("/character_weapons/add.json", {
                character_id: character_id,
                weapon_id: weapon_id
            }).then(function (response) {
                if (response.status === 200) {
                    callbackFn(response.data.data);
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
            weaponSearch: weaponSearch,
            addWeapon: addWeapon,
            deleteWeapon: deleteWeapon,
            setEquipped: setEquipped
        }
        ;
    }]);


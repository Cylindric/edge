rpgAppNg.factory('armourService', ['$http', '$filter', function ($http, $filter) {

        var armourList;

        /*
         * Get a list of every armour available.
         * The result is internally cached for auto-complete lookups.
         */
        var getArmour = function (callbackFn) {
            $http.get("/armour.json").then(function (response) {
                armourList = response.data;
                callbackFn(response);
            });
        };

        /*
         * Return a list of all armour matching the supplied query
         */
        var armourSearch = function (query) {
            var results = query ? $filter('filter')(armourList, {name: query}) : armourList, deferred;
            return results;
        };

        var addArmour = function (armour_id, character_id, callbackFn) {
            $http.post("/character_armour/add.json", {
                character_id: character_id,
                armour_id: armour_id
            }).then(function (response) {
                if (response.status === 200) {
                    callbackFn(response.data.data);
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
            armourSearch: armourSearch,
            getArmour: getArmour,
            addArmour: addArmour,
            deleteArmour: deleteArmour,
            setEquipped: setEquipped
        };
    }]);

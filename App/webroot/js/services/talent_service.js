rpgAppNg.factory('talentService', ['$http', '$filter', function ($http, $filter) {

        var talentList;

        /*
         * Get a list of every talent available.
         * The result is internally cached for auto-complete lookups.
         */
        var getTalents = function (callbackFn) {
            $http.get("/talents.json").then(function (response) {
                talentList = response.data;
                callbackFn(response);
            });
        };

        /*
         * Return a list of all talents matching the supplied query
         */
        var talentSearch = function (query) {
            var results = query ? $filter('filter')(talentList, {name: query}) : talentList, deferred;
            return results;
        };

        var addTalent = function (talent_id, character_id, callbackFn) {
            $http.post("/character_talents/add.json", {
                character_id: character_id,
                talent_id: talent_id
            }).then(function (response) {
                if (response.data.response.result === 'success') {
                    callbackFn(response.data.response.data);
                }
            });
        };

        var deleteTalent = function (talent_id, character_id, callbackFn) {
            $http.post("/character_talents/delete.json", {
                character_id: character_id,
                talent_id: talent_id
            }).then(function (response) {
                if (response.data.response.result === 'success') {
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
            changeRank: changeRank,
            talentSearch: talentSearch
        };
    }]);


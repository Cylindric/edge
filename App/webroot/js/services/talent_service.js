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
        changeRank: changeRank
    };
});


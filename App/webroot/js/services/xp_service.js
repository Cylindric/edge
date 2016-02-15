rpgAppNg.factory('xpService', function ($http) {

    var deleteXp = function (record, callbackFn) {
        $http.post("/xp/delete.json", {
            character_id: record.character_id,
            xp_id: record.id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(record, response.data);
            }
        });
    };

    return {
        deleteXp: deleteXp
    };

});


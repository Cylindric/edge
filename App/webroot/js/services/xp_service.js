rpgAppNg.factory('xpService', function ($http) {

    var addXp = function (record, callbackFn) {
        $http.post("/xp/add.json", {
            character_id: record.character_id,
            value: record.value,
            note: record.note
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(response.data);
            }
        });
    };

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
        addXp: addXp,
        deleteXp: deleteXp
    };

});


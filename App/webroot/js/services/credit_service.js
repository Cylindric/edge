rpgAppNg.factory('creditService', function ($http) {

    var addCredits = function (value, character_id, callbackFn) {
        $http.post("/credits/add.json", {
            character_id: character_id,
            value: value
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(response.data);
            }
        });
    };

    var deleteCredits = function (record, callbackFn) {
        $http.post("/credits/delete.json", {
            character_id: record.character_id,
            credit_id: record.id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(record, response.data);
            }
        });
    };

    return {
        addCredits: addCredits,
        deleteCredits: deleteCredits
    };
});


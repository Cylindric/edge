rpgAppNg.factory('creditService', function ($http) {

    var addCredits = function (record, callbackFn) {
        $http.post("/credits/add.json", {
            character_id: record.character_id,
            value: record.value,
            note: record.note
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


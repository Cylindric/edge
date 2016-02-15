rpgAppNg.factory('obligationService', function ($http) {

    var deleteObligation = function (record, callbackFn) {
        $http.post("/obligations/delete.json", {
            character_id: record.character_id,
            obligation_id: record.id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(record, response.data);
            }
        });
    };

    return {
        deleteObligation: deleteObligation
    };

});


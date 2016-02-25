rpgAppNg.factory('chronicleService', ['$http', function ($http) {

        var groupIndex = function (group_id, callbackFn) {
            $http.post("/chronicles.json", {
                group_id: group_id
            }).then(function (response) {
                callbackFn(response.data);
            });
        };

        var deleteChronicle = function (item, callbackFn) {
            $http.post("/chronicles/delete.json", {
                chronicle_id: item.id
            }).then(function (response) {
                if (response.status === 200) {
                    callbackFn(item, response.data);
                }
            });
        };

        var publishChronicle = function (item, published, callbackFn) {
            $http.post("/chronicles/publish.json", {
                chronicle_id: item.id,
                published: published
            }).then(function (response) {
                if (response.status === 200) {
                    callbackFn(item, response.data);
                }
            });
        };

        return {
            groupIndex: groupIndex,
            publishChronicle: publishChronicle,
            deleteChronicle: deleteChronicle
        };
    }]);

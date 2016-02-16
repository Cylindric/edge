rpgAppNg.factory('itemService', function ($http) {

    var getItems = function (callbackFn) {
        $http.get("/items.json").then(function (response) {
            callbackFn(response);
        });
    };

    var addItem = function (item_id, character_id, callbackFn) {
        $http.post("/character_items/add.json", {
            character_id: character_id,
            item_id: item_id
        }).then(function (response) {
            if (response.data.response.result === 'success') {
                callbackFn(response.data);
            }
        });
    };

    var deleteItem = function (link, callbackFn) {
        $http.post("/character_items/delete.json", {
            id: link.id,
            character_id: link.character_id,
            item_id: link.item_id
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(response.data);
            }
        });
    };

    var setEquipped = function (link, equipped, callbackFn) {
        $http.post("/character_items/set_equipped.json", {
            character_id: link.character_id,
            item_id: link.item_id,
            id: link.id,
            equipped: equipped
        }).then(function (response) {
            if (response.status === 200) {
                callbackFn(link, response.data);
            }
        });
    };

    return {
        getItems: getItems,
        addItem: addItem,
        deleteItem: deleteItem,
        setEquipped: setEquipped
    };
});

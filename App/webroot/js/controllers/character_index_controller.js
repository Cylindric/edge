rpgAppNg.controller('CharacterIndexCtrl', ['$scope', '$window', '$http', '$filter',
    function ($scope, $window, $http, $filter) {

        function updateCharacterList() {
            $http
                    .get("/characters.json")
                    .success(function (response) {
                        $scope.characters = response.characters;
                    });
        }

        $scope.viewCharacter = function (character_id) {
            $window.location.href = '/characters/view/' + character_id;
        };

        $scope.editCharacter = function (character_id) {
            $window.location.href = '/characters/edit/' + character_id;
        };

        $scope.deleteCharacter = function (character_id) {
            $http
                    .post("/characters/delete.json", {
                        character_id: character_id
                    })
                    .success(function (response) {
                        var index = $scope.characters.indexOf($filter('filter')($scope.characters, {id: character_id})[0]);
                        $scope.characters.splice(index, 1);
                    });
        };

        updateCharacterList();

    }]);
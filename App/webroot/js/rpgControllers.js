var rpgControllers = angular.module('rpgControllers', []);


rpgAppNg.controller('CharacterCtrl', ['$scope', '$routeParams', '$http',
    function ($scope, $routeParams, $http) {

    $http.get('characters/edit_skills/' + $routeParams.characterId + '.json').success(function(data) {
        $scope.phone = data;
        $scope.mainImageUrl = data.images[0];
    });
}]);
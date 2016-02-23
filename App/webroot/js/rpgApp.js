var rpgAppNg = angular.module('rpgAppNg', [
    'ui.bootstrap',
    'rpgControllers',
    'ngMaterial',
    'ngMessages',
    'hc.marked'
]);



var rpgControllers = angular.module('rpgControllers', [], function ($locationProvider) {
    $locationProvider.html5Mode(true);});
var rpgAppNg = angular.module('rpgAppNg', [
    'ngRoute',
    'rpgControllers'
]);

rpgAppNg.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/characters/:character_id', {
                templateUrl: 'partials/phone-list.html',
                controller: 'CharacterController'
            })
        ;
    }]);


window.rpgApp = window.rpgApp || {};

$.fn.editable.defaults.mode = 'inline';

rpgApp.changeAttribute = function (character_id, attribute_id, delta, update) {
    $('#' + update).html('<img src="/img/loading.gif" />');

    $.get('/characters/change_attribute/' + character_id + '/' + attribute_id + '/' + delta + '.json',

        function (response) {
            if (response.response.result == 'success') {
                $('#' + update).text(response.response.data);
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(function () {
    $('[data-toggle="popover"]').popover()
})
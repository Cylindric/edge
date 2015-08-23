window.rpgApp = window.rpgApp || {};

$.fn.editable.defaults.mode = 'inline';

rpgApp.changeStatus = function (character_id, status_id, delta, update) {
    $.get('/characters/change_status/' + character_id + '/' + status_id + '/' + delta + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('#' + update).text(response.response.data);
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

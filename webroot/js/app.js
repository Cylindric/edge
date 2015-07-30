var RpgApp = {};

(function () {
    RpgApp.getSkills = function () {


        $.get('/characters/get_skills/1', function (response) {
            $incompleteDiv = $('#skills_list');

            // The response should be the formatted list of skills
            $incompleteDiv.empty();
            $incompleteDiv.append(response);
        });
    };

    RpgApp.changeSkill = function (id, delta) {
        $.get('/characters/change_skill/1/' + id + '/' + delta + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    RpgApp.getSkills();
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };

})();

(function ($) {
    $(document).on('click', 'i[id*=increase_]', function () {
        var id = $(this).attr('id').replace('increase_', '');
        RpgApp.changeSkill(id, 1);
    });
    $(document).on('click', 'i[id*=decrease_]', function () {
        var id = $(this).attr('id').replace('decrease_', '');
        RpgApp.changeSkill(id, -1);
    });

    RpgApp.getSkills();
})(jQuery);
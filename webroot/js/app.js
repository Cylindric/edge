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

    RpgApp.increaseSkill = function (id) {
        $.get('/characters/increase_skill/' + id + '.json',
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
    $(document).on('click', 'a', function () {
        var id = $(this).attr('id').replace('increase_', '');
        RpgApp.increaseSkill(id);
    });

    RpgApp.getSkills();
})(jQuery);
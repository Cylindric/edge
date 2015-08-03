var RpgApp = {};

(function () {
    RpgApp.getSkills = function (character_id) {
        $.get('/characters/edit_skills/' + character_id, function (response) {
            $incompleteDiv = $('#skills_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);
        });
    };

    RpgApp.getStats = function (character_id) {
        $.get('/characters/edit_stats/' + character_id, function (response) {
            $incompleteDiv = $('#stats_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);
        });
    };

    RpgApp.changeSkill = function (character_id, skill_id, delta) {
        $.get('/characters/change_skill/' + character_id + '/' + skill_id + '/' + delta + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    RpgApp.getSkills(character_id);
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };

    RpgApp.changeStat = function (character_id, stat_id, delta) {
        $.get('/characters/change_stat/' + character_id + '/' + stat_id + '/' + delta + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    RpgApp.getSkills(character_id);
                    RpgApp.getStats(character_id);
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };

})();

(function ($) {
    // Get the Character ID
    var char_id = $(document).find('input[name="id"]').val();

	// Stat +/- buttons
    $(document).on('click', 'i[id*=statincrease_]', function () {
        var id = $(this).attr('id').replace('statincrease_', '');
        RpgApp.changeStat(char_id, id, 1);
    });
    $(document).on('click', 'i[id*=statdecrease_]', function () {
        var id = $(this).attr('id').replace('statdecrease_', '');
        RpgApp.changeStat(char_id, id, -1);
    });
    
	// Skill +/- buttons
    $(document).on('click', 'i[id*=skillincrease_]', function () {
        var id = $(this).attr('id').replace('skillincrease_', '');
        RpgApp.changeSkill(char_id, id, 1);
    });
    $(document).on('click', 'i[id*=skilldecrease_]', function () {
        var id = $(this).attr('id').replace('skilldecrease_', '');
        RpgApp.changeSkill(char_id, id, -1);
    });

	RpgApp.getStats(char_id);
    RpgApp.getSkills(char_id);
})(jQuery);
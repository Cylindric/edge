var RpgApp = {};

(function () {

    RpgApp.getSkills = function (character_id) {
        $.get('/characters/edit_skills/' + character_id, function (response) {
            $incompleteDiv = $('#skills_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);
        });
    };

    RpgApp.getNotes = function (character_id) {
        $.get('/characters/edit_notes/' + character_id, function (response) {
            $incompleteDiv = $('#notes_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);
        });
    };

    RpgApp.getTalents = function (character_id) {
        $.ajax({
            async: false,
            type: 'GET',
            url: '/characters/edit_talents/' + character_id,
            success: function (response) {
                $incompleteDiv = $('#talents_list_edit');
                $incompleteDiv.empty();
                $incompleteDiv.append(response);

                $("#autocomplete").autocomplete({
                    source: "/talents.json",
                    focus: function (event, ui) {
                        $("#autocomplete").val(ui.item.label);
                        return false;
                    },
                    select: function (event, ui) {
                        $("#autocomplete").val(ui.item.label);

                        $.get('/characters/add_talent/' + character_id + '/' + ui.item.value + '.json', function (response) {
                            if (response.response.result == 'success') {

                                // reload the talent screen
                                RpgApp.getTalents(character_id);
                            }
                        });

                        return false;
                    }
                });
            }
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
                    // response now contains the new Skill values
                    var newLevel = response.response.Level;
                    var level = $('#skill_' + skill_id).find('span.skill_level');
                    level.text(newLevel);

                    // Set the new value
                    $dice = $('#skill_' + skill_id).find('span.skill_dice');
                    $dice.empty();
                    var proficiencyDice = response.response.Dice["proficiency"];
                    for (i = 0; i < proficiencyDice; i++) {
                        $dice.append('<img src="/img/dice-proficiency.png" alt="Proficiency">');
                    }
                    var abilityDice = response.response.Dice["ability"];
                    for (i = 0; i < abilityDice; i++) {
                        $dice.append('<img src="/img/dice-ability.png" alt="Ability">');
                    }

                    // Show or hide the buttons
                    if (newLevel >= 1) {
                        $('#skill_' + skill_id).find('i.decrease').fadeIn();
                        level.fadeIn();
                    } else {
                        $('#skill_' + skill_id).find('i.decrease').fadeOut();
                        level.fadeOut();
                    }

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

    RpgApp.changeStatus = function (character_id, status_id, delta, update) {
        $.get('/characters/change_status/' + character_id + '/' + status_id + '/' + delta + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    $('#'+update).text(response.response.data);
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };

    RpgApp.removeTalent = function (character_id, link_id) {
        $.get('/characters/remove_talent/' + character_id + '/' + link_id + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    $('tr[id=talent_' + link_id).remove();
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };

    RpgApp.changeTalent = function (character_id, talent_id, delta) {
        $.get('/characters/change_talent_rank/' + character_id + '/' + talent_id + '/' + delta + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    RpgApp.getTalents(character_id);
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };
	
    RpgApp.removeNote= function (character_id, note_id) {
        $.get('/characters/remove_note/' + character_id + '/' + note_id + '.json',
            function (response) {
                if (response.response.result == 'success') {
                    $('tr[id=note_' + note_id).remove();
                } else if (response.response.result == 'fail') {
                    console.log('fail');
                }
            }
        );
    };
	
	RpgApp.addNote = function (character_id) {
		$.post( "/characters/add_note/" + character_id + '.json', { note: $("#new_note").val(), private: $("#new_note_private").prop('checked') ? 1 : 0 }, function( data ) {
			RpgApp.getNotes(character_id);
		});
	}


})();

(function ($) {
    // Get the Character ID
    var char_id = $(document).find('input[name="id"]').val();

    // status buttons
    //$(document).on('click', 'i[id=strain_1_decrease]', function () {
    //    RpgApp.changeStatus(char_id, 'strain', -1, 'strain_box');
    //});
    //$(document).on('click', 'i[id=strain_1_increase]', function () {
    //    RpgApp.changeStatus(char_id, 'strain', 1, 'strain_box');
    //});
    //$(document).on('click', 'i[id=wounds_1_decrease]', function () {
    //    RpgApp.changeStatus(char_id, 'wounds', -1, 'wounds_box');
    //});
    //$(document).on('click', 'i[id=wounds_1_increase]', function () {
    //    RpgApp.changeStatus(char_id, 'wounds', 1, 'wounds_box');
    //});

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

    // Talent buttons
    $(document).on('click', 'span[id*=remove_talent_]', function () {
        var id = $(this).attr('id').replace('remove_talent_', '');
        RpgApp.removeTalent(char_id, id);
    });
    $(document).on('click', 'span[id*=increase_talent_]', function () {
        var id = $(this).attr('id').replace('increase_talent_', '');
        RpgApp.changeTalent(char_id, id, 1);
    });
    $(document).on('click', 'span[id*=decrease_talent_]', function () {
        var id = $(this).attr('id').replace('decrease_talent_', '');
        RpgApp.changeTalent(char_id, id, -1);
    });
	
	// Note buttons
	$(document).on('click', 'span[id*=remove_note_]', function () {
        var id = $(this).attr('id').replace('remove_note_', '');
        RpgApp.removeNote(char_id, id);
    });
	$(document).on('click', 'a[id*=new_note_submit]', function () {
        RpgApp.addNote(char_id);
    });
		
	RpgApp.getStats(char_id);
    RpgApp.getSkills(char_id);
    RpgApp.getTalents(char_id);
	RpgApp.getNotes(char_id);
})(jQuery);
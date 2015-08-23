window.rpgApp = window.rpgApp || {};

rpgApp.getSkills = function (character_id) {
    $.get('/characters/edit_skills/' + character_id, function (response) {
        $incompleteDiv = $('#skills_list_edit');
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.getNotes = function (character_id) {
    $.get('/characters/edit_notes/' + character_id, function (response) {
        $incompleteDiv = $('#notes_list_edit');
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.getTalents = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/characters/edit_talents/' + character_id,
        success: function (response) {
            $incompleteDiv = $('#talents_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);

            $("#new_talent_autocomplete").autocomplete({
                source: "/talents.json",
                focus: function (event, ui) {
                    $("#new_talent_autocomplete").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#new_talent_autocomplete").val(ui.item.label);

                    $.get('/characters/add_talent/' + character_id + '/' + ui.item.value + '.json', function (response) {
                        if (response.response.result == 'success') {

                            // reload the talent screen
                            rpgApp.getTalents(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
};

rpgApp.getWeapons = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/characters/edit_weapons/' + character_id,
        success: function (response) {
            $incompleteDiv = $('#weapons_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);

            $("#new_weapon_autocomplete").autocomplete({
                source: "/weapons.json",
                focus: function (event, ui) {
                    $("#new_weapon_autocomplete").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#new_weapon_autocomplete").val(ui.item.label);

                    $.get('/characters/add_weapon/' + character_id + '/' + ui.item.value + '.json', function (response) {
                        if (response.response.result == 'success') {

                            // reload the weapons screen
                            rpgApp.getWeapons(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
}

rpgApp.getStats = function (character_id) {
    $.get('/characters/edit_stats/' + character_id, function (response) {
        $incompleteDiv = $('#stats_list_edit');
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.changeSkill = function (character_id, skill_id, delta) {
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

rpgApp.changeStat = function (character_id, stat_id, delta) {
    $.get('/characters/change_stat/' + character_id + '/' + stat_id + '/' + delta + '.json',
        function (response) {
            if (response.response.result == 'success') {
                rpgApp.getSkills(character_id);
                rpgApp.getStats(character_id);
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeTalent = function (character_id, link_id) {
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

rpgApp.changeTalent = function (character_id, talent_id, delta) {
    $.get('/characters/change_talent_rank/' + character_id + '/' + talent_id + '/' + delta + '.json',
        function (response) {
            if (response.response.result == 'success') {
                rpgApp.getTalents(character_id);
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.toggleCareer = function (character_id, skill_id, replace) {
    $.get('/characters/toggle_career/' + character_id + '/' + skill_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                if (response.response.data == true) {
                    $('#' + replace).addClass('btn-success');
                    $('#' + replace).removeClass('btn-default');
                    $('#' + replace).text('career');
                } else {
                    $('#' + replace).addClass('btn-default');
                    $('#' + replace).removeClass('btn-success');
                    $('#' + replace).text('standard');
                }
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.toggleWeapon = function (character_id, link_id, replace) {
    $.get('/characters/toggle_weapon/' + character_id + '/' + link_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                if (response.response.data == true) {
                    $('#' + replace).addClass('btn-success');
                    $('#' + replace).removeClass('btn-default');
                    $('#' + replace).text('equipped');
                } else {
                    $('#' + replace).addClass('btn-default');
                    $('#' + replace).removeClass('btn-success');
                    $('#' + replace).text('not equipped');
                }
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.dropWeapon = function (character_id, link_id) {
    $.get('/characters/drop_weapon/' + character_id + '/' + link_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=weapon_' + link_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeNote = function (character_id, note_id) {
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

rpgApp.addNote = function (character_id) {
    $.post("/characters/add_note/" + character_id + '.json', {
        note: $("#new_note").val(),
        private: $("#new_note_private").prop('checked') ? 1 : 0
    }, function (data) {
        rpgApp.getNotes(character_id);
    });
};


(function ($) {
    // Get the Character ID
    var char_id = $(document).find('input[name="id"]').val();

    // Stat +/- buttons
    $(document).on('click', 'i[id*=statincrease_]', function () {
        var id = $(this).attr('id').replace('statincrease_', '');
        rpgApp.changeStat(char_id, id, 1);
    });
    $(document).on('click', 'i[id*=statdecrease_]', function () {
        var id = $(this).attr('id').replace('statdecrease_', '');
        rpgApp.changeStat(char_id, id, -1);
    });

    // Skill +/- buttons
    $(document).on('click', 'i[id*=skillincrease_]', function () {
        var id = $(this).attr('id').replace('skillincrease_', '');
        rpgApp.changeSkill(char_id, id, 1);
    });
    $(document).on('click', 'i[id*=skilldecrease_]', function () {
        var id = $(this).attr('id').replace('skilldecrease_', '');
        rpgApp.changeSkill(char_id, id, -1);
    });

    // Talent buttons
    $(document).on('click', 'span[id*=remove_talent_]', function () {
        var id = $(this).attr('id').replace('remove_talent_', '');
        rpgApp.removeTalent(char_id, id);
    });
    $(document).on('click', 'span[id*=increase_talent_]', function () {
        var id = $(this).attr('id').replace('increase_talent_', '');
        rpgApp.changeTalent(char_id, id, 1);
    });
    $(document).on('click', 'span[id*=decrease_talent_]', function () {
        var id = $(this).attr('id').replace('decrease_talent_', '');
        rpgApp.changeTalent(char_id, id, -1);
    });
    $(document).on('click', 'i[id*=toggle_career_]', function () {
        var id = $(this).attr('id').replace('toggle_career_', '');
        rpgApp.toggleCareer(char_id, id, $(this).attr('id'));
    });

    // Weapon buttons
    $(document).on('click', 'i[id*=toggle_weapon_]', function () {
        var id = $(this).attr('id').replace('toggle_weapon_', '');
        rpgApp.toggleWeapon(char_id, id, $(this).attr('id'));
    });
    $(document).on('click', 'i[id*=drop_weapon_]', function () {
        var id = $(this).attr('id').replace('drop_weapon_', '');
        rpgApp.dropWeapon(char_id, id, $(this).attr('id'));
    });


    // Note buttons
    $(document).on('click', 'span[id*=remove_note_]', function () {
        var id = $(this).attr('id').replace('remove_note_', '');
        rpgApp.removeNote(char_id, id);
    });
    $(document).on('click', 'a[id*=new_note_submit]', function () {
        rpgApp.addNote(char_id);
    });


    rpgApp.getStats(char_id);
    rpgApp.getSkills(char_id);
    rpgApp.getTalents(char_id);
    rpgApp.getNotes(char_id);
    rpgApp.getWeapons(char_id);
})(jQuery);
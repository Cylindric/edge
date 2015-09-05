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

rpgApp.getXp = function (character_id) {
    $.get('/characters/edit_xp/' + character_id, function (response) {
        $incompleteDiv = $('#xp_list_edit');
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.getCredits = function (character_id) {
    $.get('/credits/edit/' + character_id, function (response) {
        $incompleteDiv = $('#credits_list_edit');
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.getObligation = function (character_id) {
    $.get('/characters/edit_obligations/' + character_id, function (response) {
        $incompleteDiv = $('#obligation_list_edit');
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

rpgApp.getArmour = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/character_armour/edit/' + character_id,
        success: function (response) {
            $incompleteDiv = $('#armour_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);

            $("#new_armour_autocomplete").autocomplete({
                source: "/armour.json",
                focus: function (event, ui) {
                    $("#new_armour_autocomplete").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#new_armour_autocomplete").val(ui.item.label);

                    $.get('/character_armour/add/' + character_id + '/' + ui.item.value + '.json', function (response) {
                        if (response.response.result == 'success') {

                            // reload the weapons screen
                            rpgApp.getArmour(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
}

rpgApp.getItems = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/character_items/edit/' + character_id,
        success: function (response) {
            var $incompleteDiv = $('#item_list_edit');
            $incompleteDiv.empty();
            $incompleteDiv.append(response);

            $("#new_item_autocomplete").autocomplete({
                source: "/items.json",
                focus: function (event, ui) {
                    $("#new_item_autocomplete").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#new_item_autocomplete").val(ui.item.label);

                    $.get('/character_items/add/' + character_id + '/' + ui.item.value + '.json', function (response) {
                        if (response.response.result == 'success') {

                            // reload the item screen
                            rpgApp.getItems(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
}

rpgApp.dropArmour = function (char_id, link_id) {
    $.get('/character_armour/drop/' + char_id + '/' + link_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=armour_' + link_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.toggleArmour = function (char_id, link_id, replace) {
    $.get('/character_armour/toggle/' + char_id + '/' + link_id + '.json',
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
rpgApp.getWeapons = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/character_weapons/edit/' + character_id,
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

                    $.get('/character_weapons/add/' + character_id + '/' + ui.item.value + '.json', function (response) {
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
    $.get('/character_skills/change/' + character_id + '/' + skill_id + '/' + delta + '.json',
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
    $.get('/character_weapons/toggle/' + character_id + '/' + link_id + '.json',
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
    $.get('/character_weapons/drop/' + character_id + '/' + link_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=weapon_' + link_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.changeWeapon = function (character_id, link_id, delta) {
    $.get('/character_weapons/change_qty/' + character_id + '/' + link_id + '/' + delta + '.json',
        function (response) {
            if (response.response.result == 'success') {
                rpgApp.getWeapons(character_id);
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeNote = function (note_id) {
    $.get('/notes/delete/' + note_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=note_' + note_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeXp = function (xp_id) {
    $.get('/xp/delete/' + xp_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=xp_' + xp_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeCredits = function (credit_id) {
    $.get('/credits/delete/' + credit_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=credits_' + credit_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.removeObligation = function (obligation_id) {
    $.get('/obligations/delete/' + obligation_id + '.json',
        function (response) {
            if (response.response.result == 'success') {
                $('tr[id=obligation_' + obligation_id).remove();
            } else if (response.response.result == 'fail') {
                console.log('fail');
            }
        }
    );
};

rpgApp.addNote = function (character_id) {
    $.post("/characters_notes/add.json", {
        charId: character_id,
        note: $("#new_note").val(),
        private: $("#new_note_private").prop('checked') ? 1 : 0
    }, function (data) {
        rpgApp.getNotes(character_id);
    });
};

rpgApp.addXp = function (character_id) {
    $.post("/xp/add.json", {
        character_id: character_id,
        value: $("#new_xp").val(),
        note: $("#new_xp_note").val()
    }, function (data) {
        rpgApp.getXp(character_id);
    });
};

rpgApp.addCredits = function (character_id) {
    $.post("/credits/add.json", {
        character_id: character_id,
        value: $("#new_credits").val(),
        note: $("#new_credits_note").val()
    }, function (data) {
        rpgApp.getCredits(character_id);
    });
};

rpgApp.addObligation = function (character_id) {
    $.post("/obligations/add.json", {
        character_id: character_id,
        value: $("#new_obligation").val(),
        type: $("#new_obligation_type").val(),
        note: $("#new_obligation_note").val()
    }, function (data) {
        rpgApp.getObligation(character_id);
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
    $(document).on('click', 'span[id*=increase_weapon_]', function () {
        var id = $(this).attr('id').replace('increase_weapon_', '');
        rpgApp.changeWeapon(char_id, id, 1);
    });
    $(document).on('click', 'span[id*=decrease_weapon_]', function () {
        var id = $(this).attr('id').replace('decrease_weapon_', '');
        rpgApp.changeWeapon(char_id, id, -1);
    });

    // Armour buttons
    $(document).on('click', 'i[id*=drop_armour_]', function () {
        var id = $(this).attr('id').replace('drop_armour_', '');
        rpgApp.dropArmour(char_id, id, $(this).attr('id'));
    });
    $(document).on('click', 'i[id*=toggle_armour_]', function () {
        var id = $(this).attr('id').replace('toggle_armour_', '');
        rpgApp.toggleArmour(char_id, id, $(this).attr('id'));
    });

    // Note buttons
    $(document).on('click', 'span[id*=remove_note_]', function () {
        var id = $(this).attr('id').replace('remove_note_', '');
        rpgApp.removeNote(id);
    });
    $(document).on('click', 'a[id*=new_note_submit]', function () {
        rpgApp.addNote(char_id);
    });

    // Xp buttons
    $(document).on('click', 'span[id*=remove_xp_]', function () {
        var id = $(this).attr('id').replace('remove_xp_', '');
        rpgApp.removeXp(id);
    });
    $(document).on('click', 'a[id*=new_xp_submit]', function () {
        rpgApp.addXp(char_id);
    });

    // Credits buttons
    $(document).on('click', 'span[id*=remove_credits_]', function () {
        var id = $(this).attr('id').replace('remove_credits_', '');
        rpgApp.removeCredits(id);
    });
    $(document).on('click', 'a[id*=new_credits_submit]', function () {
        rpgApp.addCredits(char_id);
    });

    // Obligation buttons
    $(document).on('click', 'span[id*=remove_obligation_]', function () {
        var id = $(this).attr('id').replace('remove_obligation_', '');
        rpgApp.removeObligation(id);
    });
    $(document).on('click', 'a[id*=new_obligation_submit]', function () {
        rpgApp.addObligation(char_id);
    });


    rpgApp.getStats(char_id);
    rpgApp.getSkills(char_id);
    rpgApp.getTalents(char_id);
    rpgApp.getNotes(char_id);
    rpgApp.getWeapons(char_id);
    rpgApp.getArmour(char_id);
    rpgApp.getItems(char_id);
    rpgApp.getXp(char_id);
    rpgApp.getObligation(char_id);
    rpgApp.getCredits(char_id);
})(jQuery);
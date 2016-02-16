window.rpgApp = window.rpgApp || {};

rpgApp.genericLinkDelete = function (controller, character_id, link_id, remove, label) {
    $.post('/' + controller + '/delete.json', {
        character_id: character_id,
        id: link_id,
    }, function (response) {
        if (response.response.result == 'success') {
            $(remove).remove();
        } else if (response.response.result == 'fail') {
            console.log('fail to delete ' + label + '!');
        }
    });
};

rpgApp.genericGet = function (controller, action, character_id, update) {
    $.get('/' + controller + '/' + action + '/' + character_id, function (response) {
        var $incompleteDiv = $('#' + update);
        $incompleteDiv.empty();
        $incompleteDiv.append(response);
    });
};

rpgApp.getNotes = function (character_id) {
    rpgApp.genericGet('characters', 'edit_notes', character_id, 'notes_list_edit');
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

                            // reload the armour screen
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

rpgApp.armourToggle = function (char_id, link_id, replace) {
    $.post('/character_armour/toggle.json', {
        character_id: char_id,
        link_id: link_id,
    }, function (response) {
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
        } else {
            console.log('fail to toggle equipped status for ' + link_id + '!');
        }
    });
};

rpgApp.setButtonState = function (id, enabled, enabled_text, disabled_text) {
    if(enabled) {
        $(id).addClass('btn-success');
        $(id).removeClass('btn-default');
        $(id).text(enabled_text);
    } else {
        $(id).addClass('btn-default');
        $(id).removeClass('btn-success');
        $(id).text(disabled_text);
    }
}

rpgApp.toggleItemEquip = function (char_id, link_id) {
    $.post('/character_items/toggle_equip.json', {
        character_id: char_id,
        link_id: link_id,
    }, function (response) {
        if (response.response.result == 'success') {
            rpgApp.setButtonState('#toggle_item_equip_' + link_id, response.response.data.equipped, 'equipped', 'not equipped');
            rpgApp.setButtonState('#toggle_item_carry_' + link_id, response.response.data.carried, 'carried', 'not carried');
        } else {
            console.log('fail to toggle equipped status for ' + link_id + '!');
        }
    });
};

rpgApp.toggleItemCarry = function (char_id, link_id, replace) {
    $.post('/character_items/toggle_carry.json', {
        character_id: char_id,
        link_id: link_id,
    }, function (response) {
        if (response.response.result == 'success') {
            rpgApp.setButtonState('#toggle_item_equip_' + link_id, response.response.data.equipped, 'equipped', 'not equipped');
            rpgApp.setButtonState('#toggle_item_carry_' + link_id, response.response.data.carried, 'carried', 'not carried');
        } else {
            console.log('fail to toggle carried status for ' + link_id + '!');
        }
    });
};

rpgApp.weaponsGet = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/character_weapons/edit/' + character_id,
        success: function (response) {
            var $incompleteDiv = $('#weapons_list_edit');
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

                    $.post("/character_weapons/add.json", {
                        character_id: character_id,
                        weapon_id: ui.item.value,
                    }, function (response) {
                        if (response.response.result == 'success') {
                            rpgApp.weaponsGet(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
}

rpgApp.getStats = function (character_id) {
    rpgApp.genericGet('characters', 'edit_stats', character_id, 'stats_list_edit');
};

rpgApp.talentsGet = function (character_id) {
    $.ajax({
        async: false,
        type: 'GET',
        url: '/character_talents/edit/' + character_id,
        success: function (response) {
            var $incompleteDiv = $('#talents_list_edit');
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

                    $.post("/character_talents/add.json", {
                        character_id: character_id,
                        talent_id: ui.item.value,
                    }, function (response) {
                        if (response.response.result == 'success') {
                            rpgApp.talentsGet(character_id);
                        }
                    });

                    return false;
                }
            });
        }
    });
};

rpgApp.talentChangeRank = function (character_id, link_id, delta) {
    $.post("/character_talents/change_rank.json", {
        character_id: character_id,
        link_id: link_id,
        delta: delta,
    }, function () {
        rpgApp.talentsGet(character_id);
    });
};

rpgApp.weaponToggle = function (character_id, link_id, replace) {
    $.post('/character_weapons/toggle.json', {
        character_id: character_id,
        link_id: link_id,
    }, function (response) {
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
        } else {
            console.log('fail to toggle equipped status for weapon ' + link_id + '!');
        }
    });
};

rpgApp.weaponChangeQty = function (character_id, link_id, delta) {
    $.post('/character_weapons/change_qty.json', {
        character_id: character_id,
        link_id: link_id,
        delta: delta,
    }, function (response) {
        if (response.response.result == 'success') {
            rpgApp.weaponsGet(character_id);
        } else if (response.response.result == 'fail') {
            console.log('fail to change quantity for weapon ' + link_id + '!');
        }
    });
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

rpgApp.addNote = function (character_id) {
    $.post("/character_notes/add.json", {
        charId: character_id,
        note: $("#new_note").val(),
        private: $("#new_note_private").prop('checked') ? 1 : 0
    }, function (data) {
        rpgApp.getNotes(character_id);
    });
};

(function ($) {
    // Get the Character ID
    var char_id = $(document).find('input[name="id"]').val();

    // Talent buttons
    $(document).on('click', 'span[id*=remove_talent_]', function () {
        var id = $(this).attr('id').replace('remove_talent_', '');
        rpgApp.genericLinkDelete('character_talents', char_id, id, 'tr[id=talent_' + id, 'talent');
    });
    $(document).on('click', 'span[id*=increase_talent_]', function () {
        var id = $(this).attr('id').replace('increase_talent_', '');
        rpgApp.talentChangeRank(char_id, id, 1);
    });
    $(document).on('click', 'span[id*=decrease_talent_]', function () {
        var id = $(this).attr('id').replace('decrease_talent_', '');
        rpgApp.talentChangeRank(char_id, id, -1);
    });

    // Weapon buttons
    $(document).on('click', 'i[id*=toggle_weapon_]', function () {
        var id = $(this).attr('id').replace('toggle_weapon_', '');
        rpgApp.weaponToggle(char_id, id, $(this).attr('id'));
    });
    $(document).on('click', 'i[id*=drop_weapon_]', function () {
        var id = $(this).attr('id').replace('drop_weapon_', '');
        rpgApp.genericLinkDelete('character_weapons', char_id, id, 'tr[id=weapon_' + id, 'weapon');
    });
    $(document).on('click', 'span[id*=increase_weapon_]', function () {
        var id = $(this).attr('id').replace('increase_weapon_', '');
        rpgApp.weaponChangeQty(char_id, id, 1);
    });
    $(document).on('click', 'span[id*=decrease_weapon_]', function () {
        var id = $(this).attr('id').replace('decrease_weapon_', '');
        rpgApp.weaponChangeQty(char_id, id, -1);
    });

    // Armour buttons
    $(document).on('click', 'i[id*=drop_armour_]', function () {
        var id = $(this).attr('id').replace('drop_armour_', '');
        rpgApp.genericLinkDelete('character_armour', char_id, id, 'tr[id=armour_' + id, 'armour');
    });
    $(document).on('click', 'i[id*=toggle_armour_]', function () {
        var id = $(this).attr('id').replace('toggle_armour_', '');
        rpgApp.armourToggle(char_id, id, $(this).attr('id'));
    });

    // Item buttons
    $(document).on('click', 'i[id*=drop_item_]', function () {
        var id = $(this).attr('id').replace('drop_item_', '');
        rpgApp.genericLinkDelete('character_items', char_id, id, 'tr[id=item_' + id, 'item');
    });
    $(document).on('click', 'i[id*=toggle_item_equip_]', function () {
        var id = $(this).attr('id').replace('toggle_item_equip_', '');
        rpgApp.toggleItemEquip(char_id, id);
    });
    $(document).on('click', 'i[id*=toggle_item_carry_]', function () {
        var id = $(this).attr('id').replace('toggle_item_carry_', '');
        rpgApp.toggleItemCarry(char_id, id);
    });

    // Note buttons
    $(document).on('click', 'span[id*=remove_note_]', function () {
        var id = $(this).attr('id').replace('remove_note_', '');
        rpgApp.removeNote(id);
    });
    $(document).on('click', 'a[id*=new_note_submit]', function () {
        rpgApp.addNote(char_id);
    });

    rpgApp.getStats(char_id);
    rpgApp.talentsGet(char_id);
    rpgApp.getNotes(char_id);
    rpgApp.weaponsGet(char_id);
    rpgApp.getArmour(char_id);
    rpgApp.getItems(char_id);

})(jQuery);


SELECT @admin_id:=`id` FROM users WHERE `username`='admin';
SELECT @human_id:=`id` FROM species WHERE `name` = 'Human';
SELECT @dodge_id:=`id` FROM talents WHERE name='Dodge';
SELECT @blaster_id:=`id` FROM weapons WHERE name='Blaster Carbine';
SELECT @laminate_id:=`id` FROM armour WHERE name='Laminate';

-- DELETE FROM characters WHERE `name` = 'Default Test User' AND `user_id` = @admin_id;

INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Default Test User', @admin_id, @human_id, NOW(), NOW());
SET @character_id:=LAST_INSERT_ID();

INSERT INTO characters_talents (`character_id`, `talent_id`, `created`, `modified`) VALUES (@character_id, @dodge_id, NOW(), NOW());
INSERT INTO characters_weapons (`character_id`, `weapon_id`, `created`, `modified`) VALUES (@character_id, @blaster_id, NOW(), NOW());
INSERT INTO characters_armour (`character_id`, `armour_id`, `created`, `modified`) VALUES (@character_id, @laminate_id, NOW(), NOW());
INSERT INTO credits (`character_id`, `value`, `note`, `created`, `created_by`, `modified`, `modified_by`) VALUES (@character_id, '123', 'Some Credits', NOW(), @admin_id, NOW(), @admin_id);
INSERT INTO xp (`character_id`, `value`, `note`, `created`, `created_by`, `modified`, `modified_by`) VALUES (@character_id, '10', 'Some XP', NOW(), @admin_id, NOW(), @admin_id);

INSERT INTO groups (`name`, `created`, `modified`) VALUES ('Test Group', NOW(), NOW());
SET @group_id:=LAST_INSERTED_ID();

INSERT INTO characters_groups (`character_id`, `group_id`) VALUES (@character_id, @group_id);
INSERT INTO groups_users (`group_id`, `user_id`) VALUES (@group_id, @admin_id);

SELECT * FROM characters WHERE id=@character_id;
SELECT * FROM characters_talents WHERE character_id=@character_id;
SELECT * FROM characters_armour WHERE character_id=@character_id;
SELECT * FROM characters_weapons WHERE character_id=@character_id;
SELECT * FROM credits WHERE character_id=@character_id;
SELECT * FROM obligations WHERE character_id=@character_id;
SELECT * FROM xp WHERE character_id=@character_id;


INSERT INTO characters_weapons(character_id, weapon_id) VALUES (23, (SELECT id FROM weapons LIMIT 1));
INSERT INTO characters_armour(character_id, armour_id) VALUES (23, (SELECT id FROM armour LIMIT 1));
INSERT INTO characters_talents(character_id, talent_id) VALUES (23, (SELECT id FROM talents LIMIT 1));
INSERT INTO characters_items(character_id, item_id) VALUES (23, (SELECT id FROM items LIMIT 1));
INSERT INTO credits(character_id, value, note, created_by, modified_by, created, modified) VALUES (23, 123, 'test', 1, 1, NOW(), NOW());
INSERT INTO xp(character_id, value, note, created_by, modified_by, created, modified) VALUES (23, 10, 'test', 1, 1, NOW(), NOW());
INSERT INTO obligations(character_id, value, note, type, created_by, modified_by, created, modified) VALUES (23, 10, 'test', 'testing', 1, 1, NOW(), NOW());


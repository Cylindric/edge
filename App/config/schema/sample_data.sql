SELECT @admin_id:=`id` FROM users WHERE `username`='admin';
SELECT @human_id:=`id` FROM species WHERE `name` = 'Human';
SELECT @dodge_id:=`id` FROM talents WHERE name='Dodge';
SELECT @blaster_id:=`id` FROM weapons WHERE name='Blaster Carbine';
SELECT @laminate_id:=`id` FROM armour WHERE name='Laminate';

DELETE FROM characters WHERE `name` = 'Default Test User' AND `user_id` = @admin_id;

INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Default Test User', @admin_id, @human_id, NOW(), NOW());
SET @character_id:=LAST_INSERT_ID();

INSERT INTO characters_talents (`character_id`, `talent_id`, `created`, `modified`) VALUES (@character_id, @dodge_id, NOW(), NOW());
INSERT INTO characters_weapons (`character_id`, `weapon_id`, `created`, `modified`) VALUES (@character_id, @blaster_id, NOW(), NOW());
INSERT INTO characters_armour (`character_id`, `armour_id`, `created`, `modified`) VALUES (@character_id, @laminate_id, NOW(), NOW());

SELECT * FROM characters WHERE id=@character_id;
SELECT * FROM characters_talents WHERE character_id=@character_id;
SELECT * FROM characters_armour WHERE character_id=@character_id;
SELECT * FROM characters_weapons WHERE character_id=@character_id;

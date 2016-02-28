SELECT @admin_id:=`id` FROM users WHERE `username`='admin';
SELECT @human_id:=`id` FROM species WHERE `name` = 'Human';
SELECT @wookiee_id:=`id` FROM species WHERE `name` = 'Wookiee';
SELECT @droid_id:=`id` FROM species WHERE `name` = 'Droid';
SELECT @dodge_id:=`id` FROM talents WHERE name='Dodge';
SELECT @blaster_id:=`id` FROM weapons WHERE name='Blaster Carbine';
SELECT @laminate_id:=`id` FROM armour WHERE name='Laminate';

INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Test Character', @admin_id, @human_id, NOW(), NOW());
SET @character_id:=LAST_INSERT_ID();

-- Create a Group and some Characters in it.
INSERT INTO groups (`name`, `created`, `modified`) VALUES ('Test Group'); SET @test_group := LAST_INSERT_ID();
INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Luke Skywalker', @admin_id, @human_id, NOW(), NOW()); SET @group_char1 := LAST_INSERT_ID();
INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Han Solo', @admin_id, @human_id, NOW(), NOW()); SET @group_char2 := LAST_INSERT_ID();
INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('Chewbacca', @admin_id, @wookiee_id, NOW(), NOW()); SET @group_char3 := LAST_INSERT_ID();
INSERT INTO characters (`name`, `user_id`, `species_id`, `created`, `modified`) VALUES ('R2-D2', @admin_id, @droid_id, NOW(), NOW()); SET @group_char4 := LAST_INSERT_ID();
INSERT INTO characters_groups (`character_id`, `group_id`) VALUES (@group_char1, @test_group);
INSERT INTO characters_groups (`character_id`, `group_id`) VALUES (@group_char2, @test_group);
INSERT INTO characters_groups (`character_id`, `group_id`) VALUES (@group_char3, @test_group);
INSERT INTO characters_groups (`character_id`, `group_id`) VALUES (@group_char4, @test_group);

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

INSERT INTO chronicles (group_id, created_by, modified_by, created, modified, published, title, story) VALUES (@group_id, @admin_id, @admin_id, NOW(), NOW(), 1, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ultricies aliquet diam ac vehicula. Praesent rutrum eu enim ac pellentesque. Aenean convallis urna vehicula dolor commodo porttitor. Etiam eget lorem at dolor aliquet facilisis. Integer elementum, velit posuere interdum sollicitudin, risus magna consequat ipsum, quis euismod tortor lacus quis ligula. Phasellus finibus tristique arcu, eu pellentesque enim vulputate ac. Etiam et lectus finibus, ornare urna in, suscipit diam. Donec pulvinar id augue vel consectetur. Donec placerat porttitor molestie.\r\nInterdum et malesuada fames ac ante ipsum primis in faucibus. Ut quis tortor velit. Curabitur et sem neque. Nulla diam nibh, venenatis vel tellus vel, ultrices hendrerit erat. Morbi eleifend eleifend tortor quis sodales. Cras quis justo vel tortor sagittis luctus a sit amet massa. Nam pulvinar, augue non congue porttitor, enim libero hendrerit orci, commodo bibendum augue lectus sit amet risus. Vivamus vehicula sapien ex, a volutpat tellus ultricies at. Quisque mollis justo a gravida placerat. Morbi facilisis lacus id turpis cursus, in laoreet neque iaculis. Phasellus eget imperdiet nisi. Donec scelerisque tincidunt erat vel pulvinar. Mauris auctor nisi sit amet lobortis scelerisque. Duis tortor dolor, mattis sed volutpat lacinia, fermentum ut arcu.\r\n\r\nFusce id tempus lacus. Curabitur arcu leo, mattis a lorem eget, tempor vehicula ipsum. Fusce consectetur turpis ex, ut feugiat dui porta in. Cras luctus enim ante, sed ullamcorper nisi aliquam sit amet. Integer venenatis tellus sapien. Duis tristique lobortis augue nec hendrerit. Nulla augue leo, pulvinar nec quam a, viverra tincidunt tortor. Etiam velit augue, placerat sed velit ullamcorper, pretium tempus turpis. Morbi lacinia felis nec metus mattis auctor. Mauris dui sem, feugiat in ex eget, consectetur convallis nisl. Etiam sodales odio sit amet arcu sodales finibus. Duis rutrum, lectus at gravida hendrerit, diam leo fermentum risus, sed vehicula mauris nisl non ipsum. Integer commodo nisl ac justo accumsan interdum. Suspendisse gravida lorem et libero venenatis elementum. Sed pharetra, quam eget scelerisque tincidunt, dolor odio tristique ex, vitae pellentesque orci turpis ut urna.\r\n\r\nPellentesque id posuere odio, quis molestie ligula. Suspendisse rutrum tellus id mi semper tincidunt. Aenean pellentesque venenatis risus sed imperdiet. Ut pretium, nisi sed varius molestie, lectus arcu imperdiet neque, eu aliquam dolor dolor quis enim. Proin ultrices augue urna, id semper ipsum viverra faucibus. Nunc nec dictum tortor. Sed augue leo, ornare feugiat fringilla sed, euismod at lorem. Vestibulum ante libero, pretium quis ornare in, interdum sit amet enim. Integer porttitor, tellus a pulvinar viverra, ante ante tincidunt mi, et viverra nibh eros ac tellus. Curabitur posuere, erat ut blandit suscipit, magna sem mattis diam, in posuere diam ante at tortor.\r\n\r\nNulla condimentum fermentum leo sed euismod. Nunc a rutrum urna. Mauris dictum bibendum justo, sed faucibus risus rhoncus non. Praesent nec placerat tortor. In hac habitasse platea dictumst. Proin vitae auctor nunc. Vivamus cursus quam ac ex scelerisque efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque imperdiet, velit id euismod viverra, leo erat fringilla sapien, vitae hendrerit nulla tortor eu mi.');

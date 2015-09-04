USE edge;
DELETE FROM phinxlog where version > '20150824213600';


SELECT * FROM armour;
SELECT * FROM careers;
SELECT * FROM characters;
SELECT * FROM characters_armour;
SELECT * FROM characters_items;
SELECT * FROM characters_notes;
SELECT * FROM characters_skills;
SELECT * FROM characters_talents;
SELECT * FROM characters_weapons;
SELECT * FROM groups;
SELECT * FROM groups_users;
SELECT * FROM item_types;
SELECT * FROM items;
SELECT * FROM notes;
SELECT * FROM obligations;
SELECT * FROM phinxlog;
SELECT * FROM ranges;
SELECT * FROM skills ORDER BY name;
SELECT * FROM slack;
SELECT * FROM specialisations ORDER BY name;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents ORDER BY name;
SELECT * FROM users;
SELECT * FROM weapon_types;
SELECT * FROM weapons ORDER BY name;
SELECT * FROM xp ORDER BY modified DESC;

-- v0.3 to v0.4
CREATE TABLE `edge`.`groups_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `group_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `gm` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_group_idx` (`group_id` ASC),
  INDEX `fk_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_groups` FOREIGN KEY (`group_id`) REFERENCES `edge`.`groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `edge`.`users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION);

INSERT INTO groups_users (group_id, user_id, gm, created, modified)
SELECT c.group_id, u.id, 0, NOW(), NOW()
FROM characters c
INNER JOIN users u ON (c.user_id = u.id);

UPDATE users SET created = COALESCE(created, NOW()), modified = COALESCE(modified, NOW()) WHERE created is null OR modified is null;


DROP TABLE armour;
DROP TABLE careers;
DROP TABLE characters;
DROP TABLE characters_armour;
DROP TABLE characters_items;
DROP TABLE characters_notes;
DROP TABLE characters_skills;
DROP TABLE characters_talents;
DROP TABLE characters_weapons;
DROP TABLE groups;
DROP TABLE groups_users;
DROP TABLE item_types;
DROP TABLE items;
DROP TABLE notes;
DROP TABLE obligations;
DROP TABLE phinxlog;
DROP TABLE ranges;
DROP TABLE skills;
DROP TABLE slack;
DROP TABLE specialisations;
DROP TABLE species;
DROP TABLE stats;
DROP TABLE talents;
DROP TABLE users;
DROP TABLE weapon_types;
DROP TABLE weapons;
DROP TABLE xp;

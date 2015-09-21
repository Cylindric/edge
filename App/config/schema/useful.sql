USE edge;
DELETE FROM phinxlog where version > '20150901212000';


SELECT * FROM armour;
SELECT * FROM careers;
SELECT * FROM characters;
SELECT * FROM characters_armour;
SELECT * FROM characters_items;
SELECT * FROM characters_notes;
SELECT * FROM characters_skills ORDER BY character_id, skill_id;
SELECT * FROM characters_talents ORDER BY character_id;
SELECT * FROM characters_weapons;
SELECT * FROM credits;
SELECT * FROM groups;
SELECT * FROM groups_users;
SELECT * FROM item_types;
SELECT * FROM items;
SELECT * FROM notes;
SELECT * FROM obligations;
SELECT * FROM phinxlog;
SELECT * FROM ranges;
SELECT * FROM sessions;
SELECT * FROM skills ORDER BY name;
SELECT * FROM slack;
SELECT * FROM specialisations ORDER BY name;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents ORDER BY id;
SELECT * FROM users;
SELECT * FROM weapon_types;
SELECT * FROM weapons ORDER BY name;
SELECT * FROM xp ORDER BY modified DESC;

-- v0.4 to v0.5
CREATE TABLE sessions (
	id varchar(40) NOT NULL default '',
	data text,
	expires INT(11) NOT NULL,
	PRIMARY KEY  (id)
);
ALTER TABLE xp CHANGE COLUMN note note VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE xp ADD COLUMN created_by INT(11) NOT NULL DEFAULT 0 AFTER created;
ALTER TABLE xp ADD COLUMN modified_by INT(11) NOT NULL DEFAULT 0 AFTER modified;
ALTER TABLE obligations ADD COLUMN created_by INT(11) NOT NULL DEFAULT 0 AFTER created;
ALTER TABLE obligations ADD COLUMN modified_by INT(11) NOT NULL DEFAULT 0 AFTER modified;
ALTER TABLE credits ADD COLUMN created_by INT(11) NOT NULL DEFAULT 0 AFTER created;
ALTER TABLE credits ADD COLUMN modified_by INT(11) NOT NULL DEFAULT 0 AFTER modified;

UPDATE xp x
INNER JOIN characters c ON (x.character_id = c.id)
INNER JOIN groups_users gu ON (c.group_id = gu.group_id AND gu.gm = 1)
SET x.created_by = gu.user_id, x.modified_by = gu.user_id
;
UPDATE obligations o
INNER JOIN characters c ON (o.character_id = c.id)
INNER JOIN groups_users gu ON (c.group_id = gu.group_id AND gu.gm = 1)
SET o.created_by = gu.user_id, o.modified_by = gu.user_id
;
UPDATE credits cr
INNER JOIN characters c ON (cr.character_id = c.id)
INNER JOIN groups_users gu ON (c.group_id = gu.group_id AND gu.gm = 1)
SET cr.created_by = gu.user_id, cr.modified_by = gu.user_id
;

ALTER TABLE xp ADD CONSTRAINT `xp_ibfk_createdby` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE xp ADD CONSTRAINT `xp_ibfk_modifiedby` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE obligations ADD CONSTRAINT `obligations_ibfk_createdby` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE obligations ADD CONSTRAINT `obligations_ibfk_modifiedby` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE credits ADD CONSTRAINT `credits_ibfk_createdby` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE credits ADD CONSTRAINT `credits_ibfk_modifiedby` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;



ELECT cr.*, c.name, g.*
FROM credits cr
LEFT JOIN characters c ON (cr.character_id = c.id)
LEFT JOIN groups g ON (c.group_id = g.id)
LEFT JOIN groups_users ug ON (g.id = ug.group_id)
;

-- The order of these is important due to inheritance - don't just re-sort the list!
DROP TABLE characters_armour;
DROP TABLE characters_items;
DROP TABLE characters_notes;
DROP TABLE characters_skills;
DROP TABLE characters_talents;
DROP TABLE characters_weapons;
DROP TABLE credits;
DROP TABLE obligations;
DROP TABLE xp;
DROP TABLE characters;
DROP TABLE armour;
DROP TABLE groups_users;
DROP TABLE groups;
DROP TABLE items;
DROP TABLE item_types;
DROP TABLE notes;
DROP TABLE phinxlog;
DROP TABLE sessions;
DROP TABLE slack;
DROP TABLE specialisations;
DROP TABLE careers;
DROP TABLE talents;
DROP TABLE IF EXISTS training;
DROP TABLE weapons;
DROP TABLE ranges; 
DROP TABLE skills;
DROP TABLE stats;
DROP TABLE weapon_types;
DROP TABLE species;
DROP TABLE users;

USE edge;
DELETE FROM phinxlog where version > '20150901212000';


SELECT * FROM armour;
SELECT * FROM careers;
SELECT * FROM characters;
SELECT * FROM characters_armour;
SELECT * FROM characters_items;
SELECT * FROM characters_notes;
SELECT * FROM characters_skills ORDER BY character_id, skill_id;

SELECT ct.*, t.name
FROM characters_talents ct
INNER JOIN talents t ON (ct.talent_id = t.id)
WHERE ct.character_id=2
ORDER BY ct.character_id;

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

-- v0.6 to v0.7
UPDATE weapons SET skill_id = 26 WHERE name = 'Heavy Blaster Pistol' AND skill_id=27;

INSERT INTO characters_skills (character_id, skill_id, level, career, locked, source, created, modified)
SELECT character_id, skill_id, 0, 1, 1, '', created, modified
FROM characters_skills
WHERE career=1 AND level>0;

UPDATE characters_skills SET career=0 WHERE career=1 AND level>0;

ALTER TABLE talents ADD COLUMN soak_per_rank INT(11) NOT NULL DEFAULT 0 AFTER ranked;
ALTER TABLE talents ADD COLUMN strain_per_rank INT(11) NOT NULL DEFAULT 0 AFTER ranked;
UPDATE talents SET soak_per_rank = 1 WHERE name = 'Enduring';
UPDATE talents SET strain_per_rank = 1 WHERE name = 'Grit';


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
DROP TABLE talent_characteristics;
DROP TABLE talent_skills;
DROP TABLE stats;
DROP TABLE weapon_types;
DROP TABLE species;
DROP TABLE users;


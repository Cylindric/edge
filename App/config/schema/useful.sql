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
DROP TABLE IF EXISTS characters_armour;
DROP TABLE IF EXISTS characters_items;
DROP TABLE IF EXISTS characters_notes;
DROP TABLE IF EXISTS characters_skills;
DROP TABLE IF EXISTS characters_talents;
DROP TABLE IF EXISTS characters_weapons;
DROP TABLE IF EXISTS credits;
DROP TABLE IF EXISTS obligations;
DROP TABLE IF EXISTS xp;
DROP TABLE IF EXISTS characters;
DROP TABLE IF EXISTS armour;
DROP TABLE IF EXISTS groups_users;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS item_types;
DROP TABLE IF EXISTS notes;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS slack;
DROP TABLE IF EXISTS specialisations;
DROP TABLE IF EXISTS careers;
DROP TABLE IF EXISTS talents;
DROP TABLE IF EXISTS training;
DROP TABLE IF EXISTS weapons;
DROP TABLE IF EXISTS ranges; 
DROP TABLE IF EXISTS skills;
DROP TABLE IF EXISTS talent_characteristics;
DROP TABLE IF EXISTS talent_skills;
DROP TABLE IF EXISTS stats;
DROP TABLE IF EXISTS weapon_types;
DROP TABLE IF EXISTS species;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS phinxlog;


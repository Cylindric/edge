USE edge;
DELETE FROM phinxlog where version > '20150901212000';

SELECT * FROM armour;
SELECT * FROM careers;
SELECT * FROM characters;
SELECT * FROM characters_specialisations;
SELECT * FROM characters_careers;
SELECT * FROM characters_armour;
SELECT * FROM characters_groups;
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
SELECT * FROM ranks;
SELECT * FROM sessions;
SELECT * FROM skills ORDER BY name;
SELECT * FROM slack;
SELECT * FROM sources;
SELECT * FROM specialisations ORDER BY name;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents;
SELECT * FROM users;
SELECT * FROM weapon_types;
SELECT * FROM edge.weapons ORDER BY name;
SELECT * FROM xp ORDER BY modified DESC;

-- v0.7 to v0.8
-- THESE STILL NEED TRANSFERRING INTO A MIGRATION!
UPDATE characters c
INNER JOIN species s ON (c.species_id = s.id)
SET c.wound_threshold = c.wound_threshold - s.base_wound - c.stat_br,
c.strain_threshold = c.strain_threshold - s.base_strain - c.stat_will;



-- The order of these is important due to inheritance - don't just re-sort the list!
DROP TABLE IF EXISTS characters_armour;
DROP TABLE IF EXISTS characters_items;
DROP TABLE IF EXISTS characters_notes;
DROP TABLE IF EXISTS characters_skills;
DROP TABLE IF EXISTS characters_talents;
DROP TABLE IF EXISTS characters_weapons;
DROP TABLE IF EXISTS characters_careers;
DROP TABLE IF EXISTS characters_specialisations;
DROP TABLE IF EXISTS characters_groups;
DROP TABLE IF EXISTS ranks;
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
DROP TABLE IF EXISTS sources;
DROP TABLE IF EXISTS phinxlog;


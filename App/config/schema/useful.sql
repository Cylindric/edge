USE edge;
DELETE FROM phinxlog where version <> '20150804100105';


SELECT * FROM armour;
SELECT * FROM careers;
SELECT * FROM characters;
SELECT * FROM characters_skills;
SELECT * FROM characters_talents;
SELECT * FROM characters_weapons;
SELECT * FROM groups;
SELECT * FROM obligations;
SELECT * FROM phinxlog;
SELECT * FROM ranges;
SELECT * FROM skills ORDER BY name;
SELECT * FROM specialisations ORDER BY name;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents;
SELECT * FROM users;
SELECT * FROM weapon_types;
SELECT * FROM weapons ORDER BY name;

-- v0.1 to v0.2
ALTER TABLE characters ADD COLUMN biography text;
ALTER TABLE training RENAME characters_skills;
ALTER TABLE characters_skills ADD COLUMN locked tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE characters_skills ADD COLUMN source varchar(20) NOT NULL DEFAULT '';


SELECT * FROM characters_skills WHERE character_id = 1 AND skill_id = 1;
SELECT (SUM(level)) AS `level` FROM characters_skills CharactersSkills WHERE (character_id = 1 AND skill_id = 1);
drop table obligations;
drop table phinxlog;
drop table characters_skills;
drop table skills;
drop table stats;
drop table characters_talents;
drop table characters_weapons;
drop table talents;
drop table characters;
drop table species;
drop table users;
drop table groups;
drop table weapons;
drop table weapon_types;


USE edge;
SELECT * FROM characters;
SELECT * FROM characters_talents;
SELECT * FROM characters_groups;
SELECT * FROM groups;
SELECT * FROM skills;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents;
SELECT * FROM training;
SELECT * FROM phinxlog;
SELECT * FROM users;

SELECT Characters.id AS `Characters__id`, Characters.user_id AS `Characters__user_id`, Characters.species_id AS `Characters__species_id`, Characters.name AS `Characters__name`, Characters.gender AS `Characters__gender`, Characters.age AS `Characters__age`, Characters.height AS `Characters__height`, Characters.weight AS `Characters__weight`, Characters.hair_colour AS `Characters__hair_colour`, Characters.eye_colour AS `Characters__eye_colour`, Characters.build AS `Characters__build`, Characters.home_planet AS `Characters__home_planet`, Characters.notable_features AS `Characters__notable_features`, Characters.stat_br AS `Characters__stat_br`, Characters.stat_ag AS `Characters__stat_ag`, Characters.stat_int AS `Characters__stat_int`, Characters.stat_cun AS `Characters__stat_cun`, Characters.stat_will AS `Characters__stat_will`, Characters.stat_pr AS `Characters__stat_pr`, Characters.created AS `Characters__created`, Characters.modified AS `Characters__modified`, Talents.id AS `Talents__id`, Talents.name AS `Talents__name`, Talents.description AS `Talents__description`, Talents.ranked AS `Talents__ranked`, Talents.activation_type AS `Talents__activation_type`, Talents.page AS `Talents__page`, Talents.created AS `Talents__created`, Talents.modified AS `Talents__modified`, CharactersTalents.id AS `CharactersTalents__id`, CharactersTalents.character_id AS `CharactersTalents__character_id`, CharactersTalents.talent_id AS `CharactersTalents__talent_id`, CharactersTalents.rank AS `CharactersTalents__rank` 
FROM characters Characters 
INNER JOIN talents Talents ON CharactersTalents.id = 1
INNER JOIN characters_talents CharactersTalents ON (Characters.id = (CharactersTalents.character_id) AND Talents.id = (CharactersTalents.talent_id)) 
WHERE Characters.id = 1;
	
alter table skills drop column modified;

delete from phinxlog where version = '20150809201559';

drop table phinxlog;
drop table training;
drop table skills;
drop table stats;
drop table characters_talents;
drop table talents;
drop table characters;
drop table species;
drop table users;
drop table groups;

update characters set stat_ag = 2 where id=1;
update species set class='Bothan' where name='Bothan' and id>0;
delete from characters where id > 2;


use edgetest;
SELECT * FROM characters;
drop table training;
drop table characters;
drop table species;
drop table skills;
drop table stats;

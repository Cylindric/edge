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
SELECT * FROM xp;

-- v0.2 to v0.3
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Arcona', 'Arcona',             10, 10, 100, 1, 2, 2, 2, 3, 2);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Chevin', 'Chevin',             11, 11,  80, 3, 1, 2, 3, 2, 1);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Gran', 'Gran',                 10,  9, 100, 2, 2, 2, 1, 2, 3);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Chiss', 'Chiss',               10, 10, 100, 2, 2, 3, 2, 2, 1);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Duros', 'Duros',               11, 10, 100, 1, 2, 3, 2, 2, 2);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Toydarian', 'Toydarian',        9, 12,  90, 1, 1, 2, 2, 3, 3);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Drall', 'Drall',                8, 12,  90, 1, 1, 4, 2, 2, 2);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Selonian', 'Selonian',         11, 10,  90, 2, 3, 2, 1, 3, 1);
INSERT INTO species (name, class, base_wound, base_strain, base_xp, stat_br, stat_ag, stat_int, stat_cun, stat_will, stat_pr) VALUES ('Corellian Human', 'Corellian', 10, 10, 110, 2, 2, 2, 2, 2, 2);
INSERT INTO talents (name, ranked) VALUES ('Mood Reader', false);
INSERT INTO talents (name, ranked) VALUES ('Flying', false);
CREATE TABLE `xp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `character_id` INT NOT NULL,
  `value` INT NOT NULL,
  `note` VARCHAR(45) NOT NULL DEFAULT '',
  `created` DATETIME NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_characters_idx` (`character_id` ASC),
  CONSTRAINT `fk_characters`
    FOREIGN KEY (`character_id`)
    REFERENCES `edge`.`characters` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION);

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

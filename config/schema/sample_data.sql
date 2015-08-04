INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('1', 'Human', 'Human', '10', '10', '100', '2', '2', '2', '2', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('2', 'Droid', 'SpeciesBase', '10', '10', '175', '1', '1', '1', '1', '1', '1');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('3', 'Wookiee', 'SpeciesBase', '10', '10', '100', '2', '2', '2', '2', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('4', 'Twi\'Lek', 'SpeciesBase', '10', '10', '100', '2', '2', '2', '2', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('5', 'Bothan', 'SpeciesBase', '10', '11', '100', '1', '2', '2', '3', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('6', 'Rodian', 'SpeciesBase', '10', '10', '100', '2', '2', '2', '2', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('7', 'Trandoshan', 'SpeciesBase', '10', '10', '100', '2', '2', '2', '2', '2', '2');
INSERT INTO `species` (`id`, `name`, `class`, `base_wound`, `base_strain`, `base_xp`, `stat_br`, `stat_ag`, `stat_int`, `stat_cun`, `stat_will`, `stat_pr`) VALUES ('8', 'Gand', 'SpeciesBase', '10', '10', '100', '2', '2', '2', '2', '3', '1');

INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('1', 'Brawn', 'Br');
INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('2', 'Agility', 'Ag');
INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('3', 'Intellect', 'Int');
INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('4', 'Cunning', 'Cun');
INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('5', 'Willpower', 'Will');
INSERT INTO `stats` (`id`, `name`, `code`) VALUES ('6', 'Presence', 'Pr');

INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('1', '3', '1', 'Astrogation');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('2', '1', '1', 'Athletics');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('3', '6', '1', 'Charm');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('4', '5', '1', 'Coercion');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('5', '3', '1', 'Computers');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('6', '6', '1', 'Cool');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('7', '2', '1', 'Coordination');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('8', '4', '1', 'Deception');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('9', '5', '1', 'Discipline');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('10', '6', '1', 'Leadership');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('11', '3', '1', 'Mechanics');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('12', '3', '1', 'Medicine');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('13', '6', '1', 'Negotiation');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('14', '4', '1', 'Perception');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('15', '2', '1', 'Piloting - Planetary');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('16', '2', '1', 'Piloting - Space');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('17', '1', '1', 'Resilience');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('18', '4', '1', 'Skulduggery');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('19', '2', '1', 'Stealth');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('20', '4', '1', 'Streetwise');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('21', '4', '1', 'Survival');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('22', '5', '1', 'Vigilance');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('23', '1', '2', 'Brawl');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('24', '2', '2', 'Gunnery');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('25', '1', '2', 'Melee');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('26', '2', '2', 'Ranged - Light');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('27', '2', '2', 'Ranged - Heavy');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('28', '1', '2', 'Lightsaber');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('29', '3', '3', 'Core Worlds');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('30', '3', '3', 'Education');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('31', '3', '3', 'Lore');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('32', '3', '3', 'Outer Rim');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('33', '3', '3', 'Underworld');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('34', '3', '3', 'Warfare');
INSERT INTO `skills` (`id`, `stat_id`, `skilltype_id`, `name`) VALUES ('35', '3', '3', 'Xenology');

INSERT INTO `edge`.`characters`
(`id`,`user_id`,`species_id`,`name`,`gender`,`age`,`height`,`weight`,`hair_colour`,`eye_colour`,`build`,`home_planet`,`notable_features`,`stat_br`,`stat_ag`,`stat_int`,`stat_cun`,`stat_will`,`stat_pr`) VALUES
(1, 1, 1, 'Testing User', 'Male', 37, '6\' 2"', '90kg', 'Brown', 'Blue', 'Athletic', 'Corellia', 'Only has one eye', 2, 2, 2, 2, 2, 2);



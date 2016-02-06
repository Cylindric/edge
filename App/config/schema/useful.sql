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
SELECT * FROM characters_talents ORDER BY ct.character_id;
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
SELECT * FROM specialisations ORDER BY name;
SELECT * FROM species;
SELECT * FROM stats;
SELECT * FROM talents where description like '%{dice%' ORDER BY id;
SELECT * FROM users;
SELECT * FROM weapon_types;
SELECT * FROM weapons ORDER BY name;
SELECT * FROM xp ORDER BY modified DESC;

-- v0.7 to v0.8
-- THESE STILL NEED TRANSFERRING INTO A MIGRATION!
UPDATE characters c
INNER JOIN species s ON (c.species_id = s.id)
SET c.wound_threshold = c.wound_threshold - s.base_wound - c.stat_br,
c.strain_threshold = c.strain_threshold - s.base_strain - c.stat_will;

ALTER TABLE talents CHANGE COLUMN `description` `description` VARCHAR(300) NULL DEFAULT NULL;
UPDATE talents SET description = 'Remove {dice.setback.rank} from Deception or Skulduggery checks.' WHERE name = 'Convincing Demeanor';
UPDATE talents SET description = 'Remove {dice.setback.rank} from checks to find tracks or track targets. Decrease time to track a target by half.' WHERE name = 'Expert Tracker';
UPDATE talents SET description = 'Add {dice.boost.rank} to all checks when interacting with beast or animals (including combat checks). Add + 10 to Critical Injury results against beasts or animals per rank of Hunter.' WHERE name = 'Hunter';
UPDATE talents SET description = 'Remove {dice.setback.rank} from checks to move through terrain or manage environmental effects. Decrease overland travel times by half.' WHERE name = 'Outdoorsman';
UPDATE talents SET description = 'After making a successful attack, may spend I Destiny Point to add damage equal to Cunning to one hit.' WHERE name = 'Soft Spot';
UPDATE talents SET description = 'Do not suffer usual penalties for moving through difficult terrain.' WHERE name = 'Swift';
UPDATE talents SET description = 'When purchasing illegal goods, may reduce rarity by {rank}, increasing cost by 50 percent of base cost per reduction.' WHERE name = 'Black Market Contacts';
UPDATE talents SET description = 'Once per round on the character\'s turn, he may draw or holster an easily accessible weapon as an incidental, not a maneuver. This talent also reduces the amount of time to draw or stow a weapon that usually requires more than one maneuver to properly prepare or stow, by one maneuver.' WHERE name = 'Quick Draw';
UPDATE talents SET description = 'When defending computer systems, add {dice.setback.rank} to opponents\' checks.', name = 'Defensive Slicing' WHERE name = 'Defencive Slicing';
UPDATE talents SET description = 'Remove {dice.setback.rank} from checks to break codes or decypt comms. Decrease difficulty to break codes or decrypt codes by 1.' WHERE name = 'Codebreaker';
UPDATE talents SET description = 'Gain +{rank*2} Wound Threshold' WHERE name = 'Toughened';
UPDATE talents SET description = '' WHERE name = '';
UPDATE talents SET description = '' WHERE name = '';
UPDATE talents SET description = '' WHERE name = '';
UPDATE talents SET description = '' WHERE name = '';
UPDATE talents SET description = '' WHERE name = '';

-- The order of these is important due to inheritance - don't just re-sort the list!
DROP TABLE IF EXISTS characters_armour;
DROP TABLE IF EXISTS characters_items;
DROP TABLE IF EXISTS characters_notes;
DROP TABLE IF EXISTS characters_skills;
DROP TABLE IF EXISTS characters_talents;
DROP TABLE IF EXISTS characters_weapons;
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
DROP TABLE IF EXISTS phinxlog;


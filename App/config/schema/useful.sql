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

-- v0.5 to v0.6
ALTER TABLE species DROP COLUMN class;
ALTER TABLE talents ADD COLUMN `description` varchar(255);

UPDATE talents SET description = '+{rank} Soak.' WHERE name = 'Enduring';
UPDATE talents SET description = '+{rank} Strain.' WHERE name = 'Grit';
UPDATE talents SET description = '+{dice.boost.rank} to all Stealth and Coordination checks.' WHERE name = 'Stalker';
UPDATE talents SET description = 'Perform {check.average.medicine} to increase one characteristic of an engaged character by 1; suffer 1 Strain.' WHERE name = 'Stim Application';
UPDATE talents SET description = '+{rank} wound healed.' WHERE name = 'Surgeon';
UPDATE talents SET description = 'When targeted by a combat check, may suffer up to {rank} Strain to increase difficulty by {rank}.' WHERE name = 'Dodge';
UPDATE talents SET description = 'On successful attack, spend 1 Destiny Point to add {stat.ag} Damage to one hit.' WHERE name = 'Targeted Blow';
UPDATE talents SET description = 'Once per session, reduce rarity of a legal item by {rank}.' WHERE name = 'Know Somebody';
UPDATE talents SET description = 'On purchase, chose one of Charm, Coercion, Negotiation or Deception. On checks of that skill, may spend {symbol.triumph} to gain {symbol.success.rank}.' WHERE name = 'Smooth Talker';
UPDATE talents SET description = 'When selling legal goods to a merchant, gain {rank}0% more credits.' WHERE name = 'Wheel and Deal';
UPDATE talents SET description = 'When making Brawl checks, +1 Damage and Critical Rating 3.' WHERE name = 'Claws';


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

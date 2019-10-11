CREATE TABLE character_item (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    character_id INT NOT NULL,
    item_id INT NOT NULL,
    holding_item_id INT,
    count INT,
    attuned_level INT DEFAULT 0,
    hide_above_attuned_level BOOLEAN DEFAULT TRUE,
    apply_dm_overrides BOOLEAN DEFAULT TRUE
);

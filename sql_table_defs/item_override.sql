CREATE TABLE item_override (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    item_id INT NOT NULL,
    key STRING NOT NULL,
    value STRING NOT NULL,
    is_append BOOLEAN NOT NULL DEFAULT true;
    attunement_level INT DEFAULT 0,
    visible_below_attunement_level BOOLEAN DEFAULT true,
    dm_overried_value STRING DEFAULT NULL
);

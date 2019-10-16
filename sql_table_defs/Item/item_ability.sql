CREATE TABLE item_ability (
    id INT AUTO_INCREMENT NOT NULL,
    item_id INT NOT NULL,
    ability_id INT NOT NULL,
    attunement_level_required INT DEFAULT 0,
    attune_by JSON,
    requires_proficiency BOOL DEFAULT false,
    always_on BOOL DEFAULT false,
    PRIMARY KEY (id)
);

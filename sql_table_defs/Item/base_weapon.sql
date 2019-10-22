CREATE TABLE base_weapon (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    cost_copper INT NOT NULL,
    weight_pounds FLOAT NOT NULL,
    damage_die_amount INT NOT NULL,
    damage_die_type INT NOT NULL,
    damage_type VARCHAR(32) NOT NULL,
    class VARCHAR(16) NOT NULL,
    ranged BOOLEAN NOT NULL DEFAULT false,
    properties JSON
);

CREATE TABLE base_container (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    weight_on_character BOOLEAN NOT NULL,
    maximum_weight_pounds INT,
    hold_specific_base_item VARCHAR(32),
    maximum_number INT,
    carried_on_person BOOLEAN
);

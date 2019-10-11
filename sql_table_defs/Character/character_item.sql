CREATE TABLE character_item (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    character_id INT NOT NULL,
    item_id INT NOT NULL,
    holding_item_id INT,
    count INT
);

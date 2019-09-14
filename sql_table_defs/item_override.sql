CREATE TABLE item_override (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    item_id INT NOT NULL,
    override_key VARCHAR(32) NOT NULL,
    value VARCHAR(128) NOT NULL,
    is_append BOOLEAN DEFAULT TRUE
);

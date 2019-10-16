CREATE TABLE ability_override (
    id INT NOT NULL,
    override_key VARCHAR(32) NOT NULL,
    value VARCHAR(128) NOT NULL,
    is_append BOOLEAN DEFAULT TRUE
);

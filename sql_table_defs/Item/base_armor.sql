CREATE TABLE base_armor (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    class VARCHAR(16) NOT NULL,
    cost_copper INT NOT NULL,
    weight_pounds FLOAT NOT NULL,
    base_ac INT NOT NULL,
    max_dex_ac_bonus INT,
    other_ac_bonus INT NOT NULL,
    min_str_requirement INT NOT NULL,
    stealth_disadvantage BOOL NOT NULL,
    don_time_turns INT NOT NULL,
    doff_time_turns INT NOT NULL
);

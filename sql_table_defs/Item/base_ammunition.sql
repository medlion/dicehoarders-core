CREATE TABLE base_ammunition (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    cost_copper INT NOT NULL,
    weight_pounds FLOAT NOT NULL,
    bundle_size INT
);
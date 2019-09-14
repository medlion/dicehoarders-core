CREATE TABLE item (
    id INT AUTO_INCREMENT NOT NULL,
    type INT NOT NULL,
    cost_copper INT,
    weight_pounds FLOAT,
    description LONGTEXT,
    source VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE ability (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    slug VARCHAR(32),
    uses INT DEFAULT 0,
    recharge_time INT,
    recharge_time_unit VARCHAR (16),
    recharge_amount VARCHAR(8) DEFAULT '1',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

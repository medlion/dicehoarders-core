CREATE TABLE ability (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    ability_type VARCHAR (16) NOT NULL,
    attunement_level_required INT DEFAULT 0,
    attune_by JSON,
    uses INT DEFAULT 0,
    recharge_time INT,
    recharge_time_unit VARCHAR (16),
    recharge_amount VARCHAR(8) DEFAULT '1',
    PRIMARY KEY (id)
);
CREATE TABLE `item`
(
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    type int(11) NOT NULL,
    name varchar(128) NOT NULL,
    description longtext DEFAULT NULL,
    physical_description longtext DEFAULT NULL,
    rarity varchar (32) DEFAULT NULL,
    source varchar(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

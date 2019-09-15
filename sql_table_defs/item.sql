CREATE TABLE `item`
(
    `id`                   int(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type`                 int(11)      NOT NULL,
    `name`                 varchar(128) NOT NULL,
    `description`          longtext     DEFAULT NULL,
    `physical_description` longtext     DEFAULT NULL,
    `source`               varchar(255) DEFAULT NULL
);

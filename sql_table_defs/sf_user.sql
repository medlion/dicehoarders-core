create table sf_user ( id int not null auto_increment, email varchar(180) not null unique, validated bool not null default false, username varchar(180) not null unique, roles json, password varchar(255) not null, primary key (id) );
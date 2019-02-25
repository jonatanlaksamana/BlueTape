
CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP ON *.* TO 'dev'@'localhost';

# Create DB
CREATE DATABASE IF NOT EXISTS `bluetape` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bluetape`;


create table bluetape_userinfo(
    email varchar(128),
    name varchar(256),
    lastUpdate datetime
);

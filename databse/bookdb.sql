CREATE DATABASE IF NOT EXISTS bookdb;
USE bookdb;
CREATE TABLE book (
id int(11) NOT NULL AUTO_INCREMENT,
	isbn varchar(30) NOT NULL,
	title varchar(255) NOT NULL,
	author varchar(255) NOT NULL,
	date_added timestamp NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (id)
);
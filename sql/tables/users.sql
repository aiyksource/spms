CREATE TABLE users(
	id int(11) NOT NULL auto_increment,
	username varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	access varchar(255) NULL,
	date_added datetime NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY (email)
);
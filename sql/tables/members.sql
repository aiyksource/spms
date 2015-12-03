CREATE TABLE members(
	id int(11) NOT NULL auto_increment,
	firstname varchar(255) NOT NULL,
	lastname varchar(255) NOT NULL,
	job_title varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	avatar varchar(255) NOT NULL,
	organization int(11) NOT NULL,	
	access varchar(2) NOT NULL,
	date_added datetime NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY id (email)
);
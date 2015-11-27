CREATE TABLE tbl_organizations(
	id int(11) NOT NULL auto_increment,
	name varchar(255) NOT NULL,
	logo varchar(255) NOT NULL,
	category varchar(255) NOT NULL,
	description longtext NULL,
	location varchar(255) NULL,
	links varchar(255) NULL,
	org_password varchar(255) NOT NULL,
	org_email varchar(255) NOT NULL,
	access_key varchar(2) NOT NULL,
	date_added datetime NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY id (org_email)
);
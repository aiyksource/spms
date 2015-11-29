CREATE TABLE tbl_org_categories(
	id int(11) NOT NULL auto_increment,
	category varchar(255) NOT NULL,
	added_by varchar(50) NOT NULL,
	date_added datetime NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY id (category)
);